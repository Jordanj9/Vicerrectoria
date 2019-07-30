<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoUnidad;
use App\NivelEducativo;
use App\Metodologia;
use App\Periodoacademico;
use App\Programa;
use App\Pensum;
use App\Grupo;
use PDF;
use App\Unidad;
use App\Personanatural;
use App\Aplicarevaluacion;
use App\Evaluacionaah;
use App\Valoracionevalucionacademica;
use Illuminate\Support\Facades\Auth;
use App\Docenteacademico;
use App\Autorizarevaluacion;
use App\Persona;
use App\Materia;

class ResultadoseaController extends Controller {
    /*
     * muestra el menu de los resultados
     */

    public function resultadoseaindex() {
        $tu = TipoUnidad::pluck('descripcion', 'id');
        $ne = NivelEducativo::pluck('descripcion', 'id');
        $met = Metodologia::pluck('nombre', 'id');
        $pe = Periodoacademico::all()->sortByDesc('anio');
        $periodos = null;
        foreach ($pe as $p) {
            $periodos[$p->id] = $p->anio . " - " . $p->periodo . " ==> " . $p->tipoperiodo->descripcion;
        }
        return view('evaluacion_academica.resultados.list')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('tu', $tu)
                        ->with('met', $met)
                        ->with('ne', $ne)
                        ->with('periodos', $periodos);
    }

    /*
     * obtiene los docentes 
     */

    public function getDocentes($pr, $per) {
        $pens = Pensum::where('programa_id', $pr)->first();
        $pm = $pens->pensummaterias;
        $response = [
            'error' => 'NO',
            'data' => null,
            'mensaje' => 'OK'
        ];
        if (count($pm) > 0) {
            $data = null;
            foreach ($pm as $m) {
                $gps = Grupo::where([['materia_codigomateria', $m->materia_codigomateria], ['periodoacademico_id', $per]])->get();
                if (count($gps) > 0) {
                    foreach ($gps as $g) {
                        $docs = $g->docentegrupos;
                        if (count($docs) > 0) {
                            foreach ($docs as $d) {
                                if (count($g->grupomatriculados) > 0) {
                                    $pn = Personanatural::find($d->docenteunidad->docenteacademico_pege);
                                    $data[$d->docenteunidad->docenteacademico_pege] = [
                                        'id' => $d->docenteunidad->docenteacademico_pege,
                                        'docente_idt' => $pn->persona->numero_documento,
                                        'docente' => $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido
                                    ];
                                }
                            }
                        }
                    }
                }
            }
            if (count($data) > 0) {
                $response['data'] = $data;
            } else {
                $response['error'] = 'SI';
                $response['mensaje'] = 'No hay docentes';
            }
        } else {
            $response['error'] = 'SI';
            $response['mensaje'] = 'No hay docentes';
        }
        return json_encode($response);
    }

    /*
     * obtiene los resultados de un docente evaluado para todos sus programas en un período determinado
     */

