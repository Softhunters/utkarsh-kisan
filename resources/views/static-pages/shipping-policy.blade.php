@extends('layouts.main1')



@section('content')
    <style>
        p, li {
      color: #4d4b4b !important;
   }
        /* .container {
            max-width: 95% !important;
        } */


        h1,
        h2,
        h3,
        h4 {
            color: var(--title-color1);
            font-family: var(--font-dosis);
        }

        h1 {
            font-size: 2.5rem;
            text-align: center;
            background: var(--gradient-color);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 30px;
        }

        h4 {
            margin-top: 30px;
            font-size: 1.25rem;
            border-left: 4px solid var(--primary-color3);
            padding-left: 12px;
        }

        ul {
            padding-left: 20px;
            margin: 10px 0;
        }

        a {
            color: var(--primary-color3);
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
            color: var(--primary-color3);
        }

        hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 30px 0;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 2rem;
            }

            .container {
                padding: 20px 15px;
            }
        }
           @media (min-width: 768px) {
  .container, .container-md, .container-sm {
     /* max-width: 1250px */
     max-width: 95%;
  }
}
 

@media screen  and (min-width:1500px) {
    .container, .container-md, .container-sm {
     /* max-width: 1250px */
     max-width: 1450px;
  }
}
    </style>


    <div class="container">
        <h1  >Shipping & Delivery Policy</h1>
        <p class="mb-0"><strong>Effective Date:</strong> 10-07-2025</p>
        <p><strong>Applicable To:</strong> All orders placed on Utkarsh Kisan (via mobile app or website)</p>

        <hr />


        <p> At <strong> Utkarsh Kisan, </strong> we are committed to ensuring timely, safe, and transparent delivery of all
            agricultural products ordered through our platform. This policy outlines our approach to <strong> shipping timelines,
            delivery processes, charges, </strong> and <strong> responsibilities </strong> of buyers and sellers.</p>

        <hr />

        <h4>1. Dispatch Timelines </h4>
        <ul>
             <li>Orders are typically dispatched by the seller within <strong> 24 to 48 business hours </strong> of confirmation.</li>
            <li>Sellers must ensure that items are packaged properly and dispatched as per the promised timeline.</li>
            <li>Certain perishable items may be dispatched the same day or next morning to maintain freshness.</li>
        </ul>

        <hr />

        <h4>2. Estimated Delivery Time</h4>
        <ul>
            <li>Estimated Delivery Time</li>
            <li>The estimated delivery time is 2 to 5 business days, depending on:</li>
            <ul>
                <li>Buyer's delivery location</li>
                <li>Seller’s dispatch location</li>
                <li>Availability of logistics partner in the delivery area</li>
            </ul>
            <li>In some remote or rural locations, delivery may take slightly longer due to accessibility.</li>
        </ul>

        <hr />

        <h4>3. Delivery Process ( mention as per our system )</h4>
         <ul>
            <li>Once dispatched, buyers receive:</li>
            <ul>
                <li>A tracking link via SMS/email/WhatsApp</li>
                <li>Order status updates through the app</li>
            </ul>
            <li>Delivery is completed through <strong> verified logistics partners, </strong> which may include third-party courier services or
                our in-house logistics.</li>
            <li>If the recipient is unavailable, <strong> two additional attempts </strong> may be made before the order is marked
                undeliverable.</li>
        </ul>

        <hr />

        <h4>4. Shipping Charges</h4>
        <ul>
           
            <li>Shipping charges, if applicable, are displayed at checkout before payment.</li>
            <li>Some products or regions may qualify for <strong> free delivery </strong> based on order value, product type, or promotional
                schemes.</li>
            <li>In case of cancellation before dispatch, shipping charges are refunded in full.</li>
        </ul>

        <hr />

        <h4>5. Non-Delivery or Delayed Delivery</h4>
        <p><strong> </strong></p>
        <ul>
            <li>If your order is not delivered within the specified time:</li>
            <ul>
                <li>You may raise a support request within <strong> 72 hours </strong> from the expected delivery date.</li>
                <li>Utkarsh Kisan will investigate with the seller and logistics provider.</li>
                <li>In case of delivery failure due to seller or logistics error, <strong> full refund </strong> will be issued.</li>
            </ul>
            <li>We are not responsible for delays caused by:</li>
            <ul>
                <li>Weather disruptions</li>
                <li>Lockdowns or government restrictions</li>
                <li>Natural disasters or regional unrest</li>
            </ul>
        </ul>

        <hr />

        <h4>6. Damaged Packages at Delivery</h4>
         <ul>
            <li>If a package appears <strong> damaged, tampered, or open  </strong> at the time of delivery:</li>
            <ul>
                <li>You are advised <strong> not to accept </strong> the delivery</li>
                <li>Immediately notify our support team with photos</li>
                <li>If accepted in error, you must raise a complaint within <strong> 6 hours of receipt </strong> along with photos</li>
            </ul>
            <li>Final resolution will be made by Utkarsh Kisan after verifying the complaint and coordinating with all
                parties.</li>
        </ul>

        <hr />

        <h4>7. Seller Obligations</h4>
         <ul>
            <li>All sellers on the platform must:</li>
            <ul>
                <li>Use packaging suitable for safe transport, especially for perishable or fragile items</li>
                <li>Dispatch only listed and verified items</li>
                <li>Ensure accurate weight and labeling</li>
                <li>Cooperate with logistics and customer support teams in case of issues</li>
            </ul>
            <li>Repeated failure to meet shipping standards may lead to penalties or removal from the platform.</li>
        </ul>

        <hr />

        <h4>8. Delivery Areas</h4>
        <p><strong> </strong></p>
        <ul>
            <li>Currently, Utkarsh Kisan offers delivery across:</li>
            <ul>
                <li> <strong> Tier 1, 2, and 3 cities </strong></li>
                <li><strong> Selected rural areas, </strong> based on logistics partner coverage</li>
            </ul>
            <li>Users will be notified during checkout if delivery is not available in their pincode</li>
            <li>We are actively expanding our delivery zones to serve more rural and semi-urban consumers.</li>
        </ul>

        <hr />

        <h4>9. Contact for Delivery Support</h4>
         <p>
            For order tracking, delay issues, or damaged delivery reports:
            <br /><br />
            <strong>Utkarsh Kisan Delivery Support</strong><br />
            Email:  <a href="mailto:info.utkarshkisan@gmail.com">info.utkarshkisan@gmail.com</a><br />
            phone:  +91-7425 900 711<br />
            Hours: Monday to Saturday, 10:00 AM to 6:00 PM IST
        </p>

    </div>
@endsection
