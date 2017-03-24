<?php

namespace App\Services;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Mail;

/**
 * Class PasswordService
 * @package App\Services
 */
class PasswordService
{
    /**
     * @var string
     */
    protected $remindPasswordEmailTemplate = 'emails.reset';

    /**
     * @param $email
     *
     * @return bool
     */
    public function sendResetPasswordEmail($email)
    {
        $user = User::where('email', '=', $email)->first();

        if ($user) {
            $token = app('auth.password.broker')->createToken($user);

            Mail::send(
                $this->remindPasswordEmailTemplate,
                ['hash' => $token, 'email' => $email],
                function ($message) use ($user) {
                    $message->to($user->email, $user->usename)->subject('CarSoup');
                }
            );

            return true;
        }

        return false;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        if (Hash::check($request->get('current_password'), $user->password)) {
            $user->password = Hash::make($request['password']);
            $user->save();

            return true;
        }

        return false;
    }
}
