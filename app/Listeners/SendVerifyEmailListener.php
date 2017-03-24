<?php

namespace App\Listeners;

use App\Services\ActivationService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class SendVerifyEmailListener
 * @package App\Listeners
 */
class SendVerifyEmailListener implements ShouldQueue
{
    private $activationService;

    /**
     * SendVerifyEmailListener constructor.
     * @param ActivationService $activationService
     */
    public function __construct(ActivationService $activationService)
    {
        $this->activationService = $activationService;
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $hash = $this->activationService->createActivation($event->user);
        $this->activationService->sendActivationEmail($event->user, $hash);
    }
}
