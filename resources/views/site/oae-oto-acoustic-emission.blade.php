@extends('site.layouts.layout')
@section('title', 'OAE (Oto Acoustic Emission) - Turtle Maarks Hearing Health')
@section('description', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('keywords', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('content')


<!-- breadcrumb area -->
<div class="breadcrumb-area" style="background-image: url('{{ asset('frontend-assets/images/breadcrumb.png') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <h2 class="page-title">OAE (Oto Acoustic Emission)
                </h2>
                <ol class="breadcrumb text-center">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">OAE (Oto Acoustic Emission)</li>
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
                    <img src="{{ asset('frontend-assets/images/services/otoacoustic.webp') }}" class="rounded" alt="">
                    <h3 class="margin-bottom-20">OAE (Oto Acoustic Emission)</h3>
                    <p>
                        Oto Acoustic Emissions (OAE) is a quick, non-invasive test used to evaluate the function of the inner ear, specifically the cochlea (the hearing organ). During the test, a soft sound is played into the ear, and a tiny microphone measures the sound waves (emissions) that the inner ear produces in response. 
                    </p>
                    <p>
                       Because OAE testing does not require a response from the patient, it is ideal for testing infants, young children, or individuals with special needs. If emissions are present, it typically indicates normal hearing. If they are absent, it may suggest hearing loss or cochlear damage.
                    </p>
                    <p>
                       Our advanced OAE testing helps in early detection of hearing issues, enabling timely intervention and treatment.
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
                                <h4 class="margin-bottom-20">This test is especially valuable in</h4>
                                <ul class="single-list">
                                    <li class="amount">Newborn hearing screening</li>
                                </ul>
                                <ul class="single-list">
                                    <li class="amount">Diagnosing hearing loss in children and adults</li>
                                </ul>
                                <ul class="single-list">
                                    <li class="amount">Monitoring hearing health in noisy work environments</li>
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