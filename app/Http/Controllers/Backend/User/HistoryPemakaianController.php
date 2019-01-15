<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\Url;
use Yajra\Datatables\Datatables;
use App\History;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        $myhistory = History::where('user_id', Auth::user()->id)->get();
        return view('backend.user.history.index', ['histories' => $myhistory]);
    }

    public function store(Request $request){
      $last = History::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->first();

      $this->validate($request, [
        'foto_meteran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

      $history = new History;
      $history->user_id = Auth::user()->id;
      $history->bulan = $request->bulan;
      $history->tahun = $request->tahun;
      $history->jumlah_pemakaian = $request->jumlah_pemakaian;


      if ($request->hasFile('foto_meteran')) {
          $image = $request->file('foto_meteran');
          $name = str_slug($request->bulan.$request->tahun.Auth::user()->id).'.'.$image->getClientOriginalExtension();
          $destinationPath = public_path('/uploads/meteran');
          $imagePath = $destinationPath. "/".  $name;
          $image->move($destinationPath, $name);
          $history->foto_meteran = $name;
        }
      if($last){
        $selisih = ($request->jumlah_pemakaian - $last->jumlah_pemakaian);
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
      $history->total_bayar = $total_bayar;
      if($history->save()){
        $res = array('status' => 200, 'message' => "Sukses menambahkan history");

      }else{
        $res = array('status' => 500, 'message' => "Gagal menambahkan history");

      }
      return $res;
    }

}
