<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\user\ajaxController;
use App\Http\Controllers\user\userController;

// Route::get('/', function () {
//     return view('login');
// });

// Route::get('/register', function () {
//     return view('register');
// });

Route::middleware('admin_auth')->group(function () {
//login , register
Route::redirect('/', 'loginPage');
Route::get('/loginPage',[AuthController::class, 'loginPage'])->name('auth#loginPage');
Route::get('/registerPage',[AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware([
    'auth'
])->group(function () {

//dashboard
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

//admin
Route::middleware('admin_auth')->group(function () {
//Category
Route::prefix('category')->group(function () {
    Route::get('listPage',[CategoryController::class, 'list'])->name('category#listPage');
    Route::get('createPage',[CategoryController::class,'createPage'])->name('category#createPage');
    Route::post('create', [CategoryController::class, 'create'])->name('category#create');
    Route::get('delete/{id}',[CategoryController::class, 'delete'])->name('category#delete');
    Route::get('editPage/{id}',[CategoryController::class, 'editPage'])->name('category#editPage');
    Route::post('update',[CategoryController::class, 'update'])->name('category#update');
    });

//admin account
//admin password change
Route::group(['prefix'=>'account'],function(){
Route::get('pwChangePage',[AdminController::class, 'pwChangePage'])->name('account#pwChangePage');
Route::post('pwChange',[AdminController::class, 'pwChange'])->name('account#pwChange');

//admin details info
Route::get('infoPage',[AdminController::class, 'infoPage'])->name('account#infoPage');
Route::get('editPage',[AdminController::class, 'editPage'])->name('account#editPage');
Route::post('update/{id}',[AdminController::class, 'update'])->name('account#update');

//admin list
Route::get('list',[AdminController::class, 'list'])->name('account#list');
Route::get('listSearch',[AdminController::class, 'listSearch'])->name('account#listSearch');
Route::get('delete/{id}',[AdminController::class, 'delete'])->name('account#delete');
Route::get('changeRole/{id}',[AdminController::class, 'changeRole'])->name('account#changeRole');
Route::post('change/{id}',[AdminController::class, 'change'])->name('account#change');
});

//products
Route::prefix('products')->group(function(){
    Route::get('productListPage',[ProductController::class, 'productListPage'])->name('products#productListPage');
    Route::get('productCreatePage',[ProductController::class, 'productCreatePage'])->name('products#productCreatePage');
    Route::post('productCreate',[ProductController::class, 'productCreate'])->name('products#productCreate');
    Route::get('productDelete/{id}',[ProductController::class, 'productDelete'])->name('products#Delete');
    Route::get('productView/{id}',[ProductController::class, 'productView'])->name('products#View');
    Route::get('productUpdatePage/{id}',[ProductController::class, 'productUpdatePage'])->name('products#UpdatePage');
    Route::post('productUpdate',[ProductController::class, 'productUpdate'])->name('products#Update');
});

//order
Route::prefix('order')->group(function () {
    Route::get('orderListPage',[OrderController::class,'orderListPage'])->name('order#orderListPage');
     Route::get('status/search',[OrderController::class,'orderStatusSearch'])->name('order#orderStatusSearch');
     Route::get('orderCodeInfo/{orderCode}',[OrderController::class,'orderCodeInfo'])->name('order#codeInfo');
});

//user list
Route::get('userList',[UserListController::class, 'userList'])->name('user#list');
Route::get('userListSearch',[UserListController::class, 'userListSearch'])->name('user#listSearch');
Route::get('user/updatePage/{userId}',[UserListController::class, 'userUpdatePage'])->name('admin#userUpdate');
Route::post('user/update',[UserListController::class, 'userUpdate'])->name('admin#userUpdateBtn');
Route::get('user/delete/{userId}',[UserListController::class, 'userDelete'])->name('admin#userDelete');

//contact list
Route::get('contactList',[ContactController::class, 'contactList'])->name('admin#contactList');

//admin ajax
Route::prefix('ajax')->group(function () {
    Route::get('order/statusChange',[OrderController::class,'statusChange'])->name('ajax#statusChange');
    Route::get('user/roleChange',[UserListController::class, 'roleChange'])->name('ajax#roleChange');
    Route::get('admin/roleChange',[AdminController::class, 'adminRoleChange'])->name('ajax#adminRoleChange');
    Route::get('message/delete',[AdminController::class, 'deleteMessage'])->name('ajax#deleteMessage');
    Route::get('message/read',[AdminController::class, 'readMessage'])->name('ajax#readMessage');
    // Route::get('list/search',[AdminController::class, 'listSearch'])->name('ajax#listSearch');
});

});

//user
Route::prefix('user')->middleware('user_auth')->group(function () {
    // Route::get('home', function(){
    //     return view('user.home');
    // })->name('user#home');

    //user home page
    Route::get('home',[userController::class, 'home'])->name('user#home');
    //user category filter
    Route::get('filter/{id}',[userController::class, 'filter'])->name('user#categoryFilter');

    //product details
    Route::get('details/{id}',[userController::class, 'productDetails'])->name('user#productDetails');

    //user order history
    Route::get('history',[userController::class, 'history'])->name('user#history');

    //cart page
     Route::prefix('cart')->group(function () {
        Route::get('cartPage',[userController::class,'cartPage'])->name('user#cartPage');
    });

    //contact page
    Route::get('contactPage',[ContactController::class, 'contactPage'])->name('user#contactPage');
    Route::post('contactSend',[ContactController::class, 'contactSend'])->name('user#contactSend');

    //account
    Route::prefix('account')->group(function(){
    Route::get('changePwPage',[userController::class, 'changePwPage'])->name('user#changePwPage');
    Route::post('changePw',[userController::class,'changePw'])->name('user#changePw');
    Route::get('editPage',[userController::class, 'editPage'])->name('user#editPage');
    Route::post('update/{id}',[userController::class,'update'])->name('user#update');
    });

    //ajax
    Route::prefix('ajax')->group(function () {
        Route::get('product/list',[ajaxController::class,'productList'])->name('ajax#productList');
        Route::get('order/count',[ajaxController::class,'orderCount'])->name('ajax#orderCount');
        Route::get('order/list',[ajaxController::class, 'orderList'])->name('ajax#orderList');
        Route::get('cart/clear',[ajaxController::class, 'clearCart'])->name('ajax#clearCart');
        Route::get('currentProduct/clear',[ajaxController::class, 'currentClear'])->name('ajax#currentClear');
        Route::get('product/viewCount',[ajaxController::class, 'productViewCount'])->name('ajax#viewCount');
    });


});

});

