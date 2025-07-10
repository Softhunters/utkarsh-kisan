<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Guzzle\Http\Exception\ClientErrorResponseException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;

class VendorOrderComponent extends Component
{

    public function updateOrderStatus($order_id, $status)
    {
        $order = Order::find($order_id);
        $order->status = $status;
        if ($status == "delivered") {
            $order->delivered_date = DB::raw('CURRENT_DATE');
            OrderItem::where('order_id', $order_id)->update(['rstatus' => '3', 'delivered_date' => DB::raw('CURRENT_DATE')]);
        } else if ($status == "canceled") {
            $order->canceled_date = DB::raw('CURRENT_DATE');
            $order_details = OrderItem::where('order_id', $order->id)->get();
            foreach ($order_details as $orderd) {
                // Product::where('id',$orderd->product_id)->decrement('order_qty', $orderd->quantity);
                $product = Product::find($orderd->product_id);
                $product->order_qty = $product->order_qty - $orderd->quantity;
                if ($product->quantity <= ($product->order_qty - $order->quantity)) {
                    $product->stock_status = "outofstock";
                }
                $product->save();
            }
            OrderItem::where('order_id', $order_id)->update(['rstatus' => '1', 'canceled_date' => DB::raw('CURRENT_DATE')]);
        } else if ($status == "accepted") {
            $order_details = OrderItem::where('order_id', $order->id)->get();
            foreach ($order_details as $orderd) {
                // Product::where('id',$orderd->product_id)->increment('order_qty', $orderd->quantity);
                $product = Product::find($orderd->product_id);
                $product->order_qty = $product->order_qty + $orderd->quantity;
                if ($product->quantity <= ($product->order_qty + $order->quantity)) {
                    $product->stock_status = "outofstock";
                }
                $product->save();
            }

            // $this->mkeorderapisd($order_id);
        } else if ($status == "rejected") {
            $order->canceled_date = DB::raw('CURRENT_DATE');
            OrderItem::where('order_id', $order_id)->update(['rstatus' => '1', 'canceled_date' => DB::raw('CURRENT_DATE')]);
        }

        $order->save();
        session()->flash('order_message', 'Order status has been updated Successfully!');
    }

    public function render()
    {

        $orders = Order::whereHas('orderItems', function ($query) {
            $query->where('orderitems.seller_id', Auth::id());
        })->with(['orderItems'])->get();
        // dd($orders[1]->transaction());
        return view('livewire.admin.order.vendor-order-component', ['orders' => $orders])->layout('layouts.vendor1');
    }


    public function makeorderapi($order_id)
    {
        $rt = Session::get('apitoken');
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer' . $rt
        ];
        $body = '{
        "order_id": "224-449",
      "order_date": "2024-02-29 11:11",
      "pickup_location": "Prima",
      "channel_id": "4810275",
      "comment": "Reseller: M/s Goku",
      "billing_customer_name": "Naruto",
      "billing_last_name": "Uzumaki",
      "billing_address": "House 221B, Leaf Village",
      "billing_address_2": "Near Hokage House",
      "billing_city": "New Delhi",
      "billing_pincode": "110002",
      "billing_state": "Delhi",
      "billing_country": "India",
      "billing_email": "naruto@uzumaki.com",
      "billing_phone": "9876543210",
      "shipping_is_billing": true,
      "shipping_customer_name": "",
      "shipping_last_name": "",
      "shipping_address": "",
      "shipping_address_2": "",
      "shipping_city": "",
      "shipping_pincode": "",
      "shipping_country": "",
      "shipping_state": "",
      "shipping_email": "",
      "shipping_phone": "",
      "order_items": [
        {
          "name": "Kunai",
          "sku": "chakra123",
          "units": 10,
          "selling_price": "900",
          "discount": "",
          "tax": "",
          "hsn": 441122
        }
      ],
      "payment_method": "Prepaid",
      "shipping_charges": 0,
      "giftwrap_charges": 0,
      "transaction_charges": 0,
      "total_discount": 0,
      "sub_total": 9000,
      "length": 10,
      "breadth": 15,
      "height": 20,
      "weight": 2.5
      }';

        $request = new \GuzzleHttp\Psr7\Request('POST', 'https://apiv2.shiprocket.in/v1/external/orders/create/adhoc', $headers, $body);
        //$res = $client->post('https://apiv2.shiprocket.in/v1/external/orders/create/adhoc',  ['headers'=>$headers,'body'=>$body]);
        $res = $client->sendAsync($request)->wait();
        dd($res->getBody());
        $results = $res->getBody();
        // $response = $res->send();

        dd($results);

    }


    public function mkeorderapisd($order_id)
    {

        $rt = Session::get('apitoken');
        $body = '{
        "order_id": "224-451",
      "order_date": "2024-02-29 11:11",
      "pickup_location": "Primay",
      "channel_id": "4810275",
      "comment": "Reseller: M/s Goku",
      "billing_customer_name": "Naruto",
      "billing_last_name": "Uzumaki",
      "billing_address": "House 221B, Leaf Village",
      "billing_address_2": "Near Hokage House",
      "billing_city": "New Delhi",
      "billing_pincode": "110002",
      "billing_state": "Delhi",
      "billing_country": "India",
      "billing_email": "naruto@uzumaki.com",
      "billing_phone": "9876543210",
      "shipping_is_billing": true,
      "shipping_customer_name": "",
      "shipping_last_name": "",
      "shipping_address": "",
      "shipping_address_2": "",
      "shipping_city": "",
      "shipping_pincode": "",
      "shipping_country": "",
      "shipping_state": "",
      "shipping_email": "",
      "shipping_phone": "",
      "order_items": [
        {
          "name": "Kunai",
          "sku": "chakra123",
          "units": 10,
          "selling_price": "900",
          "discount": "",
          "tax": "",
          "hsn": 441122
        }
      ],
      "payment_method": "Prepaid",
      "shipping_charges": 0,
      "giftwrap_charges": 0,
      "transaction_charges": 0,
      "total_discount": 0,
      "sub_total": 9000,
      "length": 10,
      "breadth": 15,
      "height": 20,
      "weight": 2.5
      }';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/orders/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $rt
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        dd($response);


    }
}
