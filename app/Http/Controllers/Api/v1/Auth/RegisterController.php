<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Models\User;
use Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @SWG\Post(path="/register",
     *   tags={"User actions"},
     *   summary="Perform user registration",
     *   description="register form data validate and save",
     *   produces={"application/json"},
     *   consumes={"application/json"},
     *     @SWG\Parameter(
     *     in="body",
     *     name="register object",
     *     description="JSON Object which register user",
     *     required=true,
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(property="email", type="string", example="user@mail.com"),
     *         @SWG\Property(property="password", type="string", example="12345678"),
     *         @SWG\Property(property="password_confirmation", type="string", example="12345678"),
     *         @SWG\Property(property="name", type="string", example="Steven")
     *     )
     *   ),
     *   @SWG\Response(response="200", description="Return message")
     * )
     *
     * @param Request $request
     *
     * @return Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        Auth::guard('api')->login($user);

        return response()->json([
            'message' => trans('Registered successfully. Please verify your email'),
        ]);
    }
}
