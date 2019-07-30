<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SistemaevaluacionRequest;
use App\Sistemaevalucion;
use App\Evaluacionacademico;
use App\Norma;
use App\AuditoriaAcademico;
use Illuminate\Support\Facades\Auth;
use App\Periodoacademico;
use App\Metodologia;
use App\NivelEducativo;
use App\Grupo;
use App\Pensummateria;
use App\Pensum;
use App\Materia;

class SistemaevaluacionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $se = Sistemaevalucion::all();
        return view('academico.registro_academico.calificaciones.sistema_evaluacion.sistema_evaluacion.list')
                        ->with('location', 'academico')
                        ->with('se', $se);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $nor = Norma::pluck('descripcion', 'id');
        return view('academico.registro_academico.calificaciones.sistema_evaluacion.sistema_evaluacion.create')
                        ->with('location', 'academico')
                        ->with('nor', $nor);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SistemaevaluacionRequest $request) {
        $se = new Sistemaevalucion($request->all());
        foreach ($se->attributesToArray() as $key => $value) {
            $se->$key = strtoupper($value);
        }
        $result = $se->save();
        if ($result) {
            $aud = new AuditoriaAcademico();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE SISTEMA DE EVALUACION. DATOS: ";
            foreach ($se->attributesToArray() as $key => $value) {
                if ($key == 'norma_id') {
                    $str = $str . ", " . $key . ": " . $value . ", norma:" . $se->norma->descripcion;
                } else {
                    $str = $str . ", " . $key . ": " . $value;
                }
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El Sistema de Evaluación <strong>" . $se->descripcion . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('sistevalu.index');
        } else {
            flash("El Sistema de Evaluación <strong>" . $se->descripcion . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('sistevalu.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $se = Sistemaevalucion::find($id);
        $ev = $se->evaluacionacademicos;
        $se->norma;
        return view('academico.registro_academico.calificaciones.sistema_evaluacion.sistema_evaluacion.show')
                        ->with('location', 'academico')
                        ->with('ev', $ev)
                        ->with('se', $se);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $se = Sistemaevalucion::find($id);
        return view('academico.registro_academico.calificaciones.sistema_evaluacion.sistema_evaluacion.edit')
                        ->with('location', 'academico')
                        ->with('se', $se);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $l = Sistemaevalucion::find($id);
        $lo = new Sistemaevalucion($l->attributesToArray());
        foreach ($l->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $l->$key = strtoupper($request->$key);
            }
        }
        $s1 = $l->parhabapr;
        $s2 = $l->parhabnapr;
        if ($s1 !== "PROMEDIO" && $s2 !== "PROMEDIO" && $s1 !== "PROMEDIO CON NOTA PRACTICA" && $s2 !== "PROMEDIO CON NOTA PRACTICA") {
            $l->pesodefinitiva = null;
            $l->pesohabilitacion = null;
        }
        $result = $l->save();
        if ($result) {
            $aud = new AuditoriaAcademico();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICIÓN DE SISTEMA DE EVALUACION. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($lo->attributesToArray() as $key => $value) {
                if ($key == 'norma_id') {
                    $str2 = $str2 . ", " . $key . ": " . $value . ", norma:" . $lo->norma->descripcion;
                } else {
                    $str2 = $str2 . ", " . $key . ": " . $value;
                }
            }
            foreach ($l->attributesToArray() as $key => $value) {
                if ($key == 'norma_id') {
                    $str = $str . ", " . $key . ": " . $value . ", norma:" . $l->norma->descripcion;
                } else {
                    $str = $str . ", " . $key . ": " . $value;
                }
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("El Sistema de Evaluación <strong>" . $l->descripcion . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('sistevalu.index');
        } else {
            flash("El Sistema de Evaluación <strong>" . $l->descripcion . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('sistevalu.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $l = Sistemaevalucion::find($id);
        if (count($l->evaluacionacademicos) > 0) {
            flash("El Sistema de Evaluación <strong>" . $l->descripcion . "</strong> no fue eliminado porque tiene Evaluaciones asociadas.")->warning();
            return redirect()->route('sistevalu.index');
        } else {
            $result = $l->delete();
            if ($result) {
                $aud = new AuditoriaAcademico();
                $u = Auth::user();
                $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
                $aud->operacion = "ELIMINAR";
                $str = "ELIMINACIÓN DE SISTEMA DE EVALUACION. DATOS ELIMINADOS: ";
                foreach ($l->attributesToArray() as $key => $value) {
                    if ($key == 'norma_id') {
                        $str = $str . ", " . $key . ": " . $value . ", norma:" . $l->norma->descripcion;
                    } else {
                        $str = $str . ", " . $key . ": " . $value;
                    }
                }
                $aud->detalles = $str;
                $aud->save();
                flash("El Sistema de Evaluación <strong>" . $l->descripcion . "</strong> fue eliminado de forma exitosa!")->success();
                return redirect()->route('sistevalu.index');
            } else {
                flash("El Sistema de Evaluación <strong>" . $l->descripcion . "</strong> no pudo ser eliminado. Error: " . $result)->error();
                return redirect()->route('sistevalu.index');
            }
        }
    }

    public function verperiodo() {
        dd('construir funcionalidad');
    }

    /*
     * asignar sistema evaluacion menu
     */

    public function asignarmenu() {
        $per = Periodoacademico::all()->sortByDesc('anio');
        $periodos = null;
        foreach ($per as $p) {
            $periodos[$p->id] = $p->anio . " - " . $p->periodo . " ==> " . $p->tipoperiodo->descripcion;
        }
        return view('academico.registro_academico.calificaciones.sistema_evaluacion.asignar_sistemaevaluacion.list')
                        ->with('location', 'academico')
                        ->with('per', $periodos);
    }

    /*
     * asignar sistema evaluacion por pensum
     */

    public function asignarmenuporpensum($p) {
        $per = Periodoacademico::find($p);
        $ne = NivelEducativo::pluck('descripcion', 'id');
        $met = Metodologia::pluck('nombre', 'id');
        $sist = Sistemaevalucion::pluck('descripcion', 'id');
        return view('academico.registro_academico.calificaciones.sistema_evaluacion.asignar_sistemaevaluacion.porpensum')
                        ->with('location', 'academico')
                        ->with('per', $per)
                        ->with('ne', $ne)
                        ->with('sist', $sist)
                        ->with('met', $met);
    }

    /*
     * obtiene los sistemas de evaluacion asignados a un pensum para un periodo determinado
     */

    public function getsistemas($per, $pensum) {
        $materias = Pensummateria::where('pensum_id', $pensum)->get();
        if (count($materias) > 0) {
            $sistemas = null;
            foreach ($materias as $m) {
                $grupos = null;
                $grupos = Grupo::where([['periodoacademico_id', $per], ['materia_codigomateria', $m->materia_codigomateria]])->get();
                if (count($grupos) > 0) {
                    foreach ($grupos as $g) {
                        if ($g->sistemaevalucion_id !== null) {
                            $sistemas[$g->sistemaevalucion_id] = $g->sistemaevalucion->descripcion;
                        }
                    }
                }
            }
            if ($sistemas !== null) {
                return json_encode($sistemas);
            } else {
                return "null";
            }
        } else {
            return "null";
        }
    }

    /*
     * asigna el sistema de evaluacion al pensum indicado
     */

    public function sistemasasignar($per, $pensum, $sistema) {
        $materias = Pensummateria::where('pensum_id', $pensum)->get();
        if (count($materias) > 0) {
            $si = $no = 0;
            foreach ($materias as $m) {
                $grupos = null;
                $grupos = Grupo::where([['periodoacademico_id', $per], ['materia_codigomateria', $m->materia_codigomateria]])->get();
                if (count($grupos) > 0) {
                    foreach ($grupos as $g) {
                        $g->sistemaevalucion_id = $sistema;
                        if ($g->save()) {
                            $si = $si + 1;
                        } else {
                            $no = $no + 1;
                        }
                    }
                }
            }
            flash("El Sistema de Evaluación fue asignado a " . $si . " grupos y no pudo ser asignado a " . $no . " grupos del pensum indicado")->success();
            return redirect()->route('sistevalu.asignarmenuporpensum', $per);
        } else {
            flash("El Sistema de Evaluación no pudo ser asignado al pensum indicado")->error();
            return redirect()->route('sistevalu.asignarmenuporpensum', $per);
        }
    }

    /*
     * ver grupos afectados por pensum
     */

    public function verafectados($per, $pen, $sis) {
        $materias = Pensummateria::where('pensum_id', $pen)->get();
        $gruposafectados = null;
        if (count($materias) > 0) {
            foreach ($materias as $m) {
                $grupos = null;
                $grupos = Grupo::where([['periodoacademico_id', $per], ['materia_codigomateria', $m->materia_codigomateria]])->get();
                if (count($grupos) > 0) {
                    foreach ($grupos as $g) {
                        if ($g->sistemaevalucion_id !== null) {
                            if ($g->sistemaevalucion_id == $sis) {
                                $g->materia;
                                $g->unidad;
                                $gruposafectados[] = $g;
                            }
                        }
                    }
                }
            }
        }
        $per = Periodoacademico::find($per);
        $pensum = Pensum::find($pen);
        $pensum->programa->metodologia;
        $pensum->programa->modalidad;
        $sist = Sistemaevalucion::find($sis);
        return view('academico.registro_academico.calificaciones.sistema_evaluacion.asignar_sistemaevaluacion.porpensumver')
                        ->with('location', 'academico')
                        ->with('per', $per)
                        ->with('sis', $sist)
                        ->with('pensum', $pensum)
                        ->with('grupos', $gruposafectados);
    }

    /*
     * asignar sistema evaluacion por materia
     */

    public function asignarmenupormateria($p) {
        $per = Periodoacademico::find($p);
        $ne = NivelEducativo::pluck('descripcion', 'id');
        $met = Metodologia::pluck('nombre', 'id');
        $sist = Sistemaevalucion::pluck('descripcion', 'id');
        return view('academico.registro_academico.calificaciones.sistema_evaluacion.asignar_sistemaevaluacion.pormateria')
                        ->with('location', 'academico')
                        ->with('per', $per)
                        ->with('ne', $ne)
                        ->with('sist', $sist)
                        ->with('met', $met);
    }

    /*
     * obtiene los sistemas de evaluacion asignados a una materia para un periodo determinado
     */

    public function getsistemasxm($per, $materia) {
        $sistemas = null;
        $grupos = Grupo::where([['periodoacademico_id', $per], ['materia_codigomateria', $materia]])->get();
        if (count($grupos) > 0) {
            foreach ($grupos as $g) {
                if ($g->sistemaevalucion_id !== null) {
                    $sistemas[$g->sistemaevalucion_id] = $g->sistemaevalucion->descripcion;
                }
            }
            if ($sistemas !== null) {
                return json_encode($sistemas);
            } else {
                return "null";
            }
        } else {
            return "null";
        }
    }

    /*
     * asigna el sistema de evaluacion a la materia indicada
     */

    public function sistemasasignarxm($per, $materia, $sistema) {
        $grupos = Grupo::where([['periodoacademico_id', $per], ['materia_codigomateria', $materia]])->get();
        if (count($grupos) > 0) {
            $si = $no = 0;
            foreach ($grupos as $g) {
                $g->sistemaevalucion_id = $sistema;
                if ($g->save()) {
                    $si = $si + 1;
                } else {
                    $no = $no + 1;
                }
            }
            flash("El Sistema de Evaluación fue asignado a " . $si . " grupos y no pudo ser asignado a " . $no . " grupos de la materia indicada.")->success();
            return redirect()->route('sistevalu.asignarmenupormateria', $per);
        } else {
            flash("El Sistema de Evaluación no pudo ser asignado a la materia puesto que no tiene grupos en el período indicado.")->error();
            return redirect()->route('sistevalu.asignarmenupormateria', $per);
        }
    }

    /*
     * ver grupos afectados por materia
     */

    public function verafectadosxm($per, $materia, $sis) {
        $gruposafectados = null;
        $grupos = Grupo::where([['periodoacademico_id', $per], ['materia_codigomateria', $materia]])->get();
        if (count($grupos) > 0) {
            foreach ($grupos as $g) {
                if ($g->sistemaevalucion_id !== null) {
                    if ($g->sistemaevalucion_id == $sis) {
                        $g->materia;
                        $g->unidad;
                        $gruposafectados[] = $g;
                    }
                }
            }
        }
        $per = Periodoacademico::find($per);
        $mat = Materia::find($materia);
        $sist = Sistemaevalucion::find($sis);
        return view('academico.registro_academico.calificaciones.sistema_evaluacion.asignar_sistemaevaluacion.pormateriaver')
                        ->with('location', 'academico')
                        ->with('per', $per)
                        ->with('sis', $sist)
                        ->with('materia', $mat)
                        ->with('grupos', $gruposafectados);
    }

    /*
     * asignar sistema evaluacion por grupo
     */

    public function asignarmenuporgrupo($p) {
        $per = Periodoacademico::find($p);
        $ne = NivelEducativo::pluck('descripcion', 'id');
        $met = Metodologia::pluck('nombre', 'id');
        $sist = Sistemaevalucion::pluck('descripcion', 'id');
        return view('academico.registro_academico.calificaciones.sistema_evaluacion.asignar_sistemaevaluacion.porgrupo')
                        ->with('location', 'academico')
                        ->with('per', $per)
                        ->with('ne', $ne)
                        ->with('sist', $sist)
                        ->with('met', $met);
    }

    /*
     * lista los grupos de una materia para un periodo
     */

    public function getGrupos($per, $materia) {
        $gruposafectados = null;
        $grupos = Grupo::where([['periodoacademico_id', $per], ['materia_codigomateria', $materia]])->get();
        if (count($grupos) > 0) {
            foreach ($grupos as $g) {
                $gruposafectados[$g->id] = "GRUPO " . $g->nombre;
            }
            if ($gruposafectados !== null) {
                return json_encode($gruposafectados);
            } else {
                return "null";
            }
        } else {
            return "null";
        }
    }

    /*
     * obtiene los sistemas de evaluacion asignados a un grupo para un periodo determinado
     */

    public function getsistemasxg($grupo) {
        $sistemas = null;
        $grupo = Grupo::find($grupo);
        if ($grupo !== null) {
            $sistemas[$grupo->sistemaevalucion_id] = $grupo->sistemaevalucion->descripcion;
            return json_encode($sistemas);
        } else {
            return "null";
        }
    }

    /*
     * asigna el sistema de evaluacion al grupo indicado
     */

    public function sistemasasignarxg($per, $grupo, $sistema) {
        $grupo = Grupo::find($grupo);
        if ($grupo !== null) {
            $grupo->sistemaevalucion_id = $sistema;
            if ($grupo->save()) {
                flash("El Sistema de Evaluación fue asignado al grupo de forma exitosa.")->success();
                return redirect()->route('sistevalu.asignarmenuporgrupo', $per);
            } else {
                flash("El Sistema de Evaluación no pudo ser asignado al grupo.")->error();
                return redirect()->route('sistevalu.asignarmenuporgrupo', $per);
            }
        } else {
            flash("El Sistema de Evaluación no pudo ser asignado al grupo.")->error();
            return redirect()->route('sistevalu.asignarmenuporgrupo', $per);
        }
    }

    /*
     * obtiene las evaluaciones de un sistema
     */

    public function evaluaciones($sistema) {
        $s = Sistemaevalucion::find($sistema);
        if ($s !== null) {
            $ev = $s->evaluacionacademicos;
            if (count($ev) > 0) {
                $evaluaciones = null;
                foreach ($ev as $e) {
                    $evaluaciones[$e->id] = $e->descripcion . " " . $e->peso . "%";
                }
                return json_encode($evaluaciones);
            } else {
                return "null";
            }
        } else {
            return "null";
        }
    }

}
