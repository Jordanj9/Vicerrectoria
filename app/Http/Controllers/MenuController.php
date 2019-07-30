<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NivelEducativo;
use App\TipoUnidad;
use App\Programa;
use App\Periodoacademico;
use App\Materia;
use Illuminate\Support\Facades\Auth;
use App\Persona;
use App\Docenteacademico;
use App\Personanatural;
use App\Estudiante;

class MenuController extends Controller {

    /**
     * Show the view menu académico.
     *
     * @return \Illuminate\Http\Response
     */
    public function academico() {
        return view('menu.academico')->with('location', 'academico');
    }

    /**
     * Show the view menu tesorería
     *
     * @return \Illuminate\Http\Response
     */
    public function tesoreria() {
        return view('menu.tesoreria')->with('location', 'tesoreria');
    }

    /**
     * Show the view menu tesorería ->menu liquidaciones
     *
     * @return \Illuminate\Http\Response
     */
    public function liquidacionmenu() {
        return view('menu.liquidacionmenu')->with('location', 'tesoreria');
    }

    /**
     * Show the view menu tesorería ->menu liquidaciones pecuniarios
     *
     * @return \Illuminate\Http\Response
     */
    public function liquidacionpecuniarios() {
        return view('menu.liquidacionpecuniarios')->with('location', 'tesoreria');
    }

    /**
     * Show the view menu académico.menuUnidades.
     *
     * @return \Illuminate\Http\Response
     */
    public function unidades() {
        $tipos = TipoUnidad::all()->pluck('descripcion', 'id');
        return view('menu.unidades')
                        ->with('location', 'academico')
                        ->with('tipos', $tipos);
    }

    /**
     * Show the view menu académico.menuCargos.
     *
     * @return \Illuminate\Http\Response
     */
    public function cargos() {
        return view('menu.cargos')->with('location', 'academico');
    }

    /**
     * Show the view menu usuarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function usuarios() {
        return view('menu.usuarios')->with('location', 'usuarios');
    }

    /**
     * Show the view menu admisiones.
     *
     * @return \Illuminate\Http\Response
     */
    public function admisiones() {
        return view('menu.admisiones')->with('location', 'admisiones');
    }

    /**
     * Show the view menu inscribirse.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInscribirse() {
        $niveles = NivelEducativo::all()->pluck('descripcion', 'id');
        return view('menu.inscribirse')
                        ->with('location', 'admisiones')
                        ->with('niveles', $niveles);
    }

    /**
     * Show the view menu instituciones.
     *
     * @return \Illuminate\Http\Response
     */
    public function instituciones() {
        return view('menu.instituciones')
                        ->with('location', 'academico');
    }

    /**
     * Show the view menu calificaciones.
     *
     * @return \Illuminate\Http\Response
     */
    public function calificaciones() {
        return view('menu.calificaciones')
                        ->with('location', 'academico');
    }

    /**
     * Show the view menu fechas para inclusion de notas
     *
     * @return \Illuminate\Http\Response
     */
    public function fechas() {
        $per = Periodoacademico::all()->sortByDesc('anio');
        $periodos = null;
        foreach ($per as $p) {
            $periodos[$p->id] = $p->anio . " - " . $p->periodo . " ==> " . $p->tipoperiodo->descripcion;
        }
        return view('academico.registro_academico.calificaciones.fechas_notas.menu')
                        ->with('location', 'academico')
                        ->with('per', $periodos);
    }

    /**
     * Show the view menu sistemaevaluacion.
     *
     * @return \Illuminate\Http\Response
     */
    public function sistemaevaluacion() {
        return view('menu.sistema_evaluacion')
                        ->with('location', 'academico');
    }

    /**
     * Show the view menu ingresoespecial
     *
     * @return \Illuminate\Http\Response
     */
    public function ingresoespecial() {
        return view('menu.ingresoespecial')
                        ->with('location', 'academico');
    }

    /**
     * Show the view menu reglas
     *
     * @return \Illuminate\Http\Response
     */
    public function reglas() {
        return view('menu.reglas')
                        ->with('location', 'academico');
    }

    /**
     * Show the view menu programas.
     *
     * @return \Illuminate\Http\Response
     */
    public function programas($id) {
        $p = Programa::find($id);
        $p->modalidad->NivelEducativo;
        $p->metodologia;
        $p->jornada;
        return view('menu.programas')
                        ->with('location', 'academico')
                        ->with('p', $p);
    }

