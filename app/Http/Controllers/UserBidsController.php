<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBidsController extends Controller
{
    public function index()
    {
        $bids = Auth::user()->bids()->latest()->get()->unique('lot_id');
        return view('pages.my-bids', compact('bids'));
    }
}
