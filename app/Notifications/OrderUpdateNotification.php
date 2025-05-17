<?php

namespace App\Notifications;

use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderUpdateNotification extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    protected $order;
    protected $title;
    protected $message;
    protected $link;

    public function __construct($order, $title = null, $message = null, $link = null)
    {
        $this->order = $order;
        $this->title = $title ?? 'New Order Received';
        $this->message = $message ?? "Order #{$order->id} has been placed.";
        $this->link = $link ?? route('order.view', $order->id);
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'link' => $this->link,
            'order_id' => $this->order->id,
        ];
    }

    public function toBroadcast($notifiable)
    {
        Log::info('Sending broadcast message to user ' . $notifiable->id, $this->broadcastWith());
        return new BroadcastMessage($this->broadcastWith());
    }

    public function broadcastOn()
    {
        return new PrivateChannel('App.Models.User.' . $this->order->user_id);
    }

    public function broadcastAs()
    {
        return 'order_message';
    }

    public function broadcastWith()
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'link' => $this->link,
            'time' => now()->diffForHumans(),
        ];
    }
}
