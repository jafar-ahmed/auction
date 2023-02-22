<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AuctionsController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LotController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserBidsController;
use App\Http\Controllers\UserLotsController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'middleware' => ['locale'],
    // 'middleware' => [Localization::class],
    //'middleware' => 'web',
], function () {

    Route::get('/', [HomeController::class, 'index']);
    Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth', 'isAdmin');
    /**
     * Auth section
     */
    Route::get('/login', function () {
        return view('auth.login');
    });

    Route::get('/register', function () {
        return view('auth.register');
    });

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    });
    /**
     * Category section
     */
    Route::get('/categories', [CategoriesController::class, 'index']);
    Route::get('/categories/{category}', [CategoriesController::class, 'show']);

    /**
     * Lot section
     */
    Route::group(['middleware' => ['auth']], function () {
        Route::post('/search', [SearchController::class, 'show']);
        //categories 
        Route::get('/categories', [CategoriesController::class, 'index']);
        Route::get('/categories/{category}', [CategoriesController::class, 'show']);
        //....
        Route::get('/lots', [LotController::class, 'index']);
        Route::get('/add-lot', [LotController::class, 'create']);
        Route::post('/add-lot', [LotController::class, 'store']);
        Route::get('/{lot}/edit', [LotController::class, 'edit'])->middleware('can:edit,lot');
        Route::patch('/{lot}', [LotController::class, 'update'])->middleware('can:update,lot');
        Route::delete('/{lot}', [LotController::class, 'destroy'])->middleware('can:destroy,lot');
        Route::post('/{lot}/bids', [BidController::class, 'store']);
        //.....
        Route::get('/my-bids', [UserBidsController::class, 'index']);
        //....
        Route::get('/my-lots', [UserLotsController::class, 'index']);
        //
        /**
         * Custom lot route
         */
        Route::get('/{lot}', [LotController::class, 'show']);
    });

    /**
     * User's lots 
     */
    Route::get('/about-us', function () {
        return view('pages.about-us');
    });


    //Dashboard
    Route::group(['middleware' => ['auth','isAdmin']], function () {
       
        //users
        Route::get('/dashboard/users', [UsersController::class, 'index']);
        Route::get('/dashboard/users/create', [UsersController::class, 'create']);
        Route::post('/dashboard/users', [UsersController::class, 'store']);
        Route::get('/dashboard/users/{id}/edit', [UsersController::class, 'edit']);
        Route::put('/dashboard/users/{id}', [UsersController::class, 'update']);
        Route::delete('/dashboard/users/{id}', [UsersController::class, 'destroy']);

        //catecory
        Route::get('/dashboard/categories', [CategoryController::class, 'index']);
        Route::get('/dashboard/categories/create', [CategoryController::class, 'create']);
        Route::post('/dashboard/categories', [CategoryController::class, 'store']);
        Route::get('/dashboard/categories/{id}/edit', [CategoryController::class, 'edit']);
        Route::put('/dashboard/categories/{id}', [CategoryController::class, 'update']);
        Route::delete('/dashboard/categories/{id}', [CategoryController::class, 'destroy']);

        //Auctions
        Route::get('/dashboard/auctions', [AuctionsController::class, 'index']);
        Route::get('/dashboard/auctions/create', [AuctionsController::class, 'create']);
        Route::post('/dashboard/auctions', [AuctionsController::class, 'store']);
        Route::get('/dashboard/auctions/{id}/edit', [AuctionsController::class, 'edit']);
        Route::put('/dashboard/auctions/{id}', [AuctionsController::class, 'update']);
        Route::delete('/dashboard/auctions/{id}', [AuctionsController::class, 'destroy']);

        //admins
        Route::get('/dashboard/admins', [AdminsController::class, 'index']);
        Route::get('/dashboard/admins/create', [AdminsController::class, 'create']);
        Route::post('/dashboard/admins', [AdminsController::class, 'store']);
        Route::get('/dashboard/admins/{id}/edit', [AdminsController::class, 'edit']);
        Route::put('/dashboard/admins/{id}', [AdminsController::class, 'update']);
        Route::delete('/dashboard/admins/{id}', [AdminsController::class, 'destroy']);
    });

    Auth::routes();
});
