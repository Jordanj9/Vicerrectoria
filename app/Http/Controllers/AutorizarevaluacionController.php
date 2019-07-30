<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autorizarevaluacion;
use App\Periodoacademico;
use App\Evaluacionaah;
use Illuminate\Support\Facades\Auth;
use App\Auditoriaevaluaciona;

class AutorizarevaluacionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $autorizaciones = Autorizarevaluacion::all();
        $autorizaciones->each(function($item) {
            $item->periodoacademico;
            $item->evaluacionaah;
        });
        $evaluaciones = Evaluacionaah::all();
        $p = Periodoacademico::all();
        $periodo = $p->sortByDesc('anio');
        $periodos = null;
        foreach ($periodo as $pa) {
            $periodos[$pa->id] = $pa->anio . " - " . $pa->periodo . " ==> " . $pa->tipoperiodo->descripcion;
        }
        return view('evaluacion_academica.autorizar_evaluacion.list')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('autorizaciones', $autorizaciones)
                        ->with('periodos', $periodos)
                        ->with('evaluaciones', $evaluaciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CriterioevaluacionRequest $request) {
        
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $l = Autorizarevaluacion::find($id);
        $result = $l->delete();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE AUTORIZACIÓN DE EVALUACIÓN. DATOS ELIMINADOS: ";
            foreach ($l->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("La autorización fue eliminada de forma exitosa!")->success();
            return redirect()->route('autorizarevaluacion.index');
        } else {
            flash("La autorización no pudo ser eliminada. Error: " . $result)->error();
            return redirect()->route('autorizarevaluacion.index');
        }
    }

    /*
     * agregar autorizacion
     */

    public function agregar($e, $p, $r) {
        $autorizacion = new Autorizarevaluacion();
        $autorizacion->periodoacademico_id = $p;
        $autorizacion->evaluacionaah_id = $e;
        $autorizacion->rol = $r;
        $result = $autorizacion->save();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE AUTORIZACION DE EVALUACIÓN. DATOS: ";
            foreach ($autorizacion->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("La autorización fue almacenada de forma exitosa!")->success();
            return redirect()->route('autorizarevaluacion.index');
        } else {
            flash("La autorización no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('autorizarevaluacion.index');
        }
    }

}
