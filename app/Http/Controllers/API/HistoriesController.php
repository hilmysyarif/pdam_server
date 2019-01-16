<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\History;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Input;

class HistoriesController extends Controller
{
    public $successStatus = 200;


    /**
     * all histories api
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Sistem mengecek history pelanggan x seluruh history pemakaian.
        $histories = History::Where('user_id', $user->id)->get();

        return response()->json(['success' => $histories], $this-> successStatus);
    }

    /**
     * current month api
     *
     * @return \Illuminate\Http\Response
     */
    public function current()
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Mendapatkan bulan dan tahun saat ini
        $month = date('n');
        $year = date('Y');

        // Sistem mengecek history pelanggan x untuk bulan dan tahun saat ini
        $history = History::Where(['user_id' => $user->id, 'bulan' => $month, 'tahun' => $year])->first();

        return response()->json(['success' => $history], $this-> successStatus);
    }

    /**
     * current month api
     *
     * @return \Illuminate\Http\Response
     */
    public function last_total_used()
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Mendapatkan total pemakaian terakhir
        $history = History::Where('user_id', $user->id)->orderBy('bulan','ASC')->orderBy('tahun','ASC')->first()->jumlah_pemakaian;

        return response()->json(['success' => $history], $this-> successStatus);
    }

    /**
     * add new history api
     *
     * @return \Illuminate\Http\Response
     */
    public function add_new(Request $request)
    {

        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Pengecekan apakah pelanggan memiliki history sebelumnya?
        $history = History::Where('user_id', $user->id)->orderBy('bulan','ASC')->orderBy('tahun','ASC')->first();

        // validasi untuk data yang diinput harus diisi
        $validator = Validator::make($request->all(), [
            'bulan'                 => 'required|numeric|min:1|max:12',
            'tahun'                 => 'required|numeric',
            'jumlah_pemakaian'      => 'required|numeric',
            'foto_meteran'          => 'mimes:jpeg,jpg,png,gif|required|max:500',
        ]);

        // Jika validasi tidak lolos, munculkan pesan error;
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $uploads = public_path() . '/uploads/meteran';
        $photo = Input::file('foto_meteran');
        $photodestinationPath = $uploads;

        $photoname = null;

        if($photo != null)
        {
          $photoname = str_slug($request->bulan.$request->tahun.$user->id).'.'.$photo->getClientOriginalExtension();
          Input::file('foto_meteran')->move($photodestinationPath, $photoname);
        }

        if(!$history){
          // Ini adalah pelanggan yang belum mempunyai history apapun

          // Ambil seluruh data inputan
          $input = $request->all();

          // Hitung pemakaian saat ini
          $jumlah_pemakaian_saat_ini = ($request->jumlah_pemakaian);

          // Perhitungan rumus total bayar
          if($jumlah_pemakaian_saat_ini > 0){
            if($jumlah_pemakaian_saat_ini >= 1 && $jumlah_pemakaian_saat_ini <= 10) {
              $input['total_bayar'] = $jumlah_pemakaian_saat_ini * 300;
            }else if($jumlah_pemakaian_saat_ini >= 11 && $jumlah_pemakaian_saat_ini <= 20){
              $input['total_bayar'] = $jumlah_pemakaian_saat_ini * 400;
            }else if($jumlah_pemakaian_saat_ini >= 21 && $jumlah_pemakaian_saat_ini <= 30){
              $input['total_bayar'] = $jumlah_pemakaian_saat_ini * 500;
            }else if($jumlah_pemakaian_saat_ini >= 31 && $jumlah_pemakaian_saat_ini <= 40){
              $input['total_bayar'] = $jumlah_pemakaian_saat_ini * 600;
            }else if($jumlah_pemakaian_saat_ini >= 41){
              $input['total_bayar'] = $jumlah_pemakaian_saat_ini * 1000;
            }
          }
          $input['user_id'] = $user->id;
          $input['foto_meteran'] = $photoname;

          $history = History::create($input);
        }else{
          // Ini adalah pelanggan yang sudah memiliki history
          $total_pemakaian_terakhir = $history->jumlah_pemakaian;

          // Ambil seluruh data inputan
          $input = $request->all();
          // Hitung pemakaian saat ini
          $jumlah_pemakaian_saat_ini = ($request->jumlah_pemakaian - $total_pemakaian_terakhir);

          // Perhitungan rumus total bayar
          if($jumlah_pemakaian_saat_ini > 0){
            if($jumlah_pemakaian_saat_ini >= 1 && $jumlah_pemakaian_saat_ini <= 10) {
              $input['total_bayar'] = $jumlah_pemakaian_saat_ini * 300;
            }else if($jumlah_pemakaian_saat_ini >= 11 && $jumlah_pemakaian_saat_ini <= 20){
              $input['total_bayar'] = $jumlah_pemakaian_saat_ini * 400;
            }else if($jumlah_pemakaian_saat_ini >= 21 && $jumlah_pemakaian_saat_ini <= 30){
              $input['total_bayar'] = $jumlah_pemakaian_saat_ini * 500;
            }else if($jumlah_pemakaian_saat_ini >= 31 && $jumlah_pemakaian_saat_ini <= 40){
              $input['total_bayar'] = $jumlah_pemakaian_saat_ini * 600;
            }else if($jumlah_pemakaian_saat_ini >= 41){
              $input['total_bayar'] = $jumlah_pemakaian_saat_ini * 1000;
            }
          }
          $input['user_id'] = $user->id;
          $input['foto_meteran'] = $photoname;

          $history = History::create($input);
        }

        return response()->json(['success' => $history], $this-> successStatus);
    }



}
