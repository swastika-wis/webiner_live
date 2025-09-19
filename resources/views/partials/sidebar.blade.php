<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#"> 
        <div class="sidebar-brand-text mx-3">
            @if(Auth::user())
                {{ Auth::user()?->name ?? 'Guest' }}
            @elseif(session('vendoruser'))
                {{ session('vendoruser')->name ?? 'Guest' }}
            @elseif(session('webuser'))
                {{ session('webuser')->full_name ?? 'Guest' }}
            @endif

        </div>
    </a>

    <hr class="sidebar-divider my-0">

    @if(Auth::user())

    <li class="nav-item @if(Request::is('dashboard')) active @endif">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item @if(Request::is('vendors')) active @endif">
        <a class="nav-link" href="{{ route('vendor') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Vendor</span>
        </a>
    </li>
    
    <li class="nav-item @if(Request::is('create-meeting')) active @endif">
        <a class="nav-link" href="{{route('create-meeting')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Create Meetings</span>
        </a>
    </li>

     <li class="nav-item @if(Request::is('meetings/*','qna-list/*','meeting-poll-list/*')) active @endif">
            <a class="nav-link" href="{{route('meeting','scheduled')}}">
                <i class="fas fa-fw fa-table"></i>
                <span>List Of Meetings</span>
            </a>
    </li>

    <!-- <li class="nav-item @if(Request::is('vendor-poll-list','create-poll/*')) active @endif">
        <a class="nav-link" href="{{route('vendor-poll-list')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>All Polls </span>
        </a>
    </li>

    <li class="nav-item @if(Request::is('vendor-qna-list')) active @endif">
        <a class="nav-link" href="{{route('vendor-qna-list')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Question and Answers </span>
        </a>
    </li> -->
    

    @endif

  
    @if( session('vendoruser'))
    <li class="nav-item @if(Request::is('vendor-dashboard')) active @endif">
        <a class="nav-link" href="{{route('vendor-dashboard')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>List Of Meetings </span>
        </a>
    </li>

    <li class="nav-item @if(Request::is('vendor-poll-list','create-poll/*')) active @endif">
        <a class="nav-link" href="{{route('vendor-poll-list')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>All Polls </span>
        </a>
    </li>

    <li class="nav-item @if(Request::is('vendor-qna-list')) active @endif">
        <a class="nav-link" href="{{route('vendor-qna-list')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Question and Answers </span>
        </a>
    </li>

    @endif

</ul>
