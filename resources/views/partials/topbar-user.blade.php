<nav class="navbar navbar-expand navbar-light bg-white topbar mb-2 static-top shadow">
   <!-- Sidebar Toggle-->
   @if(!session('webuser'))
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    @endif

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
            @if(session('vendoruser'))
                <a class="nav-link dropdown-toggle" href="{{route('host-logout')}}" id="userDropdown" role="button">
            @elseif(session('webuser'))
                <a class="nav-link dropdown-toggle" href="{{route('participent-logout')}}" id="userDropdown" role="button">
            @else
                <a class="nav-link dropdown-toggle" href="{{route('logout')}}" id="userDropdown" role="button">
            @endif


                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Logout</span>
                <img class="img-profile rounded-circle" src="{{ asset('assets/img/builder-icon.svg') }}">
                
            </a>
        </li>
    </ul>
</nav>