    /**
     * Show the view menu docentes.
     *
     * @return \Illuminate\Http\Response
     */
    public function docentes() {
        $tipos = TipoUnidad::all()->pluck('descripcion', 'id');
        return view('menu.docentes')
                        ->with('location', 'academico')
                        ->with('tipos', $tipos);
    }

    /**
     * Show the view menu asignarpape.
     *
     * @return \Illuminate\Http\Response
     */
    public function asignarpape() {
        return view('menu.asignarpape')->with('location', 'admisiones');
    }

    /**
     * Show the view menu matricula financiera.
     *
     * @return \Illuminate\Http\Response
     */
    public function matfinanciera() {
        return view('menu.matfinanciera')->with('location', 'academico');
    }

    /**
     * Show the view menu liquidaciones
     *
     * @return \Illuminate\Http\Response
     */
    public function basicoliquidaciones() {
        return view('menu.basicoliquidaciones')->with('location', 'tesoreria');
    }

    /**
     * Show the view menu demanda
     *
     * @return \Illuminate\Http\Response
     */
    public function demanda() {
        return view('menu.demanda')->with('location', 'academico');
    }

    /**
     * Show the view menu horarios
     *
     * @return \Illuminate\Http\Response
     */
    public function horario() {
        return view('menu.horario')->with('location', 'academico');
    }

    /**
     * Show the view menu horas
     *
     * @return \Illuminate\Http\Response
     */
    public function horas() {
        return view('menu.horas')->with('location', 'academico');
    }

    /**
     * Show the view menu matricula academica.
     *
     * @return \Illuminate\Http\Response
     */
    public function matacademica() {
        return view('menu.matacademica')->with('location', 'academico');
    }

    /**
     * Show the view menu matricula academica.
     *
     * @return \Illuminate\Http\Response
     */
    public function matacademicadb() {
        return view('menu.matacademicadb')->with('location', 'academico');
    }

    /**
     * Show the view menu sanciones
     *
     * @return \Illuminate\Http\Response
     */
    public function sanciones() {
        return view('menu.sanciones')->with('location', 'academico');
    }

    /**
     * Show the view menu sanciones
     *
     * @return \Illuminate\Http\Response
     */
    public function sancionesbasicos() {
        return view('menu.sancionesbasicos')->with('location', 'academico');
    }

    /**
     * Show the view menu estimulos
     *
     * @return \Illuminate\Http\Response
     */
    public function estimulos() {
        return view('menu.estimulos')->with('location', 'academico');
    }

    /**
     * Show the view menu grados
     *
     * @return \Illuminate\Http\Response
     */
    public function grados() {
        return view('menu.grados')->with('location', 'academico');
    }

    /**
     * Show the view menu jurados
     *
     * @return \Illuminate\Http\Response
     */
    public function jurados() {
        return view('menu.jurados')->with('location', 'academico');
    }

    /**
     * Show the view menu asesores
     *
     * @return \Illuminate\Http\Response
     */
    public function asesores() {
        return view('menu.asesores')->with('location', 'academico');
    }

    /**
     * Show the view menu practicaempresarial
     *
     * @return \Illuminate\Http\Response
     */
    public function practicaempresarial() {
        return view('menu.practicaempresarial')->with('location', 'academico');
    }

    /**
     * Show the view menu practicaempresarial basicos
     *
     * @return \Illuminate\Http\Response
     */
    public function practicaempresarialbasicos() {
        return view('menu.practicaempresarialbasico')->with('location', 'academico');
    }

    /**
     * Show the view menu reportes
     *
     * @return \Illuminate\Http\Response
     */
    public function reportes() {
        return view('menu.reportes')->with('location', 'reportes');
    }

    /**
     * Show the view menu reportes de liquidaciones
     *
     * @return \Illuminate\Http\Response
     */
    public function repliquidaciones() {
        return view('menu.repliquidaciones')->with('location', 'reportes');
    }

    /**
     * Show the view menu reportes de repproyectardemanda
     *
     * @return \Illuminate\Http\Response
     */
    public function repproyectardemanda() {
        return view('menu.repproyectardemanda')->with('location', 'reportes');
    }

    /**
     * Show the view menu reportes de repmatacademica
     *
     * @return \Illuminate\Http\Response
     */
    public function repmatacademica() {
        return view('menu.repmatacademica')->with('location', 'reportes');
    }

    /**
     * Show the view menu reportes de repcalificaciones
     *
     * @return \Illuminate\Http\Response
     */
    public function repcalificaciones() {
        return view('menu.repcalificaciones')->with('location', 'reportes');
    }

