@extends('site.layouts.layout')
@section('title', 'Shipping Policy - Turtle Maarks Hearing Health')
@section('description', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('keywords', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('content')


<!-- breadcrumb area -->
<div class="breadcrumb-area" style="background-image: url('{{ asset('frontend-assets/images/breadcrumb.png') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <h2 class="page-title">Shipping Policy
                </h2>
                <ol class="breadcrumb text-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shipping Policy</li>
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
                    <h3 class="margin-bottom-20">Shipping Policy <br>
                    Effective as of Jun 13, 2020</h3>
                    <p><strong>Order processing time:</strong></p>
                    <p>Standard Hearing aids order: 2-3 working days or immediate if stock available </p>
                    <p>Custom Hearing aids order: 7-10 working days  </p>
                    <p>Repairs: 7-10 working days from the date of items received at our end.</p>
                    <p><strong> Shipping costs : </strong> No shipping charges for out station deliveries. Our company has free shipping policy for all goods sold. </p>
                    <p><strong>Delivery methods and speeds :  </strong></p>
                       
                    <p>By Hand: For immediate and urgently required items at the places/cities of our operations</p>
                    <p>By Courier: 2-5 working days for cities where company does not have local setup.</p>
                    <p><strong>Shipping zones and restrictions :</strong>Currently shipping in India only. Future inclusions for International shipping will be updated as and when started.</p>
                    <h3>Contact Information</h3>
                      <p><strong>Mobile:</strong> <a href="tel:8130495476">8130495476</a></p>
                      <p><strong>Head Office:</strong> <a href="tel:01204406639">0120-4406639</a></p>
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
