@extends('frontend.layouts.layout')
@section('title', 'BERA (Brain Evoked Response Audiometry) - Turtle Maarks Hearing Health')
@section('description', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('keywords', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('content')


<!-- breadcrumb area -->
<div class="breadcrumb-area" style="background-image: url('{{asset('assets/images/breadcrumb.png')}}');">
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <h2 class="page-title">BERA (Brain Evoked Response Audiometry)
                </h2>
                <ol class="breadcrumb text-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">BERA (Brain Evoked Response Audiometry)</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

 @include('frontend.includes.booking')

<!-- service wrapper -->
<div class="service-wrapper padding-top-120 padding-bottom-70">
    <div class="container">
        <div class="row">
            <!-- ser-main-con -->
            <div class="col-lg-9">
                <!-- ser-cont -->
                <div class="ser-cont wow fadeInUp">
                    <img src="{{asset('assets/images/services/bera-brain.jpg')}}" class="rounded" alt="">
                    <h3 class="margin-bottom-20">BERA (Brain Evoked Response Audiometry)</h3>
                    <p>
                        BERA, or Brain Evoked Response Audiometry, is a non-invasive diagnostic test that measures the brain’s electrical activity in response to sound stimuli. It is especially useful in assessing hearing in newborns, young children, and individuals who are unable to respond to conventional hearing tests.
                    </p>
                    <p>
                       By placing small electrodes on the scalp, the test records how sound signals travel along the auditory nerve to the brainstem. BERA helps detect hearing loss, neurological issues, and auditory pathway disorders with precision. It is safe, painless, and plays a crucial role in early hearing detection and intervention.
                    </p>
                    <p>
                        BERA, or Brain Evoked Response Audiometry, is an advanced, objective hearing test that evaluates how sound signals travel from the ear through the auditory nerve to the brainstem. This test is especially beneficial for individuals who cannot provide reliable behavioral responses to traditional hearing tests — such as newborns, infants, individuals with developmental delays, or unconscious patients.
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
                                <h4 class="margin-bottom-20">Key Benefits of BERA Testing</h4>
                                <ul class="single-list">
                                    <li class="amount">
                                        Early Diagnosis in Infants: It is one of the most effective methods to identify hearing impairment in newborns and babies, allowing for timely intervention.
                                    </li>
                                </ul>
                                <ul class="single-list">
                                    <li class="amount">
                                        Objective and Reliable: No active response is required from the patient, making it suitable for people who are non-verbal or sedated.
                                    </li>
                                </ul>
                                <ul class="single-list">
                                    <li class="amount">
                                        Neurological Insight: It can also help detect neurological disorders, such as acoustic neuromas, auditory neuropathy, or brainstem lesions.
                                    </li>
                                </ul>
                                <ul class="single-list">
                                    <li class="amount">
                                        Non-invasive & Painless: The procedure is entirely safe, with no discomfort or risks involved.
                                    </li>
                                </ul>
                                <ul class="single-list">
                                    <li class="amount">At our center, BERA testing is conducted by experienced audiologists using advanced equipment to ensure precise results. </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                </div>


            </div>

            <!-- ser-sidebar -->
            <div class="col-lg-3">
                <div class="ser-sidebar">

                     @include('frontend.includes.side-bar')


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
                <img src="{{asset('assets/images/subs-vec.png')}}" alt="" class="vec1">
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


<!-- subs area -->
<div class="subs-area">
    <div class="container">
        <div class="row subs-wrapper">
            <div class="subs-shape">
                <img src="{{asset('assets/images/subs-vec.png')}}" alt="" class="vec1">
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
