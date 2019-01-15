<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('role:admin')->only('index');
    }

    public function index()
    {
        return view('backend.user.index');
    }

    public function getData()
    {
        $users = User::query();

        return Datatables::of($users)
            ->editColumn('name', function ($user) {
                return '<a href="'.route('user.edit', $user->name).'">'.$user->name.'</a>';
            })
            ->editColumn('created_at', function ($user) {
                return [
                    'display'   => '<span title="'.$user->created_at->toDayDateTimeString().'" data-toggle="tooltip" style="cursor: default;">'.$user->created_at->diffForHumans().'</span>',
                    'timestamp' => $user->created_at->timestamp,
                ];
            })
            ->editColumn('updated_at', function ($user) {
                return [
                    'display'   => '<span title="'.$user->updated_at->toDayDateTimeString().'" data-toggle="tooltip" style="cursor: default;">'.$user->updated_at->diffForHumans().'</span>',
                    'timestamp' => $user->updated_at->timestamp,
                ];
            })
            ->addColumn('action', function ($user) {
                return
                '<div class="btn-group" role="group" aria-label="Basic example">
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <a role="button" class="btn" href="'.route('admin.history-pemakaian').'" title="'.__('History Pemakaian').'" data-toggle="tooltip"><i class="fas fa-list"></i></a>
                      <a role="button" class="btn" href="'.route('user.edit', $user->name).'" title="'.__('Details').'" data-toggle="tooltip"><i class="fas fa-user-edit"></i></a>
                      <a role="button" class="btn" href="'.route('user.change-password', $user->name).'" title="'.__('Change Password').'" data-toggle="tooltip"><i class="fas fa-key"></i></a>
                    </div>
                 </div>';
            })
            ->rawColumns(['name', 'created_at.display', 'updated_at.display', 'action'])
            ->toJson();
    }

    /**
     * @param \App\User $user
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('view', $user);

        $qrCode = qrCodeGenerator($user->email);

        return view('backend.user.profile', compact('user'), [
            'qrCodeData'   => $qrCode->getContentType(),
            'qrCodeBase64' => $qrCode->generate(),
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\User                $user
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $user->email = $request->input('email');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->id_pelanggan = $request->input('id_pelanggan');
        $user->alamat = $request->input('alamat');
        $user->no_hp = $request->input('no_hp');


        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255',
        ]);

        $user->save();

        return redirect()->back()
                         ->withFlashSuccess(__('Profile updated.'));
    }
}