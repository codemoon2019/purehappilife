<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationMessage implements ShouldBroadcast
{
    
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
  
    public function __construct($message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return ['my-event'];
    }
  
    public function broadcastAs()
    {
        return 'my-event';
    }

}