    public function docenteIndividual($d, $p) {
        $doceee = $d;
        $per = $p;
        $docs[] = $d;
        if (count($docs) > 0) {
            $finales = null;
            $finalt = 0;
            foreach ($docs as $do) {
                $discriminados = null;
                $resultados = Aplicarevaluacion::where([['docente_pegea', $do], ['periodoacademico_id', $p]])->get();
                if (count($resultados) > 0) {
                    $evs = null;
                    foreach ($resultados as $r) {
                        $evs[$r->evaluacionaah_id] = $r->evaluacionaah_id;
                    }
                    foreach ($evs as $e) {
                        $items = null;
                        $tevaluados = 0;
                        foreach ($resultados as $r) {
                            if ($e == $r->evaluacionaah_id) {
                                $detalles = $r->aplicarevaluaciondetalles;
                                if (count($detalles) > 0) {
                                    foreach ($detalles as $d) {
                                        if (isset($items[$d->evaluacionindicador->indicador_id])) {
                                            $items[$d->evaluacionindicador->indicador_id] = [
                                                'item' => $d->evaluacionindicador->indicador->indicador . " - " . $d->evaluacionindicador->indicador->criterioevaluacion->nombre,
                                                'valor' => $items[$d->evaluacionindicador->indicador_id]['valor'] + $d->valor,
                                                'total' => $items[$d->evaluacionindicador->indicador_id]['total'] + 1,
                                                'resultado' => 0.0
                                            ];
                                        } else {
                                            $items[$d->evaluacionindicador->indicador_id] = [
                                                'item' => $d->evaluacionindicador->indicador->indicador . " - " . $d->evaluacionindicador->indicador->criterioevaluacion->nombre,
                                                'valor' => $d->valor,
                                                'total' => 1,
                                                'resultado' => 0.0
                                            ];
                                        }
                                    }
                                }
                                $tevaluados = $tevaluados + 1;
                            }
                        }
                        $items2 = null;
                        if (count($items) > 0) {
                            foreach ($items as $key => $value) {
                                $items2[$key] = [
                                    'item' => $value['item'],
                                    'cualitativo' => $this->equivalencia($value['valor'] / $value['total']),
                                    'resultado' => $value['valor'] / $value['total']
                                ];
                            }
                        }
                        $eee = Evaluacionaah::find($e);
                        $valorf = $totalf = 0;
                        foreach ($items2 as $i) {
                            $totalf = $totalf + 1;
                            $valorf = $valorf + $i['resultado'];
                        }
                        $finalt = $finalt + (($valorf / $totalf) * ($eee->peso / 100));
                        $discriminados[$eee->nombre] = [
                            'ev_nombre' => $eee->nombre,
                            'ev_descripcion' => $eee->descripcion,
                            'items' => $items2,
                            'final' => $valorf / $totalf,
                            'cualitativo' => $this->equivalencia($valorf / $totalf),
                            'tevaluados' => $tevaluados,
                            'evaluacion_id' => $e,
                            'docente' => $do,
                            'periodo' => $p
                        ];
                    }
                    $finales[$do] = $discriminados;
                }
            }
            if (count($finales) > 0) {
                return view('evaluacion_academica.resultados.individual')
                                ->with('location', 'menu-evaluacion-auto-hetero')
                                ->with('resultados', $finales)
                                ->with('finalt', $finalt)
                                ->with('finalc', $this->equivalencia($finalt))
                                ->with('doc', $doceee)
                                ->with('per', $per);
            } else {
                flash('No hay resultados para el docente consultado')->error();
                return redirect()->route('resultadosea.inicio');
            }
        } else {
            flash('No hay resultados para el docente consultado')->error();
            return redirect()->route('resultadosea.inicio');
        }
    }

    /*
     * obtiene los resultados de un docente evaluado para todos sus programas en un período determinado
     */

