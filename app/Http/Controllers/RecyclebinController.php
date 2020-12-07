<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;


class RecyclebinController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

   
}
