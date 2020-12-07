<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use App\Models\Categorie;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return redirect('users_suppr');
    }

    public function index_categories()
    {
        //      
        $categories = DB::table('categories')
             ->join('users', 'users.id','categories.created_by')
             ->select(DB::raw('categories.id,categories.namecategory,categories.created_at,users.username'))
             ->where('categories.actif','=',0)
             ->get();

        return view('recyclebin/index_categories', ['categories' => $categories]);
    }

    public function restore_categories(Categorie $categorie)
    {
        //   
        
       $categories = Categorie::find($categorie->id);  
       $categories->updated_by = Auth::user()->id;
       $categories->actif = 1;
       $categories->save();

         session()->flash('success', "la categorie '{$categories->namecategory}' restaurée  savec success");
         return redirect('categories_suppr');
        

    }


   
}
