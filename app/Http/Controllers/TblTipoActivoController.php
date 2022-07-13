<?php

namespace App\Http\Controllers;

use App\Models\Tbl_tipo_activo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TblTipoActivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_activo=Tbl_tipo_activo::all();
        return view('tipo_activos.index')
            ->with('tipo_activo',$tipo_activo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipo_activos.form');
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
            'descripcion' => 'required|unique:tbl_tipo_activos|max:75'
         ]);

         $tipo_activo = Tbl_tipo_activo::create($request->only('descripcion'));
         Session::flash('mensaje','¡Registro creado con exito!');
         return redirect()->route('tipo_activos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tbl_tipo_activo  $tbl_tipo_activo
     * @return \Illuminate\Http\Response
     */
    public function show(Tbl_tipo_activo $tbl_tipo_activo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tbl_tipo_activo  $tbl_tipo_activo
     * @return \Illuminate\Http\Response
     */
    public function edit(Tbl_tipo_activo $tipo_activo)
    {
        return view('tipo_activos.form',['tipo_activo'=> $tipo_activo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tbl_tipo_activo  $tbl_tipo_activo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|unique:tbl_tipo_activos|max:75'
         ]);
 
        $tipo_activo = Tbl_tipo_activo::find($id);
        $tipo_activo->fill($request->all());
        $tipo_activo->save();

         Session::flash('mensaje','¡Registro editado con exito!');
         return redirect()->route('tipo_activos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tbl_tipo_activo  $tbl_tipo_activo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_activo = Tbl_tipo_activo::find($id);
        $tipo_activo->delete();

        Session::flash('mensaje','¡Registro eliminado con exito!');
        return redirect()->route('tipo_activos.index');
    }
}
