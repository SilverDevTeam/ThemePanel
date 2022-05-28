<?php

namespace Pterodactyl\Listeners\Auth;

use Pterodactyl\Facades\Activity;
use Pterodactyl\Events\Auth\ProvidedAuthenticationToken;

class TwoFactorListener
{
    public function handle(ProvidedAuthenticationToken $event)
    {
        Activity::event($event->recovery ? 'login.recovery-token' : 'login.token')
            ->withRequestMetadata()
            ->subject($event->user)
            ->log();
    }
}