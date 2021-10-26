<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{

    public function index()
    {
        $title = 'NewsWatch Admin Dashboard';
        return view('admin.dashboard.index',compact('title'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit(){
        $user = Auth::user();
        return view('admin.settings.edit', ['title' => 'Edit Admin Profile','user'=>$user]);
    }


    public function update(Request $request)
    {
        $admin = Auth::user();
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,'.$admin->id,
        ]);
        $input = $request->all();
        if (empty($input['password'])) {
            $input['password'] = $admin->password;
        } else {
            $input['password'] = bcrypt($input['password']);
        }
        $admin->fill($input)->save();
        Session::flash('success_message', 'Great! admin successfully updated!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
