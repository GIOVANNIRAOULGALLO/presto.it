<nav class="navbar navbar-expand-lg first-color navbar-presto">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('homepage')}}" class="me-3"> <img src="/img/logo.png" width="40" height="40" alt="" ></a>
    <button class="navbar-toggler  text-light me-2 " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fa-solid fa-bars text-light"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{route('register')}}">{{__('ui.register')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('login')}}">Login</a>
        </li>
        @endguest
        <li class="nav-item">
          <a href="{{route('announce.create')}}" class="nav-link">{{__('ui.announce-create')}}</a>
        </li>
        @auth
        @if (Auth::user()->is_revisor)
        <li class="nav-item"><a href="{{route('revisor.home')}}" class="nav-link">{{__('ui.announce-gestor')}}</a>
        </li>
        <li class="nav-item"><span class="btn btn-danger button-revisor mx-2">{{\App\Models\Announce::ToBeRevisionedCount()}}</span>
        </li>
        <li class="nav-item"><a href="{{route('revisor.basket')}}" class="nav-link mt-1"><i class="fa-solid fa-trash fs-5"></i></a>
        </li>
        @endif
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{__('ui.hello')}} {{Auth::user()->name}}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">Logout</a></li>
            <form method="POST" action="{{route('logout')}}" id="form-logout">
              @csrf
            </form>
            <li><a class="dropdown-item" href="{{route('mail.create')}}">{{__('ui.work')}}</a></li>
          </ul>
        </li>
        @endauth
        <form method="GET" action="{{route('search')}}" class="d-flex">
          <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="q">
          <button class="btn btn-outline-light" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
      </ul>
    </div>
  </div>
</nav>
