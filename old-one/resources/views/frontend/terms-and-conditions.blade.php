@extends('frontend.layouts.layout')
@section('title', 'Terms and Conditions - Turtle Maarks Hearing Health')
@section('description', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('keywords', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('content')



<!-- breadcrumb area -->
<div class="breadcrumb-area" style="background-image: url('{{ asset('assets/images/breadcrumb.png') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <h2 class="page-title">Terms and Conditions
                </h2>
                <ol class="breadcrumb text-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Terms and Conditions</li>
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
                    <h3 class="margin-bottom-20">TERMS AND CONDITIONS</h3>
                    <p>1. Goods once sold will not be taken back. </p>
                    <p> 2. In case payment is not made within the said period Interest at the rate of 18% p.a. shall be applicable on amount.  </p>
                    <p>3. Cheque bounce charges INR 500/-</p>
                    <p>4. No claims will be entertained without original bill. </p>
                    <p>5. No replacement of instrument shall be made in case of the following: </p>
                       <ul>
                           <li>a) Any damage caused to the hearing aid due to negligent handling and use by the customer,</li>
                           <li>b) Any damage caused to the hearing aid due to contact with water, </li>
                           <li>c) Any damage to the battery compartment due to improper use by the customer (battery leakage). </li>
                       </ul> <br>
                    <p>6. Turtle Maarks LLP cannot be held liable for any defects in the instrument. All concern related to manufacturing defect will be addressed by the OEM of the instrument.-</p>
                    <p>7. All disputes shall be subject to the exclusive jurisdiction of courts in Gautam Budh Nagar, UP.</p>
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
