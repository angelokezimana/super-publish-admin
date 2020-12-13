<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:Voir Categories|Creer Categories|Modifier Categories|Bloquer Categories|Supprimer Categories', ['only' => ['index']]);
        $this->middleware('permission:Creer Categories', ['only' => ['store']]);
        $this->middleware('permission:Modifier Categories', ['only' => ['update']]);
        $this->middleware('permission:Supprimer Categories', ['only' => ['destroy']]);
    }

    public function index()
    {
        $categories = Categorie::where('categories.actif', '=', 1)
            ->where('category_id', null)
            ->get();

        return view('categories/index', ['categories' => $categories]);
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
            'namecategory' => ['required', 'string', 'min:2', 'unique:categories'],

        ]);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $category = new Categorie();
        $category->namecategory = $request->namecategory;
        $category->slug = Str::slug($request->namecategory);
        $category->created_by = Auth::user()->id;
        $category->actif = '1';
        $category->category_id = $request->category_id;
        $category->save();

        session()->flash('success', "La categorie '{$category->namecategory}'  ajoutée avec success");
        return response()->json($category);
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
        $validator = Validator::make($request->all(), [
            'namecategory' => [
                'required',
                'string',
                'min:2',
                Rule::unique('categories')->ignore($category->id),
            ]
        ]);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $category->namecategory = $request->namecategory;
        $category->slug = Str::slug($request->namecategory);
        $category->updated_by = Auth::user()->id;
        $category->category_id = $request->category_id;
        $category->save();

        session()->flash('success', "La categorie '{$category->namecategory}' modifiée avec success");
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie)
    {
        $categories = Categorie::find($categorie->id);
        $categories->updated_by = Auth::user()->id;
        $categories->actif = 0;
        $categories->save();

        session()->flash('success', "La categorie '{$categories->namecategory}' supprimée avec success");
        return redirect('categories');
    }
}
