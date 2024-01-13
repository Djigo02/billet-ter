{{-- START --}}
<nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
    <div class="container">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <p class="h4" aria-current="page" > <i class="fa-solid fa-train-subway"></i> Bonjour {{Session::get('utilisateur')['prenom']}} {{Session::get('utilisateur')['nom']}}</p>
          </li>
        </ul>
        <form class="d-flex mr-5" role="search">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Option
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="">{{Session::get('utilisateur')['prenom']}} {{Session::get('utilisateur')['nom']}}</a></li>
                  <li><a class="dropdown-item" href="{{route('reserver')}}">Reserver</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{route('deconnexion')}}"><i class="fa-solid fa-power-off"></i> Deconnexion</a></li>
                </ul>
              </div>
        </form>
      </div>
    </div>
  </nav>
{{-- END  --}}