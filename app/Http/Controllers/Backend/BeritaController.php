<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Url;
use App\Berita;
use App\Category;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * BeritaController constructor.
     */
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $beritas = Berita::all();
        $categories = Category::all();

        return view('backend.berita.index', [
          'beritas' => $beritas,
          'categories' => $categories
        ]);
    }

    public function store(Request $request){

      $berita = new Berita;
      $berita->judul = $request->judul;
      $berita->content = $request->content;
      $berita->category_id = $request->category_id;

      if($berita->save()){
        $res = array('status' => 200, 'message' => "Sukses menambahkan berita");

      }else{
        $res = array('status' => 500, 'message' => "Gagal menambahkan berita");

      }
      return $res;
    }

    public function destroy(Request $request){
      $berita = Berita::find($request->id);
      $berita->delete();

      return array('status' => 200, 'message' => "Sukses menghapus berita");
    }
}
