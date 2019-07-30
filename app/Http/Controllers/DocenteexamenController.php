<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Docenteexamen;
use App\Personanatural;
use App\Docenteacademico;
use App\Persona;
use App\Auditoriaevaluaciona;
use Illuminate\Support\Facades\Auth;

class DocenteexamenController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $doc = Docenteexamen::all();
        $docentes = null;
        if (count($doc) > 0) {
            foreach ($doc as $d) {
                $o = null;
                $per = Personanatural::find($d->docenteacademico_pege);
                $o['docente'] = $d;
                $o['identificacion'] = $per->persona->tipodoc->abreviatura . " - " . $per->persona->numero_documento;
                $o['nombre'] = $per->primer_nombre . " " . $per->segundo_nombre . " " . $per->primer_apellido . " " . $per->segundo_apellido;
                $docentes[$d->docenteacademico_pege] = $o;
            }
        } else {
            $docentes = $doc;
        }
        return view('evaluacion_academica.docentes.list')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('docentes', $docentes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $docentes = Docenteacademico::all();
        $p2 = null;
        if (count($docentes) > 0) {
            foreach ($docentes as $item) {
                $pn = $item->personanatural;
                $p2[$item->pege] = $pn->persona->numero_documento . ": " . $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido . " - DEPARTAMENTO: " . $item->departamento->nombre;
            }
        }
        return view('evaluacion_academica.docentes.create')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('docentes', $p2);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $doc = new Docenteexamen($request->all());
        foreach ($doc->attributesToArray() as $key => $value) {
            $doc->$key = strtoupper($value);
        }
        $doc->docenteacademico_pege = $request->personanatural_id;
        $existe = Docenteexamen::where('docenteacademico_pege', $request->personanatural_id)->get();
        if (count($existe) > 0) {
            flash("El Docente ya esta resgistrado.")->warning();
            return redirect()->route('docenteexamen.create');
        }
        $result = $doc->save();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE DOCENTE EXAMEN. DATOS: ";
            foreach ($doc->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El docente fue asociado de forma exitosa!")->success();
            return redirect()->route('docenteexamen.index');
        } else {
            flash("El docente no pudo ser asociado. Error: " . $result)->error();
            return redirect()->route('docenteexamen.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $doc = Docenteexamen::find($id);
//        if (count($jefe->materias) > 0) {
//            flash("El Área <strong>" . $jefe->descripcion . "</strong> no pudo ser eliminada porque tiene materias asociadas.")->warning();
//            return redirect()->route('areamateria.index');
//        } else {
        $result = $doc->delete();
        if ($result) {
            $aud = new Auditoriaevaluaciona();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACION DE DOCENTE EVALUACIÓN. DATOS: ";
            foreach ($doc->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("La asociación del docente fue eliminada de forma exitosa!")->success();
            return redirect()->route('docenteexamen.index');
        } else {
            flash("La asociación del docente no pudo ser eliminada. Error: " . $result)->error();
            return redirect()->route('docenteexamen.index');
        }
//        }
    }

    public function getDocentes($identificacion) {
        $p = Persona::where('numero_documento', $identificacion)->get();
        $response = null;
        $response["error"] = "SI";
        $p1 = $p2 = null;
        if (count($p) > 0) {
            foreach ($p as $value) {
                $doc = Docenteacademico::find($value->id);
                if ($doc !== null) {
                    $pn = $doc->personanatural;
                    $o['docacademico_id'] = $doc->pege;
                    $o['id'] = $pn->id;
                    $o["identificacion"] = $identificacion;
                    $o["nombres"] = $pn->primer_nombre . " " . $pn->segundo_nombre;
                    $o["apellidos"] = $pn->primer_apellido . " " . $pn->segundo_apellido;
                    $p1[] = $o;
                    $p2[$pn->id] = $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido . " - FECHA REGISTRO:" . $pn->created_at;
                }
            }
            if (count($p1) > 0) {
                $response["error"] = "NO";
                $response["data1"] = $p1;
                $response["data2"] = $p2;
            } else {
                $response["msg"] = "La persona con Identificación " . $identificacion . " no es un docente academico.";
            }
        } else {
            $response["msg"] = "Ninguna coincidencia encontrada para Identificación: " . $identificacion;
        }
        return json_encode($response);
    }

}
