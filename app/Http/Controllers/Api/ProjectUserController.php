<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectUserStoreRequest;
use App\Http\Resources\ProjectUserResource;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProjectUserResource::collection(ProjectUser::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectUserStoreRequest $request)
    {
        $created_project_user = ProjectUser::create($request->validated());

        return new ProjectUserResource($created_project_user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ProjectUserResource(ProjectUser::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function update(ProjectUserStoreRequest $request, $id)
    {
        ProjectUser::findOrFail($id)->update($request->validated());
        
        return new ProjectUserResource(ProjectUser::findOrFail($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProjectUser::findOrFail($id)->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
