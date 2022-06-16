<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __invoke()
    {
        return view('home');
    }

    public function index()
    {
        return 'Hola Admin';
        /* return view('employees.index'); */
    }
}
