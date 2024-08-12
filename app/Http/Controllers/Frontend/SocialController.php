<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;



class SocialController extends Controller
{
    // public function getInfo(){

    //     return Socialite::driver('facebook')->redirect();
    // }
    // public function checkInfo(){
    //     try {
    //         $user = Socialite::driver('facebook')->user();
    //         $finduser = User::where('email', $user->email)->first();
    //         if ($finduser) {
    //             Auth::login($finduser);
    //             return redirect()->route('showProducts.index');
    //         } else {
    //             $newUser = User::updateOrCreate(['email' => $user->email],[
    //                 'name' => $user->name,
    //                 'facebook_id' => $user->facebook_id,
    //                 'facebook_token' => $user->facebook_token,
    //                 'password' => Hash::make($user->password),
    //             ]);

    //             Auth::login($newUser);

    //             return redirect()->route('showProducts.index');
    //         }

    //     } catch (Exception) {
    //         return redirect()->route('userLogin.index')->with('error', 'Có lỗi xảy ra khi đăng nhập bằng Google!');
    //     }
           
    // }
}
