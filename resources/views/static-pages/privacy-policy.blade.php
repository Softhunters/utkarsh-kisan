@extends('layouts.main1')



@section('content')
 
  <style>
     
  /* @media (min-width: 768px) {
  .container, .container-md, .container-sm {
     
    max-width: 1350px
  }
} */
   p, li {
      color: #4d4b4b !important;
   }
   /* .container{
    max-width: 95% !important;
   } */
   

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
    <h1>Privacy Policy</h1>
    <p class="mb-0"><strong>Effective Date:</strong> 10-07-2025</p>
    <p><strong>Applicable To:</strong> All Users (Buyers, Sellers, Vendors, Visitors)</p>

    <p>At <strong>Utkarsh Kisan</strong>, we are committed to safeguarding your privacy and ensuring that your personal data is protected under applicable Indian law and international standards. This Privacy Policy explains how we collect, use, store, share, and protect your personal information when you access or use our mobile application, website, and services.</p>

    <p>By using our platform, you agree to the terms of this Privacy Policy.</p>

    <hr />

    <h4>1. Information We Collect</h4>
    <strong>Information You Provide Voluntarily:</strong>
    <ul>
      <li>Name, contact number, email address</li>
      <li>Address and delivery location</li>
      <li>Identification documents (for sellers/farmers)</li>
      <li>Bank details or payment account (only for seller payouts)</li>
      <li>Any feedback, queries, or content submitted by you</li>
    </ul>

    <strong>Automatically Collected Information:</strong>
    <ul>
      <li>Device type, browser, operating system</li>
      <li>IP address and location</li>
      <li>Usage patterns, page visits, and clicks</li>
      <li>App crash reports and logs (for technical diagnostics)</li>
    </ul>

    <strong>Cookies and Tracking Technologies:</strong>
    <ul>
      <li>We may use cookies or similar tracking technologies for session management, personalization, and analytics.</li>
      <li> You can control cookie preferences in your browser settings. </li>
    </ul>
   

    <hr />

    <h4>2. Purpose of Data Collection</h4>
    <ul>
      <li>Account creation and secure login</li>
      <li>Order processing, fulfillment, and delivery coordination</li>
      <li>Customer service and support</li>
      <li>Sending updates, notifications, and service communications</li>
      <li>Improving app and website functionality</li>
      <li>Ensuring legal and regulatory compliance</li>
      <li>Preventing fraud, unauthorized access, or misuse</li>
    </ul>
    <p><strong>Note:</strong> We do not sell or rent your personal data to third parties for marketing purposes.</p>

    <hr />

    <h4>3. Data Sharing and Disclosure</h4>
     
    <ul>
      <li>With verified delivery/logistics partners for order fulfillment</li>
      <li>With payment processors (Razorpay, UPI) during transactions</li>
      <li>With law enforcement or government authorities when legally required</li>
      <li>Internally, within Utkarsh Kisan, for service improvement and analytics</li>
    </ul>
    <p>All third-party service providers are bound by strict confidentiality agreements and data handling standards.</p>

    <hr />

    <h4>4. Data Security</h4>
    <p>We take comprehensive measures to protect your data:</p>
    <ul>
      <li>SSL encryption for data transmission</li>
      <li>Access control and role-based data access</li>
      <li>Secure servers and cloud storage (AWS/Firebase)</li>
      <li>Regular security audits and patching</li>
    </ul>
    <p>Despite our efforts, no method of transmission over the internet is 100% secure. We encourage users to protect their own login credentials and report any suspicious activity immediately.</p>

    <hr />

    <h4>5. Data Retention</h4>
    <p>We retain your personal data only for as long as necessary: </p>
    <ul>
      <li>For buyers: until account deletion or inactivity for 24 months</li>
      <li>For sellers: as per business compliance, KYC norms, and financial records (up to 7 years)</li>
      <li>For transactional data: as required by tax and regulatory authorities</li>
    </ul>
    <p>Upon deletion, your personal data will be securely erased or anonymized.</p>

    <hr />

    <h4>6. Your Rights</h4>
    <p>As a user, you have the right to:</p>
    <ul>
      <li>Access your data</li>
      <li>Request correction of inaccurate data</li>
      <li>Request deletion of your account and associated data</li>
      <li>Withdraw consent (where applicable)</li>
      <li>Lodge a complaint with the Data Protection Authority (if applicable)</li>
    </ul>
    <p>Requests can be made by writing to: <a href="mailto:info.utkarshkisan@gmail.com">info.utkarshkisan@gmail.com</a></p>

    <hr />

    <h4>7. Children's Privacy</h4>
    <p>Utkarsh Kisan is not intended for individuals under the age of 18. We do not knowingly collect data from minors. If you believe a minor has provided information, please contact us for immediate removal.</p>

    <hr />

    <h4>8. Cross-Border Data Transfers</h4>
    <p>While our primary servers are located in India, some technical services may involve cross-border data transfers. These are handled in accordance with international data transfer standards and Indian law.</p>

    <hr />

    <h4>9. Changes to This Policy</h4>
    <p>We may update this Privacy Policy from time to time. Users will be notified of significant changes via email or app notification. Continued use of the platform after such changes implies acceptance of the updated terms.</p>

    <hr />

    <h4>10. Contact Us</h4>
   <p> For questions or concerns regarding this Privacy Policy or your data: </p>
    <p>
      <strong>Privacy Officer</strong><br/>
      Utkarsh Kisan<br/>
      Email: <a href="mailto:info.utkarshkisan@gmail.com">info.utkarshkisan@gmail.com</a><br/>
      Phone: +91-7425 900 711<br/>
      Address: 508, Madhyam Marg, Mansarovar Sector 7, Agarwal Farm, Sector 9, Mansarovar, Jaipur, Rajasthan 302020
    </p>
  </div>

 


@endsection