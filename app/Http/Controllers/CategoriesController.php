<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
             ->join('users', 'users.id','categories.created_by')
             ->select(DB::raw('categories.id,categories.namecategory,categories.created_at,users.username'))
             ->get();

        return view('categories/index', ['categories' => $categories]);
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
        $validator = Validator::make($request->all(), [
            'namecategory' => ['required', 'string', 'min:2', 'unique:categories'],
        ]);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $categories = new Categorie();
        $categories->namecategory = $request->namecategory;
        $categories->actif = '1';
        $categories->save();
        //  }
        session()->flash('success', 'la categorie ajoutée avec success');
        return response()->json($categories);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(categorie $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(categorie $categories)
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
    public function update(Request $request, Categorie $category)
    {
        //
        // Validation

        //   
        $validator = Validator::make($request->all(), [
            'namecategory' => [
                'required',
                'string',
                'min:2',
                Rule::unique('categories')->ignore($category->id)
            ]

        ]);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $category->namecategory = $request->namecategory;
        $category->actif = '1';
        $category->save();

        session()->flash('success', 'la categorie modifiée avec success');
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categories)
    {
        //
    }
}