    /**
     * Show the view menu reportes de repsanciones
     *
     * @return \Illuminate\Http\Response
     */
    public function repsanciones() {
        return view('menu.repsanciones')->with('location', 'reportes');
    }

    /**
     * Show the view menu reportes de repestimulos
     *
     * @return \Illuminate\Http\Response
     */
    public function repestimulos() {
        return view('menu.repestimulos')->with('location', 'reportes');
    }

    /**
     * Show the view menu reportes de repgrados
     *
     * @return \Illuminate\Http\Response
     */
    public function repgrados() {
        return view('menu.repgrados')->with('location', 'reportes');
    }

    /**
     * Show the view menu reportes de repcargaadmin
     *
     * @return \Illuminate\Http\Response
     */
    public function repcargaadmin() {
        return view('menu.repcargaadmin')->with('location', 'reportes');
    }

    /**
     * Show the view menu reportes de repestructuracurricular
     *
     * @return \Illuminate\Http\Response
     */
    public function repestructuracurricular() {
        return view('menu.repestructuracurricular')->with('location', 'reportes');
    }

    /**
     * Show the view menu reportes de reprecursosfisicos
     *
     * @return \Illuminate\Http\Response
     */
    public function reprecursosfisicos() {
        return view('menu.reprecursosfisicos')->with('location', 'reportes');
    }

    /**
     * Show the view menu reportes de repdeudas
     *
     * @return \Illuminate\Http\Response
     */
    public function repdeudas() {
        return view('menu.repdeudas')->with('location', 'reportes');
    }

    /**
     * Show the view menu reportes de rephorarios
     *
     * @return \Illuminate\Http\Response
     */
    public function rephorarios() {
        return view('menu.rephorarios')->with('location', 'reportes');
    }

    /**
     * Show the view menu académico estudiante.
     *
     * @return \Illuminate\Http\Response
     */
    public function academicoestudiante() {
        $u = Auth::user();
        $p = Persona::where('numero_documento', $u->identificacion)->get();
        $si = false;
        if (count($p) > 0) {
            foreach ($p as $pe) {
                $pn = $pe->personanaturals;
                if (count($pn) > 0) {
                    foreach ($pn as $pni) {
                        $est = $pni->estudiantes;
                        if (count($est) > 0) {
                            $si = true;
                        }
                    }
                }
            }
        }
        if ($si) {
            return view('menu.academicoestudiante')->with('location', 'academico-estudiante');
        } else {
            flash("Usted no es un ESTUDIANTE válido. Contacte con el administrador del sistema si usted está seguro de ser un ESTUDIANTE.")->error();
            return redirect()->route('inicio');
        }
    }

    /**
     * Show the view menu matricula estudiante.
     *
     * @return \Illuminate\Http\Response
     */
    public function matricula() {
        $u = Auth::user();
        $p = Persona::where('numero_documento', $u->identificacion)->get();
        $si = false;
        if (count($p) > 0) {
            foreach ($p as $pe) {
                $pn = $pe->personanaturals;
                if (count($pn) > 0) {
                    foreach ($pn as $pni) {
                        $est = $pni->estudiantes;
                        if (count($est) > 0) {
                            $si = true;
                        }
                    }
                }
            }
        }
        if ($si) {
            return view('menu.matriculaestudiante')->with('location', 'matricula-estudiante');
        } else {
            flash("Usted no es un ESTUDIANTE válido. Contacte con el administrador del sistema si usted está seguro de ser un ESTUDIANTE.")->error();
            return redirect()->route('inicio');
        }
    }

    /**
     * Show the view menu financiera estudiante.
     *
     * @return \Illuminate\Http\Response
     */
    public function financiera() {
        $u = Auth::user();
        $p = Persona::where('numero_documento', $u->identificacion)->get();
        $si = false;
        if (count($p) > 0) {
            foreach ($p as $pe) {
                $pn = $pe->personanaturals;
                if (count($pn) > 0) {
                    foreach ($pn as $pni) {
                        $est = $pni->estudiantes;
                        if (count($est) > 0) {
                            $si = true;
                        }
                    }
                }
            }
        }
        if ($si) {
            return view('menu.financieraestudiante')->with('location', 'financiera-estudiante');
        } else {
            flash("Usted no es un ESTUDIANTE válido. Contacte con el administrador del sistema si usted está seguro de ser un ESTUDIANTE.")->error();
            return redirect()->route('inicio');
        }
    }

