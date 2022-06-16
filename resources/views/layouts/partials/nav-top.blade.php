<nav class="navbar navbar-expand fixed-top be-top-header">
    <div class="container-fluid">
        <div class="be-navbar-header"><a class="navbar-brand" href="index.html"></a>
        </div>
        <div class="page-title"><span>@yield('page-title')</span></div>
        <div class="be-right-navbar">
            <ul class="nav navbar-nav float-right be-user-nav">
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
                        role="button" aria-expanded="false"><img src="{{ asset('img/avatar.png') }}"
                            alt="Avatar"><span class="user-name">{{ auth()->user()->name }}</span></a>
                    <div class="dropdown-menu" role="menu">
                        <div class="user-info">
                            <div class="user-name">{{ auth()->user()->name }}</div>
                            <div class="user-position online">Available</div>
                        </div><a class="dropdown-item" href="pages-profile.html"><span
                                class="icon lar la-user"></span>Account</a><a class="dropdown-item" href="#"><span
                                class="icon las la-cog"></span>Settings</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span
                                class="icon las la-sign-out-alt"></span>Salir</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
