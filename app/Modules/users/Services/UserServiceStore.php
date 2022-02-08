<?php

namespace Users\Services;

use App\Abstratctions\Service;
use App\Facades\MediaFacade;
use App\Interfaces\ServiceStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;
use Users\Models\User;
use Users\Repositories\UserRepositoryShow;
use Users\Repositories\UserRepositoryStore;

class UserServiceStore extends Service implements ServiceStore
{
    public $repo;
    /**
     * @var UserRepositoryStore
     */
    private $userRepositoryStore;
    /**
     * @var UserRepositoryShow
     */
    private $userRepositoryShow;
    /**
     * @var User
     */
    private $model;

    /**
     * Create a new Repository instance.
     *
     * @param UserRepositoryStore $userRepositoryStore
     * @param UserRepositoryShow $userRepositoryShow
     */
    public function __construct(UserRepositoryStore $userRepositoryStore, UserRepositoryShow $userRepositoryShow, User $model)
    {
        $this->userRepositoryStore = $userRepositoryStore;
        $this->userRepositoryShow = $userRepositoryShow;
        $this->model = $model;
    }


    /**
     * Use save data into Repository
     *
     * @param Request $request
     * @return Boolean
     */
    public function save(Request $request)
    {
        try {
            $request->request->add(['code' => uniqid()]);
            $user = $this->userRepositoryStore->save($request->all());
            if ($user)
                $this->userRepositoryStore->assignRole($user, $request->role);
            return $user;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * Use save data into Repository
     *
     * @param Request $request
     * @return Boolean
     */
    public function update($id, Request $request)
    {
            $data = $request->only($this->model->getFillable());
            $user = $this->userRepositoryStore->update($id, $data);
            if ($user) {
                $userObject = $this->userRepositoryShow->find($id);
                if ($request->role)
                    $this->userRepositoryStore->syncRole($userObject, $request->role);
                MediaFacade::mediafiles($request, $userObject);
            }
            return $user;

    }

    public function updatePassword($id, Request $request)
    {
        $this->clean_request($request);
        try {
            $data = ['password' => Hash::make($request->password)];
            $user = $this->userRepositoryStore->update($id, $data);
            return $user;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * Remove data from the Repository
     *
     * @param Request $request
     * @param Int $id
     * @return Boolean
     */
    public function delete(Request $request, $id = null)
    {
        $this->clean_request($request);
        $delete = $this->userRepositoryStore->delete($id, $request->all());
        return $delete;
    }

    /**
     * freeze data from the Repository
     *
     * @param Request $request
     * @param Int $id
     * @return Boolean
     */
    public function freeze(Request $request, $id = null)
    {
        $data = ['freeze' => 1];
        $this->clean_request($request);
        $delete = $this->userRepositoryStore->update($id, $data, $request->all());
        return $delete;
    }
    public function un_freeze(Request $request, $id = null)
    {
        $data = ['freeze' => 0];
        $this->clean_request($request);
        $delete = $this->userRepositoryStore->update($id, $data, $request->all());
        return $delete;
    }

    public function restore(Request $request, $id = null)
    {
        $restored = $this->repo->restore($request, $id);
        return $restored;
    }
}

?>
