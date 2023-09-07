<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class PlaygroundEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private string $message;
    private User $user;

    /**
     * Create a new event instance.
     */
    public function __construct( $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // return [
        //     new PrivateChannel('channel-name'),
        // ];
        return [
            new PrivateChannel('public.chat.1'),
        ];
    }
    public function broadcastAs()
    {
        return 'playground';
    }
    public function broadcastWith()
    {
        return [
            'user' => $this->user->only(['name', 'email'])
        ];
    }
}
