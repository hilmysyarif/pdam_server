<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Url;
use App\Berita;
use App\Category;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

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
        $serviceAccount = ServiceAccount::fromJsonFile(public_path('/json/pdam-kertawinangun.json'));
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)

        ->withDatabaseUri('https://pdam-kertawinangun.firebaseio.com/')
        ->create();
        $database = $firebase->getDatabase();

        $beritas = $database->getReference('news/posts')->getSnapshot();
        $categories = Category::all();
        return view('backend.berita.index', [
          'beritas' => $beritas->getValue(),
          'categories' => $categories
        ]);
    }

    public function store(Request $request){

      $serviceAccount = ServiceAccount::fromJsonFile(public_path('/json/pdam-kertawinangun.json'));
      $firebase = (new Factory)
      ->withServiceAccount($serviceAccount)

      ->withDatabaseUri('https://pdam-kertawinangun.firebaseio.com/')
      ->create();
      $database = $firebase->getDatabase();

      $berita = $database->getReference('news/posts')->push([
        'judul' => $request->judul,
        'content' => $request->content,
        'category' => $request->category
      ]);
    }

    public function destroy(Request $request){
      $serviceAccount = ServiceAccount::fromJsonFile(public_path('/json/pdam-kertawinangun.json'));
      $firebase = (new Factory)
      ->withServiceAccount($serviceAccount)

      ->withDatabaseUri('https://pdam-kertawinangun.firebaseio.com/')
      ->create();
      $database = $firebase->getDatabase();
      $query = $database->getReference('news/posts/')->getChild($request->id);
      $reb = $query->getSnapshot()->getValue();
      $query->remove();

      return array('status' => 200, 'message' => "Sukses menghapus berita");
    }
}
