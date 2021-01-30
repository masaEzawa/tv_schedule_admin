<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Events\Event;

/**
 * ログインした時のイベント
 * App\Handlers\Events\LoginedHandler.phpと連動する
 */
class LoginedEvent extends Event
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( User $user )
    {
        $this->user = $user;
    }

}
