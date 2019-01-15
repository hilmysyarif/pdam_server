<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Url;
use App\User;
use App\Berita;
use Facades\App\Helpers\UrlHlp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class FrontendController extends Controller
{
    public function index()
    {

        $beritas    = Berita::all();

        return view('frontend.welcome', [
            'beritas' => $beritas,
        ]);
    }
}