    public function docenteIndividualpdf($d, $p) {
        $docs[] = $d;
        $docente = null;
        $periodo = Periodoacademico::find($p);
        if (count($docs) > 0) {
            $finales = null;
            $finalt = 0;
            foreach ($docs as $do) {
                $docente = Personanatural::where('persona_id', $do)->first();
                $discriminados = null;
                $resultados = Aplicarevaluacion::where([['docente_pegea', $do], ['periodoacademico_id', $p]])->get();
                if (count($resultados) > 0) {
                    $evs = null;
                    foreach ($resultados as $r) {
                        $evs[$r->evaluacionaah_id] = $r->evaluacionaah_id;
                    }
                    foreach ($evs as $e) {
                        $items = null;
                        $tevaluados = 0;
                        foreach ($resultados as $r) {
                            if ($e == $r->evaluacionaah_id) {
                                $detalles = $r->aplicarevaluaciondetalles;
                                if (count($detalles) > 0) {
                                    foreach ($detalles as $d) {
                                        if (isset($items[$d->evaluacionindicador->indicador_id])) {
                                            $items[$d->evaluacionindicador->indicador_id] = [
                                                'item' => $d->evaluacionindicador->indicador->indicador . " - " . $d->evaluacionindicador->indicador->criterioevaluacion->nombre,
                                                'valor' => $items[$d->evaluacionindicador->indicador_id]['valor'] + $d->valor,
                                                'total' => $items[$d->evaluacionindicador->indicador_id]['total'] + 1,
                                                'resultado' => 0.0
                                            ];
                                        } else {
                                            $items[$d->evaluacionindicador->indicador_id] = [
                                                'item' => $d->evaluacionindicador->indicador->indicador . " - " . $d->evaluacionindicador->indicador->criterioevaluacion->nombre,
                                                'valor' => $d->valor,
                                                'total' => 1,
                                                'resultado' => 0.0
                                            ];
                                        }
                                    }
                                }
                                $tevaluados = $tevaluados + 1;
                            }
                        }
                        $items2 = null;
                        if (count($items) > 0) {
                            foreach ($items as $key => $value) {
                                $items2[$key] = [
                                    'item' => $value['item'],
                                    'cualitativo' => $this->equivalencia($value['valor'] / $value['total']),
                                    'resultado' => $value['valor'] / $value['total']
                                ];
                            }
                        }
                        $eee = Evaluacionaah::find($e);
                        $valorf = $totalf = 0;
                        foreach ($items2 as $i) {
                            $totalf = $totalf + 1;
                            $valorf = $valorf + $i['resultado'];
                        }
                        $finalt = $finalt + (($valorf / $totalf) * ($eee->peso / 100));
                        $aute = Autorizarevaluacion::where([['periodoacademico_id', $periodo->id], ['evaluacionaah_id', $eee->id]])->first();
                        $discriminados[$eee->nombre] = [
                            'ev_nombre' => $eee->nombre . " (" . $eee->peso . "%)",
                            'ev_descripcion' => $eee->descripcion,
                            'items' => $items2,
                            'final' => $valorf / $totalf,
                            'cualitativo' => $this->equivalencia($valorf / $totalf),
                            'tevaluados' => $tevaluados,
                            'evaluacion_id' => $e,
                            'docente' => $do,
                            'periodo' => $p,
                            'rol' => $aute->rol
                        ];
                    }
                    $finales[$do] = $discriminados;
                }
            }
            if (count($finales) > 0) {
                $docentee = "---";
                if ($docente != null) {
                    $docentee = $docente->primer_nombre . " " . $docente->segundo_nombre . " " . $docente->primer_apellido . " " . $docente->segundo_apellido;
                }
                $encabezado = [
                    'DOCENTE' => $docentee,
                    'UNIDAD ACADÉMICA' => '',
                    'PERÍODO ACADÉMICO' => $periodo->anio . " - " . $periodo->periodo . " => " . $periodo->TipoPeriodo->descripcion,
                ];
                $evals = Valoracionevalucionacademica::all();
                $cabeceras = ['ACTORES DE EVALUACIÓN', 'CALIFICACIÓN: CUANTITATIVA/CUALITATIVA'];
                $filtros = null;
                $hoy = getdate();
                $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                $date['fecha'] = $fecha;
                $date['encabezado'] = $encabezado;
                $date['cabeceras'] = $cabeceras;
                $date['data'] = $finales;
                $date['eval'] = $evals;
                $date['finalt'] = $finalt;
                $date['finalc'] = $this->equivalencia($finalt);
                $date['titulo'] = "INSTITUTO DE FORMACIÓN TÉCNICA PROFESIONAL SAN JUAN DEL CESAR - LA GUAJIRA | EVALUACIÓN DE DESEMPEÑO DOCENTE";
                $date['filtros'] = $filtros;
                $pdf = PDF::loadView('evaluacion_academica.resultados.print', $date);
                return $pdf->stream('reporte.pdf');
            } else {
                flash('No hay resultados para el docente consultado')->error();
                return redirect()->route('resultadosea.inicio');
            }
        } else {
            flash('No hay resultados para el docente consultado')->error();
            return redirect()->route('resultadosea.inicio');
        }
    }

    /*
     * devuelve una notacion cualitativa a partir de una cuantitativa
     */

    public function equivalencia($valor) {
        $result = " - ";
        $indicadores = Valoracionevalucionacademica::all();
        if (count($indicadores) > 0) {
            foreach ($indicadores as $i) {
                if ($valor >= $i->valor_cuat1 && $valor <= $i->valor_cuat2) {
                    $result = $i->acronimo . " - " . $i->valor_cualitativo;
                }
            }
        }
        return $result;
    }

    /*
     * obtiene los resultados de un docente evaluado para un programa en un período determinado
     */

