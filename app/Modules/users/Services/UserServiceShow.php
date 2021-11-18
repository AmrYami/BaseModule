<?php

namespace Users\Services;

use App\Interfaces\ServiceShow;
use Illuminate\Http\Request;
use Users\Repositories\UserRepositoryShow;

class UserServiceShow implements ServiceShow
{
    public $repo;

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
    public function find($id, Request $request = null): object
    {
        try {
            $user = $this->repo->find($id);
            return $user;
        }catch (\Exception $exception){
            return false;
        }
    }

    /**
     * @param array $criteria
     * @param array|string[] $columns
     * @return mixed
     */
    public function findByOperator(array $criteria, array $columns = ['*']){
        return $this->repo->findByOperator($criteria, $columns);
    }

}

?>
