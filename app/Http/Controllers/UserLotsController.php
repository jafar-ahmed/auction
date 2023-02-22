<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLotsController extends Controller
{
    public function index()
    { 
        $lots = Auth::user()->lots()->latest()->get();
        return view('pages.my-lots', compact('lots'));     
    }
}
