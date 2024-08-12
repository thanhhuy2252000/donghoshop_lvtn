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

class LoginGithubController extends Controller
{
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }
    public function handleGithubCallback()
    {
        try {
            $passrandom = Str::random(8);
            $githubUser = Socialite::driver('github')->user();
            
            $finduser = User::where('github_id', $githubUser->id)->first();
            
            if($finduser){
         
                Auth::login($finduser);
        
                return redirect()->route('frontend.index');
         
            }else{
                
                $newUser = User::updateOrCreate(
                    ['email' => $githubUser->email,
                        'name' => $githubUser->name,
                        'github_id' => $githubUser->id,
                        'github_token' => $githubUser->token,
                        'password' => Hash::make($passrandom)
                    ]
                );
                    
                Auth::login($newUser);
        
                return redirect()->route('frontend.index');
            }
        
        } catch (Exception) {
            return redirect()->route('userLogin.index')->with('error', 'Có lỗi xảy ra khi đăng nhập bằng github !');
        }
    }
}