    public function docentePrograma($d, $p, $pro, $und) {
        $docente = $d;
        $periodo = $p;
        $programa = $pro;
        $unidad = $und;
        $docs[] = $d;
        if (count($docs) > 0) {
            $finales = null;
            $finalt = 0;
            foreach ($docs as $do) {
                $discriminados = null;
                $resultados1 = Aplicarevaluacion::where([['docente_pegea', $do], ['periodoacademico_id', $p], ['programa_id', $pro]])->get();
                $resultados2 = Aplicarevaluacion::where([['docente_pegea', $do], ['docente_pegeq', $do], ['periodoacademico_id', $p]])->get();
                $resultados = null;
                if (count($resultados1) > 0) {
                    foreach ($resultados1 as $r) {
                        $resultados[] = $r;
                    }
                }
                if (count($resultados2) > 0) {
                    foreach ($resultados2 as $r) {
                        $resultados[] = $r;
                    }
                }
                if (count($resultados) > 0) {
                    $evs = null;
                    foreach ($resultados as $r) {
                        $evs[$r->evaluacionaah_id] = $r->evaluacionaah_id;
                    }
                    foreach ($evs as $e) {
                        $items = null;
                        $tevaluados = 0;
                        foreach ($resultados as $r) {
                            if ($e == $r->evaluacionaah_id) {
                                $detalles = $r->aplicarevaluaciondetalles;
                                if (count($detalles) > 0) {
                                    foreach ($detalles as $d) {
                                        if (isset($items[$d->evaluacionindicador->indicador_id])) {
                                            $items[$d->evaluacionindicador->indicador_id] = [
                                                'item' => $d->evaluacionindicador->indicador->indicador . " - " . $d->evaluacionindicador->indicador->criterioevaluacion->nombre,
                                                'valor' => $items[$d->evaluacionindicador->indicador_id]['valor'] + $d->valor,
                                                'total' => $items[$d->evaluacionindicador->indicador_id]['total'] + 1,
                                                'resultado' => 0.0
                                            ];
                                        } else {
                                            $items[$d->evaluacionindicador->indicador_id] = [
                                                'item' => $d->evaluacionindicador->indicador->indicador . " - " . $d->evaluacionindicador->indicador->criterioevaluacion->nombre,
                                                'valor' => $d->valor,
                                                'total' => 1,
                                                'resultado' => 0.0
                                            ];
                                        }
                                    }
                                }
                                $tevaluados = $tevaluados + 1;
                            }
                        }
                        $items2 = null;
                        if (count($items) > 0) {
                            foreach ($items as $key => $value) {
                                $items2[$key] = [
                                    'item' => $value['item'],
                                    'cualitativo' => $this->equivalencia($value['valor'] / $value['total']),
                                    'resultado' => $value['valor'] / $value['total']
                                ];
                            }
                        }
                        $eee = Evaluacionaah::find($e);
                        $valorf = $totalf = 0;
                        foreach ($items2 as $i) {
                            $totalf = $totalf + 1;
                            $valorf = $valorf + $i['resultado'];
                        }
                        $finalt = $finalt + (($valorf / $totalf) * ($eee->peso / 100));
                        $discriminados[$eee->nombre] = [
                            'ev_nombre' => $eee->nombre,
                            'ev_descripcion' => $eee->descripcion,
                            'items' => $items2,
                            'final' => $valorf / $totalf,
                            'cualitativo' => $this->equivalencia($valorf / $totalf),
                            'tevaluados' => $tevaluados,
                            'evaluacion_id' => $e,
                            'docente' => $do,
                            'periodo' => $p
                        ];
                    }
                    $finales[$do] = $discriminados;
                }
            }
            if (count($finales) > 0) {
                $prf = Programa::find($pro);
                return view('evaluacion_academica.resultados.programa')
                                ->with('location', 'menu-evaluacion-auto-hetero')
                                ->with('resultados', $finales)
                                ->with('programa', $prf)
                                ->with('finalt', $finalt)
                                ->with('docente', $docente)
                                ->with('periodo', $periodo)
                                ->with('unidad', $unidad)
                                ->with('finalc', $this->equivalencia($finalt));
            } else {
                flash('No hay resultados para el docente consultado')->error();
                return redirect()->route('resultadosea.inicio');
            }
        } else {
            flash('No hay resultados para el docente consultado')->error();
            return redirect()->route('resultadosea.inicio');
        }
    }

    /*
     * obtiene los resultados de un docente evaluado para un programa en un período determinado
     */

