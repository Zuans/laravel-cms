<link rel="stylesheet" href="{{ asset('css/nav.css') }}">
<ul class="nav bg-dark py-5 px-1 flex-column">
    <li class="nav-item  p-2">
        <h1 class="text-center text-white">Hi, {{ Auth::user()->name }}</h1>
    </li>
    <hr class="w-50 mx-auto" style="border: 1px solid white;">
    <li class="nav-item p-1 mt-3 ">
        <a class="nav-link text-white nav-size font-weight-bold" href="{{ route('home') }}"><i class="fas text-primary text-white pr-4 fa-user"></i>Info</a>
    </li>
    <li class="nav-item p-1 ">
        <a class="nav-link text-white nav-size font-weight-bold" href="{{ route('dashboard.postSett') }}"><i class="fas text-primary fa-user-cog pr-3"></i>All Post</a>
    </li>
    <li class="nav-item p-1 ">
        <a class="nav-link text-white nav-size font-weight-bold" href="{{ route('dashboard.addPost') }}"><i class="fas fa-plus pr-3 text-primary"></i>Add Post</a>
    </li>
    <li class="nav-item p-1 ">
        <a class="nav-link text-white nav-size font-weight-bold" href="{{ route('dashboard.yourPost') }}"><i class="fas text-primary fa-user-edit  pr-3 "></i>Your Post</a>
    </li>

</ul>