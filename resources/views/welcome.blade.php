@extends('theme.base')

@section('content')

<div id="carouselExampleIndicators" class="carousel slide py-5" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="cat">
            <img class="remove-bg" src="img/logo_inv-lab.jpg" alt="First slide" > 
        </div>
        <div class="carousel-caption d-none d-md-block">
            <h1>¡Bienvenidos!</h1>
            <p>...</p>
        </div>
      </div>
      <div class="carousel-item">
        <div class="cat">
            <img class="remove-bg" src="img/logo_inv-lab.jpg" alt="Second slide" > 
        </div>
        <div class="carousel-caption d-none d-md-block">
            <h2>Sistema</h2>
            <h2>Inventario x Laboratorio</h2>
            <p class="p1">Departamento de informática adminsitrativa UNAH</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
   
    <style>
        .remove-bg {
            filter: brightness(1.1);
            mix-blend-mode: multiply
        }

        h1 { color: #FF0000; }

        h2 { color: #FF0000; }

        .p1 { color: hsl(226, 100%, 50%); }

        img {
            max-width: 150%;
            max-height: 150%;
        }

        .cat {
            height:400px;
            width: 400px;
        }
    </style>
@endsection
