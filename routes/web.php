<?php
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login',[AuthController::class,'index'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('loginStore');

Route::middleware(['auth'])->group(function (){
Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');
Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

Route::middleware(['admin'])->group(function (){
    Route::prefix('/products')->group(function () {
        Route::get('/create', [ProductsController::class, 'create'])->name('createProduct');
        Route::post('/store', [ProductsController::class, 'store'])->name('storeProduct');
        Route::get('/edit/{id}', [ProductsController::class, 'edit'] )->name('editProduct');
        Route::patch('/update/{id}', [ProductsController::class, 'update'] )->name('updateProduct');
        Route::delete('/delete/{id}', [ProductsController::class, 'destroy'])->name('deleteProduct');
        Route::patch('/updateStock/{id}', [ProductsController::class, 'updateStock'])->name('updateStock');
    });
    Route::prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::get('/create', [UserController::class, 'create'])->name('createUser');
        Route::post('/store', [UserController::class, 'store'])->name('storeUser');
        Route::get('/edit/{id}', [UserController::class, 'edit'] )->name('editUser');
        Route::patch('/update/{id}', [UserController::class, 'update'] )->name('updateUser');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('deleteUser');
    });
});
Route::middleware(['staff'])->group(function() {
    Route::prefix('/transactions')->group(function () {
        Route::get('/', [TransactionsController::class, 'index'])->name('transactions');
        Route::get('/create', [TransactionsController::class, 'create'])->name('createTransaction');
        Route::post('/store', [TransactionsController::class, 'store'])->name('storeTransaction');
        Route::get('/edit/{id}', [TransactionsController::class, 'edit'] )->name('editTransaction');
        Route::patch('/update/{id}', [TransactionsController::class, 'update'] )->name('updateTransaction');
        Route::delete('/delete/{id}', [TransactionsController::class, 'destroy'])->name('deleteTransaction');
    });
});

});


