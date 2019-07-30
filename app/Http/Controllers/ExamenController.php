<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Examen;
use App\Resultadoexamen;
use App\Resultadoexamenrespuesta;
use App\Actividad;
use App\Estudiante;
use App\Respuesta;

class ExamenController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $ex = Examen::find($request->examen);
        $resex = Resultadoexamen::find($request->resex);
        if ($ex !== null) {
            if ($resex !== null) {
                $preguntas = $ex->preguntaexamens;
                if (count($preguntas) > 0) {
                    $ptsTotal = $ptsAlcanzados = $calificacion = $tCualitativas = 0;
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "-" . $hoy["mon"] . "-" . $hoy["mday"] . " " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $response = null;
                    foreach ($preguntas as $pr) {
                        $ptsTotal = $ptsTotal + $pr->pregunta->puntos;
                        $var = "PREGUNTA_" . $pr->pregunta_id;
                        if (isset($request->$var)) {
                            if ($pr->pregunta->tipo == 'CUANTITATIVA') {
                                $rer = $this->getResultadore("", "CALIFICADA", 1, $request->$var[0], $pr->pregunta_id, $resex->id);
                                $rer->save();
                                if ($pr->pregunta->respuesta_id == $request->$var[0]) {
                                    $response[] = "[OK]  LA RESPUESTA DE LA PREGUNTA (" . $pr->pregunta->pregunta . ") FUE GUARDADA Y CALIFICADA, LA RESPUESTA ES CORRECTA, PUNTOS OBTENIDOS: " . $pr->pregunta->puntos;
                                    $ptsAlcanzados = $ptsAlcanzados + $pr->pregunta->puntos;
                                } else {
                                    $response[] = "[OK]  LA RESPUESTA DE LA PREGUNTA (" . $pr->pregunta->pregunta . ") FUE GUARDADA Y CALIFICADA, LA RESPUESTA ES INCORRECTA, PUNTOS OBTENIDOS: 0";
                                }
                            } else {
                                $tCualitativas = $tCualitativas + 1;
                                if ($request->$var[0] == null) {
                                    //no hay respuesta cualitativa
                                    $rer = $this->getResultadore("", "CALIFICADA", 0, null, $pr->pregunta_id, $resex->id);
                                    $rer->save();
                                    $response[] = "[X]  LA PREGUNTA (" . $pr->pregunta->pregunta . ") NO FUE RESPONDIDA, PUNTOS OBTENIDOS: 0";
                                } else {
                                    //hay respuesta cualitativa
                                    $rer = $this->getResultadore($request->$var[0], "SIN CALIFICAR", 0, null, $pr->pregunta_id, $resex->id);
                                    $rer->save();
                                    $response[] = "[OK]  LA RESPUESTA DE LA PREGUNTA (" . $pr->pregunta->pregunta . ") FUE GUARDADA Y ESTA A LA ESPERA DE CALIFICACION DEL DOCENTE";
                                }
                            }
                        } else {
                            $rer = $this->getResultadore("", "CALIFICADA", 0, null, $pr->pregunta_id, $resex->id);
                            $rer->save();
                            $response[] = "[X]  LA PREGUNTA (" . $pr->pregunta->pregunta . ") NO FUE RESPONDIDA, PUNTOS OBTENIDOS: 0";
                        }
                    }
                    $resex->intentos = $resex->intentos + 1;
                    $resex->fecharealizacion = $fecha;
                    if ($tCualitativas == 0) {
                        $resex->estado = "CALIFICADO";
                    }
                    $calificacion = ($ptsAlcanzados * 5) / $ptsTotal;
                    $resex->calificacion = round($calificacion, 1, PHP_ROUND_HALF_UP);
                    $resex->puntostotal = $ptsTotal;
                    $resex->puntosalcanzados = $ptsAlcanzados;
                    $resex->save();
                    $html = "<h4><b>RESULTADO DE EXÁMEN GUARDADO...</b></h4><h5>FECHA REALIZACIÓN: " . $resex->fecharealizacion . "</h5><h5>ESTADO: " . $resex->estado . "</h5>"
                            . "<h5>CALIFICACIÓN: <ul><li>EN ESCALA (0-5): " . $resex->calificacion . "</li><li>PUNTOS: " . $resex->puntosalcanzados . "/" . $resex->puntostotal . "</li></ul></h5>"
                            . "<hr/><br/><h4>DETALLES</h4><ol>";
                    foreach ($response as $re) {
                        $html = $html . "<li>" . $re . "</li>";
                    }
                    $html = $html . "</ol>";
                    flash($html)->success();
                    return redirect()->route('panel.estudiante', [$ex->actividad->seccion->grupoav_id, $ex->actividad->seccion->grupoav->periodoacademico_id, $request->est]);
                } else {
                    flash('Problemas al establecer las preguntas para calificar el exámen, lamentamos las molestias ocasionadas. Debe repetir el exámen.')->error();
                    return redirect()->route('actividad.realizarexamen', [$request->actividad_id, $request->est]);
                }
            } else {
                flash('Problemas al establecer la calificación del exámen, lamentamos las molestias ocasionadas. Debe repetir el exámen.')->error();
                return redirect()->route('actividad.realizarexamen', [$request->actividad_id, $request->est]);
            }
        } else {
            flash('Problemas al establecer el exámen para ser calificado, lamentamos las molestias ocasionadas. Debe repetir el exámen.')->error();
            return redirect()->route('actividad.realizarexamen', [$request->actividad_id, $request->est]);
        }
    }

    public function getResultadore($resp, $estado, $ok, $rta, $pre, $resex) {
        $r = Resultadoexamenrespuesta::where([['resultadoexamen_id', $resex], ['pregunta_id', $pre]])->first();
        if ($r === null) {
            $r = new Resultadoexamenrespuesta();
        }
        $r->respuesta = $resp;
        $r->estado = $estado;
        $r->ok = $ok;
        $r->respuesta_id = $rta;
        $r->pregunta_id = $pre;
        $r->resultadoexamen_id = $resex;
        return $r;
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
        //
    }

    /*
     * presenta vista para calificar 
     */

    public function vistacalificar($id) {
        $acti = Actividad::find($id);
        $acti->seccion->grupoav->periodoacademico;
        $acti->seccion->grupoav->asignatura;
        $acti->examen;
        $est = $acti->seccion->grupoav->matestudiantes;
        if (count($est) > 0) {
            $estudiantes = null;
            $nro = 0;
            foreach ($est as $e) {
                $pn = $e->estudiante->personanatural;
                $a = null;
                $nro = $nro + 1;
                $a['nro'] = $nro;
                $a['id'] = $e->estudiante_id;
                $a['nombre'] = $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido;
                $a['ident'] = $pn->persona->numero_documento;
                $estudiantes[] = $a;
            }
            return view('aula_virtual.panel_docente.examencalificar')
                            ->with('location', 'menu-aulavirtual-doc')
                            ->with('acti', $acti)
                            ->with('est', $estudiantes);
        } else {
            flash("No hay estudiantes matriculados en el grupo")->success();
            return redirect()->route('panel.docente', [$acti->seccion->grupoav->asignatura_codigomateria, $acti->seccion->grupoav->id, $acti->seccion->grupoav->periodoacademico_id]);
        }
    }

    /*
     * presenta vista para calificar 
     */

    public function vistacalificarestudiante($id, $est) {
        $acti = Actividad::find($id);
        $acti->seccion->grupoav->periodoacademico;
        $acti->seccion->grupoav->asignatura;
        $ex = $acti->examen;
        $preguntas = $ex->preguntaexamens;
        if (count($preguntas) > 0) {
            $resex = Resultadoexamen::where([['estudiante_id', $est], ['examen_id', $acti->examen->id]])->first();
            if ($resex === null) {
                //el estudiante no realizó el exámen se le califica todo en cero.
                $totalPts = 0;
                foreach ($preguntas as $pr) {
                    $totalPts = $totalPts + $pr->pregunta->puntos;
                }
                $resex = new Resultadoexamen();
                $resex->intentos = 0;
                $resex->estado = "CALIFICADO";
                $resex->calificacion = 0;
                $resex->puntostotal = $totalPts;
                $resex->puntosalcanzados = 0;
                $resex->estudiante_id = $est;
                $resex->examen_id = $ex->id;
                if ($resex->save()) {
                    foreach ($preguntas as $pr2) {
                        $r = new Resultadoexamenrespuesta();
                        $r->respuesta = "";
                        $r->estado = "CALIFICADA";
                        $r->ok = 0;
                        $r->respuesta_id = null;
                        $r->pregunta_id = $pr2->pregunta_id;
                        $r->resultadoexamen_id = $resex->id;
                        $r->save();
                    }
                } else {
                    flash("El estudiante no realizó el exámen y no se le pudo establecer una calificación en 0 ('cero'), debe repetir el proceso.")->error();
                    return redirect()->route('panel.docente', [$acti->seccion->grupoav->asignatura_codigomateria, $acti->seccion->grupoav->id, $acti->seccion->grupoav->periodoacademico_id]);
                }
            }
            //se continua llenando los datos para calificar: el resultado y las preguntas
            $resex->resultadoexamenrespuestas;
            $e = Estudiante::find($est);
            $estu = $numero = "";
            if ($e !== null) {
                $pn = $e->personanatural;
                $estu = $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido;
                $numero = $pn->persona->numero_documento;
            }
            $ok = [
                '0' => 'NO',
                '1' => 'SI'
            ];
            if (count($resex->resultadoexamenrespuestas) > 0) {
                foreach ($resex->resultadoexamenrespuestas as $p) {
                    $p->rta = "NO";
                    $p->rtaCrta = "NO";
                    if ($p->respuesta_id !== null) {
                        $p->rta = Respuesta::find($p->respuesta_id);
                    }
                    if ($p->pregunta->tipo == "CUANTITATIVA") {
                        $p->rtaCrta = Respuesta::find($p->pregunta->respuesta_id);
                    }
                }
            }
            return view('aula_virtual.panel_docente.calificarestudiante')
                            ->with('location', 'menu-aulavirtual-doc')
                            ->with('acti', $acti)
                            ->with('ex', $ex)
                            ->with('numero', $numero)
                            ->with('resex', $resex)
                            ->with('estu', $estu)
                            ->with('ok', $ok);
        } else {
            flash("El exámen no tiene preguntas asociadas")->error();
            return redirect()->route('panel.docente', [$acti->seccion->grupoav->asignatura_codigomateria, $acti->seccion->grupoav->id, $acti->seccion->grupoav->periodoacademico_id]);
        }
    }

    /*
     * guarda la calificacion de una respuesta a un examen
     */

    public function guardarcalest($id, $ok, $cal) {
        $r = Resultadoexamenrespuesta::find($id);
        if ($cal < 0 or $cal > $r->pregunta->puntos) {
            return "CAL";
        }
        $r->estado = "CALIFICADA";
        $r->ok = $ok;
        if ($r->save()) {
            $re = $r->resultadoexamen;
            $re->puntosalcanzados = $re->puntosalcanzados + $cal;
            if ($re->save()) {
                $this->recalcularNota($r);
                return "SI";
            } else {
                $r->estado = "SIN CALIFICAR";
                $r->ok = 0;
                $r->save();
                return "NO";
            }
        } else {
            return "NO";
        }
    }

    public function recalcularNota($r) {
        $re = $r->resultadoexamen;
        $re->calificacion = round((($re->puntosalcanzados * 5) / $re->puntostotal), 1, PHP_ROUND_HALF_UP);
        $resp = $re->resultadoexamenrespuestas;
        if (count($resp) > 0) {
            $t = 0;
            foreach ($resp as $k) {
                if ($k->estado == 'SIN CALIFICAR') {
                    $t = $t + 1;
                }
            }
            if ($t <= 0) {
                $re->estado = "CALIFICADO";
            }
        }
        $re->save();
    }

}
