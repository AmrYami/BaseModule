<?php

namespace App\Repositories;

use App\Models\NotificationModel;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class NotificationRepository
 * @package App\Repositories
 * @version December 16, 2019, 2:25 pm UTC
 */
class NotificationRepository extends BaseRepositoryStore
{


    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id','type','related_id','related_type','message','route','label_type'
    ];


    /**
     * Use Search Criteria from request to find from model
     *
     * @param Request $request
     * @return Collection
     */
    public function find_by(Request $request, $relation = [], $columns = '*', $pluck = [], $recursiveRel = [])
    {
        return $this->all($request->all(), null, null, $columns, $relation, [],$recursiveRel, false, $pluck);
    }

    public function updateMultiRawsData($data, $ids, $column = 'id'){
        return $this->updateMultiRaws($data, $ids, $column);
    }

    /**
     * Use save data into Model
     *
     * @param Request $request
     * @param Int $id
     * @return Boolean
     */
    public function save(Request $request, $id = null)
    {
//        try {
            // check weather is there id or not
            if ($id) {

                // if there is id use the model as the id model object
                $notification = $this->update($request->all(), $id);
            } else {
                $notification = $this->create($request->all());
            }
//        } catch (\Exception $e) {
//            return false;
//        }
        return $notification;
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
        return NotificationModel::class;
    }
}
