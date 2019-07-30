<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargo;
use App\Http\Requests\CargoRequest;
use App\Norma;
use App\Niveljerarquico;
use App\Escalasalario;
use Illuminate\Support\Collection;

class CargoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $cargos = Cargo::where('tipo', 'C')->get();
        return view('academico.recursos_academicos.carga_administrativa.cargos.list')
                        ->with('location', 'academico')
                        ->with('cargos', $cargos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('academico.recursos_academicos.carga_administrativa.cargos.create')
                        ->with('location', 'academico');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CargoRequest $request) {
        $cargo = new Cargo($request->all());
        foreach ($cargo->attributesToArray() as $key => $value) {
            if ($key === 'tiene_funcion') {
                if ($value === 'on') {
                    $cargo->$key = 1;
                } else {
                    $cargo->$key = 0;
                }
            } else {
                $cargo->$key = strtoupper($value);
            }
        }
        if (!isset($cargo->tiene_funcion)) {
            $cargo->tiene_funcion = 0;
        }
        $cargo->tipo = "C";
        $result = $cargo->save();
        if ($result) {
            flash("El cargo <strong>" . $cargo->nombre . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('cargo.index');
        } else {
            flash("El cargo <strong>" . $cargo->nombre . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('cargo.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $cargo = Cargo::find($id);
        return view('academico.recursos_academicos.carga_administrativa.cargos.show')
                        ->with('location', 'academico')
                        ->with('cargo', $cargo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $cargo = Cargo::find($id);
        return view('academico.recursos_academicos.carga_administrativa.cargos.edit')
                        ->with('location', 'academico')
                        ->with('cargo', $cargo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $cargo = Cargo::find($id);
        foreach ($cargo->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                if ($key === 'tiene_funcion') {
                    if ($request->$key === 'on') {
                        $cargo->$key = 1;
                    } else {
                        $cargo->$key = 0;
                    }
                } else {
                    $cargo->$key = strtoupper($request->$key);
                }
            } else {
                if ($key === 'tiene_funcion') {
                    $cargo->$key = 0;
                }
            }
        }
        $result = $cargo->save();
        if ($result) {
            flash("El cargo <strong>" . $cargo->nombre . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('cargo.index');
        } else {
            flash("El cargo <strong>" . $cargo->nombre . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('cargo.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $cargo = Cargo::find($id);
        $result = $cargo->delete();
        if ($result) {
            flash("El cargo <strong>" . $cargo->nombre . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('cargo.index');
        } else {
            flash("El cargo <strong>" . $cargo->nombre . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('cargo.index');
        }
    }

}
