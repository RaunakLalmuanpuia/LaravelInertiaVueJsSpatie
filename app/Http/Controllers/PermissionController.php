<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use PDO;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    //
    public function index(){
        $permissions = Permission::with('roles')->get();

        $roles = Role::pluck('name', 'id');
        return Inertia::render('Role/Permission',[
            'permissions' => $permissions,
            'roles' => $roles,
        ]);
    }
    public function store(Request $request)
    {
        // dd($request);
        $data = $request -> validate([
            'name' => ['required', 'string'],
            'roles' => ['array'],
        ]);

        $permissions = Permission::create($data);

        $permissions->syncRoles($request->input('roles'));

        return redirect()->route('permissions');
    }
    public function update(Request $request, Permission $permission)
    {
        // dd($request);
        $data = $request->validate([
            'name' => ['required', 'string'],
            'roles' => ['array'],
        ]);

        $update_permission = $permission->where('id', $request->selectedPermission)->first();

        $update_permission->update($data);

        $update_permission->syncRoles($request->input('roles'));

        return redirect()->route('permissions');

    }
    public function destroy($id, Permission $permission){
        // dd($id);
        $permission->where('id', $id)->first()->delete();
        return redirect()->route('permissions');
    }
}
