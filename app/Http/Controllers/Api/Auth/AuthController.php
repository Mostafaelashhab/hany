<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    public function register(Request $request){
        $valid = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users|max:100',
            'password' => 'required|confirmed|min:8|max:60',

        ]);
        if ($valid->fails()) {
            return $this->sendResponse($valid->errors()->all());
        }
        $request['password'] = Hash::make($request->password);
        if ($request->has('image')){
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'),$image_name);
            $request['image'] = $image_name;
        }


        $user = User::create($request->all());
        $token = $user->createToken('auth_token')->plainTextToken;
        return $this->sendResponse([
            'user' => $user,
            'token' => $token
        ]);
    }
    public function login(Request $request){
        $valid = Validator::make($request->all(),[
            'email' => 'required|email|max:100|exists:users',
            'password' => 'required|min:8|max:60',
        ]);
        if ($valid->fails()) {
            return $this->sendResponse($valid->errors()->all() , 500);
        }
        $user = User::where('email',$request->email)->first();
        if ($user && Hash::check($request->password,$user->password)){
            $token = $user->createToken('auth_token')->plainTextToken;
            return $this->sendResponse([
                'user' => $user,
                'token' => $token
            ]);
        }
        return $this->sendResponse('Invalid Credentials' ,500);
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return $this->sendResponse('Logged Out');
    }
    public function profile(Request $request){
        $data = [
            'name'=>$request->user()->name,
            'email'=>$request->user()->email,
            'phone'=>$request->user()->phone,
            'address'=>$request->user()->address,
        ];
        return $this->sendResponse($data);
    }
    public function changePassword(Request $request){
        $valid = Validator::make($request->all(),[
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8|max:60',
        ]);
        if ($valid->fails()) {
            return $this->sendResponse($valid->errors()->all() , 500);
        }
        $user = $request->user();
        if (Hash::check($request->old_password,$user->password)){
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return $this->sendResponse('Password Changed Successfully');
        }
        return $this->sendResponse('Invalid Password' ,500);
    }
    public function updateMe (Request $request){
        $user = User::find($request->user()->id);
        if ($request->has('password')){
            return $this->sendResponse('You can not change password here' , 500);
        }
        $valid = Validator::make($request->all(),[
            'email' => 'email|unique:users|max:100',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);
        if ($valid->fails()) {
            return $this->sendResponse($valid->errors()->all() , 500);
        }
        if ($request->has('image')){
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'),$image_name);
            $request['image'] = $image_name;
        }

        $user->update($request->all());

        return $this->sendResponse($user);
    }
    public function deleteMe(Request $request){
        $user = User::find($request->user()->id);
        $user->delete();
        return $this->sendResponse('Deleted Successfully');
    }
    public function forgotPassword(Request $request){
        $valid = Validator::make($request->all(),[
            'email' => 'required|email|exists:users',
        ]);
        if ($valid->fails()) {
            return $this->sendResponse($valid->errors()->all() , 500);
        }
        $user = User::where('email',$request->email)->first();
        if ($user){
            $code = rand(1111,9999);
            $user->update([
                'code' => $code
            ]);
            $status = Password::sendResetLink(
                $request->only('email')
            );
            // return $this->sendResponse('Code Sent Successfully');
            return $this->sendResponse($status);
        }
        return $this->sendResponse('Invalid Email' ,500);
    }
}
