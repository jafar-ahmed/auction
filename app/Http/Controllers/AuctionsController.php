<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuctionsController extends Controller
{
    public function index()
    {
        $auctions = Lot::all();
        return view('dashboard.auctions.index', [
            'title' => 'auctions List',
            'auctions' => $auctions,
        ]);
    }
    public function create()
    {
        return view('dashboard.auctions.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|int|gte:10|lte:5000',
            'step' => 'required|int|gte:10|lte:300',
            'dt_end' => 'required',
            'img' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        $data = $request->except('img');
        if ($request->hasFile('img')) {
            $filename = time() . '.' . request()->img->getClientOriginalExtension();
            request()->img->move(public_path('storage'), $filename);
            $data['img'] = $filename;
        }
        $data['user_id'] =  auth()->id();
        Lot::create($data);
     
        Str::slug($request->name);
        $request->merge([
            'slug' => Str::slug($request->name),
        ]);
        // $lot = Lot::create($request->all());
        return redirect('/dashboard/auctions')->with('success', 'Auction Added!!!');
    }

    public function edit($id)
    {
        $auction = Lot::findOrFail($id);
        return view('dashboard.auctions.edit', [
            'auction' => $auction,
        ]);
    }

    public function update(Request $request, $id)
    {
        $lot = Lot::findOrFail($id);
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|int|gte:10|lte:5000',
            'step' => 'required|int|gte:10|lte:300',
            'dt_end' => 'required',
            'img' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        $data = $request->except('img');
        if ($request->hasFile('img')) {
            $filename = time() . '.' . request()->img->getClientOriginalExtension();
            request()->img->move(public_path('storage'), $filename);
            $data['img'] = $filename;
        }
        $data['user_id'] =  auth()->id();
        $data['active'] =  "1";
        $lot->update($data);
        
        return redirect('/dashboard/auctions')->with('success', 'Auction updated!!!');
    }
    public function destroy($id)
    {
        Lot::destroy($id);
        return redirect('/dashboard/auctions')->with('success', 'Auction Deleted!!!');
    }
}
