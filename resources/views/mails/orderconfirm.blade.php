<x-mail::message>
<x-mail::panel>
    <h1 style="text-align:center; color:white;">Thank you for your order</h1>
</x-mail::panel>

<div>
    <p>Hi {{$order->name}},</p>
    <p>Just to let you know — we've received your order #{{$order->order_number}}, and it is now being processed:</p>
    <p>Pay with {{$order->transaction->mode == 'cod' ? 'Cash on Delivery' : 'Razorpay'}}</p>
    <h3 style="color:rgb(16, 124, 64) ;">[Order #{{$order->order_number}}] ({{$order->created_at->format('M-d-Y')}})</h3>
</div>

<div >
<x-mail::table>
| Product       | Quantity      | Price      |
| ------------- | :-----------: | ------------: |
@foreach($order->orderItems as $item)
| {{$item->product->name}} - {{$item->product->varaint_detail}}     | {{$item->quantity}}      | ₹{{$item->price * $item->quantity}}          |
@endforeach
</x-mail::table>

<x-mail::table>
|       |         |       |
| ------------- | :-----------: | ------------: |
| Subtotal:       |  | ₹{{$order->subtotal}}           |
| Tax:       |  | ₹{{$order->tax}}via          |
| Shipping:       |  | ₹{{$order->shipping_charge}}via          |

</x-mail::table>
<x-mail::table>
|       |         |       |
| ------------- | :-----------: | ------------: |
| Payment method:       |  | {{$order->transaction->mode == 'cod' ? 'Cash on Delivery' : 'Razorpay'}}           |
| Total:      |  |₹ {{$order->total}}    |
</x-mail::table>
</div>


<div style="display: flex; justify-content: space-between;margin-top:20px;">
<div>
    <p style="color:rgb(16, 124, 64) ; font-size: 20px;font-weight: 600;">Billing address</p>
    <div>
        <p class="height">{{$order->user->name}}</p>
        <p class="height">{{$order->line1}} <br>
                                    {{$order->line2}},{{$order->zipcode}},<br />
                                 {{$order->city->name??''}} 
        <p class="height">{{$order->state->name??''}}</p>
        <p class="height">{{$order->mobile}}</p>
        <p class="height"><a href="vikram.softhunters@gmail.com"></a></p>
    </div>
</div>
<div>
    <p style="color:rgb(16, 124, 64) ;font-size: 20px;font-weight: 600;">Shipping address</p>
    <div>
        <p class="height">{{$order->user->name}}</p>
        <p class="height">{{$order->user->email}}</p>
        <p class="height">{{$order->user->phone}}</p>
    </div>
</div>

</div>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>