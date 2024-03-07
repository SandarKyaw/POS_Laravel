<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\orderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ajaxController extends Controller
{
    //product list
    public function productList(Request $request){
    //  logger($request->all());
    if($request->status == 'desc'){
          $data = Product::orderBy('created_at','desc')->get();
    }else{
          $data = Product::orderBy('created_at','asc')->get();
    }

     return $data;
    }

    //order count
    public function orderCount(Request $request){
        $data = $this->getOrderData($request);
        // logger($request->all());
        Cart::create($data);

        $response = [
            'message' => 'add to cart complete',
            'status' => 'success'
        ];

        return response()->json($response, 200);
    }

    //order list
    public function orderList(Request $request){
        // logger($request->all());
        $total = 0;
        foreach($request->all() as $item){

            $data = orderList::create([
                'user_id' => $item['userId'],
                'product_id' => $item['productId'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['orderCode'],
            ]);
             $total += $data->total;
        }

            Cart::where('user_id',Auth::user()->id)->delete();

            Order::create([
                'user_id' => Auth::user()->id,
                'order_code' => $data->order_code,
                'total_price' => $total+3000
            ]);

        return response()->json(['status'=>'true','message'=>'order completed..'], 200);
    }

    //clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    //clear current product order
    public function currentClear(Request $request){
        // logger($request->all());
        // Cart::where('user_id',Auth::user()->id)
        // ->where('id',$request->orderId)
        // ->where('product_id',$request->productId)
        // ->delete();
        Cart::where('id',$request->orderId)->delete();
    }

    //view count
    public function productViewCount(Request $request){
        // logger($request->all());
        $product = Product::where('id',$request->productId)->first();

        $viewCount = [
            'view_count' => $product->view_count +1
        ];

        Product::where('id',$request->productId)->update($viewCount);
    }

    //get order data - cart
    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
