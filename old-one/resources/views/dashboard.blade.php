<x-app-layout>
    <div class="py-4 bg-light">
        <div class="container-fluid">
            <div class="row min-vh-100">

                <!-- Sidebar -->

                @include('admin-sidebar')

                <!-- Main content -->
                <main class="col-12 col-md-9 col-lg-10 p-4">
                    <h4 class="mb-4 text-dark fw-bold">Welcome, {{ Auth::user()->name }}!</h4>

                    <div class="row g-4">
                        <!-- Categories Card -->
                        <div class="col-12 col-md-6 col-lg-4">
                          <div class="card dashboard-card card-categories shadow-sm rounded-3 h-100 border-0">
                                <div class="card-body text-center">
                                    <div class="icon-circle categories-icon mb-3">
                                        <i class="bi bi-folder-fill fs-3"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark">Categories</h5>
                                    <p class="text-muted mb-3"><span class="counter">{{ \App\Models\Category::count() }}</span> total</p>
                                    <div class="d-flex flex-column gap-2">
                                        <a href="{{route('categories.index')}}" class="btn btn-outline-gold btn-sm">View All</a>
                                        <a href="{{route('categories.create')}}" class="btn btn-gold btn-sm">Add New</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                          <!-- Blogs Card -->
                        <div class="col-12 col-md-6 col-lg-4">
                           <div class="card dashboard-card card-blogs shadow-sm rounded-3 h-100 border-0">
                                <div class="card-body text-center">
                                    <div class="icon-circle blogs-icon mb-3">
                                        <i class="bi bi-journal-richtext fs-3"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark">Blogs</h5>
                                    <p class="text-muted mb-3"><span class="counter">{{ \App\Models\Blog::count() }}</span> total</p>
                                    <div class="d-flex flex-column gap-2">
                                        <a href="{{route('admin.blogs.index')}}" class="btn btn-outline-gold btn-sm">View All</a>
                                        <a href="{{route('admin.blogs.create')}}" class="btn btn-gold btn-sm">Add New</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pages Card -->

                        <div class="col-12 col-md-6 col-lg-4">
                          <div class="card dashboard-card card-pages shadow-sm rounded-3 h-100 border-0">
                                <div class="card-body text-center">
                                    <div class="icon-circle testimonials-icon mb-3">
                                        <i class="bi bi-chat-left-quote fs-3"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark">Pages</h5>
                                    <p class="text-muted mb-3"><span class="counter">{{ \App\Models\Page::count() }}</span> total</p>
                                    <div class="d-flex flex-column gap-2">
                                        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-gold btn-sm">View All</a>
                                        <a href="{{ route('admin.pages.create') }}" class="btn btn-gold btn-sm">Add New</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
  /* Dashboard Cards */
.dashboard-card {
    transition: transform 0.3s, box-shadow 0.3s;
    cursor: pointer;
    background-color: #ffffff;
    border-radius: 14px;
}

/* Unique Background Colors for Cards */
.card-categories {
    background-color: #fff9e6 !important; /* soft yellow */
}

.card-blogs {
    background-color: #fff2e8 !important; /* soft peach/orange */
}

.card-pages {
    background-color: #eaf4ff !important; /* soft light blue */
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(49, 78, 82, 0.2);
}

/* Icon Circles */
.icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    font-size: 1.5rem;
    background-color: #1276B7;
    color: #ffffff;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.dashboard-card:hover .icon-circle {
    transform: scale(1.1);
}

/* Counter */
.counter {
    font-weight: 600;
    font-size: 1.3rem;
    color: #314E52;
}

/* Buttons */
.btn-gold {
    background-color: #1276B7;
    color: #ffffff !important;
}

.btn-outline-gold {
    color: #0C6161;
    border: 1px solid #1276B7;
}

</style>

<script>
    // Simple counter animation
    document.querySelectorAll('.counter').forEach(counter => {
        const updateCount = () => {
            const target = +counter.innerText;
            let count = 0;
            const increment = target / 50;
            const update = () => {
                count += increment;
                if (count < target) {
                    counter.innerText = Math.floor(count);
                    requestAnimationFrame(update);
                } else {
                    counter.innerText = target;
                }
            };
            update();
        };
        updateCount();
    });
</script>