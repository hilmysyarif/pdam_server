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
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

class DashboardController extends Controller
{
    public function view()
    {

        $serviceAccount = ServiceAccount::fromJsonFile(public_path('/json/pdam-kertawinangun.json'));
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)

        ->withDatabaseUri('https://pdam-kertawinangun.firebaseio.com/')
        ->create();
        $database = $firebase->getDatabase();

        $beritas = $database->getReference('news/posts')->getSnapshot();

        $users = $database->getReference('users')->getSnapshot()->numChildren();
        $activeUser = $database->getReference('users')->getSnapshot();
        $countActiveUser = 0;
        $countInActiveUser = 0;
        foreach ($activeUser->getValue() as $key => $value) {
          if(isset($value['alamat'])){
            $countActiveUser += 1;
          }else{
            $countInActiveUser += 1;
          }
        }
        return view('backend.dashboard', [
            'totalPelanggan'       => $users,
            'totalPelangganAktif'  => $countActiveUser,
            'totalPelangganTdkAktif'  => $countInActiveUser,
            'beritas' => $beritas->getValue(),
        ]);
    }
}
