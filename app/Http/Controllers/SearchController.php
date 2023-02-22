<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        $attr = $this->validate($request, [
            'search' => 'required|string|max:120'
        ]);
        $title = $request->search;
        $lots = Lot::where('name', 'like', '%' . $title . '%')->latest()->paginate(9);
        return view('pages.search', compact('lots', 'title'));
    }
}