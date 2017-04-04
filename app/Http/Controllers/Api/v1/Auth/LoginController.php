<?php

namespace App\Http\Controllers\Api\v1\Auth;

use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Helpers\JsonApiResponseHelper;
use Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, JsonApiResponseHelper;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Handle a login request to the application.
     *
     * @SWG\Post(path="/login",
     *   tags={"User actions"},
     *   summary="Perform user sign in",
     *   description="login user using request data",
     *   produces={"application/json"},
     *   consumes={"application/json"},
     *     @SWG\Parameter(
     *     in="body",
     *     name="login user",
     *     description="JSON Object which login user",
     *     required=true,
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(property="email", type="string", example="user@mail.com"),
     *         @SWG\Property(property="password", type="string", example="password"),
     *     )
     *   ),
     *   @SWG\Response(response="200", description="Return token or error message")
     * )
     *
     * @param Request $request
     *
     * @return Response
     */
    public function login(Request $request)
    {
        $errors = $this->validateLogin($request->all())->errors();
        if (!empty($errors->all())) {
            return $this->sendFailedResponse($errors->toArray(), 401);
        }

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($token = Auth::guard('api')->attempt($this->credentials($request))) {
            if (Auth::guard('api')->user()->activated) {
                return $this->sendLoginResponse($request, $token);
            } else {
                $error = [
                    'source' => ['email' => $request->get('email')],
                    'email' => ['Email not verified']
                ];
                return $this->sendFailedResponse($error, 403);
            }

        }

        $this->incrementLoginAttempts($request);

        $error = [
            'email' => ['Invalid credentials. Please check login/password and try again']
        ];

        return $this->sendFailedResponse($error, 401);
    }

    /**
     * @param Request $request
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function sendLoginResponse(Request $request, $token)
    {
        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user(), $token);
    }

    /**
     * @param Request $request
     * @param $user
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function authenticated(Request $request, $user, $token)
    {
        $user = Auth::guard('api')->user();

        return response()->json([
            'data' => [
                'type' => 'token',
                'attributes' => [
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'email' => $user->email,
                    'id' => $user->id,
                    'token' => 'Bearer ' . $token,
                ]
            ]
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @SWG\Get(path="/logout",
     *   tags={"User actions"},
     *   summary="Perform user logout",
     *   description="logout user",
     *   produces={"application/json"},
     *   @SWG\Response(response="200", description="Return token or error message")
     * )
     *
     * @return Response
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json([
        ], 200);
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function validateLogin(array $data)
    {
        $messages = [
            'required'  => ':attribute field can\'t be blank'
        ];

        return Validator::make($data, [
            'email' => 'required',
            'password' => 'required'
        ], $messages);
    }
}
