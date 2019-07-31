<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\JefedepartamentoRequest;
use App\Jefedepartamento;
use App\Personanatural;
use App\Facultad;
use App\Docenteacademico;
use App\Auditoriaevaluaciona;
use Illuminate\Support\Facades\Auth;

class JefedepartamentoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $jefesdoc = Jefedepartamento::all();
        $jefes = null;
        if ($jefesdoc != null) {
            foreach ($jefesdoc as $i) {
                $o = null;
                $je = Docenteacademico::find($i->docentejefe);
                $o["id"] = $i->id;
                $o["jefe"] = $je->personanatural->primer_nombre . " " . $je->personanatural->segundo_nombre . " " . $je->personanatural->primer_apellido . " " . $je->personanatural->segundo_apellido;
                $o["docente"] = $i->docenteacademico->personanatural->primer_nombre . " " . $i->docenteacademico->personanatural->segundo_nombre . " " . $i->docenteacademico->personanatural->primer_apellido . " " . $i->docenteacademico->personanatural->segundo_apellido;
                $o["fi"] = $i->fechainicio;
                $o["ff"] = $i->fechafin;
                $jefes[] = $o;
            }
        }
        return view('evaluacion_academica.jefe_departamento.list')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('jefes', $jefes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $facultad = Facultad::all()->pluck('nombre', 'id');
        $docentes = Docenteacademico::all();
        $p2 = null;
        if (count($docentes) > 0) {
            foreach ($docentes as $item) {
                $pn = $item->personanatural;
                $p2[$item->pege] = $pn->persona->numero_documento . ": " . $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido . " - DEPARTAMENTO: " . $item->personanatural->departamento->nombre . " - CARGO: " . $item->cargo->nombre;
            }
        }
        return view('evaluacion_academica.jefe_departamento.create')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('docentes', $p2)
                        ->with('facultad', $facultad);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JefedepartamentoRequest $request) {
        $jefe = new Jefedepartamento($request->all());
        foreach ($jefe->attributesToArray() as $key => $value) {
            $jefe->$key = strtoupper($value);
        }
        $existe = Jefedepartamento::where('docenteacademico_pege', $jefe->docenteacademcio_pege)->get();
        if (count($existe) > 0) {
            flash("El Docente <strong>" . $jefe->docenteacademico->personanatural->primer_nombre . " " . $jefe->docenteacademico->personanatural->primer_apellido . "</strong> ya cuenta con jefe.")->warning();
            return redirect()->route('jefedepartamento.create');
        }
        $result = $jefe->save();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE JEFE. DATOS: ";
            foreach ($jefe->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            $j = Docenteacademico::find($jefe->docentejefe);
            flash("El jefe <strong>" . $j->personanatural->primer_nombre . " " . $j->personanatural->primer_apellido . "</strong> fue asignado de forma exitosa!")->success();
            return redirect()->route('jefedepartamento.index');
        } else {
            flash("El jefe <strong>" . $j->personanatural->rimer_nombre . " " . $j->personanatural->primer_apellido . "</strong> no pudo ser asignado. Error: " . $result)->error();
            return redirect()->route('jefedepartamento.index');
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
        $jefe = Jefedepartamento::find($id);
        return view('evaluacion_academica.jefe_departamento.edit')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('jefe', $jefe);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $jefe = Jefedepartamento::find($id);
        $lo = new Jefedepartamento($jefe->attributesToArray());
        foreach ($jefe->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $jefe->$key = strtoupper($request->$key);
            }
        }
        $result = $jefe->save();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICIÓN DE DATOS DE JEFE DE DEPARTAMENTO. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($lo->attributesToArray() as $key => $value) {
                if ($key == 'personanatural_id') {
                    $str2 = $str2 . ", " . $key . ": " . $value . ", personanatural:" . $lo->personanatural->primer_apellido . " " . $lo->personanatural->primer_nombre;
                } else if ($key == 'departamento_id') {
                    $str2 = $str2 . ", " . $key . ": " . $value . ", departamento:" . $lo->departamento->nombre;
                } else {
                    $str2 = $str2 . ", " . $key . ": " . $value;
                }
            }
            foreach ($jefe->attributesToArray() as $key => $value) {
                if ($key == 'personanatural_id') {
                    $str = $str . ", " . $key . ": " . $value . ", personanatural:" . $jefe->personanatural->primer_apellido . " " . $jefe->personanatural->primer_nombre;
                } else if ($key == 'departamento_id') {
                    $str = $str . ", " . $key . ": " . $value . ", programa:" . $jefe->departamento->nombre;
                } else {
                    $str = $str . ", " . $key . ": " . $value;
                }
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("El jefe de departamento <strong>" . $jefe->personanatural->primer_nombre . " " . $jefe->personanatural->primer_apellido . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('jefedepartamento.index');
        } else {
            flash("El jefe de departamento <strong>" . $jefe->personanatural->primer_nombre . " " . $jefe->personanatural->primer_apellido . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('jefedepartamento.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $jefe = Jefedepartamento::find($id);
//        if (count($jefe->materias) > 0) {
//            flash("El Área <strong>" . $jefe->descripcion . "</strong> no pudo ser eliminada porque tiene materias asociadas.")->warning();
//            return redirect()->route('areamateria.index');
//        } else {
        $result = $jefe->delete();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACION DE JEFE. DATOS: ";
            foreach ($jefe->attributesToArray() as $key => $value) {
                    $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
             $j = Docenteacademico::find($jefe->docentejefe);
            flash("El jefe <strong>" . $j->personanatural->primer_nombre . " " . $j->personanatural->primer_apellido . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('jefedepartamento.index');
        } else {
            flash("El jefe <strong>" . $j->personanatural->primer_nombre . " " . $j->personanatural->primer_apellido . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('jefedepartamento.index');
        }
//        }
    }

}
