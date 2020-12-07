<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

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
}
