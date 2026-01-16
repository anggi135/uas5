<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        {{-- LOGO --}}
        <a class="navbar-brand fw-bold text-danger" href="{{ route('home') }}">
            Baby Souvenir
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">

                {{-- MENU UMUM --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('souvenirs.index') }}">Produk</a>
                </li>

                {{-- ================= AUTH ================= --}}
                @auth
                    {{-- ADMIN --}}
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link fw-bold text-primary"
                               href="{{ route('admin.souvenirs.index') }}">
                                Admin Panel
                            </a>
                        </li>
                    @endif

                    {{-- USER --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders.index') }}">
                            Pesanan
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                           href="#"
                           data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('profile.edit') }}">
                                    Profil
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>

                @else
                    {{-- GUEST --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-danger btn-sm ms-lg-2"
                           href="{{ route('register') }}">
                            Daftar
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- SPACER --}}
<div style="height:72px"></div>
