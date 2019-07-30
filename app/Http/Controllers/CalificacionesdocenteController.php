<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Persona;
use App\Docenteacademico;
use App\Grupo;
use App\Docenteunidad;
use App\Docentegrupo;
use App\Periodoacademico;
use App\Fechaevaluaciongrupo;
use App\Calificacion;
use App\Sistemaevalucion;
use App\Evaluacionacademico;
use PDF;

class CalificacionesdocenteController extends Controller {
    /*
     * lista los grupos que un docente tiene a cargo un semestre
     */

    public function listargrupos($per) {
        $u = Auth::user();
        $p = Persona::where('numero_documento', $u->identificacion)->get();
        $grupos = null;
        if (count($p) > 0) {
            foreach ($p as $pe) {
                $d = Docenteacademico::find($pe->id);
                if ($d !== null) {
                    $du = Docenteunidad::where('docenteacademico_pege', $d->pege)->get();
                    if (count($du) > 0) {
                        foreach ($du as $v) {
                            $dgs = Docentegrupo::where('docenteunidad_id', $v->id)->get();
                            if (count($dgs) > 0) {
                                foreach ($dgs as $i) {
                                    if ($i->grupo->periodoacademico_id == $per) {
                                        $grupos[] = $i->grupo;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $p = Periodoacademico::find($per);
        return view('docente.academico.calificaciones')
                        ->with('location', 'academico-docente')
                        ->with('d', $grupos)
                        ->with('per', $p);
    }

    /*
     * presenta la vista para realizar calificaciones
     */

    public function vistacalificar($p, $g) {
        $per = Periodoacademico::find($p);
        $grupo = Grupo::find($g);
        if ($grupo->sistemaevalucion_id === null) {
            flash('El grupo no tiene sistema de evaluación asignado; usted debe dirigirse a Registro y Control Académico, al administrador del sistema o a la dependencia encargada para que notifique el evento.')->error();
            return redirect()->route('calificacionesdocente.listargrupos', $per->id);
        }
        $sistema = $grupo->sistemaevalucion;
        $ev = $sistema->evaluacionacademicos;
        $evn = $ev->sortBy('orden');
        $evs = null;
        if (count($evn) > 0) {
            foreach ($evn as $v) {
                if ($v->tipo !== 'HABILITACION') {
                    $evs[$v->id] = $v->descripcion . " - TIPO: " . $v->tipo . " (" . $v->peso . "%)";
                }
            }
        }
        return view('docente.academico.calificacionesd.calificar')
                        ->with('location', 'academico-docente')
                        ->with('sistema', $sistema)
                        ->with('per', $per)
                        ->with('grupo', $grupo)
                        ->with('ev', $evs);
    }

    /*
     * lista los estudiantes de un grupo para calificar y verifica las fechas de ingreso de notas
     */

    public function listarestudiantes($e, $g, $per) {
        $response['error'] = "NO";
        $fechas = Fechaevaluaciongrupo::where([['grupo_id', $g], ['periodoacademico_id', $per], ['evaluacionacademico_id', $e]])->get();
        $tf = count($fechas);
        if ($tf > 0) {
            //verificar fechas
            $hoy = getdate();
            $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"];
            if ($this->check_in_range($fechas[0]->fechainicio, $fechas[$tf - 1]->fechafin, $fecha)) {
                $gr = Grupo::find($g);
                $gm = $gr->grupomatriculados;
                $lista = null;
                if (count($gm) > 0) {
                    foreach ($gm as $i) {
                        if ($i->estado == '1') {
                            $mam = $i->matriculaacademica;
                            if ($mam != null) {
                                $epm = $mam->estudiantepensum;
                                if ($epm != null) {
                                    $em = $epm->estudiante;
                                    if ($em != null) {
                                        $p = $em->personanatural;
                                        if ($p != null) {
                                            $a = null;
                                            $a['doc'] = $p->persona->tipodoc->abreviatura . " - " . $p->persona->numero_documento;
                                            $a['persona'] = $p->primer_apellido . " " . $p->segundo_apellido . " " . $p->primer_nombre . " " . $p->segundo_nombre;
                                            $cal = Calificacion::where([['evaluacionacademico_id', $e], ['grupomatriculado_id', $i->id]])->first();
                                            if ($cal === null) {
                                                $cal = new Calificacion();
                                                $cal->valor = 0;
                                                $cal->evaluacionacademico_id = $e;
                                                $cal->grupomatriculado_id = $i->id;
                                                $cal->save();
                                            }
                                            if ($cal->justificacion === null) {
                                                $cal->justificacion = "";
                                            }
                                            $a['cal'] = $cal;
                                            $a['fallas'] = $i->numerofallas;
                                            $lista[] = $a;
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $lista2 = $this->orderMultiDimensionalArray($lista, 'persona');
                    $response['data'] = $lista2;
                } else {
                    $response['error'] = "SI";
                    $response['msg'] = "No hay estudiantes matriculados en el grupo indicado.";
                }
            } else {
                $response['error'] = "SI";
                $response['msg'] = "El día de hoy esta fuera del rango de fechas estipulado para el ingreso de notas en la evaluación indicada.";
            }
        } else {
            $response['error'] = "SI";
            $response['msg'] = "No se han definido fechas para el ingreso de notas en la evaluación indicada.";
        }
        return json_encode($response);
    }

    //saber si una fecha esta en el rango
    function check_in_range($fecha_inicio, $fecha_fin, $fecha) {
        setlocale(LC_ALL, "es_ES");
        $fecha_inicio = strtotime($fecha_inicio);
        $fecha_fin = strtotime($fecha_fin);
        $fecha = strtotime($fecha);
        if (($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin)) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * modifica o ingresa una calificación
     */

    public function calificar($cal, $estado, $jus, $nota, $fallas) {
        $c = Calificacion::find($cal);
        if ($c !== null) {
            $c->estado = $estado;
            $c->justificacion = null;
            if ($jus !== "NO") {
                $c->justificacion = $jus;
            }
            $c->justificacion = strtoupper($c->justificacion);
            $c->valor = $nota;
            if ($c->save()) {
                $g = $c->grupomatriculado;
                if ($g !== null) {
                    $g->numerofallas = $g->numerofallas + $fallas;
                    $calis = $g->calificacions;
                    if (count($calis) > 0) {
                        $nnn = 0;
                        foreach ($calis as $k) {
                            $nnn = $nnn + ( $k->valor * ($k->evaluacionacademico->peso / 100));
                        }
                        $g->final = round($nnn, 1, PHP_ROUND_HALF_UP);
                        $g->definitiva = round($nnn, 1, PHP_ROUND_HALF_UP);
                    } else {
                        $nnn = $c->valor * ($c->evaluacionacademico->peso / 100);
                        $g->final = round($nnn, 1, PHP_ROUND_HALF_UP);
                        $g->definitiva = round($nnn, 1, PHP_ROUND_HALF_UP);
                    }
                    $g->save();
                }
                return "SI";
            } else {
                return "null";
            }
        } else {
            return "null";
        }
    }

    /*
     * presenta la vista para realizar calificaciones denhabilitaciones
     */

    public function vistahabilitar($p, $g) {
        $per = Periodoacademico::find($p);
        $grupo = Grupo::find($g);
        if ($grupo->sistemaevalucion_id === null) {
            flash('El grupo no tiene sistema de evaluación asignado; usted debe dirigirse a Registro y Control Académico, al administrador del sistema o a la dependencia encargada para que notifique el evento.')->error();
            return redirect()->route('calificacionesdocente.listargrupos', $per->id);
        }
        $sistema = $grupo->sistemaevalucion;
        $ev = $sistema->evaluacionacademicos;
        $evn = $ev->sortBy('orden');
        $evs = $idevs = $estudiantes = null;
        if (count($evn) > 0) {
            foreach ($evn as $v) {
                if ($v->tipo == 'HABILITACION') {
                    $idevs = $v->id;
                    $evs[$v->id] = $v->descripcion . " - TIPO: " . $v->tipo . " (" . $v->peso . "%)";
                }
            }
        }
        $fechas = Fechaevaluaciongrupo::where([['grupo_id', $g], ['periodoacademico_id', $per->id], ['evaluacionacademico_id', $idevs]])->get();
        $tf = count($fechas);
        if ($tf > 0) {
            //verificar fechas
            $hoy = getdate();
            $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"];
            if ($this->check_in_range($fechas[0]->fechainicio, $fechas[$tf - 1]->fechafin, $fecha)) {
                $gm = $grupo->grupomatriculados;
                if (count($gm) > 0) {
                    foreach ($gm as $i) {
                        if ($i->estado == '1' && $i->final < 3) {
                            $p = $i->matriculaacademica->estudiantepensum->estudiante->personanatural;
                            $a = null;
                            $a['doc'] = $p->persona->tipodoc->abreviatura . " - " . $p->persona->numero_documento;
                            $a['persona'] = $p->primer_nombre . " " . $p->segundo_nombre . " " . $p->primer_apellido . " " . $p->segundo_apellido;
                            $a['final'] = $i->final;
                            $a['definitiva'] = $i->definitiva;
                            $a['habilitacion'] = $i->habilitacion;
                            $a['grupom'] = $i->id;
                            $estudiantes[] = $a;
                        }
                    }
                } else {
                    flash('No hay estudiantes matriculados en el grupo indicado.')->error();
                    return redirect()->route('calificacionesdocente.listargrupos', $per->id);
                }
            } else {
                flash('El día de hoy esta fuera del rango de fechas estipulado para el ingreso de notas en la evaluación indicada.')->error();
                return redirect()->route('calificacionesdocente.listargrupos', $per->id);
            }
        } else {
            flash('No se han definido fechas para el ingreso de notas en la evaluación indicada.')->error();
            return redirect()->route('calificacionesdocente.listargrupos', $per->id);
        }
        return view('docente.academico.calificacionesd.habilitar')
                        ->with('location', 'academico-docente')
                        ->with('sistema', $sistema)
                        ->with('per', $per)
                        ->with('grupo', $grupo)
                        ->with('ev', $evs)
                        ->with('estudiantes', $estudiantes)
                        ->with('idevs', $idevs);
    }

    /*
     * ingresa una calificación de habilitacion
     */

    public function habilitar($gm, $estado, $nota, $eval) {
        $c = new Calificacion();
        $c->estado = $estado;
        $c->justificacion = "";
        $c->supletorio = 0;
        $c->evaluacionacademico_id = $eval;
        $c->grupomatriculado_id = $gm;
        $c->valor = $nota;
        if ($c->save()) {
            $g = $c->grupomatriculado;
            $valor = $this->notaHabilitacion($nota, $g, $eval);
            $g->definitiva = $valor['definitiva'];
            $g->habilitacion = $valor['habilitacion'];
            if ($g->save()) {
                return "SI";
            } else {
                $c->delete();
                return "null";
            }
        } else {
            return "null";
        }
    }

    /*
     * calcula el valor de la nota de habilitacion
     */

    public function notaHabilitacion($nota, $gm, $eval) {
        $s = $gm->grupo->sistemaevalucion;
        $evac = Evaluacionacademico::find($eval);
        $valor = [
            'habilitacion' => $nota,
            'definitiva' => 0
        ];
        if ($nota >= 3) {
            switch ($s->parhabapr) {
                case 'APROBATORIA':
                    $valor['definitiva'] = 3;
                    break;
                case 'HABILITACION':
                    $valor['definitiva'] = $nota;
                    break;
                case 'PROMEDIO':
                    $valor['definitiva'] = $this->notaPromedio($evac, $gm, $nota);
                    break;
                case 'PROMEDIO CON NOTA PRACTICA':
                    $valor['definitiva'] = $this->notaPromedio($evac, $gm, $nota);
                    break;
            }
        } else {
            switch ($s->parhabnapr) {
                case 'FINAL':
                    $valor['definitiva'] = $gm->final;
                    break;
                case 'MAYOR':
                    if ($gm->final > $nota) {
                        $valor['definitiva'] = $gm->final;
                    } else {
                        $valor['definitiva'] = $nota;
                    }
                    break;
                case 'HABILITACION':
                    $valor['definitiva'] = $nota;
                    break;
                case 'PROMEDIO':
                    $valor['definitiva'] = $this->notaPromedio($evac, $gm, $nota);
                    break;
                case 'PROMEDIO CON NOTA PRACTICA':
                    $valor['definitiva'] = $this->notaPromedio($evac, $gm, $nota);
                    break;
            }
        }
        return $valor;
    }

    public function notaPromedio($evac, $gm, $nota) {
        $totalf = $totalh = $sumapeso = 0;
        $sumapeso = 100 + $evac->peso;
        $totalf = ($gm->final * 100) / $sumapeso;
        $totalh = ($nota * $evac->peso) / $sumapeso;
        return $totalf + $totalh;
    }

    /*
     * lista las calificaciones de los estudiantes de un grupo
     */

    public function listarestudiantesver($g, $per) {
        $estudiantes = null;
        $gr = Grupo::find($g);
        if ($gr->sistemaevalucion_id === null) {
            flash('El grupo no tiene sistema de evaluación asignado; usted debe dirigirse a Registro y Control Académico, al administrador del sistema o a la dependencia encargada para que notifique el evento.')->error();
            return redirect()->route('calificacionesdocente.listargrupos', $per);
        }
        $sistema = $gr->sistemaevalucion;
        $evaluaciones = $sistema->evaluacionacademicos;
        $gm = $gr->grupomatriculados;
        if (count($gm) > 0) {
            $nro = 0;
            foreach ($gm as $i) {
                if ($i->estado == '1') {
                    $nro = $nro + 1;
                    $mf = $i->matriculaacademica;
                    if ($mf != null) {
                        $epf = $mf->estudiantepensum;
                        if ($epf != null) {
                            $ef = $epf->estudiante;
                            if ($ef != null) {
                                $p = $ef->personanatural;
                                if ($p != null) {
                                    $a = null;
                                    $a['doc'] = $p->persona->tipodoc->abreviatura . " - " . $p->persona->numero_documento;
                                    $a['persona'] = $p->primer_nombre . " " . $p->segundo_nombre . " " . $p->primer_apellido . " " . $p->segundo_apellido;
                                    $a['fallas'] = $i->numerofallas;
                                    $a['final'] = $i->final;
                                    $a['definitiva'] = $i->definitiva;
                                    $a['habilitacion'] = $i->habilitacion;
                                    $lista = null;
                                    foreach ($evaluaciones as $ev) {
                                        if ($ev->tipo !== 'HABILITACION') {
                                            $c = Calificacion::where([['evaluacionacademico_id', $ev->id], ['grupomatriculado_id', $i->id]])->first();
                                            if ($c !== null) {
                                                $lista[] = $c->valor;
                                            } else {
                                                $lista[] = "SIN NOTA";
                                            }
                                        }
                                    }
                                    $a['calificaciones'] = $lista;
                                    $a['nro'] = $nro;
                                    $estudiantes[] = $a;
                                }
                            }
                        }
                    }
                }
            }
        } else {
            flash("No hay estudiantes matriculados en el grupo indicado.")->error();
            return redirect()->route('calificacionesdocente.listargrupos', $per);
        }
        return view('docente.academico.calificacionesd.ver')
                        ->with('location', 'academico-docente')
                        ->with('sistema', $sistema)
                        ->with('per', $per)
                        ->with('grupo', $gr)
                        ->with('ev', $evaluaciones)
                        ->with('estudiantes', $estudiantes);
    }

    /*
     * imprime las calificaciones de los estudiantes de un grupo
     */

    public function listarestudiantesimprimir($g, $per) {
        $estudiantes = null;
        $gr = Grupo::find($g);
        $sistema = $gr->sistemaevalucion;
        $evaluaciones = $sistema->evaluacionacademicos;
        $gm = $gr->grupomatriculados;
        if (count($gm) > 0) {
            $nro = 0;
            foreach ($gm as $i) {
                if ($i->estado == '1') {
                    $nro = $nro + 1;
                    $mf = $i->matriculaacademica;
                    if ($mf != null) {
                        $epf = $mf->estudiantepensum;
                        if ($epf != null) {
                            $ef = $epf->estudiante;
                            if ($ef != null) {
                                $p = $ef->personanatural;
                                if ($p != null) {
                                    $a = null;
                                    $a['doc'] = $p->persona->tipodoc->abreviatura . " - " . $p->persona->numero_documento;
                                    $a['persona'] = $p->primer_nombre . " " . $p->segundo_nombre . " " . $p->primer_apellido . " " . $p->segundo_apellido;
                                    $a['fallas'] = $i->numerofallas;
                                    $a['final'] = $i->final;
                                    $a['definitiva'] = $i->definitiva;
                                    $a['habilitacion'] = $i->habilitacion;
                                    $lista = null;
                                    foreach ($evaluaciones as $ev) {
                                        if ($ev->tipo !== 'HABILITACION') {
                                            $c = Calificacion::where([['evaluacionacademico_id', $ev->id], ['grupomatriculado_id', $i->id]])->first();
                                            if ($c !== null) {
                                                $lista[] = $c->valor;
                                            } else {
                                                $lista[] = "SIN NOTA";
                                            }
                                        }
                                    }
                                    $a['calificaciones'] = $lista;
                                    $a['nro'] = $nro;
                                    $estudiantes[] = $a;
                                }
                            }
                        }
                    }
                }
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>No hay estudiantes matriculados en el grupo indicado.<br/><br/></p>";
        }

        $per = Periodoacademico::find($per);
        $encabezado = [
            'CÓDIGO MATERIA' => $gr->materia_codigomateria,
            'MATERIA' => $gr->materia->nombre,
            'PERÍODO ACADÉMICO' => $per->anio . " - " . $per->periodo,
            'TIPO PERÍODO' => $per->TipoPeriodo->descripcion,
            'GRUPO' => 'GRUPO ' . $gr->nombre,
            'SISTEMA EVALUACIÓN' => $sistema->descripcion
        ];
        $hoy = getdate();
        $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
        $date['fecha'] = $fecha;
        $date['encabezado'] = $encabezado;
        $date['evaluaciones'] = $evaluaciones;
        $date['data'] = $estudiantes;
        $date['titulo'] = "CALIFICACIONES DE LOS ESTUDIANTES EN EL GRUPO " . $gr->nombre;
        $pdf = PDF::loadView('docente.academico.print2', $date);
        return $pdf->stream('listado.pdf');
    }

    public function orderMultiDimensionalArray($toOrderArray, $field, $inverse = false) {
        $position = array();
        $newRow = array();
        foreach ($toOrderArray as $key => $row) {
            $position[$key] = $row[$field];
            $newRow[$key] = $row;
        }
        if ($inverse) {
            arsort($position);
        } else {
            asort($position);
        }
        $returnArray = array();
        foreach ($position as $key => $pos) {
            $returnArray[] = $newRow[$key];
        }
        return $returnArray;
    }

    /*
     * imprime la planilla de calificaciones de los estudiantes de un grupo
     */

    public function planilla($g, $per) {
        $estudiantes = null;
        $gr = Grupo::find($g);
        $sistema = $gr->sistemaevalucion;
        $evaluaciones = $sistema->evaluacionacademicos;
        $gm = $gr->grupomatriculados;
        if (count($gm) > 0) {
            $nro = 0;
            foreach ($gm as $i) {
                if ($i->estado == '1') {
                    $nro = $nro + 1;
                    $mf = $i->matriculaacademica;
                    if ($mf != null) {
                        $epf = $mf->estudiantepensum;
                        if ($epf != null) {
                            $ef = $epf->estudiante;
                            if ($ef != null) {
                                $p = $ef->personanatural;
                                if ($p != null) {
                                    $a = null;
                                    $a['doc'] = $p->persona->tipodoc->abreviatura . " - " . $p->persona->numero_documento;
                                    $a['persona'] = $p->primer_nombre . " " . $p->segundo_nombre . " " . $p->primer_apellido . " " . $p->segundo_apellido;
                                    $a['fallas'] = " ";
                                    $a['definitiva'] = " ";
                                    $a['obs'] = " ";
                                    $lista = null;
                                    foreach ($evaluaciones as $ev) {
                                        if ($ev->tipo !== 'HABILITACION') {
                                            $lista[] = "";
                                        }
                                    }
                                    $a['calificaciones'] = $lista;
                                    $a['nro'] = $nro;
                                    $estudiantes[] = $a;
                                }
                            }
                        }
                    }
                }
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>No hay estudiantes matriculados en el grupo indicado.<br/><br/></p>";
        }

        $per = Periodoacademico::find($per);
        $encabezado = [
            'CÓDIGO MATERIA' => $gr->materia_codigomateria,
            'MATERIA' => $gr->materia->nombre,
            'PERÍODO ACADÉMICO' => $per->anio . " - " . $per->periodo,
            'TIPO PERÍODO' => $per->TipoPeriodo->descripcion,
            'GRUPO' => 'GRUPO ' . $gr->nombre,
            'SISTEMA EVALUACIÓN' => $sistema->descripcion
        ];
        $hoy = getdate();
        $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
        $date['fecha'] = $fecha;
        $date['encabezado'] = $encabezado;
        $date['evaluaciones'] = $evaluaciones;
        $date['data'] = $estudiantes;
        $date['titulo'] = "CALIFICACIONES DE LOS ESTUDIANTES EN EL GRUPO " . $gr->nombre;
        $pdf = PDF::loadView('docente.academico.print3', $date);
        return $pdf->stream('listado.pdf');
    }

    //
    public function calificarMasivo(Request $request) {
        if (count($request->ID_CAL) > 0) {
            $response = "<h3>RESULTADO CALIFICACIÓN MASIVA</h3></br></br>";
            $si = $no = 0;
            $nocal = "";
            $mm = null;
            foreach ($request->ID_CAL as $key => $idcal) {
//                $mm[] = [
//                    'idcal' => $idcal,
//                    'estado' => $request->ESTADO_[$key],
//                    'justificacion' => $request->JUSTIFICACION_[$key],
//                    'nota' => $request->NOTA_[$key],
//                    'fallas' => $request->FALLAS_[$key]
//                ];
                if ($this->calificar($idcal, $request->ESTADO_[$key], $request->JUSTIFICACION_[$key], $request->NOTA_[$key], $request->FALLAS_[$key]) == "SI") {
                    $si = $si + 1;
                } else {
                    $no = $no + 1;
                    $cali = Calificacion::find($idcal);
                    if ($cali !== null) {
                        $pn = $cali->grupomatriculado->matriculaacademica->estudiantepensum->estudiante->personanatural;
                        $nocal = $nocal . "<li>" . $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido . "</li></br>";
                    } else {
                        $nocal = $nocal . "<li>ESTUDIANTE NO ENCONTRADO</li>";
                    }
                }
            }
//            dd($mm);
            $response = $response . "<b>ESTUDIANTES CALIFICADOS CON ÉXITO: " . $si . "</b></br>";
            $response = $response . "<b>ESTUDIANTES SIN CALIFICAR: " . $no . "</b></br></br>";
            $response = $response . "<b>ESTUDIANTES QUE NO FUERION CALIFICADOS:</b></br>";
            $response = $response . "<ol>" . $nocal . "</ol>";
            flash($response)->success();
            return redirect()->route('calificacionesdocente.vistacalificar', [$request->periodo, $request->grupo]);
        } else {
            flash('No se envió la información necesaria para procesar las calificaciones.')->error();
            return redirect()->route('calificacionesdocente.vistacalificar', [$request->periodo, $request->grupo]);
        }
    }

}
