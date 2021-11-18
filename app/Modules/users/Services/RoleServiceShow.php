<?php

namespace Users\Services;

use App\Interfaces\ServiceShow;
use App\Interfaces\ServiceStore;
use Illuminate\Http\Request;
use Users\Models\Role;
use Users\Repositories\RoleRepositoryShow;
use Mockery\Exception;

class RoleServiceShow implements ServiceShow
{
    public $repo;

    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    /**
     * Create a new Repository instance.
     *
     * @param RoleRepository $repository
     * @return void
     */
    public function __construct(RoleRepositoryShow $repository)
    {
        $this->repo = $repository;
    }

    /**
     * Use Search Criteria from request to find from Repository
     *
     * @param Request $request
     * @return Collection
     */

    public function find_by(Request $request): object
    {
        $roles = $this->repo->find_by($request->all());
        return $roles;
    }

    /**
     * Use id to find from Repository
     *
     * @param Int $id
     */
    public function find($id, Request $request): object
    {
//        try {
            $Role = $this->repo->find($id);
            return $Role;
//        } catch (\Exception $exception) {
//            return false;
//        }
    }


}
