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
        Session::flush('u_id');
        return redirect()->route('login');
    }
}
