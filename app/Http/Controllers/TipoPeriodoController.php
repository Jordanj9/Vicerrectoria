<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoPeriodo;
use App\Http\Requests\TipoPeriodoRequest;
use App\Periodoacademico;

class TipoPeriodoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tipos = TipoPeriodo::all();
        return view('academico.recursos_academicos.estructura_curricular.informacion_basica.tipo_periodo.list')
                        ->with('location', 'academico')
                        ->with('tipos', $tipos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('academico.recursos_academicos.estructura_curricular.informacion_basica.tipo_periodo.create')
                        ->with('location', 'academico');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $tipo = new TipoPeriodo($request->all());
        foreach ($tipo->attributesToArray() as $key => $value) {
            $tipo->$key = strtoupper($value);
        }
        $result = $tipo->save();
        if ($result) {
            flash("El tipo de periodo académico <strong>" . $tipo->descripcion . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('tipoperiodo.index');
        } else {
            flash("El tipo de periodo académico <strong>" . $tipo->descripcion . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('tipoperiodo.index');
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
        $tipo = TipoPeriodo::find($id);
        return view('academico.recursos_academicos.estructura_curricular.informacion_basica.tipo_periodo.edit')
                        ->with('location', 'academico')
                        ->with('tipo', $tipo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $tipo = TipoPeriodo::find($id);
        foreach ($tipo->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $tipo->$key = strtoupper($request->$key);
            }
        }
        $result = $tipo->save();
        if ($result) {
            flash("El tipo de periodo académico <strong>" . $tipo->descripcion . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('tipoperiodo.index');
        } else {
            flash("El tipo de periodo académico <strong>" . $tipo->descripcion . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('tipoperiodo.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $tipo = TipoPeriodo::find($id);
        if (count($tipo->programas) > 0) {
            flash("El tipo de periodo académico <strong>" . $tipo->descripcion . "</strong> no pudo ser eliminado porque tiene programas asociadas.")->warning();
            return redirect()->route('tipoperiodo.index');
        } else {
            $result = $tipo->delete();
            if ($result) {
                flash("El tipo de periodo académico <strong>" . $tipo->descripcion . "</strong> fue eliminado de forma exitosa!")->success();
                return redirect()->route('tipoperiodo.index');
            } else {
                flash("El tipo de periodo académico <strong>" . $tipo->descripcion . "</strong> no pudo ser eliminado. Error: " . $result)->error();
                return redirect()->route('tipoperiodo.index');
            }
        }
    }

    /**
     * show all resource from a tipoperiodo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function periodos($id) {
        $tipo = TipoPeriodo::find($id);
        $periodo = $tipo->periodoacademicos;
        $periodos = $periodo->sortByDesc('anio');
        if (count($periodos) > 0) {
            $periodosf = null;
            foreach ($periodos as $value) {
                $obj["id"] = $value->id;
                $obj["value"] = $value->anio . " - " . $value->periodo;
                $periodosf[] = $obj;
            }
            return json_encode($periodosf);
        } else {
            return "null";
        }
    }

}
