@extends('theme.base')

@section('content')
    <div class="container py-5 float-none">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Listado de Usuarios</h1>
                        <a href={{ route('auth.create') }} class="btn btn-success btn-sm float-right">Agregar usuario</a>
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
                                        <th>Nombre completo</th>
                                        <th>Correo institucional</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <body>
                                @foreach ($auth as $detail)
                                    <tr>
                                        <td>{{$detail->id}}</td>
                                        <td>{{$detail->name}}</td>
                                        <td>{{$detail->email}}</td>
                                        <td>{{$detail->estado}}</td>
                                        <td>
                                            <a href={{ route('auth.edit', $detail->id) }} class="btn btn-info">Editar</a>
                                            {{-- <form action="{{ route('auth.destroy', $detail->id) }}" method="post" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                                </body>
                            </table>
                            {{-- @if ($auth->count())
                                {{$auth->links()}}
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/bootstrap.min.js')}}"></script>
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