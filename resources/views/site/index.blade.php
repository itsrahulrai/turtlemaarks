@extends('site.layouts.layout')
@section('title', 'Hearing Aid Clinic in Noida | Turtle Maarks Hearing Health')
@section('description', 'Turtle Maarks Hearing Health is a trusted Hearing Aid Clinic in Noida offering branded hearing aids, hearing aid repair and specialized speech therapy services.')
@section('keywords', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services')
@section('content')


<!-- hero area -->
<div class="container-fluid p-0">
    <img src="{{asset('frontend-assets/images/banners/banner-1.webp')}}" class="img-fluid w-100 d-block" alt="Banner">
</div>

 @include('site.includes.booking')

<!-- about area -->
<div class="about-area padding-top-50 padding-bottom-50">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-6 col-xl-5">
                <div class="about-left">
                    <img src="{{ asset('frontend-assets/images/about-us.jpg') }}" alt="" class="main-img rounded">
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
                        At <span style="font-weight: 700;">Turtle Maarks Hearing Health</span>, we are committed to enhancing lives through expert hearing care and speech solutions.
                        As a trusted
                        <a href="https://share.google/yjX6IHjYg8WoH0eWC">
                            <span style="font-weight: 700;">Hearing Aid Clinic near Noida Extension</span>
                        </a>,
                        we provide hearing aids from all leading global brands, helping our clients access the latest technology, comfort, and reliable aftercare support.
                    </p>

                    <p class="margin-top-20" style="text-align: justify;">
                        Whether you're experiencing hearing difficulties, looking for a hearing aid, or seeking advanced audiological solutions, our team is here to guide you at every step.
                        We offer <span style="font-weight: 700;">comprehensive audiological evaluations</span> conducted by
                        <span style="font-weight: 700;">RCI-registered Audiologists</span>, ensuring accurate assessment, diagnosis, and personalized recommendations based on your individual hearing needs.
                    </p>

                    <p class="margin-top-20" style="text-align: justify;">
                        In addition to hearing care, <span style="font-weight: 700;">Turtle Maarks Hearing Health</span> provides
                        <span style="font-weight: 700;">specialized Speech Therapy</span> services for individuals of all ages experiencing speech and language difficulties.
                        Our certified speech-language professionals work with patients compassionately to address challenges related to communication, language development, articulation, fluency, and other speech and language concerns.
                    </p>
                    <div class="btn-box margin-top-20">
                        <a href="{{ route('contact-us') }}" class="btn2">contact now</a>
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
                        <h3 class="counter">20</h3>
                        <h6 class="margin-top-20">Expert Staff</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="single-counter">
                    <div class="icon-box">
                        <span><i class="icofont-users-alt-4"></i></span>
                    </div>
                    <div class="cont-box">
                        <h3 class="counter">10000</h3>
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
                        <h3 class="counter">5000</h3>
                        <h6 class="margin-top-20">check up</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="single-counter">
                    <div class="icon-box">
                        <span><i class="icofont-prescription"></i></span>
                    </div>
                    <div class="cont-box">
                        <h3 class="counter">9000</h3>
                        <h6 class="margin-top-20">Happy Patient</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row about-counter margin-top-60 text-center">

            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
                <iframe width="100%" height="250" src="https://www.youtube.com/embed/juOmFzxFBMg?si=Uaj_pKW6P0DubpXe" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <!-- Video 1 -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
                <iframe width="100%" height="250"
                    src="https://www.youtube.com/embed/4yAlwfAl_i8?autoplay=1&mute=1"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allow="autoplay; encrypted-media"
                    allowfullscreen>
                </iframe>
            </div>

            <!-- Video 2 -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
                <iframe width="100%" height="250"
                    src="https://www.youtube.com/embed/zAwpZego-lE?si=53zH3IwZyiKEFExB"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allow="autoplay; encrypted-media"
                    allowfullscreen>
                </iframe>
            </div>

            <!-- Video 3 -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
                <iframe width="100%" height="250"
                    src="https://www.youtube.com/embed/aH7jAW4jz58?si=Hu40IC8etn52WHCw"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allow="autoplay; encrypted-media"
                    allowfullscreen>
                </iframe>
            </div>

            <!-- Video 4 -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
                <iframe width="100%" height="250" src="https://www.youtube.com/embed/vrF2ciqFfrg?si=TAIp8iY1g2wEbOVd" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <!-- Video 5 -->

            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
                <iframe width="100%" height="250" src="https://www.youtube.com/embed/vkNae-Vqu0U?si=X_qwvhNpD7nJuspm" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <!-- Video 6 -->

            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
                <iframe width="100%" height="250" src="https://www.youtube.com/embed/gL8awpcAedw?si=gmeT9JSF-u1SutNz" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>

    </div>
</div>


<!-- service area -->
<div class="service-area padding-top-115 padding-bottom-90">
    <div class="service-shapes">
        <img src="{{asset('frontend-assets/images/ser-vec1.png')}}" alt="" class="vec1 item-animateTwo">
        <img src="{{asset('frontend-assets/images/ser-vec2.png')}}" alt="" class="vec2">
    </div>
    <div class="container">
        <div class="row justify-content-center margin-bottom-45">
            <div class="col-lg-8">
                <div class="common-title text-center">
                    <h2>Diagnostic Services <span>available</span></h2>
                    <p class="margin-top-20">
                        Hearing evaluation by under mentioned tests
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay='.2s'>
                <div class="single-service">
                    <img src="{{asset('frontend-assets/images/services/pta.webp')}}" alt="">
                    <div class="cont-box margin-top-20">
                        <h4><a href="{{ route('pta-pure-tone-audiometry') }}">PTA</a></h4>
                        <p class="margin-top-15">
                            ure Tone Audiometry (PTA) is a fundamental hearing test used to evaluate
                        </p>
                        <a href="{{route('pta-pure-tone-audiometry')}}" class="link margin-top-10">learn more <span><i
                                    class="icofont-simple-right"></i></span></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay='.2s'>
                <div class="single-service">
                    <img src="{{asset('frontend-assets/images/services/tymp.webp')}}" alt="">
                    <div class="cont-box margin-top-20">
                        <h4><a href="{{route('tymp-tympanometry')}}">Tymp</a></h4>
                        <p class="margin-top-15">Tympanometry is a quick and painless diagnostic test that evaluates </p>
                        <a href="{{route('tymp-tympanometry')}}" class="link margin-top-10">learn more <span><i
                                    class="icofont-simple-right"></i></span></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay='.4s'>
                <div class="single-service">
                    <img src="{{asset('frontend-assets/images/services/bera.webp')}}" alt="">
                    <div class="cont-box margin-top-20">
                        <h4><a href="{{route('bera-brain-evoked-response-audiometry')}}">BERA </a></h4>
                        <p class="margin-top-15">BERA, or Brain Evoked Response Audiometry, is a non-invasive diagnostic</p>
                        <a href="{{route('bera-brain-evoked-response-audiometry')}}" class="link margin-top-10">learn more <span><i
                                    class="icofont-simple-right"></i></span></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay='.6s'>
                <div class="single-service">
                    <img src="{{asset('frontend-assets/images/services/oae.webp')}}" alt="">
                    <div class="cont-box margin-top-20">
                        <h4><a href="{{route('oae-oto-acoustic-emission')}}">OAE </a></h4>
                        <p class="margin-top-15">Oto Acoustic Emissions (OAE) is a quick, non-invasive test used </p>
                        <a href="{{route('oae-oto-acoustic-emission')}}" class="link margin-top-10">learn more <span><i
                                    class="icofont-simple-right"></i></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- service area -->
<div class="padding-top-50 padding-bottom-50">
    <div class="container">
        <div class="row justify-content-center margin-bottom-45">
            <div class="col-lg-8 wow fadeInUp">
                <div class="common-title2 text-center">
                    <h2>Brands of Hearing Aids Offered</h2>
                    <p class="margin-top-20">
                        We provide a comprehensive selection of high-quality hearing aids from multiple globally recognized manufacturers.
                    </p>
                </div>
            </div>
        </div>
        <div class="shivam slide-option">
            <div id="infinite" class="highway-slider">
                <div class="container highway-barrier">
                    <ul class="highway-lane">
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/widex.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/signia.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/starkey.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/resound.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/phonak.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/unitron.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/oticon.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/earkart.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/alps-international.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/widex.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/signia.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/starkey.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/resound.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/phonak.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/unitron.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/oticon.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/earkart.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/alps-international.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/widex.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/signia.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/starkey.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/resound.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/phonak.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/unitron.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/oticon.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/earkart.webp')}}" />
                        </li>
                        <li class="highway-car">
                            <img src="{{asset('frontend-assets/images/brand/alps-international.webp')}}" />
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- gallery area -->
<div class="gallery-area padding-top-115 padding-bottom-110">
    <div class="gallery-shapes">
        <img src="{{asset('frontend-assets/images/gallery-vec.png')}}" alt="" class="vec1 item-zooming">
    </div>
    <div class="container">
        <div class="row justify-content-center margin-bottom-45">
            <div class="col-lg-6">
                <div class="common-title text-center">
                    <h2>Hearing Aids <span>Available</span></h2>
                    <p class="margin-top-20">
                        We offer a diverse range of hearing aids to suit individual needs, preferences, and lifestyles.
                    </p>
                </div>
            </div>
        </div>
        <div class="gallery-wrapper">
            <div class="row port-galleries gx-3 gy-4">
                <div class="col-lg-2 col-md-4 col-6 mb-2">
                    <div class="bg-danger rounded p-2 h-100">
                        <div class="single-gallery">
                            <img class="img-fluid rounded" src="{{asset('frontend-assets/images/hearing-aid/bte.webp')}}" alt="">
                        </div>
                        <h6 class="text-center text-white">BTE Hearing Aid</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-2">
                    <div class="bg-danger rounded p-2 h-100">
                        <div class="single-gallery">
                            <img class="img-fluid rounded" src="{{asset('frontend-assets/images/hearing-aid/ric.webp')}}" alt="">
                        </div>
                        <h6 class="text-center text-white">RIC Hearing Aid</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-2">
                    <div class="bg-danger rounded p-2 h-100">
                        <div class="single-gallery">
                            <img class="img-fluid rounded" src="{{asset('frontend-assets/images/hearing-aid/cic.webp')}}" alt="">
                        </div>
                        <h6 class="text-center text-white">CIC Hearing Aid</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-2">
                    <div class="bg-danger rounded p-2 h-100">
                        <div class="single-gallery">
                            <img class="img-fluid rounded" src="{{asset('frontend-assets/images/hearing-aid/itc.webp')}}" alt="">
                        </div>
                        <h6 class="text-center text-white">ITC Hearing Aid</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-2">
                    <div class="bg-danger rounded p-2 h-100">
                        <div class="single-gallery">
                            <img class="img-fluid rounded" src="{{asset('frontend-assets/images/hearing-aid/ite.webp')}}" alt="">
                        </div>
                        <h6 class="text-center text-white">ITE Hearing Aid</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-2">
                    <div class="bg-danger rounded p-2 h-100">
                        <div class="single-gallery">
                            <img class="img-fluid rounded" src="{{asset('frontend-assets/images/hearing-aid/iic.webp')}}" alt="">
                        </div>
                        <h6 class="text-center text-white">IIC Hearing Aid</h6>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<div class="task-area padding-top-115">
    <div class="task-shapes">
        <img src="{{asset('frontend-assets/images/color-vec1.png')}}" alt="" class="vec1">
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
                            <img src="{{asset('frontend-assets/images/batteries.webp')}}" class="rounded" alt="">
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
                                <a href="#" data-toggle="modal" data-target="#bookingModal" class="btn3">booking now</a>
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
                            <img src="{{asset('frontend-assets/images/ear-model.jpg')}}" class="rounded" alt="">
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
                                <a href="#" data-toggle="modal" data-target="#bookingModal" class="btn3">booking now</a>
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
                            <img src="{{asset('frontend-assets/images/hearing-aid-repair-services.webp')}}" class="rounded" alt="">
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
                                <a href="#" data-toggle="modal" data-target="#bookingModal" class="btn3">Booking now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>


<div class="emergency-area padding-top-120 padding-bottom-120">
    <div class="emer-shapes">
        <img src="{{asset('frontend-assets/images/emergemcy_vec1.png')}}" alt="" class="vec1">
        <img src="{{asset('frontend-assets/images/emergemcy_vec2.png')}}" alt="" class="vec2">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="emergency-cont">
                    <div class="img-box">
                        <img src="{{asset('frontend-assets/images/emergemcy_vec3.png')}}" alt="">
                    </div>
                    <div class="cont-box common-title2">
                        <h4 class="margin-bottom-30">Senior Citizens Deserve the Best <br> Enjoy Free Home Visit Services!</h4>
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
        <img src="{{asset('frontend-assets/images/team-vec2.png')}}" alt="" class="vec1 item-animateOne">
        <img src="{{asset('frontend-assets/images/team-vec3.png')}}" alt="" class="vec2 item-rotate2">
        <img src="{{asset('frontend-assets/images/color-vec4.png')}}" alt="" class="vec3">
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
                        <img src="{{asset('frontend-assets/images/team/team-01.webp')}}" style="border-radius:10px;" alt="">
                    </div>
                    <div class="cont-box">
                        <h4 class="margin-bottom-10"><a href="">
                                Name of Employee
                            </a></h4>
                        <h6 class="margin-bottom-10">Position</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 wow fadeInDown">
                <div class="single-team-2">
                    <div class="img-box">
                        <img src="{{asset('frontend-assets/images/team/team-02.webp')}}" style="border-radius:10px;" alt="">
                    </div>
                    <div class="cont-box">
                        <h4 class="margin-bottom-10"><a href="">
                                Name of Employee
                            </a></h4>
                        <h6 class="margin-bottom-10">Position</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 wow fadeInUp">
                <div class="single-team-2">
                    <div class="img-box">
                        <img src="{{asset('frontend-assets/images/team/team-03.webp')}}" style="border-radius:10px;" alt="">
                    </div>
                    <div class="cont-box">
                        <h4 class="margin-bottom-10"><a href="">
                                Name of Employee
                            </a></h4>
                        <h6 class="margin-bottom-10">Position</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 wow fadeInUp">
                <div class="single-team-2">
                    <div class="img-box">
                        <img src="{{asset('frontend-assets/images/team/team-01.webp')}}" style="border-radius:10px;" alt="">
                    </div>
                    <div class="cont-box">
                        <h4 class="margin-bottom-10"><a href="">
                                Name of Employee
                            </a></h4>
                        <h6 class="margin-bottom-10">Position</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- gallery area -->
<div class="gallery-area padding-top-115 padding-bottom-110">
    <div class="gallery-shapes">
        <img src="{{asset('frontend-assets/images/gallery-vec.png')}}" alt="" class="vec1 item-zooming">
    </div>
    <div class="container">
        <div class="row justify-content-center margin-bottom-45">
            <div class="col-lg-6">
                <div class="common-title text-center">
                    <h2>our <span>gallery</span></h2>
                    <p class="margin-top-20">
                        Our gallery captures the essence of the support and solutions we provide every day.
                    </p>
                </div>
            </div>
        </div>
        <div class="gallery-wrapper">
            <div class="row port-galleries">
                <div class="col-lg-4 col-md-4 col-12">
                    <a href="{{asset('frontend-assets/images/gallery/01.webp')}}" target="_blank">
                        <div class="single-gallery">
                            <img src="{{asset('frontend-assets/images/gallery/01.webp')}}" class="img-fluid rounded" alt="">
                            <span><i class="far fa-image"></i></span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-8 col-md-8 col-12"> <a href="{{asset('frontend-assets/images/gallery/02.webp')}}" target="_blank">
                        <div class="single-gallery">
                            <img src="{{asset('frontend-assets/images/gallery/02.webp')}}" class="img-fluid rounded" alt="">
                            <span><i class="far fa-image"></i></span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <a href="{{asset('frontend-assets/images/gallery/03.webp')}}" target="_blank">
                        <div class="single-gallery">
                            <img class="img-fluid" src="{{asset('frontend-assets/images/gallery/03.webp')}}" alt=""> <span><i
                                    class="far fa-image"></i></span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-12"> <a href="{{asset('frontend-assets/images/gallery/04.webp')}}" target="_blank">
                        <div class="single-gallery">
                            <img class="img-fluid" src="{{asset('frontend-assets/images/gallery/04.webp')}}" alt="">
                            <span><i class="far fa-image"></i></span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-12"><a href="{{asset('frontend-assets/images/gallery/05.webp')}}" target="_blank">
                        <div class="single-gallery">
                            <img class="img-fluid" src="{{asset('frontend-assets/images/gallery/05.webp')}}" alt=""> <span><i
                                    class="far fa-image"></i></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="btn-box text-center margin-top-30">
                <a href="{{asset('frontend-assets/images/gallery/05.webp')}}" class="btn3" target="_blank">View All Gallery</a>
            </div>
        </div>
    </div>
</div>




<!-- testimonial area -->
<div class="testimonial-area padding-top-115 padding-bottom-145">
    <div class="testi-shapes">
        <img src="{{asset('frontend-assets/images/fea-vec2.png')}}" alt="" class="vec1 item-bounce">
        <img src="{{asset('frontend-assets/images/fea-vec3.png')}}" alt="" class="vec2 item-rotate">
    </div>
    <div class="container">
        <div class="row justify-content-center margin-bottom-25">
            <div class="col-lg-8">
                <div class="common-title text-center">
                    <h2>What Our Patients Are <span>Saying</span></h2>
                    <p class="margin-top-20">
                        Our patients are at the heart of everything we do. From the moment they walk through our doors, we’re dedicated to providing compassionate care.
                    </p>
                </div>
            </div>
        </div>

        <div class="btn-box text-center margin-top-30">
            <a href="https://www.google.com/search?num=10&sca_esv=fa25cb492db56b5e&rlz=1C1ONGR_enIN1154IN1154&sxsrf=ANbL-n4mQMXqvOjFcwve9vhgjjfd1kicYA:1770812575708&si=AL3DRZEsmMGCryMMFSHJ3StBhOdZ2-6yYkXd_doETEE1OR-qORTwfKEfzY_quV-SU8CroR1tN4H9-cpyApdW3m0Q2cK-hf5ItifnYXv4WA8X8XwqmUY4juTnEEJycxrAaJIrMYR_dz61w8ySsEEUEMC-Q4JkWl5hww%3D%3D&q=Turtle+Maarks+Hearing+Health+Reviews&sa=X&ved=2ahUKEwj7yqf0ttGSAxUOyDgGHfMbEWcQ0bkNegQIPxAH&biw=1366&bih=641&dpr=1" class="btn3" target="_blank">Read Reviews </a>
        </div>
    </div>
</div>



<!-- faq area -->
<div class="faq-area padding-top-115">
    <div class="faq-shapes">
        <img src="{{asset('frontend-assets/images/faq-vec1.png')}}" alt="" class="vec1 item-animateOne">
        <img src="{{asset('frontend-assets/images/faq-vec2.png')}}" alt="" class="vec2 wow zoomIn">
    </div>
    <div class="container">
        <div class="row justify-content-center margin-bottom-45">
            <div class="col-lg-8">
                <div class="common-title text-center">
                    <h2>Frequently Asked <span>Questions</span></h2>
                    <p class="margin-top-20">
                        We understand that hearing and speech care can raise many questions. Whether you're considering hearing aids for the first time or exploring speech therapy options, we’re here to help. Below are answers to some of the most common questions our patients ask.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-12">
                <div class="faq-left">
                    <img src="{{asset('frontend-assets/images/fea-1.png')}}" class="rounded" alt="">
                </div>
            </div>
            <div class="col-lg-7 col-12">
                <div class="faq-right">
                    <div id="accordion" class="accordion-wrapper">

                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h6>
                                    <a href="#" data-toggle="collapse" class="collapse" data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        Q. 1. How do I know if I need a hearing aid?
                                    </a>
                                </h6>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <p>
                                        If you often ask people to repeat themselves, struggle to hear in noisy environments, or feel like others are mumbling, it may be time for a hearing assessment. Our audiologists can perform a quick, painless hearing test to determine your needs.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h6>
                                    <a href="#" data-toggle="collapse" class="collapsed" data-target="#collapseTwo"
                                        aria-expanded="false" aria-controls="collapseTwo">
                                        Q. 2. Do you offer hearing aids from all major brands?
                                    </a>
                                </h6>
                            </div>

                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <p>
                                        Yes, we provide hearing aids from all leading global brands, ensuring you have access to the latest technology that suits your lifestyle, hearing loss level, and budget.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h6>
                                    <a href="#" data-toggle="collapse" class="collapsed"
                                        data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Q. 3. How long does a hearing test take?
                                    </a>
                                </h6>
                            </div>

                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <p>
                                        A standard hearing test usually takes about 20 to 30 minutes. Our experts will guide you through the entire process and explain your results clearly.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h6>
                                    <a href="#" data-toggle="collapse" class="collapsed" data-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        Q. 4. Is speech therapy available for all age groups?

                                    </a>
                                </h6>
                            </div>

                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <p>
                                        Absolutely. We offer personalized speech therapy for children, adults, and seniors, addressing a wide range of speech and language disorders with care and professionalism.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingFive">
                                <h6>
                                    <a href="#" data-toggle="collapse" class="collapsed" data-target="#collapseFive"
                                        aria-expanded="false" aria-controls="collapseFive">
                                        Q. 5. Will my hearing aids be visible or bulky?
                                    </a>
                                </h6>
                            </div>

                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <p>
                                        Modern hearing aids are discreet, lightweight, and designed for comfort. Many models are nearly invisible and sit inside the ear canal or behind the ear with a slim tube.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- featured products & brands (dynamic, admin-managed) -->
@if($featuredProducts->count() || $brands->count())
<div class="gallery-area padding-top-115 padding-bottom-60">
    <div class="container">

        @if($brands->count())
        <div class="row justify-content-center margin-bottom-45">
            <div class="col-lg-6">
                <div class="common-title text-center">
                    <h2>Brands We <span>Carry</span></h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center align-items-center margin-bottom-60 g-4">
            @foreach($brands as $brand)
            <div class="col-6 col-md-2 text-center">
                <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}" class="img-fluid" style="max-height:60px;object-fit:contain;">
            </div>
            @endforeach
        </div>
        @endif

        @if($featuredProducts->count())
        <div class="row justify-content-center margin-bottom-45">
            <div class="col-lg-6">
                <div class="common-title text-center">
                    <h2>Featured <span>Hearing Aids</span></h2>
                </div>
            </div>
        </div>
        <div class="row g-4">
            @foreach($featuredProducts as $product)
            <div class="col-lg-3 col-md-6">
                <div class="border rounded-3 h-100 p-3 text-center">
                    <a href="{{ route('product.show', $product->slug) }}">
                        <img src="{{ $product->thumbnail_url }}" class="img-fluid rounded mb-2" style="height:160px;object-fit:cover;width:100%;" alt="{{ $product->name }}">
                    </a>
                    @if($product->brand)<div class="text-muted small mb-1">{{ $product->brand->name }}</div>@endif
                    <h6 class="mb-1"><a href="{{ route('product.show', $product->slug) }}" class="text-dark text-decoration-none">{{ $product->name }}</a></h6>
                    @if($product->sale_price)
                        <span class="text-danger fw-bold">₹{{ number_format($product->sale_price, 2) }}</span>
                        <span class="text-muted text-decoration-line-through small">₹{{ number_format($product->price, 2) }}</span>
                    @else
                        <span class="fw-bold">₹{{ number_format($product->price, 2) }}</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('products') }}" class="btn2">View All Products</a>
        </div>
        @endif
    </div>
</div>
@endif

@if($services->count())
<div class="gallery-area padding-bottom-60">
    <div class="container">
        <div class="row justify-content-center margin-bottom-45">
            <div class="col-lg-6">
                <div class="common-title text-center">
                    <h2>Our <span>Services</span></h2>
                </div>
            </div>
        </div>
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-lg-4 col-md-6">
                <div class="border rounded-3 h-100 p-3 text-center">
                    <img src="{{ $service->image_url }}" class="img-fluid rounded mb-2" style="height:150px;object-fit:cover;width:100%;" alt="{{ $service->name }}">
                    <h6>{{ $service->name }}</h6>
                    <div class="fw-bold mb-2">₹{{ number_format($service->price, 2) }}</div>
                    <a href="{{ route('services.show', $service->slug) }}" class="btn2">Learn More</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('services.index') }}" class="btn2">View All Services</a>
        </div>
    </div>
</div>
@endif


<!-- subs area -->
<div class="subs-area">
    <div class="container">
        <div class="row subs-wrapper">
            <div class="subs-shape">
                <img src="{{asset('frontend-assets/images/subs-vec.png')}}" alt="" class="vec1">
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
