<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Valoracionevalucionacademica;
use App\Auditoriaevaluaciona;
use App\Http\Requests\ValoracionevaluacionacademicaRrequest;
use Illuminate\Support\Facades\Auth;

class ValoracionevaluacionacademicaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $valoraciones = Valoracionevalucionacademica::all();
        return view('evaluacion_academica.sistema_evaluacion.list')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('valoraciones', $valoraciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('evaluacion_academica.sistema_evaluacion.create')
                        ->with('location', 'menu-evaluacion-auto-hetero');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValoracionevaluacionacademicaRrequest $request) {
        $valoracion = new Valoracionevalucionacademica($request->all());
        foreach ($valoracion->attributesToArray() as $key => $value) {
            $valoracion->$key = strtoupper($value);
        }
        $notai =  $request->valor_cuat1;
        $notaf =  $request->valor_cuat2;
        if($notai > $notaf || $notaf > 100){
            flash("La Valoración <strong>" . $valoracion->valor_cualitativo . "</strong> no pudo ser almacenada ingrese una calificación correcta.")->warning();
            return redirect()->route('valoracion.create');
        }
        $result = $valoracion->save();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE VALORACIÓN. DATOS: ";
            foreach ($valoracion->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("La Valoración <strong>" . $valoracion->valor_cualitativo . "</strong> almacenada de forma exitosa!")->success();
            return redirect()->route('valoracion.index');
        } else {
            flash("La Valoración <strong>" . $valoracion->valor_cualitativo . "</strong> no pudo ser almacenada. Error: " . $result)->error();
            return redirect()->route('valoracion.index');
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
        $valoracion = Valoracionevalucionacademica::find($id);
        return view('evaluacion_academica.sistema_evaluacion.edit')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('valoracion', $valoracion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $valoracion = Valoracionevalucionacademica::find($id);
        $lo = new Valoracionevalucionacademica($valoracion->attributesToArray());
        foreach ($valoracion->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $valoracion->$key = strtoupper($request->$key);
            }
        }
        $notai = (double) $request->valor_cuat1;
        $notaf = (double) $request->valor_cuat2;
        if($notai > $notaf || $notaf > 5){
            flash("La Valoración <strong>" . $valoracion->valor_cualitativo . "</strong> no pudo ser almacenada ingrese una calificación correcta.")->warning();
            return redirect()->route('valoracion.edit',$id);
        }
        $result = $valoracion->save();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICIÓN DE DATOS DE VALORACIÓN. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($lo->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($valoracion->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("La Valoración <strong>" . $valoracion->valor_cualitativo . "</strong> modificada de forma exitosa!")->success();
            return redirect()->route('valoracion.index');
        } else {
            flash("La Valoración <strong>" . $valoracion->valor_cualitativo . "</strong> no pudo ser modificada. Error: " . $result)->error();
            return redirect()->route('valoracion.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $valoracion = Valoracionevalucionacademica::find($id);
//        if (count($valoracion->materias) > 0) {
//            flash("El Área <strong>" . $valoracion->descripcion . "</strong> no pudo ser eliminada porque tiene materias asociadas.")->warning();
//            return redirect()->route('areamateria.index');
//        } else {
        $result = $valoracion->delete();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACION DE VALORACIÓN. DATOS: ";
            foreach ($valoracion->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("La Valoración <strong>" . $valoracion->valor_cualitativo . "</strong> eliminada de forma exitosa!")->success();
            return redirect()->route('valoracion.index');
        } else {
            flash("La Valoración<strong>" . $valoracion->valor_cualitativo . "</strong> no pudo ser eliminada. Error: " . $result)->error();
            return redirect()->route('valoracion.index');
        }
//        }
    }

}
