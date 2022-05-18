<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Requests\StoreUserPermissionRequest;
use App\Http\Resources\RolesResource;
use Illuminate\Support\Facades\DB;
use App\Models\UserPermission;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = DB::table('roles')->get();
        return RolesResource::collection($roles);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $data = $request->validated();
        $role = Role::create($data);
        return new RolesResource($role);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        //
    }

    public function UpdatePermission(Role $role, Request $request, $id) {
        $data = $request->data;
        $role = Role::where('id', '=', $id)->update([
            'permission' => $data,
        ]);
    }

    public function singleRole(UserPermission $permission, Request $request, $id){
        $role = Role::find($id);
        return $role;
    }

    public function newRolePermission(UserPermission $permission, StoreUserPermissionRequest $request, $id)
    {
        $permissions = $request->validated();
        // $user_id = $permissions['user_id'];

        // return $user_id;

        foreach ($permissions['data'] as $permission) {
            $permission = UserPermission::updateOrInsert([
                'role_id' => $id,
                'title' => $permission
            ]);
            
        }        
        return $permissions;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response('', 204);
    }
    public function deleteAllPost(Role $role) 
    {
        DB::table('roles')->delete();
        return response('deleted', 204);
    }
    public function roleCount()
    {
        $roleCount = DB::table('roles')->count();
        return [
            'counts' => $roleCount,
        ];
    }

    public function TotalSingleRolePermission(Request $request, $id)
    {
        $permissions = DB::table('user_permissions')->where('role_id', '=', $id)->pluck('title');
        return response($permissions);
        
    }
}
