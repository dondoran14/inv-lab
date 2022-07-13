@extends('theme.base')

@section('content')
    <div class="container py-5 float-none">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Listado de inventarios encabezados</h1>
                        <a href={{ route('encabezados.create') }} class="btn btn-success btn-sm float-right">Agregar Inventario Encabezado</a>
                        @if (Session::has('mensaje'))
                            <div class="alert info my-5">
                                {{ Session::get('mensaje')}}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="tabla">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Número Inventario</th>
                                        <th>Laboratorio</th>
                                        <th>Gestión</th>
                                        <th>Número Ficha</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <body>
                                @foreach ($encabezado as $detail)
                                    <tr>
                                        <td>{{$detail->id}}</td>
                                        <td>{{$detail->numero_inventario}}</td>
                                        <td>{{$detail->nombre_laboratorio}}</td>
                                        <td>{{$detail->gestion}}</td>
                                        <td>{{$detail->numero_ficha}}</td>
                                        <td>{{$detail->descripcion}}</td>
                                        <td>{{$detail->estado}}</td>
                                        <td>
                                            @if ($detail->estado === "abierto")
                                                <a href={{ route('detalles.show', $detail->id) }} class="btn btn-primary">Detalles</a> |
                                            @else
                                                <a onclick="return alert('Inventario Cerrado');" class="btn btn-primary" disabled>Detalles</a> |
                                            @endif

                                            <a href={{ route('encabezados.edit', $detail) }} class="btn btn-info">Editar</a> |

                                            <form action="{{ route('encabezados.destroy', $detail->id) }}" method="post" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este inventario?')">Eliminar</button>
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
                            {{-- @if ($encabezado->count())
                                {{$encabezado->links()}}
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> --}}
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

