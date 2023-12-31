<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

        <div class="logo me-auto">
            <h1><a href="/">Lumia</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/lumia/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                <li><a class="nav-link scrollto" href="#services">Services</a></li>
                <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li>
                <li><a class="nav-link scrollto" href="#testimonials">Testimonials</a></li>
                <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @if (Route::has('register'))
                        <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endif
                @else
                    <li class="dropdown"><a href="#"><span>Admin</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ url('/admin/v1/home') }}">Admin V1</a></li>
                            <li><a href="{{ url('/admin/v2/home') }}">Admin V2</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#"><span>{{ Auth::user()->name }}</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();document.getElementById('SignOutForm').submit();">Sign-Out</a>
                                <form id="SignOutForm" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
                {{--                <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>--}}
                {{--                    <ul>--}}
                {{--                        <li><a href="#">Drop Down 1</a></li>--}}
                {{--                        <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>--}}
                {{--                            <ul>--}}
                {{--                                <li><a href="#">Deep Drop Down 1</a></li>--}}
                {{--                                <li><a href="#">Deep Drop Down 2</a></li>--}}
                {{--                                <li><a href="#">Deep Drop Down 3</a></li>--}}
                {{--                                <li><a href="#">Deep Drop Down 4</a></li>--}}
                {{--                                <li><a href="#">Deep Drop Down 5</a></li>--}}
                {{--                            </ul>--}}
                {{--                        </li>--}}
                {{--                        <li><a href="#">Drop Down 2</a></li>--}}
                {{--                        <li><a href="#">Drop Down 3</a></li>--}}
                {{--                        <li><a href="#">Drop Down 4</a></li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <div class="header-social-links d-flex align-items-center">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
        </div>

    </div>
</header><!-- End Header -->
