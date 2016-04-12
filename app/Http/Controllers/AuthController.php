<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Issue;

class AuthController extends Controller
{
    public function getLogin()
    {
    	return view('auth.login');
    }

    public function fds()
    {
    	$issues = Issue::all();

    	return view('fds', compact('issues'));
    }
}
