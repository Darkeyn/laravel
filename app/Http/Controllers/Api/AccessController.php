<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectUserResource;
use App\Models\ProjectUser;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function info($project_id, $user_id){

        return ProjectUserResource::collection(ProjectUser::all()->where(
            'project_id', '=', $project_id
        )->where(
            'user_id', '=', $user_id
        ))->first();

        // return "Hello $user_id, project $project_id";

    }
}
