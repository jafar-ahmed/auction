<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        $email = $request['email'];
        $password = $request['password'];
        $user=User::where('email',$email)->first();
        if(!$user){
            return response()->json($this->result(false, __('app.No membership'), 404));
        }
        if (!(Hash::check($password, $user->password))) {
            return response()->json($this->result(false, __('app.wrong password'), 404));
        }
        if (!$user->email_verified_at) {
            return response()->json($this->result(false, __('app.Your Account have been verified via email'), 404));
        }
        // if ($user->deactivated_at != "") {
        //     return response()->json($this->result(false, __('app.Sorry, Your Account have been deactivated at ') . $user->deactivated_at, 404));
        // }
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!($token = auth()->attempt($validator->validated()))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    // public function Login(LoginRequest $request)
    // {

    //     try {
    //         $email = $request['email'];
    //         $password = $request['password'];
    //         //$route = 'admin.home';

    //         $user = User::where('email', $email)->whereIn('role', ['super', 'store'])->first();
    //         if (!$user) {
    //             return response()->json($this->result(false, __('app.No membership'), 404));
    //         }
    //         if (!(Hash::check($password, $user->password))) {
    //             return response()->json($this->result(false, __('app.wrong password'), 404));
    //         }
    //         if (!$user->verified_at) {
    //             return response()->json($this->result(false, __('app.Your Account have been verified via email'), 404));
    //         }
    //         // if ($user->deactivated_at != "") {
    //         //     return response()->json($this->result(false, __('app.Sorry, Your Account have been deactivated at ') . $user->deactivated_a, 404));
    //         // }
    //         $user->generateToken();
    //         $this->guard()->user();
    //         $user->save();
    //         if ($user->role == 'super') {
    //             $route = 'super.home';
    //         }

    //         Auth::loginUsingId($user->id);

    //         return $this->result(true, __('app.Logined successfully'), 200, ['route' => route($route)]);
    //     } catch (\Exception $exception) {
    //         return $this->unexpectedMessage();
    //     }
    // }


    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'contacts' => 'required|int',
            'avatar' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge($validator->validated(), ['password' => bcrypt($request->password)]));
        return response()->json(
            [
                'message' => 'User successfully registered',
                'user' => $user,
            ],
            201,
        );
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth()->user());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token _type' => 'bearer',
            'expires_in' =>
            auth()
                ->factory()
                ->getTTL() * 60,
            'user' => auth()->user(),
        ]);
    }
}
