<?php

namespace Users\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Users\Http\Requests\CreateUserRequest;
use Users\Http\Requests\UpdateUserPasswordRequest;
use Users\Http\Requests\UpdateUserRequest;
use Users\Http\Requests\UpdateUserProfileRequest;
use Users\Services\UserService;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Users\Services\UserServiceShow;
use Users\Services\UserServiceStore;

class UsersController extends BaseController
{
    /**
     * @var UserServiceShow
     */
    private $serviceShow;
    /**
     * @var UserServiceStore
     */
    private $userServiceStore;

    /**
     * Create a new Service instance.
     *
     * @param UserServiceShow $serviceShow
     * @param UserServiceStore $userServiceStore
     */
    public function __construct(UserServiceShow $serviceShow, UserServiceStore $userServiceStore)
    {
        $this->middleware('permission:list-users', ['only' => ['index']]);
        $this->middleware('permission:create-users', ['only' => ['create']]);
        $this->middleware('permission:edit-users', ['only' => ['edit']]);
        $this->middleware('permission:block-users', ['only' => ['destroy']]);
        $this->middleware('permission:edit-my-profile', ['only' => ['myProfile']]);
        $this->serviceShow = $serviceShow;
        $this->userServiceStore = $userServiceStore;
    }

    /**
     * Display a listing of the user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request): Renderable
    {
        $users = $this->serviceShow->find_by($request);
        return view('users::users.index')
            ->with('users', $users)
            ->with('action', 'users');
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $status = [
            0 => 'pending',
            1 => 'active',
        ];
        return view('users::users.create', [
            'action' => 'create',
            'status' => $status,
        ]);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $request->request->add(['type' => 'user']);
        $user = $this->userServiceStore->save($request);
        if ($user) {
            return redirect()->route('users.index')->with('created', __('messages.Created', ['thing' => 'User']));
        } else {
            return back()->withErrors(__('common.Sorry But there Was an issue in saving Data please try again'));
        }
    }

    /**
     * Display the user.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id): Renderable
    {
        $user = $this->serviceShow->find($id);
        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        return view('users::users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the user.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, Request $request)
    {
        $status = [
            0 => 'pending',
            1 => 'active',
        ];
        $user = $this->serviceShow->find($id, $request);
        return view('users::users.edit', [
            'user' => $user,
            'status' => $status,
            'action' => 'edit',
        ]);
    }

    /**
     * Update the specified user in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        try {
            $request->merge(['type' => 'user']);
            $user = $this->userServiceStore->update($id, $request);
            if ($user) {
                return redirect()->route('users.index')->with('updated', __('messages.Updated', ['thing' => 'User']));
            } else {
                return back()->withErrors(__('common.Sorry But there Was an issue in saving Data please try again'));
            }
        } catch (\Exception $exception) {
            return false;
        }

    }

    public function update_password($id, UpdateUserPasswordRequest $request)
    {
        $user = $this->userServiceStore->updatePassword($id, $request);
        if ($user) {
            return redirect()->route('users.index')->with('updated', __('messages.Updated', ['thing' => 'User']));
        } else {
            return back()->withErrors(__('common.Sorry But there Was an issue in saving Data please try again'));
        }
    }

    /**
     * Remove the specified user.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy(Request $request, $id)
    {
        if ($id == 1)
            return back()->withErrors(__('common.You cant delete this user'));
        $delete = $this->userServiceStore->delete($request, $id);
        if ($delete) {
            return redirect()->back()->with('deleted', __('messages.Deleted', ['thing' => 'User']));
        } else {
            return back()->withErrors(__('common.Sorry But there Was an issue in saving Data please try again'));
        }
    }

    /**
     * Update user's profile.
     *
     * @param int $id
     * @param UpdateUserProfileRequest $request
     *
     * @return Response
     */
    public function updateMyProfile($id, UpdateUserProfileRequest $request)
    {
        $user = $this->userServiceStore->update($id, $request);
        if ($user) {
            return redirect()->back()->with('updated', __('messages.Updated', ['thing' => 'Your Profile']));
        } else {
            return back()->withErrors(__('common.Sorry But there Was an issue in saving Data please try again'));
        }
    }


    public function myProfile(Request $request)
    {
        $user = $this->serviceShow->find(auth()->user()->id, $request);
        return view('users::users.profile', [
            'action' => 'my profile',
            'user' => $user,
        ]);
    }

    /**
     * Freeze user.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function freeze(Request $request, $id)
    {
        $delete = $this->userServiceStore->freeze($request, $id);
        if ($delete) {
            return redirect()->back()->with('deleted', __('messages.Freezed', ['thing' => 'User']));
        } else {
            return back()->withErrors(__('common.Sorry But there Was an issue in saving Data please try again'));
        }
    }

    public function un_freeze(Request $request, $id)
    {
        $delete = $this->userServiceStore->un_freeze($request, $id);
        if ($delete) {
            return redirect()->back()->with('deleted', __('messages.Un-Freezed', ['thing' => 'User']));
        } else {
            return back()->withErrors(__('common.Sorry But there Was an issue in saving Data please try again'));
        }
    }


}
