<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Persona;
use App\Estudiantepensum;
use App\Periodoacademico;
use App\Matriculaacademica;
use App\Hismatriculaacademica;
use PDF;
use App\Grupomatriculado;
use App\Calificacion;
use App\Fechaaplicacionevaluacion;
use App\Autorizarevaluacion;
use App\Evaluacionaah;
use App\Aplicarevaluacion;

class AcademicostudianteController extends Controller {
    /*
     * muestra el menu de la opcion calificaciones
     */

    public function menu() {
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
                                        $o = null;
                                        $o['ep'] = $ep;
                                        $o['periodos'] = $this->periodosestudiante($ep->id);
                                        $estudiantes[] = $o;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return view('estudiante.academico.calificaciones.index')
                        ->with('location', 'academico-estudiante')
                        ->with('programas', $estudiantes)
                        ->with('est', $estudiante)
                        ->with('numero', $numero);
    }

    /*
     * consulta las notas actuales o registro extendido
     */

    public function consultarnotas($id, $tipo, $per) {
        $ep = Estudiantepensum::find($id);
        $numero = $ep->estudiante->personanatural->persona->numero_documento;
        $pn = $ep->estudiante->personanatural;
        $estudiante = $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido;
        if ($tipo == "NA") {
            //NOTAS ACTUALES
            $mat = Matriculaacademica::where([['periodoacademico_id', $per], ['estudiantepensum_id', $id], ['estado', 'ACTIVA']])->first();
            if ($mat !== null) {
                $gm = $mat->grupomatriculados;
                $materias = null;
                if (count($gm) > 0) {
                    foreach ($gm as $g) {
                        if ($g->estado == '1') {
                            $a = null;
                            $a['codigo'] = $g->grupo->materia_codigomateria;
                            $a['materia'] = $g->grupo->materia->nombre;
                            $a['pond'] = $g->grupo->materia->ponderacionacademica;
                            $a['final'] = "--";
                            if ($g->final != null) {
                                $a['final'] = $g->final;
                            }
                            $a['hab'] = "--";
                            if ($g->habilitacion != null) {
                                $a['hab'] = $g->habilitacion;
                            }
                            $a['def'] = "--";
                            if ($g->definitiva != null) {
                                $a['def'] = $g->definitiva;
                            }
                            $a['fallas'] = $g->numerofallas;
                            $a['gmid'] = $g->id;
                            $materias[] = $a;
                        }
                    }
                    return view('estudiante.academico.calificaciones.actuales')
                                    ->with('location', 'academico-estudiante')
                                    ->with('ep', $ep)
                                    ->with('materias', $materias)
                                    ->with('est', $estudiante)
                                    ->with('numero', $numero)
                                    ->with('per', $per);
                } else {
                    flash('El estudiante no tiene materias matriculadas.')->error();
                    return redirect()->route('academicoest.menu');
                }
            } else {
                flash('No hay matrícula académica ACTIVA en el período indicado')->error();
                return redirect()->route('academicoest.menu');
            }
        } else {
            //REGISTRO EXTENDIDO
            $his = $ep->hismatriculaacademicas;
            $record = null;
            if (count($his) > 0) {
                foreach ($his as $h) {
                    $grupos = $lista = null;
                    $creditos = $creditosaprobados = 0;
                    $grupos = $h->registroacademicos;
                    if (count($grupos) > 0) {
                        foreach ($grupos as $g) {
                            $a = null;
                            $a['codigo'] = $g->materia_codigomateria;
                            $a['materia'] = $g->materia->nombre;
                            $a['pond'] = $g->materia->ponderacionacademica;
                            $a['grupo'] = "---";
                            if ($g->grupo_id !== null) {
                                $a['grupo'] = "GRUPO " . $g->grupo->nombre;
                            }
                            $a['final'] = $a['hab'] = $a['def'] = 0;
                            if ($g->habilitacion !== null) {
                                $a['final'] = number_format($g->notaanteshab, 1);
                                $a['hab'] = number_format($g->habilitacion, 1);
                                $a['def'] = number_format($g->notafinal, 1);
                            } else {
                                $a['final'] = number_format($g->notafinal, 1);
                                $a['hab'] = number_format($g->habilitacion, 1);
                                $a['def'] = number_format($g->notafinal, 1);
                            }
                            $a['aprobado'] = $g->aprobado;
                            $creditos = $creditos + $g->materia->ponderacionacademica;
                            if ($g->aprobado == "1") {
                                $creditosaprobados = $creditosaprobados + $g->materia->ponderacionacademica;
                            }
                            $lista[] = $a;
                        }
                    }
                    $o = null;
                    $o['mat'] = $h;
                    $o['crd'] = $creditos;
                    $o['crdap'] = $creditosaprobados;
                    $o['grupos'] = $lista;
                    $record[$h->periodoacademico->anio . " - " . $h->periodoacademico->periodo] = $o;
                }
                if ($record !== null) {
                    return view('estudiante.academico.calificaciones.registroextendido')
                                    ->with('location', 'academico-estudiante')
                                    ->with('ep', $ep)
                                    ->with('record', $record)
                                    ->with('est', $estudiante)
                                    ->with('numero', $numero);
                } else {
                    flash('El estudiante no tiene registro extendido de notas')->error();
                    return redirect()->route('academicoest.menu');
                }
            } else {
                flash('El estudiante no tiene registro extendido de notas')->error();
                return redirect()->route('academicoest.menu');
            }
        }
    }

