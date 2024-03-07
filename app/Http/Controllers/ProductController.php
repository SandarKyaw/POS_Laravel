<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    //pizza List Page
    public function productListPage(){
        $products = Product::Select('products.*','categories.name as category_name')
        ->when(request('searchKey'), function($query){
            $query -> where('products.name','like','%'.request('searchKey').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')->paginate(3);

        $products->appends(request()->all());
        return view('admin.products.productList',compact('products'));
    }

    //pizza Create Page
    public function productCreatePage(){
        // $categories = Category::get();
        $categories = Category::Select('id','name')->get();
        // dd($categories->toArray());
        return view('admin.products.productCreate',compact('categories'));
    }

    //product create data
    public function productCreate(Request $request){
        $this->productValidationCheck($request,"create");
        $data = $this->requestProductInfo($request);
        if($request->hasFile('productImage')){
            $filename = uniqid().'_sdk_'.$request->file('productImage')->getClientOriginalName();

            //for public store
            $request->file('productImage')->storeAS('public',$filename);

            //for database store
            $data['image'] = $filename;
        }

        Product::Create($data);
        return redirect()->route('products#productListPage')->with(['productSuccess' => 'Product Created Successfully...']);
    }

    //product delete
    public function productDelete($id){
        Product::where('id',$id)->delete();
        return back()->with(['productSuccess'=>'Product Deleted Successfully....']);
    }

    //product edit
    public function productView($id){
       $products = Product::select('products.*','categories.name as category_name')
       ->leftJoin('categories','products.category_id','categories.id')
       ->where('products.id', $id)->first();
        return view('admin.products.productView', compact('products'));
    }

    //product update page
    public function productUpdatePage($id){
        $products = Product::where('id',$id)->first();
        $categories = Category::get();
        return view('admin.products.productUpdate',compact('products','categories'));
    }

    //product update
    public function productUpdate(Request $request){
        $this->productValidationCheck($request,"update");
        $data = $this->requestProductInfo($request);

        if($request->hasFile('productImage')){
            $oldImageName = Product::where('id',$request->id)->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }

            $filename = uniqid().$request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public',$filename);
            $data['image'] = $filename;
        }

        Product::where('id',$request->id)->update($data);
        return redirect()->route('products#productListPage')->with(['productSuccess' => 'Product Updated Successfully..']);

    }

    //product data add to database
    private function requestProductInfo($request){
      return [
            'category_id' => $request->productCategory,
            'name' => $request->productName,
            'description' => $request->productDescription,
            'price' => $request->productPrice,
            'waiting_time' => $request->waitingTime
        ];
    }

      //product validation check
      private function productValidationCheck($request,$action){
        $validatorRules = [
            "productName" => 'required | unique:products,name,'.$request->id,
            'productCategory' => 'required',
            'productDescription' => 'required',
            'productPrice' => 'required',
            'waitingTime' => 'required'
        ];

        $validatorRules['productImage'] = $action == "create" ? 'required | mimes:jpg, jpeg, png | file' : 'mimes:jpg, jpeg, png | file';

        Validator::make($request->all(), $validatorRules
      )->validate();
    }
}
