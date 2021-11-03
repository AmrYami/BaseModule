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
class UserRepositoryStore extends BaseRepository implements RepositoryStore
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'type',
        'quota',
        'expiration_from',
        'expiration_to',
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

        $user = $this->model->create($data);
        $user->password = Hash::make($user->password);
        $user->save();

        return $user;
    }

    public function assignRole($user, $role)
    {
        $user->assignRole($role);
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
        $user = $this->model->WHERE('id', $id);
        if ($filter)
            $user = $user->WHERE($filter);
        $user = $user->update($data);

        return $user;
    }

    public function updatePassword($id, $data, $filter = null)
    {
        $user = $this->model->WHERE('id', $id);
        if ($filter)
            $user = $user->WHERE($filter);
        return $user = $user->update($data);
    }

    public function syncRole($user, $role)
    {
        $user->syncRoles($role);
    }

    public function restore(Request $request, $id = null)
    {
        $user = $this->find($id, ['*'], [], [], [], $trashed = true);
        $restored = $user->restore();
        return $restored;
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
