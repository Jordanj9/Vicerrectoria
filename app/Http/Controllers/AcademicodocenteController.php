<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Persona;
use App\Docenteacademico;
use App\Personanatural;
use App\Ciudad;
use App\Estado;
use App\Pais;
use App\Docenteunidad;
use App\Docentegrupo;
use App\Grupo;
use PDF;
use App\Periodoacademico;
use App\Pensummateria;

class AcademicodocenteController extends Controller {
    /*
     * datos personales del docente inicio
     */

    public function datospersonales($doc) {
        $docente = null;
        if ($doc === '0') {
            $u = Auth::user();
            $p = Persona::where('numero_documento', $u->identificacion)->get();
            if (count($p) > 0) {
                foreach ($p as $pe) {
                    $d = Docenteacademico::find($pe->id);
                    if ($d !== null) {
                        $pn = Personanatural::where('persona_id', $d->pege)->first();
                        if ($pn !== null) {
                            $docente[$pn->id] = $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido . "  -  DOCENTE DESDE: " . $d->created_at;
                        }
                    }
                }
            }
        } else {
            $docente = Personanatural::find($doc);
            $docente->persona->tipodoc;
            $docente->estadocivil;
            $docente->religion;
            $docente->ciudadr = "";
            $docente->estador = "";
            $docente->paisr = "";
            if ($docente->persona->ciudad2_id !== null) {
                $dcr = Ciudad::find($docente->persona->ciudad2_id);
                if ($dcr !== null) {
                    $docente->ciudadr = $dcr->nombre;
                    $der = Estado::find($dcr->estado_id);
                    if ($der !== null) {
                        $docente->estador = $der->nombre;
                    }
                }
                $dpr = Pais::find($docente->persona->pais2_id);
                if ($dpr !== null) {
                    $docente->paisr = $dpr->nombre;
                }
            }
        }
        return view('docente.academico.datospersonales')
                        ->with('location', 'academico-docente')
                        ->with('d', $docente)
                        ->with('dd', $doc);
    }

    /*
     * lista los grupos que un docente tiene a cargo un semestre
     */

    public function listarestudiantes($per) {
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
        return view('docente.academico.listaestudiantes')
                        ->with('location', 'academico-docente')
                        ->with('d', $grupos)
                        ->with('per', $per);
    }

    /*
     * imprime el listado de estudiantes de un grupo
     */

    public function listarestudiantespdf($per, $grupo) {
        $g = Grupo::find($grupo);
        if ($g !== null) {
            $gm = $g->grupomatriculados;
            $response = null;
            $total = 0;
            if (count($gm) > 0) {
                foreach ($gm as $i) {
                    if ($i->estado === '1') {
                        $p = $i->matriculaacademica->estudiantepensum->estudiante->personanatural;
                        $o = null;
                        $o['td'] = $p->persona->tipodoc->descripcion;
                        $o['id'] = $p->persona->numero_documento;
                        $o['persona'] = $p->primer_apellido . " " . $p->segundo_apellido . " " . $p->primer_nombre . " " . $p->segundo_nombre;
                        $response[] = $o;
                        $total = $total + 1;
                    }
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $per = Periodoacademico::find($per);
                    $pm = Pensummateria::where('materia_codigomateria', $g->materia_codigomateria)->get();
                    $programa = "";
                    if (count($pm) > 0) {
                        foreach ($pm as $k) {
                            $programa = $programa . $k->pensum->programa->nombre . " - ";
                        }
                    }
                    $encabezado = [
                        'UNIDAD REGIONAL - CIUDAD' => $g->unidad->nombre . " - " . $g->unidad->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $per->anio . " - " . $per->periodo . " => " . $per->TipoPeriodo->descripcion,
                        'PROGRAMA' => $programa,
                        'MATERIA' => $g->materia->nombre,
                        'GRUPO' => 'GRUPO ' . $g->nombre,
                        'TOTAL ALUMNOS' => $total
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombre'];
                    $filtros = null;
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fecha;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $this->orderMultiDimensionalArray($response, 'persona', false);
                    $date['nivel'] = 1;
                    $date['titulo'] = "LISTADO DE ESTUDIANTES MATRICULADOS EN EL GRUPO " . $g->nombre;
                    $date['filtros'] = $filtros;
                    $pdf = PDF::loadView('docente.academico.print', $date);
                    return $pdf->stream('listado.pdf');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>El grupo no tiene estudiantes matriculados<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>El grupo no tiene estudiantes matriculados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>El grupo no se encontró.<br/><br/></p>";
        }
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

}
