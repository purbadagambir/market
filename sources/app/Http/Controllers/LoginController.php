<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use App\Models\Store as StoreModel;
use Toastr;
use Hash;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'     => ['required', 'email'],
            'password'  => ['required']
        ]);

        $user = UserModel::whereEmail($request->email)->first();

        if($user)
        {
            if(md5($request->password) == $user->password)
            {
                Auth::login($user);

                return Redirect('select_store');
            }
            else
            {
                Toastr::error('Login gagal!');
                return \Redirect::back();
            }
        }
        else
        {
            Toastr::error('Login gagal!');
            return \Redirect::back();
        }
    }

    public function select_store()
    {
        $data['store'] = StoreModel::all();
        return view('auth.selectstore', compact('data'));
    }

    public function set_store(Request $request)
    {
        $store = StoreModel::where('store_id', $request->store_id)->first();
        session(['store' => $store], time() + 2629700);
        Toastr::success('Login berhasil!');
        return Redirect('dashboard');
    }

    public function change_password()
    {
        $data = [
            'page'  => 'Change Password',
        ];
        return view('user.change_password', compact('data'));
    }

    public function update_password(Request $request)
    {
        $user = UserModel::where('id', Auth::user()->id)->first();

        if($user)
        {
            if(Hash::check($request->password, $user->password))
            {
                $data_update = [
                    'password' => Hash::make($request->password_update),
                ];
                
                $update = UserModel::where('id', Auth::user()->id)->update($data_update);

                Toastr::success('Password berhasil di update!');
                return Redirect('dashboard');
            }
            else
            {
                Toastr::error('Password tidak sesuai!');
                return \Redirect::back();
            }
        }
        else
        {
            Toastr::error('Password gagal update!');
            return \Redirect::back();
        }
    }

    public function logout()
    {
        session()->flush();
        Auth::logout();
        return Redirect('login');
    }
}
