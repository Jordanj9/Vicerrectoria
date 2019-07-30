<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Persona;
use App\Docenteacademico;
use App\Docenteunidad;
use App\Docentegrupo;
use App\Estudiantepensum;
use App\Periodoacademico;
use App\Matriculaacademica;
use App\Fechaaplicacionevaluacion;
use App\Personanatural;
use App\Materia;
use App\Aplicarevaluacion;
use App\Aplicarevaluaciondetalle;
use App\Autorizarevaluacion;
use App\Evaluacionaah;
use App\Valoracionevalucionacademica;
use App\Pensum;
use App\Jefedepartamento;
use App\Grupo;
use App\Unidad;
use App\Pensummateria;
use App\Programa;
use App\Auditoriaevaluaciona;
use App\Docenteexamen;

class AplicarevaluacionController extends Controller {
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function jefeindex() {
        $u = Auth::user();
        $jefe = false;
        $personas = Persona::where('numero_documento', $u->identificacion)->get();
        if (count($personas) > 0) {
            foreach ($personas as $p) {
                $pns = $p->personanaturals;
                if (count($pns) > 0) {
                    foreach ($pns as $pn) {
                        $jefes = $pn->jefedepartamentos;
                        if (count($jefes) > 0) {
                            $jefe = true;
                        } else {
                            flash("<strong>Usted </strong> no es un encargado de programa válido!")->error();
                            return redirect()->route('admin.evaluacionautohetero');
                        }
                    }
                } else {
                    flash("<strong>Usted </strong> no se encuentra registrada como persona natural!")->warning();
                    return redirect()->route('admin.evaluacionautohetero');
                }
            }
        } else {
            flash("<strong> Usted </strong> no se encuentra registrado(a)!")->warning();
            return redirect()->route('admin.evaluacionautohetero');
        }
        if (!$jefe) {
            flash("<strong>Usted </strong> no es un encargado de programa válido!")->error();
            return redirect()->route('admin.evaluacionautohetero');
        }
        $periodos = Periodoacademico::all();
        $periodosor = $periodos->sortByDesc('anio');
        $periodosf = null;
        foreach ($periodosor as $value) {
            $periodosf[$value->id] = $value->anio . " - " . $value->periodo . " --> " . $value->TipoPeriodo->descripcion;
        }
        return view('evaluacion_academica.aplicar_evaluacion.jefeinicio')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('periodos', $periodosf);
    }

    /*
     * verifica si hay fechas de aplicacion para el periodo seleccionado
     */

    public function jefeconsutarfecha($per, $jefedept) {
        $fecha = Fechaaplicacionevaluacion::where('periodoacademico_id', $per)->first();
        if ($fecha != null) {
            $hoy = date('Y-m-j');
            if (strtotime($hoy) >= strtotime($fecha->fechainicio) && strtotime($hoy) <= strtotime($fecha->fechafin)) {
                $u = Auth::user();
                $personas = Persona::where('numero_documento', $u->identificacion)->get();
                $programas = null;
                if (count($personas) > 0) {
                    foreach ($personas as $p) {
                        $pns = $p->personanaturals;
                        if (count($pns) > 0) {
                            foreach ($pns as $pn) {
                                $jefes = $pn->jefedepartamentos;
                                if (count($jefes) > 0) {
                                    foreach ($jefes as $j) {
                                        $programas[$j->id] = $j->programa->nombre;
                                    }
                                }
                            }
                        }
                    }
                }
                if ($programas != null) {
                    $periodo = Periodoacademico::find($per);
                    return view('evaluacion_academica.aplicar_evaluacion.jefelist')
                                    ->with('location', 'menu-evaluacion-auto-hetero')
                                    ->with('fecha', $fecha)
                                    ->with('periodo', $periodo)
                                    ->with('programas', $programas);
                } else {
                    flash("Usted no tiene programas a cargo!!")->warning();
                    return redirect()->route('aplicacionjefe.inicio');
                }
            } else {
                flash("No hay aplicación de evaluación academica en esta fecha!")->warning();
                return redirect()->route('aplicacionjefe.inicio');
            }
        } else {
            flash("No hay fecha de aplicación de evaluación académica par el período seleccionado!")->warning();
            return redirect()->route('aplicacionjefe.inicio');
        }
    }

