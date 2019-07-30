<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TipoevaluacionRequest;
use App\Tipoevaluacion;
use App\AuditoriaAcademico;
use Illuminate\Support\Facades\Auth;

class TipoevaluacionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tipos = Tipoevaluacion::all();
        return view('academico.registro_academico.calificaciones.ingreso_especial.tipo_ingreso_especial.list')
                        ->with('location', 'academico')
                        ->with('tipos', $tipos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('academico.registro_academico.calificaciones.ingreso_especial.tipo_ingreso_especial.create')
                        ->with('location', 'academico');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoevaluacionRequest $request) {
        $tipo = new Tipoevaluacion($request->all());
        foreach ($tipo->attributesToArray() as $key => $value) {
            $tipo->$key = strtoupper($value);
        }
        $result = $tipo->save();
        if ($result) {
            $aud = new AuditoriaAcademico();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE TIPO DE INGRESO ESPECIAL. DATOS: ";
            foreach ($tipo->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El Tipo de Ingreso Especial <strong>" . $tipo->descripcion . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('tipoevaluacion.index');
        } else {
            flash("El Tipo de Ingreso Especial <strong>" . $tipo->descripcion . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('tipoevaluacion.index');
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
        $tipo = Tipoevaluacion::find($id);
        return view('academico.registro_academico.calificaciones.ingreso_especial.tipo_ingreso_especial.edit')
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
        $tipo = Tipoevaluacion::find($id);
        $t = new Tipoevaluacion($tipo->attributesToArray());
        foreach ($tipo->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $tipo->$key = strtoupper($request->$key);
            }
        }
        $result = $tipo->save();
        if ($result) {
            $aud = new AuditoriaAcademico();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICIÓN DE TIPO DE INGRESO ESPECIAL. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($t->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($tipo->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("El Tipo de Ingreso Especial <strong>" . $tipo->descripcion . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('tipoevaluacion.index');
        } else {
            flash("El Tipo de Ingreso Especial <strong>" . $tipo->descripcion . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('tipoevaluacion.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $tipo = Tipoevaluacion::find($id);
//        if (count($tipo->localidads) > 0) {
//            flash("El Tipo de espacio fisico <strong>" . $tipo->descripcion . "</strong> no fue eliminado porque tiene localidades asociadas.")->warning();
//            return redirect()->route('tiposef.index');
//        } else {
        $result = $tipo->delete();
        if ($result) {
            $aud = new AuditoriaAcademico();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE TIPO DE INGRESO ESPECIAL. DATOS ELIMINADOS: ";
            foreach ($tipo->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El Tipo de Ingreso Especial <strong>" . $tipo->descripcion . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('tipoevaluacion.index');
        } else {
            flash("El Tipode de Ingreso Especial <strong>" . $tipo->descripcion . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('tipoevaluacion.index');
        }
    }

}
