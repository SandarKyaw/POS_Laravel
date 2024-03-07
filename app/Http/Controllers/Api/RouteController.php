<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\orderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all product
   public function productList(){
    $data = Product::get();
    return response()->json($data, 200);
   }

    //get all category
   public function categoryList(){
    $data = Category::get();
    return response()->json($data, 200);
   }

    //get all user
   public function userList(){
    $data = User::get();
    return response()->json($data, 200);
   }

    //get all order
   public function orderList(){
    $data = Order::get();
    return response()->json($data, 200);
   }

    //get all orderList
   public function orderList_List(){
    $data = orderList::get();
    return response()->json($data, 200);
   }

    //get all contact
   public function contactList(){
    $data = Contact::get();
    return response()->json($data, 200);
   }

    //get all cart
   public function cartList(){
    $data = Cart::get();
    return response()->json($data, 200);
   }

     //get each data form cart
   public function cartDetails($id){
    $data = Cart::where('id',$id)->first();

   if(isset($data)){
    return response()->json(['status'=>'true', 'message'=>$data], 200);
   }
   return response()->json(['status'=>'false', 'message'=>'there is no cart for this id'], 500);
   }

     //get each data form product
   public function productDetails($id){
    $data = Product::where('id',$id)->first();

   if(isset($data)){
    return response()->json(['status'=>'true', 'message'=>$data], 200);
   }
   return response()->json(['status'=>'false', 'message'=>'there is no product for this id'], 500);
   }

     //get each data form category
   public function categoryDetails($id){
    $data = Category::where('id',$id)->first();

   if(isset($data)){
    return response()->json(['status'=>'true', 'message'=>$data], 200);
   }
   return response()->json(['status'=>'false', 'message'=>'there is no category for this id'], 500);
   }

     //get each data form user
   public function userDetails($id){
    $data = User::where('id',$id)->first();

   if(isset($data)){
    return response()->json(['status'=>'true', 'message'=>$data], 200);
   }
   return response()->json(['status'=>'false', 'message'=>'there is no user for this id'], 500);
   }

     //get each data form order
   public function orderDetails($id){
    $data = Order::where('id',$id)->first();

   if(isset($data)){
    return response()->json(['status'=>'true', 'message'=>$data], 200);
   }
   return response()->json(['status'=>'false', 'message'=>'there is no order for this id'], 500);
   }

   //get each data form orderList
   public function orderList_Details($id){
    $data = orderList::where('id',$id)->first();

   if(isset($data)){
    return response()->json(['status'=>'true', 'message'=>$data], 200);
   }
   return response()->json(['status'=>'false', 'message'=>'there is no order_list for this id'], 500);
   }

   //get each data form contact
   public function contactDetails($id){
    $data = Contact::where('id',$id)->first();

   if(isset($data)){
    return response()->json(['status'=>'true', 'message'=>$data], 200);
   }
   return response()->json(['status'=>'false', 'message'=>'there is no contact for this id'], 500);
   }

   //delete data form contact
   public function contactDelete($id){
    $data = Contact::where('id',$id)->first();

   if(isset($data)){
    Contact::where('id',$id)->delete();
    return response()->json(['status'=>'true', 'message'=> 'delete success' ,'deleted data'=>$data], 200);
   }
   return response()->json(['status'=>'false', 'message'=>'there is no contact for this id'], 500);
   }

    //delete data form product
   public function productDelete($id){
    $data = Product::where('id',$id)->first();

   if(isset($data)){
    Product::where('id',$id)->delete();
    return response()->json(['status'=>'true', 'message'=> 'delete success' ,'deleted data'=>$data], 200);
   }
   return response()->json(['status'=>'false', 'message'=>'there is no product for this id'], 500);
   }

    //delete data form category
   public function categoryDelete($id){
    $data = Category::where('id',$id)->first();

   if(isset($data)){
    Category::where('id',$id)->delete();
    return response()->json(['status'=>'true', 'message'=> 'delete success' ,'deleted data'=>$data], 200);
   }
   return response()->json(['status'=>'false', 'message'=>'there is no category for this id'], 500);
   }

    //delete data form user
   public function userDelete($id){
    $data = User::where('id',$id)->first();

   if(isset($data)){
    User::where('id',$id)->delete();
    return response()->json(['status'=>'true', 'message'=> 'delete success' ,'deleted data'=>$data], 200);
   }
   return response()->json(['status'=>'false', 'message'=>'there is no user for this id'], 500);
   }

    //delete data form order
   public function orderDelete($id){
    $data = Order::where('id',$id)->first();

   if(isset($data)){
    Order::where('id',$id)->delete();
    return response()->json(['status'=>'true', 'message'=> 'delete success' ,'deleted data'=>$data], 200);
   }
   return response()->json(['status'=>'false', 'message'=>'there is no order for this id'], 500);
   }

    //delete data form orderList
   public function orderListDelete($id){
    $data = orderList::where('id',$id)->first();
   if(isset($data)){
    orderList::where('id',$id)->delete();
    return response()->json(['status'=>'true', 'message'=> 'delete success' ,'deleted data'=>$data], 200);
   }
   return response()->json(['status'=>'false', 'message'=>'there is no order_list for this id'], 500);
   }

    //delete data form cart
   public function cartDelete($id){
    $data = Cart::where('id',$id)->first();

   if(isset($data)){
    Cart::where('id',$id)->delete();
    return response()->json(['status'=>'true', 'message'=> 'delete success' ,'deleted data'=>$data], 200);
   }
   return response()->json(['status'=>'false', 'message'=>'there is no cart for this id'], 500);
   }

   //post
   //create product
//    public function createProduct(Request $request){
//     return $request->all();
//     $data = [
//         'category_id' => $request->category_id,
//         'name' => $request->name,
//         'description' => $request->description,
//         'image' => $request->image,
//         'price' => $request->price,
//         'waiting_time' => $request->waiting_time
//     ];
//     $response = Product::create($data);
//     return response()->json(['message'=> 'success create' , 'response'=> $response], 200);
//    }

   //create category
   public function createCategory(Request $request){
    // return $request->all();
    $data = $this->requestCategoryData($request);
    Category::create($data);
    $category = Category::get();
    return response()->json($category, 200);
   }

     //update category
    public function updateCategory(Request $request){
        $categoryId = $request->category_id;
        $dbSource = Category::where('id',$categoryId)->first();
        if(isset($dbSource)){
             $data = $this->requestCategoryData($request);
             $response = Category::where('id',$categoryId)->update($data);
             return response()->json(['message'=> 'update success', 'response'=> $data], 200);
        }
       return response()->json(['message'=> 'there is no category for update'], 200);
    }

   //category request data
   private function requestCategoryData($request){
    return [
        'name' => $request->name,
        // 'created_at' => Carbon::now(),
        // 'updated_at' => Carbon::now()
    ];
   }
}


