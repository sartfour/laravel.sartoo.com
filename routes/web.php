<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItemTypesController;
use App\Http\Controllers\ItemsController;

use App\Http\Controllers\ListsController;

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

Route::get('/', function () {
    $recentLists = App\Models\CustList::limit(10)->get();
    $recentItems = App\Models\Item::limit(10)->get();
    return view('home', compact('recentLists', 'recentItems'));
})->name('home');


Route::resources([
    'item-types' => ItemTypesController::class,
    'items' => ItemsController::class,
]);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
