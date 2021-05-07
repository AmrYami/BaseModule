<?php

namespace Users\Repositories;

use App\Interfaces\RepositoryShow;
use App\Interfaces\RepositoryStore;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
/**
 * Class CampaignRepository
 * @package App\Repositories
 * @version December 11, 2019, 2:33 pm UTC
*/

class RoleRepositoryShow implements RepositoryShow
{
    /**
     * @var Role
     */
    private $model;

    /**
     * RoleRepository constructor.
     * @param Role $model
     */
    public function __construct(Role $model)
    {

        $this->model = $model;
    }

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'guard_name',
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
        $this->model->newQuery();
        if ($request)
            $this->model->where($request);
            return $this->model->paginate(25);
    }


    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Role::class;
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
