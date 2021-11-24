<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <a class="navbar-brand text-white" href="{{ route('welcome') }}">
        <svg height="40px" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" style="width: 100%" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="comp_x5F_194-laravel">
                <polygon points="33,106 153,336 479,256 429,186 359,196 469,356 319,406 143,106    " style="fill:#F35045;" />
                <g>
                    <path d="M319.001,416.001c-3.471,0-6.792-1.814-8.626-4.94l-53.019-90.373l-101.973,25.024      c-4.471,1.1-9.118-1.002-11.249-5.086l-120-230c-1.618-3.1-1.498-6.819,0.314-9.809C26.261,97.826,29.503,96,33,96h110      c3.548,0,6.83,1.88,8.625,4.94l115.439,196.772l128.113-31.438l-44.418-64.608c-1.96-2.851-2.308-6.513-0.918-9.682      c1.39-3.168,4.318-5.394,7.744-5.883l70-10c3.692-0.531,7.38,1.048,9.552,4.087l50,70c1.928,2.699,2.392,6.178,1.239,9.288      c-1.153,3.109-3.772,5.446-6.994,6.236l-53.324,13.086l49.182,71.537c1.78,2.589,2.24,5.864,1.241,8.843      c-0.998,2.979-3.339,5.315-6.319,6.31l-150,50C321.12,415.834,320.054,416.001,319.001,416.001z M277.626,315.714l45.899,78.237      l129.706-43.236l-45.939-66.821L277.626,315.714z M49.497,116l108.74,208.418l88.559-21.731L137.273,116H49.497z       M376.374,203.62l39.57,57.557l46.342-11.372l-37.89-53.046L376.374,203.62z" style="fill:#B63C34;" />
                </g>
            </g>
            <g id="Layer_1" />
        </svg>
        Laravel Shopping
    </a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-light" href="{{ route('welcome') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('products.index') }}">Shop</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('allPosts') }}">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('aboutUs') }}">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('contactUs') }}">Contact Us</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Pages
                </a>
                <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item text-light hover" href="{{ route('contactUs') }}">Contact Us</a>
                    <a class="dropdown-item text-light hover" href="{{ route('aboutUs') }}">About Us</a>
                    <a class="dropdown-item text-light hover" href="{{ route('privacyPolicy') }}">Privacy & Policy</a>
                    <a class="dropdown-item text-light hover" href="{{ route('products.index') }}">Products</a>
                    <a class="dropdown-item text-light hover" href="{{ route('cart.index') }}">Cart</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('cart.index') }}">
                    <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 18px !important">
                    </i>
                    @if(Cart::instance('default')->count() > 0)
                    <span class="badge badge-pill badge-warning" style="font-size:10px">
                        {{ Cart::instance('default')->count()  }}
                    </span>
                    @endif
                </a>
            </li>
            @guest
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('register') }}">Register</a>
            </li>
            @endguest
            @if(Auth::user())
            @if(!Auth::user()->profile->avatar && Auth::user()->profile->gender =="male" )
            <img src="{{ asset('backend/dist/img/avatar5.png') }}" alt="" width="50px" class="rounded-circle">
            @elseif(!Auth::user()->profile->avatar && Auth::user()->profile->gender =="female")
            <img src="{{ asset('backend/dist/img/avatar3.png') }}" alt="" width="50px" class="rounded-circle">
            @else
            <img src="{{ asset('avatar-image/'.Auth::user()->profile->avatar) }}" alt="" width="50px" class="rounded-circle" style="margin-bottom: -10px !important">
            @endif
            <li class="nav-item dropdown float-right">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name}}
                </a>
                <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item text-light hover" href="{{ route('userProfile') }}">My Porfile</a>
                    @role('super-admin|admin|product-manger|post-editor')
                    <a class="dropdown-item text-light hover" href="{{ route('admin') }}">Admin Panel</a>
                    @endrole
                    <a class="dropdown-item text-light hover" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{ _('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            @endif
        </ul>
        {{-- @include('error.index') --}}
    </div>
</nav>
