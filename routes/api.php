<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get
Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']);
Route::get('user/list',[RouteController::class,'userList']);
Route::get('order/list',[RouteController::class,'orderList']);
Route::get('orderList/list',[RouteController::class,'orderList_List']);
Route::get('contact/list',[RouteController::class,'contactList']);
Route::get('cart/list',[RouteController::class,'cartList']);

//for each data
Route::get('product/list/{id}',[RouteController::class,'productDetails']);
Route::get('category/list/{id}',[RouteController::class,'categoryDetails']);
Route::get('user/list/{id}',[RouteController::class,'userDetails']);
Route::get('order/list/{id}',[RouteController::class,'orderDetails']);
Route::get('orderList/list/{id}',[RouteController::class,'orderList_Details']);
Route::get('contact/list/{id}',[RouteController::class,'contactDetails']);
Route::get('cart/list/{id}',[RouteController::class,'cartDetails']);

//delete data
Route::get('product/delete/{id}',[RouteController::class,'productDelete']);
Route::get('category/delete/{id}',[RouteController::class,'categoryDelete']);
Route::get('user/delete/{id}',[RouteController::class,'userDelete']);
Route::get('order/delete/{id}',[RouteController::class,'orderDelete']);
Route::get('orderList/delete/{id}',[RouteController::class,'orderList_Delete']);
Route::get('contact/delete/{id}',[RouteController::class,'contactDelete']);
Route::get('cart/delete/{id}',[RouteController::class,'cartDelete']);

//post
//create data
Route::post('create/product',[RouteController::class,'createProduct']);
Route::post('create/category',[RouteController::class,'createCategory']);
Route::post('create/user',[RouteController::class,'createUser']);
Route::post('create/order',[RouteController::class,'createOrder']);
Route::post('create/orderList',[RouteController::class,'createOrderList']);
Route::post('create/contact',[RouteController::class,'createContact']);
Route::post('create/cart',[RouteController::class,'createCart']);

//updateData
Route::post('update/product',[RouteController::class,'updateProduct']);
Route::post('update/category',[RouteController::class,'updateCategory']);
Route::post('update/user',[RouteController::class,'updateUser']);
Route::post('update/order',[RouteController::class,'updateOrder']);
Route::post('update/orderList',[RouteController::class,'updateOrderList']);
Route::post('update/contact',[RouteController::class,'updateContact']);
Route::post('update/cart',[RouteController::class,'updateCart']);

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| product list
| localhost:8000/api/product/list (GET)
| localhost:8000/api/product/list/id (GET) - for each data
| localhost:8000/api/product/delete/id (GET) - for delete
|
| category list
| localhost:8000/api/category/list (GET)
| localhost:8000/api/category/list/id (GET) - for each data
| localhost:8000/api/category/delete/id (GET) - for delete
| localhost:8000/api/create/category (Post) - for create (Key = name)
| localhost:8000/api/update/category (Post) - for update (Key = category_id, name)
|
|user list
| localhost:8000/api/user/list (GET)
| localhost:8000/api/user/list/id (GET) - for each data
| localhost:8000/api/user/delete/id (GET) - for delete
|
|order list
| localhost:8000/api/order/list (GET)
| localhost:8000/api/order/list/id (GET) - for each data
| localhost:8000/api/order/delete/id (GET) - for delete
|
|orderList list
| localhost:8000/api/orderList/list (GET)
| localhost:8000/api/orderList/list/id (GET) - for each data
| localhost:8000/api/orderList/delete/id (GET) - for delete
|
|contact list
| localhost:8000/api/contact/list (GET)
| localhost:8000/api/contact/list/id (GET) - for each data
| localhost:8000/api/contact/delete/id (GET) - for delete
|
|cart list
| localhost:8000/api/cart/list (GET)
| localhost:8000/api/cart/list/id (GET) - for each data
| localhost:8000/api/cart/delete/id (GET) - for delete
|
|----------------------------------------------------------
|
|
|
*/
