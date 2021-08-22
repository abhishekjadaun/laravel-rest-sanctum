<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userinfo;
use Validator;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    function getData($id=null){
        return $id?Userinfo::find($id):Userinfo::all();
    }

    function add(Request $req){
        $valid=Validator::make($req->all(),[
           'name'=>'required',
           'email'=>'required|email',
           'password'=>'required',

        ]);
        if($valid->fails()){
            return response()->json(['error'=>$valid->errors()],'401');
        }
        $Userinfo=new Userinfo;
        $Userinfo->name=$req->name;
        $Userinfo->email=$req->email;
        $Userinfo->password=Hash::make($req->password);
        $result=$Userinfo->save();
        if($result){
            return 'Saved Successfully';
        }else{
            return 'Something Went Wrong';

        }
    }

    function update(Request $req){
        // return $req->all();
         $Userinfo=Userinfo::find($req->id);
         $Userinfo->name=$req->name;
         $Userinfo->email=$req->email;
         $Userinfo->password=Hash::make($req->password);
         $result=$Userinfo->update();
        if($result){
            return 'Updated Successfully';
        }else{
            return 'Something Went Wrong';

        }
    }

    function search($name){
        return Userinfo::where('name','like','%'.$name.'%')->get();
    }

    function delete($id){
        $Userinfo=Userinfo::find($id);
        $result=$Userinfo->delete();
        if($result){
            return 'Deleted Successfully';
        }else{
            return 'Something Went Wrong';

        }
    }

    function login(Request $request){
         $valid=Validator::make($request->all(),[
                'email'=>'required',
                'password'=>'required',
         ]);
         if($valid->fails()){
             return response()->json(['error'=>$valid->errors()],'401');
         }
         $user=Userinfo::where('email',$request->email)->first();
         if(!$user || !Hash::check($request->password,$user->password)){
             return response([
                'message'=>'Wrong Credentials',
             ],'404');
         }
       
        
         $token=$user->createToken('authToken')->plainTextToken;

         $response=[
             'user'=>$user,
             'token'=>$token,
         ];
         return response($response,201);

    }

    function upload(Request $request){
        $result=$request->file('file')->store('apiDocs');
        return response(['result'=>$result],200);
    }
}
