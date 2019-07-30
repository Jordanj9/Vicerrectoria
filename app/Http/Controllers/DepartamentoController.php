<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departamento;
use App\Facultad;

class DepartamentoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $departamentos = Departamento::all();
        return view('academico.recursos_academicos.estructura_curricular.informacion_basica.departamento.list')
                        ->with('location', 'academico')
                        ->with('departamentos', $departamentos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $facultades = Facultad::all()->pluck('nombre', 'id');
        return view('academico.recursos_academicos.estructura_curricular.informacion_basica.departamento.create')
                        ->with('location', 'academico')
                        ->with('facultades', $facultades);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $departamento = new Departamento($request->all());
        foreach ($departamento->attributesToArray() as $key => $value) {
            $departamento->$key = strtoupper($value);
        }
        $result = $departamento->save();
        if ($result) {
            flash("El Departamento <strong>" . $departamento->nombre . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('departamentos.index');
        } else {
            flash("El Departamento <strong>" . $departamento->nombre . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('departamentos.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $departamento = Departamento::find($id);
        $facultades = Facultad::all()->pluck('nombre', 'id');
        return view('academico.recursos_academicos.estructura_curricular.informacion_basica.departamento.edit')
                        ->with('location', 'academico')
                        ->with('facultades', $facultades)
                        ->with('departamento', $departamento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $departamento = Departamento::find($id);
        foreach ($departamento->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $departamento->$key = strtoupper($request->$key);
            }
        }
        $result = $departamento->save();
        if ($result) {
            flash("El Departamento <strong>" . $departamento->nombre . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('departamentos.index');
        } else {
            flash("El Departamento <strong>" . $departamento->nombre . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('departamentos.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $departamento = Departamento::find($id);
        $result = $departamento->delete();
        if ($result) {
            flash("El Departamento <strong>" . $departamento->nombre . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('departamentos.index');
        } else {
            flash("El Departamento <strong>" . $departamento->nombre . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('departamentos.index');
        }
    }

}
