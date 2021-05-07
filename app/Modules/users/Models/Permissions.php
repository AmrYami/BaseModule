<?php

namespace Users\Models;

use App\Models\BaseModel;

/**
 * Class Role
 * @package App\Models
 * @version December 11, 2019, 11:23 am UTC
 *
 * @property string name
 * @property string guard_name
 */
class Permissions extends BaseModel
{

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
    public $table = 'permissions';



    public $fillable = [
        'name',
        'guard_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'guard_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:255|unique:roles,name',
    ];

}
