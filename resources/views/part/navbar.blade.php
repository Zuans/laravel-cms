<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand display-4" href="/">
        <h4 class="text-dark font-weight-bold pl-5">Zuans Post's</h4>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto py-2">
            @if (Route::has('login'))
            @auth
            <a href="{{ url('/home') }}" class="nav-item nav-link  font-weight-bold">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="nav-item nav-link  font-weight-bold">Login</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="nav-item nav-link  font-weight-bold">Register</a>
            @endif
            @endauth
            @endif
        </div>
    </div>
</nav>