    /*
     * imprime el recor academico
     */

    public function extendidoimprimir($id) {
        $ep = Estudiantepensum::find($id);
        $his = $ep->hismatriculaacademicas;
        $record = null;
        if (count($his) > 0) {
            foreach ($his as $h) {
                $grupos = $lista = null;
                $creditos = $creditosaprobados = 0;
                $grupos = $h->registroacademicos;
                if (count($grupos) > 0) {
                    foreach ($grupos as $g) {
                        $a = null;
                        $a['codigo'] = $g->materia_codigomateria;
                        $a['materia'] = $g->materia->nombre;
                        $a['pond'] = $g->materia->ponderacionacademica;
                        $a['grupo'] = "---";
                        if ($g->grupo_id !== null) {
                            $a['grupo'] = "GRUPO " . $g->grupo->nombre;
                        }
                        $a['final'] = $a['hab'] = $a['def'] = 0;
                        if ($g->habilitacion !== null) {
                            $a['final'] = number_format($g->notaanteshab, 1);
                            $a['hab'] = number_format($g->habilitacion, 1);
                            $a['def'] = number_format($g->notafinal, 1);
                        } else {
                            $a['final'] = number_format($g->notafinal, 1);
                            $a['hab'] = number_format($g->habilitacion, 1);
                            $a['def'] = number_format($g->notafinal, 1);
                        }
                        $a['aprobado'] = $g->aprobado;
                        $creditos = $creditos + $g->materia->ponderacionacademica;
                        if ($g->aprobado == "1") {
                            $creditosaprobados = $creditosaprobados + $g->materia->ponderacionacademica;
                        }
                        $lista[] = $a;
                    }
                }
                $o = null;
                $o['mat'] = $h;
                $o['crd'] = $creditos;
                $o['crdap'] = $creditosaprobados;
                $o['grupos'] = $lista;
                $record[$h->periodoacademico->anio . " - " . $h->periodoacademico->periodo] = $o;
            }
            if ($record !== null) {
                $numero = $ep->estudiante->personanatural->persona->numero_documento;
                $pn = $ep->estudiante->personanatural;
                $estudiante = $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido;
                $hoy = getdate();
                $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                $date['fecha'] = $fecha;
                $date['ep'] = $ep;
                $date['record'] = $record;
                $date['est'] = $estudiante;
                $date['numero'] = $numero;
                $date['titulo'] = "REGISTRO EXTENDIDO DE CALIFICACIONES";
                $pdf = PDF::loadView('estudiante.academico.calificaciones.print', $date);
                return $pdf->stream('registroextendido.pdf');
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>El estudiante no tiene registro extendido de notas<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>El estudiante no tiene registro extendido de notas<br/><br/></p>";
        }
    }

    /*
     * obtiene los periodos acadmeicos de un estudiante
     */

    public function periodosestudiante($id) {
        $ep = Estudiantepensum::find($id);
        $periodos = null;
        if ($ep !== null) {
            $p = Periodoacademico::find($ep->periodoacademico_id);
            if ($p !== null) {
                $per = Periodoacademico::where([['anio', '>=', $p->anio], ['tipo_periodo_id', $p->tipo_periodo_id]])->get();
                if (count($per) > 0) {
                    $per2 = $per->sortByDesc('anio');
                    foreach ($per2 as $pe) {
                        $periodos[$pe->id] = $pe->anio . "-" . $pe->periodo;
                    }
                }
            }
        }
        return $periodos;
    }

    /*
     * muestra las notas d euna materia
     */

    public function consultarnotasactuales($gm, $per) {
        //evaluacion academica, consulto fechas
        $g = Grupomatriculado::find($gm);
        $grupo = $g->grupo;
        $fecha = Fechaaplicacionevaluacion::where('periodoacademico_id', $per)->first();
        if ($fecha != null) {
            $hoy = date('Y-m-j');
            if ($hoy >= $fecha->fechainicio && $hoy <= $fecha->fechafin) {
                $aut = Autorizarevaluacion::where([['periodoacademico_id', $per], ['rol', 'ESTUDIANTE']])->first();
                if ($aut != null) {
                    $e = Evaluacionaah::find($aut->evaluacionaah_id);
                    $eval = Aplicarevaluacion::where([['materia_codigomateria', $grupo->materia_codigomateria], ['programa_id', $g->matriculaacademica->estudiantepensum->programaunidad->programa_id], ['periodoacademico_id', $per], ['evaluacionaah_id', $e->id], ['estudiantepensum_id', $g->matriculaacademica->estudiantepensum_id]])->first();
                    if ($eval == null) {
                        //tiene que hacer evaluación
                        flash('Debe hacer la evaluación al docente en el módulo indicado para ello, de lo contrario no podrá visualizar las calificaciones.')->error();
                        return redirect()->route('academicoest.consultarnotas', [$g->matriculaacademica->estudiantepensum_id, 'NA', $per]);
                    }
                }
            }
        }
        $sistema = $grupo->sistemaevalucion;
        $ev = $sistema->evaluacionacademicos;
        $evaluaciones = $ev->sortBy('orden');
        $ep = Estudiantepensum::find($g->matriculaacademica->estudiantepensum_id);
        $numero = $ep->estudiante->personanatural->persona->numero_documento;
        $pn = $ep->estudiante->personanatural;
        $estudiante = $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido;
        $calificaciones = null;
        foreach ($evaluaciones as $e) {
            $calis = Calificacion::where([['evaluacionacademico_id', $e->id], ['grupomatriculado_id', $gm]])->first();
            if ($calis != null) {
                $calificaciones[$e->descripcion . " (" . $e->peso . " %)"] = $calis->valor;
            } else {
                $calificaciones[$e->descripcion . " (" . $e->peso . " %)"] = "--";
            }
        }
        return view('estudiante.academico.calificaciones.actualesdetalles')
                        ->with('location', 'academico-estudiante')
                        ->with('ep', $ep)
                        ->with('evaluaciones', $calificaciones)
                        ->with('est', $estudiante)
                        ->with('numero', $numero)
                        ->with('per', $per)
                        ->with('gm', $g);
    }

}
