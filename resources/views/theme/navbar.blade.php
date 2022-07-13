<nav class="navbar navbar-light bg-primary fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" style="color: white" href="#">Sistema de Inventario x Laboratorio</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <hr/>
        <div class="offcanvas-header">
          @if(auth()->user()->name != "")
              <h5 class="mayuscula">{{ auth()->user()->name }}</h5>
          @endif
        </div>
        <hr class="dropdown-divider">
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link" href="./">Inicio</a>
            </li>

            @if(auth()->user()->id_perfil == 2)
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Seguridad
              </a>
              <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                <li><a class="dropdown-item" href="{{ route('laboratorios.index') }}">Laboratorios</a></li>
                <li><a class="dropdown-item" href="{{ route('tipo_activos.index') }}">Tipo de activos</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="{{ route('auth.index') }}">Usuarios</a></li>
              </ul>
            </li>
            @endif
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Inventarios
              </a>
              <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                <li><a class="dropdown-item" href="{{ route('encabezados.index') }}">Registrar Inventario</a></li>
                <li><a class="dropdown-item" href="{{ route('detalles.index') }}">Listado de inventarios</a></li>
              </ul>
            </li>
          </ul>
          <form class="d-flex" action="{{ route('auth.logout') }}" method="POST">
            @csrf
            <input type="submit" class="btn btn-outline-danger btn-right mt-1" value="Cerrar sesión">
          </form>
        </div>
      </div>
    </div>
  </nav>

  <style>
    .mayuscula { text-transform: uppercase;} 
  </style>