    public function docenteProgramapdf($d, $p, $pro, $und) {
        $docente = null;
        $periodo = Periodoacademico::find($p);
        $unidad = Unidad::find($und);
        $docs[] = $d;
        if (count($docs) > 0) {
            $finales = null;
            $finalt = 0;
            foreach ($docs as $do) {
                $docente = Personanatural::where('persona_id', $do)->first();
                $discriminados = null;
                $resultados1 = Aplicarevaluacion::where([['docente_pegea', $do], ['periodoacademico_id', $p], ['programa_id', $pro]])->get();
                $resultados2 = Aplicarevaluacion::where([['docente_pegea', $do], ['docente_pegeq', $do], ['periodoacademico_id', $p]])->get();
                $resultados = null;
                if (count($resultados1) > 0) {
                    foreach ($resultados1 as $r) {
                        $resultados[] = $r;
                    }
                }
                if (count($resultados2) > 0) {
                    foreach ($resultados2 as $r) {
                        $resultados[] = $r;
                    }
                }
                if (count($resultados) > 0) {
                    $evs = null;
                    foreach ($resultados as $r) {
                        $evs[$r->evaluacionaah_id] = $r->evaluacionaah_id;
                    }
                    foreach ($evs as $e) {
                        $items = null;
                        $tevaluados = 0;
                        foreach ($resultados as $r) {
                            if ($e == $r->evaluacionaah_id) {
                                $detalles = $r->aplicarevaluaciondetalles;
                                if (count($detalles) > 0) {
                                    foreach ($detalles as $d) {
                                        if (isset($items[$d->evaluacionindicador->indicador_id])) {
                                            $items[$d->evaluacionindicador->indicador_id] = [
                                                'item' => $d->evaluacionindicador->indicador->indicador . " - " . $d->evaluacionindicador->indicador->criterioevaluacion->nombre,
                                                'valor' => $items[$d->evaluacionindicador->indicador_id]['valor'] + $d->valor,
                                                'total' => $items[$d->evaluacionindicador->indicador_id]['total'] + 1,
                                                'resultado' => 0.0
                                            ];
                                        } else {
                                            $items[$d->evaluacionindicador->indicador_id] = [
                                                'item' => $d->evaluacionindicador->indicador->indicador . " - " . $d->evaluacionindicador->indicador->criterioevaluacion->nombre,
                                                'valor' => $d->valor,
                                                'total' => 1,
                                                'resultado' => 0.0
                                            ];
                                        }
                                    }
                                }
                                $tevaluados = $tevaluados + 1;
                            }
                        }
                        $items2 = null;
                        if (count($items) > 0) {
                            foreach ($items as $key => $value) {
                                $items2[$key] = [
                                    'item' => $value['item'],
                                    'cualitativo' => $this->equivalencia($value['valor'] / $value['total']),
                                    'resultado' => $value['valor'] / $value['total']
                                ];
                            }
                        }
                        $eee = Evaluacionaah::find($e);
                        $valorf = $totalf = 0;
                        foreach ($items2 as $i) {
                            $totalf = $totalf + 1;
                            $valorf = $valorf + $i['resultado'];
                        }
                        $finalt = $finalt + (($valorf / $totalf) * ($eee->peso / 100));
                        $aute = Autorizarevaluacion::where([['periodoacademico_id', $periodo->id], ['evaluacionaah_id', $eee->id]])->first();
                        $discriminados[$eee->nombre] = [
                            'ev_nombre' => $eee->nombre . " (" . $eee->peso . "%)",
                            'ev_descripcion' => $eee->descripcion,
                            'items' => $items2,
                            'final' => $valorf / $totalf,
                            'cualitativo' => $this->equivalencia($valorf / $totalf),
                            'tevaluados' => $tevaluados,
                            'evaluacion_id' => $e,
                            'docente' => $do,
                            'periodo' => $p,
                            'rol' => $aute->rol
                        ];
                    }
                    $finales[$do] = $discriminados;
                }
            }
            if (count($finales) > 0) {
                $prf = Programa::find($pro);
                $docentee = "---";
                if ($docente != null) {
                    $docentee = $docente->primer_nombre . " " . $docente->segundo_nombre . " " . $docente->primer_apellido . " " . $docente->segundo_apellido;
                }
                $encabezado = [
                    'PROGRAMA' => $prf->nombre,
                    'DOCENTE' => $docentee,
                    'UNIDAD ACADÉMICA' => $unidad->nombre,
                    'PERÍODO ACADÉMICO' => $periodo->anio . " - " . $periodo->periodo . " => " . $periodo->TipoPeriodo->descripcion,
                ];
                $evals = Valoracionevalucionacademica::all();
                $cabeceras = ['ACTORES DE EVALUACIÓN', 'CALIFICACIÓN: CUANTITATIVA/CUALITATIVA'];
                $filtros = null;
                $hoy = getdate();
                $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                $date['fecha'] = $fecha;
                $date['encabezado'] = $encabezado;
                $date['cabeceras'] = $cabeceras;
                $date['data'] = $finales;
                $date['eval'] = $evals;
                $date['finalt'] = $finalt;
                $date['finalc'] = $this->equivalencia($finalt);
                $date['titulo'] = "INSTITUTO DE FORMACIÓN TÉCNICA PROFESIONAL SAN JUAN DEL CESAR - LA GUAJIRA | EVALUACIÓN DE DESEMPEÑO DOCENTE POR PROGRAMA";
                $date['filtros'] = $filtros;
                $pdf = PDF::loadView('evaluacion_academica.resultados.print', $date);
                return $pdf->stream('reporte.pdf');
            } else {
                flash('No hay resultados para el docente consultado')->error();
                return redirect()->route('resultadosea.inicio');
            }
        } else {
            flash('No hay resultados para el docente consultado')->error();
            return redirect()->route('resultadosea.inicio');
        }
    }

