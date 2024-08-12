<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginGoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $passrandom = Str::random(8);
            $googleUser = Socialite::driver('google')->user();
            
            $finduser = User::where('google_id', $googleUser->id)->first();
            
            if($finduser){
         
                Auth::login($finduser);
        
                return redirect()->route('frontend.index');
         
            }else{
                
                $newUser = User::updateOrCreate(
                    [
                        'email' => $googleUser->email,
                        'google_id' =>$googleUser->id,
                        'google_token' => $googleUser->token,
                        'name' => $googleUser->name,
                        'password' => Hash::make($passrandom),
                    ]);
                    
                Auth::login($newUser);
        
                return redirect()->route('frontend.index');
            }
        
        } catch (Exception) {
            return redirect()->route('userLogin.index')->with('error', 'Có lỗi xảy ra khi đăng nhập bằng Google!');
        }
    }
}
