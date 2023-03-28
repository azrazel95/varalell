<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Models\Products;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $products = Products::all();
    return view('welcome',['products' => $products]);
});
Route::get('/cart', function () {
    return view('cart');
});

Route::get('/cart/add/{id}', [ProductsController::class, 'addToCart']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// public function addCart($id){
//     $product = Products::find(id);
//     $cart = session() ->get('car', []);
//     if(isset($cart[$id])){
//         $cart[$id]['quanitity']++;}
//         else{
//             $cart[$id]=[
//                 products
//             ]
//         }
//     }
// }