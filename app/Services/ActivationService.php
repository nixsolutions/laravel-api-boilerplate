<?php

namespace App\Services;

use App\Models\Activation;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use Mail;

/**
 * Class ActivationRepository
 * @package App\Repositories
 */
class ActivationService
{
    /**
     * Activation email template
     *
     * @var string
     */
    protected $activationEmailTemplate = 'emails.activation';

    /**
     * @param User $user
     *
     * @return string
     */
    public function createActivation(User $user)
    {
        $user->activation()->delete();

        $hash = Hash::make(str_random(50));
        $expired = Carbon::now()->addDay();

        Activation::insert([
            'user_id' => $user->id,
            'token'   => $hash,
            'expired' => $expired,
        ]);

        return $hash;
    }

    /**
     * @param User $user
     *
     * @return Activation
     */
    public function getActivation(User $user)
    {
        return $user->activation;
    }

    /**
     * @param string $token
     *
     * @return Activation
     */
    public function getActivationByToken(string $token)
    {
        return Activation::where('token', $token)->first();
    }

    /**
     * @param string $token
     *
     * @return bool
     */
    public function verifyEmail(string $token)
    {
        $activation = Activation::where('token', $token)->first();

        if ($activation) {
            $user = $activation->user;
            $user->activated = true;
            $user->save();
            $activation->delete();

            return $user;
        }

        return false;
    }

    /**
     *
     */
    public function deleteOldActivations()
    {
        $date = Carbon::now()->subDays(7);
        $activations = Activation::where('expired', '<', $date->toDateTimeString())->get();

        if (!$activations->isEmpty()) {
            User::destroy($activations->pluck('user_id'));
        }
    }

    /**
     * @param User $user
     * @param string $hash
     */
    public function sendActivationEmail(User $user, string $hash)
    {
        return Mail::send(
            $this->activationEmailTemplate,
            ['hash' => $hash],
            function ($message) use ($user) {
                $message->to($user->email, $user->usename)->subject('Laravel api boilerplate');
            }
        );
    }

    /**
     * @param $email
     * @return bool
     */
    public function resendActivationEmail($email)
    {
        $user = User::where('email', '=', $email)->first();

        if ($user->activated) {
            return false;
        }

        $hash = $this->createActivation($user);
        $this->sendActivationEmail($user, $hash);

        return true;
    }
}
