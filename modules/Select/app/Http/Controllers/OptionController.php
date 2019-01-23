<?php

namespace Select\Http\Controllers;

use Illuminate\Http\Request;
use Select\Http\Requests\CreateOptionRequest;
use Select\Http\Requests\UpdateOptionRequest;
use Select\Model\Option;

class OptionController extends Controller
{
    public function index(Request $request)
    {
        try {
            $options = Option::all();

            return view('select.option.index', compact('options'));
        } catch (\Exception $exception) {
            flash('danger', trans('flash.save.error'), $exception->getMessage());

            return redirect()->route('home');
        }
    }

    public function create(Request $request)
    {
        try {
            return view('select.option.create');
        } catch (\Exception $exception) {
            flash('danger', trans('flash.save.error'), $exception->getMessage());

            return redirect()->route('select.option.index');
        }
    }

    public function store(CreateOptionRequest $request)
    {
        try {
            Option::create($request->all());

            flash('success', trans('flash.save_success'));

            return redirect()->route('select.option.create');
        } catch (\Exception $e) {
            flash('danger', trans('flash.save_error'), $e->getMessage());

            return \Redirect::route('select.option.create')
                ->withErrors($request->validate())
                ->withInput();
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $option = Option::findOrfail($id);

            return view('select.option.edit', compact('option', 'roles', 'selectedRoles'));
        } catch (\Exception $exception) {
            flash('danger', trans('flash.edit_error'), $exception->getMessage());

            return redirect()->route('select.option.index');
        }
    }

    public function update(UpdateOptionRequest $request, $id)
    {
        try {
            $option = Option::findOrfail($id);
            $option->update($request->all());

            flash('success', trans('flash.update_success'));

            return redirect()->route('select.option.index');
        } catch (\Exception $e) {
            flash('danger', trans('flash.save_error'), $e->getMessage());

            return \Redirect::route('select.option.create')
                ->withErrors($request->validate())
                ->withInput();
        }
    }


    public function destroy($id)
    {
        try {
            Option::findOrfail($id)->delete();

            return response()->json([
                'success' => true,
                'route' => route('select.option.index')
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'route' => route('select.option.index'),
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function labelAutocomplete(Request $request)
    {
        return response()->json(
            Option::select(['label as title', 'label AS writer'])
                ->where('label', 'ILIKE', "%{$request->get('q')}%")
                ->orderBy('label')
                ->get()
        );
    }
}
