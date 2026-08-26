@extends('site.layouts.layout')
@section('title', 'PTA (Pure Tone Audiometry) - Turtle Maarks Hearing Health')
@section('description', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('keywords', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('content')

  

<!-- breadcrumb area -->
<div class="breadcrumb-area" style="background-image: url('{{ asset('frontend-assets/images/breadcrumb.png') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <h2 class="page-title">PTA (Pure Tone Audiometry)
                </h2>
                <ol class="breadcrumb text-center">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">PTA (Pure Tone Audiometry)</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

  @include('site.includes.booking')


<!-- service wrapper -->
<div class="service-wrapper padding-top-120 padding-bottom-70">
    <div class="container">
        <div class="row">
            <!-- ser-main-con -->
            <div class="col-lg-9">
                <!-- ser-cont -->
                <div class="ser-cont wow fadeInUp">
                    <img src="{{ asset('frontend-assets/images/services/pta-pure-tone-audiometry.webp') }}" class="rounded" alt="">
                    <h3 class="margin-bottom-20">PTA (Pure Tone Audiometry)</h3>
                    <p>
                        Pure Tone Audiometry (PTA) is a fundamental hearing test used to evaluate an individual's hearing sensitivity. It measures the softest sounds a person can hear at different frequencies, helping identify the type and degree of hearing loss. During the test, the patient wears headphones and responds to a series of tones played at varying volumes and pitches.
                    </p>
                    <p>
                        This test is simple, non-invasive, and highly accurate. It plays a crucial role in diagnosing hearing conditions and determining the most appropriate treatment or hearing aid solution. PTA is commonly used for people experiencing hearing difficulties, sudden hearing loss, or those exposed to excessive noise.
                    </p>
                    <p>
                        Whether for routine check-ups or specific concerns, our audiologists conduct PTA tests with utmost care and precision to ensure reliable results and personalized care plans.
                    </p>
                </div>

                <!-- section separator -->
                <div class="separator margin-bottom-50">
                    <hr>
                </div>

                <!-- service list -->
                <div class="service-list-wrap wow fadeInUp">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="service-list">
                                <h4 class="margin-bottom-20">How the Test is Conducted:</h4>
                                <ul class="single-list">
                                    <li class="amount">The individual sits in a sound-treated room or booth to avoid external noise interference.</li>
                                </ul>
                                <ul class="single-list">
                                    <li class="amount">Headphones or insert earphones are placed over the ears.</li>
                                </ul>
                                <ul class="single-list">
                                    <li class="amount">A series of pure tones (simple beeping sounds) are presented at various pitches (frequencies) and volumes (intensities).</li>
                                </ul>
                                <ul class="single-list">
                                    <li class="amount">The person is asked to respond—usually by pressing a button or raising their hand—every time they hear a sound, no matter how faint.</li>
                                </ul>
                                <ul class="single-list">
                                    <li class="amount">Both ears are tested separately.</li>
                                </ul>
                            </div>
                        </div>
                    </div>


                </div>

               
            </div>

            <!-- ser-sidebar -->
            <div class="col-lg-3">
                <div class="ser-sidebar">
                @include('site.includes.side-bar')
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
