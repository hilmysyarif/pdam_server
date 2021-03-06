<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
class UserController extends Controller
{
public $successStatus = 200;
/**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this-> successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pelanggan'  => 'required',
            'no_hp'     => 'required',
            'name'      => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $user_email = User::where('email', $request->email)->first();
        $user_id_pelanggan = User::where('id_pelanggan', $request->id_pelanggan)->first();
        if($user_email){
          $success['status'] = 500;
          $success['message'] = 'Email sudah terdaftar';
        }
        else if($user_id_pelanggan){
          $success['status'] = 500;
          $success['message'] = 'ID Pelanggan sudah ada';
        }
        else{
          $input = $request->all();
          $input['password'] = bcrypt($input['password']);
          $user = User::create($input);
          $success['token'] =  $user->createToken('MyApp')-> accessToken;
          $success['name'] =  $user->name;
        }

        return response()->json(['success'=>$success], $this-> successStatus);
    }

    /**
     * Update profile api
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_hp'     => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'alamat' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $user = User::find(Auth::user()->id);
        $user->update($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['data']  = $user;
        return response()->json(['success'=>$success], $this-> successStatus);
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return $user;
        // return response()->json(['success' => $user], $this->successStatus);
    }
}