    /*
     * muestra el menu de los resultados para el docente
     */

    public function resultadosdocenteindex() {
        $pe = Periodoacademico::all()->sortByDesc('anio');
        $periodos = null;
        foreach ($pe as $p) {
            $periodos[$p->id] = $p->anio . " - " . $p->periodo . " ==> " . $p->tipoperiodo->descripcion;
        }
        return view('evaluacion_academica.resultados.docente')
                        ->with('location', 'menu-evaluacion-auto-hetero')
                        ->with('periodos', $periodos);
    }

    /*
     * muestra los resultados para el docente
     */

    public function resultadosdocenteresultados($p) {
        $u = Auth::user();
        $persona = Persona::where('numero_documento', $u->identificacion)->get();
        $docs = null;
        if (count($persona) > 0) {
            foreach ($persona as $pe) {
                $d = Docenteacademico::where('pege', $pe->id)->get();
                if (count($d) > 0) {
                    foreach ($d as $i) {
                        $docs[] = $i->pege;
                    }
                }
            }
            if (count($docs) > 0) {
                $finales = null;
                $finalt = 0;
                foreach ($docs as $do) {
                    $discriminados = null;
                    $resultados = Aplicarevaluacion::where([['docente_pegea', $do], ['periodoacademico_id', $p]])->get();
                    if (count($resultados) > 0) {
                        $evs = null;
                        foreach ($resultados as $r) {
                            $evs[$r->evaluacionaah_id] = $r->evaluacionaah_id;
                        }
                        foreach ($evs as $e) {
                            $items = null;
                            $tevaluados = 0;
                            foreach ($resultados as $r) {
                                if ($e == $r->evaluacionaah_id) {
                                    $detalles = $r->aplicarevaluaciondetalles;
                                    if (count($detalles) > 0) {
                                        foreach ($detalles as $d) {
                                            if (isset($items[$d->evaluacionindicador->indicador_id])) {
                                                $items[$d->evaluacionindicador->indicador_id] = [
                                                    'item' => $d->evaluacionindicador->indicador->indicador . " - " . $d->evaluacionindicador->indicador->criterioevaluacion->nombre,
                                                    'valor' => $items[$d->evaluacionindicador->indicador_id]['valor'] + $d->valor,
                                                    'total' => $items[$d->evaluacionindicador->indicador_id]['total'] + 1,
                                                    'resultado' => 0.0
                                                ];
                                            } else {
                                                $items[$d->evaluacionindicador->indicador_id] = [
                                                    'item' => $d->evaluacionindicador->indicador->indicador . " - " . $d->evaluacionindicador->indicador->criterioevaluacion->nombre,
                                                    'valor' => $d->valor,
                                                    'total' => 1,
                                                    'resultado' => 0.0
                                                ];
                                            }
                                        }
                                    }
                                    $tevaluados = $tevaluados + 1;
                                }
                            }
                            $items2 = null;
                            if (count($items) > 0) {
                                foreach ($items as $key => $value) {
                                    $items2[$key] = [
                                        'item' => $value['item'],
                                        'cualitativo' => $this->equivalencia($value['valor'] / $value['total']),
                                        'resultado' => $value['valor'] / $value['total']
                                    ];
                                }
                            }
                            $eee = Evaluacionaah::find($e);
                            $valorf = $totalf = 0;
                            foreach ($items2 as $i) {
                                $totalf = $totalf + 1;
                                $valorf = $valorf + $i['resultado'];
                            }
                            $finalt = $finalt + (($valorf / $totalf) * ($eee->peso / 100));
                            $discriminados[$eee->nombre] = [
                                'ev_nombre' => $eee->nombre,
                                'ev_descripcion' => $eee->descripcion,
                                'items' => $items2,
                                'final' => $valorf / $totalf,
                                'cualitativo' => $this->equivalencia($valorf / $totalf),
                                'tevaluados' => $tevaluados,
                                'evaluacion_id' => $e,
                                'docente' => $do,
                                'periodo' => $p
                            ];
                        }
                        $finales[$do] = $discriminados;
                    }
                }
                if (count($finales) > 0) {
                    return view('evaluacion_academica.resultados.docenteresultados')
                                    ->with('location', 'menu-evaluacion-auto-hetero')
                                    ->with('resultados', $finales)
                                    ->with('finalt', $finalt)
                                    ->with('finalc', $this->equivalencia($finalt));
                } else {
                    flash('No hay resultados para el docente consultado')->error();
                    return redirect()->route('resultadosea.resultadosdocenteindex');
                }
            } else {
                flash('No hay resultados para el docente consultado')->error();
                return redirect()->route('resultadosea.resultadosdocenteindex');
            }
        } else {
            flash('No hay resultados para el docente consultado')->error();
            return redirect()->route('resultadosea.resultadosdocenteindex');
        }
    }

