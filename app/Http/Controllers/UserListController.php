<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserListController extends Controller
{
    //user list
    public function userList(){

        $users = User::where('role','user')->paginate('3');
        return view('admin.user.userList',compact('users'));

    }

    //user list search
    public function userListSearch(Request $request){
        $users = User::when(request('searchKey'),function($query){
        $query ->where('role','user');
        });

         if($request->status == 'name' && $request->searchKey != null){
            $users = $users->where('name','like','%'.request('searchKey').'%')->paginate();
         }else if($request->status == 'gender'  && $request->searchKey != null){
            $users = $users->where('gender','like','%'.request('searchKey').'%')->paginate();
         }else if($request->status == 'email'  && $request->searchKey != null){
            $users = $users->where('email','like','%'.request('searchKey').'%')->paginate();
         }else if($request->status == 'phone'  && $request->searchKey != null){
            $users = $users->where('phone','like','%'.request('searchKey').'%')->paginate();
         }else if($request->status == 'address'  && $request->searchKey != null){
            $users = $users->where('address','like','%'.request('searchKey').'%')->paginate();
         }
        else if(($request->status == 'name' && $request->searchKey == null) ||
                ($request->status == 'gender' && $request->searchKey == null) ||
                ($request->status == 'phone' && $request->searchKey == null) ||
                ($request->status == 'email' && $request->searchKey == null) ||
                ($request->status == 'address' && $request->searchKey == null)
        ){
            return back()->with(['message'=>'Type a word for searching data..']);
         }


        //  dd($users->toArray());
          $users->appends(request()->all());

        return view('admin.user.userList',compact('users'));
    }

    //ajax role change
    public function roleChange(Request $request){
        logger($request);
        User::where('id',$request->userId)->update([
            'role' => $request->role,
        ]);
    }

    //user data update page
    public function userUpdatePage($userId){
        $data = User::where('id',$userId)->first();
        return view('admin.user.update', compact('data'));
    }

    //user data update btn
    public function userUpdate(Request $request){

        $this->validationCheck($request);

        $data = $this->requestData($request);

        if($request->hasFile('userImage')){
            $oldImageName = User::where('id',$request->id)->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }

            $filename = uniqid().$request->file('userImage')->getClientOriginalName();
            $request->file('userImage')->storeAs('public',$filename);
            $data['image'] = $filename;
        }

        User::where('id',$request->id)->update($data);
        return back();
    }

    //user data delete
    public function userDelete($userId){
        User::where('id',$userId)->delete();
        return back();
    }

    //validation check
    private function validationCheck($request){

      $validatorRules = [
            "name" => 'required | unique:products,name,'.$request->id,
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'userImage' => 'mimes:jpg, jpeg, png, webp | file'
        ];

        Validator::make($request->all(), $validatorRules
      )->validate();
    }

    //user request data
    private function requestData($request){
        return
             [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
             ];
    }
}
