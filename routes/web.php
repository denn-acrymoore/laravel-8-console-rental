<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\HomeController;

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

// User's Routing:
// Route::get('/', function () {
//     return view('welcome');
// });

// Admin's Routing:
// - Consoles:
Route::get('/consoles', [ConsolesController::class, 'index'])
    ->name('consoles')
    ->middleware('adminOnly');

Route::get('/consoles/detail/{id}', [ConsolesController::class, 'detailPage'])
    ->middleware('adminOnly');

Route::get('/consoles/add', [ConsolesController::class, 'addPage'])
    ->middleware('adminOnly');

Route::post('/consoles/add/submit', [ConsolesController::class, 'addPageSubmit'])
    ->middleware('adminOnly');

Route::get('/consoles/edit/{id}', [ConsolesController::class, 'editPage'])
    ->middleware('adminOnly');

Route::post('consoles/edit/submit/{id}', [ConsolesController::class, 'editPageSubmit'])
    ->middleware('adminOnly');

Route::post('/consoles/delete/{id}', [ConsolesController::class, 'deleteSubmit'])
    ->middleware('adminOnly');

// - Users:
Route::get('/users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('adminOnly');

Route::get('/users/detail/{id}', [UsersController::class, 'detailPage'])
    ->middleware('adminOnly');

Route::get('/users/add', [UsersController::class, 'addPage'])
    ->middleware('adminOnly');

Route::post('/users/add/submit', [UsersController::class, 'addPageSubmit'])
    ->middleware('adminOnly');

Route::get('/users/edit/{id}', [UsersController::class, 'editPage'])
    ->middleware('adminOnly');

Route::post('/users/edit/submit/{id}', [UsersController::class, 'editPageSubmit'])
    ->middleware('adminOnly');

Route::post('/users/delete/{id}', [UsersController::class, 'deleteSubmit'])
    ->middleware('adminOnly');

// - Orders:
Route::get('/orders', [OrdersController::class, 'index'])
    ->name('orders')
    ->middleware('adminOnly');

Route::get('/orders/detail/{id}', [OrdersController::class, 'detailPage'])
    ->middleware('adminOnly');

Route::post('/orders/delivered/{id}', [OrdersController::class, 'setOrderDelivered'])
    ->middleware('adminOnly');

Route::post('/orders/done/{id}', [OrdersController::class, 'setOrderDone'])
    ->middleware('adminOnly');


// User's Routing:
// - Home Page:
Route::get('/', [HomeController::class, 'index'])
    ->name('home')
    ->middleware('userOnly');


// - Shopping Cart Page:
Route::get('/shopping-cart', [HomeController::class, 'shoppingCartPage'])
    ->name('shoppingCart')
    ->middleware(['userOnly', 'isUserLoggedIn']);

Route::post('/add-shopping-cart', [HomeController::class, 'addShoppingCart'])
    ->middleware(['userOnly', 'isUserLoggedIn']);

Route::get('/delete-shopping-cart/{id}', [HomeController::class, 'deleteShoppingCart'])
    ->middleware(['userOnly', 'isUserLoggedIn']);

Route::post('/submit-shopping-cart', [HomeController::class, 'submitShoppingCart'])
    ->middleware(['userOnly', 'isUserLoggedIn']);

Route::get('/history', [HomeController::class, 'historyPage'])
    ->name('history')
    ->middleware(['userOnly', 'isUserLoggedIn']);

Route::post('/ready-to-pick-up', [HomeController::class, 'setOrderReadyToPickUp'])
    ->middleware(['userOnly', 'isUserLoggedIn']);


// - Login, Register, Logout Page:
Route::get('/login', [HomeController::class, 'loginPage'])
    ->name('loginPage')
    ->middleware('alreadyLoggedIn');

Route::post('/login/submit', [HomeController::class, 'loginSubmit'])
    ->middleware('alreadyLoggedIn');

Route::get('/register', [HomeController::class, 'registerPage'])->name('registerPage')
    ->middleware('alreadyLoggedIn');

Route::post('/register/submit', [HomeController::class, 'registerSubmit'])
    ->middleware('alreadyLoggedIn');

Route::get('/logout', [HomeController::class, 'logout']);
