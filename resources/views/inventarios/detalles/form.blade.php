@extends('theme.base')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if (isset($detalle))
                        <h1>Editar Inventario Detalle: # {{$detalle->id}}</h1>
                    @else
                        <h1>Registrar Inventario Detalle: # {{$id}}</h1>
                        @if (Session::has('mensaje'))
                            <div class="alert info my-5">
                                {{ Session::get('mensaje')}}
                            </div>
                        @endif
                    @endif
                </div>
                <div class="card-body">
                    @if (isset($detalle))
                        <form action={{ route('detalles.update', $detalle->id) }} method="post">
                            @method('PUT')
                    @else
                        <form action={{ route('detalles.store') }} method="post">
                    @endif
                    
                    @csrf
                        <div class="form-group" hidden>
                            <label for="id_inventario" class="form-label">Id</label>
                            @if (isset($detalle))
                                <input class="form-control" type="text" name="id_inventario" value='{{$detalle->id_inventario}}'>
                            @else
                                <input class="form-control" type="text" name="id_inventario" value='{{$id}}'>
                            @endif

                            @error('id_inventario')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="objeto_gasto" class="form-label">Objeto gasto</label>
                            <input required class="form-control input" type="number" step="0" name="objeto_gasto" placeholder="Escriba el valor de gasto" value="{{ old('objeto_gasto') ?? @$detalle->objeto_gasto }}">
                            @error('objeto_gasto')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="valor_adquirido" class="form-label">Valor adquirido</label>
                            <input required class="form-control input" type="number" step="0.000" id="valor_adquirido" name="valor_adquirido" placeholder="Escriba el valor adquirido" value="{{ old('valor_adquirido') ?? @$detalle->valor_adquirido }}" >
                            @error('valor_adquirido')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="valor_residual" class="form-label">Valor residual</label>
                            <input required class="form-control input" type="number" step="0.000" id="valor_residual" name="valor_residual" placeholder="Escriba el valor residual" value="{{ old('valor_residual') ?? @$detalle->valor_residual }}">
                            @error('valor_residual')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="vida_util" class="form-label">Vida util</label>
                            <input required class="form-control input" type="number" id="vida_util" name="vida_util" placeholder="Escriba la vida util" value="{{ old('vida_util') ?? @$detalle->vida_util }}">
                            @error('vida_util')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="interes" class="form-label">Interés</label>
                            <input required class="form-control input" type="number" step="0.00" id="interes" name="interes" placeholder="Escriba la tasa de interés" value="{{ old('interes') ?? @$detalle->interes }}">
                            @error('interes')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="depreciacion_mensual1" class="form-label">Depreciación Mensual</label>
                            <input disabled class="form-control input" type="number" step="0.000" id="depreciacion_mensual1" name="depreciacion_mensual1" placeholder="Escriba la depreciación mensual" value="{{ old('depreciacion_mensual') ?? @$detalle->depreciacion_mensual }}" >
                            <input type="hidden" id="depreciacion_mensual" name="depreciacion_mensual">
                            @error('depreciacion_mensual')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="depreciacion_anual1" class="form-label">Depreciación Anual</label>
                            <input disabled class="form-control input" type="number" step="0.000" id="depreciacion_anual1" name="depreciacion_anual1" placeholder="Escriba la depreciación anual" value="{{ old('depreciacion_anual') ?? @$detalle->depreciacion_anual }}" >
                            <input type="hidden" id="depreciacion_anual" name="depreciacion_anual">
                            @error('depreciacion_anual')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="depreciacion_acumulada1" class="form-label">Depreciación Acumulada</label>
                            <input disabled required class="form-control input" type="number" step="0.000" id="depreciacion_acumulada1" name="depreciacion_acumulada1" placeholder="Escriba la depreciación acumulada" value="{{ old('depreciacion_acumulada') ?? @$detalle->depreciacion_acumulada }}" >
                            <input type="hidden" id="depreciacion_acumulada" name="depreciacion_acumulada">
                            @error('depreciacion_acumulada')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="valor_desecho" class="form-label">Valor desecho</label>
                            <input required class="form-control input" type="number" step="0.000" id="valor_desecho" name="valor_desecho" placeholder="Escriba el valor desecho" value="{{ old('valor_desecho') ?? @$detalle->valor_desecho }}">
                            @error('valor_desecho')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group py-2">
                            <label for="valor_libros1" class="form-label">Valor en libros</label>
                            <input disabled class="form-control input" type="number" step="0.000" id="valor_libros1" name="valor_libros1" placeholder="Escriba el valor en libros" value="{{ old('valor_libros') ?? @$detalle->valor_libros }}" >
                            <input type="hidden" id="valor_libros" name="valor_libros">
                            @error('depreciacion_acumulada')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="button" class="btn btn-primary" id="cal_depr" name="cal_depr" value="Calcular datos" >
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="fecha_compra" class="form-label">Fecha compra</label>
                            <input required class="form-control" type="date" name="fecha_compra" value="{{ old('fecha_compra') ?? @$detalle->fecha_compra }}">
                            @error('fecha_compra')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fecha_desecho" class="form-label">Fecha desecho</label>
                            <input required class="form-control" type="date" name="fecha_desecho" value="{{ old('fecha_desecho') ?? @$detalle->fecha_desecho }}">
                            @error('fecha_desecho')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nombre_activo" class="form-label">Nombre activo</label>
                            <input class="form-control" type="text" name="nombre_activo" placeholder="Escriba la descripción" value="{{ old('nombre_activo') ?? @$detalle->nombre_activo }}">
                            @error('nombre_activo')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input class="form-control" type="text" name="descripcion" placeholder="Escriba la descripción" value="{{ old('descripcion') ?? @$detalle->descripcion }}">
                            @error('descripcion')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="ubicacion" class="form-label">Ubicación</label>
                            <input required class="form-control" type="text" name="ubicacion" placeholder="Escriba la ubicación" value="{{ old('ubicacion') ?? @$detalle->ubicacion }}">
                            @error('ubicacion')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="encargado" class="form-label">Encargado</label>
                            <input required class="form-control" type="text" name="encargado" placeholder="Escriba el encargado" value="{{ old('encargado') ?? @$detalle->encargado }}">
                            @error('encargado')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="region" class="form-label">Región</label>
                            <input required class="form-control" type="text" name="region" placeholder="Escriba la región" value="{{ old('region') ?? @$detalle->region }}">
                            @error('region')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tipo_activo" class="form-label">Tipo de activo</label>
                            <select name="tipo_activo" class="form-control">
                                <option required value="">Seleccione Tipo de Activo</option>
                                @foreach($tipo_activo as $id => $descripcion)
                                    @if(isset($detalle))
                                        <option value="{{ $id }}" {{ ($id == old("tipo_activo", $detalle->tipo_activo))? "selected":"" }}>{{ $descripcion }}</option>
                                    @else
                                        <option value="{{ $id }}" >{{ $descripcion }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('tipo_activo')
                                <p class="form-text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <br/>
                        @if (isset($detalle))
                            <button type="submit" class="btn btn-success" onclick="return confirm('¿Deseá modificar el detalle?')">Editar</button>
                            {{-- <form action="{{ route('detalles.index') }}" method="post">
                                @method('GET')
                                @csrf
                                <input type ="hidden" id="fecha1" name="fecha1">
                                <input type ="hidden" id="fecha2" name="fecha2">
                                <button type="submit" id="cancelar" name="cancelar" class="btn btn-secondary">Cancelar</button>
                            </form> --}}
                            <a href={{ route('detalles.index') }} type="button" class="btn btn-secondary">Cancelar</a>
                        @else
                            <button type="submit" class="btn btn-success" onclick="return confirm('¿Deseá registrar el detalle?')">Guardar</button>
                            <a href={{ route('encabezados.index') }} type="button" class="btn btn-secondary">Cancelar</a>
                        @endif
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{asset('js/jquery.min.js')}}"></script>


