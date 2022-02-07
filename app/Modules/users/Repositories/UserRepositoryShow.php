<?php

namespace Users\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use App\Interfaces\RepositoryShow;
use App\Repositories\BaseRepositoryShow;
use Users\Models\User;
/**
 * Class Repository
 * @package App\Repositories
 * @version December 11, 2019, 2:33 pm UTC
*/

class UserRepositoryShow extends BaseRepositoryShow implements RepositoryShow, BaseRepositoryInterface
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'type',
        'created_at',
        'updated_at'
    ];

    /**
     * Use Search Criteria from request to find from model
     *
     * @param  Array $request
     * @return Collection
     */

//    public function find_by(array $request)
//    {
//       $query = $this->model->newQuery();
//        if (isset($request['search']))
//        $query->whereRaw("MATCH(name, email, mobile) AGAINST(? IN BOOLEAN MODE)",array($request['search']));
//
////        if ($request)
////            $query->where($request);
//        return $query->paginate(25);
//    }
    public function find_by(array $request, $perPage = 25)
    {
            return $this->paginate($request, $perPage);
    }

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable() : array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model() : string
    {
        return User::class;
    }

}