    /**
     * Show the view menu académico docente.
     *
     * @return \Illuminate\Http\Response
     */
    public function academicodocente() {
        $u = Auth::user();
        $p = Persona::where('numero_documento', $u->identificacion)->first();
        if ($p !== null) {
            $d = Docenteacademico::find($p->id);
            if ($d !== null) {
                $per = Periodoacademico::all()->sortByDesc('anio');
                $periodos = null;
                foreach ($per as $p) {
                    $periodos[$p->id] = $p->anio . " - " . $p->periodo . " ==> " . $p->tipoperiodo->descripcion;
                }
                return view('menu.academicodocente')
                                ->with('location', 'academico-docente')
                                ->with('per', $periodos);
            } else {
                flash("Usted no es un docente válido. Contacte con el administrador del sistema si usted esta seguro de ser un DOCENTE.")->error();
                return redirect()->route('inicio');
            }
        } else {
            flash("Usted no es una persona válida ni un docente válido. Contacte con el administrador del sistema si usted esta seguro de ser un DOCENTE.")->error();
            return redirect()->route('inicio');
        }
    }

    /**
     * Show the view menu matricula docente.
     *
     * @return \Illuminate\Http\Response
     */
    public function matriculadocente() {
        $u = Auth::user();
        $p = Persona::where('numero_documento', $u->identificacion)->first();
        if ($p !== null) {
            $d = Docenteacademico::find($p->id);
            if ($d !== null) {
                $per = Periodoacademico::all()->sortByDesc('anio');
                $periodos = null;
                foreach ($per as $p) {
                    $periodos[$p->id] = $p->anio . " - " . $p->periodo . " ==> " . $p->tipoperiodo->descripcion;
                }
                return view('menu.matriculadocente')
                                ->with('location', 'matricula-docente')
                                ->with('per', $periodos);
            } else {
                flash("Usted no es un docente válido. Contacte con el administrador del sistema si usted esta seguro de ser un DOCENTE.")->error();
                return redirect()->route('inicio');
            }
        } else {
            flash("Usted no es una persona válida ni un docente válido. Contacte con el administrador del sistema si usted esta seguro de ser un DOCENTE.")->error();
            return redirect()->route('inicio');
        }
    }

    /**
     * Show the view menu aula virtual admin
     *
     * @return \Illuminate\Http\Response
     */
    public function aulavirtual() {
        return view('menu.aulavirtual')->with('location', 'menu-aulavirtual');
    }

    /**
     * Show the view menu habilitarmenu admin
     *
     * @return \Illuminate\Http\Response
     */
    public function habilitarmenu() {
        return view('menu.habilitarmenu')->with('location', 'admisiones');
    }

    /**
     * Show the view menu aula virtual docente
     *
     * @return \Illuminate\Http\Response
     */
    public function aulavirtualdoc() {
        $u = Auth::user();
        $p = Persona::where('numero_documento', $u->identificacion)->first();
        if ($p !== null) {
            $d = Docenteacademico::find($p->id);
            if ($d !== null) {
                $pa = Periodoacademico::all()->sortByDesc('anio');
                $periodosf = null;
                if (count($pa) > 0) {
                    foreach ($pa as $value) {
                        $periodosf[$value->id] = $value->anio . " - " . $value->periodo;
                    }
                } else {
                    flash("No hay períodos académicos para realizar el proceso")->error();
                    return redirect()->route('inicio');
                }
                return view('menu.aulavirtualdoc')
                                ->with('location', 'menu-aulavirtual-doc')
                                ->with('pa', $periodosf);
            } else {
                flash("Usted no es un docente válido. Contacte con el administrador del sistema si usted esta seguro de ser un DOCENTE.")->error();
                return redirect()->route('inicio');
            }
        } else {
            flash("Usted no es una persona válida ni un docente válido. Contacte con el administrador del sistema si usted esta seguro de ser un DOCENTE.")->error();
            return redirect()->route('inicio');
        }
    }

