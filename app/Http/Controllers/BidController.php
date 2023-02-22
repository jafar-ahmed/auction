<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidStoreRequest;
use App\Models\Bid;
use App\Models\Lot;
use Illuminate\Http\Request;

class BidController extends Controller
{
    /**
     * Store a newly created model in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BidStoreRequest $request, Lot $lot)
    {
        $request->validate([
            'price' => 'required',
           
        ]);
        Bid::create($request->validated());
        return redirect()->back();
    }
}
