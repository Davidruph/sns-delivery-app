<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NewOrderNotification extends Notification
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
        return new BroadcastMessage([
            'title' => $this->title,
            'message' => $this->message,
            'link' => $this->link,
            'order_id' => $this->order->id,
            'created_at' => now()->toDateTimeString(),
        ]);
    }

    public function broadcastType()
    {
        return 'notification'; // This ensures it uses the notification channel
    }
}
