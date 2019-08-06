<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('users')->get(); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return 'store';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'edit';
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

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        tap($user)->update($request->only('name', 'email'));
        return DB::table('users')->get();

        

        $check = Auth::validate([
            'email'    => Auth::user()->email,//$this->user->email,
            'password' => $request->current_password
        ]); 

        $file = $request->file('avatar');
        $put = User::find($id);
        if ($request->name) {
            $put->name = $request->name;
        }
        if ($request->email) {
            $put->email = $request->email;
        }
        //========Change Password=================
        if ($request->password) {
            if (!$check) {
                return back()->with('status', 'Current Password Do Not Match Our Record');
            }
            if ($request->password != $request->password_confirmation) {
                return back()->with('status', 'Password Confirmation Do Not Match');
            }   $put->password = bcrypt($request->password);
        }
        if ($request->password_change) {
            $put->password = bcrypt($request->password_change);
            // $put->password = Hash::make($request->password);
        }
        if ($request->hasFile('avatar')) {
          //$FileName = $file->getClientOriginalName();
          $path = $file->storeAs('images/profile', $id.'jpg');
          $file->move('images/profile', $id.'jpg');
          $put->avatar = $path;
        } $put->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
    }
}