<script type="text/javascript">
    
    $('#cal_depr').bind('click',function(){
        var importe = $('#valor_adquirido').val();
        var interes = $('#interes').val();
        var vida_util = $('#vida_util').val();
        var valor_residual = $('#valor_residual').val();
        var valor_desecho = $('#valor_desecho').val();
    
        if(importe == ""){
            alert('¡El campo valor adquirido esta vacio!');
        }
        else if(interes == ""){
            alert('¡El campo interés esta vacio!');
        }
        else if(vida_util == ""){
            alert('¡El campo vida util esta vacio!');
        }
        else if(valor_residual == ""){
            alert('¡El campo valor residual esta vacio!');
        }
        else if(valor_desecho == ""){
            alert('¡El campo valor desecho esta vacio!');
        }
        else{
            vida_util = vida_util;
            var pago_mensual = (importe - valor_residual)/(vida_util * 12);
            var pago_anual = (importe - valor_residual)/vida_util;
            var valor_libros = importe - valor_desecho;

            $('#depreciacion_mensual1').val(pago_mensual);
            $('#depreciacion_anual1').val(pago_anual);
            $('#depreciacion_acumulada1').val(pago_anual);
            $('#valor_libros1').val(valor_libros);

            // Hidden
            $('#depreciacion_mensual').val(pago_mensual);
            $('#depreciacion_anual').val(pago_anual);
            $('#depreciacion_acumulada').val(pago_anual);
            $('#valor_libros').val(valor_libros);
        }
        
    });

</script>

@endsection

