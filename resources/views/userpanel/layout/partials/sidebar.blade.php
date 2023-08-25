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
        <a class="nav-link" href="{{ url('/user/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fa fa-list-alt"></i>
            <span>View Site</span>
        </a>
    </li>
       <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('user/createblog') }}">
            <i class="fa fa-tags"></i>
            <span>Create Blog</span>
        </a>
    </li>
       <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/user/awaitingblogs') }}">
            <i class="fa fa-fw fa-table"></i>
            <span>Awaiting Blogs</span>
        </a>
    </li> 
       <hr class="sidebar-divider">
    
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/user/approvedblogs') }}">
            <i class="fa fa-fw fa-table"></i>
            <span>Approved Blogs</span>
        </a>
    </li> 

</ul>
    <!-- End of Sidebar -->
