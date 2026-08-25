@extends('frontend.layouts.layout')
@section('title', 'Return & Refund Policy - Turtle Maarks Hearing Health')
@section('description', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('keywords', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('content')

  




<!-- breadcrumb area -->
<div class="breadcrumb-area" style="background-image: url('{{ asset('assets/images/breadcrumb.png') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <h2 class="page-title">Return & Refund Policy
                </h2>
                <ol class="breadcrumb text-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Return & Refund Policy</li>
                </ol>
            </nav>
        </div>
    </div>
</div>




<!-- service wrapper -->
<div class="service-wrapper padding-top-70 padding-bottom-70">
    <div class="container">
        <div class="row">
            <!-- ser-main-con -->
            <div class="col-lg-12">
                <!-- ser-cont -->
                <div class="ser-cont wow fadeInUp">
                    <h3 class="margin-bottom-20">Return & Refund Policy</h3>
                        <h4 class="margin-bottom-20">Eligibility for Returns</h4>
                        <p><strong>Time Limit:</strong> 10 Days</p>
                        <p><strong>Product Condition:</strong></p>
                        <ul>
                          <li>No Physical damage</li>
                          <li>No Discolouration</li>
                          <li>In working condition</li>
                          <li>With Original packaging</li>
                          <li>With all tags, Stickers & warranty card</li>
                        </ul>
                        <h4 class="margin-top-20">Exclusions and Exceptions</h4>
                        <ul>
                          <li>Standard products can only be considered for return.</li>
                          <li>Custom made products such as CIC/ITC/ITE/IIC if returned, a minimum deduction of <strong>Rs 10,000/-</strong> each unit will be levied irrespective of the item price.</li>
                        </ul>
                            <h4 class="margin-top-20">Return Procedure</h4>
                            <ul>
                              <li>A written confirmation regarding return should be conveyed to our office/customer support through WhatsApp messages or e-mail within the prescribed time frame.</li>
                              <li>Item should reach our office within <strong>3 days</strong> of written communication. (Courier/delivery charges are the responsibility of the customer)</li>
                              <li>Our receiving team will check the suitability of item for return as per terms and conditions.</li>
                              <li>A written confirmation will be sent to the customer for refund eligibility with all details.</li>
                              <li>Customers must provide consent and share bank account details with IFSC code to initiate refund.</li>
                              <li>Payment will be initiated within <strong>2-3 working days</strong> upon customer’s confirmation.</li>
                            </ul>
                            <h4 class="margin-top-20">Refund Options</h4>
                            <ul>
                              <li><strong>Damaged goods:</strong> No refund, item will be returned to customer.</li>
                              <li><strong>Missing Packaging/Tags/Warranty cards/Stickers:</strong> Rs 2000/- will be deducted.</li>
                              <li><strong>Custom Products:</strong> Minimum Rs 10,000/- deduction per unit.</li>
                              <li><strong>Items in prescribed condition:</strong> Full refund within 2-3 working days.</li>
                            </ul>
                            <h4 class="margin-top-20">Processing Timeframes</h4>
                            <p>Refunds are usually processed within <strong>10-15 days</strong> from the initiation date.  
                            Delays in customer confirmation may extend the timeline.</p>
                            <h4 class="margin-top-20">Return Shipping Costs</h4>
                            <p>Return & Shipping costs are to be borne by the customer only.</p>
                            <h4 class="margin-top-20">Contact Information</h4>
                            <p><strong>Mobile:</strong> 8130495476</p>
                            <p><strong>Head Office:</strong> 0120-4406639</p>
                            <p><strong>Email:</strong> <a href="mailto:turtlemaarks@gmail.com">turtlemaarks@gmail.com</a></p>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- subs area -->
<div class="subs-area">
    <div class="container">
        <div class="row subs-wrapper">
            <div class="subs-shape">
                <img src="assets/images/subs-vec.png" alt="" class="vec1">
            </div>
            <div class="col-lg-12">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-xl-6 col-12">
                        <div class="subs-content">
                            <h2>subscribe to our newsletter</h2>
                        </div>
                    </div>
                    <div class="col-lg-7 col-xl-6 col-12">
                        <div class="subs-form">
                            <form action="#">
                                <input type="email" placeholder="Enter your email address">
                                <button type="submit">subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection     
