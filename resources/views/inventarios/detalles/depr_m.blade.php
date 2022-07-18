@extends('theme.base')

@section('content')

<div class="container-fluid py-5 float-none">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Depreciación Mensual <?php echo $equipo ?></h1>
                </div>
                <div class="card-body">
                    <input type="hidden" id="importe" name="importe" />
                    <input type="hidden" id="tasa_interes" name="tasa_interes" />
                    <input type="hidden" id="tasa_efectiva" name="tasa_efectiva" />
                    <input type="hidden" id="amortizacion" name="amortizacion" />
                    <input type="hidden" id="cuota" name="cuota" />

                    <table class="table table-responsive" id="tabla">
                        <thead>
                            <tr>
                                <th>Mes</th>
                                <th>Tasa de Interes</th>
                                <th>Pago</th>
                                <th>Amortización</th>
                                <th>Cuota pendiente</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($tablaAmortizacion as $cuota)
                            {?>
                                <tr>
                                    <td><?php echo $cuota["periodo"];?></td>
                                    <td><?php echo number_format($cuota["interes"],2,'.','');?></td>
                                    <td><?php echo number_format($cuota["cuota"],2,'.','')?></td>
                                    <td><?php echo number_format($cuota["abono"],2,'.','')?></td>
                                    <td><?php echo number_format($cuota["saldo"],2,'.','')?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


    <script src="{{asset('js/jquery.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
    <script src="{{asset('js/datatables.min.js')}}"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>

    <script type="text/javascript">
        $("#tabla").DataTable({
            paging: true,
            ordering: true,
            info: true,
            pagingType: "full_numbers",
            searching: true,
            pageLength: 25,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            dom: 'Blfrtip',
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
            },
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn btn-default rounded-0',
                    text: '<i class="far fa-file-excel"></i> Exportar a excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }
            ],
        });
    </script>
@endsection