 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/cms') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>CMS</span>
        </a>
    </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/categories') }}">
            <i class="fa fa-list-alt"></i>
            <span>Category</span>
        </a>
    </li>
       <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/tags') }}">
            <i class="fa fa-tags"></i>
            <span>Tags</span>
        </a>
    </li>
       <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/blogs') }}">
            <i class="fa fa-fw fa-table"></i>
            <span>Blogs</span>
        </a>
    </li>
       <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/awaiting') }}">
            <i class="fa fa-user-clock"></i>
            <span>Awating Approval</span>
        </a>
    </li>
        
</ul>
    <!-- End of Sidebar -->