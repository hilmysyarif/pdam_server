<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Url;
use Yajra\Datatables\Datatables;
use App\History;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

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
        $serviceAccount = ServiceAccount::fromJsonFile(public_path('/json/pdam-kertawinangun.json'));
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)

        ->withDatabaseUri('https://pdam-kertawinangun.firebaseio.com/')
        ->create();
        $database = $firebase->getDatabase();

        $histories = $database->getReference('history/meteran')->getSnapshot();

        return view('backend.history.index', ['histories' => $histories->getValue()]);
    }
}
