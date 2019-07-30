<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FechaaplicacionevaluacionRequest;
use App\Fechaaplicacionevaluacion;
use App\Auditoriaevaluaciona;
use App\Periodoacademico;
use Illuminate\Support\Facades\Auth;

class FechaaplicacionevaluacionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $fechas = Fechaaplicacionevaluacion::all();
        return view('evaluacion_academica.fecha_aplicacion.list')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('fechas', $fechas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $periodos = Periodoacademico::all();
        $periodosor = $periodos->sortByDesc('anio');
        $periodosf = null;
        foreach ($periodosor as $value) {
            $periodosf[$value->id] = $value->anio . " - " . $value->periodo . " --> " . $value->TipoPeriodo->descripcion;
        }
        return view('evaluacion_academica.fecha_aplicacion.create')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('periodos', $periodosf);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FechaaplicacionevaluacionRequest $request) {
        $fecha = new Fechaaplicacionevaluacion($request->all());
        foreach ($fecha->attributesToArray() as $key => $value) {
            $fecha->$key = strtoupper($value);
        }
        $existe = Fechaaplicacionevaluacion::where('periodoacademico_id', $fecha->periodoacademico_id)->get();
        if (count($existe) > 0) {
            flash("El Periodo <strong>" . $fecha->periodoacademico->anio . " - " . $fecha->periodoacademico->periodo . " --> " . $fecha->periodoacademico->TipoPeriodo->descripcion . "</strong> ya cuenta con fecha de aplicación.")->warning();
            return redirect()->route('fechaaplicacion.create');
        }
        $result = $fecha->save();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE FECHA DE APLIACION DE EVALUACION ACADEMICA. DATOS: ";
            foreach ($fecha->attributesToArray() as $key => $value) {
                if ($key == 'periodoacademico_id') {
                    $str = $str . ", " . $key . ": " . $value . ", periodo:" . $fecha->periodoacademico->anio . " - " . $fecha->periodoacademico->periodo . " --> " . $fecha->periodoacademico->TipoPeriodo->descripcion;
                } else {
                    $str = $str . ", " . $key . ": " . $value;
                }
            }
            $aud->detalles = $str;
            $aud->save();
            flash("La fecha de aplicación del periodo <strong>" . $fecha->periodoacademico->anio . " - " . $fecha->periodoacademico->periodo . " --> " . $fecha->periodoacademico->TipoPeriodo->descripcion . "</strong> fue almacenada de forma exitosa!")->success();
            return redirect()->route('fechaaplicacion.index');
        } else {
            flash("El jefe de departamento <strong>" . $fecha->periodoacademico->anio . " - " . $fecha->periodoacademico->periodo . " --> " . $fecha->periodoacademico->TipoPeriodo->descripcion . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('fechaaplicacion.index');
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
        $fecha = Fechaaplicacionevaluacion::find($id);
        $periodos = Periodoacademico::all();
        $periodosor = $periodos->sortByDesc('anio');
        $periodosf = null;
        foreach ($periodosor as $value) {
            $periodosf[$value->id] = $value->anio . " - " . $value->periodo . " --> " . $value->TipoPeriodo->descripcion;
        }
        return view('evaluacion_academica.fecha_aplicacion.edit')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('fecha', $fecha)
                        ->with('periodos', $periodosf);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $fecha = Fechaaplicacionevaluacion::find($id);
        $lo = new Fechaaplicacionevaluacion($fecha->attributesToArray());
        foreach ($fecha->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $fecha->$key = strtoupper($request->$key);
            }
        }
        $result = $fecha->save();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICIÓN DE DATOS DE FECHA DE APLICACION DE EVALUACIÓN ACADEMICA. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($lo->attributesToArray() as $key => $value) {
                if ($key == 'periodoacademico_id') {
                    $str2 = $str2 . ", " . $key . ": " . $value . ", periodoacademico:" . $lo->periodoacademico->anio . " - " . $lo->periodoacademico->periodo . " --> " . $lo->periodoacademico->TipoPeriodo->descripcion;
                } else {
                    $str2 = $str2 . ", " . $key . ": " . $value;
                }
            }
            foreach ($fecha->attributesToArray() as $key => $value) {
                if ($key == 'periodoacademico_id') {
                    $str = $str . ", " . $key . ": " . $value . ", periodoacademico:" . $fecha->periodoacademico->anio . " - " . $fecha->periodoacademico->periodo . " --> " . $fecha->periodoacademico->TipoPeriodo->descripcion;
                } else {
                    $str = $str . ", " . $key . ": " . $value;
                }
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("La fecha de aplicación del periodo <strong>" . $fecha->periodoacademico->anio . " - " . $fecha->periodoacademico->periodo . " --> " . $fecha->periodoacademico->TipoPeriodo->descripcion . "</strong> fue modificada de forma exitosa!")->success();
            return redirect()->route('fechaaplicacion.index');
        } else {
            flash("La fecha de aplicación del periodo <strong>" . $fecha->periodoacademico->anio . " - " . $fecha->periodoacademico->periodo . " --> " . $fecha->periodoacademico->TipoPeriodo->descripcion . "</strong> no pudo ser modificada. Error: " . $result)->error();
            return redirect()->route('fechaaplicacion.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $fecha = Fechaaplicacionevaluacion::find($id);
//        if (count($jefe->materias) > 0) {
//            flash("El Área <strong>" . $jefe->descripcion . "</strong> no pudo ser eliminada porque tiene materias asociadas.")->warning();
//            return redirect()->route('areamateria.index');
//        } else {
        $result = $fecha->delete();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACION DE FECHA DE APLICACION DE EVALUACION ACADEMICA. DATOS: ";
            foreach ($fecha->attributesToArray() as $key => $value) {
                if ($key == 'periodoacademico_id') {
                    $str = $str . ", " . $key . ": " . $value . ", periodo:" . $fecha->periodoacademico->anio . " - " . $fecha->periodoacademico->periodo . " --> " . $fecha->periodoacademico->TipoPeriodo->descripcion;
                } else {
                    $str = $str . ", " . $key . ": " . $value;
                }
            }
            $aud->detalles = $str;
            $aud->save();
            flash("La fecha de aplicación del periodo <strong>" . $fecha->periodoacademico->anio . " - " . $fecha->periodoacademico->periodo . " --> " . $fecha->periodoacademico->TipoPeriodo->descripcion . "</strong> fue eliminada de forma exitosa!")->success();
            return redirect()->route('fechaaplicacion.index');
        } else {
            flash("La fecha de aplicación del periodo <strong>" . $fecha->periodoacademico->anio . " - " . $fecha->periodoacademico->periodo . " --> " . $fecha->periodoacademico->TipoPeriodo->descripcion . "</strong> no pudo ser eliminada. Error: " . $result)->error();
            return redirect()->route('fechaaplicacion.index');
        }
//        }
    }

}
