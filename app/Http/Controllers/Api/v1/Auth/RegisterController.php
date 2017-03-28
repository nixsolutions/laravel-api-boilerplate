<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Helpers\Interfaces\ResponseCodesInterface;
use App\Helpers\JsonApiResponseHelper;
use App\Models\User;
use Auth;
use App\Services\ActivationService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller implements ResponseCodesInterface
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

    use RegistersUsers, JsonApiResponseHelper;

    /**
     * @var ActivationService
     */
    private $activationService;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * RegisterController constructor.
     * @param ActivationService $activationService
     */
    public function __construct(ActivationService $activationService)
    {
        $this->middleware('guest');

        $this->activationService = $activationService;
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
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return $user;
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
     *         @SWG\Property(property="password", type="string", example="password"),
     *         @SWG\Property(property="password_confirmation", type="string", example="password"),
     *         @SWG\Property(property="name", type="string", example="Steven")
     *     )
     *   ),
     *   @SWG\Response(response="200", description="Return message")
     * )
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $errors = $this->validator($request->all())->errors();

        if (!empty($errors->all())) {
            return $this->sendFailedResponse($errors->toArray(), self::HTTP_CODE_BAD_REQUEST);
        } else {
            event(new Registered($user = $this->create($request->all())));

            return $this->sendSuccessResponse();
        }

    }

    /**
     * Verify user account.
     *
     * @SWG\Post(path="/register/verify",
     *   tags={"User actions"},
     *   summary="Verify user's email",
     *   description="register form data validate and save",
     *   produces={"application/json"},
     *   consumes={"application/json"},
     *     @SWG\Parameter(
     *     in="body",
     *     name="verify object",
     *     description="JSON Object which verify email",
     *     required=true,
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(property="hash", type="string", example="12345678")
     *     )
     *   ),
     *   @SWG\Response(response="200", description="Return message")
     * )
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function verify(Request $request)
    {
        $user = $this->activationService->verifyEmail($request->get('hash'));

        if ($user) {
            $token = JWTAuth::fromUser($user);

            return $this->sendLoginResponse($token, $user);
        }

        $error = ['activation_hash' => ['Wrong activation hash']];

        return $this->sendFailedResponse($error, self::HTTP_CODE_BAD_REQUEST);
    }

    /**
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function sendLoginResponse($token, $user)
    {
        return response()->json([
            'data' => [
                'type' => 'token',
                'attributes' => [
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'email' => $user->email,
                    'id' => $user->id
                ]
            ]
        ]);
    }

}
