<nav class="navbar navbar-expand-md navbar-light navbar-laravel navbar-dark" style="background:#353434">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
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
            <li class="nav-item dropdown">
                <a class="nav-link text-white" href="{{ route('news.index') }}">{{ __('News') }}</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="{{ route('product.index') }}">{{ __('Products') }}</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('product.index') }}">{{__('All')}}</a>
                    <a class="dropdown-item" href="{{ route('product_type.index','1') }}">{{__('Action')}}</a>
                    <a class="dropdown-item" href="{{ route('product_type.index','2') }}">{{__('Education')}}</a>
                    <a class="dropdown-item" href="{{ route('product_type.index','3') }}">{{__('Cosplay')}}</a>
                    <a class="dropdown-item" href="{{ route('product_type.index','4') }}">{{__('Motion')}}</a>
                    <a class="dropdown-item" href="{{ route('product_type.index','5') }}">{{__('Puzzle')}}</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link text-white" href="{{ route('ranking.index','0') }}">{{ __('Leaderboard') }}</a>
                {{-- <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="{{ route('ranking.index') }}">{{ __('Leaderboard') }}</a> --}}
                {{-- <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('ranking.index','0') }}">{{ __('New Leaderboard') }}</a>
                    <a class="dropdown-item" href="leaderboard.php?id=1">{{ __('Hot Leaderboard') }}</a>
                </div> --}}
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link text-white" href="{{ route('video.index') }}">{{ __('Video') }}</a>
            </li>
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#">{{__('Collection')}}</a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('collect.index') }}">{{__('My Collection')}}</a>
                        <a class="dropdown-item" href="{{ route('my_order.index') }}">{{__('My Products')}}</a>
                    </div>
                </li>
                @if(Auth::user()->creator_null())
                <li class="nav-item dropdown">
                    <a class="nav-link text-white" href="{{ route('article.index') }}">{{__('Forum')}}</a>
                </li>
                @endif
                @endauth 
                @auth('admin')
                <li class="nav-item dropdown">
                    <a class="nav-link text-white" href="{{ route('admin.article.index') }}">{{__('Forum')}}</a>
                </li>
                @endauth
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#">{{__('Language')}}</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('lang','zh-tw') }}">{{__('Traditional Chinese')}}</a>
                        <a class="dropdown-item" href="{{ route('lang','en') }}">{{__('English')}}</a>
                    </div>
                </li>
                @auth
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" v-pre>
                            {{ Auth::user()->creator_name() }}　　{{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('order.index') }}">{{ __('Order') }}</a>
                        <a class="dropdown-item" href="{{ route('member.show') }}">{{__('Basic Information')}}</a>
                        <a class="dropdown-item" href="{{ route('member.edit') }}">{{__('Change Basic Information')}}</a>
                        <a class="dropdown-item" href="{{ route('member.pass.edit') }}">{{ __('Change Password') }}</a> 
                        @if(Auth::user()->creator_null())
                        <a class="dropdown-item" href="{{ route('management.index') }}">{{ __('Work Management') }}</a>                     
                        <a class="dropdown-item" href="{{ route('report.index','month') }}">{{ __('Report') }}</a> 
                        @else
                        <a class="dropdown-item" href="{{ route('creator.create') }}">{{ __('Apply Creator') }}</a> 
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @else 
                    @auth('admin')
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ auth('admin')->user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.creator') }}">{{ __('Creator Management') }}</a>
                            <a class="dropdown-item" href="{{ route('admin.new') }}">{{ __('New Management') }}</a>
                            <a class="dropdown-item" href="{{ route('admin.product') }}">{{ __('Products Management') }}</a>
                            <a class="dropdown-item" href="{{ route('admin.report.index','month') }}">{{ __('Report') }}</a>
                            {{-- <a class="dropdown-item" href="{{ route('admin.member') }}">{{ __('Member Management') }}</a> --}}
                            <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('password.request') }}">{{ __('Request Password') }}</a>
                    </li>
                    @endauth 
                @endauth
            </ul>
        </div>
    </div>
</nav>