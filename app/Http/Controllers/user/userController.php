<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    //user home
    public function home(){
        $product = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('product','category','cart','history'));
    }

    //category filter
    public function filter($categoryId){
         $product = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
         $category = Category::get();
         $cart = Cart::where('user_id',Auth::user()->id)->get();
         $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('product','category','cart','history'));

    }

    //product details
    public function productDetails($productId){
        $productData = Product::where('id',$productId)->first();
        $productList = Product::get();
        return view('user.main.details',compact('productData','productList'));
    }

    //user order history
    public function history(){
        $orderData = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate('5');
        return view('user.main.history',compact('orderData'));
    }

    //cart page
    public function cartPage(){
        $cartList = Cart::select('carts.*','products.name as name','products.price as price','products.image as image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('user_id',Auth::user()->id)
                    ->get();
        // dd($cartList->toArray());
        $totalPrice = 0;
        foreach($cartList as $c){
            $totalPrice += $c->price*$c->qty;
        }
        return view('user.cart.cart',compact('cartList','totalPrice'));
    }

    //change password page
    public function changePwPage(){
        return view('user.account.changePw');
    }

    //change password
    public function changePw(Request $request){
         $this->passwordValidationCheck($request);
        $currentUserId = Auth::user()->id;
        $user = User::select('password')->where('id',$currentUserId)->first();
        // dd($user->toArray());
        $dbHashValue = $user -> password;

        if(Hash::check($request->oldPassword, $dbHashValue)){
           $newPassword = ['password' => Hash::make( $request->newPassword)];

           User::where('id',$currentUserId)->update($newPassword);

           return back()->with(['changeSuccess' => 'Your Password is successfully Changed...']);

        }else{
            return back()->with(['incorrectPassword'=>'The old password does not match. Try Again..']);
        }
    }

    //user update page
    public function editPage(){
        return view('user.account.edit');
    }

    //user update
    public function update($id, Request $request){
           $this->accountValidationCheck($request);
           $data = $this->getUserData($request);

        //for image
        if($request->hasFile('image')){
            //old image name | check => delete | store
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;
            // dd($dbImage); - ** don't forget enctype for image file **

        if($dbImage != null){
            Storage::delete('public/'.$dbImage);
           }
           //get unique filename
            $fileName = uniqid(). $request->file('image')->getClientOriginalName();
             //store image in public with filename
            $request->file('image')->storeAs('public',$fileName);

            //store image name in db
            $data['image'] = $fileName;
        }
        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'Your account has updated successfully...']);
    }

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required | min:6',
            'newPassword' => 'required | min:6',
            'confirmPassword' => 'required | min:6 | same:newPassword'])->validate();
    }

     //get user request data
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now(),
        ];
    }

     // account Validation Check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'image' => 'mimes:jpg,jpeg,png,webp | file',
            'address' => 'required',

        ])->validate();
    }
}
