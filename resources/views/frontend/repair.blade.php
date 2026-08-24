@extends('frontend.layouts.layout')
@section('title', 'Repair - Turtle Maarks Hearing Health')
@section('description', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('keywords', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('content')

  


<!-- breadcrumb area -->
<div class="breadcrumb-area" style="background-image: url('{{ asset('assets/images/breadcrumb.png') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <h2 class="page-title">Repair 
                </h2>
                <ol class="breadcrumb text-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Repair </li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<div class="task-area padding-top-115">
    <div class="task-shapes">
        <img src="{{ asset('assets/images/color-vec1.png') }}" alt="" class="vec1">
    </div>
    <div class="container">
        <div class="row justify-content-center margin-bottom-25">
            <div class="col-lg-8">
                <div class="common-title text-center">
                    <h2>Hearing Aid Accessories & <span>Support Services</span></h2>
                    <p class="margin-top-20">
                        We offer a comprehensive selection of hearing aid accessories to enhance comfort, performance, and longevity of your hearing devices.
                    </p>
                </div>
            </div>
        </div>

        <!-- tab nav -->
        <div class="row task-tab-nav margin-bottom-50">
            <div class="col-lg-12">
                <nav>
                    <div class="nav task-nav-wrapper justify-content-center " id="nav-tab" role="tablist">

                        <a class="nav-item nav-link active" id="nav-one-tab" data-toggle="tab" href="#nav-one"
                            role="tab" aria-controls="nav-one" aria-selected="true">
                            <div class="single-nav active">
                                <h5>Hearing Aid Batteries</h5>
                            </div>
                        </a>

                        <a class="nav-item nav-link" id="nav-two-tab" data-toggle="tab" href="#nav-two" role="tab"
                            aria-controls="nav-two" aria-selected="false">
                            <div class="single-nav">
                                <h5>Ear Moulds & Tips</h5>
                            </div>
                        </a>

                        <a class="nav-item nav-link" id="nav-three-tab" data-toggle="tab" href="#nav-three"
                            role="tab" aria-controls="nav-three" aria-selected="false">
                            <div class="single-nav">
                                <h5>Hearing Aid Repair Services</h5>
                            </div>
                        </a>
                    </div>
                </nav>
            </div>
        </div>

        <!-- tab cont -->
        <div class="tab-content" id="nav-tabContent">
            <!-- single item -->
            <div class="tab-pane fade show active" id="nav-one" role="tabpanel" aria-labelledby="nav-one-tab">
                <div class="row task-tab-cont align-items-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="task-img">
                            <img src="{{ asset('assets/images/batteries.webp') }}" class="rounded" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="task-cont">
                            <h3 class="margin-bottom-20">
                                Hearing Aid Batteries
                            </h3>

                            <p class="margin-bottom-20">
                                We stock high-quality, long-lasting batteries in all standard sizes — 13, 312, 10, and 675 — compatible with leading brands like Widex, Starkey, and Power One.
                            </p>
                            <ul>
                                <li> Battery Sizes — 13</li>
                                <li> Battery Sizes — 312 </li>
                                <li> Battery Sizes — 10</li>
                                <li> Battery Sizes — 675</li>
                            </ul>
                            <div class="btn-box">
                                <a href="" data-toggle="modal" data-target="#bookingModal" class="btn3">booking now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- single item -->
            <div class="tab-pane fade" id="nav-two" role="tabpanel" aria-labelledby="nav-two-tab">
                <div class="row task-tab-cont align-items-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="task-img">
                            <img src="{{ asset('assets/images/ear-model.jpg') }}" class="rounded" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="task-cont">
                            <h3 class="margin-bottom-20">
                                Ear Moulds & Tips
                            </h3>

                            <p class="margin-bottom-20">
                                Choose from a variety of soft and hard ear moulds as well as ear tips designed for optimal fit and sound delivery. Each is crafted for comfort and performance.
                            </p>
                            <ul>
                                <li> We offer soft and hard ear moulds tailored for a comfortable and secure fit.</li>
                                <li> Designed to improve sound delivery and reduce feedback in hearing aids. </li>
                                <li> Available in various sizes and materials to suit individual ear shapes. </li>
                            </ul>
                            <div class="btn-box">
                                <a href="" data-toggle="modal" data-target="#bookingModal" class="btn3">booking now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- single item -->
            <div class="tab-pane fade" id="nav-three" role="tabpanel" aria-labelledby="nav-three-tab">
                <div class="row task-tab-cont align-items-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="task-img">
                            <img src="{{ asset('assets/images/hearing-aid-repair-services.webp') }}" class="rounded" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="task-cont">
                            <h3 class="margin-bottom-20">
                                Hearing Aid Repair Services
                            </h3>

                            <p class="margin-bottom-20">
                                We provide expert repair services for all major hearing aid brands listed above. From minor adjustments to complete overhauls, our technicians ensure your devices are working their best.
                            </p>
                            <ul>
                                <li>Expert repairs and adjustments for all major hearing aid brands to restore optimal function.</li>
                                <li>Skilled technicians handle everything from minor tweaks to full servicing with precision.</li>
                                <li> Fast turnaround, reliable quality, and personalized support to keep your devices working at their best.</li>
                            </ul>
                            <div class="btn-box">
                                <a href="" data-toggle="modal" data-target="#bookingModal" class="btn3">booking now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>


@endsection     
