<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Indicador;
use App\Http\Requests\IndicadorRequest;
use App\Auditoriaevaluaciona;
use Illuminate\Support\Facades\Auth;
use App\Criterioevaluacion;

class IndicadorController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $indicadores = Indicador::all();
        return view('evaluacion_academica.indicadores.list')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('indicadores', $indicadores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $criterio = Criterioevaluacion::all()->pluck('nombre', 'id');
        return view('evaluacion_academica.indicadores.create')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('criterios', $criterio);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IndicadorRequest $request) {
        $i = new Indicador($request->all());
        foreach ($i->attributesToArray() as $key => $value) {
            $i->$key = strtoupper($value);
        }
        $result = $i->save();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE INDICADORES DE EVALUACIÓN. DATOS: ";
            foreach ($i->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El Indicador <strong>" . $i->indicador . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('indicador.index');
        } else {
            flash("El Indicador <strong>" . $i->indicador . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('indicador.index');
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
        $i = Indicador::find($id);
        $criterio = Criterioevaluacion::all()->pluck('nombre', 'id');
        return view('evaluacion_academica.indicadores.edit')
                        ->with('i', $i)
                        ->with('criterios', $criterio)
                        ->with('location', 'menu-evaluacion-auto-hetero');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $l = Indicador::find($id);
        $lo = new Indicador($l->attributesToArray());
        foreach ($l->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $l->$key = strtoupper($request->$key);
            }
        }
        $result = $l->save();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICIÓN DE INDICADOR. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($lo->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($l->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("El Indicador <strong>" . $l->indicador . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('indicador.index');
        } else {
            flash("El Indicador <strong>" . $l->indicador . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('indicador.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $l = Indicador::find($id);
        $result = $l->delete();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE INDICADOR. DATOS ELIMINADOS: ";
            foreach ($l->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El Indicador <strong>" . $l->indicador . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('indicador.index');
        } else {
            flash("El Indicador <strong>" . $l->indicador . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('indicador.index');
        }
    }

}
