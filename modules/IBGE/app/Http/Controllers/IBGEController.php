<?php

namespace IBGE\Http\Controllers;

use Illuminate\Http\Request;

class IBGEController extends Controller
{
    public function city(Request $request)
    {
        $items = app('ibge.model.cidade')->findByName(utf8_encode($request->q))->get();
        return response()->json(compact('items'));
    }

    public function cityByCode(Request $request, $code)
    {
        $items = app('ibge.model.cidade')->findByIbgeCode($code)->get();
        return response()->json(compact('items'));
    }


}
