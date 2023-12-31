<nav class="navbar navbar-expand-md navbar-light bg-custom">
    <style>
        .bg-custom {
            background-color: #C2EDFB;
        }
    </style>
    <div class="container">
        <a class="navbar-brand" href="{{ route('post.index') }}">
            Knowledge
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    <!-- 新規登録画面のヘッダー -->
                    @if (Route::currentRouteName() === 'register')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                        </li>

                    <!-- ログイン画面のヘッダー -->
                    @elseif (Route::currentRouteName() === 'login')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                        </li>
                    @endif

                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('post.show') }}">{{ __('投稿') }}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('post.index') }}">{{ __('投稿一覧') }}</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
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
    </div>
</nav>
