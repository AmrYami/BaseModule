<?php

namespace Users\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use App\Interfaces\RepositoryStore;
use App\Repositories\BaseRepositoryStore;
use Illuminate\Http\Request;
use Users\Models\Role;

/**
 * Class CampaignRepository
 * @package App\Repositories
 * @version December 11, 2019, 2:33 pm UTC
 */
class RoleRepositoryStore extends BaseRepositoryStore implements RepositoryStore, BaseRepositoryInterface
{

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
//    public function update($id, $data, $filter = null)
//    {
//        $role = $this->model->WHERE('id', $id);
//        if ($filter)
//            $role = $role->WHERE($filter);
//        $role = $role->update($data);
//        if (isset($role) && isset($request->selected)) {
//            $role->syncPermissions($request->selected);
//        }
//        return $role;
//    }


    /**
     * Remove data from the Repository
     *
     * @param Request $request
     * @param Int $id
     * @return Boolean
     */
//    public function delete($id, $request)
//    {
//        $delete = $this->model->newQuery();
//        if ($request)
//            $delete = $delete->where($request);
//        if ($delete->findOrFail($id)->delete())
//            return true;
//        return false;
//    }

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Role::class;
    }
}
