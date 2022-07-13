@extends('theme.base')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if (isset($tipo_activo))
                        <h1>Editar Tipo de activo</h1>
                    @else
                        <h1>Registrar Tipo de activo</h1>
                    @endif
                </div>
                <div class="card-body">
                    @if (isset($tipo_activo))
                        <form action={{ route('tipo_activos.update', $tipo_activo->id) }} method="post">
                            @method('PUT')
                    @else
                        <form action={{ route('tipo_activos.store') }} method="post">
                    @endif
                    
                    @csrf
                        <div class="form-group">
                            <label for="descripcion" class="form-label">Nombre</label>
                            <input class="form-control input" type="text" name="descripcion" placeholder="Escriba el nombre para el tipo de activo" value="{{ old('descripcion') ?? @$tipo_activo->descripcion }}">
                            @error('descripcion')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <br/>
                        @if (isset($tipo_activo))
                            <button type="submit" class="btn btn-success" onclick="return confirm('¿Deseá modificar el tipo?')">Editar</button>
                        @else
                            <button type="submit" class="btn btn-success" onclick="return confirm('¿Deseá registrar el tipo?')">Guardar</button>
                        @endif
                        <a href={{ route('tipo_activos.index') }} type="button" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/app.css') }}">

@endsection

