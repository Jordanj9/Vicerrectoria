<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EvaluacionacademicoRequest;
use App\Evaluacionacademico;
use App\Sistemaevalucion;
use App\AuditoriaAcademico;
use Illuminate\Support\Facades\Auth;

class EvaluacionacademicoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id) {
        $ea = Evaluacionacademico::where('sistemaevalucion_id', $id)->get();
        $se = Sistemaevalucion::find($id);
        return view('academico.registro_academico.calificaciones.sistema_evaluacion.sistema_evaluacion.liste')
                        ->with('location', 'academico')
                        ->with('ea', $ea)
                        ->with('se', $se);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id) {
        $se = Sistemaevalucion::find($id);
        $ev = Evaluacionacademico::all();
        if (count($ev) > 0) {
            $ev = Evaluacionacademico::where('tipo', "HABILITACION")->get();
            if (count($ev) > 0) {
                $ev = 0;
            } else {
                $ev = 1;
            }
        } else {
            $ev = 0;
        }
        return view('academico.registro_academico.calificaciones.sistema_evaluacion.sistema_evaluacion.creater')
                        ->with('location', 'academico')
                        ->with('se', $se)
                        ->with('ev', $ev);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EvaluacionacademicoRequest $request) {
        $eva = new Evaluacionacademico($request->all());
        foreach ($eva->attributesToArray() as $key => $value) {
            $eva->$key = strtoupper($value);
        }
        if ($eva->tipo === "HABILITACION") {
            $eva->peso = 0;
            $eva->opcional = "1";
            $eva->orden = "0";
        }
        $result = $eva->save();
        if ($result) {
            $aud = new AuditoriaAcademico();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE EVALUACIÓN ACADEMICO. DATOS: ";
            foreach ($eva->attributesToArray() as $key => $value) {
                if ($key == 'sistemaevalucion_id') {
                    $str = $str . ", " . $key . ": " . $value . ", sistemaevalucion:" . $eva->sistemaevalucion->descripcion;
                } else {
                    $str = $str . ", " . $key . ": " . $value;
                }
            }
            $aud->detalles = $str;
            $aud->save();
            flash("La Evaluación <strong>" . $eva->descripcion . "</strong> fue almacenada de forma exitosa!")->success();
            return redirect()->route('evaluacionacademico.listar', $request->sistemaevalucion_id);
        } else {
            flash("La Evaluación <strong>" . $eva->descripcion . "</strong> no pudo ser almacenada. Error: " . $result)->error();
            return redirect()->route('evaluacionacademico.listar', $request->sistemaevalucion_id);
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
        $ev = Evaluacionacademico::find($id);
        $eva = Evaluacionacademico::where('tipo', "HABILITACION")->get();
        if (count($eva) > 0) {
            $eva = 0;
        } else {
            $eva = 1;
        }
        return view('academico.registro_academico.calificaciones.sistema_evaluacion.sistema_evaluacion.edite')
                        ->with('location', 'academico')
                        ->with('ev', $ev)
                        ->with('eva', $eva);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $l = Evaluacionacademico::find($id);
        $lo = new Evaluacionacademico($l->attributesToArray());
        foreach ($l->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $l->$key = strtoupper($request->$key);
            }
        }
        if ($l->tipo === "HABILITACION") {
            $l->peso = 0;
            $l->opcional = "1";
            $l->orden = "0";
        }
        $result = $l->save();
        if ($result) {
            $aud = new AuditoriaAcademico();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICIÓN DE EVALUACION ACADEMICO. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($lo->attributesToArray() as $key => $value) {
                if ($key == 'sistemaevalucion_id') {
                    $str2 = $str2 . ", " . $key . ": " . $value . ", sistemaevalucion:" . $lo->sistemaevalucion->descripcion;
                } else {
                    $str2 = $str2 . ", " . $key . ": " . $value;
                }
            }
            foreach ($l->attributesToArray() as $key => $value) {
                if ($key == 'sistemaevalucion_id') {
                    $str = $str . ", " . $key . ": " . $value . ", sistemaevalucion:" . $l->sistemaevalucion->descripcion;
                } else {
                    $str = $str . ", " . $key . ": " . $value;
                }
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("La Evaluación <strong>" . $l->descripcion . "</strong> fue modificada de forma exitosa!")->success();
            return redirect()->route('evaluacionacademico.listar', $request->sistemaevalucion_id);
        } else {
            flash("La Repuesta <strong>" . $l->descripcion . "</strong> no pudo ser modificada. Error: " . $result)->error();
            return redirect()->route('evaluacionacademico.listar', $request->sistemaevalucion_id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $l = Evaluacionacademico::find($id);
        $result = $l->delete();
        if ($result) {
            $aud = new AuditoriaAcademico();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE EVALUACION ACADEMICO. DATOS ELIMINADOS: ";
            foreach ($l->attributesToArray() as $key => $value) {
                if ($key == 'sistemaevalucion_id') {
                    $str = $str . ", " . $key . ": " . $value . ", sistemaevalucion:" . $l->sistemaevalucion->descripcion;
                } else {
                    $str = $str . ", " . $key . ": " . $value;
                }
            }
            $aud->detalles = $str;
            $aud->save();
            flash("La Evaluación <strong>" . $l->descripcion . "</strong> fue eliminada de forma exitosa!")->success();
            return redirect()->route('evaluacionacademico.listar', $l->sistemaevalucion_id);
        } else {
            flash("La Evaluación <strong>" . $l->contenido . "</strong> no pudo ser eliminada. Error: " . $result)->error();
            return redirect()->route('evaluacionacademico.listar', $l->sistemaevalucion_id);
        }
    }

}
