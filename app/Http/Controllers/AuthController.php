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
        try {
            $validate = Validator::make($request->all(), [
                'email' => ['required', 'email'],
                'password' => ['required']
            ]);

            if ($validate->fails()) {
                return response()->json(['errors' => $validate->errors()], 422);
            }

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect('https://sim-academy.vercel.app/home');  // Login success
            } else {
                return response()->json(
                    ['errors' => $validate->errors()]
                );
            }
        } catch (\Exception $e) {
            // Return the actual error message for debugging
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
