<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\TwitterUser;
use App\User;
use Auth;

class SocialController extends Controller
{
    public function getTwitterAuth() {
        return Socialite::driver('twitter')->redirect();
    }

    public function getTwitterAuthCallback() {
        try {
            $user = Socialite::with('twitter')->user();
            // $user->token;
            // 初めて来た人はユーザー登録、すでにIDがあるひとは、とってくる
            $authUser = $this->findOrCreateUser($user);
            // その後ログイン
            Auth::login($authUser, true);
            return redirect('home');
        } catch (\Exception $e) {
            return redirect('home');
        }
    }

    public function getFacebookAuth() {
        return Socialite::driver('facebook')->redirect();
    }

    public function getFacebookAuthCallback() {
        try {
            $fuser = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
            return redirect("/");
        }
        if ($fuser) {
            dd($fuser);
        } else {
            return 'something went wrong';
        }
    }

    public function getGoogleAuth() {
        return Socialite::driver('google')->redirect();
    }

    public function getGoogleAuthCallback() {
        try {
            $guser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect("/");
        }
        if ($guser) {
            dd($guser);

        } else {
            return 'something went wrong';
        }
    }
    
     /**
     * Return user if exists; create and return if doesn't
     *
     * @param $user
     * @return NewUser
     */
    private function findOrCreateUser($user)
    {
        //dd($twitterUser);
        $twitterUser = TwitterUser::where('twitter_user_id', $user->id)->first();
        
        if($twitterUser) {
            $authUser = $twitterUser->user;
            if ($authUser){
                return $authUser;
            }
            throw new \Exception("twitter userがいるけどuserテーブルに紐づいていない");
        }

        $newUser = User::create([
            'name' => $user->name,
            'email' => str_random(16)."@example.com", //仮で入れる
            'password' => bcrypt(str_random(16)), //仮で入れる
        ]);

        $twitter_user = new TwitterUser([
            'twitter_user_id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'nickname' => $user->nickname,
            'avatar' => $user->avatar,
            'token' => $user->token,
            'token_secret' => $user->tokenSecret,
        ]);

        $newUser->twitter_users()->save($twitter_user);
        return $newUser;
    }
}