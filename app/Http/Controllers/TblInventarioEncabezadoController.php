<?php

namespace App\Http\Controllers;

use App\Models\Tbl_inventario_encabezado;
use App\Models\Tbl_laboratorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TblInventarioEncabezadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $encabezado = Tbl_inventario_encabezado::join('tbl_laboratorios','tbl_inventario_encabezados.id_laboratorio','=','tbl_laboratorios.id')
                ->select('tbl_inventario_encabezados.*','tbl_laboratorios.nombre_laboratorio')
                ->get();
                
        return view('inventarios.encabezados.index')
            ->with('encabezado',$encabezado);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $laboratorio = Tbl_laboratorio::all()->pluck('nombre_laboratorio', 'id');
        return view('inventarios.encabezados.form', compact('laboratorio'));
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
            'numero_inventario' => 'required|unique:tbl_inventario_encabezados|max:75'
         ]);

         $encabezado= Tbl_inventario_encabezado::create($request->all());
         Session::flash('mensaje','¡Registro creado con exito!');
         return redirect()->route('encabezados.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tbl_inventario_encabezado  $tbl_inventario_encabezado
     * @return \Illuminate\Http\Response
     */
    public function show(Tbl_inventario_encabezado $tbl_inventario_encabezado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tbl_inventario_encabezado  $tbl_inventario_encabezado
     * @return \Illuminate\Http\Response
     */
    public function edit(Tbl_inventario_encabezado $encabezado)
    {
        $laboratorio = Tbl_laboratorio::all()->pluck('nombre_laboratorio', 'id');
        return view('inventarios.encabezados.form', compact('laboratorio','encabezado'));
        // return view('inventarios.encabezados.form',['encabezado'=> $encabezado]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tbl_inventario_encabezado  $tbl_inventario_encabezado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'numero_inventario' => 'required|max:75'
        ]);
 
        $encabezado = Tbl_inventario_encabezado::find($id);
        $encabezado->fill($request->all());
        $encabezado->save();

         Session::flash('mensaje','¡Registro editado con exito!');
         return redirect()->route('encabezados.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tbl_inventario_encabezado  $tbl_inventario_encabezado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $encabezado = Tbl_inventario_encabezado::find($id);
        $encabezado->delete();

        Session::flash('mensaje','¡Registro eliminado con exito!');
        return redirect()->route('encabezados.index');
    }
}
