<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Bid;
use App\Models\Category;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    { 
        $users = User::count();
        $lots = Lot::count();
        $bids = Bid::count();
        $category = Category::count();
        return view('dashboard', compact('users','lots','bids', 'category' ));
    }
}
