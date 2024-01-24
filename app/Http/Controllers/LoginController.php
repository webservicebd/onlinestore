<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
  // admin dasboard
  public function adminDashboard () {
    return view('admin.dashboard');
  }
  // login for overwrite fortify login post
  public function login (Request $request) {

    $validated = $request->validate([
      'email'     => 'required|email',
      'password'  => 'required',
    ]);

    if (auth()->attempt(['email' => $request->email, 'password' => $request->password]))
    {
      if (auth()->user()->user_type == 1) {
        return redirect()->route('admin.dashboard');
      }
      else
      {
        return redirect()->route('dashboard');
      }
    }
    else
    {
      return redirect()->route('login')->with('status', 'Invalid credentials');
    }
  }

}
