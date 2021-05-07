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
class RoleRepositoryStore implements RepositoryStore
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
     * Use save data into Model
     *
     * @param Request $request
     * @return Boolean
     */
    public function save($data)
    {
        // check weather is there id or not
        $role = $this->model->create($data);
        return $role;
    }

    public function syncPermissions($data, $role)
    {
        if (isset($role) && isset($data)) {
            $res = $role->syncPermissions($data);
            if ($res)
                return true;
            return false;
        }
    }

    /**
     * Use save data into Model
     *
     * @param Request $request
     * @param Int $id
     * @return Boolean
     */
    public function update($id, $data, $filter = null)
    {
        $role = $this->model->WHERE('id', $id);
        if ($filter)
            $role = $role->WHERE($filter);
        $role = $role->update($data);
        if (isset($role) && isset($request->selected)) {
            $role->syncPermissions($request->selected);
        }
        return $role;
    }


    /**
     * Remove data from the Repository
     *
     * @param Request $request
     * @param Int $id
     * @return Boolean
     */
    public function delete($id, $request)
    {
        $delete = $this->model->newQuery();
        if ($request)
            $delete = $delete->where($request);
        if ($delete->findOrFail($id)->delete())
            return true;
        return false;
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

}