    /*
     * muestra los resultados para el docente
     */

    public function resultadosdocenteresultadosc($p, $e, $d) {
        $discriminados = null;
        $resultados = Aplicarevaluacion::where([['docente_pegea', $d], ['periodoacademico_id', $p], ['evaluacionaah_id', $e]])->get();
        if (count($resultados) > 0) {
            $discriminados = null;
            $i = 0;
            foreach ($resultados as $r) {
                $i = $i + 1;
                $detalles = $r->aplicarevaluaciondetalles;
                $items = null;
                if (count($detalles) > 0) {
                    foreach ($detalles as $de) {
                        $items[$de->evaluacionindicador->indicador_id] = [
                            'item' => $de->evaluacionindicador->indicador->indicador . " - " . $de->evaluacionindicador->indicador->criterioevaluacion->nombre,
                            'valor' => $de->valor,
                            'equivalencia' => $this->equivalencia($de->valor)
                        ];
                    }
                }
                $label = "PERSONA ";
                if ($r->jefedepartamento_id != "") {
                    $label = "ENCARGADO DEL PROGRAMA: " . $r->jefedepartamento->programa->nombre;
                }
                if ($r->estudiantepensum_id != "") {
                    $label = "ESTUDIANTE: " . $i;
                }
                if ($r->docente_pegeq != "") {
                    $pn = Personanatural::find($d);
                    $label = "DOCENTE: " . $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido;
                }
                $m = Materia::find($r->materia_codigomateria);
                $discriminados[] = [
                    'quien' => $label,
                    'formulario' => $r,
                    'evaluacion' => $r->evaluacionaah,
                    'items' => $items,
                    'materia' => $m
                ];
            }
            if ($discriminados !== null) {
                return view('evaluacion_academica.resultados.docenteresultadosc')
                                ->with('location', 'menu-evaluacion-auto-hetero')
                                ->with('resultados', $discriminados)
                                ->with('p', $p);
            } else {
                flash('No hay resultados específicos para la evaluación indicada')->error();
                return redirect()->route('resultadosea.resultadosdocenteresultados', $p);
            }
        } else {
            flash('No hay resultados específicos para la evaluación indicada')->error();
            return redirect()->route('resultadosea.resultadosdocenteresultados', $p);
        }
    }

    /*
     * muestra los resultados del docente para la administracion
     */

