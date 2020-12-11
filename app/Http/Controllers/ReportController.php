<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        session()->forget('_old_input');

        $data = $this->report();

        return view('reports.index', $data);
    }

    public function search(Request $request)
    {
        session()->flashInput($request->input());

        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        $data = $this->report($request->start_date, $request->end_date);

        session()->flash('success', "Résultat de votre recherche");

        return view('reports.index', $data);
    }

    private function report($start_date = null, $end_date = null)
    {
        $publications_category = Publication::with(['category', 'creator']);

        if ($start_date && $end_date) {
            $publications_category = $publications_category->whereBetween('created_at', [$start_date, $end_date]);
        } elseif ($start_date) {
            $publications_category = $publications_category->whereDate('created_at', $start_date);
        } elseif ($end_date) {
            $publications_category = $publications_category->whereDate('created_at', $end_date);
        }

        $publications_category = $publications_category->get();

        $category_name = [];
        $publications_count_per_category = [];

        $creator = [];
        $publications_count_per_creator = [];

        foreach ($publications_category as $publication_category) {

            if (!in_array($publication_category->category->namecategory, $category_name)) {
                if ($publication_category->category->categories->count() == 0) {
                    $category_name[] = $publication_category->category->namecategory;
                    $publications_count_per_category[] = $publication_category->category->publications->count();
                }
            }

            if (!in_array($publication_category->creator->username, $creator)) {
                $creator[] = $publication_category->creator->username;
                $publications_count_per_creator[] = $publication_category->creator->publications->count();
            }
        }

        return [
            'category_name' => json_encode($category_name),
            'publications_count_per_category' => json_encode($publications_count_per_category),
            'creator' => json_encode($creator),
            'publications_count_per_creator' => json_encode($publications_count_per_creator),
        ];
    }
}
