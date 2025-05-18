<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->back();
        }
        return view('login');
    }
    public function process(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'email not found'])->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'password not correct'])->withInput();
        }

        Auth::login($user);

        return redirect()->route('dashboard')->with('status', 'Login successful');
    }

    public function updatePasword()
    {
        return view('auth.passwords.edit');
    }
    public function processUpdatePasword(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'old_password' => 'required',
                'new_password' => 'required|min:5',
                'new_password_confirmation' => 'required|same:new_password'
            ]);
            if ($validate->passes()) {
                if (Hash::check($request->old_password, Auth::user()->password)) {
                    User::where('id', Auth::user()->id)->update([
                        'password'  => Hash::make($request->new_password)
                    ]);
                }
                return redirect()->back()->with('status', 'Passsword changed successfully');
            } else {
                return redirect()->back()->withErrors($validate);
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to change password. ' . $e->getMessage());
        }
    }
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route("login");
        }
    }
}
