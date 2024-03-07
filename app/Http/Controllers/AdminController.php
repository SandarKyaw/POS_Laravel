<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
     //direct password change page
     public function pwChangePage(){
        return view ('admin.account.pwChange');
    }

    //password change
     public function pwChange(Request $request){
        $this->passwordValidationCheck($request);
        $currentUserId = Auth::user()->id;
        $user = User::select('password')->where('id',$currentUserId)->first();
        // dd($user->toArray());
        $dbHashValue = $user -> password;

        if(Hash::check($request->oldPassword, $dbHashValue)){
           $newPassword = ['password' => Hash::make( $request->newPassword)];

           User::where('id',$currentUserId)->update($newPassword);

           Auth::logout();
           return redirect()->route('auth#loginPage')->with(['pwChangeSuccess' => 'Your Password is successfully Changed! Login Again...']);

        //    return redirect()->route('category#listPage')->with(['categorySuccess' => 'Your Password is successfully Changed...']);

        }else{
            return back()->with(['incorrectPassword'=>'The old password does not match. Try Again..']);
        }

    }

    //info detail page
    public function infoPage(){
        return view('admin.account.infoDetail');
    }

    //info edit page
    public function editPage(){
        return view('admin.account.edit');
    }

    //info update
    public function update($id,Request $request){
        // dd($id, $request->all());
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

            //store image
            $fileName = uniqid(). $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);

            // dd($fileName);
            $data['image'] = $fileName;
        }
        User::where('id',$id)->update($data);
        return redirect()->route('account#infoPage')->with(['updateSuccess' => 'Admin Account Updated...']);
    }

    //admin list

    // public function list(){
    //     $admin = User::when(request('searchKey')
    //     ,function($query){
    //         $query
    //         ->orWhere('name','like','%'.request('searchKey').'%')
    //         ->orWhere('gender','like','%'.request('searchKey').'%')
    //         ->orWhere('email','like','%'.request('searchKey').'%')
    //         ->orWhere('phone','like','%'.request('searchKey').'%')
    //         ->orWhere('address','like','%'.request('searchKey').'%')
    //         ;
    //     })

    //     ->where('role','admin')
    //     ->paginate(3);
    //     return view('admin.account.list',compact('admin'));
    // }

    public function list(){
        $admin = User::where('role','admin')->paginate(3);
         return view('admin.account.list', compact('admin'));
    }

    //admin list search
    public function ListSearch(Request $request){
        $admin = User::when(request('searchKey'),function($query){
        $query ->where('role','admin');
        });

         if($request->status == 'name' && $request->searchKey != null){
            $admin = $admin->where('name','like','%'.request('searchKey').'%')->paginate();
         }else if($request->status == 'gender'  && $request->searchKey != null){
            $admin = $admin->where('gender','like','%'.request('searchKey').'%')->paginate();
         }else if($request->status == 'email'  && $request->searchKey != null){
            $admin = $admin->where('email','like','%'.request('searchKey').'%')->paginate();
         }else if($request->status == 'phone'  && $request->searchKey != null){
            $admin = $admin->where('phone','like','%'.request('searchKey').'%')->paginate();
         }else if($request->status == 'address'  && $request->searchKey != null){
            $admin = $admin->where('address','like','%'.request('searchKey').'%')->paginate();
         }
        else if(($request->status == 'name' && $request->searchKey == null) ||
                ($request->status == 'gender' && $request->searchKey == null) ||
                ($request->status == 'phone' && $request->searchKey == null) ||
                ($request->status == 'email' && $request->searchKey == null) ||
                ($request->status == 'address' && $request->searchKey == null)
        ){
            return back()->with(['deleteSuccess'=>'Type a word for searching data..']);
         }

        //  dd($admin->toArray());
          $admin->appends(request()->all());

        return view('admin.account.list', compact('admin'));

     }

    //admin list delete
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=> 'Admin Successfully Deleted..']);
    }

    //admin change role page
    public function changeRole($id){
       $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    //change role
    // public function change($id, Request $request){
    //     $data = $this->requestRoleData($request);
    //     User::where('id',$id)->update($data);
    //     return redirect()->route('account#list');
    // }

    // ajax change role
    public function adminRoleChange(Request $request){
        User::where('id',$request->userId)->update(
            [
                'role' => $request->currentRole,
            ]
        );
    }

    //ajax delete message
    public function deleteMessage(Request $request){
        // logger($request->all());
        Contact::where('id',$request->contactId)->delete();

    }

    //ajax read message
    public function readMessage(Request $request){
        logger($request->all());
        Contact::where('id',$request->contactId)->update([
            'status'=> $request->status
        ]);
    }

    //request role data
    private function requestRoleData($request){
        return [
            'role' => $request->role
        ];
    }

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required | min:6',
            'newPassword' => 'required | min:6',
            'confirmPassword' => 'required | min:6 | same:newPassword'])->validate();
    }

    //info update request data
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
            'image' => 'mimes:jpg,jpeg,png | file',
            'address' => 'required',

        ])->validate();
    }

}
