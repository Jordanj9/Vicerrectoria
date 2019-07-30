<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Indicador;
use App\Evaluacionaah;
use App\Evaluacionindicador;
use App\Auditoriaevaluaciona;
use Illuminate\Support\Facades\Auth;

class EvaluacionaahController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $evaluaciones = Evaluacionaah::all();
        return view('evaluacion_academica.evaluacionaah.list')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('evaluaciones', $evaluaciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('evaluacion_academica.evaluacionaah.create')
                        ->with('location', 'menu-evaluacion-auto-hetero');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $i = new Evaluacionaah($request->all());
        foreach ($i->attributesToArray() as $key => $value) {
            $i->$key = strtoupper($value);
        }
        $result = $i->save();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE FORMULARIO DE EVALUACIÓN. DATOS: ";
            foreach ($i->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El Formulario <strong>" . $i->nombre . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('evaluacionaah.index');
        } else {
            flash("El Formulario <strong>" . $i->nombre . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('evaluacionaah.index');
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
        $l = Evaluacionaah::find($id);
        return view('evaluacion_academica.evaluacionaah.edit')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('e', $l);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $l = Evaluacionaah::find($id);
        $lo = new Evaluacionaah($l->attributesToArray());
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
            $str = "EDICIÓN DE FORMULARIO DE EVALUACIÓN. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($lo->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($l->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("El Formulario <strong>" . $l->nombre . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('evaluacionaah.index');
        } else {
            flash("El Formulario <strong>" . $l->nombre . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('evaluacionaah.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $l = Evaluacionaah::find($id);
        if (count($l->evaluacionindicadors) > 0) {
            flash("El Formulario <strong>" . $i->nombre . "</strong> no pudo ser eliminado porque tiene indicadores asociados.")->warning();
            return redirect()->route('evaluacionaah.index');
        }
        $result = $l->delete();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE FORMULARIO DE EVALUACIÓN. DATOS ELIMINADOS: ";
            foreach ($l->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El Formulario <strong>" . $l->nombre . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('evaluacionaah.index');
        } else {
            flash("El Formulario <strong>" . $l->nombre . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('evaluacionaah.index');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indicadores($id) {
        $evaluacion = Evaluacionaah::find($id);
        $evaluacion->evaluacionindicadors;
        $i = Indicador::all()->sortByDesc('criterioevaluacion_id');
        return view('evaluacion_academica.evaluacionaah.listindicadores')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('i', $i)
                        ->with('e', $evaluacion);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indicadoragregar($id, $idi) {
        $m = Evaluacionindicador::where([['indicador_id', $idi], ['evaluacionaah_id', $id]])->first();
        if ($m !== null) {
            flash("El Indicador ya existe en el formulario, agregue otro diferente.")->warning();
            return redirect()->route('evaluacionaah.indicadores', $id);
        }
        $i = new Evaluacionindicador();
        $i->evaluacionaah_id = $id;
        $i->indicador_id = $idi;
        $result = $i->save();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE INDICADOR DE FORMULARIO DE EVALUACIÓN. DATOS: ";
            foreach ($i->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El Indicador fue almacenado de forma exitosa!")->success();
            return redirect()->route('evaluacionaah.indicadores', $id);
        } else {
            flash("El Indicador no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('evaluacionaah.indicadores', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function indicadordelete($id, $idi) {
        $l = Evaluacionindicador::find($idi);
        $result = $l->delete();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE INDICADORES DE FORMULARIO DE EVALUACIÓN. DATOS ELIMINADOS: ";
            foreach ($l->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El Indicador fue eliminado de forma exitosa!")->success();
            return redirect()->route('evaluacionaah.indicadores', $id);
        } else {
            flash("El Indicador no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('evaluacionaah.indicadores', $id);
        }
    }

}
