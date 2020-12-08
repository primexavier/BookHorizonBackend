<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\UsersController;

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
    return view('welcome');
});

Route::group(['middleware' => 'AuthAdmin'], function () {
    Route::get('/dashboard', function (){
        return view('home');
    })->name('dashboard');
    Route::group(['prefix' => 'books'], function () {
        Route::get('/', [BackendController::class, 'index'])->name('book.index');
        Route::get('/create', [BackendController::class, 'create'])->name('book.create');
        Route::post('/create', [BackendController::class, 'store'])->name('book.store');
        Route::get('/update/{book}', [BackendController::class, 'edit'])->name('book.edit');
        Route::post('/update/{book}', [BackendController::class, 'update'])->name('book.update');
        Route::get('/detail/{book}', [BackendController::class, 'detail'])->name('book.detail');
        Route::post('/delete/{book}', [BackendController::class, 'delete'])->name('book.delete');
        Route::post('/import', [BackendController::class, 'import'])->name('book.import');
        Route::get('/import', [BackendController::class, 'import'])->name('book.import');
        Route::get('/import-add', [BackendController::class, 'add'])->name('book.import.add');
        Route::post('/import-store', [BackendController::class, 'store'])->name('book.import.store');
    });
    Route::group(['prefix' => 'blogs'], function () {
        Route::get('/', 'BlogController@index')->name('blog.index');
        Route::get('/create', 'BlogController@create')->name('blog.create');
        Route::post('/create', 'BlogController@store')->name('blog.store');
        Route::get('/update/{blog}', 'BlogController@edit')->name('blog.edit');
        Route::post('/update/{blog}', 'BlogController@update')->name('blog.update');
        Route::get('/detail/{blog}', 'BlogController@show')->name('blog.detail');
        Route::post('/delete/{blog}', 'BlogController@delete')->name('blog.delete');
    });
    Route::group(['prefix' => 'members'], function () {
        Route::get('/', 'MemberController@index')->name('member.index');
        Route::get('/create', 'MemberController@create')->name('member.create');
        Route::post('/create', 'MemberController@store')->name('member.store');
        Route::get('/update/{user}', 'MemberController@edit')->name('member.edit');
        Route::post('/update/{user}', 'MemberController@update')->name('member.update');
        Route::get('/detail/{user}', 'MemberController@show')->name('member.detail');
        Route::post('/delete/{user}', 'MemberController@delete')->name('member.delete');
    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UsersController::class, 'index'])->name('users.index');
        Route::get('/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('/create', [UsersController::class, 'store'])->name('users.store');
        Route::get('/update/{user}', [UsersController::class, 'edit'])->name('users.edit');
        Route::post('/update/{user}', [UsersController::class, 'update'])->name('users.update');
        Route::get('/detail/{user}', [UsersController::class, 'detail'])->name('users.detail');
        Route::post('/delete/{user}', [UsersController::class, 'delete'])->name('users.delete');
    });
    Route::group(['prefix' => 'transactions'], function () {
        Route::get('/', 'TransactionController@index')->name('transactions.index');
            Route::get('/create', 'TransactionController@create')->name('transactions.create');
            Route::post('/create', 'TransactionController@store')->name('transactions.store');
            Route::get('/update/{transaction}', 'TransactionController@edit')->name('transactions.edit');
            Route::get('/detail/{transaction}', 'TransactionController@show')->name('transactions.detail');
            Route::post('/update/{transaction}', 'TransactionController@update')->name('transactions.update');
            Route::post('/delete/{transaction}', 'TransactionController@destroy')->name('transactions.delete');
            Route::get('/approve-receipt/{transaction}', 'TransactionController@approveReceipt')->name('transactions.approve-receipt');
            Route::get('/decline-receipt/{transaction}', 'TransactionController@declineReceipt')->name('transactions.decline-receipt');
            Route::get('/cancel/{transaction}', 'TransactionController@cancel')->name('transactions.cancel');
            Route::post('/add-shipping/{transaction}', 'TransactionController@addShipping')->name('transactions.add-shipping');
            Route::get('/finish/{transaction}', 'TransactionController@finishTransaction')->name('transactions.finish');
        });
        Route::group(['prefix' => 'genre'], function () {
            Route::get('/', 'GenreController@index')->name('genre.index');
            Route::get('/create', 'GenreController@create')->name('genre.create');
            Route::post('/create', 'GenreController@store')->name('genre.store');
            Route::get('/update/{genre}', 'GenreController@edit')->name('genre.edit');
            Route::post('/update/{genre}', 'GenreController@update')->name('genre.update');
            Route::get('/detail/{genre}', 'GenreController@show')->name('genre.detail');
            Route::post('/delete/{genre}', 'GenreController@destroy')->name('genre.delete');
        });
        Route::group(['prefix' => 'author'], function () {
            Route::get('/', 'AuthorController@index')->name('author.index');
            Route::get('/create', 'AuthorController@create')->name('author.create');
            Route::post('/create', 'AuthorController@store')->name('author.store');
            Route::get('/update/{author}', 'AuthorController@edit')->name('author.edit');
            Route::post('/update/{author}', 'AuthorController@update')->name('author.update');
            Route::get('/detail/{author}', 'AuthorController@show')->name('author.detail');
            Route::post('/delete/{author}', 'AuthorController@destroy')->name('author.delete');
        });
        Route::group(['prefix' => 'currency'], function () {
            Route::get('/', 'CurrencyController@index')->name('currency.index');
            Route::get('/create', 'CurrencyController@create')->name('currency.create');
            Route::post('/create', 'CurrencyController@store')->name('currency.store');
            Route::get('/update/{currency}', 'CurrencyController@edit')->name('currency.edit');
            Route::post('/update/{currency}', 'CurrencyController@update')->name('currency.update');
            Route::get('/detail/{currency}', 'CurrencyController@show')->name('currency.detail');
            Route::post('/delete/{currency}', 'CurrencyController@destroy')->name('currency.delete');
        });
        Route::group(['prefix' => 'bank'], function () {
            Route::get('/', 'BankController@index')->name('bank.index');
            Route::get('/create', 'BankController@create')->name('bank.create');
            Route::post('/create', 'BankController@store')->name('bank.store');
            Route::get('/update/{bank}', 'BankController@edit')->name('bank.edit');
            Route::post('/update/{bank}', 'BankController@update')->name('bank.update');
            Route::get('/detail/{bank}', 'BankController@show')->name('bank.detail');
            Route::post('/delete/{bank}', 'BankController@destroy')->name('bank.delete');
        });
        Route::group(['prefix' => 'category'], function () {
            Route::get('/', 'CategoryController@index')->name('category.index');
            Route::get('/create', 'CategoryController@create')->name('category.create');
            Route::post('/create', 'CategoryController@store')->name('category.store');
            Route::get('/update/{category}', 'CategoryController@edit')->name('category.edit');
            Route::post('/update/{category}', 'CategoryController@update')->name('category.update');
            Route::get('/detail/{category}', 'CategoryController@show')->name('category.detail');
            Route::post('/delete/{category}', 'CategoryController@destroy')->name('category.delete');
        });
        Route::group(['prefix' => 'supplier'], function () {
            Route::get('/', 'SupplierController@index')->name('supplier.index');
            Route::get('/create', 'SupplierController@create')->name('supplier.create');
            Route::post('/create', 'SupplierController@store')->name('supplier.store');
            Route::get('/update/{supplier}', 'SupplierController@edit')->name('supplier.edit');
            Route::post('/update/{supplier}', 'SupplierController@update')->name('supplier.update');
            Route::get('/detail/{supplier}', 'SupplierController@show')->name('supplier.detail');
            Route::post('/delete/{supplier}', 'SupplierController@destroy')->name('supplier.delete');
        });
        Route::group(['prefix' => 'stock'], function () {
            Route::get('/', 'StockController@index')->name('stock.index');
            Route::get('/create', 'StockController@create')->name('stock.create');
            Route::post('/create', 'StockController@store')->name('stock.store');
            Route::get('/update/{stock}', 'StockController@edit')->name('stock.edit');
            Route::post('/update/{stock}', 'StockController@update')->name('stock.update');
            Route::get('/detail/{stock}', 'StockController@show')->name('stock.detail');
            Route::post('/delete/{stock}', 'StockController@destroy')->name('stock.delete');
        });
        Route::group(['prefix' => 'membership'], function () {
            Route::get('/', 'MembershipController@index')->name('membership.index');
            Route::get('/create', 'MembershipController@create')->name('membership.create');
            Route::post('/create', 'MembershipController@store')->name('membership.store');
            Route::get('/update/{membership}', 'MembershipController@edit')->name('membership.edit');
            Route::post('/update/{membership}', 'MembershipController@update')->name('membership.update');
            Route::get('/detail/{membership}', 'MembershipController@show')->name('membership.detail');
            Route::post('/delete/{membership}', 'MembershipController@destroy')->name('membership.delete');
        });
        Route::group(['prefix' => 'promotion'], function () {
            Route::get('/', 'PromotionController@index')->name('promotion.index');
            Route::get('/create', 'PromotionController@create')->name('promotion.create');
            Route::post('/create', 'PromotionController@store')->name('promotion.store');
            Route::get('/update/{promotion}', 'PromotionController@edit')->name('promotion.edit');
            Route::post('/update/{promotion}', 'PromotionController@update')->name('promotion.update');
            Route::get('/detail/{promotion}', 'PromotionController@show')->name('promotion.detail');
            Route::post('/delete/{promotion}', 'PromotionController@destroy')->name('promotion.delete');
        });
        Route::group(['prefix' => 'paymentMethod'], function () {
            Route::get('/', 'PaymentMethodController@index')->name('paymentMethod.index');
            Route::get('/create', 'PaymentMethodController@create')->name('paymentMethod.create');
            Route::post('/create', 'PaymentMethodController@store')->name('paymentMethod.store');
            Route::get('/update/{paymentmethod}', 'PaymentMethodController@edit')->name('paymentMethod.edit');
            Route::post('/update/{paymentmethod}', 'PaymentMethodController@update')->name('paymentMethod.update');
            Route::get('/detail/{paymentmethod}', 'PaymentMethodController@show')->name('paymentMethod.detail');
            Route::post('/delete/{paymentmethod}', 'PaymentMethodController@destroy')->name('paymentMethod.delete');
        });
        Route::group(['prefix' => 'setting'], function () {
            Route::get('/', 'SettingController@index')->name('setting.index');
        Route::post('/update', 'BookController@update')->name('setting.update');
    });
});
Route::get('/login', [BackendController::class, 'login'])->name('login');
Route::post('/login', [BackendController::class, 'authenticate'])->name('authenticate');
