@extends('theme.base')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Revisar Inventarios Creados</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('detalles.index') }}" method="post">
                        {{-- @method('GET') --}}
                        @csrf
                        <div class="form-group">
                            <label for="fecha1">Desde fecha</label>
                            <input type="date" class="form-control" id="fecha1" name="fecha1">
                            <input type="hidden" class="form-control" id="f1" name="f1">
                        </div>
                        <div class="form-group">
                            <label for="fecha2">Desde fecha</label>
                            <input type="date" class="form-control" id="fecha2" name="fecha2">
                            <input type="hidden" class="form-control" id="f2" name="f2">
                        </div>
                        <br/>
                        <button type="submit" class="btn btn-primary">Mostrar información</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{asset('js/jquery.min.js')}}"></script>

<script type="text/javascript">
    $('#fecha1').bind('change', function(){
        var f1 = $('#fecha1').val();

        f1=f1 + ' 00:00:00';
        
        $('#f1').val(f1);
    });

    $('#fecha2').bind('change', function(){
        var f2 = $('#fecha2').val();

        f2=f2 + ' 00:00:00';
        
        $('#f2').val(f2);
    });

    
</script>
@endsection