<nav class="navbar navbar-expand-lg navbar-light header-navbar navbar-static ml-0">
    <div class="container-fluid navbar-wrapper">
        <div class="navbar-header d-flex">
            <img class="streamstats-logo-sm" src="{{asset('app-assets/img/logos/app-01.png')}}"
                 alt="Top StreamStats App">
            <switch-api-version-component></switch-api-version-component>

        </div>
        <div class="navbar-container">
            <div class="collapse navbar-collapse d-block" id="navbarSupportedContent">
                @auth
                    <ul class="navbar-nav">


                        <li class="dropdown nav-item mr-1"><a
                                class="nav-link dropdown-toggle user-dropdown d-flex align-items-end"
                                id="dropdownBasic2"
                                href="javascript:;" data-toggle="dropdown">
                                <div class="user d-md-flex d-none mr-2"><span
                                        class="text-right">{{ Auth::user()->name }}</span>
                                    @if(Auth::user()->twitch_id)<span
                                        class="text-right text-muted font-small-3">Twitch</span></div>@endif
                                <img class="avatar"
                                     src="@if(Auth::user()->avatar) {{Auth::user()->avatar}} @else ../../../app-assets/img/portrait/small/avatar-s-1.png @endif"
                                     alt="avatar"
                                     height="35" width="35">
                            </a>
                            <div class="dropdown-menu text-left dropdown-menu-right m-0 pb-0"
                                 aria-labelledby="dropdownBasic2">


                                <a class="dropdown-item" href="{{route('home')}}">
                                    Dashboard
                                </a>
                                <a class="dropdown-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <div class="d-flex align-items-center" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                            class="ft-power mr-2"></i><span>Logout</span>
                                    </div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </a>
                            </div>
                        </li>
                    </ul>
                @else
                    <a class="btn btn-lg twitch-btn"
                       href="{{route('auth.redirect', ['driver'=>\App\Http\Controllers\Oauth\Twitch::DRIVER])}}"><i
                            class="fa fa-twitch"></i> Connect with Twitch </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
<!-- Navbar (Header) Ends-->
