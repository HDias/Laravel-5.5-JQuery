<?php

namespace ACL\Http\Controllers;

use ACL\Http\Requests\CreateUserRequest;
use ACL\Http\Requests\UpdateUserPasswordRequest;
use ACL\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Select\Model\Sexo;

class UserController extends Controller
{
    public function index(Request $request)
    {
         try {
            $search = $request->input('search', '');

            $users = app('acl.service.user')->allUserCheckRoles($search)->paginate(10);
            // $users = app('acl.service.user')->allUserCheckRoles($search)->all();

            return view('acl.user.index', compact('users'));
         } catch (\Exception $exception) {
             flash('danger', trans('flash.save.error'), $exception->getMessage());

             return redirect()->route('dashboard.index');
         }
    }

    public function create()
    {
        try {
            $roles = app('acl.service.user')->allRoleWithoutDeveloper()->get();

            return view('acl.user.create', compact('roles'));
        } catch (\Exception $exception) {
            flash('danger', trans('flash.save.error'), $exception->getMessage());

            return redirect()->route('user.index');
        }
    }

    public function store(CreateUserRequest $request)
    {
        try {
            \DB::beginTransaction();

            $user = app('model.user')->fill($request->except('roles'));
            $user->password = '123456';
            $user->save();

            $person = app('model.person');
            $person->fill($request->only(['sexo', 'dt_birth', 'cpf']));
            $person->user_id = $user->id;
            $person->save();

            $roles = explode(',', $request->roles);
            $user->syncRoles($roles);

            \DB::commit();

            flash('success', trans('flash.save_success'));

            return redirect()->route('user.index');
        } catch (\Exception $e) {
            \DB::rollBack();

            flash('danger', trans('flash.save_error'), $e->getMessage());

            return \Redirect::route('user.create')
                ->withErrors($request->validate())
                ->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $user = app('model.user')->findWithPersonById($id)->first();

            $selectedRoles = app('acl.model.role')->findToSelect($user->id)->get();

            $roles = app('acl.service.user')->allRoleWithoutDeveloper();

            return view('acl.user.edit', compact('user', 'roles', 'selectedRoles'));
        } catch (\Exception $exception) {
            flash('danger', trans('flash.edit_error'), $exception->getMessage());

            return redirect()->route('user.index');
        }
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            \DB::beginTransaction();

            $user = app('model.user')->findWithPersonById($id)->first();
            $user->update($request->except('roles'));

            $person = Person::where('user_id', '=', $user->id)->first();
            $person->update($request->only(['sexo', 'dt_birth', 'cpf']));

            // Se não vier Role alguma deve passar um array vazio para syncRoles()
            $roles = explode(',', $request->roles);
            if (is_null($request->roles)) {
                $roles = [];
            }

            $user->syncRoles($roles);

            \DB::commit();

            flash('success', trans('flash.update_success'));

            return redirect()->route('user.index');
        } catch (\Exception $e) {
            \DB::rollBack();
            flash('danger', trans('flash.save_error'), $e->getMessage());

            return \Redirect::route('user.index')
                ->withErrors($request->validate())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            User::findOrfail($id)->delete();

            return response()->json([
                'success' => true,
                'route' => route('user.index')
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'route' => route('user.index'),
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function editLogged()
    {
        if (!\Auth::user()->password_change_at) {
            flash('warning', 'Nota: É seu primeiro acesso, portanto, você deverá atualizar sua senha!');
        }

        return view('auth.passwords.change-password');
    }

    public function updatePassword(UpdateUserPasswordRequest $request)
    {
        try {
            $credentials = $request->only('password', 'password_confirmation');
            $user = \Auth::user();
            $user->password = $credentials['password'];
            $user->password_change_at = true;
            $user->save();

            flash('success', trans('flash.update_success'));

            return redirect()->route('dashboard.index');
        } catch (\Exception $exception) {
            flash('danger', trans('flash.save_error'), $exception->getMessage());

            return redirect()->back();
        }
    }

    public function restore($id)
    {
        try {
            User::withTrashed()->where('id', $id)->restore();
            flash('success', trans('flash.restore_sucess'));

            return redirect()->route('user.index');
        } catch (\Exception $e) {
            flash('danger', trans('flash.restore_error'), $e->getMessage());

            return \Redirect::route('user.index');
        }
    }
}
