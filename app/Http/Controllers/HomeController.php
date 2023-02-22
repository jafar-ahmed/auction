<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // /**
    //  * Show the application dashboard.
    //  *
    //  * @return \Illuminate\Contracts\Support\Renderable
    //  */
    public function index()
    {        
         
        // $lots = Lot::all();
        // return view('index', [
        //     'title' => 'Admins List',
        //     'lots' => $lots,
        // ]); 
        
        $lots = Lot::activeLots()->latest()->paginate(9);
         return view('index',compact('lots'));
    }
}
