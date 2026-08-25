@extends('site.layouts.layout')
@section('title', 'Products - Turtle Maarks Hearing Health')
@section('description', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('keywords', 'Hearing Aid supplier of all leading brands. Please connect for premium care and services.')
@section('content')

  

<!-- breadcrumb area -->
<div class="breadcrumb-area" style="background-image: url('{{ asset('frontend-assets/images/breadcrumb.png') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <h2 class="page-title">Products
                </h2>
                <ol class="breadcrumb text-center">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- gallery area -->
<div class="gallery-area padding-top-115 padding-bottom-110">
    <div class="gallery-shapes">
        <img src="{{ asset('frontend-assets/images/gallery-vec.png') }}" alt="" class="vec1 item-zooming">
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
                            <img class="img-fluid rounded" src="{{ asset('frontend-assets/images/hearing-aid/bte.webp') }}" alt="">
                        </div>
                        <h6 class="text-center text-white">BTE Hearing Aid</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-2">
                    <div class="bg-danger rounded p-2 h-100">
                        <div class="single-gallery">
                            <img class="img-fluid rounded" src="{{ asset('frontend-assets/images/hearing-aid/ric.webp') }}" alt="">
                        </div>
                        <h6 class="text-center text-white">RIC Hearing Aid</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-2">
                    <div class="bg-danger rounded p-2 h-100">
                        <div class="single-gallery">
                            <img class="img-fluid rounded" src="{{ asset('frontend-assets/images/hearing-aid/cic.webp') }}" alt="">
                        </div>
                        <h6 class="text-center text-white">CIC Hearing Aid</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-2">
                    <div class="bg-danger rounded p-2 h-100">
                        <div class="single-gallery">
                            <img class="img-fluid rounded" src="{{ asset('frontend-assets/images/hearing-aid/itc.webp') }}" alt="">
                        </div>
                        <h6 class="text-center text-white">ITC Hearing Aid</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-2">
                    <div class="bg-danger rounded p-2 h-100">
                        <div class="single-gallery">
                            <img class="img-fluid rounded" src="{{ asset('frontend-assets/images/hearing-aid/ite.webp') }}" alt="">
                        </div>
                        <h6 class="text-center text-white">ITE Hearing Aid</h6>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-2">
                    <div class="bg-danger rounded p-2 h-100">
                        <div class="single-gallery">
                            <img class="img-fluid rounded" src="{{ asset('frontend-assets/images/hearing-aid/iic.webp') }}" alt="">
                        </div>
                        <h6 class="text-center text-white">IIC Hearing Aid</h6>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<!-- dynamic catalogue area -->
<div class="gallery-area padding-bottom-110">
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            {{-- Filters --}}
            <div class="col-lg-3 mb-4">
                <div class="p-4 bg-white rounded-3 border">
                    <h6 class="fw-bold mb-3">Filters</h6>
                    <form method="GET" id="filter-form">
                        <div class="mb-4">
                            <div class="fw-semibold mb-2" style="font-size:.88rem;">Category</div>
                            @foreach($categories as $cat)
                            <div class="form-check">
                                <input class="form-check-input filter-radio" type="radio" name="category_id"
                                       value="{{ $cat->id }}" id="cat-{{ $cat->id }}"
                                       {{ request('category_id') == $cat->id ? 'checked' : '' }}>
                                <label class="form-check-label" for="cat-{{ $cat->id }}" style="font-size:.85rem;">
                                    {{ $cat->name }} <span class="text-muted">({{ $cat->products_count }})</span>
                                </label>
                            </div>
                            @endforeach
                        </div>

                        <div class="mb-4">
                            <div class="fw-semibold mb-2" style="font-size:.88rem;">Brand</div>
                            @foreach($brands as $brand)
                            <div class="form-check">
                                <input class="form-check-input filter-radio" type="radio" name="brand_id"
                                       value="{{ $brand->id }}" id="brand-{{ $brand->id }}"
                                       {{ request('brand_id') == $brand->id ? 'checked' : '' }}>
                                <label class="form-check-label" for="brand-{{ $brand->id }}" style="font-size:.85rem;">
                                    {{ $brand->name }} <span class="text-muted">({{ $brand->products_count }})</span>
                                </label>
                            </div>
                            @endforeach
                        </div>

                        <div class="mb-4">
                            <div class="fw-semibold mb-2" style="font-size:.88rem;">Price Range</div>
                            <div class="d-flex gap-2 align-items-center">
                                <input type="number" name="min_price" class="form-control form-control-sm" placeholder="Min" value="{{ request('min_price') }}">
                                <span>—</span>
                                <input type="number" name="max_price" class="form-control form-control-sm" placeholder="Max" value="{{ request('max_price') }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="in_stock" id="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }}>
                                <label class="form-check-label" for="in_stock" style="font-size:.84rem;">In Stock Only</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="on_sale" id="on_sale" value="1" {{ request('on_sale') ? 'checked' : '' }}>
                                <label class="form-check-label" for="on_sale" style="font-size:.84rem;">On Sale</label>
                            </div>
                        </div>

                        <button type="submit" class="btn2 w-100">Apply Filters</button>
                        <a href="{{ route('products') }}" class="btn btn-link w-100 mt-1">Clear all</a>
                    </form>
                </div>
            </div>

            {{-- Product grid --}}
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">{{ $products->total() }} product(s) found</span>
                    <form method="GET" class="d-flex align-items-center gap-2">
                        @foreach(request()->except('sort') as $k => $v)
                            <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                        @endforeach
                        <label class="text-muted small mb-0">Sort:</label>
                        <select name="sort" class="form-select form-select-sm" style="width:auto;" onchange="this.form.submit()">
                            <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Most Popular</option>
                        </select>
                    </form>
                </div>

                <div class="row g-4">
                    @forelse($products as $product)
                    <div class="col-lg-4 col-md-6">
                        <div class="border rounded-3 h-100 p-3 text-center">
                            <a href="{{ route('product.show', $product->slug) }}">
                                <img src="{{ $product->thumbnail_url }}" class="img-fluid rounded mb-2" style="height:180px;object-fit:cover;width:100%;" alt="{{ $product->name }}">
                            </a>
                            @if($product->brand)
                                <div class="text-muted small mb-1">{{ $product->brand->name }}</div>
                            @endif
                            <h6 class="mb-1"><a href="{{ route('product.show', $product->slug) }}" class="text-dark text-decoration-none">{{ $product->name }}</a></h6>
                            <div class="mb-2">
                                @if($product->sale_price)
                                    <span class="text-danger fw-bold">₹{{ number_format($product->sale_price, 2) }}</span>
                                    <span class="text-muted text-decoration-line-through small">₹{{ number_format($product->price, 2) }}</span>
                                @else
                                    <span class="fw-bold">₹{{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn2 w-100" {{ ($product->manage_stock && $product->stock <= 0) ? 'disabled' : '' }}>
                                    {{ ($product->manage_stock && $product->stock <= 0) ? 'Out of Stock' : 'Add to Cart' }}
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <h6>No products found</h6>
                        <p class="text-muted">Try adjusting your filters, or check back soon — our catalogue is growing.</p>
                    </div>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $products->links() }}
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
