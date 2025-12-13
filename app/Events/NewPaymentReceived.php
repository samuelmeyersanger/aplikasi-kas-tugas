<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast; // Tambahkan ini
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Pembayaran;

class NewPaymentReceived implements ShouldBroadcast // Implement interface ini
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pembayaran;

    public function __construct(Pembayaran $pembayaran)
    {
        $this->pembayaran = $pembayaran;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('admin-notifications'), // Channel khusus admin
        ];
    }
}