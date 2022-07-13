<?php

namespace App\Http\Controllers;

use App\Models\Tbl_laboratorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TblLaboratorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laboratorio=Tbl_laboratorio::all();
        return view('laboratorios.index')
            ->with('laboratorio',$laboratorio);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laboratorios.form');
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
            'nombre_laboratorio' => 'required|unique:tbl_laboratorios|max:75'
        ]);
 
         $laboratorio = Tbl_laboratorio::create($request->only('nombre_laboratorio'));
         Session::flash('mensaje','¡Registro creado con exito!');
         return redirect()->route('laboratorios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tbl_laboratorio  $tbl_laboratorio
     * @return \Illuminate\Http\Response
     */
    public function show(Tbl_laboratorio $tbl_laboratorio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tbl_laboratorio  $tbl_laboratorio
     * @return \Illuminate\Http\Response
     */
    public function edit(Tbl_laboratorio $laboratorio)
    {
        return view('laboratorios.form',['laboratorio'=> $laboratorio]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tbl_laboratorio  $tbl_laboratorio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_laboratorio' => 'required|unique:tbl_laboratorios|max:75'
         ]);
 
        $tbl_laboratorio = Tbl_laboratorio::find($id);
        $tbl_laboratorio->fill($request->all());
        $tbl_laboratorio->save();

         Session::flash('mensaje','¡Registro editado con exito!');
         return redirect()->route('laboratorios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tbl_laboratorio  $tbl_laboratorio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tbl_laboratorio = Tbl_laboratorio::find($id);
        $tbl_laboratorio->delete();

        Session::flash('mensaje','¡Registro eliminado con exito!');
        return redirect()->route('laboratorios.index');
    }
}
