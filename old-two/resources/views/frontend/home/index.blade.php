@extends('site.layouts.layout')
@section('title', setting('site_name', 'Sanni Cad Cam'))

@section('content')

    {{-- Hero Slider --}}
    @if ($banners->count())

        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

            {{-- Indicators --}}
            <div class="carousel-indicators">
                @foreach ($banners as $i => $banner)
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}"
                        class="{{ $i === 0 ? 'active' : '' }}">
                    </button>
                @endforeach
            </div>

            {{-- Slides --}}
            <div class="carousel-inner">

                @foreach ($banners as $i => $banner)
                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">

                        @if ($banner->link)
                            <a href="{{ $banner->link }}">
                        @endif

                        {{-- Desktop Image --}}
                        <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}"
                            class="w-100 d-none d-md-block hero-banner-img">

                        {{-- Mobile Image --}}
                        <img src="{{ $banner->mobile_image ? asset('public/storage/' . $banner->mobile_image) : $banner->image_url }}"
                            alt="{{ $banner->title }}" class="w-100 d-block d-md-none hero-banner-mobile-img">

                        @if ($banner->link)
                            </a>
                        @endif

                    </div>
                @endforeach

            </div>

            {{-- Controls --}}
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">

                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">

                <span class="carousel-control-next-icon"></span>
            </button>

        </div>
    @else
        {{-- Default Banner --}}
        <div class="hero-default-banner">

            {{-- Desktop --}}
            <img src="{{ base_public_url('assets/img/dummy.png') }}" alt="Banner"
                class="w-100 d-none d-md-block hero-banner-img">

            {{-- Mobile --}}
            <img src="{{ base_public_url('assets/img/dummy.png') }}" alt="Banner"
                class="w-100 d-block d-md-none hero-banner-mobile-img">

        </div>

    @endif





    @if ($featuredCategories->count())

    <section class="cat-slide-section">
        <div class="container">
            <div class="cat-swiper-wrap">

                <button class="cat-nav-btn cat-prev"><i class="bi bi-chevron-left"></i></button>

                <div class="swiper cat-swiper">
                    <div class="swiper-wrapper">

                        @foreach ($featuredCategories as $cat)
                            <div class="swiper-slide">
                                <a href="{{ route('shop.category', $cat->slug) }}" class="cat-slide-card text-decoration-none">
                                    <div class="cat-slide-img">
                                        @if ($cat->image)
                                            <img src="{{ $cat->image_url }}" alt="{{ $cat->name }}">
                                        @else
                                            <img src="{{ base_public_url('assets/img/no-category.jpg') }}" alt="{{ $cat->name }}">
                                        @endif
                                    </div>
                                    <h6>{{ $cat->name }}</h6>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>

                <button class="cat-nav-btn cat-next"><i class="bi bi-chevron-right"></i></button>

            </div>

        </div>
    </section>

    @once
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                new Swiper('.cat-swiper', {
                    slidesPerView: 6,
                    spaceBetween: 18,
                    navigation: {
                        nextEl: '.cat-next',
                        prevEl: '.cat-prev',
                    },
                    breakpoints: {
                        0:    { slidesPerView: 3.2, spaceBetween: 8 },
                        480:  { slidesPerView: 4,   spaceBetween: 10 },
                        768:  { slidesPerView: 4.5, spaceBetween: 14 },
                        992:  { slidesPerView: 5,   spaceBetween: 16 },
                        1200: { slidesPerView: 6,   spaceBetween: 18 },
                    }
                });
            });
        </script>
    @endonce

@endif



        {{-- =========================
    ABOUT SECTION
========================== --}}


<section class="py-5">
    <div class="container">

          <div class="row align-items-center g-5">

                {{-- Left Content --}}
                <div class="col-lg-7">

                    <span class="about-badge">
                        About Turtle Maarks Hearing Health
                    </span>

                    <h1 class="about-title mt-3">
                        Turtle Maarks Hearing Health
                    </h1>

                    <p class="about-subtitle">
                        Your Trusted Partner in Digestive, Liver & Anorectal Health
                    </p>

                    <p class="about-text">
                        <strong>Turtle Maarks Hearing Health</strong> is a healthcare-focused
                        pharmaceutical and wellness company dedicated to improving the lives
                        of patients suffering from anorectal disorders, gastrointestinal
                        diseases, and liver-related conditions.
                    </p>

                    <p class="about-text">
                        Backed by more than
                        <strong>22 years of clinical excellence</strong> and the trusted
                        foundation of <strong>Centre for Piles and Fistula</strong>, our
                        mission is to provide effective, trusted, and doctor-recommended
                        healthcare solutions that improve quality of life and promote
                        long-term digestive wellness.
                    </p>


                </div>


                {{-- Right Card --}}
                <div class="col-lg-5">

                    <div class="about-card">

                        <h3>
                            Our Healthcare Focus
                        </h3>

                        <div class="row g-3 mt-2">

                            <div class="col-6">
                                <div class="feature-box">
                                    Piles (Hemorrhoids)
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="feature-box">
                                    Fissure & Fistula
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="feature-box">
                                    Constipation
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="feature-box">
                                    Digestive Disorders
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="feature-box">
                                    Acidity & Gas
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="feature-box">
                                    Liver health and Wellness 
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="feature-box">
                                    Fatty Liver
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="feature-box">
                                     IBS & Gut Wellness
                                </div>
                            </div>

                        </div>

                    </div>

                </div>


            </div>

    </div>
