<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $roles = $request->input('roles');
        $createdRolesData = [];

        foreach ($roles as $roleName) {
            $role = Role::create(['name' => $roleName]);
            $roleId = $role->id;
            $createdRolesData[] = ['id' => $roleId, 'name' => $roleName];
        }

        return response()->json(['roles_data' => $createdRolesData, 'message' => "Roles created successfully"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $roles = Role::all();
        return view('pages/role_management', ['roles' => $roles]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $rolesToDelete = $request->input('roles');
        Role::whereIn('id', $rolesToDelete)->delete();

        return response()->json(['message' => 'Roles deleted successfully']);
    }
}
