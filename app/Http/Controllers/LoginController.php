<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Admin Login
    public function showAdminLogin()
    {
        return view('admin.login');
    }

    public function adminLogin(Request $request)
    {
        if ($request->email === 'admin@mccigh.com' && $request->password === 'admin123') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }
        return back()->with('error', 'Invalid admin credentials');
    }

    public function adminLogout()
    {
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
        if ($request->email === 'superadmin@mccigh.com' && $request->password === 'superadmin123') {
            session(['superadmin_logged_in' => true]);
            return redirect()->route('superadmin.dashboard');
        }
        return back()->with('error', 'Invalid superadmin credentials');
    }

    public function superAdminLogout()
    {
        session()->forget('superadmin_logged_in');
        return redirect()->route('superadmin.login');
    }
}
