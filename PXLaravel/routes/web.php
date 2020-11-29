<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['prefix' => 'backend'], function () {
    Route::group(['middleware' => 'AuthAdmin'], function () {
        Route::get('/', function ()    {
            return view('backend.home');            
        })->name('backend.home');
        Route::group(['prefix' => 'books'], function () {
            Route::get('/', 'BookController@index')->name('backend.book.index');
            Route::get('/create', 'BookController@create')->name('backend.book.create');
            Route::post('/create', 'BookController@store')->name('backend.book.store');
            Route::get('/update/{book}', 'BookController@edit')->name('backend.book.edit');
            Route::post('/update/{book}', 'BookController@update')->name('backend.book.update');
            Route::get('/detail/{book}', 'BookController@show')->name('backend.book.detail');
            Route::post('/delete/{book}', 'BookController@delete')->name('backend.book.delete');
            Route::post('/import', 'BookController@importExcel')->name('backend.book.import');
            Route::get('/import', 'BookController@importExcel')->name('backend.book.import');
            Route::get('/import-add', 'BookController@ImportCreate')->name('backend.book.import.add');
            Route::post('/import-store', 'BookController@ImportStore')->name('backend.book.import.store');
        });
        Route::group(['prefix' => 'blogs'], function () {
            Route::get('/', 'BlogController@index')->name('backend.blog.index');
            Route::get('/create', 'BlogController@create')->name('backend.blog.create');
            Route::post('/create', 'BlogController@store')->name('backend.blog.store');
            Route::get('/update/{blog}', 'BlogController@edit')->name('backend.blog.edit');
            Route::post('/update/{blog}', 'BlogController@update')->name('backend.blog.update');
            Route::get('/detail/{blog}', 'BlogController@show')->name('backend.blog.detail');
            Route::post('/delete/{blog}', 'BlogController@delete')->name('backend.blog.delete');
        });
        Route::group(['prefix' => 'members'], function () {
            Route::get('/', 'MemberController@index')->name('backend.member.index');
            Route::get('/create', 'MemberController@create')->name('backend.member.create');
            Route::post('/create', 'MemberController@store')->name('backend.member.store');
            Route::get('/update/{user}', 'MemberController@edit')->name('backend.member.edit');
            Route::post('/update/{user}', 'MemberController@update')->name('backend.member.update');
            Route::get('/detail/{user}', 'MemberController@show')->name('backend.member.detail');
            Route::post('/delete/{user}', 'MemberController@delete')->name('backend.member.delete');
        });
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UsersController@index')->name('backend.users.index');
            Route::get('/create', 'UsersController@create')->name('backend.users.create');
            Route::post('/create', 'UsersController@store')->name('backend.users.store');
            Route::get('/update/{user}', 'UsersController@edit')->name('backend.users.edit');
            Route::post('/update/{user}', 'UsersController@update')->name('backend.users.update');
            Route::get('/detail/{user}', 'UsersController@show')->name('backend.users.detail');
            Route::post('/delete/{user}', 'UsersController@destroy')->name('backend.users.delete');
        });
        Route::group(['prefix' => 'transactions'], function () {
            Route::get('/', 'TransactionController@index')->name('backend.transactions.index');
            Route::get('/create', 'TransactionController@create')->name('backend.transactions.create');
            Route::post('/create', 'TransactionController@store')->name('backend.transactions.store');
            Route::get('/update/{transaction}', 'TransactionController@edit')->name('backend.transactions.edit');
            Route::get('/detail/{transaction}', 'TransactionController@show')->name('backend.transactions.detail');
            Route::post('/update/{transaction}', 'TransactionController@update')->name('backend.transactions.update');
            Route::post('/delete/{transaction}', 'TransactionController@destroy')->name('backend.transactions.delete');
            Route::get('/approve-receipt/{transaction}', 'TransactionController@approveReceipt')->name('backend.transactions.approve-receipt');
            Route::get('/decline-receipt/{transaction}', 'TransactionController@declineReceipt')->name('backend.transactions.decline-receipt');
            Route::get('/cancel/{transaction}', 'TransactionController@cancel')->name('backend.transactions.cancel');
            Route::post('/add-shipping/{transaction}', 'TransactionController@addShipping')->name('backend.transactions.add-shipping');
            Route::get('/finish/{transaction}', 'TransactionController@finishTransaction')->name('backend.transactions.finish');
        });
        Route::group(['prefix' => 'genre'], function () {
            Route::get('/', 'GenreController@index')->name('backend.genre.index');
            Route::get('/create', 'GenreController@create')->name('backend.genre.create');
            Route::post('/create', 'GenreController@store')->name('backend.genre.store');
            Route::get('/update/{genre}', 'GenreController@edit')->name('backend.genre.edit');
            Route::post('/update/{genre}', 'GenreController@update')->name('backend.genre.update');
            Route::get('/detail/{genre}', 'GenreController@show')->name('backend.genre.detail');
            Route::post('/delete/{genre}', 'GenreController@destroy')->name('backend.genre.delete');
        });
        Route::group(['prefix' => 'author'], function () {
            Route::get('/', 'AuthorController@index')->name('backend.author.index');
            Route::get('/create', 'AuthorController@create')->name('backend.author.create');
            Route::post('/create', 'AuthorController@store')->name('backend.author.store');
            Route::get('/update/{author}', 'AuthorController@edit')->name('backend.author.edit');
            Route::post('/update/{author}', 'AuthorController@update')->name('backend.author.update');
            Route::get('/detail/{author}', 'AuthorController@show')->name('backend.author.detail');
            Route::post('/delete/{author}', 'AuthorController@destroy')->name('backend.author.delete');
        });
        Route::group(['prefix' => 'currency'], function () {
            Route::get('/', 'CurrencyController@index')->name('backend.currency.index');
            Route::get('/create', 'CurrencyController@create')->name('backend.currency.create');
            Route::post('/create', 'CurrencyController@store')->name('backend.currency.store');
            Route::get('/update/{currency}', 'CurrencyController@edit')->name('backend.currency.edit');
            Route::post('/update/{currency}', 'CurrencyController@update')->name('backend.currency.update');
            Route::get('/detail/{currency}', 'CurrencyController@show')->name('backend.currency.detail');
            Route::post('/delete/{currency}', 'CurrencyController@destroy')->name('backend.currency.delete');
        });
        Route::group(['prefix' => 'bank'], function () {
            Route::get('/', 'BankController@index')->name('backend.bank.index');
            Route::get('/create', 'BankController@create')->name('backend.bank.create');
            Route::post('/create', 'BankController@store')->name('backend.bank.store');
            Route::get('/update/{bank}', 'BankController@edit')->name('backend.bank.edit');
            Route::post('/update/{bank}', 'BankController@update')->name('backend.bank.update');
            Route::get('/detail/{bank}', 'BankController@show')->name('backend.bank.detail');
            Route::post('/delete/{bank}', 'BankController@destroy')->name('backend.bank.delete');
        });
        Route::group(['prefix' => 'category'], function () {
            Route::get('/', 'CategoryController@index')->name('backend.category.index');
            Route::get('/create', 'CategoryController@create')->name('backend.category.create');
            Route::post('/create', 'CategoryController@store')->name('backend.category.store');
            Route::get('/update/{category}', 'CategoryController@edit')->name('backend.category.edit');
            Route::post('/update/{category}', 'CategoryController@update')->name('backend.category.update');
            Route::get('/detail/{category}', 'CategoryController@show')->name('backend.category.detail');
            Route::post('/delete/{category}', 'CategoryController@destroy')->name('backend.category.delete');
        });
        Route::group(['prefix' => 'supplier'], function () {
            Route::get('/', 'SupplierController@index')->name('backend.supplier.index');
            Route::get('/create', 'SupplierController@create')->name('backend.supplier.create');
            Route::post('/create', 'SupplierController@store')->name('backend.supplier.store');
            Route::get('/update/{supplier}', 'SupplierController@edit')->name('backend.supplier.edit');
            Route::post('/update/{supplier}', 'SupplierController@update')->name('backend.supplier.update');
            Route::get('/detail/{supplier}', 'SupplierController@show')->name('backend.supplier.detail');
            Route::post('/delete/{supplier}', 'SupplierController@destroy')->name('backend.supplier.delete');
        });
        Route::group(['prefix' => 'stock'], function () {
            Route::get('/', 'StockController@index')->name('backend.stock.index');
            Route::get('/create', 'StockController@create')->name('backend.stock.create');
            Route::post('/create', 'StockController@store')->name('backend.stock.store');
            Route::get('/update/{stock}', 'StockController@edit')->name('backend.stock.edit');
            Route::post('/update/{stock}', 'StockController@update')->name('backend.stock.update');
            Route::get('/detail/{stock}', 'StockController@show')->name('backend.stock.detail');
            Route::post('/delete/{stock}', 'StockController@destroy')->name('backend.stock.delete');
        });
        Route::group(['prefix' => 'membership'], function () {
            Route::get('/', 'MembershipController@index')->name('backend.membership.index');
            Route::get('/create', 'MembershipController@create')->name('backend.membership.create');
            Route::post('/create', 'MembershipController@store')->name('backend.membership.store');
            Route::get('/update/{membership}', 'MembershipController@edit')->name('backend.membership.edit');
            Route::post('/update/{membership}', 'MembershipController@update')->name('backend.membership.update');
            Route::get('/detail/{membership}', 'MembershipController@show')->name('backend.membership.detail');
            Route::post('/delete/{membership}', 'MembershipController@destroy')->name('backend.membership.delete');
        });
        Route::group(['prefix' => 'promotion'], function () {
            Route::get('/', 'PromotionController@index')->name('backend.promotion.index');
            Route::get('/create', 'PromotionController@create')->name('backend.promotion.create');
            Route::post('/create', 'PromotionController@store')->name('backend.promotion.store');
            Route::get('/update/{promotion}', 'PromotionController@edit')->name('backend.promotion.edit');
            Route::post('/update/{promotion}', 'PromotionController@update')->name('backend.promotion.update');
            Route::get('/detail/{promotion}', 'PromotionController@show')->name('backend.promotion.detail');
            Route::post('/delete/{promotion}', 'PromotionController@destroy')->name('backend.promotion.delete');
        });
        Route::group(['prefix' => 'paymentMethod'], function () {
            Route::get('/', 'PaymentMethodController@index')->name('backend.paymentMethod.index');
            Route::get('/create', 'PaymentMethodController@create')->name('backend.paymentMethod.create');
            Route::post('/create', 'PaymentMethodController@store')->name('backend.paymentMethod.store');
            Route::get('/update/{paymentmethod}', 'PaymentMethodController@edit')->name('backend.paymentMethod.edit');
            Route::post('/update/{paymentmethod}', 'PaymentMethodController@update')->name('backend.paymentMethod.update');
            Route::get('/detail/{paymentmethod}', 'PaymentMethodController@show')->name('backend.paymentMethod.detail');
            Route::post('/delete/{paymentmethod}', 'PaymentMethodController@destroy')->name('backend.paymentMethod.delete');
        });
        Route::group(['prefix' => 'setting'], function () {
            Route::get('/', 'SettingController@index')->name('backend.setting.index');
            Route::post('/update', 'BookController@update')->name('backend.setting.update');
        });
    });
    Route::get('/login', 'BackendController@login')->name('backend.login');
    Route::post('/login', 'BackendController@authenticate')->name('backend.authenticate');
});
