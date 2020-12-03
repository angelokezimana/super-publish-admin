<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        //

        $categories = DB::table('categories')
        ->join('users', 'users.id','categories.user_create')               
        ->get();

      return view('categories/index', ['categories' => $categories ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         
           
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'membre' => ['required' ,'string', 'min:2'] ,
            'montant' => ['required', 'numeric', 'min:1'],
            'date_paiement' =>  ['required',  'max:' .date('d-m-Y')],
            'categorie' => ['required' ,'string', 'min:2'],
            'cooperative' => 'required',
            'etat' => ['required' ,'string', 'min:2'],
            // 'sortie' => ['min:date_adesion','max:'.date('d-m-Y')] 

            
        ]);

        // $cooperative = DB::table('cooperatives')->where('mail',$request->mail);  
        // if($cooperative == null)
        // {
               
        $categories = new Categorie();
         $categories->namecategory = $request->name;
         $categories->actif = '1';
        //  $categories->user_create = null ;
        //  $categories->user_update = ;      
         $categories->save();
        //  }
    
         return redirect('categories')->withFlashMessage('categories ajoute avec success.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, categories $categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(categories $categories)
    {
        //
    }
}
