@extends('theme.base')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if (isset($laboratorio))
                        <h1>Editar laboratorio</h1>
                    @else
                        <h1>Registrar laboratorio</h1>
                    @endif
                </div>
                <div class="card-body">
                    @if (isset($laboratorio))
                        <form action={{ route('laboratorios.update', $laboratorio->id) }} method="post">
                            @method('PUT')
                    @else
                        <form action={{ route('laboratorios.store') }} method="post">
                    @endif
                    
                    @csrf
                        <div class="form-group">
                            <label for="nombre_laboratorio" class="form-label">Nombre</label>
                            <input class="form-control input" type="text" name="nombre_laboratorio" placeholder="Escriba el nombre para el laboratorio" value="{{ old('nombre_laboratorio') ?? @$laboratorio->nombre_laboratorio }}">
                            @error('nombre_laboratorio')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <br/>
                        @if (isset($laboratorio))
                            <button type="submit" class="btn btn-success" onclick="return confirm('¿Deseá modificar el laboratorio?')">Editar</button>
                        @else
                            <button type="submit" class="btn btn-success" onclick="return confirm('¿Deseá registrar el laboratorio?')">Guardar</button>
                        @endif
                        <a href={{ route('laboratorios.index') }} type="button" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/app.css') }}">

@endsection

