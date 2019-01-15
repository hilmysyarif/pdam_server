<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Url;
use App\User;
use App\Berita;
use Facades\App\Helpers\UrlHlp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class DashboardController extends Controller
{
    public function view()
    {

        $beritas    = Berita::all();

        return view('backend.dashboard', [
            'totalPelanggan'       => User::count(),
            'totalPelangganAktif'  => User::where('first_name', '!=', '')->count(),
            'totalPelangganTdkAktif'  => User::where('updated_at', '=', null)->count(),
            'beritas' => $beritas,
        ]);
    }
}
