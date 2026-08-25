@extends('site.layouts.layout')
@section('title', 'Tymp (Tympanometry) - Turtle Maarks Hearing Health')
@section('description', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('keywords', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('content')

  



<!-- breadcrumb area -->
<div class="breadcrumb-area" style="background-image: url('{{ asset('frontend-assets/images/breadcrumb.png') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <h2 class="page-title">Tymp (Tympanometry)
                </h2>
                <ol class="breadcrumb text-center">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tymp (Tympanometry)</li>
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
                    <img src="{{ asset('frontend-assets/images/services/tympanometry.webp') }}" class="rounded" alt="">
                    <h3 class="margin-bottom-20">Tymp (Tympanometry)</h3>
                    <p>
                       Tympanometry is a quick and painless diagnostic test that evaluates the condition of the middle ear and the mobility of the eardrum (tympanic membrane). It helps detect problems such as fluid buildup, eustachian tube dysfunction, ear infections, or a perforated eardrum.
                    </p>
                    <p>
                        During the test, a small probe is gently placed into the ear canal, which changes air pressure and measures the eardrum’s response. The results are recorded on a graph called a tympanogram.
                    </p>
                    <p>
                        Tympanometry is especially useful for both children and adults who experience hearing difficulties, frequent ear infections, or a feeling of fullness in the ear. It's a valuable tool in diagnosing middle ear conditions and guiding effective treatment.
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
                                <h4 class="margin-bottom-20">Why is Tympanometry Important?</h4>
                                <ul class="single-list">
                                    <li class="amount">Fluid in the middle ear (often due to ear infections)</li>
                                </ul>
                                <ul class="single-list">
                                    <li class="amount">Eustachian tube dysfunction (trouble equalizing ear pressure)</li>
                                </ul>
                                <ul class="single-list">
                                    <li class="amount">Perforated (ruptured) eardrum</li>
                                </ul>
                                <ul class="single-list">
                                    <li class="amount">Earwax blockage</li>
                                </ul>
                                <ul class="single-list">
                                    <li class="amount">Ossicular chain (middle ear bones) abnormalities</li>
                                </ul>
                            </div>k
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