</section>




    {{-- Trending Products --}}
    @if ($trendingProducts->count())
        <section class="py-5" style="
            background:
            radial-gradient(circle at top right,
            rgba(20,184,166,.08),
            transparent 30%),
            linear-gradient(
            180deg,
            #F8FCFB 0%,
            #F1FAF8 50%,
            #ECF7F5 100%
            );
            ">
            <div class="container">
                <div class="section-header text-center mb-5">
                    <span class="category-mini-title">
                        Trusted Healthcare
                    </span>
                    <h2 class="category-main-title">
                        Popular Medicines
                    </h2>
                    <p>Top-selling medicines and wellness essentials.</p>
                </div>

                <div class="row g-3">
                    @foreach ($trendingProducts as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('shop') }}" class="btn btn-outline-pink px-4">View All Products</a>
                </div>
            </div>
        </section>
    @endif
   
    {{-- Flash Sale --}}
    @if ($saleProducts->count())
        <section class="py-5" style="
                    background:
                    radial-gradient(circle at top right, rgba(255,255,255,.08), transparent 25%),
                    linear-gradient(135deg, #0B3C49 0%, #0E5A68 40%, #0A9396 100%);
                    ">
            <div class="container"> 
                <div class="section-header" style="color:#fff;">
                    <span
                        style="background:rgba(255,255,255,.15);color:#fff;padding:5px 14px;border-radius:20px;font-size:.78rem;font-weight:600;display:inline-block;margin-bottom:10px;">
                        Recommended</span>
                    <h2 style="color:#fff;">Daily Care</h2>
                    <p style="color:rgba(255,255,255,.7);"> Carefully selected products for your daily wellness.</p>
                </div>
                <div class="row g-3">
                    @foreach ($saleProducts as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- New Arrivals --}}
    @if ($newArrivals->count())
        <section class="py-5" style="
background:
radial-gradient(circle at top right,
rgba(20,184,166,.08),
transparent 30%),
linear-gradient(
180deg,
#F8FCFB 0%,
#F1FAF8 50%,
#ECF7F5 100%
);

">
            <div class="container">
                <div class="section-header text-center mb-5">
                    <span class="category-mini-title">
                        Latest Collection
                    </span>
                    <h2 class="category-main-title">
                         New Arrivals
                    </h2>
                    <p>Newly added medicines and healthcare essentials.</p>
                </div>

                <div class="row g-3">
                    @foreach ($newArrivals as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Best Sellers --}}
    @if ($bestSellers->count())
        <section class="py-5" style="
                    background:
                    radial-gradient(circle at top right, rgba(255,255,255,.08), transparent 25%),
                    linear-gradient(135deg, #0B3C49 0%, #0E5A68 40%, #0A9396 100%);
                    ">
            <div class="container">
                 <div class="section-header" style="color:#fff;">
                    <span
                        style="background:rgba(255,255,255,.15);color:#fff;padding:5px 14px;border-radius:20px;font-size:.78rem;font-weight:600;display:inline-block;margin-bottom:10px;">
                         Customer Favorites </span>
                    <h2 style="color:#fff;">Best Sellers</h2>
                    <p style="color:rgba(255,255,255,.7);"> Most trusted and frequently purchased products.</p>
                </div>


                <div class="row g-3">
                    @foreach ($bestSellers as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Testimonials --}}
    {{-- @if ($testimonials->count())
        <section class="py-5" style="background:#f8f9fa;">
            <div class="container">
                <div class="section-header">
                    <span class="badge-label">💬 Reviews</span>
                    <h2>What Our Customers Say</h2>
                </div>
                <div class="row g-3">
                    @foreach ($testimonials as $t)
                    <div class="col-md-4">
                        <div class="p-4" style="background:#fff;border-radius:14px;border:1px solid #e9ecef;height:100%;">
                            <div class="text-warning mb-3">
                                @for ($i = 0; $i < 5; $i++)
                                <i class="bi bi-star{{ $i < $t->rating ? '-fill' : '' }}"></i>
                                @endfor
                            </div>
                            <p style="font-size:.9rem;color:#555;line-height:1.7;">"{{ $t->message }}"</p>
                            <div class="d-flex align-items-center gap-3 mt-3">
                                <img src="{{ $t->avatar_url }}" style="width:44px;height:44px;border-radius:50%;object-fit:cover;" alt="{{ $t->name }}">
                                <div>
                                    <div style="font-weight:700;font-size:.88rem;">{{ $t->name }}</div>
                                    <div style="font-size:.78rem;color:#6c757d;">{{ $t->designation }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif --}}

    {{-- Latest Blog --}}
    @if ($latestBlogs->count())
        <section class="py-5">
            <div class="container">
                <div class="section-header">
                    <span class="badge-label">📖 Blog</span>
                    <h2>Latest Industry Updates</h2>
                </div>
                <div class="row g-3">
                    @foreach ($latestBlogs as $blog)
                        <div class="col-md-4">
                            <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none">
                                <div style="border-radius:14px;overflow:hidden;border:1px solid #e9ecef;transition:all .25s;"
                                    onmouseover="this.style.boxShadow='0 4px 20px rgba(46,111,64,.1)'"
                                    onmouseout="this.style.boxShadow=''">
                                    <img src="{{ $blog->thumbnail_url }}"
                                        style="width:100%;height:200px;object-fit:cover;" alt="{{ $blog->title }}">
                                    <div class="p-4">
                                        <div
                                            style="font-size:.75rem;color:var(--kkt-primary);font-weight:600;margin-bottom:8px;">
                                            {{ $blog->published_at?->format('d M Y') }}</div>
                                        <h6 style="font-weight:700;color:var(--kkt-dark);">
                                            {{ Str::limit($blog->title, 60) }}</h6>
                                        <p style="font-size:.84rem;color:#6c757d;">{{ Str::limit($blog->excerpt, 100) }}
                                        </p>
                                        <span style="color:var(--kkt-primary);font-size:.84rem;font-weight:600;">Read More
                                            →</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection


