<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use JWTAuth;

class TwitterAuthController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('session');
        $this->middleware('jwt.auth', ['except' => ['redirect', 'handleProviderCallback']]);
    }

    public function redirect(Request $request){
        $url = Socialite::driver('twitter')->redirect()->getTargetUrl();
        \Log::info($request->session()->getId());
        \Log::info($request->session()->getName());
        \Log::info(json_encode($request->session()->get("oauth.temp")));
        $request->session()->keep("oauth.temp");
        return [
            'redirect_url' => $url
        ];
    }

    public function handleProviderCallback(Request $request)
    {
        \Log::info($request->session()->getId());
        \Log::info($request->session()->getName());
        \Log::info($request->session()->get("oauth.temp"));
        $request->session()->keep("oauth.temp");
        //$request->session()->regenerate();
        try {
            $user = Socialite::driver('twitter')->user();
            //            $user = Socialite::driver('twitter')->userFromTokenAndSecret($request->get("oauth_token"), $request->get("oauth_verifier"));;
        } catch (\Exception $e) {
            dd($e);
            //return redirect('api/oauth/twitter');
        }
        //return response()->json(\Request::all());
        $authUser = $this->findOrCreateUser($user);

        $token = JWTAuth::fromUser($authUser);

        //dd([$request->session(), $user, $token]);
        return response()->json(compact('user', 'token'));
    }

    public function getCurrentUser()
    {
        $user = JWTAuth::parseToken()->authenticate();
        return response()->json(compact('user'));
    }

    private function findOrCreateUser($twitterUser)
    {
        $authUser = User::where('twitter_id', $twitterUser->id)->first();
        if ($authUser){
            return $authUser;
        }

        return User::create([
            'name' => $twitterUser->name,
            'handle' => $twitterUser->nickname,
            'twitter_id' => $twitterUser->id,
            'avatar' => $twitterUser->avatar_original
        ]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
