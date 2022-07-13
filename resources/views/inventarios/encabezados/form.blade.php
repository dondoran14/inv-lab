@extends('theme.base')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if (isset($encabezado))
                        <h1>Editar Inv. Encabezado</h1>
                    @else
                        <h1>Registrar Inv. Encabezado</h1>
                    @endif
                </div>
                <div class="card-body">
                    @if (isset($encabezado))
                        <form action={{ route('encabezados.update', $encabezado->id) }} method="post">
                            @method('PUT')
                    @else
                        <form action={{ route('encabezados.store') }} method="post">
                    @endif
                    
                    @csrf
                        <div class="form-group">
                            <label for="id_laboratorio" class="form-label">Laboratorio</label>
                            <select name="id_laboratorio" class="form-control">
                                <option value="">Seleccione Laboratorio</option>
                                @foreach($laboratorio as $id => $nombre_laboratorio)
                                    @if(isset($encabezado))
                                        <option value="{{ $id }}" {{ ($id == old("id_laboratorio", $encabezado->id_laboratorio))? "selected":"" }}>{{ $nombre_laboratorio }}</option>
                                    @else
                                        <option value="{{ $id }}" >{{ $nombre_laboratorio }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('id_laboratorio')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gestion" class="form-label">Gestión</label>
                            <input class="form-control input" type="text" name="gestion" placeholder="Escriba el nombre de gestión" value="{{ old('gestion') ?? @$encabezado->gestion }}">
                            @error('gestion')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="numero_inventario" class="form-label">Número de inventario</label>
                            <input class="form-control input" type="text" name="numero_inventario" placeholder="Escriba el número de inventario" value="{{ old('numero_inventario') ?? @$encabezado->numero_inventario }}">
                            @error('numero_inventario')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="numero_ficha" class="form-label">Número de ficha</label>
                            <input class="form-control input" type="text" name="numero_ficha" placeholder="Escriba el número de ficha" value="{{ old('numero_ficha') ?? @$encabezado->numero_ficha }}">
                            @error('numero_ficha')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input class="form-control input" type="text" name="descripcion" placeholder="Escriba la descripción" value="{{ old('descripcion') ?? @$encabezado->descripcion }}">
                            @error('descripcion')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        @if (isset($encabezado))
                        <div class="input-group d-inline m-2">
                            <label for="check">Marcar Estado de Inventario como: (Cerrado ó Abierto)</label>
                            <input type="checkbox" id="check" name="check" class="form-checkbox">
                            <input type="hidden" class="form-control" id="estado" name="estado">
                            <br/>
                        </div>
                        @else
                        <input type="hidden" class="form-control" id="estado" name="estado">
                        @endif

                        <br/>
                        @if (isset($encabezado))
                            <button type="submit" class="btn btn-success" onclick="return confirm('¿Deseá modificar el encabezado?')">Editar</button>
                        @else
                            <button type="submit" class="btn btn-success" onclick="return confirm('¿Deseá registrar el encabezado?')">Guardar</button>
                        @endif
                        <a href={{ route('encabezados.index') }} type="button" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{asset('js/jquery.min.js')}}"></script>

<script type="text/javascript">
    $('#estado').val('abierto');

    $(document).ready(function()
    {
        $('#check').on('change', function(){
            if( $('#check').is(':checked') ) {
                $('#estado').val('cerrado');
            }else{
                $('#estado').val('abierto');
            }
        });
    });

</script>

@endsection