    /**
     * Show the view menu aula virtual estudiante
     *
     * @return \Illuminate\Http\Response
     */
    public function aulavirtualest() {
        $u = Auth::user();
        $p = Persona::where('numero_documento', $u->identificacion)->get();
        $si = false;
        if (count($p) > 0) {
            foreach ($p as $pe) {
                $pn = $pe->personanaturals;
                if (count($pn) > 0) {
                    foreach ($pn as $pni) {
                        $est = $pni->estudiantes;
                        if (count($est) > 0) {
                            $si = true;
                        }
                    }
                }
            }
        }
        if ($si) {
            $pa = Periodoacademico::all()->sortByDesc('anio');
            $periodosf = null;
            if (count($pa) > 0) {
                foreach ($pa as $value) {
                    $periodosf[$value->id] = $value->anio . " - " . $value->periodo;
                }
            } else {
                flash("No hay períodos académicos para realizar el proceso")->error();
                return redirect()->route('inicio');
            }
            $est = $this->estudianteByIdentificacion();
            return view('menu.aulavirtualest')
                            ->with('location', 'aula-virtual-est')
                            ->with('pa', $periodosf)
                            ->with('est', $est);
        } else {
            flash("Usted no es un ESTUDIANTE válido. Contacte con el administrador del sistema si usted está seguro de ser un ESTUDIANTE.")->error();
            return redirect()->route('inicio');
        }
    }

    /**
     * get a estudiante to user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function estudianteByIdentificacion() {
        $u = Auth::user();
        $p = Persona::where('numero_documento', $u->identificacion)->get();
        $response = null;
        $response["error"] = "SI";
        $p1 = null;
        if (count($p) > 0) {
            foreach ($p as $value) {
                $pn = $value->personanaturals;
                if (count($pn) > 0) {
                    foreach ($pn as $item) {
                        $e = $item->estudiantes;
                        if (count($e) > 0) {
                            foreach ($e as $i) {
                                $ep = $i->estudiantepensums;
                                if (count($ep) > 0) {
                                    foreach ($ep as $estp) {
                                        //hacer estudiante con programa
                                        $p1[$i->id][] = $item->primer_nombre . " " . $item->segundo_nombre . " " . $item->primer_apellido . " " . $item->segundo_apellido . " - PROGRAMA: " . $estp->programaunidad->programa->nombre . " - ESTUDIANTE DESDE:" . $i->created_at;
                                    }
                                } else {
                                    //estudiante sin programa
                                    $p1[$i->id][] = $item->primer_nombre . " " . $item->segundo_nombre . " " . $item->primer_apellido . " " . $item->segundo_apellido . " - SIN PROGRAMA - ESTUDIANTE DESDE:" . $i->created_at;
                                }
                            }
                        } else {
                            return null;
                        }
                    }
                } else {
                    return null;
                }
            }
            if (count($p1) > 0) {
                return $p1;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    /**
     * Show the view menu materias admin
     *
     * @return \Illuminate\Http\Response
     */
    public function materias($id) {
        $m = Materia::find($id);
        $m->naturaleza;
        $m->unidad;
        $programas = Programa::all()->pluck('nombre', 'id');
        return view('menu.materias')
                        ->with('location', 'academico')
                        ->with('programas', $programas)
                        ->with('m', $m);
    }

    /**
     * Show the view fecha limite de pago
     *
     * @return \Illuminate\Http\Response
     */
    public function fechalimitepago() {
        return view('tesoreria.liquidaciones.fecha_limite_pago.list')
                        ->with('location', 'tesoreria');
    }

    /**
     * Show the view reservamenu
     *
     * @return \Illuminate\Http\Response
     */
    public function reservamenu() {
        return view('menu.reservarecurso')
                        ->with('location', 'reserva-recurso');
    }

    /**
     * Show the view menu de gestion de recursos para reserva
     *
     * @return \Illuminate\Http\Response
     */
    public function menurecursos() {
        return view('menu.menurecursos')->with('location', 'reserva-recurso');
    }

    /**
     * Show the view reservamenu
     *
     * @return \Illuminate\Http\Response
     */
    public function menumantenimiento() {
        return view('menu.menumantenimiento')
                        ->with('location', 'reserva-recurso');
    }

    /**
     * Show the view reservamenu
     *
     * @return \Illuminate\Http\Response
     */
    public function menugestionreserva() {
        return view('menu.menugestionreserva')
                        ->with('location', 'reserva-recurso');
    }

    /**
     * Show the view represerva
     *
     * @return \Illuminate\Http\Response
     */
    public function represerva() {
        return view('menu.represerva')
                        ->with('location', 'reserva-recurso');
    }
    
     /**
     * Show the view evaluacionautohetero
     *
     * @return \Illuminate\Http\Response
     */
    public function evaluacionautohetero() {
        return view('menu.evaluacionautohetero')
                        ->with('location', 'menu-evaluacion-auto-hetero');
    }

}
