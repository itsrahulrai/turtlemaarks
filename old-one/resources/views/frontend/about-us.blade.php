@extends('frontend.layouts.layout')
@section('title', 'About us - Turtle Maarks Hearing Health')
@section('description', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('keywords', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('content')

<!-- breadcrumb area -->
<div class="breadcrumb-area" style="background-image: url('{{ asset('assets/images/breadcrumb.png') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <h2 class="page-title">About us
                </h2>
                <ol class="breadcrumb text-center">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About us</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- booking-area -->
 @include('frontend.includes.booking')


<!-- about area -->
<div class="about-area padding-top-50 padding-bottom-50">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-6 col-xl-5">
                <div class="about-left">
                    <img src="{{ asset('assets/images/about-us.jpg') }}" alt="" class="main-img rounded">
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-7">
                <div class="about-right">
                    <div class="common-title">
                        <h2>Turtle Maarks <br>
                            <span>Hearing Health</span>
                        </h2>
                    </div>
                    <p class="margin-top-20" style="text-align: justify;">
                        At our center, we are committed to enhancing lives through expert hearing care and speech solutions. As trusted providers of <strong> hearing aids from all leading global brands,</strong> we ensure our clients receive the best in technology, comfort, and support. Whether you're experiencing hearing difficulties or looking for advanced audiological solutions, our team is here to guide you every step of the way.
                    </p>
                    <p class="margin-top-20" style="text-align: justify;">
                        We offer <strong> comprehensive audiological evaluations </strong> conducted by <strong> RCI-registered Audiologists, </strong> accurate diagnosis and personalized recommendations tailored to your unique hearing needs.
                    </p>
                    <p class="margin-top-20" style="text-align: justify;">
                        In addition to hearing care, we provide <strong> specialized Speech Therapy </strong> services for individuals of all ages dealing with speech and language disorders. Our certified speech-language pathologists work with patients compassionately to overcome challenges in communication, language development, articulation, fluency, and more.
                    </p>
                    <div class="btn-box margin-top-20">
                        <a href="{{ url('contact-us') }}" class="btn2">contact now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row about-counter margin-top-60">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="single-counter">
                    <div class="icon-box">
                        <span><i class="icofont-stethoscope-alt"></i></span>
                    </div>
                    <div class="cont-box">
                        <h3 class="counter">240</h3>
                        <h6 class="margin-top-20">Quality doctors</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="single-counter">
                    <div class="icon-box">
                        <span><i class="icofont-users-alt-4"></i></span>
                    </div>
                    <div class="cont-box">
                        <h3 class="counter">1450</h3>
                        <h6 class="margin-top-20">our Patients</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="single-counter">
                    <div class="icon-box">
                        <span><i class="icofont-prescription"></i></span>
                    </div>
                    <div class="cont-box">
                        <h3 class="counter med-fil">1.1</h3>
                        <h6 class="margin-top-20">medical filled</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="single-counter">
                    <div class="icon-box">
                        <span><i class="icofont-simple-smile"></i></span>
                    </div>
                    <div class="cont-box">
                        <h3 class="counter med-fil">2.3</h3>
                        <h6 class="margin-top-20">happy patient</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="emergency-area padding-top-120 padding-bottom-120">
    <div class="emer-shapes">
        <img src="{{ asset('assets/images/emergemcy_vec1.png') }}" alt="" class="vec1">
        <img src="{{ asset('assets/images/emergemcy_vec2.png') }}" alt="" class="vec2">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="emergency-cont">
                    <div class="img-box">
                        <img src="{{ asset('assets/images/emergemcy_vec3.png') }}" alt="">
                    </div>
                    <div class="cont-box common-title2">
                        <h3 class="margin-bottom-30">Home visit available for <br> Senior citizens free of cost.</h3>
                        <span class="tel_btn"><span><i class="icofont-telephone"></i></span>
                            <a href="tel:8130495476" class="text-white"> +91 8130495476 </a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ht-team area -->
<div class="ht-team-area  padding-top-115 padding-bottom-90">
    <div class="team-shapes">
        <img src="{{ asset('assets/images/team-vec2.png') }}" alt="" class="vec1 item-animateOne">
        <img src="{{ asset('assets/images/team-vec3.png') }}" alt="" class="vec2 item-rotate2">
    </div>
    <div class="container">
        <div class="row justify-content-center wow fadeInUp margin-bottom-45">
            <div class="col-lg-7">
                <div class="common-title2 text-center">
                    <h2>Our Expertise Team</h2>
                    <p class="margin-top-20">
                        Our team comprises experienced audiologists, hearing care specialists, and support professionals who are passionate about improving lives through better hearing.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 wow fadeInUp">
                <div class="single-team-2">
                    <div class="img-box">
                        <img src="{{ asset('assets/images/team/team-01.webp') }}" style="border-radius:10px;" alt="">
                    </div>
                    <div class="cont-box">
                        <h4 class="margin-bottom-10"><a href="javascript:void(0)">
                                Name of Employee
                            </a></h4>
                        <h6 class="margin-bottom-10">Position</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 wow fadeInDown">
                <div class="single-team-2">
                    <div class="img-box">
                        <img src="{{ asset('assets/images/team/team-02.webp') }}" style="border-radius:10px;" alt="">
                    </div>
                    <div class="cont-box">
                        <h4 class="margin-bottom-10"><a href="javascript:void(0)">
                                Name of Employee
                            </a></h4>
                        <h6 class="margin-bottom-10">Position</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 wow fadeInUp">
                <div class="single-team-2">
                    <div class="img-box">
                        <img src="{{ asset('assets/images/team/team-03.webp') }}" style="border-radius:10px;" alt="">
                    </div>
                    <div class="cont-box">
                        <h4 class="margin-bottom-10"><a href="javascript:void(0)">
                                Name of Employee
                            </a></h4>
                        <h6 class="margin-bottom-10">Position</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 wow fadeInUp">
                <div class="single-team-2">
                    <div class="img-box">
                        <img src="{{ asset('assets/images/team/team-01.webp') }}" style="border-radius:10px;" alt="">
                    </div>
                    <div class="cont-box">
                        <h4 class="margin-bottom-10"><a href="javascript:void(0)">
                                Name of Employee
                            </a></h4>
                        <h6 class="margin-bottom-10">Position</h6>
                    </div>
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
                <img src="{{ asset('assets/images/subs-vec.png') }}" alt="" class="vec1">
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
