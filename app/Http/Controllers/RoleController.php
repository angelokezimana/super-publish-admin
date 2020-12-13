<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:Voir Roles|Creer Roles|Modifier Roles|Supprimer Roles', ['only' => ['index']]);
        $this->middleware('permission:Creer Roles', ['only' => ['store']]);
        $this->middleware('permission:Modifier Roles', ['only' => ['update']]);
        $this->middleware('permission:Supprimer Roles', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::where('actif', 1)->get();
        $permissions = Permission::all();

        return view('roles.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
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
            'name' => ['required', 'unique:roles'],
            'permissions' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $role = new Role();

        $role->name = $request->name;
        $role->save();

        $role->permissions()->sync($request->permissions);

        session()->flash('success', "Le rôle '{$role->name}' ajouté avec succès!");
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('roles')->ignore($role->id)
            ],
            'permissions' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $role->name = $request->name;
        $role->updated_at = now();

        $role->save();

        $role->permissions()->sync($request->permissions);

        session()->flash('success', "Le rôle '{$role->name}' modifié avec succès!");
        return response()->json($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->actif = 0;
        $role->save();

        session()->flash('success', "Le rôle '{$role->name}' supprimé avec succès!");
        return redirect()->route('roles.index');
    }
}
