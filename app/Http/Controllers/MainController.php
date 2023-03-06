<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function logout()
    {
    }
    public function index()
    {
        Session::flush('user');
        return redirect()->route('login-form');
    }
}
