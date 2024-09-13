<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolePermission extends Controller
{
    public function role()
    {
        $data['roles'] = Role::all();
        return view('role.index', $data);
    }

    public function createrole(Request $request)
    {
        // dd($request->all());
        $role = Role::create(['name' => $request->input('name')]);

        return redirect('Role');
    }

    public function givepermission (Role $role)
    {
        $data['role'] = $role;
        $data['rolePermissions'] = Permission::
        join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id",$role->id)
        ->get();

        $roles = Permission::all();
        $arr = [];
        foreach ($roles as $key => $value) {
            $arr[$key] = '';
            foreach ($data['rolePermissions'] as $ky => $val) {

                if ($val->name == $value->name) {
                    $arr[$key] = $val->name;
                }
            }
        }

        $data['arr'] = $arr;
        // dd($arr);
        // dd($data['rolePermissions']);
        $data['permissions'] = Permission::all();
        return view('role.view', $data);

    }

    public function givepermissions(Role $role,Request $request)
    {
        // dd($request->all());
        $role->syncPermissions($request->name);

        return redirect('Role');
    }

    public function giveuserrole()
    {
        // dd('sas');

        $data['users'] = User::latest()->get();

        $data['roles'] = Role::pluck('name','name')->all();
        return view('role.user', $data);
    }

    public function giverole(User $user)
    {
        $data['user'] = $user;
        $data['roles'] = Role::all();
        $roles = Role::all();
        $userRole = $user->roles->all();
        $arr = [];
        foreach ($roles as $key => $value) {
            $arr[$key] = '';
            foreach ($userRole as $ky => $val) {

                if ($val->name == $value->name) {
                    $arr[$key] = $val->name;
                }
            }
        }

        $data['arr'] = $arr;
        // dd($arr);

        return view('role.role', $data);

    }

    public function giveroles(User $user,Request $request)
    {
        // dd($request->all());
        if($user->active == 'REQUEST'){
            $user->update(['active' => 'ACTIVE']);
        }
        $user->syncRoles($request->name);
        // $arr = [];
        // foreach ($user->getPermissionsViaRoles() as $key => $value) {
           
        //     $arr[$key] = $value->name;
        // }

        // $data['arr'] = $arr;
        // dd($arr);
        // $user->syncPermissions($arr);

        return redirect('giveuserrole');
    }

    public function permission()
    {
        $data['permissions'] = Permission::all();
        return view('permission.index', $data);
    }

    public function createpermission(Request $request)
    {
        $permission = Permission::create(['name' => $request->input('name')]);

        return redirect('Permission');
    }

}
