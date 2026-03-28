<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Admin Login
    public function showAdminLogin()
    {
        return view('admin.login');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials + ['role' => 'admin'])) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }
        return back()->with('error', 'Invalid admin credentials');
    }

    public function adminLogout()
    {
        Auth::logout();
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }

    // SuperAdmin Login
    public function showSuperAdminLogin()
    {
        return view('superadmin.login');
    }

    public function superAdminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials + ['role' => 'superadmin'])) {
            session(['superadmin_logged_in' => true]);
            return redirect()->route('superadmin.dashboard');
        }
        return back()->with('error', 'Invalid superadmin credentials');
    }

    public function superAdminLogout()
    {
        Auth::logout();
        session()->forget('superadmin_logged_in');
        return redirect()->route('superadmin.login');
    }
}
