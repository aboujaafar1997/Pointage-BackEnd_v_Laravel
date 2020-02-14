<?php

namespace App\Http\Controllers\API;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\PayloadFactory;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $credentials = request(['email', 'password']);
       // $out->writeln(request(['email']));

     //  $customClaims = ['foo' => 'bar', 'baz' => 'bob'];
     
    //  $user = User::where( 'email', "aboujaafar.othmane@gmail.com" )->first();
    //  $payloadable = [
    //     'id' => "tokenPayload->id",
    //     'name' => "tokenPayload->name",
    //     'email' => "tokenPayload->email",
    //     'deleted_at' => "tokenPayload->deleted_at",
    //     'created_at' => "tokenPayload->created_at",
    //     'updated_at' => "tokenPayload->updated_at",
    //     'organization' => "request->organization_id"
    // ];
    // $token = JWTAuth::fromUser($user,$payloadable);
       


    
    // error_log($user->password);
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}