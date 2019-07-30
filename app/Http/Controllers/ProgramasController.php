<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Programa;
use App\Http\Requests\ProgramaRequest;
use App\Modalidad;
use App\Metodologia;
use App\Jornada;
use App\NivelEducativo;
use App\TipoPeriodo;
use App\Norma;
use Illuminate\Support\Facades\DB;
use App\Programaunidad;
use App\TipoUnidad;
use App\Tipocubrimientosnies;
use App\Justificacionsnie;
use App\Tipoacreditacionp;
use App\Itemfundamentacionp;
use App\Ciclocurricular;
use App\Revisionprogramasnie;
use App\Areaconocimientosnie;
use App\Nbcsnie;
use App\Periodoprogunidad;
use App\Servicioprograma;
use App\Servicioperiodo;
use App\Programacionprocacademico;

class ProgramasController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $programas = Programa::all();
        $programas->each(function ($programas) {
            $programas->modalidad;
            $programas->metodologia;
            $programas->jornada;
        });
        return view('academico.recursos_academicos.estructura_curricular.programas.programas.list')
                        ->with('location', 'academico')
                        ->with('programas', $programas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $metodologia = Metodologia::all()->pluck('nombre', 'id');
        $niveles = NivelEducativo::all()->pluck('descripcion', 'id');
        $jornada = Jornada::all()->pluck('descripcion', 'id');
        $tipos = TipoPeriodo::all()->pluck('descripcion', 'id');
        $normas = Norma::all()->pluck('descripcion', 'id');
        return view('academico.recursos_academicos.estructura_curricular.programas.programas.create')
                        ->with('location', 'academico')
                        ->with('metodologias', $metodologia)
                        ->with('niveles', $niveles)
                        ->with('jornadas', $jornada)
                        ->with('tipos', $tipos)
                        ->with('normas', $normas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgramaRequest $request) {
        $programa = new Programa($request->all());
        foreach ($programa->attributesToArray() as $key => $value) {
            $programa->$key = strtoupper($value);
        }
        $result = $programa->save();
        if ($result) {
            flash("Programa <strong>" . $programa->nombre . "</strong> almacenado de forma exitosa!")->success();
            return redirect()->route('programas.index');
        } else {
            flash("El Programa <strong>" . $programa->nombre . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('programas.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $programa = Programa::find($id);
        $programa->metodologia;
        $programa->jornada;
        $programa->modalidad;
        $programa->tipo_periodo;
        $programa->norma;
        return view('academico.recursos_academicos.estructura_curricular.programas.programas.show')
                        ->with('location', 'academico')
                        ->with('programa', $programa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $programa = Programa::find($id);
        $programa->metodologia;
        $programa->jornada;
        $programa->modalidad;
        $metodologia = Metodologia::all()->pluck('nombre', 'id');
        $modalidad = Modalidad::all()->pluck('descripcion', 'id');
        $jornada = Jornada::all()->pluck('descripcion', 'id');
        $tipos = TipoPeriodo::all()->pluck('descripcion', 'id');
        $normas = Norma::all()->pluck('descripcion', 'id');
        return view('academico.recursos_academicos.estructura_curricular.programas.programas.edit')
                        ->with('location', 'academico')
                        ->with('programa', $programa)
                        ->with('metodologias', $metodologia)
                        ->with('modalidades', $modalidad)
                        ->with('jornadas', $jornada)
                        ->with('tipos', $tipos)
                        ->with('normas', $normas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $programa = Programa::find($id);
        foreach ($programa->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $programa->$key = strtoupper($request->$key);
            }
        }
        $result = $programa->save();
        if ($result) {
            flash("Programa <strong>" . $programa->nombre . "</strong> modificado de forma exitosa!")->success();
            return redirect()->route('programas.index');
        } else {
            flash("El Programa <strong>" . $programa->nombre . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('programas.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $programa = Programa::find($id);
        if (count($programa->pensums) > 0) {
            flash("El Programa <strong>" . $programa->nombre . "</strong> no pudo ser eliminado porque tiene pensums asociados.")->warning();
            return redirect()->route('programas.index');
        } else {
            $result = $programa->delete();
            if ($result) {
                flash("Programa <strong>" . $programa->nombre . "</strong> eliminado de forma exitosa!")->success();
                return redirect()->route('programas.index');
            } else {
                flash("El Programa <strong>" . $programa->nombre . "</strong> no pudo ser eliminado. Error: " . $result)->error();
                return redirect()->route('programas.index');
            }
        }
    }

    /**
     * get the pensums from a programa.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pensums($id) {
        $programa = Programa::find($id);
        $pensums = $programa->pensums;
        $array = null;
        foreach ($pensums as $value) {
            $obj["id"] = $value->id;
            $obj["value"] = $value->descripcion . " ==> " . $value->estadopensum->descripcion;
            $array[] = $obj;
        }
        return json_encode($array);
    }

    /**
     * get the pensums from a programa.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pensums2($id) {
        $pu = Programaunidad::find($id);
        $programa = Programa::find($pu->programa_id);
        $pensums = $programa->pensums;
        $array = null;
        foreach ($pensums as $value) {
            $obj["id"] = $value->id;
            $obj["value"] = $value->descripcion . " ==> " . $value->estadopensum->descripcion;
            $array[] = $obj;
        }
        return json_encode($array);
    }

    /**
     * show the view programa-unidad
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unidad($id) {
        $p = Programa::find($id);
        $p->modalidad->NivelEducativo;
        $p->metodologia;
        $p->jornada;
        $tipos = TipoUnidad::all()->pluck('descripcion', 'id');
        $r = Programaunidad::where('programa_id', $id)->get();
        $r->each(function($item) {
            $item->unidad->ciudad;
            $item->cubrimientoprogramas;
            $v = DB::select('SELECT (SELECT descripcion FROM tipocubrimientosnies WHERE tipocubrimientosnies.codigo=`tipocubrimientosnie_codigo`) as cubr, (SELECT nombre FROM metodologias WHERE id=`metodologia_id`) as met FROM `cubrimientoprogramas` WHERE programaunidad_id=?', [$item->id]);
            if (count($v) > 0) {
                $item->cub = $v[0]->cubr . " - " . $v[0]->met;
            }
        });
        $tc = Tipocubrimientosnies::all()->pluck('descripcion', 'codigo');
        $met = Metodologia::where('estado', 'ACTIVA')->get()->pluck('nombre', 'id');
        return view('academico.recursos_academicos.estructura_curricular.programas.unidad.list')
                        ->with('location', 'academico')
                        ->with('p', $p)
                        ->with('r', $r)
                        ->with('tipos', $tipos)
                        ->with('tc', $tc)
                        ->with('met', $met)
                        ->with('modo', 'CREACION');
    }

    /**
     * show the view programa-titulo
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function titulo($id) {
        $p = Programa::find($id);
        $p->modalidad->NivelEducativo;
        $p->metodologia;
        $p->jornada;
        $titulos = $p->tituloprogramas;
        $titulos->each(function($item) {
            $item->titulop;
        });
        $niveles = NivelEducativo::all()->pluck('descripcion', 'id');
        $normas = Norma::all()->pluck('descripcion', 'id');
        return view('academico.recursos_academicos.estructura_curricular.programas.titulo.list')
                        ->with('location', 'academico')
                        ->with('p', $p)
                        ->with('titulos', $titulos)
                        ->with('niveles', $niveles)
                        ->with('normas', $normas);
    }

    /**
     * show the view programa-cambio nombre
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cambionombre($id) {
        $p = Programa::find($id);
        $p->modalidad->NivelEducativo;
        $p->metodologia;
        $p->jornada;
        $nombres = $p->cambionombreprogs;
        $nombres->each(function($item) {
            $item->norma;
        });
        $niveles = NivelEducativo::all()->pluck('descripcion', 'id');
        $normas = Norma::all()->pluck('descripcion', 'id');
        return view('academico.recursos_academicos.estructura_curricular.programas.nombre.list')
                        ->with('location', 'academico')
                        ->with('p', $p)
                        ->with('nombres', $nombres)
                        ->with('niveles', $niveles)
                        ->with('normas', $normas);
    }

    /**
     * show the view programa-cambio estado
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cambioestado($id) {
        $p = Programa::find($id);
        $p->modalidad->NivelEducativo;
        $p->metodologia;
        $p->jornada;
        $estados = $p->cambioestadoprogs;
        $estados->each(function($item) {
            $item->norma;
            $item->justificacionsnie;
        });
        $estadossnies = Justificacionsnie::all()->pluck('descripcion', 'id');
        $normas = Norma::all()->pluck('descripcion', 'id');
        return view('academico.recursos_academicos.estructura_curricular.programas.estado.list')
                        ->with('location', 'academico')
                        ->with('p', $p)
                        ->with('estados', $estados)
                        ->with('estadossnies', $estadossnies)
                        ->with('normas', $normas);
    }

    /**
     * show the view programa-cambio tipo periodo academico
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cambiotpa($id) {
        $p = Programa::find($id);
        $p->modalidad->NivelEducativo;
        $p->metodologia;
        $p->jornada;
        $tipos = $p->cambiotpaprogs;
        $tipos->each(function($item) {
            $item->norma;
            $item->tipo_periodo;
        });
        $tiposp = TipoPeriodo::all()->pluck('descripcion', 'id');
        $normas = Norma::all()->pluck('descripcion', 'id');
        return view('academico.recursos_academicos.estructura_curricular.programas.cambiotpa.list')
                        ->with('location', 'academico')
                        ->with('p', $p)
                        ->with('tipos', $tipos)
                        ->with('tiposp', $tiposp)
                        ->with('normas', $normas);
    }

    /**
     * show the view programa-renovacion
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function renovacion($id) {
        $p = Programa::find($id);
        $p->modalidad->NivelEducativo;
        $p->metodologia;
        $p->jornada;
        $renovacions = $p->renovacionprogs;
        $renovacions->each(function($item) {
            $item->norma;
        });
        $normas = Norma::all()->pluck('descripcion', 'id');
        return view('academico.recursos_academicos.estructura_curricular.programas.renovacion.list')
                        ->with('location', 'academico')
                        ->with('p', $p)
                        ->with('renovacions', $renovacions)
                        ->with('modo', "CREACION")
                        ->with('normas', $normas);
    }

    /**
     * show the view programa-acreditacion
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function acreditacion($id) {
        $p = Programa::find($id);
        $p->modalidad->NivelEducativo;
        $p->metodologia;
        $p->jornada;
        $acreditacions = $p->acreditacionprogs;
        $acreditacions->each(function($item) {
            $item->norma;
            $item->tipoacreditacionp;
        });
        $tipos = Tipoacreditacionp::all()->pluck('descripcion', 'id');
        $normas = Norma::all()->pluck('descripcion', 'id');
        return view('academico.recursos_academicos.estructura_curricular.programas.acreditacion.list')
                        ->with('location', 'academico')
                        ->with('p', $p)
                        ->with('acreditacions', $acreditacions)
                        ->with('modo', "CREACION")
                        ->with('normas', $normas)
                        ->with('tipos', $tipos);
    }

    /**
     * show the view programa-aspectos
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function aspectos($id) {
        $p = Programa::find($id);
        $p->modalidad->NivelEducativo;
        $p->metodologia;
        $p->jornada;
        $aspectos = $p->aspectosprogramas;
        $aspectos->each(function($item) {
            $item->itemfundamentacionp;
        });
        $items = Itemfundamentacionp::all()->pluck('descripcion', 'id');
        return view('academico.recursos_academicos.estructura_curricular.programas.aspectos.list')
                        ->with('location', 'academico')
                        ->with('p', $p)
                        ->with('aspectos', $aspectos)
                        ->with('modo', "CREACION")
                        ->with('items', $items);
    }

    /**
     * show the view programa-ciclos
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ciclos($id) {
        $p = Programa::find($id);
        $p->modalidad->NivelEducativo;
        $p->metodologia;
        $p->jornada;
        $ciclos = $p->cicloprogramas;
        $ciclos->each(function($item) {
            $item->ciclocurricular;
        });
        $cl = Ciclocurricular::all()->pluck('descripcion', 'id');
        return view('academico.recursos_academicos.estructura_curricular.programas.ciclos.list')
                        ->with('location', 'academico')
                        ->with('p', $p)
                        ->with('ciclos', $ciclos)
                        ->with('cl', $cl);
    }

    /**
     * show the view programa-revisiones snies
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function revision($id) {
        $p = Programa::find($id);
        $p->modalidad->NivelEducativo;
        $p->metodologia;
        $p->jornada;
        $revisiones = $p->revisionprogramas;
        $revisiones->each(function($item) {
            $item->revisionprogramasnie;
        });
        $cl = Revisionprogramasnie::all()->pluck('descripcion', 'id');
        return view('academico.recursos_academicos.estructura_curricular.programas.revision.list')
                        ->with('location', 'academico')
                        ->with('p', $p)
                        ->with('revisiones', $revisiones)
                        ->with('r', $cl);
    }

    /**
     * show the view programa-nbc snies
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function nbc($id) {
        $p = Programa::find($id);
        $p->modalidad->NivelEducativo;
        $p->metodologia;
        $p->jornada;
        $nbcs = $p->nbcprogramasnies;
        $nbcs->each(function($item) {
            $item->nbcsnie->areaconocimientosnie;
            $n = Nbcsnie::find($item->nbcsnie2_id);
            $n->areaconocimientosnie;
            $item->nbc2 = $n;
        });
        $cl = Areaconocimientosnie::all()->pluck('descripcion', 'id');
        return view('academico.recursos_academicos.estructura_curricular.programas.nbc.list')
                        ->with('location', 'academico')
                        ->with('p', $p)
                        ->with('nbcs', $nbcs)
                        ->with('r', $cl);
    }

    /**
     * get the programas from a parameters
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function programas($id_me, $id_mo, $unidad, $pa) {
        $ppu = Periodoprogunidad::where([['unidad_id', $unidad], ['periodoacademico_id', $pa]])->get();
        $ppu->each(function($item) {
            $item->programaunidad;
        });
        $pu = Programaunidad::where('unidad_id', $unidad)->orderBy('programa_id')->get();
        $pu->each(function($item) {
            $item->programa;
        });
        $programas = null;
        foreach ($pu as $value) {
            if ($value->programa->metodologia_id == $id_me && $value->programa->modalidad_id == $id_mo && $this->existe($ppu, $value->programa) == false) {
                $p = $value->programa;
                $p->programaunidad_id = $value->id;
                $programas[] = $p;
            }
        }
        $actual = null;
        $temp = null;
        if ($programas != null) {
            foreach ($programas as $value) {
                if ($actual === null) {
                    $actual = $value->id;
                    $temp[] = $value;
                }
                if ($actual !== $value->id) {
                    $actual = $value->id;
                    $temp[] = $value;
                }
            }
            $array["error"] = "NO";
            if (count($temp) > 0) {
                foreach ($temp as $value) {
                    $value->jornada;
                }
                $arr = null;
                foreach ($temp as $value) {
                    $obj["id"] = $value->id;
                    $obj["nombre"] = $value->nombre;
                    $obj["jornada"] = $value->jornada->descripcion;
                    $obj["estado"] = $value->estado;
                    $obj["programaunidad_id"] = $value->programaunidad_id;
                    $arr[] = $obj;
                }
                $array["data"] = $arr;
            } else {
                $array["error"] = "SI";
            }
        } else {
            $array["error"] = "SI";
        }
        return json_encode($array);
    }

    /**
     * get the programas from a parameters
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function programas2($id_me, $id_mo, $unidad) {
        $pu = Programaunidad::where('unidad_id', $unidad)->orderBy('programa_id')->get();
        $pu->each(function($item) {
            $item->programa;
        });
        $programas = null;
        foreach ($pu as $value) {
            if ($value->programa->metodologia_id == $id_me && $value->programa->modalidad_id == $id_mo) {
                $pr = $value->programa;
                $p = $pr;
                $p->pensums = $pr->pensums;
                $p->programaunidad_id = $value->id;
                if (count($p->pensums) > 0) {
                    foreach ($p->pensums as $pe) {
                        $pe->estadopensum;
                    }
                }
                $programas[] = $p;
            }
        }
        return json_encode($programas);
    }

    public function existe($coleccion, $p) {
        foreach ($coleccion as $value) {
            if ($value->programaunidad->programa_id == $p->id) {
                return true;
            }
        }
        return false;
    }

    public function existe2($coleccion, $p) {
        if (count($coleccion) > 0) {
            foreach ($coleccion as $value) {
                if ($value->id == $p->id) {
                    return true;
                }
            }
        } else {
            return false;
        }
        return false;
    }

    public function existe3($coleccion, $p, $pa) {
        foreach ($coleccion as $value) {
            if ($value->periodoprogunidad->programaunidad->programa_id == $p->id && $value->periodoprogunidad->periodoacademico_id == $pa) {
                return true;
            }
        }
        return false;
    }

    /**
     * get the programas from a parameters
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function programasp($id_me, $id_mo, $unidad, $pa) {
        $ppu = Periodoprogunidad::where([['unidad_id', $unidad], ['periodoacademico_id', $pa]])->get();
        $ppu->each(function($item) {
            $item->programaunidad->programa;
        });
        $p = Servicioprograma::all();
        $p->each(function($item) {
            $item->servicioperiodo->periodoacademico;
        });
        $sp = $p->filter(function($value, $key) use ($pa) {
            if ($value->servicioperiodo->periodoacademico->id == $pa) {
                return true;
            }
        });
        $programas1 = null;
        $band = TRUE;
        if (count($sp) > 0) {
            foreach ($sp as $value) {
                $pt = $value->periodoprogunidad->programaunidad->programa;
                if ($pt->metodologia_id == $id_me && $pt->modalidad_id == $id_mo) {
                    $programas1[] = $pt;
                }
            }
        } else {
            $band = FALSE;
        }
        $programas = null;
        foreach ($ppu as $value) {
            if ($band) {
                if ($value->programaunidad->programa->metodologia_id == $id_me && $value->programaunidad->programa->modalidad_id == $id_mo && $this->existe2($programas1, $value->programaunidad->programa) == false) {
                    $p = $value->programaunidad->programa;
                    $p->periodoprogunidad_id = $value->id;
                    $programas[] = $p;
                }
            } else {
                if ($value->programaunidad->programa->metodologia_id == $id_me && $value->programaunidad->programa->modalidad_id == $id_mo) {
                    $p = $value->programaunidad->programa;
                    $p->periodoprogunidad_id = $value->id;
                    $programas[] = $p;
                }
            }
        }
        $actual = null;
        $temp = null;
        if ($programas != null) {
            foreach ($programas as $value) {
                if ($actual === null) {
                    $actual = $value->id;
                    $temp[] = $value;
                }
                if ($actual !== $value->id) {
                    $actual = $value->id;
                    $temp[] = $value;
                }
            }
            $array["error"] = "NO";
            if (count($temp) > 0) {
                foreach ($temp as $value) {
                    $value->jornada;
                }
                $arr = null;
                foreach ($temp as $value) {
                    $obj["id"] = $value->id;
                    $obj["nombre"] = $value->nombre;
                    $obj["jornada"] = $value->jornada->descripcion;
                    $obj["estado"] = $value->estado;
                    $obj["periodoprogunidad_id"] = $value->periodoprogunidad_id;
                    $obj['pund_id'] = $value->periodoprogunidad->programaunidad_id;
                    $arr[] = $obj;
                }
                $array["data"] = $arr;
            } else {
                $array["error"] = "SI";
            }
        } else {
            $array["error"] = "SI";
        }
        return json_encode($array);
    }

    /**
     * get the programas from a parameters
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function programaspa($id_me, $id_mo, $unidad, $serp) {
        $spe = Servicioperiodo::find($serp);
        $ppu = Periodoprogunidad::where([['unidad_id', $unidad], ['periodoacademico_id', $spe->periodoacademico_id]])->get();
        $ppu->each(function($item) {
            $item->programaunidad->programa;
        });
        $p = Servicioprograma::all();
        $p->each(function($item) {
            $item->servicioperiodo->periodoacademico;
        });
        $sp = $p->filter(function($value, $key) use ($serp) {
            if ($value->servicioperiodo_id == $serp) {
                return true;
            }
        });
        $programas1 = null;
        $band = TRUE;
        if (count($sp) > 0) {
            foreach ($sp as $value) {
                $pt = $value->periodoprogunidad->programaunidad->programa;
                if ($pt->metodologia_id == $id_me && $pt->modalidad_id == $id_mo) {
                    $programas1[] = $pt;
                }
            }
        } else {
            $band = FALSE;
        }
        $programas = null;
        foreach ($ppu as $value) {
            if ($band) {
                if ($value->programaunidad->programa->metodologia_id == $id_me && $value->programaunidad->programa->modalidad_id == $id_mo && $this->existe2($programas1, $value->programaunidad->programa) == false) {
                    $p = $value->programaunidad->programa;
                    $p->periodoprogunidad_id = $value->id;
                    $programas[] = $p;
                }
            } else {
                if ($value->programaunidad->programa->metodologia_id == $id_me && $value->programaunidad->programa->modalidad_id == $id_mo) {
                    $p = $value->programaunidad->programa;
                    $p->periodoprogunidad_id = $value->id;
                    $programas[] = $p;
                }
            }
        }
        $actual = null;
        $temp = null;
        if ($programas != null) {
            foreach ($programas as $value) {
                if ($actual === null) {
                    $actual = $value->id;
                    $temp[] = $value;
                }
                if ($actual !== $value->id) {
                    $actual = $value->id;
                    $temp[] = $value;
                }
            }
            $array["error"] = "NO";
            if (count($temp) > 0) {
                foreach ($temp as $value) {
                    $value->jornada;
                }
                $arr = null;
                foreach ($temp as $value) {
                    $obj["id"] = $value->id;
                    $obj["nombre"] = $value->nombre;
                    $obj["jornada"] = $value->jornada->descripcion;
                    $obj["estado"] = $value->estado;
                    $obj["periodoprogunidad_id"] = $value->periodoprogunidad_id;
                    $arr[] = $obj;
                }
                $array["data"] = $arr;
            } else {
                $array["error"] = "SI";
            }
        } else {
            $array["error"] = "SI";
        }
        return json_encode($array);
    }

    /**
     * get the programas from a parameters
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function programasproceso($id_me, $id_mo, $unidad, $pa, $proceso) {
        $ppu = Periodoprogunidad::where([['unidad_id', $unidad], ['periodoacademico_id', $pa]])->get();
        $ppu->each(function($item) {
            $item->programaunidad->programa;
        });
        $paca = Programacionprocacademico::where('procesoacademico_id', $proceso)->get();
        $paca->each(function($item) {
            $item->periodoprogunidad->programaunidad;
        });
        $programas = null;
        foreach ($ppu as $value) {
            $pr = $value->programaunidad->programa;
            if ($pr->metodologia_id == $id_me && $pr->modalidad_id == $id_mo && $this->existe3($paca, $pr, $pa) == false) {
                $pr->periodoprogunidad_id = $value->id;
                $programas[] = $pr;
            }
        }
        if ($programas != null) {
            $array["error"] = "NO";
            foreach ($programas as $value) {
                $value->jornada;
            }
            $arr = null;
            foreach ($programas as $value) {
                $obj["id"] = $value->id;
                $obj["nombre"] = $value->nombre;
                $obj["jornada"] = $value->jornada->descripcion;
                $obj["estado"] = $value->estado;
                $obj["periodoprogunidad_id"] = $value->periodoprogunidad_id;
                $arr[] = $obj;
            }
            $array["data"] = $arr;
        } else {
            $array["error"] = "SI";
        }
        return json_encode($array);
    }

    /**
     * return the programs for the parammeters specified
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function programasdocanx($id_me, $id_mo) {
        $pd = Programa::where([['metodologia_id', $id_me], ['modalidad_id', $id_mo]])->get();
        if (count($pd) > 0) {
            $programasd = null;
            foreach ($pd as $value) {
                $obj["id"] = $value->id;
                $obj["value"] = $value->nombre;
                $programasd[] = $obj;
            }
            return json_encode($programasd);
        } else {
            return "null";
        }
    }

}
