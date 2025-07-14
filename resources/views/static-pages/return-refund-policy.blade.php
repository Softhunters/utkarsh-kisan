@extends('layouts.main1')



@section('content')
 
   <style>
    p, li {
      color: #4d4b4b !important;
   }
     
   .container{
    max-width: 95% !important;
   }
   

    h1, h2, h3, h4 {
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
    <h1>Return & Refund Policy</h1>
    <p class="mb-0"><strong>Effective Date:</strong> 10-07-2025</p>
    <p><strong>Applies To:</strong> All Buyers and Sellers using the Utkarsh Kisan Platform</p>

    <hr />

     <p>At <strong>Utkarsh Kisan</strong>, we strive to ensure a fair, transparent, and efficient experience for both our buyers and sellers. However, due to the nature of agricultural products—many of which are <strong>perishable and time-sensitive </strong>-our return and refund policy has been designed to balance buyer protection, seller responsibility, and platform integrity.</p>

    <hr />

    <h4>1. General Policy Statement</h4>
    <p>Utkarsh Kisan operates as a <strong> neutral digital facilitator </strong> between sellers (farmers or vendors) and buyers (individuals, institutions, or retailers). While we do not own or manufacture the products, we take full responsibility for facilitating a smooth resolution process wherever issues arise.</p>
    <p>Returns and refunds are subject to <strong> specific eligibility conditions </strong> and are handled through a <strong> centralized process </strong> managed by Utkarsh Kisan.</p>

    <hr />

    <h4>2. Return Eligibility</h4>
    <p>A return request may be raised by the buyer within <strong>12 hours of delivery</strong> in the following cases:</p>
    <ul>
      <li> <strong> Incorrect product delivered </strong> (not matching the order) </li>
      <li> <strong> Damaged or spoiled goods </strong> at the time of delivery</li>
      <li> <strong> Expired  packaging </strong> (for non-perishables)</li>
      <li> <strong> Product not delivered at all, </strong> despite confirmation</li>
    </ul>
    <p><strong>Non-returnable products include:</strong></p>
    <ul>
      <li>Perishables (vegetables, fruits, grains, etc.), unless damaged or incorrect</li>
      <li> Products that have been used, altered, or tampered with </li>
      <li> Orders placed under discounted or promotional schemes (except in case of damage) </li>
    </ul>

    <hr />

    <h4>3. Refund Process</h4>
    <strong>Upon Valid Return:</strong>
    <p>If the return is approved: </p>
    <ul>
      <li>Refunds initiated within <strong> 3–7 business days </strong></li>
      <li>    Refunds will be processed via the <strong> original payment method </strong> or <strong> Utkarsh Wallet, </strong> as per user preference </li>
      <li>In case of UPI/bank delays, processing may extend up to <strong> 10 days </strong></li>
    </ul>

    <strong>In Case of Failed Delivery:</strong>
    <p> If an order is not delivered due to a seller-side issue, logistics delay, or cancellation by the company:  </p>
    <ul>
      <li>Full refund is initiated automatically</li>
      <li>No charges or deductions apply</li>
    </ul>

    <strong>Partial Refunds:</strong>
    <p>In some cases (bulk orders, partial delivery), a <strong> pro-rata refund  </strong> will be applied after review by our support team. .</p>

    <hr />

    <h4>4. Return Request Process( process recommendation what we have build for this ) </h4>
    <p>All return/refund requests must be raised <strong> through the app or website </strong></p>
    <ol>
      <li>Go to “My Orders”</li>
      <li>Select the relevant order</li>
      <li>Click “Request Return” or “Report Issue”</li>
      <li>Upload supporting photos (damaged product, wrong item, etc.) </li>
      <li>Support team will respond within <strong> 24 hours </strong></li>
    </ol>

    <hr />

    <h4>5. Buyer Responsibilities</h4>
    <ul>
      <li>Do not accept packages that appear tampered/damaged</li>
      <li>Report return issues promptly within the stated timeframe. </li>
      <li>Cooperate during inspection or pickup (if applicable)</li>
      <li>Provide clear (photo/video) proof for fast resolution</li>
    </ul>

    <hr />

    <h4>6. Seller Responsibilities</h4>
    <ul>
      <li>Ensure accuracy in listings, pricing, and product details. </li>
      <li> Pack products securely for transport. </li>
      <li>Avoid dispatching substandard or incorrect goods</li>
      <li>Cooperate with the company’s review and refund process when a valid return is raised.</li>
    </ul>
    <p>Sellers failing to maintain return standards may face <strong> temporary suspension, monetary penalties, </strong> or 

<strong> removal </strong> from the platform.</p>

    <hr />

    <h4>7. Utkarsh Kisan's Role</h4>
    <ul>
      <li>Act as an <strong> impartial reviewer </strong> in all return and refund cases.</li>
      <li>Maintain full transaction history, timestamp, and delivery logs for audit. </li>
      <li>Ensure buyer and seller are both notified and updated throughout the process. </li>
      <li>Make final decisions in <strong> disputed returns, </strong> based on documented evidence.</li>
    </ul>
    <p>Our decision in such cases will be final and binding to both parties, as agreed under the platform’s terms of use. </p>

    <hr />

    <h4>8. Force Majeure</h4>
    <p>We are not liable for returns or refunds caused by <strong> events outside our control, </strong> including but not limited to natural disasters, delivery partner strikes, pandemic lockdowns, or internet outages.</p>

    <hr />

    <h4>9. Contact for Return Issues</h4>
    <p>For any clarification or escalation, please contact:  </p>
    <p>
      <strong>Utkarsh Kisan Return Desk</strong><br />
      📧 Email: <a href="mailto:info.utkarshkisan@gmail.com">info.utkarshkisan@gmail.com</a><br />
      📞 Phone: +91-7425 900 711 (Mon–Sat, 10 AM to 6 PM)
    </p>
  </div>

 

@endsection