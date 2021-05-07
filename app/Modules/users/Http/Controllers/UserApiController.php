<?php

namespace Users\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Resources\userResource;
use Illuminate\Http\Request;
use Users\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserApiController extends AppBaseController
{
    private $user_service;
    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }
    public function index(Request $request){

        $users = $this->user_service->find_by($request);
        if(Auth::user()->can('Force_list_user_when_share')){
            $all = new userResource($users);
            return $this->sendResponse($all, "");
        }else{
            $users = user()->mySubTree();
            return $users;
        }
    }
}
