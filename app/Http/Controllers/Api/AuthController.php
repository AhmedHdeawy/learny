<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HasJsonResponse;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Validator;

class AuthController extends Controller
{

    use HasJsonResponse;

    /**
     * Login the user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'password' => 'required',
        ]);

        $credentials = request(['code', 'password']);
        
        // Check if User is Exist
        $user = User::where('code', $credentials['code'])->first();

        // Check Phone and Password
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return $this->jsonResponse(401, 'Code or Password is Incorrect', 'Unauthorized.');
        }

        // Login the USER
        Auth::login($user);

        // Get User Access Token
        $token = $this->getAccessToken($request, $user);

        // Response Data
        $data = [
            'user'    =>  Auth::user(),
            'token'         =>  $token,
        ];
        
        return $this->jsonResponse(200, 'Logged in Successfully', null, $data);
        
    }

    /**
     * [logout User]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function logout(Request $request)
    {
        $request->user('users')->token()->revoke();
     
        return $this->jsonResponse(200, 'Successfully Logged Out !');
    }


    /**
     * [getAccessToken Data]
     * @param  Request $request [description]
     * @param  Model   $user   [description]
     * @return [type]           [description]
     */
    public function getAccessToken(Request $request, User $user): array
    {
        $tokenResult = $user->createToken('Ringler');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(52);
        $token->save();
        return [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ];
    }



}
