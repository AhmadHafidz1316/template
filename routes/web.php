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
Route::get('/', [TransactionsController::class, 'index'])->name('transactions');
Route::get('/invoice/{id}', [TransactionsController::class, 'invoice'])->name('invoice');
Route::get('/view/{id}', [TransactionsController::class,'view'])->name('view');
Route::get('/downloadExcel', [TransactionsController::class, 'downloadExcel'])->name('downloadExcel');
Route::get('/downloadPDF/{id}', [TransactionsController::class, 'downloadPDF'])->name('downloadPDF');

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
        Route::get('/create', [TransactionsController::class, 'create'])->name('createTransaction');
        Route::post('/cart', [TransactionsController::class, 'cart'])->name('cart');
        Route::get('/checkout', [TransactionsController::class, 'checkout'])->name('checkout');
        Route::post('/store', [TransactionsController::class, 'store'])->name('storeTransaction');
        Route::get('/member/{id}', [TransactionsController::class, 'member'])->name('member');
        Route::post('/updateMember', [TransactionsController::class, 'updateMember'])->name('updateMember');

    });
});

});


