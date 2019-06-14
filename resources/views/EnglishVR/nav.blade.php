<nav class="navbar navbar-expand-md navbar-light navbar-laravel navbar-dark" style="background:#353434">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Virtual學識
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            {{-- <li class="nav-item active">
                <a class="nav-link" href="{{ url('/') }}">首頁 <span class="sr-only">(current)</span></a>
            </li> --}}
            @auth
                <li class="nav-item dropdown">
                    <a class="nav-link text-white" href="{{ route('englishvr.playrecord') }}">遊玩紀錄</a>
                </li>
            @endauth 
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link text-white" href="{{ route('ranking.index','0') }}">{{ __('Leaderboard') }}</a>
                </li> --}}
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @auth
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->englishVR() }}　　{{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        {{-- <a class="dropdown-item" href="{{ route('order.index') }}">{{ __('Order') }}</a> --}}
                        <a class="dropdown-item" href="{{ route('englishvr.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('englishvr.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @else 
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('englishvr.login') }}">{{ __('Login') }}</a>
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>