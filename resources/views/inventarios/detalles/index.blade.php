@extends('theme.base')

@section('content')
    <div class="container py-5 float-none">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Listado de inventarios</h1>
                        {{-- <a href={{ route('detalles.list_inv') }} class="float-right"><< Regresar a la búsqueda</a> | --}}
                        {{-- <input type ="text" class="d-inline" id="fecha1" name="fecha1" value="<?php echo $fecha1 ?>" disabled>
                        <input type ="text" class="d-inline" id="fecha2" name="fecha2" value="<?php echo $fecha2 ?>" disabled> --}}
                        @if (Session::has('mensaje'))
                            <div class="alert info my-5">
                                {{ Session::get('mensaje')}}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <table class="table-responsive display nowrap" id="tabla" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Número Inventario</th>
                                    <th>Laboratorio</th>
                                    <th>Nombre de activo</th>
                                    <th>Gestión</th>
                                    <th>Número Ficha</th>
                                    <th>Descripción</th>
                                    <th>Comentario</th>
                                    <th>Objeto gasto</th>
                                    <th>Valor adquirido</th>
                                    <th>Valor residual</th>
                                    <th>Vida util</th>
                                    <th>Interes</th>
                                    <th>Depreciación mensual</th>
                                    <th>Depreciación anual</th>
                                    <th>Depreciación acumulada</th>
                                    <th>Valor en libros</th>
                                    <th>Valor desecho</th>
                                    <th>Tipo de activo</th>
                                    <th>Fecha de inventario</th>
                                    <th>Fecha de compra</th>
                                    <th>Fecha de desecho</th>
                                    <th>Ubicación</th>
                                    <th>Encargado</th>
                                    <th>Región</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <body>
                            @foreach($detalle as $detail)
                                <tr>
                                    <td>{{$detail->id}}</td>
                                    <td>{{$detail->numero_inventario}}</td>
                                    <td>{{$detail->nombre_laboratorio}}</td>
                                    <td>{{$detail->nombre_activo}}</td>
                                    <td>{{$detail->gestion}}</td>
                                    <td>{{$detail->numero_ficha}}</td>
                                    <td>{{$detail->descripcion}}</td>
                                    <td>{{$detail->comentario}}</td>
                                    <td>{{$detail->objeto_gasto}}</td>
                                    <td>{{$detail->valor_adquirido}}</td>
                                    <td>{{$detail->valor_residual}}</td>
                                    <td>{{$detail->vida_util}}</td>
                                    <td>{{$detail->interes}}</td>
                                    <td>{{$detail->depreciacion_mensual}}</td>
                                    <td>{{$detail->depreciacion_anual}}</td>
                                    <td>{{$detail->depreciacion_acumulada}}</td>
                                    <td>{{$detail->valor_libros}}</td>
                                    <td>{{$detail->valor_desecho}}</td>
                                    <td>{{$detail->tipo}}</td>
                                    <td>{{$detail->created_at}}</td>
                                    <td>{{$detail->fecha_compra}}</td>
                                    <td>{{$detail->fecha_desecho}}</td>
                                    <td>{{$detail->ubicacion}}</td>
                                    <td>{{$detail->encargado}}</td>
                                    <td>{{$detail->region}}</td>
                                    <td> 
                                        @if ($detail->estado === "abierto")
                                            <a href={{ route('detalles.edit', $detail) }} class="btn btn-info">Editar</a> |
                                        @else
                                            <a onclick="return alert('Inventario Cerrado');" class="btn btn-info" disabled>Editar</a> |
                                        @endif                                              
                                        
                                        @if ($detail->estado === "abierto")
                                            <form action="{{ route('detalles.destroy', $detail->id) }}" method="post" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este item?')">Eliminar</button>
                                            </form> |
                                        @else
                                            <a onclick="return alert('Inventario Cerrado');" class="btn btn-danger" disabled>Eliminar</a> |
                                        @endif 
                                        
                                        
                                        @if ($detail->estado === "abierto")
                                            @if ($detail->interes > 0)
                                                <a href={{ route('detalles.depr_m', [$detail->interes,$detail->vida_util,$detail->valor_adquirido,$detail->nombre_activo]) }} class="btn btn-primary">Ver depreciación mensual</a> |
                                            @else
                                                <a onclick="return alert('¡El campo interes es menor o igual a cero!');" class="btn btn-primary" disabled>Ver depreciación mensual</a> |
                                            @endif
                                        @else
                                            <a onclick="return alert('Inventario Cerrado');" class="btn btn-primary" disabled>Ver depreciación mensual</a> |
                                        @endif  

                                        
                                    </td>
                                </tr>
                            @endforeach
                            </body>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/colreorder/1.5.6/css/colReorder.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.5.6/js/dataTables.colReorder.min.js"></script>

    {{-- Botones de impresión --}}
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>

    <script type="text/javascript">
        var table = $('#tabla').DataTable( {
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            ordering: true,
            info: true,
            pagingType: "full_numbers",
            searching: true,
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            dom: 'Blfrtip',
            language: {
                paginate: {
                    first: "Primero",
                    last: "Ultimo",
                    previous: "Anterior",
                    next: "Siguiente",
                },
                info: "Mostrar Entradas de _START_ a _TOTAL_",
                infoEmpty: "Total de Entradas 0",
                infoFiltered: "Filtrado de _MAX_ entradas totales",
                lengthMenu: "Mostrar _MENU_ Entradas",
                search: "Filtrar"
            },
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn btn-default rounded-0',
                    text: '<i class="far fa-file-excel"></i> Exportar a excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23]
                    }
                }
            ],
            columnDefs: [
                { orderable: false, targets: 0 },
                { orderable: false, targets: -1 }
            ],
            ordering: [[ 1, 'asc' ]],
            colReorder: {
                fixedColumnsLeft: 2,
                fixedColumnsRight: 1
            }
        });

        new $.fn.dataTable.FixedColumns( table, {
            leftColumns: 2,
            rightColumns: 1
        } );
    </script>

@endsection

