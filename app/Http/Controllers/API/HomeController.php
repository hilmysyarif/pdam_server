<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\History;
use App\Berita;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
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
        $beritas = Berita::all();

        return response()->json(['success' => $beritas], $this-> successStatus);
    }

    /**
     * get token by user_id api
     *
     * @return \Illuminate\Http\Response
     */
    public function getToken()
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        return response()->json(['success' => $user->createToken('MyApp')->accessToken], $this-> successStatus);
    }

}