    public function resultadosdocenteresultadosca($p, $e, $d) {
        $discriminados = null;
        $resultados = Aplicarevaluacion::where([['docente_pegea', $d], ['periodoacademico_id', $p], ['evaluacionaah_id', $e]])->get();
        if (count($resultados) > 0) {
            $discriminados = null;
            $i = 0;
            foreach ($resultados as $r) {
                $i = $i + 1;
                $detalles = $r->aplicarevaluaciondetalles;
                $items = null;
                if (count($detalles) > 0) {
                    foreach ($detalles as $de) {
                        $items[$de->evaluacionindicador->indicador_id] = [
                            'item' => $de->evaluacionindicador->indicador->indicador . " - " . $de->evaluacionindicador->indicador->criterioevaluacion->nombre,
                            'valor' => $de->valor,
                            'equivalencia' => $this->equivalencia($de->valor)
                        ];
                    }
                }
                $label = "PERSONA ";
                if ($r->jefedepartamento_id != "") {
                    $label = "ENCARGADO DEL PROGRAMA: " . $r->jefedepartamento->programa->nombre;
                }
                if ($r->estudiantepensum_id != "") {
                    $label = "ESTUDIANTE: " . $i;
                }
                if ($r->docente_pegeq != "") {
                    $pn = Personanatural::find($d);
                    $label = "DOCENTE: " . $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido;
                }
                $m = Materia::find($r->materia_codigomateria);
                $discriminados[] = [
                    'quien' => $label,
                    'formulario' => $r,
                    'evaluacion' => $r->evaluacionaah,
                    'items' => $items,
                    'materia' => $m
                ];
            }
            if ($discriminados !== null) {
                return view('evaluacion_academica.resultados.individualdetalles')
                                ->with('location', 'menu-evaluacion-auto-hetero')
                                ->with('resultados', $discriminados)
                                ->with('p', $p)
                                ->with('doc', $d);
            } else {
                flash('No hay resultados específicos para la evaluación indicada')->error();
                return redirect()->route('resultadosea.docenteindividual', [$d, $p]);
            }
        } else {
            flash('No hay resultados específicos para la evaluación indicada')->error();
            return redirect()->route('resultadosea.docenteindividual', [$d, $p]);
        }
    }

    /*
     * muestra los resultados del docente para la administracion
     */

    public function resultadosdocenteresultadoscap($p, $e, $d, $pro) {
        $discriminados = null;
        $resultados1 = Aplicarevaluacion::where([['docente_pegea', $d], ['periodoacademico_id', $p], ['evaluacionaah_id', $e], ['programa_id', $pro]])->get();
        $resultados2 = Aplicarevaluacion::where([['docente_pegea', $d], ['docente_pegeq', $d], ['evaluacionaah_id', $e], ['periodoacademico_id', $p]])->get();
        $resultados = null;
        if (count($resultados1) > 0) {
            foreach ($resultados1 as $r) {
                $resultados[] = $r;
            }
        }
        if (count($resultados2) > 0) {
            foreach ($resultados2 as $r) {
                $resultados[] = $r;
            }
        }
        if (count($resultados) > 0) {
            $discriminados = null;
            $i = 0;
            foreach ($resultados as $r) {
                $i = $i + 1;
                $detalles = $r->aplicarevaluaciondetalles;
                $items = null;
                if (count($detalles) > 0) {
                    foreach ($detalles as $de) {
                        $items[$de->evaluacionindicador->indicador_id] = [
                            'item' => $de->evaluacionindicador->indicador->indicador . " - " . $de->evaluacionindicador->indicador->criterioevaluacion->nombre,
                            'valor' => $de->valor,
                            'equivalencia' => $this->equivalencia($de->valor)
                        ];
                    }
                }
                $label = "PERSONA ";
                if ($r->jefedepartamento_id != "") {
                    $label = "ENCARGADO DEL PROGRAMA: " . $r->jefedepartamento->programa->nombre;
                }
                if ($r->estudiantepensum_id != "") {
                    $label = "ESTUDIANTE: " . $i;
                }
                if ($r->docente_pegeq != "") {
                    $pn = Personanatural::find($d);
                    $label = "DOCENTE: " . $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido;
                }
                $m = Materia::find($r->materia_codigomateria);
                $discriminados[] = [
                    'quien' => $label,
                    'formulario' => $r,
                    'evaluacion' => $r->evaluacionaah,
                    'items' => $items,
                    'materia' => $m
                ];
            }
            if ($discriminados !== null) {
                return view('evaluacion_academica.resultados.programadetalles')
                                ->with('location', 'menu-evaluacion-auto-hetero')
                                ->with('resultados', $discriminados)
                                ->with('p', $p)
                                ->with('doc', $d);
            } else {
                flash('No hay resultados específicos para la evaluación indicada')->error();
                return redirect()->route('resultadosea.docentes', $p);
            }
        } else {
            flash('No hay resultados específicos para la evaluación indicada')->error();
            return redirect()->route('resultadosea.docentes', $p);
        }
    }

}
