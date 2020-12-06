<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::where('actif', 1)->get();
        $roles = Role::all();

        return view('users.index', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'username' => ['required', 'string', 'max:30', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $user = new User();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->actif = '1';

        $user->save();

        session()->flash('success', 'Utilisateur ajouté avec succès !');
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', Rule::unique('users')->ignore($user->id)],
            'username' => ['required', 'string', 'max:30', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->role_id = $request->role_id;

        if (!empty($request->password))
            $user->password = Hash::make($request->password);

        $user->save();

        session()->flash('success', "L'utilisateur '{$user->first_name} {$user->last_name}' modifié avec succès!");
        return response()->json($user);
    }

    /**
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function suspend(User $user)
    {
        $status = "{$user->first_name} {$user->last_name}";

        if ($user->id == auth()->user()->id) {
            abort(404);
        }

        if ($user->banned_at) {
            $user->banned_at = null;
            $status .= " débloqué(e) avec succès!";
        } else {
            $user->banned_at = Carbon::now();
            $status .= " bloqué(e) avec succès!";
        }

        $user->save();

        session()->flash('success', $status);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id == auth()->user()->id) {
            abort(404);
        }

        $user->actif = 0;
        $user->save();

        session()->flash('success', "L'utilisateur '{$user->full_name}' supprimé avec succès!");
        return redirect()->route('users.index');
    }
}
