@extends('layouts.main1')



@section('content')
    <style>
        p, li {
      color: #4d4b4b !important;
   }
        .container {
            max-width: 95% !important;
        }


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
    </style>
 
  <div class="container">
    <h1>Vendor / Farmer Terms & Conditions</h1>
    <p class="mb-0"><strong>Effective Date:</strong> 10-07-2025</p>
    <p><strong>Applies To:</strong> All registered sellers, vendors, and farmers on Utkarsh Kisan</p>

    <hr/>
 
    <p>These terms govern your registration, listing, and use of the Utkarsh Kisan platform as a <strong> seller </strong> (farmer, vendor, or agricultural producer). By listing your products, you agree to comply with these terms in full.</p>
    <p>Utkarsh Kisan acts as a <strong> neutral, digital facilitator </strong> and reserves the right to monitor, audit, suspend, or terminate any seller account found in violation of these policies.</p>

    <hr/>

    <h4>1. Seller Eligibility & Onboarding</h4>
     <ul>
      <li>Be a resident of India, aged 18 years or older</li>
      <li>Own or operate a farm, agri-business, or have legal rights to trade listed goods</li>
      <li>Submit valid <strong> KYC documents: </strong></li>
      <ul>
        <li>Aadhaar Card / PAN Card</li>
        <li>Bank Account details (for payments)</li>
        <li>Proof of farmland ownership or vendor registration (if applicable)</li>
      </ul>
      <li>Utkarsh Kisan reserves the right to verify all documents before approval.</li>
    </ul>

    <hr/>

    <h4>2. Product Listings</h4>
     <ul>
      <li>You may list only agricultural or agri-related products that:</li>
      <ul>
        <li>Are fresh, authentic, and not prohibited by Indian law</li>
        <li>Belong to you or are sourced legally</li>
        <li>Contain accurate product name, weight, grade, variety, and pricing</li>
        <li>Include correct dispatch timelines and available stock</li>
        <li>Are free from adulteration, false claims, or misleading descriptions</li>
      </ul>
      <li>Any false or misleading listings will result in immediate suspension.</li>
    </ul>

    <hr/>

    <h4>3. Order Fulfillment & Dispatch</h4>
     <ul>
      <li>Accept orders promptly as notified via the app or dashboard</li>
      <li>Dispatch products within <strong> 24–48 business hours </strong> </li>
      <li>Use clean and secure packaging as per product category</li>
      <li>Handover to delivery partner as instructed by Utkarsh Kisan</li>
    </ul>
    <p>Failure to dispatch on time may lead to automatic cancellation or penalties.</p>

    <hr/>

    <h4>4. Payment Terms</h4>
     <ul>
      <li>Sellers will receive payments <strong> after successful delivery </strong> and no return claims from the buyer.</li>
      <li>Payouts are processed within <strong> 3–5 business days </strong> to your registered bank account.</li>
      <li>Platform service charges (commission, if any) will be clearly communicated and deducted before payout.</li>
    </ul>
    <p>You are responsible for maintaining valid bank account and GST details (if applicable).</p>

    <hr/>

    <h4>5. Returns, Refunds & Disputes</h4>
     <ul>
      <li>In case of a return due to <strong> damaged, expired, or incorrect products, </strong> the seller is liable to bear the cost.</li>
      <li>Repeated return cases may lead to <strong> review or delisting.</strong> </li>
      <li>Disputes are resolved by Utkarsh Kisan’s customer support based on evidence and policies.</li>
      <li>The seller agrees to accept Utkarsh Kisan’s final resolution in all dispute matters. You may raise counterclaims through the proper in-app support channels.</li>
    </ul>

    <hr/>

    <h4>6. Prohibited Activities</h4>
    <p> You may <strong> not </strong>:<p>
     <ul>
      <li>List counterfeit or banned agricultural items</li>
      <li>Manipulate product ratings or buyer reviews</li>
      <li>Communicate directly with buyers outside the platform to bypass commission</li>
      <li>Share fake documents or unauthorized inventory</li>
      <li>Delay order dispatch intentionally or repeatedly</li>
    </ul>
    <p>Violation may result in <strong> suspension, withholding of payments, </strong> or permanent blacklisting.</p>

    <hr/>

    <h4>7. Seller Conduct & Obligations</h4>
     <ul>
      <li>Maintain a minimum order acceptance rate as defined by the platform</li>
      <li>Update product stock regularly to avoid false availability</li>
      <li>Cooperate with support and logistics for any complaints or returns</li>
      <li>Maintain professional and honest conduct at all times</li>
    </ul>

    <hr/>

    <h4>8. Platform Rights</h4>
     <ul>
      <li>Modify or remove any product listing without prior notice</li>
      <li>Withhold payments if fraud or dispute is suspected</li>
      <li>Audit seller performance periodically</li>
      <li>Modify these terms with or without notice, as per business or legal requirements</li>
    </ul>

    <hr/>

    <h4>9. Compliance & Legal Liability</h4>
     <ul>
      <li>You agree to comply with:</li>
      <ul>
        <li>All Indian agriculture and trade laws</li>
        <li>FSSAI guidelines (if selling food items)</li>
        <li>Tax regulations, GST laws, and digital commerce standards</li>
      </ul>
    </ul>
    <p>You are solely responsible for your income tax, GST filings, and any applicable local licensing.</p>

    <hr/>

    <h4>10. Termination</h4>
     <ul>
      <li>Your seller account may be terminated for:</li>
      <ul>
        <li>Breach of platform policies or legal regulations</li>
        <li>Fraudulent listings or repeated customer complaints</li>
        <li>Refusal to cooperate with platform policies</li>
      </ul>
    </ul>
    <p>All dues will be cleared post-verification of pending deliveries and return claims.</p>

    <hr/>

    <h4>11. Contact for Seller Support</h4>
     <p>
      For questions, onboarding help, or disputes, reach out to:
      <br/><br/>
      <strong>Utkarsh Kisan Vendor Desk</strong><br/>
      Email: <a href="mailto:info.utkarshkisan@gmail.com">info.utkarshkisan@gmail.com</a><br/>
      phone: +91-7425 900 711<br/>
      Hours: Monday to Saturday, 10:00 AM – 6:00 PM IST
    </p>
  </div>
 
@endsection
