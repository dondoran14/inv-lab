<?php

namespace App\Http\Controllers;

use App\Models\Tbl_inventario_detalle;
use App\Models\Tbl_tipo_activo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TblInventarioDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detalle = Tbl_inventario_detalle::join('tbl_inventario_encabezados','tbl_inventario_detalles.id_inventario','=','tbl_inventario_encabezados.id')
                            ->join('tbl_tipo_activos','tbl_inventario_detalles.tipo_activo','=','tbl_tipo_activos.id')
                            ->join('tbl_laboratorios','tbl_inventario_encabezados.id_laboratorio','=','tbl_laboratorios.id')
                            ->select('tbl_inventario_encabezados.numero_inventario','tbl_inventario_encabezados.gestion','tbl_inventario_encabezados.numero_ficha','tbl_inventario_encabezados.descripcion as comentario','tbl_inventario_encabezados.estado','tbl_inventario_encabezados.created_at','tbl_tipo_activos.descripcion as tipo','tbl_laboratorios.nombre_laboratorio','tbl_inventario_detalles.*')
                            ->get();

        return view('inventarios.detalles.index')
                ->with('detalle', $detalle);
    }

    public function list_inv()
    {
        return view('inventarios.detalles.inventarios');
    }

    public function depr_m($interes,$vida_util,$valor_adquirido,$equipo)
    {
        $intCapital = $valor_adquirido;
        $intInteres = $interes;
        $intPlazo = $vida_util*12;
        $tablaAmortizacion = array();
        // dd($interes,$vida_util,$valor_adquirido);
        // cuota = Capital * interes / ( 1 - ( 1 + interes) ^ -plazo)
        // interesPagar = saldo Capital * interes
        // abono a capital = cuota - interesPagar
        // capitalSaldo =  capital - capital-saldo - abono a capital
        $intInteresNominal = $intInteres / 12 / 100;
        $capitalSaldo = $intCapital;
        $cuotaItem = array();
        $tablaAmortizacion =array();
        $fltCuota = round(($intCapital * $intInteresNominal) / ( 1 - ((1+ $intInteresNominal)**(-1 * $intPlazo))),4);
        for ( $i = 1; $i <= $intPlazo; $i++) {
            // $cuotaItem = array();
            $cuotaItem["periodo"] = $i;
            $cuotaItem["cuota"] = $fltCuota;
            $cuotaItem["interes"] = round($capitalSaldo * $intInteresNominal, 4);
            $cuotaItem["abono"] = $cuotaItem["cuota"] - $cuotaItem["interes"];
            if ($i == $intPlazo){
                $cuotaItem["cuota"] = $capitalSaldo + $cuotaItem["interes"];
                $cuotaItem["abono"] = $capitalSaldo;
                $cuotaItem["saldo"] = 0;
            }else{
                $capitalSaldo -= $cuotaItem["abono"];
                $cuotaItem["saldo"] = $capitalSaldo;
            }

            $tablaAmortizacion[] = $cuotaItem;
        }
        // dd($tablaAmortizacion);
        return view('inventarios.detalles.depr_m',compact('tablaAmortizacion','equipo'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_activo = Tbl_tipo_activo::all()->pluck('descripcion', 'id');
        return view('inventarios.detalles.form', compact('tipo_activo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_activo' => 'required|max:75',
            'interes' => 'required'
        ]);
        
        $detalle= Tbl_inventario_detalle::create($request->all());
        $id=$request['id_inventario'];
        Session::flash('mensaje','¡Registro creado con exito!');
        return redirect()->route('detalles.show', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tbl_inventario_detalle  $tbl_inventario_detalle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo_activo = Tbl_tipo_activo::all()->pluck('descripcion', 'id');
        return view('inventarios.detalles.form', compact('tipo_activo','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tbl_inventario_detalle  $tbl_inventario_detalle
     * @return \Illuminate\Http\Response
     */
    public function edit(Tbl_inventario_detalle $detalle)
    {
        $tipo_activo = Tbl_tipo_activo::all()->pluck('descripcion', 'id');
        return view('inventarios.detalles.form', compact('tipo_activo','detalle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tbl_inventario_detalle  $tbl_inventario_detalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_activo' => 'required|max:75'
        ]);
 
        $detalle = Tbl_inventario_detalle::find($id);
        $detalle->fill($request->all());
        $detalle->save();

        Session::flash('mensaje','¡Registro editado con exito!');
        return redirect()->route('detalles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tbl_inventario_detalle  $tbl_inventario_detalle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detalle = Tbl_inventario_detalle::find($id);
        $detalle->delete();

        Session::flash('mensaje','¡Registro eliminado con exito!');
        return redirect()->route('detalles.index');
    }
}
