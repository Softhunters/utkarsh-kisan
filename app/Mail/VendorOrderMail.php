<?php


namespace App\Mail;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VendorOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderItem;
    public $order;

    public function __construct(OrderItem $orderItem, Order $order)
    {
        $this->orderItem = $orderItem;
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('New Order Received')
                    ->markdown('emails.vendor.order');
    }
}
