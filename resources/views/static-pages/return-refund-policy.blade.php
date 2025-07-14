@extends('layouts.main1')



@section('content')
<style>
    p{
        color: #5b6c8f;
    font-size: 16px;
    line-height: 20px;
    }
    li{
      color: #5b6c8f;
    font-size: 16px;
    /* line-height: 26px */
    }
    .ps-privacy__title{
  font-size: 50px;
  line-height: 60px;
  font-size: 34px;
  line-height: 40px;
  margin-bottom: 20px;
  text-align: center;
  color: #103178;
}
    
</style>
<div>
    <div class="container">
       <ul class="ps-breadcrumb">
            <li class="ps-breadcrumb__item"><a href="{{route('home')}}">Home</a></li>
            <li class="ps-breadcrumb__item active" aria-current="page">Return-Refund</li>
        </ul>
        <div class="ps-privacy_content">
            <div clas="row">
                <div class="col-md-12">
                    <h2 class="ps-privacy__title">RETURN-REFUND POLICY</h2>
                    <P style="color: #103178;"><b>Return</b></P>
                    <P>'Return' is defined as the action of giving back the item purchased by the Buyer to the Seller on the Indiherbo website.</P>
                    <P style="color: #103178;"><b>Replacement</b></P>
                    <P>'Replacement' is the action or process of replacing something in place of another. A Buyer can request for replacement whenever he is not happy with the item, reason being damaged in shipping, Defective item, Item(s) missing, wrong item shipped and the like. <br>
                        Buyer is asked for 'Reason for Return/Replacement'. Among others, the following are the leading reasons: <br>
                     </P>
                     <ul>
                        <li>Item was defective</li>
                        <li>Item was damaged during the Shipping</li>
                        <li>Products was/were missing</li>
                        <li>Wrong item was sent by the Seller</li>
                        <li>Item delivered had a size mismatch issue</li>
                        <li>Item was expired</li>
                        <li>Return could also result in refund of money in most of the cases</li>
                     </ul>
                     <p>An intimation shall be provided to Seller seeking either 'approval' or 'rejection' of the return/replacement request.</p>
                    <P style="color: #103178;"><b>Points to be noted:</b></P>
                    <p style="color: #103178;"><b>Seller can always accept the return/replacement irrespective of the policy.</b></p>
                    <P>If Seller disagrees a return/replacement request, Buyer can file a dispute. <br> <br>
                       We encourage the Buyer to review the listing before making the purchase decision. In case Buyer orders a wrong item, Buyer shall not be entitled to any return/refund. <br> <br>
                       Buyer needs to raise the return/replacement request within the return/replacement period applicable to the respective product along with photographs (of the parcel box as well as other products received) or other relevant proof as requested by Indiherbo. <br> <br>
                       Once Buyer has raised a return/replacement request by contacting us on Our Toll Free Number, Seller will return/replace the product only after the shipment is received by the seller and refund will be completed within 30 (thirty) days from date of reverse pick up. <br> <br>
                       In case the Seller doesn't have the product at all, Seller can provide the refund to the Buyer and Buyer shall be obligated to accept the refund in lieu of replacement. All the product parameters shall be required to be complied with in cases of replacement. <br> <br>
                       All shipping and other replacement charges shall be borne and incurred by the Seller. <br> <br>
                    </P>
                    <P style="color: #103178;"><b>Return Acceptance Conditions</b></P>
                    <P>Conveniently place your return request online by raising an issue in your Indiherbo account or by mailing us on our
                       Email: customer-indiherbo@gmail.com
                    </P>
                    <ul>
                        <li>In case of Wrong Product/Size Exchange issue can be raised within 7 days of order delivery along with photographs (of the parcel box as well as other products received) or other relevant proofs</li>
                        <li>If after opening the package customer discovers that the item is missing, the return request should be filed within 2 days of delivery along with photographs (of the parcel box as well as other products received) on our email.</li>
                        <li>In case of a damaged packaging, do not accept the delivery of that particular package. In case you have received it and later, after opening the package, discover that the item(s) is Damaged/Defective or the product is leaked, the return request should be filed within 2 days of delivery along with photographs (of the received parcel box as well as the product) on our e-mail</li>
                        <li>In case products delivered are past or near their expiry date (medicines with an expiry date of less than 6 months shall be considered as near expiry) return request can be raised within 7 days of order delivery along with photographs of products (Expiry date must be clearly visible in the attached photographs).</li>
                    </ul>
                    <P style="color: #103178;"><b>Important Points to Remember</b></P>
                    <ul>
                        <li>Please ensure that the product to be returned is in unused and original condition. Include everything you've received for the particular product you want to return like price tags, labels, invoice, original packing including box, freebies and accessories. In case the Product(s) returned by the customer does not fulfill these conditions then Indiherbo is not liable to re-conduct the delivery of the returned product(s).</li>
                        <li>In case where a customer had ordered multiple products and if one of the product(s) get damaged in transit then Indiherbo will either replace the damaged product(s) and not the complete order. In case of non-availability of the product(s) Indiherbo will refund the amount of only the damaged product(s) and not the complete order.</li>
                        <li>In case of Refunds, the entire amount paid by you including shipping charges are transferred to your account</li>
                        <li>Once your request to return an order is approved, a pickup will be initiated, after the product is received by us, it is verified against your claim and accordingly, replacement or refund is initiated.</li>
                        <li>In the rare scenario where a reverse pickup cannot be done in certain areas, you can ship the product through any other courier. In case of Self-Shipment, Indiherbo will reimburse your courier charges (max. upto Rs. 50).</li>
                        <li>Replacement is subject to availability of stock with the Seller. In case a Replacement is not available, Seller will refund the amount for the same.</li>
                    </ul>
                    <P style="color: #103178;"><b>Return/Replacement Non-Acceptance Conditions</b></P>
                    <ul>
                        <p>There are certain scenarios where it is difficult for us to support returns/replacements.</p>
                        <li>Return request is made outside the specified time frame.</li>
                        <li>Any wrong ordering or partially consumed strips or products do not qualify for return.</li>
                        <li>We shall not be liable for refunds/replacements for any incidental liquid leakage up to 25% of total product quantity as it may be a result of evaporation or courier handling etc.</li>
                        <li>Leakages above 25% shall be covered under our return/replacement policy.</li>
                        <li>Anything missing from the package related to the product including price tags, labels, invoice, original packing of product, parcel box, freebies and accessories.</li>
                        <li>Defective/damaged products that are covered under the manufacturer's warranty, for such products a buyer can directly call the manufacturer and avail the warranty.</li>
                        <li>Product is damaged due to misuse or Incidental damage by the customer.</li>
                        <li>Specific categories like elastic supports, stockings, bandages and tapes once used.</li>
                        <li>Specific categories like books are reading material and therefore not returnable once purchased.</li>
                        <li>Any consumable item that has been used or the seal is broken.</li>
                        <li>Products with tampered or missing serial numbers.</li>
                        <p>We assure you that all products sold on Indiherbo are brand new and 100% genuine. In case the product you received is 'Damaged', 'Defective' or 'Not as Described', our Friendly Returns policy has got you covered.</p>
                    </ul>
                    <P style="color: #103178;"><b>Indiherbo Replacement Guarantee:</b></P>
                    <P>If you have received a Wrong/Defective product you can return it to get a replacement within 7 days of delivery, in case of Damaged/Leaked/Missing Product, the Return request should be filed within 2 days of delivery. Please contact us with a replacement request or raise an issue in your Indiherbo account. The item will be recalled and a brand new replacement will be shipped to you at the earliest. <br> <br>
                       If you are not satisfied with the size of elastic supports delivered, you can request an exchange in a different size. (Please ensure that the product is in unused and original condition). <br> <br>
                       After the product is received by us, it is verified against your claim and accordingly, Replacement or Refund is initiated. <br> <br>
                       Indiherbo reserves the right to cancel the return request, in the event of fraudulent and unjustified complaints regarding the quality and content of the products. Under such conditions, the products will be discarded. <br> <br>
                    </P>
                    <P style="color: #103178;"><b>Return Process</b></P>
                    <P>
                        <ul>
                            <li style="list-style: none;">1.	For Return intimation, please visit www.Indiherbo.com</li>
                            <li style="list-style: none;">2.	Indiherbo customer care team will verify the claim made by the customer within 72 (seventy-two) business hours from the time of receipt of complaint.</li>
                            <li style="list-style: none;">3.	Once the claim is verified as genuine and reasonable, Indiherbo will initiate the collection of product(s) to be returned.</li>
                            <li style="list-style: none;">4.	The customer will be required to pack the product(s) in original manufacturer's packaging.</li>
                            <li style="list-style: none;">5.	Refund will be completed within 30 (thirty) days from date of reverse pick up (if required).</li>
                        </ul>
                    </P>
                    <P style="color: #103178;"><b>Cancellation Policy</b></P>
                    <P style="color: #103178;"><b>Customer cancellation</b></P>
                    <p>The customer can cancel the order for the product directly by logging in Indiherbo account till we ship it. Orders once shipped cannot be cancelled. <br>
                       After shipping if a customer still don't need the product he/she may refuse to accept it from the courier partner and we will initiate a refund after the product is received by us.
                    </p>
                    <P style="color: #103178;"><b>Other cancellations</b></P>
                    <P>Indiherbo also reserves the right to cancel any orders that our courier partners are unable to accept and service due to certain reasons. <br>               
                       Some other situations that may result in your order being cancelled include: <br>            
                    </P>
                   <ul>
                    <li>Non-availability of the product ordered by you</li>
                    <li>Errors in pricing information specified by our partners (sellers)</li>
                    <li>Non-availability of the quantities ordered by you</li>
                    <li>Any other reason beyond the control of Indiherbo</li>
                   </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection