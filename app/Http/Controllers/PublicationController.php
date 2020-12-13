<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Categorie;
use App\Models\Publication;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class PublicationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:Voir Publications|Creer Publications|Modifier Publications|Bloquer Publications|Supprimer Publications', ['only' => ['index', 'show']]);
        $this->middleware('permission:Creer Publications', ['only' => ['create', 'store']]);
        $this->middleware('permission:Modifier Publications', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Supprimer Publications', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publications_without_paginate = Publication::with('category')->where('actif', 1);
        $publications = Publication::with('category')->where('actif', 1)->paginate(9);

        return view('publications.index', [
            'publications_without_paginate' => $publications_without_paginate,
            'publications' => $publications
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::whereNull('category_id')->get();
        return view('publications.create', ['categories' => $categories]);
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
            'content' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'photo' => 'required|mimes:jpeg,png,jpg,JPG,PNG,JPEG|max:10240',
            'multiple_files.*' => 'nullable|mimes:pdf,PDF,xlsx,xls,doc,docx,jpeg,png,jpg,JPG,PNG,JPEG'
        ]);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $photo = 'publish-image-' . time() . '.' . $request->photo->extension();

        $image = Image::make($request->photo->path());

        $image->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('storage/images') . '/' . $photo);

        $publication = new Publication();

        $publication->title = $request->title;
        $publication->content = $request->content;
        $publication->slug = $this->createSlug($request->title);
        $publication->category_id = $request->category_id;
        $publication->actif = '1';
        $publication->created_by = Auth::id();
        $publication->photo = $photo;

        $publication->save();

        if ($request->hasfile('multiple_files')) {
            foreach ($request->file('multiple_files') as $file) {
                $new_file = new File();

                $name = rand() . '.' . $file->extension();
                $file->move(public_path() . '/storage/files/', $name);

                $new_file->file_name = $name;
                $new_file->publication_id = $publication->id;

                $new_file->save();
            }
        }
        session()->flash('success', "La publication '{$publication->title}' ajoutée avec succès!");
        return response()->json($publication);
    }

    public function show(Publication $publication)
    {
        return view('publications.show', ['publication' => $publication]);
    }

    public function edit(Publication $publication)
    {
        $categories = Categorie::whereNull('category_id')->get();

        return view('publications.edit', [
            'publication' => $publication,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Publication $publication)
    {
        $request->validate([
            'content' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'photo' => 'nullable|mimes:jpeg,png|max:10240',
        ]);

        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {

                $photo = 'publish-image-' . time() . '.' . $request->photo->extension();

                $image = Image::make($request->photo->path());

                $image->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('storage/images') . '/' . $photo);

                $publication->photo = $photo;
            }
        }

        $publication->title = $request->title;
        $publication->content = $request->content;
        $publication->slug = $this->createSlug($request->title, $publication->id);
        $publication->category_id = $request->category_id;
        $publication->updated_by = Auth::id();

        $publication->save();

        session()->flash('success', "La publication '{$publication->title}' modifiée avec succès!");
        return redirect()->route('publications.show', $publication);
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('storage/images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/images/' . $fileName);
            $msg = 'Image uploadée avec succès';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function destroy(Publication $publication)
    {
        $publication->actif = 0;
        $publication->save();

        session()->flash('success', "La publication '{$publication->title}' supprimée avec succès!");
        return redirect()->route('publications.index');
    }

    public function checkPublicationValidation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'photo' => 'required|mimes:jpeg,png,jpg,JPG,PNG,JPEG|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        return response()->json(array('success' => 'success'));
    }

    private function createSlug($title, $id = 0)
    {
        $slug = Str::slug($title);

        $allSlugs = $this->getRelatedSlugs($slug, $id);

        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        for ($i = 1;; $i++) {

            $newSlug = $slug . '-' . $i;

            if (!$allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
    }

    private function getRelatedSlugs($slug, $id)
    {
        return Publication::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }
}
