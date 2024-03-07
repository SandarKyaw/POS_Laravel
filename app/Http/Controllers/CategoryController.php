<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category list page
    public function list(){
        $categories = Category::when(request('searchKey'),function($query){
            $query -> where('name','like','%'.request('searchKey').'%');
        })
        ->orderBy('id','desc')->paginate(5);
        // $categories->appends(request()->all()); - two way appends
        return view('admin.category.list',compact('categories'));
    }

    //direct category create page
    public function createPage(){
        return view('admin.category.create');
    }

    //category create
    public function create(Request $request){
        // dd($request->all());
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#listPage')->with(['categorySuccess'=>'Category Created...']);
    }

    //category delete
    public function delete($id){
        Category::where('id',$id)->delete();
        return back()->with(['categorySuccess'=>'Category Deleted...']);
    }

    //category edit
    public function editPage($id){
        $category = Category::where('id', $id)->first();
        return view('admin.category.edit',compact('category'));
    }

    //category update
    public function update(Request $request){
        // dd($request->all());
        $id = $request->categoryId;
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id',$id)->update($data);
        return redirect()->route('category#listPage');
    }

    //category validation
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required| unique:categories,name, '.$request->categoryId,
        ],
        ['categoryName.required' => 'category name field is required',
        'categoryName.unique' => 'this category name has already been taken..'
        ])->validate();  }

    //category request data to array
    private function requestCategoryData($request){
        return [
           'name' => $request -> categoryName,
        ];
    }
}
