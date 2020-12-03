<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('actif', 1)->get();

        return view('users.index', ['users' => $users]);
    }
}
