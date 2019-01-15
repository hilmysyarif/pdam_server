<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Url;
use Yajra\Datatables\Datatables;
use App\History;

class HistoryPemakaianController extends Controller
{
    /**
     * HistoryPemakaianController constructor.
     */
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $histories = History::all();
        return view('backend.history.index', ['histories' => $histories]);
    }
}
