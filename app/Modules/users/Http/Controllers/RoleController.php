<?php

namespace Users\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Users\Http\Requests\CreateRoleRequest;
use Users\Http\Requests\UpdateRoleRequest;
use Users\Services\RoleService;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Users\Services\RoleServiceShow;
use Users\Services\RoleServiceStore;

class RoleController extends BaseController
{

    /**
     * @var RoleServiceShow
     */
    private $serviceShow;
    /**
     * @var RoleServiceStore
     */
    private $roleServiceStore;

    public function __construct(RoleServiceShow $serviceShow, RoleServiceStore $roleServiceStore)
    {
        $this->middleware("permission:list-users-role", ['only' => ['index']]);
        $this->middleware("permission:create-users-role", ['only' => ['create']]);
        $this->middleware("permission:edit-users-role", ['only' => ['edit']]);
        $this->middleware("permission:delete-users-role", ['only' => ['destroy']]);
        $this->serviceShow = $serviceShow;
        $this->roleServiceStore = $roleServiceStore;
    }

    /**
     * Display a listing of the Role.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $roles = $this->serviceShow->find_by($request);
        return view('users::roles.index')
            ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return Response
     */
    public function create()
    {
        return view('users::roles.create', [
            'action' => 'create',
            'active' => 'Users Roles',
        ]);
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param CreateChannelRequest $request
     *
     * @return Response
     */
    public function store(CreateRoleRequest $request)
    {
        $role = $this->roleServiceStore->save($request);
        if ($role) {
            return redirect()->route('roles.index')->with('created', __('messages.Created', ['thing' => 'User Role']));
        } else {
            return back()->withErrors(__('common.Sorry But You Should Select Permission To Role'));
        }


    }

    /**
     * Display the specified Role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
//        $user = $this->userRepository->find($id);
//
//        if (empty($user)) {
//            Flash::error('User not found');
//
//            return redirect(route('roles.index'));
//        }
//
//        return view('users::roles.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified Role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, Request $request)
    {
        if ($id == 1)
            return back();
        $role = $this->serviceShow->find($id, $request);
        $rolePermissions = $role->permissions->pluck('id', 'id');
        $selected = $rolePermissions;
        return view('users::roles.edit', [
            'role' => $role,
            'rolePermissions' => $rolePermissions,
            'selected' => $selected,
            'action' => 'edit',
            'active' => 'Users Roles',
        ]);
    }

    /**
     * Update the specified Role in storage.
     *
     * @param int $id
     * @param UpdateChannelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoleRequest $request)
    {
        if ($id == 1)
            return back();
        $role = $this->roleServiceStore->update($id, $request);
        if ($role) {
            return redirect()->route('roles.index')->with('updated', __('messages.Updated', ['thing' => 'User Role']));
        } else {
            return back()->withErrors(__('common.Sorry But there Was an issue in saving Data please try again'));
        }
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy(Request $request, $id)
    {
        $delete = $this->roleServiceStore->delete($request, $id);
        if ($delete) {
            return redirect()->route('roles.index')->with('deleted', __('messages.Deleted', ['thing' => 'User Role']));
        } else {
            return redirect()->route('roles.index')->with('deleted', __('messages.You can\'t delete role that has users!!'));
        }
    }
}
