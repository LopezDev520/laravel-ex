<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!--<div class="flex items-center justify-center gap-2 p-1">
                <img src="/dist/img/user2-160x160.jpg" class="rounded-full w-10 h-10" alt="User Image">
                <p>{{ Auth::user()->name }}</p>
                <a data-widget="navbar-search" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="button">
                <i class="fas fa-power-off"></i>
            </a>
        </div>-->

        <div class="flex mr-3">
            <div class="bg-gray-300 p-1 flex items-center gap-2 rounded-tl-full rounded-bl-full">
                <img src="/dist/img/user2-160x160.jpg" class="w-10 rounded-full" />
                <p class="font-bold">{{ Auth::user()->name }}</p>
            </div>
            <a 
                class="grid place-content-center p-2.5 bg-gray-500 rounded-tr-full rounded-br-full cursor-pointer"
                href="{{ route("logout") }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                >
                <i class="fas fa-power-off text-white"></i>
            </a>
        </div>
    </ul>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</nav>
