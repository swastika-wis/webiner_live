<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text mx-3">{{ Auth::user()?->name ?? 'Guest' }}</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item @if(Request::is('dashboard')) active @endif">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item @if(Request::is('vendor')) active @endif">
        <a class="nav-link" href="{{ route('vendor') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Vendor</span>
        </a>
    </li>

     <li class="nav-item @if(Request::is('meeting')) active @endif">
        <a class="nav-link" href="{{route('meeting','scheduled')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>List Of Meetings</span>
        </a>
    </li>


    <li class="nav-item @if(Request::is('create-meeting')) active @endif">
        <a class="nav-link" href="{{route('create-meeting')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Create Meetings</span>
        </a>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-table"></i>
            <span>My Leads</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/rpfoHicZRs/vendors">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Vendors</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/rpfoHicZRs/presenter">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Presenter</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/rpfoHicZRs/seminar">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Seminar</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/rpfoHicZRs/liveusers">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Live Users</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/rpfoHicZRs/questions">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Live Questions</span>
        </a>
    </li> --}}

    {{-- <hr class="sidebar-divider d-none d-md-block"> --}}

    {{-- <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> --}}
</ul>
