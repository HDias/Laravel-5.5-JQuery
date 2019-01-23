<?php

namespace ACL\Http\Controllers;

use ACL\Http\Requests\CreateRoleRequest;
use ACL\Http\Requests\UpdateRoleRequest;
use ACL\Model\Permission;
use ACL\Model\Role;
use Artesaos\Defender\Facades\Defender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index(Request $request)
    {

        $roles = app('acl.model.role')
            ->findAllByPermissionOrUser($request->permission, $request->user)
            ->get();

        return view('acl.role.index', compact('roles'));
    }

    public function create()
    {
        $processPermissions = Permission::get();
        if (!Defender::hasRole(config('defender.superuser_role'))) {
            $processPermissions = Auth::user()->getRolesPermissions();
        }
        $permissions = [];
        foreach ($processPermissions as $permission) {
            $array = explode('.', $permission->name);
            if (isset($array[0]) && isset($array[1])) {
                $permissions[$array[0]][$permission->id] = [
                    'name' => $permission->readable_name,
                    'class' => $array[1]
                ];
            }
        }

        return view('acl.role.create', compact('permissions'));
    }

    public function store(CreateRoleRequest $request)
    {
        Role::create($request->except(['permissions_id']))
            ->permissions()
            ->attach($request->get('permissions_id'));

        return redirect()->route('acl.role.index', ['idPermission' => 0, 'idUser' => 0]);
    }

    public function edit($id)
    {
        $role = Role::findOrfail($id);
        $processPermissions = Permission::get();
        if (!Defender::hasRole(config('defender.superuser_role'))) {
            $processPermissions = Auth::user()->getAllPermissions();
        }
        $permissions = [];
        foreach ($processPermissions as $permission) {
            $array = explode('.', $permission->name);
            if (isset($array[0]) && isset($array[1])) {
                $permissions[$array[0]][$permission->id] = [
                    'name' => $permission->readable_name,
                    'class' => $array[1]
                ];
            }
        }

        return view('acl.role.edit', compact('role', 'permissions'));
    }

    public function update($id, UpdateRoleRequest $request)
    {
        $role = Role::findOrfail($id);
        $role->update($request->except(['permissions_id']));
        $role->permissions()->sync($request->get('permissions_id'));

        return redirect()->route('acl.role.edit', $role->id);
    }

    public function autocomplete(Request $request)
    {
        return response()->json(
            Role::select(['name as title', 'name AS writer'])
                ->where('name', 'ILIKE', "%{$request->get('q')}%")
                ->orderBy('name')
                ->get()
        );
    }

    public function destroy($id)
    {
        /**
         * Evita que sejam deletas as Roles com id 1 e 2
         */
        if (! in_array($id, [1, 2, 3])) {
            Role::findOrfail($id)->delete();
            return response()->json(
                ['success' => true, 'route' => route('acl.role.index')]
            );
        }

        return response()->json(
            ['success' => true, 'message' => 'Essa não!']
        );        
    }
}
