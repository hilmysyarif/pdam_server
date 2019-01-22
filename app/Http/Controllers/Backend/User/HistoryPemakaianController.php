<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\Url;
use Yajra\Datatables\Datatables;
use App\History;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
    }

    public function index()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(public_path('/json/pdam-kertawinangun.json'));
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://pdam-kertawinangun.firebaseio.com/')
        ->create();

        $database = $firebase->getDatabase();
        $users = $database->getReference('users')->getSnapshot()->getValue();
        $full_name = Auth::user()->first_name .' '. Auth::user()->last_name;
        $myhistory = [];
        foreach ($users as $key => $value) {
          if($value['firstName'] == Auth::user()->first_name && $value['lastName'] && Auth::user()->last_name && $value['id_pelanggan'] == Auth::user()->id_pelanggan){
            $uid = $key;
            $histories = $database->getReference('history/meteran/'.$uid)->getSnapshot()->getValue();
            if($histories){
              foreach ($histories as $key => $value2) {
                foreach ($value2 as $key => $value3) {
                  array_push($myhistory, $value3);
                }
              }
            }
          }
        }
        return view('backend.user.history.index', ['histories' => $myhistory]);
    }

    public function store(Request $request){
      $serviceAccount = ServiceAccount::fromJsonFile(public_path('/json/pdam-kertawinangun.json'));
      $firebase = (new Factory)
      ->withServiceAccount($serviceAccount)
      ->withDatabaseUri('https://pdam-kertawinangun.firebaseio.com/')
      ->create();
      $database = $firebase->getDatabase();
      $users = $database->getReference('users')->getSnapshot()->getValue();
      $full_name = Auth::user()->first_name .' '. Auth::user()->last_name;
      $last = [];
      foreach ($users as $key => $value) {
        if($value['firstName'] == Auth::user()->first_name && $value['lastName'] && Auth::user()->last_name && $value['id_pelanggan'] == Auth::user()->id_pelanggan){
          $uid = $key;
          $histories = $database->getReference('history/meteran/'.$uid)->getSnapshot()->getValue();
          if($histories){
            foreach ($histories as $key => $value2) {
              foreach ($value2 as $key => $value3) {
                if($request->bulan != 1){
                  if($value3['bulan'] == ($request->bulan -1) && $value3['tahun'] == $request->tahun){
                    array_push($last, $value3);
                  }
                }else{
                  if($value3['bulan'] == 12 && $value3['tahun'] == $request->tahun - 1){
                    array_push($last, $value3);
                  }
                }
              }
            }
          }
        }
      }

      $this->validate($request, [
        'foto_meteran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:500',
      ]);

      if ($request->hasFile('foto_meteran')) {
          $storage = $firebase->getStorage();
          $bucket = $storage->getBucket();
          $image = $request->file('foto_meteran');
          $file = fopen($image, 'r');
          $name = str_slug($request->bulan.$request->tahun.Auth::user()->id).'.'.$image->getClientOriginalExtension();
          $object = $bucket->upload($file, [
              'name' => $name
          ]);
        }
      if($last){
        $selisih = ($request->jumlah_pemakaian - $last[0]['jumlah_meteran']);
      }else{
        $selisih = 0;
      }
      $total_bayar = 0;
      if($selisih > 0){
        if($selisih >= 1 && $selisih <= 10){
          $total_bayar = $selisih * 300;
        }else if($selisih >= 11 && $selisih <= 20){
          $total_bayar = $selisih * 400;
        }else if($selisih >= 21 && $selisih <= 30){
          $total_bayar = $selisih * 500;
        }else if($selisih >= 31 && $selisih <= 40){
          $total_bayar = $selisih * 600;
        }else if($selisih >= 41){
          $total_bayar = $selisih * 1000;
        }
      }else{
        if($request->jumlah_pemakaian  >= 1 && $request->jumlah_pemakaian  <= 10){
          $total_bayar = $request->jumlah_pemakaian  * 300;
        }else if($request->jumlah_pemakaian  >= 11 && $request->jumlah_pemakaian  <= 20){
          $total_bayar = $request->jumlah_pemakaian  * 400;
        }else if($request->jumlah_pemakaian  >= 21 && $request->jumlah_pemakaian  <= 30){
          $total_bayar = $request->jumlah_pemakaian  * 500;
        }else if($request->jumlah_pemakaian  >= 31 && $request->jumlah_pemakaian  <= 40){
          $total_bayar = $request->jumlah_pemakaian  * 600;
        }else if($request->jumlah_pemakaian  >= 41){
          $total_bayar = $request->jumlah_pemakaian  * 1000;
        }
      }

        $history = $database->getReference('history/meteran/'.$uid.'/'.$request->tahun.'/'.$request->bulan)->set([
          'bulan' => $request->bulan,
          'tahun' => $request->tahun,
          'id_pelanggan' => Auth::user()->id_pelanggan,
          'jumlah_meteran' => $request->jumlah_pemakaian,
          'total_bayar' => $total_bayar,
          'foto_meteran' => 'https://firebasestorage.googleapis.com/v0/b/pdam-kertawinangun.appspot.com/o/'. $name. '?alt=media',
        ]);


      return $history;
    }

}
