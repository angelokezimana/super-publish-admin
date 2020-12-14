<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:Voir Pages|Creer Pages|Modifier Pages|Bloquer Pages|Supprimer Pages', ['only' => ['index', 'show']]);
        $this->middleware('permission:Creer Pages', ['only' => ['create', 'store']]);
        $this->middleware('permission:Modifier Pages', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Supprimer Pages', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::where('actif', 1)->get();

        return view('pages.index', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required', 'string'],
            'title' => ['required', 'string'],
        ]);

        $page = new Page();

        $page->title = $request->title;
        $page->content = $request->content;
        $page->slug = $this->createSlug($request->title);
        $page->created_by = Auth::id();

        $page->save();

        session()->flash('success', "La page '{$page->title}' ajoutée avec succès!");
        return redirect()->route("pages.index");
    }

    public function show(Page $page)
    {
        return view('pages.show', ['page' => $page]);
    }

    public function edit(Page $page)
    {
        return view('pages.edit', ['page' => $page]);
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'content' => ['required', 'string'],
            'title' => ['required', 'string'],
        ]);

        $page->title = $request->title;
        $page->content = $request->content;
        $page->slug = $this->createSlug($request->title, $page->id);
        $page->updated_by = Auth::id();

        $page->save();

        session()->flash('success', "La page '{$page->title}' modifiée avec succès!");
        return redirect()->route('pages.show', $page);
    }

    public function destroy(Page $page)
    {
        $page->actif = 0;
        $page->save();

        session()->flash('success', "La page '{$page->title}' supprimée avec succès!");
        return redirect()->route('pages.index');
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
        return Page::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
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
}
