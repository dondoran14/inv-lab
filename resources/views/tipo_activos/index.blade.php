@extends('theme.base')

@section('content')
    <div class="container py-5 float-none">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Listado de tipo de activos</h1>
                        <a href={{ route('tipo_activos.create') }} class="btn btn-success btn-sm float-right">Agregar tipo de activos</a>
                        @if (Session::has('mensaje'))
                            <div class="alert info my-5">
                                {{ Session::get('mensaje')}}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-lg">
                            <table class="table" id="tabla">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Tipo de activo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <body>
                                @foreach ($tipo_activo as $detail)
                                    <tr>
                                        <td>{{$detail->id}}</td>
                                        <td>{{$detail->descripcion}}</td>
                                        <td>
                                            <a href={{ route('tipo_activos.edit', $detail) }} class="btn btn-info">Editar</a>
                                            <form action="{{ route('tipo_activos.destroy', $detail->id) }}" method="post" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este tipo?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                {{-- @empty
                                    <tr>
                                        <td colspan="2" class="text-center">No hay registros</td>
                                    </tr> --}}
                                @endforeach
                                </tbody>
                            </table>
                            {{-- @if ($tipo_activo->count())
                                {{$tipo_activo->links()}}
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
    <script src="{{asset('js/datatables.min.js')}}"></script>

    <script type="text/javascript">
        $("#tabla").DataTable({
            "language": {
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "previous": "Anterior",
                    "next": "Siguiente",
                },
                "info": "Mostrar Entradas de _START_ a _TOTAL_",
                "infoEmpty": "Total de Entradas 0",
                "infoFiltered": "Filtrado de _MAX_ entradas totales",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "search": "Filtrar"
            }
        });
    </script>
@endsection