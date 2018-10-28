<?php

namespace Audit\Http\Controllers;

use Audit\Model\Audit;

class LogController extends Controller
{
    public function index()
    {
        try {
            $logs = Audit::orderBy('created_at', 'desc')->paginate($this->getLimit());

            return view('audit.log.index', compact('logs'));
        } catch (\Exception $exception) {
            flash('danger', trans('flash.save.error'), $exception->getMessage());

            return redirect()->route('home');
        }
    }
}
