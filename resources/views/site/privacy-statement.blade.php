@extends('site.layouts.layout')
@section('title', 'Turtle Maarks LLP Privacy Statement - Turtle Maarks Hearing Health')
@section('description', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('keywords', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('content')



<!-- breadcrumb area -->
<div class="breadcrumb-area" style="background-image: url('{{ asset('frontend-assets/images/breadcrumb.png') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <h2 class="page-title">Turtle Maarks LLP Privacy Statement
                </h2>
                <ol class="breadcrumb text-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Turtle Maarks LLP Privacy Statement</li>
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
                    <h3 class="margin-bottom-20">Turtle Maarks LLP Privacy Statement <br> Effective as of Jun 13, 2020 </h3>
                    <p>At Turtle Maarks, trust is our prime value. This Privacy Statement describes how Turtle Maarks LLP collects, uses, shares or otherwise processes information relating to individuals (“Personal Data”) and the rights associated with that processing. </p>
                    <p> <strong>PRIVACY POLICY</strong>  </p>
                    <p>Our company has a comprehensive privacy policy in terms of sales context:</p>
                    <p><strong>Data We Collect : </strong> Name, address, mobile number, email address, payment details, purchase history taken during purchase is a confidential data of the client, and it is confined to Company’s data bank only, and in no circumstance shared with any other individual or agency. </p>
                    <p><strong> Purpose of Collection : </strong> The very purpose of collecting this data is to maintain your records with us for warranty claims, post sales communications and post sales services. Other purposes are:</p>
                       <ul>
                           <li><strong>Sales & Internal Use :  </strong> We use this data for internal sales tracking, understanding customer demographics, and for building customer loyalty programs.</li>
                           <li><strong>Marketing :   </strong> To send out promotional information or personalized content </li>
                       </ul> <br>
                    <p> <strong>Data Storage & Security : </strong> The details we collect remains with us for an infinite period. All the details collected are protected with management, and other than top management no one can access that. Our Records are maintained on Zoho Books (<strong>Zoho Books</strong> is one of the best accounting software options for small businesses) Zoho privacy policy can be viewed through the link; <a href="https://www.zoho.com/privacy.html">https://www.zoho.com/privacy.html</a> </p>
                    <p><strong>Third-Party Sharing : </strong> No data is shared with any third party.</p>
                    <p><strong>Customer Rights : </strong> All the customers have the right to know their details available with us. Details are taken with the consent of each customer. Any alteration and deletion is accepted in case of customer’s desire.</p>
                    <p> <strong> Consent & Opt-Outs : </strong> Details are collected with the consent of customers only</p>
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
                <img src="{{ asset('frontend-assets/images/subs-vec.png') }}" alt="" class="vec1">
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
