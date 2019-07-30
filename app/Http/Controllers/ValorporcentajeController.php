<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ValorporcentajeRequest;
use App\Valorporcentaje;
use App\AuditoriaAcademico;
use Illuminate\Support\Facades\Auth;

class ValorporcentajeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $val = Valorporcentaje::all();
        return view('academico.registro_academico.grados.gestionar_porcentajeaprobacion.list')
                        ->with('location', 'academico')
                        ->with('val', $val);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('academico.registro_academico.grados.gestionar_porcentajeaprobacion.create')
                        ->with('location', 'academico');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValorporcentajeRequest $request) {
        $val = new Valorporcentaje($request->all());
        foreach ($val->attributesToArray() as $key => $value) {
            $val->$key = strtoupper($value);
        }
        $result = $val->save();
        if ($result) {
            $aud = new AuditoriaAcademico();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE PORCENTAJE DE APROBACION. DATOS: ";
            foreach ($val->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El Porcentaje de Aprobación <strong>" . $val->valor . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('valorporcentaje.index');
        } else {
            flash("El Porcentaje de Aprobación <strong>" . $val->valor . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('valorporcentaje.index');
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
        $val = Valorporcentaje::find($id);
        return view('academico.registro_academico.grados.gestionar_porcentajeaprobacion.edit')
                        ->with('location', 'academico')
                        ->with('val', $val);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $val = Valorporcentaje::find($id);
        $v = new Valorporcentaje($val->attributesToArray());
        foreach ($val->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $val->$key = strtoupper($request->$key);
            }
        }
        $result = $val->save();
        if ($result) {
            $aud = new AuditoriaAcademico();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICIÓN DE PORCENTAJE DE APROBACION. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($v->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($val->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("El Porcentaje de Aprobación <strong>" . $val->valor . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('valorporcentaje.index');
        } else {
            flash("El Porcentaje de Aprobación <strong>" . $val->valor . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('valorporcentaje.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $val = Valorporcentaje::find($id);
//        if (count($val->localidads) > 0) {
//            flash("El Tipo de espacio fisico <strong>" . $val->descripcion . "</strong> no fue eliminado porque tiene localidades asociadas.")->warning();
//            return redirect()->route('tiposef.index');
//        } else {
        $result = $val->delete();
        if ($result) {
            $aud = new AuditoriaAcademico();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE PORCENTAJE DE APROBACION. DATOS ELIMINADOS: ";
            foreach ($val->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El Porcentaje de Aprobación <strong>" . $val->valor . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('valorporcentaje.index');
        } else {
            flash("El Porcentaje deAprobación <strong>" . $val->valor . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('valorporcentaje.index');
        }
    }

//    }
}
