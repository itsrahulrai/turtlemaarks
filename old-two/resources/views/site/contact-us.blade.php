@extends('site.layouts.layout')
@section('title', 'Contact us - Turtle Maarks Hearing Health')
@section('description', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('keywords', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('content')


<!-- breadcrumb area -->
<div class="breadcrumb-area" style="background-image: url('{{ asset('frontend-assets/images/breadcrumb.png') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <h2 class="page-title">Contact us
                </h2>
                <ol class="breadcrumb text-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact us </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- mcontact section -->
<div class="mcontact-section padding-top-120 padding-bottom-115">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 col-xl-6  wow fadeInUp">
                <div class="mcontact-left">
                    <div class="common-title">
                        <h2 class="margin-bottom-20">let us <span>help you</span></h2>
                    </div>
                    <div class="inner-con margin-bottom-30">
                        <div class="icon-box">
                            <span><i class="icofont-ui-call"></i></span>
                        </div>
                        <div class="cont-box">
                            <h5>support number <span>__</span></h5>
                            <h3>+91 8130495476 </h3>
                        </div>
                    </div>
                    <div class="support-box">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-6">
                                <div class="single-sup">
                                    <div class="icon-box">
                                        <span><i class="icofont-building"></i></span>
                                    </div>
                                    <h4 class="margin-bottom-20">office address</h4>
                                    <p>
                                        15th Floor, Gaur City Mall, 1509, Greater Noida W Rd, Gaur City 1, Sector IV, Sector 4, Noida, Ghaziabad, Uttar Pradesh 201306
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="single-sup">
                                    <div class="icon-box">
                                        <span><i class="icofont-live-support"></i></span>
                                    </div>
                                    <h4 class="margin-bottom-20">Online Support</h4>
                                    <p> turtlemaarks@gmail.com </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-6 wow fadeInUp">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.7994222767175!2d77.4299678!3d28.605793499999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cef575eaa2019%3A0x13228af08a69d9af!2sTurtle%20Maarks%20Hearing%20Health!5e0!3m2!1sen!2sin!4v1753273420559!5m2!1sen!2sin" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            </div>
        </div>
    </div>
</div>

<!-- mconform section -->
<div class="mconform-section padding-bottom-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 wow fadeInLeft">
                <div class="mconform-left">
                    <img src="{{ asset('frontend-assets/images/fea-1.png') }}" class="rounded" alt="">
                </div>
            </div>
            <div class="col-lg-6 wow fadeInRight">
                <div class="common-title margin-bottom-25">
                    <h4 class="margin-bottom-10">Send a Message, Don't be shy</h4>
                    <h2>Let's <span>Talk Today!</span></h2>
                </div>
               <div class="mconform-right">
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <input
                                name="name"
                                placeholder="Name"
                                required
                                class="inputBox"
                                type="text"
                            >
                        </div>

                        <div class="col-sm-6 col-12">
                            <input
                                name="email"
                                class="inputBox"
                                placeholder="Email Address"
                                required
                                type="email"
                            >
                        </div>

                        <div class="col-sm-6 col-12">
                            <input
                                name="phone"
                                class="inputBox"
                                placeholder="Phone Number"
                                required
                                type="tel"
                            >
                        </div>

                        <div class="col-12">
                            <textarea
                                name="message"
                                class="inputBox"
                                placeholder="Enter your text"
                            ></textarea>
                        </div>

                        <div class="col-12">
                            <button class="btn2" type="submit">
                                Send Now
                            </button>
                        </div>
                    </div>
                </form>
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
