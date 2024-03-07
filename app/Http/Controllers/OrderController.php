<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Contact;
use App\Models\orderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //order list page
    public function orderListPage(){
        $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at', 'desc')
                ->get();

        return view('admin.order.orderList', compact('order'));
    }

    //ajax order status
    public function orderStatusSearch(Request $request){

        // dd($request->all());
        $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at', 'desc');

        if($request->status == null){
        $order =  $order->get();
        }else {
            $order = $order->Where('orders.status', $request->status)->get();
        }
        // return response()->json($order, 200);
        return view('admin.order.orderList',compact('order'));
    }

    public function orderCodeInfo($orderCode){

        $orderPrice = Order::where('order_code',$orderCode)->first();
        // dd($orderCode);
        $orderList = orderList::SELECT('order_lists.*','users.name as username','products.name as pname','products.image as pimage')
                    ->leftJoin('users','users.id','order_lists.user_id')
                    ->leftJoin('products','products.id','order_lists.product_id')
                    ->where('order_code',$orderCode)
                    ->get();
        return view('admin.order.orderCodeInfo',compact('orderList', 'orderPrice'));
        // dd($orderList->toArray());
    }

    //ajax status change when find stautus
    public function statusChange(Request $request){
        logger($request->all());

        Order::where('id', $request->orderId)->update([
            'status' => $request->status,
        ]);
    }
}
