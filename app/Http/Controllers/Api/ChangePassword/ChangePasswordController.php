<?php

namespace App\Http\Controllers\Api\ChangePassword;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Hash;

class ChangePasswordController extends Controller
{
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function update(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string|max:255',
            'password' => 'bail|required|confirmed|min:6',
        ]);
        if (Hash::check($request->old_password, $request->user()->password)) {
            $request->user()->fill([
                'password' => Hash::make($request->password)
            ])->save();
            //event(new ChangePassword($request->user()));
            return response()->json([
                'message' => 'Password updated'
            ],200);
        }  else { 
            //     $validator->after(function ($validator) {
            //     $validator->errors()->add('password', 'Your old password does not match our records.');
            // });
            // event(new ChangePassword($request->user()));
            return response()->json([
                'errors' =>  'Your old password does not match our records'
            ],422);
        } 
        return false;
    }

}
