<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionsUpdateRequest;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

        public function __construct(){
            // $this->middleware('role:Super-Admin');
            //  $this->middleware('permission:Delete Role');
            
        }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreRequest $request)
    {
        Role::create(
            $request->validated()
        );
        return redirect()->route('roles.index')->with('message', 'Role Created Successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, role $role)
    {
        $role->update($request->validated());
        return redirect()->route('roles.index')->with('message', 'Role Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('message', 'Role Deleted Successfully');
    }

    public function permissions(Role $role)
    {
        $permissions = Permission::all();

        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('admin.roles.add-permissions', compact('role', 'permissions', 'rolePermissions'));
        /*  */
    }

    public function permissionsUpdate(PermissionsUpdateRequest $request, Role $role)
    {

        /* return response()->json([

            'request' => $request->validated(),
            'role' => $role,
        ], 200); */



        $role->syncPermissions($request->validated());

        return redirect()->back()->with('message', 'Permissions Added to Role Successfully');
    }
}
