<?php

namespace Users\Repositories;

use App\Interfaces\RepositoryShow;
use App\Interfaces\RepositoryStore;
use Illuminate\Database\Eloquent\Model;
use Users\Models\User;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
/**
 * Class CampaignRepository
 * @package App\Repositories
 * @version December 11, 2019, 2:33 pm UTC
*/

class UserRepositoryShow extends BaseRepository implements RepositoryShow
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

    public function find_by(array $request)
    {
       $query = $this->model->newQuery();
        if (isset($request['search']))
        $query->whereRaw("MATCH(name, email, mobile) AGAINST(? IN BOOLEAN MODE)",array($request['search']));

//        if ($request)
//            $query->where($request);
        return $query->paginate(25);
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

    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    public function find($id, array $filter = [])
    {
        return $this->model->findOrFail($id);
    }
}
