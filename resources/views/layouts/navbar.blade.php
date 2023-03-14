<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <div class="container">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
        @if (Route::has('login'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @endif

        @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->nama }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                {{-- home aplikasi --}}
                <a class="dropdown-item" href="/" >
                    {{ __('Home Aps') }}
                </a>

                {{-- update prof --}}
                <a class="dropdown-item" href="/update/users/{{ Auth::user()->id }}">
                    {{ __('Update Profile') }}
                </a>

                {{-- save post --}}
                <div class="border-bottom pb-2">
                    <a class="dropdown-item" href="{{ route('post-saves.show',['post' => auth()->user()->id ]) }}">
                        {{ __('Saved Post') }}
                    </a>
                  </div>

                {{-- logout --}}
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        @endguest
    </ul>
</div>
</nav>