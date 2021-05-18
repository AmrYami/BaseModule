<?php

namespace Users\Services;

use App\Interfaces\ServiceShow;
use App\Interfaces\ServiceStore;
use Illuminate\Http\Request;
use Users\Models\User;
use Users\Repositories\UserRepositoryShow;
use Mockery\Exception;

class UserServiceShow implements ServiceShow
{
    public $repo;

    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    /**
     * Create a new Repository instance.
     *
     * @param UserRepository $repository
     * @return void
     */
    public function __construct(UserRepositoryShow $repository)
    {
        $this->repo = $repository;
    }

    /**
     * Use Search Criteria from request to find from Repository
     *
     * @param Request $request
     * @return Collection
     */

    public function find_by(Request $request):object
    {
        $users = $this->repo->find_by($request->all());
        return $users;
    }

    /**
     * Use id to find from Repository
     *
     * @param Int $id
     */
    public function find($id, Request $request): object
    {
        try {
            $user = $this->repo->find($id, $request->all());
            return $user;
        }catch (\Exception $exception){
            return false;
        }
    }


}

?>