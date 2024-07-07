<nav class="navbar navbar-expand-lg bg-red">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4 text-white" href="{{ route('main') }}">ЛИГХТ</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav d-flex align-items-center w-100">
                <li class="nav-item w-50 mx-auto">
                    <form action="{{ route('main') }}">
                        <div class="bg-white rounded-c d-flex w-100">
                            <input type="text" name="search" class="p-2 w-100 form-control"
                                style="border: none; border-radius: 20px">
                            <button class="btn rounded-c">
                                <img src="/icons/magnifier.svg" alt="лупа" width="30" height="30">
                            </button>
                        </div>
                    </form>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">
                            <img src="{{ url('/icons/user.svg') }}" alt="profile" width="40" height="40">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart') }}">
                            <img src="/icons/cart.svg" alt="profile" width="40" height="40">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('favourite') }}">
                            <img src="/icons/like.svg" alt="profile" width="40" height="40">
                        </a>
                    </li>
                    @if (auth()->user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin') }}">
                                <img src="/icons/admin.svg" alt="admin" width="40" height="40">
                            </a>
                        </li>
                    @endif
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link btn btn-white rounded-c me-2" href="{{ route('login') }}">Войти</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-white rounded-c" href="{{ route('register') }}">Регистрация</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
