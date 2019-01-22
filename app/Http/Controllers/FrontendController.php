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
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

class FrontendController extends Controller
{
    public function index()
    {

      $serviceAccount = ServiceAccount::fromJsonFile(public_path('/json/pdam-kertawinangun.json'));
      $firebase = (new Factory)
      ->withServiceAccount($serviceAccount)

      ->withDatabaseUri('https://pdam-kertawinangun.firebaseio.com/')
      ->create();
      $database = $firebase->getDatabase();

      $beritas = $database->getReference('news/posts')->getValue();
        return view('frontend.welcome', [
            'beritas' => $beritas,
        ]);
    }
}
