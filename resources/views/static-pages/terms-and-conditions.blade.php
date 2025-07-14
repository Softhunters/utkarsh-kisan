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
    <h1>Terms & Conditions</h1>
    <p class="mb-0"><strong>Effective Date:</strong> 10-07-2025</p>
    <p><strong>Applies To:</strong> All users of the Utkarsh Kisan platform (buyers, sellers, vendors, and visitors)</p>

    <p>Welcome to <strong> Utkarsh Kisan, </strong> an agri-commerce platform operated by <strong> Utkarsh Kisan Pvt. Ltd. </strong> These Terms and Conditions govern your use of our mobile application, website, and associated services.</p>

    <p>By accessing or using Utkarsh Kisan, you agree to comply with and be legally bound by these terms. If you do not agree with any of the terms, you should not use the platform.</p>

    <hr />

    <h4>1. Definitions</h4>
    <p> <strong> "Platform" </strong> refers to the Utkarsh Kisan website and mobile application.</p>
    <p> <strong>"Buyer" </strong> means a user purchasing goods from the platform.</p>
    <p> <strong>"Seller"  or "Vendor"  </strong> refers to a registered farmer or verified seller listing agricultural goods.</p>
    <p> <strong> "User" </strong> includes both buyers and sellers, as well as visitors browsing the platform.</p>
    <p> <strong>"Company", "We", "Us", or "Our" </strong> refers to Utkarsh Kisan Pvt. Ltd.</p>

    <hr />

    <h4>2. Eligibility to Use</h4>
    <p>Users must be:</p>
    <ul>
      <li>At least <strong> 18 years </strong> of age</li>
      <li>Capable of entering into a legally binding contract under <strong> Indian law </strong></li>
      <li>Using accurate and verifiable personal and contact details</li>
    </ul>
    <p>We reserve the right to reject or disable any account at our discretion.</p>

    <hr />

    <h4>3. Account Registration</h4>
    <ul>
      <li>Users must provide valid information during account creation</li>
      <li>Sellers are required to submit <strong> KYC documents, </strong> including identity proof and bank details</li>
      <li>Users are responsible for maintaining confidentiality of their login credentials</li>
      <li>Any unauthorized activity must be reported immediately</li>
    </ul>

    <hr />

    <h4>4 .Platform Role and Limitations</h4>
    <ul>
      <li>Utkarsh Kisan acts solely as a <strong> digital facilitator/marketplace </strong></li>
      <li>We do <strong> not own, produce, or stock </strong> the products listed</li>
      <li>We facilitate listing, payment, logistics coordination, and customer support</li>
      <li>The platform shall not be liable for<strong> offline transactions </strong> or direct dealings outside the platform</li>
    </ul>

    <hr />

    <h4>5. Product Listings and Transactions</h4>
    <strong>For Sellers:</strong>
    <ul>
      <li>Must ensure that all products listed are <strong> genuine, legal, and of the stated quality </strong></li>
      <li>Prices should be fair and reflect market conditions</li>
      <li>Stock availability and dispatch timelines must be accurate</li>
      <li>Products must not infringe on any third-party rights or violate Indian law</li>
    </ul>

    <strong>For Buyers:</strong>
    <ul>
      <li>Must verify product details before placing an order</li>
      <li>Are responsible for maintaining a valid delivery address and accepting delivery</li>
      <li>Shall not attempt to cancel, dispute, or reverse payments without valid cause</li>
    </ul>

    <hr />

    <h4>6. Prohibited Conduct</h4>
    <p>Users agree <strong> not </strong> to:</p>
    <ul>
      <li>Post false or misleading information</li>
      <li>Upload harmful, illegal, or defamatory content</li>
      <li>Misuse referral codes or payment systems</li>
      <li>Create fake accounts or impersonate others</li>
      <li>Attempt to hack, disable, or disrupt the platform</li>
      <li>Initiate direct transactions that bypass the platform's system</li>
    </ul>
    <p>Violation of these terms may result in <strong> immediate suspension or permanent account termination. </strong></p>

    <hr />

    <h4>7. Payments and Charges</h4>
    <ul>
      <li>Payments must be made via authorized payment gateways</li>
      <li>Sellers may be charged platform commissions or transaction fees</li>
      <li>All payments are governed by Indian financial and e-commerce regulations</li>
      <li>The company reserves the right to revise charges with prior notice</li>
    </ul>

    <hr />

    <h4>8. Cancellations, Returns & Disputes</h4>
    <p>All cancellations, return requests, and refund processes are governed by our Return & Refund Policy. In case of a dispute:</p>
    <ul>
      <li>Users must raise issues through the platform’s resolution system</li>
      <li>Utkarsh Kisan will act as a <strong> neutral mediator </strong> </li>
      <li>Final decisions will be made based on platform records and submitted evidence</li>
    </ul>

    <hr />

    <h4>9. Intellectual Property</h4>
    <p>All content on Utkarsh Kisan — including branding, text, images, logos, and software — is the intellectual property of Utkarsh Kisan Pvt. Ltd. No part may be copied, reused, or reproduced without written permission.</p>

    <hr />

    <h4>10. Limitation of Liability</h4>
    <p>To the fullest extent permitted by law:</p>
    <ul>
      <li>Utkarsh Kisan shall not be held liable for product defects, delivery issues, or damages arising from third-party actions</li>
      <li>Our liability is limited to the value of the transaction or ₹1,000, whichever is lower</li>
    </ul>

    <hr />

    <h4>11. Governing Law and Jurisdiction</h4>
    <p>These terms are governed by the laws of <strong> India. </strong> All disputes arising under or in connection with these Terms and Conditions shall be subject to the exclusive jurisdiction of the <strong> courts in Jaipur, Rajasthan. </strong></p>

    <hr />

    <h4>12. Amendments</h4>
    <p>We reserve the right to update or modify these terms at any time. Updates will be notified on the platform or via email. Continued use after such updates constitutes acceptance.</p>

    <hr />

    <h4>13. Contact Information</h4>
    <p>For legal inquiries or to report a violation of these terms: </p>
    <p>
      <strong>Utkarsh Kisan Legal Desk</strong><br/>
      Email: <a href="mailto:info.utkarshkisan@gmail.com">info.utkarshkisan@gmail.com</a><br/>
      Phone: +91-7425 900 711<br/>
      Registered Office: 508, Madhyam Marg, Mansarovar Sector 7, Agarwal Farm, Sector 9, Mansarovar, Jaipur, Rajasthan 302020
    </p>
  </div>



@endsection