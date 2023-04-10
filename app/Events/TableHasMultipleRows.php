<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TableHasMultipleRows implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $tableName;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    public function broadcastOn()
    {//
       // return new PrivateChannel('my-channel.'.$this->tableName);
       return ['my-channel'];
    }
    public function broadcastAs()
    {
        return 'my-event';
    }
}