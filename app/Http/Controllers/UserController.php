<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('role')->get();
        return view('admin.user.index', compact(['users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact(['roles']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('photo');
        $nama_file = time()."_".$file->getClientOriginalName();

        $file->move('uploads/user', $nama_file);
        $photo = 'uploads/user/' . $nama_file;

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'role_id'   => $request->role,
            'photo'     => $photo
        ]);

        return redirect()->route('userIndex');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return view('admin.user.edit', compact(['user', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->file('photo')) {
            $file = $request->file('photo');
            $nama_file = time()."_".$file->getClientOriginalName();

            $file->move('uploads/user', $nama_file);
            $photo = 'uploads/user/' . $nama_file;
        } else {
            $photo = $user->photo;
        }

        $user->update([
            'name'      => $request->name,
            'role_id'   => $request->role,
            'photo'     => $photo
        ]);

        $user->save();

        return redirect()->route('userIndex');
    }

    public function editPassword($id) 
    {
        return view('admin.user.password', compact(['id']));
    }

    public function updatePassword(Request $request, $id) 
    {
        $user = User::find($id);

        // $oldPassword = bcrypt($request->oldPassword);

        if (!Hash::check($request->oldPassword, $user->password)) {
            return redirect()->back()->withErrors(['msg' => 'Password Lama Salah']);
        }

        $user->update([
            'password'  => bcrypt($request->newPassword)
        ]);

        return redirect()->route('userIndex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('userIndex');
    }
}
