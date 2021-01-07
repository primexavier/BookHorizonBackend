<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
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
Route::group(['middleware' => 'AuthAdmin'], function () {
    Route::get('/', function (){
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
        Route::get('/', [BlogController::class, 'index'])->name('blog.index');
        Route::get('/create',  [BlogController::class, 'create'])->name('blog.create');
        Route::post('/create',  [BlogController::class, 'store'])->name('blog.store');
        Route::get('/update/{blog}',  [BlogController::class, 'edit'])->name('blog.edit');
        Route::post('/update/{blog}',  [BlogController::class, 'update'])->name('blog.update');
        Route::get('/detail/{blog}',  [BlogController::class, 'detail'])->name('blog.detail');
        Route::post('/delete/{blog}',  [BlogController::class, 'delete'])->name('blog.delete');
    });
    Route::group(['prefix' => 'members'], function () {
        Route::get('/', [MemberController::class, 'index'])->name('member.index');
        Route::get('/create', [MemberController::class, 'create'])->name('member.create');
        Route::post('/create', [MemberController::class, 'store'])->name('member.store');
        Route::get('/update/{user}', [MemberController::class, 'edit'])->name('member.edit');
        Route::post('/update/{user}', [MemberController::class, 'update'])->name('member.update');
        Route::get('/detail/{user}', [MemberController::class, 'detail'])->name('member.detail');
        Route::post('/delete/{user}', [MemberController::class, 'delete'])->name('member.delete');
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
            Route::get('/create', [TransactionController::class, 'index'])->name('transactions.create');
            Route::post('/create', [TransactionController::class, 'store'])->name('transactions.store');
            Route::get('/update/{transaction}', [TransactionController::class, 'edit'])->name('transactions.edit');
            Route::get('/detail/{transaction}',  [TransactionController::class, 'detail'])->name('transactions.detail');
            Route::post('/update/{transaction}',  [TransactionController::class, 'update'])->name('transactions.update');
            Route::post('/delete/{transaction}',  [TransactionController::class, 'delete'])->name('transactions.delete');
            Route::get('/approve-receipt/{transaction}',  [TransactionController::class, 'index'])->name('transactions.approve-receipt');
            Route::get('/decline-receipt/{transaction}',  [TransactionController::class, 'index'])->name('transactions.decline-receipt');
            Route::get('/cancel/{transaction}',  [TransactionController::class, 'cancel'])->name('transactions.cancel');
            Route::post('/add-shipping/{transaction}',  [TransactionController::class, 'index'])->name('transactions.add-shipping');
            Route::get('/finish/{transaction}',  [TransactionController::class, 'finish'])->name('transactions.finish');
        });
        Route::group(['prefix' => 'genre'], function () {
            Route::get('/', [GenreController::class, 'index'])->name('genre.index');
            Route::get('/create', [GenreController::class, 'create'])->name('genre.create');
            Route::post('/create', [GenreController::class, 'store'])->name('genre.store');
            Route::get('/update/{genre}', [GenreController::class, 'edit'])->name('genre.edit');
            Route::post('/update/{genre}', [GenreController::class, 'update'])->name('genre.update');
            Route::get('/detail/{genre}', [GenreController::class, 'detail'])->name('genre.detail');
            Route::post('/delete/{genre}', [GenreController::class, 'delete'])->name('genre.delete');
        });
        Route::group(['prefix' => 'author'], function () {
            Route::get('/', [AuthorController::class, 'index'])->name('author.index');
            Route::get('/create', [AuthorController::class, 'create'])->name('author.create');
            Route::post('/create', [AuthorController::class, 'store'])->name('author.store');
            Route::get('/update/{author}', [AuthorController::class, 'edit'])->name('author.edit');
            Route::post('/update/{author}', [AuthorController::class, 'update'])->name('author.update');
            Route::get('/detail/{author}', [AuthorController::class, 'detail'])->name('author.detail');
            Route::post('/delete/{author}', [AuthorController::class, 'delete'])->name('author.delete');
        });
        Route::group(['prefix' => 'currency'], function () {
            Route::get('/', [CurrencyController::class, 'index'])->name('currency.index');
            Route::get('/create', [CurrencyController::class, 'create'])->name('currency.create');
            Route::post('/create', [CurrencyController::class, 'store'])->name('currency.store');
            Route::get('/update/{currency}', [CurrencyController::class, 'edit'])->name('currency.edit');
            Route::post('/update/{currency}', [CurrencyController::class, 'update'])->name('currency.update');
            Route::get('/detail/{currency}', [CurrencyController::class, 'detail'])->name('currency.detail');
            Route::post('/delete/{currency}', [CurrencyController::class, 'delete'])->name('currency.delete');
        });
        Route::group(['prefix' => 'bank'], function () {
            Route::get('/', [BankController::class, 'index'])->name('bank.index');
            Route::get('/create',  [BankController::class, 'create'])->name('bank.create');
            Route::post('/create',  [BankController::class, 'store'])->name('bank.store');
            Route::get('/update/{bank}',  [BankController::class, 'edit'])->name('bank.edit');
            Route::post('/update/{bank}',  [BankController::class, 'update'])->name('bank.update');
            Route::get('/detail/{bank}',  [BankController::class, 'detail'])->name('bank.detail');
            Route::post('/delete/{bank}',  [BankController::class, 'delete'])->name('bank.delete');
        });
        Route::group(['prefix' => 'category'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
            Route::post('/create', [CategoryController::class, 'store'])->name('category.store');
            Route::get('/update/{category}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::post('/update/{category}', [CategoryController::class, 'update'])->name('category.update');
            Route::get('/detail/{category}', [CategoryController::class, 'detail'])->name('category.detail');
            Route::post('/delete/{category}', [CategoryController::class, 'delete'])->name('category.delete');
        });
        Route::group(['prefix' => 'supplier'], function () {
            Route::get('/', [SupplierController::class, 'index'])->name('supplier.index');
            Route::get('/create', [SupplierController::class, 'create'] )->name('supplier.create');
            Route::post('/create', [SupplierController::class, 'store'])->name('supplier.store');
            Route::get('/update/{supplier}', [SupplierController::class, 'edit'])->name('supplier.edit');
            Route::post('/update/{supplier}', [SupplierController::class, 'update'])->name('supplier.update');
            Route::get('/detail/{supplier}', [SupplierController::class, 'detail'])->name('supplier.detail');
            Route::post('/delete/{supplier}', [SupplierController::class, 'delete'])->name('supplier.delete');
        });
        Route::group(['prefix' => 'stock'], function () {
            Route::get('/', [StockController::class, 'index'])->name('stock.index');
            Route::get('/create',  [StockController::class, 'create'])->name('stock.create');
            Route::post('/create',  [StockController::class, 'store'])->name('stock.store');
            Route::get('/update/{stock}',  [StockController::class, 'edit'])->name('stock.edit');
            Route::post('/update/{stock}',  [StockController::class, 'update'])->name('stock.update');
            Route::get('/detail/{stock}',  [StockController::class, 'detail'])->name('stock.detail');
            Route::post('/delete/{stock}',  [StockController::class, 'delete'])->name('stock.delete');
        });
        Route::group(['prefix' => 'membership'], function () {
            Route::get('/', [MembershipController::class, 'index'])->name('membership.index');
            Route::get('/create', [MembershipController::class, 'create'])->name('membership.create');
            Route::post('/create', [MembershipController::class, 'store'])->name('membership.store');
            Route::get('/update/{membership}', [MembershipController::class, 'edit'])->name('membership.edit');
            Route::post('/update/{membership}', [MembershipController::class, 'update'])->name('membership.update');
            Route::get('/detail/{membership}', [MembershipController::class, 'detail'])->name('membership.detail');
            Route::post('/delete/{membership}', [MembershipController::class, 'delete'])->name('membership.delete');
        });
        Route::group(['prefix' => 'promotion'], function () {
            Route::get('/', [PromotionController::class, 'index'])->name('promotion.index');
            Route::get('/create', [PromotionController::class, 'create'])->name('promotion.create');
            Route::post('/create', [PromotionController::class, 'store'])->name('promotion.store');
            Route::get('/update/{promotion}', [PromotionController::class, 'edit'])->name('promotion.edit');
            Route::post('/update/{promotion}', [PromotionController::class, 'update'])->name('promotion.update');
            Route::get('/detail/{promotion}', [PromotionController::class, 'detail'])->name('promotion.detail');
            Route::post('/delete/{promotion}', [PromotionController::class, 'delete'])->name('promotion.delete');
        });
        Route::group(['prefix' => 'paymentMethod'], function () {
            Route::get('/', [PaymentMethodController::class, 'index'])->name('paymentMethod.index');
            Route::get('/create', [PaymentMethodController::class, 'create'])->name('paymentMethod.create');
            Route::post('/create', [PaymentMethodController::class, 'store'])->name('paymentMethod.store');
            Route::get('/update/{paymentmethod}', [PaymentMethodController::class, 'edit'])->name('paymentMethod.edit');
            Route::post('/update/{paymentmethod}', [PaymentMethodController::class, 'update'])->name('paymentMethod.update');
            Route::get('/detail/{paymentmethod}', [PaymentMethodController::class, 'detail'])->name('paymentMethod.detail');
            Route::post('/delete/{paymentmethod}', [PaymentMethodController::class, 'delete'])->name('paymentMethod.delete');
        });
        Route::group(['prefix' => 'setting'], function () {
            Route::get('/',  [SettingController::class, 'index'])->name('setting.index');
            Route::post('/update', [SettingController::class, 'update'])->name('setting.update');
        });
});
Route::get('/login', [BackendController::class, 'login'])->name('login');
Route::post('/login', [BackendController::class, 'authenticate'])->name('authenticate');
