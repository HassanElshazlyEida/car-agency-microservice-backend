<?php 
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CarUpdatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public array $car, public string $actionStatus
    )
    {
        
    }

    public function broadcastOn()
    {
        return new Channel('cars'); 
    }

    public function broadcastWith()
    {
        return [
            'car' => $this->car,
            'action_status' => $this->actionStatus, 
            'timestamp' => now(), 
        ];
    }
}