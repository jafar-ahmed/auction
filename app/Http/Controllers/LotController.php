<?php

namespace App\Http\Controllers;

use App\Http\Requests\LotStoreRequest;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LotController extends Controller
{
    public function index()
    {
        $lots = Lot::all();
        $lots = Lot::activeLots()->latest()->paginate(10);
        return view('lot.list', compact('lots'));
    }

    /**
     * Show the form for creating a new model.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lot.add');
    }

    /**
     * Store a newly created model in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|gte:10|lte:5000',
            'step' => 'required|gte:10|lte:300',
            'dt_end' => 'required',
            'img' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        $data = $request->except('img');
        if ($request->hasFile('img')) {
            $filename = time() . '.' . request()->img->getClientOriginalExtension();
            request()->img->move(public_path('storage'), $filename);
            $data['img'] = $filename;
        }
        $data['user_id'] =auth()->id();


         Lot::create($data);
        // $request->validate([
        //     'name' => 'required|max:255',
        //     'description' => 'required|max:255',
        //     'price' => 'required',
        //     'step' => 'required',
        //     'dt_end' => 'required',
        //     'img' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
        // ]);
    //     Lot::create([
    //         'name' => request('name'),
    //         'description' => request('description'),
    //         'price' => request('price'),
    //         'step' => request('step'),
    //         // 'img' => request('img'),
    //         'category_id' => request('category_id'),
    //         'dt_end' => request('dt_end'),
    //         'user_id' => auth()->id()
    //     ]
    
    // );

        // $data = $request->except('img');
        // if ($request->hasFile('img')) {
        //     $filename = time() . '.' . request()->img->getClientOriginalExtension();
        //     request()->img->move(public_path('storage'), $filename);
        //     $data['img'] = $filename;
        // }
        // Lot::create($data);

        return redirect('/');
    }

    /**
     * Display the specified model.
     *
     * @param  \App\Models\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function show(Lot $lot)
    {
        $bids = $lot->bids()->latest()->get()->unique('user_id');
        return view('lot.view', compact('lot', 'bids'));
    }

    /**
     * Show the form for editing the specified model.
     *
     * @param  \App\Models\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function edit(Lot $lot)
    {
        return view('lot.edit', compact('lot'));
    }

    /**
     * Update the specified model in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function update(LotStoreRequest $request, Lot $lot)
    {
        $request->validate([
            'name' => 'required|max:255',
            // 'slug' => 'required',
            'description' => 'required',
            'price' => 'required|min:10|max:5000',
            'step' => 'required|min:10|max:300',
            'dt_end' => 'required',
            'img' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        $data = $request->except('img');
        if ($request->hasFile('img')) {
            $filename = time() . '.' . request()->img->getClientOriginalExtension();
            request()->img->move(public_path('storage'), $filename);
            $data['img'] = $filename;
        }
        $lot->update($data);
        return redirect('/dashboard/slider');
        //return $lot->update($request->validated());
    }

    /**
     * Remove the specified model from storage.
     *
     * @param  \App\Models\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lot $lot)
    {
        return $lot->delete();
    }
}
