<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return redirect()->route('login.show');
});

Route::middleware("guest")->group(function () {
    
    Route::get("/register",[AuthController::class,"showRegisterationForm"])->name("register.show");
    Route::post("/register",[AuthController::class,"register"])->name("register.store");
    Route::get("/login",[AuthController::class,"showLoginForm"])->name("login.show");   
    Route::post("/login",[AuthController::class,"login"])->name("login.store");
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get("/dashboard",[HomeController::class,"index"])->name("dashboard");

    // Products
    Route::get("/products",[ProductController::class,"index"])->name("products.index"); 
    Route::get("/products/create",[ProductController::class,"create"])->name("products.create"); 
    Route::post("/products",[ProductController::class,"store"])->name("products.store");
    Route::get("/products/{product}/edit",[ProductController::class,"edit"])->name("products.edit");
    Route::put("/products/{product}",[ProductController::class,"update"])->name("products.update");
    Route::delete("/products/{product}",[ProductController::class,"destroy"])->name("products.destroy");
    Route::get("/products/search",[ProductController::class,"search"])->name("products.search");

    // Categories
    Route::get("/categories",[CategoryController::class,"index"])->name("categories.index");
    Route::get("/categories/create",[CategoryController::class,"create"])->name("categories.create");
    Route::post("/categories",[CategoryController::class,"store"])->name("categories.store");
    Route::get("/categories/{category}/edit",[CategoryController::class,"edit"])->name("categories.edit");
    Route::put("/categories/{category}",[CategoryController::class,"update"])->name("categories.update");
    Route::delete("/categories/{category}",[CategoryController::class,"destroy"])->name("categories.destroy");

    // Orders
    Route::resource('orders', OrderController::class);

    // Customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
});
