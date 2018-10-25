<?php

namespace ACL\Http\Controllers;

use GeDuc\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PermissionUserController extends controller
{
    public function link($id)
    {
        $user = User::findOrfail($id);
        $permissions = [];
        foreach (Auth::user()->getAllPermissions() as $permission) {
            $array = explode('.', $permission->name);
            if (isset($array[0]) && isset($array[1])) {
                $permissions[$array[0]][$permission->id] = [
                    'name' => $permission->readable_name,
                    'class' => $array[1]
                ];
            }
        }

        return view('acl.permissionRole.link', compact('user', 'permissions'));
    }

    public function store($id, Request $request)
    {
        Validator::make($request->all(), $this->rules($request))->validate();
        $user = User::findOrfail($id);
        $permissions = [];
        foreach ($request->get('permissions_id') as $id) {
            if (!in_array($id, $user->getRolesPermissions()->pluck('id')->toArray())) {
                array_push($permissions, $id);
            }
        }
        $user->syncPermissions(array_fill_keys($permissions, ['value' => true]));

        return redirect()->route('user.criar', ['idRole' => 0, 'idPermission' => 0]);
    }

    private function rules(Request $request, $id = null)
    {
        $rules = [
            'permissions_id' => ['sometimes', 'required', 'array'],
        ];

        return $rules;
    }
}
