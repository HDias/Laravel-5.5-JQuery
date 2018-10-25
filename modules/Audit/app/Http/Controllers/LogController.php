<?php

namespace Audit\Http\Controllers;

use Audit\Model\Audit;
use GeDuc\Http\Controllers\Paginator;

class LogController extends Controller
{
    use Paginator;

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
