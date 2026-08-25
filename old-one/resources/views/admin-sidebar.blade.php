<!-- Sidebar -->
<nav class="col-12 col-md-3 col-lg-2 offcanvas-md offcanvas-start sidebar vh-100 p-0" id="sidebarOffcanvas">

    <div class="offcanvas-header d-md-none border-bottom" style="background-color:#ffffff;">
        <h5 class="offcanvas-title text-dark">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="d-flex flex-column justify-content-between h-100" style="background-color:#ffffff;">

        <!-- Menu Items -->
        <ul class="nav flex-column mt-3 px-2 gap-2">

            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="nav-link d-flex align-items-center gap-2 sidebar-link 
                   {{ request()->routeIs('dashboard') ? 'active-link' : '' }}">
                    <i class="bi bi-speedometer2 fs-5"></i> Dashboard
                </a>
            </li>

            <!-- Add Category -->
            <li class="nav-item">
                <a href="{{ route('categories.create') }}"
                    class="nav-link d-flex align-items-center gap-2 sidebar-link 
                   {{ request()->routeIs('categories.create') ? 'active-link' : '' }}">
                    <i class="bi bi-grid fs-5"></i> Add Category
                </a>
            </li>

            <!-- All Category -->
            <li class="nav-item">
                <a href="{{ route('categories.index') }}"
                    class="nav-link d-flex align-items-center gap-2 sidebar-link 
                   {{ request()->routeIs('categories.index') ? 'active-link' : '' }}">
                    <i class="bi bi-list-ul fs-5"></i> All Category
                </a>
            </li>

            <!-- Add Blog -->
            <li class="nav-item">
                <a href="{{ route('admin.blogs.create') }}"
                    class="nav-link d-flex align-items-center gap-2 sidebar-link 
                   {{ request()->routeIs('admin.blogs.create') ? 'active-link' : '' }}">
                    <i class="bi bi-file-earmark-plus fs-5"></i> Add Blog
                </a>
            </li>

            <!-- All Blogs -->
            <li class="nav-item">
                <a href="{{ route('admin.blogs.index') }}"
                    class="nav-link d-flex align-items-center gap-2 sidebar-link 
                   {{ request()->routeIs('admin.blogs.index') ? 'active-link' : '' }}">
                    <i class="bi bi-journal-text fs-5"></i> All Blogs
                </a>
            </li>

            <!-- Gallery -->
            <!-- <li class="nav-item">
                <a href="{{ route('admin.gallery.index') }}"
                   class="nav-link d-flex align-items-center gap-2 sidebar-link 
                   {{ request()->routeIs('admin.gallery.index') ? 'active-link' : '' }}">
                    <i class="bi bi-images fs-5"></i> Gallery
                </a>
            </li> -->

            <!-- Pages -->
            <li class="nav-item">
                <a href="{{ route('admin.pages.index') }}"
                    class="nav-link d-flex align-items-center gap-2 sidebar-link 
                   {{ request()->routeIs('admin.pages.index') ? 'active-link' : '' }}">
                    <i class="bi bi-journal-text fs-5"></i> Pages
                </a>
            </li>

        </ul>

    </div>
</nav>


<!-- Add this in your <head> or before your styles -->
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Apply Rubik font globally or to sidebar */
    .sidebar {
        font-family: 'Rubik', sans-serif;
        background-color: #ffffff;
        border-right: 1px solid #e0e0e0;
    }

    /* Links default */
    .sidebar-link {
        color: #314E52;
        border-radius: 10px;
        padding: 12px 18px;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        font-family: 'Rubik', sans-serif;
    }

    /* Hover effect */
    .sidebar-link:hover {
        background-color: #1276B7;
        color: #ffffff !important;
        transform: translateX(5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Active link */
    .sidebar-link.active-link {
        background-color: #1276B7;
        color: #ffffff !important;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Icons inside links */
    .sidebar-link i {
        transition: transform 0.3s ease, color 0.3s ease;
    }

    /* Hover icon animation */
    .sidebar-link:hover i {
        transform: translateX(3px);
        color: #fff;
    }

    /* Logout button */
    .logout-btn {
        background-color: #1276B7;
        color: #fff !important;
        border-radius: 10px;
        padding: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-family: 'Rubik', sans-serif;
    }

    .logout-btn:hover {
        background-color: #1C3B7A;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
</style>
