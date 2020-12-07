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
    public function index_users()
    {
        $users = User::where('actif', 0)->get();
        $roles = Role::all();

        return view('recyclebin/index_users', [
            'users' => $users,
            'roles' => $roles
        ]);
    }
    public function  restore_users(User $user)
    {
        if ($user->id == auth()->user()->id) {
            abort(404);
        }

        $user->actif = 1;
        $user->save();

        session()->flash('success', "L'utilisateur '{$user->full_name}' restauré avec succès!");
        return redirect('recyclebin/index_users');
    }

   
}
