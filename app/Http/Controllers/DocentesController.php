<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documentovinculacion;
use App\Cargo;
use App\Dedicaciondocente;
use App\Clasificaciondocente;
use App\Unidad;
use App\Persona;
use App\Trabajador;
use App\Trabajadorlabor;
use App\Trabajadorlaborunidad;
use App\Docenteacademico;
use App\Facultad;
use App\Docenteunidad;
use App\Situacionadmin;
use App\Personanatural;
use App\Histrabajadorlabor;
use App\Programaunidad;
use App\Docentemateriaunidad;
use App\Docentegrupo;

class DocentesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $docentes = Docenteacademico::all();
        if (count($docentes) > 0) {
            foreach ($docentes as $item) {
                $p = $item->personanatural;
                $item->name = $p->primer_nombre . " " . $p->segundo_nombre . " " . $p->primer_apellido . " " . $p->segundo_apellido;
                $item->tipo = $item->personanatural->persona->tipodoc->abreviatura;
                $item->documento = $item->personanatural->persona->numero_documento;
                $item->genero = $p->sexo;
                $item->labor = $item->cargo->nombre;
                $item->depto = $item->personanatural->departamento->nombre;
                $item->fac = $item->personanatural->departamento->facultad->nombre;
            }
        }
        return view('academico.recursos_academicos.carga_administrativa.docentes.list')
                        ->with('location', 'academico')
                        ->with('docentes', $docentes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $facultades = Facultad::all()->pluck('nombre', 'id');
        $cargos = Cargo::all()->pluck('nombre', 'id');
        return view('academico.recursos_academicos.carga_administrativa.docentes.create')
                        ->with('location', 'academico')
                        ->with('facultades', $facultades)
                        ->with('cargos', $cargos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $pn = Personanatural::find($request->personanatural_id);
        if ($pn !== null) {
            $p = $pn->persona;
            $da = new Docenteacademico();
            $da->pege = $p->id;
            $da->codigo = $request->codigo;
            $da->cargo_id = $request->cargo_id;
            $da->personanatural_id = $pn->id;
            if ($da->save()) {
                flash("El docente ha sido creado de forma exitosa!")->success();
                return redirect()->route('docentes.index');
            } else {
                flash("El docente no pudo ser creado")->error();
                return redirect()->route('docentes.index');
            }
        } else {
            flash("Persona Invalida o Inexistente!")->error();
            return redirect()->route('docentes.create');
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
        $docente = Docenteacademico::find($id);
        $result = $docente->delete();
        if ($result) {
            flash("El docente fue eliminado de forma exitosa!")->success();
            return redirect()->route('docentes.index');
        } else {
            flash("El docente no pudo ser eliminado")->error();
            return redirect()->route('docentes.index');
        }
    }

    /**
     * Show the view for more options of docente
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function more() {
        $doc_id = $_POST["docente_id"];
        $und_id = $_POST["unidad_id"];
        if ($doc_id === '0') {
            flash("No ha seleccionado docente, <strong>no puede continuar!</strong>")->warning();
            return redirect()->route('admin.docentes');
        } else {
            $unidad = Unidad::find($und_id);
            $unidad->TipoUnidad;
            $unidad->ciudad;
            $doc = Personanatural::where('persona_id', $doc_id)->first();
            if (count($doc) > 0) {
                $doc->persona->tipodoc;
            }
            return view('academico.recursos_academicos.carga_administrativa.docentes.procesos.more')
                            ->with('location', 'academico')
                            ->with('unidad', $unidad)
                            ->with('doc', $doc);
        }
    }

    /**
     * Show the view for more options of docente
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function situacion($id) {
        $doc = Personanatural::where('persona_id', $id)->first();
        $doc->persona->tipodoc;
        $vinculaciones = Trabajadorlabor::where([['trabajador_pege', '=', $id], ['dedicaciondocente_id', '<>', null], ['clasificaciondocente_id', '<>', null]])->get();
        foreach ($vinculaciones as $value) {
            $value->dedicaciondocente;
            $value->documentovinculacion->norma;
        }
        return view('academico.recursos_academicos.carga_administrativa.docentes.procesos.situacion')
                        ->with('location', 'academico')
                        ->with('doc', $doc)
                        ->with('vinculaciones', $vinculaciones)
                        ->with('sss', "NO");
    }

    /**
     * Show the view for more options of docente
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function situaciones($id) {
        $t = Trabajadorlabor::find($id);
        $doc = Personanatural::where('persona_id', $t->trabajador_pege)->first();
        $doc->persona->tipodoc;
        $vinculaciones = Trabajadorlabor::where([['trabajador_pege', '=', $t->trabajador_pege], ['dedicaciondocente_id', '<>', null], ['clasificaciondocente_id', '<>', null]])->get();
        foreach ($vinculaciones as $value) {
            $value->dedicaciondocente;
            $value->documentovinculacion->norma;
        }
        $t->situacionadmin;
        $st = Situacionadmin::all()->pluck('descripcion', 'id');
        $situaciones = Histrabajadorlabor::where([['trabajador_pege', $t->trabajador_pege], ['documentovinculacion_id', $t->documentovinculacion_id], ['cargo_id', $t->cargo_id]])->get();
        $situaciones->each(function($s) {
            $s->situacionadmin;
        });
        return view('academico.recursos_academicos.carga_administrativa.docentes.procesos.situacion')
                        ->with('location', 'academico')
                        ->with('doc', $doc)
                        ->with('vinculaciones', $vinculaciones)
                        ->with('sss', "SI")
                        ->with('estados', $situaciones)
                        ->with('st', $st)
                        ->with('t', $t);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setst(Request $request) {
        $t = Trabajadorlabor::where([['trabajador_pege', $request->trabajador_pege], ['documentovinculacion_id', $request->documentovinculacion_id]])->first();
        $h = new Histrabajadorlabor();
        $h->fechainicioestado = $t->fechainicioestado;
        $now = new \DateTime();
        $h->fechafinestado = $now->format('y-m-d');
        $h->situacionadmin_id = $t->situacionadmin_id;
        $h->trabajador_pege = $t->trabajador_pege;
        $h->cargo_id = $t->cargo_id;
        $h->documentovinculacion_id = $t->documentovinculacion_id;
        $h->fechainicial = $t->fechainicial;
        $h->fechafinal = $t->fechafinal;
        $t->situacionadmin_id = $request->estado;
        $t->fechainicioestado = $request->fechainicial;
        $result = $t->save();
        if ($result) {
            $h->save();
            flash("<strong>La situación administrativa del docente </strong> fue modificada de forma exitosa!")->success();
            return redirect()->route('docentes.situaciones', $t->id);
        } else {
            flash("<strong>La situación administrativa del docente</strong> no pudo ser modificada.")->error();
            return redirect()->route('docentes.situaciones', $t->id);
        }
    }

    /**
     * Show the view for more options of docente
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function materias($id) {
        $doc = Personanatural::where('persona_id', $id)->first();
        $doc->persona->tipodoc;
        $vinculaciones = Trabajadorlabor::where([['trabajador_pege', '=', $id], ['dedicaciondocente_id', '<>', null], ['clasificaciondocente_id', '<>', null]])->get();
        foreach ($vinculaciones as $value) {
            $value->dedicaciondocente;
            $value->documentovinculacion->norma;
        }
        return view('academico.recursos_academicos.carga_administrativa.docentes.procesos.materias')
                        ->with('location', 'academico')
                        ->with('doc', $doc)
                        ->with('vinculaciones', $vinculaciones)
                        ->with('sss', "NO")
                        ->with('dd', 'NO');
    }

    /**
     * Show the view for more options of docente
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function materiasund($id) {
        $t = Trabajadorlabor::find($id);
        $doc = Personanatural::where('persona_id', $t->trabajador_pege)->first();
        $doc->persona->tipodoc;
        $vinculaciones = Trabajadorlabor::where([['trabajador_pege', '=', $t->trabajador_pege], ['dedicaciondocente_id', '<>', null], ['clasificaciondocente_id', '<>', null]])->get();
        foreach ($vinculaciones as $value) {
            $value->dedicaciondocente;
            $value->documentovinculacion->norma;
        }
        $du = Docenteunidad::where('docenteacademico_pege', $t->trabajador_pege)->get();
        $du->each(function($item) {
            $item->unidad->ciudad;
        });
        $unda = Programaunidad::where('relacion', 'A')->orderBy('unidad_id')->get();
        $undafinal = null;
        $actual = null;
        foreach ($unda as $value) {
            if ($actual === null) {
                $actual = $value->unidad_id;
                $undafinal[] = $value;
            }
            if ($actual !== $value->unidad_id) {
                $actual = $value->unidad_id;
                $undafinal[] = $value;
            }
        }
        $undafinal2 = null;
        foreach ($undafinal as $value) {
            $undafinal2[] = $value->unidad;
        }
        $undafinal2 = collect($undafinal2);
        $undafinal2 = $undafinal2->pluck('nombre', 'id');
        $undsa = null;
        foreach ($du as $value) {
            if ($this->existe($undafinal2, $value)) {
                $undsa[] = $value;
            }
        }
        return view('academico.recursos_academicos.carga_administrativa.docentes.procesos.materias')
                        ->with('location', 'academico')
                        ->with('doc', $doc)
                        ->with('vinculaciones', $vinculaciones)
                        ->with('sss', "SI")
                        ->with('dd', 'NO')
                        ->with('t', $t)
                        ->with('undsa', $undsa)
                        ->with('id', $id);
    }

    /**
     * Show the view for more options of docente
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function materiasundmat($id, $id_du) {
        $t = Trabajadorlabor::find($id);
        $doc = Personanatural::where('persona_id', $t->trabajador_pege)->first();
        $doc->persona->tipodoc;
        $vinculaciones = Trabajadorlabor::where([['trabajador_pege', '=', $t->trabajador_pege], ['dedicaciondocente_id', '<>', null], ['clasificaciondocente_id', '<>', null]])->get();
        foreach ($vinculaciones as $value) {
            $value->dedicaciondocente;
            $value->documentovinculacion->norma;
        }
        $du = Docenteunidad::where('docenteacademico_pege', $t->trabajador_pege)->get();
        $du->each(function($item) {
            $item->unidad->ciudad;
        });
        $unda = Programaunidad::where('relacion', 'A')->orderBy('unidad_id')->get();
        $undafinal = null;
        $actual = null;
        foreach ($unda as $value) {
            if ($actual === null) {
                $actual = $value->unidad_id;
                $undafinal[] = $value;
            }
            if ($actual !== $value->unidad_id) {
                $actual = $value->unidad_id;
                $undafinal[] = $value;
            }
        }
        $undafinal2 = null;
        foreach ($undafinal as $value) {
            $undafinal2[] = $value->unidad;
        }
        $undafinal2 = collect($undafinal2);
        $undafinal2 = $undafinal2->pluck('nombre', 'id');
        $undsa = null;
        foreach ($du as $value) {
            if ($this->existe($undafinal2, $value)) {
                $undsa[] = $value;
            }
        }
        $materiasdu = Docentemateriaunidad::where('docenteunidad_id', $id_du)->get();
        $materiasdu->each(function($m) {
            $m->materia;
        });
        return view('academico.recursos_academicos.carga_administrativa.docentes.procesos.materias')
                        ->with('location', 'academico')
                        ->with('doc', $doc)
                        ->with('vinculaciones', $vinculaciones)
                        ->with('sss', "SI")
                        ->with('dd', 'SI')
                        ->with('t', $t)
                        ->with('undsa', $undsa)
                        ->with('id', $id)
                        ->with('materias', $materiasdu)
                        ->with('du', $id_du);
    }

    public function existe($coleccion, $consulta) {
        foreach ($coleccion as $key => $value) {
            if ($key === $consulta->unidad_id) {
                return true;
            }
        }
        return false;
    }

    /*
     * obtiene todos los docentes que están dando clase en un período...
     */

    public function getDocentesPeriodo($p) {
        $doc = Docentegrupo::all();
        $response = [
            'error' => 'NO',
            'data' => null,
            'mensaje' => 'OK'
        ];
        if (count($doc) > 0) {
            $data = null;
            foreach ($doc as $d) {
                $g = $d->grupo;
                if ($g->periodoacademico_id == $p) {
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

}
