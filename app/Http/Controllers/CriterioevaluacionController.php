<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Criterioevaluacion;
use App\Http\Requests\CriterioevaluacionRequest;
use App\Auditoriaevaluaciona;
use Illuminate\Support\Facades\Auth;

class CriterioevaluacionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $criterio = Criterioevaluacion::all();
        return view('evaluacion_academica.criterios.list')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('criterios', $criterio);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('evaluacion_academica.criterios.create')
                        ->with('location', 'menu-evaluacion-auto-hetero');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CriterioevaluacionRequest $request) {
        $criterio = new Criterioevaluacion($request->all());
        foreach ($criterio->attributesToArray() as $key => $value) {
            $criterio->$key = strtoupper($value);
        }
        $result = $criterio->save();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE CRITERIO DE EVALUACIÓN. DATOS: ";
            foreach ($criterio->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El Criterio <strong>" . $criterio->nombre . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('criterioe.index');
        } else {
            flash("El Criterio <strong>" . $criterio->nombre . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('criterioe.index');
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
        $c = Criterioevaluacion::find($id);
        return view('evaluacion_academica.criterios.edit')
                        ->with('c', $c)
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
        $l = Criterioevaluacion::find($id);
        $lo = new Criterioevaluacion($l->attributesToArray());
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
            $str = "EDICIÓN DE CRITERIO. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($lo->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($l->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("El Criterio <strong>" . $l->nombre . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('criterioe.index');
        } else {
            flash("El Criterio <strong>" . $l->nombre . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('criterioe.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $l = Criterioevaluacion::find($id);
        if (count($l->indicadors) > 0) {
            flash("El criterio <strong>" . $l->nombre . "</strong> no fue eliminado porque tiene indicadores asociados.")->warning();
            return redirect()->route('criterioe.index');
        } else {
            $result = $l->delete();
            if ($result) {
                $aud = new Auditoriaevaluaciona();
                $u = Auth::user();
                $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
                $aud->operacion = "ELIMINAR";
                $str = "ELIMINACIÓN DE CRITERIO. DATOS ELIMINADOS: ";
                foreach ($l->attributesToArray() as $key => $value) {
                    $str = $str . ", " . $key . ": " . $value;
                }
                $aud->detalles = $str;
                $aud->save();
                flash("El Criterio <strong>" . $l->nombre . "</strong> fue eliminado de forma exitosa!")->success();
                return redirect()->route('criterioe.index');
            } else {
                flash("El Criterio <strong>" . $l->nombre . "</strong> no pudo ser eliminado. Error: " . $result)->error();
                return redirect()->route('criterioe.index');
            }
        }
    }

}