    public function getDocentes($pen, $per, $pro, $j) {
        $jefe = Jefedepartamento::find($pen);
        $programa = Programa::find($jefe->programa_id);
        $pensums = $programa->pensums;
        if ($pensums != null) {
            $response = null;
            foreach ($pensums as $r) {
                $penmat = $r->pensummaterias;
                if (count($penmat) > 0) {
                    foreach ($penmat as $p) {
                        $gr = Grupo::where([['periodoacademico_id', $per], ['materia_codigomateria', $p->materia_codigomateria]])->get();
                        if (count($gr) > 0) {
                            foreach ($gr as $g) {
                                $docgr = $g->docentegrupos;
                                if (count($docgr) > 0) {
                                    foreach ($docgr as $doc) {
                                        $docenteunidad = $doc->docenteunidad;
                                        if ($docenteunidad != null) {
                                            $docacademico = $docenteunidad->docenteacademico;
                                            $o = null;
                                            $o['materiac'] = $p->materia_codigomateria;
                                            $o['materian'] = $p->materia->nombre;
                                            $o['docentepege'] = $docacademico->pege;
                                            $pn = Personanatural::find($docacademico->pege);
                                            $o['docente_pn'] = $docacademico->pege;
                                            $o['identificacion'] = $pn->persona->Tipodoc->abreviatura . " " . $pn->persona->numero_documento;
                                            $o['docente'] = $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido;
                                            $response[] = $o;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $rta['totalg'] = count($response);
            $eval = Aplicarevaluacion::where([['programa_id', $programa->id], ['periodoacademico_id', $per], ['jefedepartamento_id', $jefe->id]])->get();
            $rta['totala'] = count($eval);
            $rta['data'] = $response;
            $rta['jefe'] = $jefe->id;
            $rta['programa'] = $programa->id;
            return json_encode($rta);
        } else {
            return "null";
        }
    }

    public function continuar($docpege, $docpn, $mat, $jef, $prog, $per) {
        $tipo = Docenteexamen::where('docenteacademico_pege', $docpege)->first();
        $aut = null;
        if ($tipo != null) {
            if ($tipo->tipo == 'PLANTA') {
                $aut = Autorizarevaluacion::where([['periodoacademico_id', $per], ['rol', 'ENCARGADO PROGRAMA (DOCENTE PLANTA)']])->first();
            } else {
                $aut = Autorizarevaluacion::where([['periodoacademico_id', $per], ['rol', 'ENCARGADO PROGRAMA (DOCENTE CATEDRATICO)']])->first();
            }
        } else {
            flash('No hay formulario de evaluación definido para el período y el encargado de programa indicado')->error();
            return redirect()->route('aplicacionjefe.ir', [$per, $jef]);
        }
        if ($aut == null) {
            flash('No hay formulario de evaluación definido para el período y el encargado de programa indicado')->error();
            return redirect()->route('aplicacionjefe.ir', [$per, $jef]);
        }
        $e = Evaluacionaah::find($aut->evaluacionaah_id);
        $eval = Aplicarevaluacion::where([['docente_pegea', $docpege], ['programa_id', $prog], ['periodoacademico_id', $per], ['evaluacionaah_id', $e->id], ['jefedepartamento_id', $jef]])->first();
        if ($eval == null) {
            $jefe = Jefedepartamento::find($jef);
            $periodo = Periodoacademico::find($per);
            $materia = Materia::find($mat);
            $pn = Personanatural::find($docpn);
            $programa = Programa::find($prog);
            $e->evaluacionindicadors;
            $evals = Valoracionevalucionacademica::all();
            $nombrejefe = $jefe->personanatural->primer_nombre . " " . $jefe->personanatural->segundo_nombre . " " . $jefe->personanatural->primer_apellido . " " . $jefe->personanatural->segundo_apellido;
            $nombredoc = $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido;
            return view('evaluacion_academica.aplicar_evaluacion.jeferealizarexamen')
                            ->with('location', 'menu-evaluacion-auto-hetero')
                            ->with('jefe', $jefe)
                            ->with('periodo', $periodo)
                            ->with('materia', $materia)
                            ->with('programa', $programa)
                            ->with('pn', $pn)
                            ->with('e', $e)
                            ->with('eval', $evals)
                            ->with('nombrejefe', $nombrejefe)
                            ->with('nombredoc', $nombredoc);
        } else {
            flash('Ya realizó la evaluación para el período y el docente indicado')->error();
            return redirect()->route('aplicacionjefe.ir', [$per, $jef]);
        }
    }

    /*
     * guarda la evaluacion de un jefe de departamento
     */

    public function guardarevaluacionjefe(Request $request) {
        $ae = new Aplicarevaluacion($request->all());
        $e = Evaluacionaah::find($request->evaluacionaah_id);
        $indicadores = null;
        foreach ($e->evaluacionindicadors as $i) {
            $ii = new Aplicarevaluaciondetalle();
            $ii->evaluacionindicador_id = $i->id;
            $var = "indicador_" . $i->id;
            $ii->valor = $request->$var;
            $indicadores[] = $ii;
            if ($ii->valor < 0 || $ii->valor > 5) {
                flash('La valoración debe estar entre 0 y 5.')->error();
                return redirect()->route('aplicacionjefe.ir', [$request->periodoacademico_id, $request->jefedepartamento_id]);
            }
        }
        if (count($indicadores) > 0) {
            if ($ae->save()) {
                $aud = new Auditoriaevaluaciona();
                $u = Auth::user();
                $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
                $aud->operacion = "INSERTAR";
                $str = "CREACIÓN DE REALIZACIÓN DE EVALUACIÓN. DATOS: ";
                foreach ($ae->attributesToArray() as $key => $value) {
                    $str = $str . ", " . $key . ": " . $value;
                }
                $aud->detalles = $str;
                $aud->save();
                foreach ($indicadores as $i) {
                    $i->aplicarevaluacion_id = $ae->id;
                    if ($i->save()) {
                        $aud = new Auditoriaevaluaciona();
                        $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
                        $aud->operacion = "INSERTAR";
                        $str = "CREACIÓN DE REALIZACIÓN DE EVALUACIÓN: INSERTAR INDICADOR EVALUADO. DATOS: ";
                        foreach ($i->attributesToArray() as $key => $value) {
                            $str = $str . ", " . $key . ": " . $value;
                        }
                        $aud->detalles = $str;
                        $aud->save();
                    }
                }
                flash('Evaluación registrada con éxito.')->success();
                return redirect()->route('aplicacionjefe.ir', [$request->periodoacademico_id, $request->jefedepartamento_id]);
            } else {
                flash('No se guardó el exámen, debe repetirlo.')->error();
                return redirect()->route('aplicacionjefe.ir', [$request->periodoacademico_id, $request->jefedepartamento_id]);
            }
        } else {
            flash('No respondió correctamente la evaluación, no se guardó.')->error();
            return redirect()->route('aplicacionjefe.ir', [$request->periodoacademico_id, $request->jefedepartamento_id]);
        }
    }

    /*
     * inicio de aplicacion de evaluacion a los estudiantes
     */

    public function estudianteindex() {
        $u = Auth::user();
        $p = Persona::where('numero_documento', $u->identificacion)->get();
        $estudiantes = null;
        $estudiante = $numero = "";
        if (count($p) > 0) {
            foreach ($p as $pe) {
                $numero = $pe->numero_documento;
                $pn = $pe->personanaturals;
                if (count($pn) > 0) {
                    foreach ($pn as $pni) {
                        $estudiante = $pni->primer_nombre . " " . $pni->segundo_nombre . " " . $pni->primer_apellido . " " . $pni->segundo_apellido;
                        $est = $pni->estudiantes;
                        if (count($est) > 0) {
                            foreach ($est as $e) {
                                $epensum = $e->estudiantepensums;
                                if (count($epensum) > 0) {
                                    foreach ($epensum as $ep) {
                                        $ep->situacionestudiante;
                                        $estudiantes[$ep->id] = $ep->programaunidad->programa->nombre . " - " . $ep->pensum->descripcion;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        if ($estudiantes == null) {
            flash('Usted no es un ESTUDIANTE válido. Contacte con el administrador del sistema si usted está seguro de ser un ESTUDIANTE.')->error();
            return redirect()->route('admin.evaluacionautohetero');
        }
        return view('evaluacion_academica.aplicar_evaluacion.estudianteindex')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('programas', $estudiantes)
                        ->with('est', $estudiante)
                        ->with('numero', $numero);
    }

    /*
     * consulta la matricula academica de un estudiante
     */

    public function consultarmatriculaacademica($epid, $per) {
        //consulto fechas
        $fecha = Fechaaplicacionevaluacion::where('periodoacademico_id', $per)->first();
        if ($fecha != null) {
            $hoy = date('Y-m-j');
            if (strtotime($hoy) >= strtotime($fecha->fechainicio) && strtotime($hoy) <= strtotime($fecha->fechafin)) {
                $ep = Estudiantepensum::find($epid);
                $ep->estudiante->personanatural->persona;
                $ep->programaunidad->programa;
                $text = $ep->estudiante->personanatural->primer_nombre . " " . $ep->estudiante->personanatural->segundo_nombre . " " . $ep->estudiante->personanatural->primer_apellido . " " . $ep->estudiante->personanatural->segundo_apellido;
                $mat = Matriculaacademica::where([['periodoacademico_id', $per], ['estudiantepensum_id', $ep->id], ['estado', 'ACTIVA']])->first();
                $creditos = 0;
                $gr = null;
                if ($mat !== null) {
                    if (count($mat->grupomatriculados) > 0) {
                        foreach ($mat->grupomatriculados as $g) {
                            if ($g->estado == '1') {
                                $creditos = $creditos + $g->grupo->materia->ponderacionacademica;
                                $d = $g->grupo->docentegrupos;
                                if (count($d) > 0) {
                                    foreach ($d as $f) {
                                        $o = null;
                                        $o['materiac'] = $g->grupo->materia_codigomateria;
                                        $o['materian'] = $g->grupo->materia->nombre;
                                        $o['docente_pege'] = $f->docenteunidad->docenteacademico_pege;
                                        $pn = Personanatural::find($f->docenteunidad->docenteacademico_pege);
                                        $o['docente_pn'] = $f->docenteunidad->docenteacademico_pege;
                                        $o['docente'] = $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido;
                                        $o['id'] = $pn->persona->numero_documento;
                                        $gr[] = $o;
                                    }
                                }
                            }
                        }
                    }
                }
                $per = Periodoacademico::find($per);
                $totalg = count($gr);
                $eval = Aplicarevaluacion::where([['programa_id', $ep->programaunidad->programa_id], ['periodoacademico_id', $per->id], ['estudiantepensum_id', $ep->id]])->get();
                $totala = count($eval);
                return view('evaluacion_academica.aplicar_evaluacion.estudiantecargaacademica')
                                ->with('location', 'menu-evaluacion-auto-hetero')
                                ->with('ep', $ep)
                                ->with('mat', $mat)
                                ->with('gr', $gr)
                                ->with('text', $text)
                                ->with('totalg', $totalg)
                                ->with('totala', $totala)
                                ->with('creditos', $creditos)
                                ->with('per', $per);
            } else {
                flash('La fecha de hoy está fuera de las fechas indicadas para efectuar la evaluación académica a los DOCENTES.')->error();
                return redirect()->route('aplicacionestudiante.inicio');
            }
        } else {
            flash('No hay fechas para efectuar la evaluación académica a los DOCENTES.')->error();
            return redirect()->route('aplicacionestudiante.inicio');
        }
    }

    /*
     * muestra la vista de la evaluación del estudiante
     */

    public function vistaaplicarestudiante($ep, $per, $pn, $doc, $mat) {
        $ep = Estudiantepensum::find($ep);
        $per = Periodoacademico::find($per);
        $pn = Personanatural::find($pn);
        $mat = Materia::find($mat);
        $aut = Autorizarevaluacion::where([['periodoacademico_id', $per->id], ['rol', 'ESTUDIANTE']])->first();
        if ($aut == null) {
            flash('No hay formulario de evaluación definido para el período y el docente indicado')->error();
            return redirect()->route('aplicacionestudiante.consultarmatriculaacademica', [$ep->id, $per->id]);
        }
        $e = Evaluacionaah::find($aut->evaluacionaah_id);
        $eval = Aplicarevaluacion::where([['materia_codigomateria', $mat->codigomateria], ['docente_pegea', $doc], ['programa_id', $ep->programaunidad->programa_id], ['periodoacademico_id', $per->id], ['evaluacionaah_id', $e->id], ['estudiantepensum_id', $ep->id]])->first();
        if ($eval == null) {
            $e->evaluacionindicadors;
            $evals = Valoracionevalucionacademica::all();
            $text = $ep->estudiante->personanatural->primer_nombre . " " . $ep->estudiante->personanatural->segundo_nombre . " " . $ep->estudiante->personanatural->primer_apellido . " " . $ep->estudiante->personanatural->segundo_apellido;
            return view('evaluacion_academica.aplicar_evaluacion.estudianterealizarexamen')
                            ->with('location', 'menu-evaluacion-auto-hetero')
                            ->with('ep', $ep)
                            ->with('mat', $mat)
                            ->with('pn', $pn)
                            ->with('text', $text)
                            ->with('e', $e)
                            ->with('eval', $evals)
                            ->with('per', $per);
        } else {
            flash('Ya realizó la evaluación para el período y el docente indicado')->error();
            return redirect()->route('aplicacionestudiante.consultarmatriculaacademica', [$ep->id, $per->id]);
        }
    }

    /*
     * guarda la evaluacion de un estudiante
     */

    public function guardarevaluacionestudiante(Request $request) {
        $ae = new Aplicarevaluacion($request->all());
        $e = Evaluacionaah::find($request->evaluacionaah_id);
        $indicadores = null;
        foreach ($e->evaluacionindicadors as $i) {
            $ii = new Aplicarevaluaciondetalle();
            $ii->evaluacionindicador_id = $i->id;
            $var = "indicador_" . $i->id;
            $ii->valor = $request->$var;
            $indicadores[] = $ii;
            if ($ii->valor < 0 || $ii->valor > 5) {
                flash('La valoración debe estar entre 0 y 5.')->error();
                return redirect()->route('aplicacionestudiante.consultarmatriculaacademica', [$request->estudiantepensum_id, $request->periodoacademico_id]);
            }
        }
        if (count($indicadores) > 0) {
            if ($ae->save()) {
                $aud = new Auditoriaevaluaciona();
                $u = Auth::user();
                $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
                $aud->operacion = "INSERTAR";
                $str = "CREACIÓN DE REALIZACIÓN DE EVALUACIÓN. DATOS: ";
                foreach ($ae->attributesToArray() as $key => $value) {
                    $str = $str . ", " . $key . ": " . $value;
                }
                $aud->detalles = $str;
                $aud->save();
                foreach ($indicadores as $i) {
                    $i->aplicarevaluacion_id = $ae->id;
                    if ($i->save()) {
                        $aud = new Auditoriaevaluaciona();
                        $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
                        $aud->operacion = "INSERTAR";
                        $str = "CREACIÓN DE REALIZACIÓN DE EVALUACIÓN: INSERTAR INDICADOR EVALUADO. DATOS: ";
                        foreach ($i->attributesToArray() as $key => $value) {
                            $str = $str . ", " . $key . ": " . $value;
                        }
                        $aud->detalles = $str;
                        $aud->save();
                    }
                }
                flash('Evaluación registrada con éxito.')->success();
                return redirect()->route('aplicacionestudiante.consultarmatriculaacademica', [$request->estudiantepensum_id, $request->periodoacademico_id]);
            } else {
                flash('No se guardó el exámen, debe repetirlo.')->error();
                return redirect()->route('aplicacionestudiante.consultarmatriculaacademica', [$request->estudiantepensum_id, $request->periodoacademico_id]);
            }
        } else {
            flash('No respondió correctamente la evaluación, no se guardó.')->error();
            return redirect()->route('aplicacionestudiante.consultarmatriculaacademica', [$request->estudiantepensum_id, $request->periodoacademico_id]);
        }
    }

    public function docenteindex() {
        $u = Auth::user();
        $persona = Persona::where('numero_documento', $u->identificacion)->get();
        $docente = null;
        if (count($persona) < 0) {
            flash("<strong> Usted </strong> no se encuentra registrado(a)!")->warning();
            return redirect()->route('admin.evaluacionautohetero');
        }
        foreach ($persona as $pe) {
            $d = Docenteacademico::find($pe->id);
            if ($d !== null) {
                $pn = Personanatural::where('persona_id', $d->pege)->first();
                if ($pn !== null) {
                    $docente[$pn->id] = $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido . "  -  DOCENTE DESDE: " . $d->created_at;
                }
            }
        }
        if ($docente == null) {
            flash("<strong>Usted </strong> no es un docente valido!")->error();
            return redirect()->route('admin.evaluacionautohetero');
        }
        $periodos = Periodoacademico::all();
        $periodosor = $periodos->sortByDesc('anio');
        $periodosf = null;
        foreach ($periodosor as $value) {
            $periodosf[$value->id] = $value->anio . " - " . $value->periodo . " --> " . $value->TipoPeriodo->descripcion;
        }
        return view('evaluacion_academica.aplicar_evaluacion.docenteinicio')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('docente', $docente)
                        ->with('periodos', $periodosf);
    }

    /*
     * verifica si hay fechas de aplicacion para el periodo seleccionado
     */

    public function docenteconsutarfecha($per) {
        $fecha = Fechaaplicacionevaluacion::where('periodoacademico_id', $per)->first();
        if ($fecha != null) {
            $hoy = date('Y-m-j');
            if (strtotime($hoy) >= strtotime($fecha->fechainicio) && strtotime($hoy) <= strtotime($fecha->fechafin)) {
                $u = Auth::user();
                $p = null;
                $p = Persona::where('numero_documento', $u->identificacion)->first();
                if ($p != null) {
                    $d = Docenteacademico::find($p->id);
                    if ($d != null) {
                        $tipo = Docenteexamen::where('docenteacademico_pege', $d->pege)->first();
                        $aut = null;
                        if ($tipo != null) {
                            if ($tipo->tipo == 'PLANTA') {
                                $aut = Autorizarevaluacion::where([['periodoacademico_id', $per], ['rol', 'DOCENTE DE PLANTA']])->first();
                            } else {
                                $aut = Autorizarevaluacion::where([['periodoacademico_id', $per], ['rol', 'DOCENTE CATEDRATICO']])->first();
                            }
                        } else {
                            flash('No hay formulario de evaluación definido para el período y el docente indicado')->error();
                            return redirect()->route('admin.evaluacionautohetero');
                        }
                        if ($aut == null) {
                            flash('No hay formulario de evaluación definido para el período y el docente indicado')->error();
                            return redirect()->route('admin.evaluacionautohetero');
                        }
                        $e = Evaluacionaah::find($aut->evaluacionaah_id);
                        $eval = Aplicarevaluacion::where([['docente_pegea', $d->pege], ['docente_pegeq', $d->pege], ['periodoacademico_id', $per], ['evaluacionaah_id', $e->id]])->first();
                        if ($eval == null) {
                            $periodo = Periodoacademico::find($per);
                            $pn = Personanatural::find($d->pege);
                            $e->evaluacionindicadors;
                            $evals = Valoracionevalucionacademica::all();
                            $nombredoc = $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido;
                            return view('evaluacion_academica.aplicar_evaluacion.docenterealizarexamen')
                                            ->with('location', 'menu-evaluacion-auto-hetero')
                                            ->with('docenteacademico', $d)
                                            ->with('periodo', $periodo)
                                            ->with('pn', $pn)
                                            ->with('e', $e)
                                            ->with('eval', $evals)
                                            ->with('nombredoc', $nombredoc);
                        } else {
                            flash('Ya realizó la evaluación para el período y el docente indicado')->error();
                            return redirect()->route('admin.evaluacionautohetero');
                        }
                    } else {
                        flash("El docente no pudo ser establecido.")->warning();
                        return redirect()->route('admin.evaluacionautohetero');
                    }
                } else {
                    flash("La persona no pudo ser establecida!")->warning();
                    return redirect()->route('admin.evaluacionautohetero');
                }
            } else {
                flash("No hay aplicación de evaluación academica en esta fecha!")->warning();
                return redirect()->route('admin.evaluacionautohetero');
            }
        } else {
            flash("No hay fecha de aplicación de evaluccioón academica par el periodo seleccionado!")->warning();
            return redirect()->route('admin.evaluacionautohetero');
        }
    }

    /*
     * guarda la evaluacion de un docente
     */

    public function guardarevaluaciondocente(Request $request) {
        $ae = new Aplicarevaluacion($request->all());
        $e = Evaluacionaah::find($request->evaluacionaah_id);
        $indicadores = null;
        foreach ($e->evaluacionindicadors as $i) {
            $ii = new Aplicarevaluaciondetalle();
            $ii->evaluacionindicador_id = $i->id;
            $var = "indicador_" . $i->id;
            $ii->valor = $request->$var;
            $indicadores[] = $ii;
            if ($ii->valor < 0 || $ii->valor > 5) {
                flash('La valoración debe estar entre 0 y 5.')->error();
                return redirect()->route('aplicaciondocente.inicio');
            }
        }
        if (count($indicadores) > 0) {
            if ($ae->save()) {
                $aud = new Auditoriaevaluaciona();
                $u = Auth::user();
                $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
                $aud->operacion = "INSERTAR";
                $str = "CREACIÓN DE REALIZACIÓN DE EVALUACIÓN. DATOS: ";
                foreach ($ae->attributesToArray() as $key => $value) {
                    $str = $str . ", " . $key . ": " . $value;
                }
                $aud->detalles = $str;
                $aud->save();
                foreach ($indicadores as $i) {
                    $i->aplicarevaluacion_id = $ae->id;
                    if ($i->save()) {
                        $aud = new Auditoriaevaluaciona();
                        $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
                        $aud->operacion = "INSERTAR";
                        $str = "CREACIÓN DE REALIZACIÓN DE EVALUACIÓN: INSERTAR INDICADOR EVALUADO. DATOS: ";
                        foreach ($i->attributesToArray() as $key => $value) {
                            $str = $str . ", " . $key . ": " . $value;
                        }
                        $aud->detalles = $str;
                        $aud->save();
                    }
                }
                flash('Evaluación registrada con éxito.')->success();
                return redirect()->route('aplicaciondocente.inicio');
            } else {
                flash('No se guardó el exámen, debe repetirlo.')->error();
                return redirect()->route('aplicaciondocente.inicio');
            }
        } else {
            flash('No respondió correctamente la evaluación, no se guardó.')->error();
            return redirect()->route('aplicaciondocente.inicio');
        }
    }

}
