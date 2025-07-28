@component('mail::message')
# New Order Received

Hi {{ $orderItem->seller->name ?? 'Vendor' }},

You have received a new order.

**Product:** {{ $orderItem->product->name }}  
**Quantity:** {{ $orderItem->quantity }}  
**Total Price:** ₹{{ $orderItem->price * $orderItem->quantity }}

@component('mail::panel')
Order ID: {{ $order->order_number }}  
Date: {{ $order->created_at->format('d M, Y') }}
@endcomponent

Thanks,  
{{ config('app.name') }}
@endcomponent
