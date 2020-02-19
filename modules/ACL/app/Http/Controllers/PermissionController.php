<?php

namespace ACL\Http\Controllers;

use ACL\Http\Requests\UpdatePermissionRequest;
use ACL\Model\Permission;
use App\Http\Controllers\Paginator;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    use Paginator;

    public function index(Request $request)
    {
        $permissions = app('acl.model.permission')
            ->findAllByRoleOrUser($this->getLimit(), $request->role, $request->user);

        return view('acl.permission.index', compact('permissions'));
    }

    public function edit($id)
    {
        $permission = Permission::findOrfail($id);

        return view('acl.permission.edit', compact('permission'));
    }

    public function update($id, UpdatePermissionRequest $request)
    {
        Permission::findOrfail($id)->update($request->all());

        return redirect()->route('acl.permission.index', ['idRole' => 0, 'idUser' => 0]);
    }

    public function labelAutocomplete(Request $request)
    {
        return response()->json(
            Permission::select(['readable_name as title', 'name AS writer'])
                ->where('readable_name', 'ILIKE', "%{$request->get('q')}%")
                ->orderBy('readable_name')
                ->get()
        );
    }

    public function nameAutocomplete(Request $request)
    {
        return response()->json(
            Permission::select(['name as title', 'readable_name AS writer'])
                ->where('name', 'ILIKE', "%{$request->get('q')}%")
                ->orderBy('name')
                ->get()
        );
    }
}
