<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class test extends Controller
{
    public function index()
    {
        
        return view('Account.index');
    }

}
