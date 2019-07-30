<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unidad;
use App\Pais;
use App\Ciudad;
use App\Matriculaacademica;
use App\Cancelacionsemestre;
use App\Hismatriculaacademica;
use App\TipoUnidad;
use App\Estudiantepensum;
use App\Programaunidad;
use App\Cancelacionmateria;
use App\Grupo;
use App\Pensummateria;
use App\Docenteunidad;
use App\Trabajadorlabor;
use App\Docentegrupo;
use App\Materia;
use App\Personanatural;
use App\NivelEducativo;
use App\Metodologia;
use App\Modalidad;
use App\Periodoacademico;
use App\Jefefamiliaest;
use App\Parentesco;
use App\Ocupacionlaboral;
use App\Posesionresidenciaest;
use PDF;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RepmatriculaacademicaController extends Controller {

    public function porgenero() {
        $unds = Unidad::where('regional', '1')->pluck('nombre', 'id');
        return view('reportes.matricula.porgenero')
                        ->with('location', 'reportes')
                        ->with('unds', $unds);
    }

    public function porgenero_pdf($und, $per, $sex) {
        $ma = Matriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
        if (count($ma) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($ma as $m) {
                $pern = $m->estudiantepensum->estudiante->personanatural;
                if ($pern !== null) {
                    if ($pern->sexo === $sex) {
                        $o = null;
                        $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                        $o['num_doc'] = $pern->persona->numero_documento;
                        $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                        $o['sexo'] = $pern->sexo;
                        $response[] = $o;
                    }
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    if ($sex === "M") {
                        $gen = "MASCULINO";
                    } else {
                        $gen = "FEMENINO";
                    }
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'GENÉRO' => $gen
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Genéro'];
                    $filtros = [
                        'GENÉRO' => $gen
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fecha;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $arror;
                    $date['nivel'] = 1;
                    $date['titulo'] = "REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE MATRICULADOS POR GENÉRO";
                    $date['filtros'] = $filtros;
                    $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                    return $pdf->stream('reporte.pdf');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function porgenero_excel($und, $per, $sex) {
        $ma = Matriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
        if (count($ma) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($ma as $m) {
                $pern = $m->estudiantepensum->estudiante->personanatural;
                if ($pern !== null) {
                    if ($pern->sexo === $sex) {
                        $o = null;
                        $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                        $o['num_doc'] = $pern->persona->numero_documento;
                        $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                        $o['sexo'] = $pern->sexo;
                        $response[] = $o;
                    }
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    if ($sex === "M") {
                        $gen = "MASCULINO";
                    } else {
                        $gen = "FEMENINO";
                    }
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'GENÉRO' => $gen
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Genéro'];
                    $filtros = [
                        'GENÉRO' => $gen
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    Excel::create('matacademica_matriculadosxgenero', function ($excel) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                        $excel->sheet('Reporte', function ($sheet) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                            $sheet->row(1, ["REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE MATRICULADOS POR GENÉRO"]);
                            $sheet->row(2, ["FECHA REPORTE: " . $fecha]);
                            $sheet->row(3, "");
                            $sheet->row(4, $encabezado);
                            $sheet->row(5, $filtros);
                            $sheet->row(6, "");
                            $sheet->row(7, $cabeceras);
                            $i = 7;
                            foreach ($arror as $key => $value) {
                                $i = $i + 1;
                                $sheet->row($i, [$value['tipodoc'], $value['num_doc'], $value['nombre'], $value['sexo']]);
                            }
                        });
                    })->download('xlsx');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function poredad() {
        $unds = Unidad::where('regional', '1')->pluck('nombre', 'id');
        return view('reportes.matricula.poredad')
                        ->with('location', 'reportes')
                        ->with('unds', $unds);
    }

    public function poredad_pdf($und, $per, $ea, $eb) {
        $ma = Matriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
        if (count($ma) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($ma as $m) {
                $pern = $m->estudiantepensum->estudiante->personanatural;
                if ($pern !== null) {
                    $edad = $this->edad($pern->fecha_nacimiento);
                    if ($edad >= $ea && $edad <= $eb) {
                        $o = null;
                        $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                        $o['num_doc'] = $pern->persona->numero_documento;
                        $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                        $o['edad'] = $edad;
                        $response[] = $o;
                    }
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'RANGO DE EDAD' => $ea . " - " . $eb
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Edad'];
                    $filtros = [
                        'EDAD' => $ea . " - " . $eb
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fecha;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $arror;
                    $date['nivel'] = 1;
                    $date['titulo'] = "REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE MATRICULADOS POR EDAD";
                    $date['filtros'] = $filtros;
                    $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                    return $pdf->stream('reporte.pdf');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function poredad_excel($und, $per, $ea, $eb) {
        $ma = Matriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
        if (count($ma) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($ma as $m) {
                $pern = $m->estudiantepensum->estudiante->personanatural;
                if ($pern !== null) {
                    $edad = $this->edad($pern->fecha_nacimiento);
                    if ($edad >= $ea && $edad <= $eb) {
                        $o = null;
                        $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                        $o['num_doc'] = $pern->persona->numero_documento;
                        $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                        $o['edad'] = $edad;
                        $response[] = $o;
                    }
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'RANGO DE EDAD' => $ea . " - " . $eb
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Edad'];
                    $filtros = [
                        'EDAD' => $ea . " - " . $eb
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    Excel::create('matacademica_matriculadosxedad', function ($excel) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                        $excel->sheet('Reporte', function ($sheet) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                            $sheet->row(1, ["REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE MATRICULADOS POR EDAD"]);
                            $sheet->row(2, ["FECHA REPORTE: " . $fecha]);
                            $sheet->row(3, "");
                            $sheet->row(4, $encabezado);
                            $sheet->row(5, $filtros);
                            $sheet->row(6, "");
                            $sheet->row(7, $cabeceras);
                            $i = 7;
                            foreach ($arror as $key => $value) {
                                $i = $i + 1;
                                $sheet->row($i, [$value['tipodoc'], $value['num_doc'], $value['nombre'], $value['edad']]);
                            }
                        });
                    })->download('xlsx');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function procedencia() {
        $unds = Unidad::where('regional', '1')->pluck('nombre', 'id');
        $paises = Pais::all()->pluck('nombre', 'id');
        return view('reportes.matricula.procedencia')
                        ->with('location', 'reportes')
                        ->with('unds', $unds)
                        ->with('paises', $paises);
    }

    public function procedencia_pdf($und, $per, $ciudad) {
        $ma = Matriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
        if (count($ma) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $c = Ciudad::find($ciudad);
            $response = null;
            foreach ($ma as $m) {
                $est = $m->estudiantepensum->estudiante;
                $pern = $est->personanatural;
                if ($est !== null && $pern !== null) {
                    if ($est->ciudad_procedencia === $ciudad) {
                        $o = null;
                        $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                        $o['num_doc'] = $pern->persona->numero_documento;
                        $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                        $o['ciudad'] = $c->nombre;
                        $response[] = $o;
                    }
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'PROCEDENCIA' => $c->nombre
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Ciudad'];
                    $filtros = [
                        'CIUDAD DE PROCEDENCIA' => $c->nombre
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fecha;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $arror;
                    $date['nivel'] = 1;
                    $date['titulo'] = "REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE MATRICULADOS POR PROCEDENCIA";
                    $date['filtros'] = $filtros;
                    $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                    return $pdf->stream('reporte.pdf');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function procedencia_excel($und, $per, $ciudad) {
        $ma = Matriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
        if (count($ma) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $c = Ciudad::find($ciudad);
            $response = null;
            foreach ($ma as $m) {
                $est = $m->estudiantepensum->estudiante;
                $pern = $est->personanatural;
                if ($est !== null && $pern !== null) {
                    if ($est->ciudad_procedencia === $ciudad) {
                        $o = null;
                        $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                        $o['num_doc'] = $pern->persona->numero_documento;
                        $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                        $o['ciudad'] = $c->nombre;
                        $response[] = $o;
                    }
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'PROCEDENCIA' => $c->nombre
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Ciudad'];
                    $filtros = [
                        'CIUDAD DE PROCEDENCIA' => $c->nombre
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    Excel::create('matacademica_matriculadosxprocedencia', function ($excel) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                        $excel->sheet('Reporte', function ($sheet) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                            $sheet->row(1, ["REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE MATRICULADOS POR PROCEDENCIA"]);
                            $sheet->row(2, ["FECHA REPORTE: " . $fecha]);
                            $sheet->row(3, "");
                            $sheet->row(4, $encabezado);
                            $sheet->row(5, $filtros);
                            $sheet->row(6, "");
                            $sheet->row(7, $cabeceras);
                            $i = 7;
                            foreach ($arror as $key => $value) {
                                $i = $i + 1;
                                $sheet->row($i, [$value['tipodoc'], $value['num_doc'], $value['nombre'], $value['ciudad']]);
                            }
                        });
                    })->download('xlsx');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function periodo() {
        $unds = Unidad::where('regional', '1')->pluck('nombre', 'id');
        return view('reportes.matricula.periodo')
                        ->with('location', 'reportes')
                        ->with('unds', $unds);
    }

    public function periodo_pdf($und, $per, $tipo) {
        if ($tipo == 1) {
            $ma = Matriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO ACTUAL";
        } else {
            $ma = Hismatriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO HISTÓRICO";
        }
        if (count($ma) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($ma as $m) {
                $est = $m->estudiantepensum->estudiante;
                $pern = $est->personanatural;
                if ($est !== null && $pern !== null) {
                    $o = null;
                    $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                    $o['num_doc'] = $pern->persona->numero_documento;
                    $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                    $o['periodo'] = $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion;
                    $response[] = $o;
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'TIPO' => $t
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Período'];
                    $filtros = [
                        'TIPO' => $t
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fecha;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $arror;
                    $date['nivel'] = 1;
                    $date['titulo'] = "REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE MATRICULADOS POR PERÍODO ACADÉMICO";
                    $date['filtros'] = $filtros;
                    $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                    return $pdf->stream('reporte.pdf');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function periodo_excel($und, $per, $tipo) {
        if ($tipo == 1) {
            $ma = Matriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO ACTUAL";
        } else {
            $ma = Hismatriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO HISTÓRICO";
        }
        if (count($ma) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($ma as $m) {
                $est = $m->estudiantepensum->estudiante;
                $pern = $est->personanatural;
                if ($est !== null && $pern !== null) {
                    $o = null;
                    $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                    $o['num_doc'] = $pern->persona->numero_documento;
                    $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                    $o['periodo'] = $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion;
                    $response[] = $o;
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'TIPO' => $t
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Período'];
                    $filtros = [
                        'TIPO' => $t
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    Excel::create('matacademica_matriculadosxperiodoacademico', function ($excel) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                        $excel->sheet('Reporte', function ($sheet) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                            $sheet->row(1, ["REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE MATRICULADOS POR PERÍODO ACADÉMICO"]);
                            $sheet->row(2, ["FECHA REPORTE: " . $fecha]);
                            $sheet->row(3, "");
                            $sheet->row(4, $encabezado);
                            $sheet->row(5, $filtros);
                            $sheet->row(6, "");
                            $sheet->row(7, $cabeceras);
                            $i = 7;
                            foreach ($arror as $key => $value) {
                                $i = $i + 1;
                                $sheet->row($i, [$value['tipodoc'], $value['num_doc'], $value['nombre'], $value['periodo']]);
                            }
                        });
                    })->download('xlsx');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function cancelarsemestre() {
        $unds = Unidad::where('regional', '1')->pluck('nombre', 'id');
        return view('reportes.matricula.cancelarsemestre')
                        ->with('location', 'reportes')
                        ->with('unds', $unds);
    }

    public function cancelarsemestre_pdf($und, $per) {
        $ma = Cancelacionsemestre::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
        if (count($ma) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($ma as $m) {
                $est = $m->estudiantepensum->estudiante;
                $pern = $est->personanatural;
                if ($est !== null && $pern !== null) {
                    $o = null;
                    $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                    $o['num_doc'] = $pern->persona->numero_documento;
                    $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                    $o['fecha'] = $m->fechacancelacion;
                    $o['objeto'] = $m->objetocancelacion->descripcion;
                    $o['norma'] = $m->norma->descripcion;
                    $response[] = $o;
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Fecha de Cancelación', 'Objeto de Cancelación', 'Norma'];
                    $filtros = null;
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fecha;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $arror;
                    $date['nivel'] = 1;
                    $date['titulo'] = "REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE CANCELACIÓN DE SEMESTRE";
                    $date['filtros'] = $filtros;
                    $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                    return $pdf->stream('reporte.pdf');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function cancelarsemestre_excel($und, $per) {
        $ma = Cancelacionsemestre::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
        if (count($ma) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($ma as $m) {
                $est = $m->estudiantepensum->estudiante;
                $pern = $est->personanatural;
                if ($est !== null && $pern !== null) {
                    $o = null;
                    $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                    $o['num_doc'] = $pern->persona->numero_documento;
                    $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                    $o['fecha'] = $m->fechacancelacion;
                    $o['objeto'] = $m->objetocancelacion->descripcion;
                    $o['norma'] = $m->norma->descripcion;
                    $response[] = $o;
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Fecha de Cancelación', 'Objeto de Cancelación', 'Norma'];
                    $filtros = null;
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    Excel::create('matacademica_cancelacionsemestre', function ($excel) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                        $excel->sheet('Reporte', function ($sheet) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                            $sheet->row(1, ["REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE CANCELACIÓN DE SEMESTRE"]);
                            $sheet->row(2, ["FECHA REPORTE: " . $fecha]);
                            $sheet->row(3, "");
                            $sheet->row(4, $encabezado);
                            $sheet->row(5, $filtros);
                            $sheet->row(6, "");
                            $sheet->row(7, $cabeceras);
                            $i = 7;
                            foreach ($arror as $key => $value) {
                                $i = $i + 1;
                                $sheet->row($i, [$value['tipodoc'], $value['num_doc'], $value['nombre'], $value['fecha'], $value['objeto'], $value['norma']]);
                            }
                        });
                    })->download('xlsx');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function sinrenovacionm() {
        $tu = TipoUnidad::all()->pluck('descripcion', 'id');
        $met = Metodologia::all()->pluck('nombre', 'id');
        $ne = NivelEducativo::all()->pluck('descripcion', 'id');
        return view('reportes.matricula.sinrenovacionm')
                        ->with('location', 'reportes')
                        ->with('tu', $tu)
                        ->with('met', $met)
                        ->with('ne', $ne);
    }

    public function sinrenovacionm_pdf($programaunidad_id, $und, $per) {
        $ep = Estudiantepensum::where([['programaunidad_id', $programaunidad_id], ['unidad_id', $und], ['categoria_id', 5]])->get();
        if (count($ep) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $pro = Programaunidad::find($programaunidad_id);
            $response = null;
            foreach ($ep as $e) {
                $mat = Matriculaacademica::where([['estudiantepensum_id', $e->id], ['periodoacademico_id', $per], ['unidad_id', $e->unidad_id]])->first();
                if ($mat === null) {
                    $est = $e->estudiante->personanatural;
                    $o = null;
                    $o['tipodoc'] = $est->persona->tipodoc->abreviatura;
                    $o['num_doc'] = $est->persona->numero_documento;
                    $o['nombre'] = $est->primer_nombre . " " . $est->segundo_nombre . " " . $est->primer_apellido . " " . $est->segundo_apellido;
                    $o['situacion'] = $e->situacionestudiante->descripcion;
                    $o['categoria'] = $e->categoria->descripcion;
                    $response[] = $o;
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Situación', 'Categoria'];
                    $filtros = [
                        'PROGRAMA' => $pro->programa->nombre
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fecha;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $arror;
                    $date['nivel'] = 1;
                    $date['titulo'] = "REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE ESTUDIANTES SIN RENOVACIÓN DE MATRÍCULA";
                    $date['filtros'] = $filtros;
                    $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                    return $pdf->stream('reporte.pdf');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function sinrenovacionm_excel($programaunidad_id, $und, $per) {
        $ep = Estudiantepensum::where([['programaunidad_id', $programaunidad_id], ['unidad_id', $und], ['categoria_id', 5]])->get();
        if (count($ep) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $pro = Programaunidad::find($programaunidad_id);
            $response = null;
            foreach ($ep as $e) {
                $mat = Matriculaacademica::where([['estudiantepensum_id', $e->id], ['periodoacademico_id', $per], ['unidad_id', $e->unidad_id]])->first();
                if ($mat === null) {
                    $est = $e->estudiante->personanatural;
                    $o = null;
                    $o['tipodoc'] = $est->persona->tipodoc->abreviatura;
                    $o['num_doc'] = $est->persona->numero_documento;
                    $o['nombre'] = $est->primer_nombre . " " . $est->segundo_nombre . " " . $est->primer_apellido . " " . $est->segundo_apellido;
                    $o['situacion'] = $e->situacionestudiante->descripcion;
                    $o['categoria'] = $e->categoria->descripcion;
                    $response[] = $o;
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Situación', 'Categoria'];
                    $filtros = [
                        'PROGRAMA' => $pro->programa->nombre
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    Excel::create('matacademica_sinrenovacionm', function ($excel) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                        $excel->sheet('Reporte', function ($sheet) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                            $sheet->row(1, ["REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE ESTUDIANTES SIN RENOVACIÓN DE MATRÍCULA"]);
                            $sheet->row(2, ["FECHA REPORTE: " . $fecha]);
                            $sheet->row(3, "");
                            $sheet->row(4, $encabezado);
                            $sheet->row(5, $filtros);
                            $sheet->row(6, "");
                            $sheet->row(7, $cabeceras);
                            $i = 7;
                            foreach ($arror as $key => $value) {
                                $i = $i + 1;
                                $sheet->row($i, [$value['tipodoc'], $value['num_doc'], $value['nombre'], $value['situacion'], $value['categoria']]);
                            }
                        });
                    })->download('xlsx');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function matprimersemestre() {
        $tu = TipoUnidad::all()->pluck('descripcion', 'id');
        $met = Metodologia::all()->pluck('nombre', 'id');
        $ne = NivelEducativo::all()->pluck('descripcion', 'id');
        return view('reportes.matricula.matprimersemestre')
                        ->with('location', 'reportes')
                        ->with('tu', $tu)
                        ->with('met', $met)
                        ->with('ne', $ne);
    }

    public function matprimersemestre_pdf($programaunidad_id, $und, $per) {
        $ep = DB::table('estudiantepensums')->where([['programaunidad_id', $programaunidad_id], ['unidad_id', $und]])
                        ->whereBetween('categoria_id', [2, 3])->get();
        if (count($ep) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $pro = Programaunidad::find($programaunidad_id);
            $response = null;
            foreach ($ep as $e) {
                $es = Estudiantepensum::find($e->id);
                if ($es !== null) {
                    $est = $es->estudiante->personanatural;
                    $o = null;
                    $o['tipodoc'] = $est->persona->tipodoc->abreviatura;
                    $o['num_doc'] = $est->persona->numero_documento;
                    $o['nombre'] = $est->primer_nombre . " " . $est->segundo_nombre . " " . $est->primer_apellido . " " . $est->segundo_apellido;
                    $o['situacion'] = $es->situacionestudiante->descripcion;
                    $o['categoria'] = $es->categoria->descripcion;
                    $response[] = $o;
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Situación', 'Categoria'];
                    $filtros = [
                        'PROGRAMA' => $pro->programa->nombre
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fecha;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $arror;
                    $date['nivel'] = 1;
                    $date['titulo'] = "REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE MATRICULADOS PRIMER SEMESTRE";
                    $date['filtros'] = $filtros;
                    $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                    return $pdf->stream('reporte.pdf');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function matprimersemestre_excel($programaunidad_id, $und, $per) {
        $ep = DB::table('estudiantepensums')->where([['programaunidad_id', $programaunidad_id], ['unidad_id', $und]])
                        ->whereBetween('categoria_id', [2, 3])->get();
        if (count($ep) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $pro = Programaunidad::find($programaunidad_id);
            $response = null;
            foreach ($ep as $e) {
                $es = Estudiantepensum::find($e->id);
                if ($es !== null) {
                    $est = $es->estudiante->personanatural;
                    $o = null;
                    $o['tipodoc'] = $est->persona->tipodoc->abreviatura;
                    $o['num_doc'] = $est->persona->numero_documento;
                    $o['nombre'] = $est->primer_nombre . " " . $est->segundo_nombre . " " . $est->primer_apellido . " " . $est->segundo_apellido;
                    $o['situacion'] = $es->situacionestudiante->descripcion;
                    $o['categoria'] = $es->categoria->descripcion;
                    $response[] = $o;
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Situación', 'Categoria'];
                    $filtros = [
                        'PROGRAMA' => $pro->programa->nombre
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    Excel::create('matacademica_matprimersemestre', function ($excel) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                        $excel->sheet('Reporte', function ($sheet) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                            $sheet->row(1, ["REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE MATRICULADOS PRIMER SEMESTRE"]);
                            $sheet->row(2, ["FECHA REPORTE: " . $fecha]);
                            $sheet->row(3, "");
                            $sheet->row(4, $encabezado);
                            $sheet->row(5, $filtros);
                            $sheet->row(6, "");
                            $sheet->row(7, $cabeceras);
                            $i = 7;
                            foreach ($arror as $key => $value) {
                                $i = $i + 1;
                                $sheet->row($i, [$value['tipodoc'], $value['num_doc'], $value['nombre'], $value['situacion'], $value['categoria']]);
                            }
                        });
                    })->download('xlsx');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function ubicacionsemestral() {
        $unds = Unidad::where('regional', '1')->pluck('nombre', 'id');
        $tu = TipoUnidad::all()->pluck('descripcion', 'id');
        $met = Metodologia::all()->pluck('nombre', 'id');
        $ne = NivelEducativo::all()->pluck('descripcion', 'id');
        return view('reportes.matricula.ubicacionsemestral')
                        ->with('location', 'reportes')
                        ->with('unds', $unds)
                        ->with('tu', $tu)
                        ->with('met', $met)
                        ->with('ne', $ne);
    }

    public function ubicacionsemestral_pdf($programaunidad_id, $und) {
        $ep = Estudiantepensum::where([['programaunidad_id', $programaunidad_id], ['unidad_id', $und]])->get();
        if (count($ep) > 0) {
            $u = Unidad::find($und);
            $pro = Programaunidad::find($programaunidad_id);
            $response = null;
            foreach ($ep as $e) {
                $est = $e->estudiante->personanatural;
                $o = null;
                $o['tipodoc'] = $est->persona->tipodoc->abreviatura;
                $o['num_doc'] = $est->persona->numero_documento;
                $o['nombre'] = $est->primer_nombre . " " . $est->segundo_nombre . " " . $est->primer_apellido . " " . $est->segundo_apellido;
                $o['situacion'] = $e->situacionestudiante->descripcion;
                $o['categoria'] = $e->categoria->descripcion;
                $o['ub_sem'] = $e->periodoacademico;
                $o['ub_cron'] = $e->periodocronologico;
                $response[] = $o;
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Situación', 'Categoria', 'Ubicación Semestral', 'Periodo Cronologico'];
                    $filtros = [
                        'PROGRAMA' => $pro->programa->nombre
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fecha;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $arror;
                    $date['nivel'] = 1;
                    $date['titulo'] = "REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE ESTUDIANTES CON UBICACIÓN SEMESTRAL";
                    $date['filtros'] = $filtros;
                    $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                    return $pdf->stream('reporte.pdf');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function ubicacionsemestral_excel($programaunidad_id, $und) {
        $ep = Estudiantepensum::where([['programaunidad_id', $programaunidad_id], ['unidad_id', $und]])->get();
        if (count($ep) > 0) {
            $u = Unidad::find($und);
            $pro = Programaunidad::find($programaunidad_id);
            $response = null;
            foreach ($ep as $e) {
                $est = $e->estudiante->personanatural;
                $o = null;
                $o['tipodoc'] = $est->persona->tipodoc->abreviatura;
                $o['num_doc'] = $est->persona->numero_documento;
                $o['nombre'] = $est->primer_nombre . " " . $est->segundo_nombre . " " . $est->primer_apellido . " " . $est->segundo_apellido;
                $o['situacion'] = $e->situacionestudiante->descripcion;
                $o['categoria'] = $e->categoria->descripcion;
                $o['ub_sem'] = $e->periodoacademico;
                $o['ub_cron'] = $e->periodocronologico;
                $response[] = $o;
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Situación', 'Categoria', 'Ubicación Semestral', 'Periodo Cronologico'];
                    $filtros = [
                        'PROGRAMA' => $pro->programa->nombre
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    Excel::create('matacademica_ubicacionsemestral', function ($excel) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                        $excel->sheet('Reporte', function ($sheet) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                            $sheet->row(1, ["REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE ESTUDIANTES CON UBICACIÓN SEMESTRAL"]);
                            $sheet->row(2, ["FECHA REPORTE: " . $fecha]);
                            $sheet->row(3, "");
                            $sheet->row(4, $encabezado);
                            $sheet->row(5, $filtros);
                            $sheet->row(6, "");
                            $sheet->row(7, $cabeceras);
                            $i = 7;
                            foreach ($arror as $key => $value) {
                                $i = $i + 1;
                                $sheet->row($i, [$value['tipodoc'], $value['num_doc'], $value['nombre'], $value['situacion'], $value['categoria'], $value['ub_sem'], $value['ub_cron']]);
                            }
                        });
                    })->download('xlsx');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function unidadregional() {
        $unds = Unidad::where('regional', '1')->pluck('nombre', 'id');
        return view('reportes.matricula.unidadregional')
                        ->with('location', 'reportes')
                        ->with('unds', $unds);
    }

    public function unidadregional_pdf($und, $per, $tipo) {
        if ($tipo == 1) {
            $ma = Matriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO ACTUAL";
        } else {
            $ma = Hismatriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO HISTÓRICO";
        }
        if (count($ma) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($ma as $m) {
                $est = $m->estudiantepensum->estudiante;
                $pern = $est->personanatural;
                if ($est !== null && $pern !== null) {
                    $o = null;
                    $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                    $o['num_doc'] = $pern->persona->numero_documento;
                    $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                    $o['periodo'] = $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion;
                    $o['unidad'] = $u->nombre;
                    $response[] = $o;
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'TIPO' => $t
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Período', 'Unidad Regional'];
                    $filtros = [
                        'TIPO' => $t,
                        'UNIDAD REGIONAL' => $u->nombre
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fecha;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $arror;
                    $date['nivel'] = 1;
                    $date['titulo'] = "REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE MATRICULADOS POR UNIDAD REGIONAL";
                    $date['filtros'] = $filtros;
                    $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                    return $pdf->stream('reporte.pdf');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function unidadregional_excel($und, $per, $tipo) {
        if ($tipo == 1) {
            $ma = Matriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO ACTUAL";
        } else {
            $ma = Hismatriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO HISTÓRICO";
        }
        if (count($ma) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($ma as $m) {
                $est = $m->estudiantepensum->estudiante;
                $pern = $est->personanatural;
                if ($est !== null && $pern !== null) {
                    $o = null;
                    $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                    $o['num_doc'] = $pern->persona->numero_documento;
                    $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                    $o['periodo'] = $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion;
                    $o['unidad'] = $u->nombre;
                    $response[] = $o;
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'TIPO' => $t
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Período', 'Unidad Regional'];
                    $filtros = [
                        'TIPO' => $t,
                        'UNIDAD REGIONAL' => $u->nombre
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    Excel::create('matacademica_ubicacionsemestral', function ($excel) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                        $excel->sheet('Reporte', function ($sheet) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                            $sheet->row(1, ["REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE MATRICULADOS POR UNIDAD REGIONAL"]);
                            $sheet->row(2, ["FECHA REPORTE: " . $fecha]);
                            $sheet->row(3, "");
                            $sheet->row(4, $encabezado);
                            $sheet->row(5, $filtros);
                            $sheet->row(6, "");
                            $sheet->row(7, $cabeceras);
                            $i = 7;
                            foreach ($arror as $key => $value) {
                                $i = $i + 1;
                                $sheet->row($i, [$value['tipodoc'], $value['num_doc'], $value['nombre'], $value['periodo'], $value['unidad']]);
                            }
                        });
                    })->download('xlsx');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function porprograma() {
        $unds = Unidad::where('regional', '1')->pluck('nombre', 'id');
        $met = Metodologia::all()->pluck('nombre', 'id');
        $ne = NivelEducativo::all()->pluck('descripcion', 'id');
        return view('reportes.matricula.porprograma')
                        ->with('location', 'reportes')
                        ->with('unds', $unds)
                        ->with('met', $met)
                        ->with('ne', $ne);
    }

    public function porprograma_pdf($programaunidad_id, $und, $per, $tipo) {
        if ($tipo == 1) {
            $ma = Matriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO ACTUAL";
        } else {
            $ma = Hismatriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO HISTÓRICO";
        }
        if (count($ma) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $programaunid = Programaunidad::find($programaunidad_id);
            $response = null;
            foreach ($ma as $m) {
                $pu = $m->estudiantepensum->programaunidad_id;
                if ($pu == $programaunidad_id) {
                    $est = $m->estudiantepensum->estudiante;
                    $pern = $est->personanatural;
                    $o = null;
                    $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                    $o['num_doc'] = $pern->persona->numero_documento;
                    $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                    $o['periodo'] = $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion;
                    $o['programa'] = $m->estudiantepensum->programaunidad->programa->nombre;
                    $o['situacion'] = $m->estudiantepensum->situacionestudiante->descripcion;
                    $response[] = $o;
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'TIPO' => $t,
                        'PROGRAMA' => $programaunid->programa->nombre
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Período', 'Programa', 'Situación'];
                    $filtros = [
                        'TIPO' => $t,
                        'PROGRAMA' => $programaunid->programa->nombre
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fecha;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $arror;
                    $date['nivel'] = 1;
                    $date['titulo'] = "REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE MATRICULADOS POR PROGRAMA";
                    $date['filtros'] = $filtros;
                    $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                    return $pdf->stream('reporte.pdf');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function porprograma_excel($programaunidad_id, $und, $per, $tipo) {
        if ($tipo == 1) {
            $ma = Matriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO ACTUAL";
        } else {
            $ma = Hismatriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO HISTÓRICO";
        }
        if (count($ma) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $programaunid = Programaunidad::find($programaunidad_id);
            $response = null;
            foreach ($ma as $m) {
                $pu = $m->estudiantepensum->programaunidad_id;
                if ($pu == $programaunidad_id) {
                    $est = $m->estudiantepensum->estudiante;
                    $pern = $est->personanatural;
                    $o = null;
                    $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                    $o['num_doc'] = $pern->persona->numero_documento;
                    $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                    $o['periodo'] = $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion;
                    $o['programa'] = $m->estudiantepensum->programaunidad->programa->nombre;
                    $o['situacion'] = $m->estudiantepensum->situacionestudiante->descripcion;
                    $response[] = $o;
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'TIPO' => $t,
                        'PROGRAMA' => $programaunid->programa->nombre
                    ];
                    $cabeceras = ['Tipo Documento', 'Número', 'Nombres', 'Período', 'Programa', 'Situación'];
                    $filtros = [
                        'TIPO' => $t,
                        'PROGRAMA' => $programaunid->programa->nombre
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    Excel::create('matacademica_ubicacionsemestral', function ($excel) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                        $excel->sheet('Reporte', function ($sheet) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                            $sheet->row(1, ["REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE MATRICULADOS POR UNIDAD REGIONAL"]);
                            $sheet->row(2, ["FECHA REPORTE: " . $fecha]);
                            $sheet->row(3, "");
                            $sheet->row(4, $encabezado);
                            $sheet->row(5, $filtros);
                            $sheet->row(6, "");
                            $sheet->row(7, $cabeceras);
                            $i = 7;
                            foreach ($arror as $key => $value) {
                                $i = $i + 1;
                                $sheet->row($i, [$value['tipodoc'], $value['num_doc'], $value['nombre'], $value['periodo'], $value['programa'], $value['situacion']]);
                            }
                        });
                    })->download('xlsx');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function consolidadomat() {
        $unds = Unidad::where('regional', '1')->pluck('nombre', 'id');
        return view('reportes.matricula.consolidadomatriculados')
                        ->with('location', 'reportes')
                        ->with('unds', $unds);
    }

    public function consolidadomat_pdf($und, $per, $tipo) {
        if ($tipo == 1) {
            $ma = Matriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO ACTUAL";
        } else {
            $ma = Hismatriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO HISTÓRICO";
        }
        if (count($ma) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($ma as $m) {
                $pro = $m->estudiantepensum->programaunidad_id;
                if ($this->buscar($response, $pro)) {
                    $response[$pro]['total'] = $response[$pro]['total'] + 1;
                } else {
                    $response[$pro]['nombrepro'] = $m->estudiantepensum->programaunidad->programa->nombre;
                    $response[$pro]['total'] = 1;
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'TIPO' => $t,
                    ];
                    $cabeceras = ['Programa', 'Total Matriculados'];
                    $filtros = [
                        'TIPO' => $t,
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fecha;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $response;
                    $date['nivel'] = 1;
                    $date['titulo'] = "REPORTES DE MATRÍCULA ACADÉMICA - CONSOLIDADO DE MATRICULADOS";
                    $date['filtros'] = $filtros;
                    $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                    return $pdf->stream('reporte.pdf');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function consolidadomat_excel($und, $per, $tipo) {
        if ($tipo == 1) {
            $ma = Matriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO ACTUAL";
        } else {
            $ma = Hismatriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO HISTÓRICO";
        }
        if (count($ma) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($ma as $m) {
                $pro = $m->estudiantepensum->programaunidad_id;
                if ($this->buscar($response, $pro)) {
                    $response[$pro]['total'] = $response[$pro]['total'] + 1;
                } else {
                    $response[$pro]['nombrepro'] = $m->estudiantepensum->programaunidad->programa->nombre;
                    $response[$pro]['total'] = 1;
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'TIPO' => $t,
                    ];
                    $cabeceras = ['Programa', 'Total Matriculados'];
                    $filtros = [
                        'TIPO' => $t,
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    Excel::create('matacademica_consolidadomatriculados', function ($excel) use ($response, $cabeceras, $encabezado, $fecha, $filtros) {
                        $excel->sheet('Reporte', function ($sheet) use ($response, $cabeceras, $encabezado, $fecha, $filtros) {
                            $sheet->row(1, ["REPORTES DE MATRÍCULA ACADÉMICA - CONSOLIDADO DE MATRICULADOS"]);
                            $sheet->row(2, ["FECHA REPORTE: " . $fecha]);
                            $sheet->row(3, "");
                            $sheet->row(4, $encabezado);
                            $sheet->row(5, $filtros);
                            $sheet->row(6, "");
                            $sheet->row(7, $cabeceras);
                            $i = 7;
                            foreach ($response as $key => $value) {
                                $i = $i + 1;
                                $sheet->row($i, [$value['nombrepro'], $value['total']]);
                            }
                        });
                    })->download('xlsx');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function estudiantegeneral() {
        $unds = Unidad::where('regional', '1')->pluck('nombre', 'id');
        return view('reportes.matricula.estudiantegeneral')
                        ->with('location', 'reportes')
                        ->with('unds', $unds);
    }

    public function estudiantegeneral_pdf($und, $per, $tipo) {
        if ($tipo == 1) {
            $ma = Matriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO ACTUAL";
        } else {
            $ma = Hismatriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO HISTÓRICO";
        }
        if (count($ma) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($ma as $m) {
                $est = $m->estudiantepensum->estudiante;
                $pern = $est->personanatural;
                $o = null;
                $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                $o['num_doc'] = $pern->persona->numero_documento;
                $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                $o['programa'] = $m->estudiantepensum->programaunidad->programa->nombre;
                $response[] = $o;
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'TIPO' => $t,
                    ];
                    $cabeceras = ['Tipo de Documento', 'Número', 'Nombre', 'Programa'];
                    $filtros = [
                        'TIPO' => $t,
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fecha;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $arror;
                    $date['nivel'] = 1;
                    $date['titulo'] = "REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE ESTUDIANTES GENERAL";
                    $date['filtros'] = $filtros;
                    $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                    return $pdf->stream('reporte.pdf');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function estudiantegeneral_excel($und, $per, $tipo) {
        if ($tipo == 1) {
            $ma = Matriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO ACTUAL";
        } else {
            $ma = Hismatriculaacademica::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
            $t = "PERÍODO HISTÓRICO";
        }
        if (count($ma) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($ma as $m) {
                $est = $m->estudiantepensum->estudiante;
                $pern = $est->personanatural;
                $o = null;
                $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                $o['num_doc'] = $pern->persona->numero_documento;
                $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                $o['programa'] = $m->estudiantepensum->programaunidad->programa->nombre;
                $response[] = $o;
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'TIPO' => $t,
                    ];
                    $cabeceras = ['Tipo de Documento', 'Número', 'Nombre', 'Programa'];
                    $filtros = [
                        'TIPO' => $t,
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    Excel::create('matacademica_estudiantesgeneral', function ($excel) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                        $excel->sheet('Reporte', function ($sheet) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                            $sheet->row(1, ["REPORTES DE MATRÍCULA ACADÉMICA - CONSOLIDADO DE MATRICULADOS"]);
                            $sheet->row(2, ["FECHA REPORTE: " . $fecha]);
                            $sheet->row(3, "");
                            $sheet->row(4, $encabezado);
                            $sheet->row(5, $filtros);
                            $sheet->row(6, "");
                            $sheet->row(7, $cabeceras);
                            $i = 7;
                            foreach ($arror as $key => $value) {
                                $i = $i + 1;
                                $sheet->row($i, [$value['tipodoc'], $value['num_doc'], $value['nombre'], $value['programa']]);
                            }
                        });
                    })->download('xlsx');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function cancelarmateria() {
        $unds = Unidad::where('regional', '1')->pluck('nombre', 'id');
        return view('reportes.matricula.cancelarmateria')
                        ->with('location', 'reportes')
                        ->with('unds', $unds);
    }

    public function cancelarmateria_pdf($und, $per) {
        $can = Cancelacionmateria::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
        if (count($can) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($can as $c) {
                $pern = $c->estudiantepensum->estudiante->personanatural;
                $o = null;
                $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                $o['num_doc'] = $pern->persona->numero_documento;
                $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                $o['materia'] = $c->materia->nombre;
                $o['programa'] = $c->estudiantepensum->programaunidad->programa->nombre;
                $o['fecha'] = $c->fechacancelacion;
                $o['tipo'] = $c->tipocancelacion;
                $o['objeto'] = $c->objetocancelacion->descripcion;
                $response[] = $o;
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                    ];
                    $cabeceras = ['Tipo de Documento', 'Número', 'Nombre', 'Materia', 'Programa', 'Fecha de Cancelación', 'Tipo de Cancelación', 'Objeto de Cancelación'];
                    $filtros = [
                        'PERIODO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fecha;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $arror;
                    $date['nivel'] = 1;
                    $date['titulo'] = "REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE CANCELACIÓN DE MATERIAS";
                    $date['filtros'] = $filtros;
                    $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                    return $pdf->stream('reporte.pdf');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function cancelarmateria_excel($und, $per) {
        $can = Cancelacionmateria::where([['unidad_id', $und], ['periodoacademico_id', $per]])->get();
        if (count($can) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($can as $c) {
                $pern = $c->estudiantepensum->estudiante->personanatural;
                $o = null;
                $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                $o['num_doc'] = $pern->persona->numero_documento;
                $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                $o['materia'] = $c->materia->nombre;
                $o['programa'] = $c->estudiantepensum->programaunidad->programa->nombre;
                $o['fecha'] = $c->fechacancelacion;
                $o['tipo'] = $c->tipocancelacion;
                $o['objeto'] = $c->objetocancelacion->descripcion;
                $response[] = $o;
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                    ];
                    $cabeceras = ['Tipo de Documento', 'Número', 'Nombre', 'Materia', 'Programa', 'Fecha de Cancelación', 'Tipo de Cancelación', 'Objeto de Cancelación'];
                    $filtros = [
                        'PERIODO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    Excel::create('matacademica_cancelacionmateria', function ($excel) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                        $excel->sheet('Reporte', function ($sheet) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                            $sheet->row(1, ["REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE CANCELACIÓN DE MATERIAS"]);
                            $sheet->row(2, ["FECHA REPORTE: " . $fecha]);
                            $sheet->row(3, "");
                            $sheet->row(4, $encabezado);
                            $sheet->row(5, $filtros);
                            $sheet->row(6, "");
                            $sheet->row(7, $cabeceras);
                            $i = 7;
                            foreach ($arror as $key => $value) {
                                $i = $i + 1;
                                $sheet->row($i, [$value['tipodoc'], $value['num_doc'], $value['nombre'], $value['materia'], $value['programa'], $value['fecha'], $value['tipo'], $value['objeto']]);
                            }
                        });
                    })->download('xlsx');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function ofertamateria() {
        $unds = Unidad::where('regional', '1')->pluck('nombre', 'id');
        return view('reportes.matricula.ofertamateria')
                        ->with('location', 'reportes')
                        ->with('unds', $unds);
    }

    public function ofertamateria_pdf($und, $per) {
        $gr = Grupo::where([['unidad_id', $und], ['periodoacademico_id', $per], ['activo', '1']])->get();
        if (count($gr) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($gr as $g) {
                $mate = $g->materia_codigomateria;
                if (!$this->buscar($response, $mate)) {
                    $prog = "";
                    $pem = Pensummateria::where([['materia_codigomateria', $mate]])->get();
                    if (count($pem) > 0) {
                        if (strlen($prog) > 1) {
                            foreach ($pem as $pe) {
                                $prog = $prog . "," . $pe->programa->nombre;
                            }
                        } else {
                            $prog = $pem[0]->programa->nombre;
                        }
                    }
                    $response[$mate]['codigo'] = $g->materia_codigomateria;
                    $response[$mate]['nombre'] = $g->materia->nombre;
                    $response[$mate]['credito'] = $g->materia->ponderacionacademica;
                    $response[$mate]['programa'] = $prog;
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                    ];
                    $cabeceras = ['Codigo', 'Nombre', 'Creditos', 'Programas'];
                    $filtros = [
                        'PERIODO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fecha;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $response;
                    $date['nivel'] = 1;
                    $date['titulo'] = "REPORTES DE MATRÍCULA ACADÉMICA - OFERTA DE MATERIAS";
                    $date['filtros'] = $filtros;
                    $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                    return $pdf->stream('reporte.pdf');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function ofertamateria_excel($und, $per) {
        $gr = Grupo::where([['unidad_id', $und], ['periodoacademico_id', $per], ['activo', '1']])->get();
        if (count($gr) > 0) {
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($gr as $g) {
                $mate = $g->materia_codigomateria;
                if (!$this->buscar($response, $mate)) {
                    $prog = "";
                    $pem = Pensummateria::where([['materia_codigomateria', $mate]])->get();
                    if (count($pem) > 0) {
                        if (strlen($prog) > 1) {
                            foreach ($pem as $pe) {
                                $prog = $prog . "," . $pe->programa->nombre;
                            }
                        } else {
                            $prog = $pem[0]->programa->nombre;
                        }
                    }
                    $response[$mate]['codigo'] = $g->materia_codigomateria;
                    $response[$mate]['nombre'] = $g->materia->nombre;
                    $response[$mate]['credito'] = $g->materia->ponderacionacademica;
                    $response[$mate]['programa'] = $prog;
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                    ];
                    $cabeceras = ['Codigo', 'Nombre', 'Creditos', 'Programas'];
                    $filtros = [
                        'PERIODO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    Excel::create('matacademica_ofertamateria', function ($excel) use ($response, $cabeceras, $encabezado, $fecha, $filtros) {
                        $excel->sheet('Reporte', function ($sheet) use ($response, $cabeceras, $encabezado, $fecha, $filtros) {
                            $sheet->row(1, ["REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE OFERTAS DE MATERIAS"]);
                            $sheet->row(2, ["FECHA REPORTE: " . $fecha]);
                            $sheet->row(3, "");
                            $sheet->row(4, $encabezado);
                            $sheet->row(5, $filtros);
                            $sheet->row(6, "");
                            $sheet->row(7, $cabeceras);
                            $i = 7;
                            foreach ($response as $key => $value) {
                                $i = $i + 1;
                                $sheet->row($i, [$value['codigo'], $value['nombre'], $value['credito'], $value['programa']]);
                            }
                        });
                    })->download('xlsx');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function estudiantexdocente() {
        $unds = Unidad::where('regional', '1')->pluck('nombre', 'id');
        $du = Docenteunidad::all();
        $docentes = null;
        if (count($du) > 0) {
            foreach ($du as $d) {
                $o = null;
                if ($d->docenteacademico !== null) {
                    $pn = Personanatural::where('persona_id', $d->docenteacademico->pege)->first();
                    if ($pn !== null) {
                        $o['identi'] = $pn->persona->numero_documento;
                        $o['tipodoc'] = $pn->persona->tipodoc->abreviatura;
                        $o['nombres'] = $pn->primer_nombre . " " . $pn->segundo_nombre . " " . $pn->primer_apellido . " " . $pn->segundo_apellido;
                        $o['dv'] = $d->documentovinculacion->norma->descripcion;
                        $dd = "";
                        if ($d->trabajadorlaborunidad !== null) {
                            $tl = Trabajadorlabor::where('trabajador_pege', $d->trabajadorlaborunidad->trabajadorlabor_pege)->first();
                            if ($tl->dedicaciondocente !== null) {
                                $dd = $tl->dedicaciondocente->descripcion;
                            } else {
                                $dd = "";
                            }
                        }
                        $o['dedicacion'] = $dd;
                        $docentes[$d->id] = $o;
                    }
                }
            }
        }
        return view('reportes.matricula.estudiantexdocente')
                        ->with('location', 'reportes')
                        ->with('unds', $unds)
                        ->with('docentes', $docentes);
    }

    public function estudiantexdocente_pdf($docenteund, $per) {
        $dg = Docentegrupo::where([['docenteunidad_id', $docenteund]])->get();
        if (count($dg) > 0) {
            $du = Docenteunidad::find($docenteund);
            $docente = Personanatural::find($du->docenteacademico_pege);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($dg as $d) {
                if ($d->grupo->periodoacademico_id == $per) {
                    $gm = $d->grupo->grupomatriculados;
                    if ($gm !== null) {
                        foreach ($gm as $g) {
                            $pern = $g->matriculaacademica->estudiantepensum->estudiante->personanatural;
                            $o = null;
                            $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                            $o['num_doc'] = $pern->persona->numero_documento;
                            $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                            $o['materia'] = $d->grupo->materia->nombre;
                            $o['programa'] = $g->matriculaacademica->estudiantepensum->programaunidad->programa->nombre;
                            $response[] = $o;
                        }
                    }
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $du->unidad->nombre,
                        'CIUDAD' => $du->unidad->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                    ];
                    $cabeceras = ['Tipo de Documento', 'Número', 'Nombre', 'Materia', 'Programa'];
                    $filtros = [
                        'PERIODO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'DOCENTE' => $docente->primer_apellido . " " . $docente->segundo_apellido . " " . $docente->primer_nombre . " " . $docente->segundo_apellido,
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fecha;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $arror;
                    $date['nivel'] = 1;
                    $date['titulo'] = "REPORTES DE MATRÍCULA ACADÉMICA - LISTADOS DE ESTUDIANTES POR DOCENTE";
                    $date['filtros'] = $filtros;
                    $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                    return $pdf->stream('reporte.pdf');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function estudiantexdocente_excel($docenteund, $per) {
        $dg = Docentegrupo::where([['docenteunidad_id', $docenteund]])->get();
        if (count($dg) > 0) {
            $du = Docenteunidad::find($docenteund);
            $docente = Personanatural::find($du->docenteacademico_pege);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($dg as $d) {
                if ($d->grupo->periodoacademico_id == $per) {
                    $gm = $d->grupo->grupomatriculados;
                    if ($gm !== null) {
                        foreach ($gm as $g) {
                            $pern = $g->matriculaacademica->estudiantepensum->estudiante->personanatural;
                            $o = null;
                            $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                            $o['num_doc'] = $pern->persona->numero_documento;
                            $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                            $o['materia'] = $d->grupo->materia->nombre;
                            $o['programa'] = $g->matriculaacademica->estudiantepensum->programaunidad->programa->nombre;
                            $response[] = $o;
                        }
                    }
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $du->unidad->nombre,
                        'CIUDAD' => $du->unidad->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                    ];
                    $cabeceras = ['Tipo de Documento', 'Número', 'Nombre', 'Materia', 'Programa'];
                    $filtros = [
                        'PERIODO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'DOCENTE' => $docente->primer_apellido . " " . $docente->segundo_apellido . " " . $docente->primer_nombre . " " . $docente->segundo_apellido,
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    Excel::create('matacademica_estudiantesxdocentes', function ($excel) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                        $excel->sheet('Reporte', function ($sheet) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                            $sheet->row(1, ["REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE ESTUDIANTES POR DOCENTES"]);
                            $sheet->row(2, ["FECHA REPORTE: " . $fecha]);
                            $sheet->row(3, "");
                            $sheet->row(4, $encabezado);
                            $sheet->row(5, $filtros);
                            $sheet->row(6, "");
                            $sheet->row(7, $cabeceras);
                            $i = 7;
                            foreach ($arror as $key => $value) {
                                $i = $i + 1;
                                $sheet->row($i, [$value['tipodoc'], $value['num_doc'], $value['nombre'], $value['materia'], $value['programa']]);
                            }
                        });
                    })->download('xlsx');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function matxmateria() {
        $unds = Unidad::where('regional', '1')->pluck('nombre', 'id');
        $materias = Materia::all();
        return view('reportes.matricula.matxmateria')
                        ->with('location', 'reportes')
                        ->with('unds', $unds)
                        ->with('materias', $materias);
    }

    public function matxmateria_pdf($cod, $per, $und) {
        $gr = Grupo::where([['materia_codigomateria', $cod], ['periodoacademico_id', $per]])->get();
        if (count($gr) > 0) {
            $mat = Materia::find($cod);
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            foreach ($gr as $g) {
                $gmat = $g->grupomatriculados;
                if (count($gmat) > 0) {
                    foreach ($gmat as $gma) {
                        $pern = $gma->matriculaacademica->estudiantepensum->estudiante->personanatural;
                        $o = null;
                        $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                        $o['num_doc'] = $pern->persona->numero_documento;
                        $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                        $o['situacion'] = $gma->matriculaacademica->estudiantepensum->situacionestudiante->descripcion;
                        $o['programa'] = $gma->matriculaacademica->estudiantepensum->programaunidad->programa->nombre;
                        $response[] = $o;
                    }
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                    ];
                    $cabeceras = ['Tipo de Documento', 'Número', 'Nombre', 'Situación', 'Programa'];
                    $filtros = [
                        'PERIODO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'MATERIA' => $mat->nombre,
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fecha;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $arror;
                    $date['nivel'] = 1;
                    $date['titulo'] = "REPORTES DE MATRÍCULA ACADÉMICA - LISTADOS DE MATRICULADO POR MATERIA";
                    $date['filtros'] = $filtros;
                    $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                    return $pdf->stream('reporte.pdf');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function matxmateria_excel($cod, $per, $und) {
        $gr = Grupo::where([['materia_codigomateria', $cod], ['periodoacademico_id', $per]])->get();
        if (count($gr) > 0) {
            $mat = Materia::find($cod);
            $u = Unidad::find($und);
            $p = Periodoacademico::find($per);
            $response = null;
            $u = null;
            foreach ($gr as $g) {
                $gmat = $gr->grupomatriculados;
                if ($gmat !== null) {
                    foreach ($gmat as $gma) {
                        $u = Unidad::find($gma->matriculaacademica->unidad->id);
                        $pern = $gma->matriculaacademica->estudiantepensum->estudiante->personanatural;
                        $o = null;
                        $o['tipodoc'] = $pern->persona->tipodoc->abreviatura;
                        $o['num_doc'] = $pern->persona->numero_documento;
                        $o['nombre'] = $pern->primer_apellido . " " . $pern->segundo_apellido . " " . $pern->primer_nombre . " " . $pern->segundo_apellido;
                        $o['situacion'] = $gma->matriculaacademica->estudiantepensum->situacionestudiante->descripcion;
                        $o['programa'] = $gma->matriculaacademica->estudiantepensum->programaunidad->programa->nombre;
                        $response[] = $o;
                    }
                }
            }
            if ($response !== null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'nombre', false);
                    $encabezado = [
                        'UNIDAD REGIONAL' => $u->nombre,
                        'CIUDAD' => $u->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                    ];
                    $cabeceras = ['Tipo de Documento', 'Número', 'Nombre', 'Situación', 'Programa'];
                    $filtros = [
                        'PERIODO' => $p->anio . " - " . $p->periodo . " => " . $p->TipoPeriodo->descripcion,
                        'MATERIA' => $mat->nombre,
                    ];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    Excel::create('matacademica_matxmaterias', function ($excel) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                        $excel->sheet('Reporte', function ($sheet) use ($arror, $cabeceras, $encabezado, $fecha, $filtros) {
                            $sheet->row(1, ["REPORTES DE MATRÍCULA ACADÉMICA - LISTADO DE ESTUDIANTES POR DOCENTES"]);
                            $sheet->row(2, ["FECHA REPORTE: " . $fecha]);
                            $sheet->row(3, "");
                            $sheet->row(4, $encabezado);
                            $sheet->row(5, $filtros);
                            $sheet->row(6, "");
                            $sheet->row(7, $cabeceras);
                            $i = 7;
                            foreach ($arror as $key => $value) {
                                $i = $i + 1;
                                $sheet->row($i, [$value['tipodoc'], $value['num_doc'], $value['nombre'], $value['situacion'], $value['programa']]);
                            }
                        });
                    })->download('xlsx');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }
    
    public function hojadevida_estudiante() {
        $tu = TipoUnidad::all()->pluck('descripcion', 'id');
        $met = Metodologia::all()->pluck('nombre', 'id');
        $ne = NivelEducativo::all()->pluck('descripcion', 'id');
        return view('reportes.matricula.hojavidaest')
                        ->with('location', 'reportes')
                        ->with('tu', $tu)
                        ->with('met', $met)
                        ->with('ne', $ne);
    }

    public function hojadevida_estudiante_pdf($estpen) {
        $estpensum = Estudiantepensum::find($estpen);
        if ($estpensum !== null) {
            $response = null;
            $est = $estpensum->estudiante;
            $perna = $est->personanatural;
            $per = $perna->persona;
            $response['nombre'] = $perna->primer_nombre . " " . $perna->segundo_nombre . " " . $perna->primer_apellido ." ". $perna->segundo_apellido;
            $response['identificacion'] = $per->tipodoc->abreviatura . " - " . $per->numero_documento;
            $response['lugar_expedicion'] = $per->lugar_expedicion;
            $response['fecha_expedicion'] = $per->fecha_expedicion;
            $response['libreta'] = $perna->libreta_militar;
            $response['distrito'] = $perna->distrito_militar;
            $response['estadocivil'] = $perna->estadocivil->descripcion;
            $response['rh'] = $perna->rh;
            $response['sexo'] = $perna->sexo;
            if($perna->religion_id !== null && $perna->religion_id !== 0){
            $response['religion'] = $perna->religion->descripcion;
            }else{
                $response['religion'] = "";
            }
            $response['fecha_nacimiento'] = $perna->fecha_nacimiento;
            $response['paisn'] = $per->pais->nombre;
            if($per->ciudad_id !== null){
            $response['departamenton'] = $per->ciudad->estado->nombre;
            $response['ciudadn'] = $per->ciudad->nombre;
            }else{
                 $response['departamenton'] = "";
                 $response['ciudadn'] = "";
            }
            $response['direccion'] = $per->direccion;
            if ($per->pais2_id !== null) {
                $p = Pais::find($per->pais2_id);
                $response['paisu'] = $p->nombre;
            } else {
                $response['paisu'] = "";
            }
            if ($per->ciudad2_id !== null) {
                $c = Ciudad::find($per->ciudad2_id);
                $response['departamento'] = $c->estado->nombre;
                $response['ciudadu'] = $c->nombre;
            } else {
                $response['departamento'] = "";
                $response['ciudadu'] = "";
            }
            $response['telefono'] = $per->telefono;
            $response['celular'] = $per->celular;
            $response['email'] = $per->mail;
            $response['email_institucional'] = $perna->email_institucional;
            $response['num_pasaporte'] = $perna->numero_pasaporte;
            $response['otra_nacionalidad'] = $perna->otra_nacionalidad;
            $grupofam = $est->grupofamiliarests;
            $grupo = null;
            if (count($grupofam) > 0) {
                foreach ($grupofam as $gf) {
                    $a = null;
                    $a['nombrec'] = $gf->nombrecompleto;
                    $a['vive'] = $gf->vive;
                    $a['ocupacion'] = $gf->ocupacion;
                    $a['niveleducativo'] = $gf->niveleducativo;
                    $a['direccion'] = $gf->direccion;
                    $a['ciudad'] = $gf->ciudad;
                    $a['sitio'] = $gf->sitiotrabajoestudio;
                    $a['edad'] = $gf->edad;
                    if($gf->tipodoc_id !== null){
                    $a['cedula'] = $gf->tipodoc->abreviatura . " - " . $gf->cedula;
                    }else{
                        $a['cedula'] = "";
                    }
                    $a['ingreso'] = $gf->ingresomensula;
                    $a['telefonoresidencia'] = $gf->telefonoresidencia;
                    $a['nombreinstestudio'] = $gf->nombreinstestudio;
                    $a['celular'] = $gf->celular;
                    $a['cargo'] = $gf->cargo;
                    $a['ingresorango'] = $gf->ingresomensual_rango;
                    $a['ciudadresidencia'] = $gf->ciudadresidencia;
                    $a['paistrabajo'] = $gf->paistrabajo;
                    $a['profesion'] = $gf->profesion;
                    $a['direccionempresa'] = $gf->direccionempresa;
                    $a['lee'] = $gf->lee;
                    if($gf->parentesco_id !== null){
                    $a['parentesco'] = $gf->parentesco->descripcion;
                    }else{
                        $a['parentesco'] = "";
                    }
                    $grupo[] = $a;
                }
            }
            $response['grupofamiliar'] = $grupo;
            $jefes = Jefefamiliaest::where('estudiante_id', $est->id)->get();
            $jefesfam = null;
            if (count($jefes) > 0) {
                foreach ($jefes as $j) {
                    $o = null;
                    $o['cedula'] = "CC - " . $j->cedula;
                    $o['nombrej'] = $j->nombre;
                    $o['cargo'] = $j->cargo;
                    $o['empresa'] = $j->empresa;
                    $o['tiemposervicio'] = $j->tiemposervicio;
                    $o['teltrabajo'] = $j->teltrabajo;
                    $o['jefeinmediato'] = $j->jefeinmediato;
                    $o['dirempresa'] = $j->dirempresa;
                    $o['ciudad'] = $j->ciudad;
                    $o['sueldo'] = $j->sueldo;
                    $o['numpersonascargo'] = $j->numpersonascargo;
                    if ($j->eljefedefamiliaeselpadre == 1) {
                        $o['jefe'] = 'PADRE';
                    } else if ($j->eljefedefamiliaeselpadre == 2) {
                        $o['jefe'] = 'MADRE';
                    } else {
                        $o['jefe'] = 'NINGUNO';
                    }
                    $o['celular'] = $j->celular;
                    if ($j->parentesco_id !== null) {
                        $p = Parentesco::find($j->parentesco_id);
                        $o['parentesco'] = $p->descripcion;
                    } else {
                        $o['parentesco'] = "";
                    }
                    if ($j->ocupacionlaboral_id !== null) {
                        $ocu = Ocupacionlaboral::find($j->ocupacionlaboral_id);
                        $o['ocupacion'] = $ocu->descripcion;
                    } else {
                        $o['ocupacion'] = "";
                    }
                    $o['niveleducativo'] = $j->niveleducativo;
                    $o['ingresos'] = $j->ingresos;
                    $o['costeaestudios'] = $j->costeaestudios;
                    $jefesfam[] = $o;
                }
            }
            $response['jefesfamilia'] = $jefesfam;
            $idioma = $est->idiomasestudiantes;
            $idiomas = null;
            if (count($idioma) > 0) {
                foreach ($idioma as $i) {
                    $a = null;
                    $a['idioma'] = $i->idioma->descripcion;
                    $a['lee'] = $i->lee;
                    $a['escribe'] = $i->escribe;
                    $a['habla'] = $i->habla;
                    $a['oir'] = $i->oir;
                    $idiomas[] = $a;
                }
            }
            $response['idiomas'] = $idiomas;
            $pasat = $est->pasatiemposestudiantes;
            $pasatiempos = null;
            if (count($pasat) > 0) {
                foreach ($pasat as $pa) {
                    $p = null;
                    $p['pasatiempo'] = $pa->pasatiempo->descripcion;
                    $pasatiempos[] = $p;
                }
            }
            $response['pasatiempos'] = $pasatiempos;
            $estudiossecun = $est->estudiossecundariosests;
            $secundarios = null;
            if (count($estudiossecun) > 0) {
                foreach ($estudiossecun as $es) {
                    $e = null;
                    $e['tituloobtenido'] = $es->tituloobtenido;
                    $e['enfasis_mod_sec'] = $es->enfasis_mod_sec;
                    $e['codigo_snp'] = $es->codigo_snp;
                    if ($es->pais !== null) {
                        $p = Pais::find($es->pais);
                        $e['pais'] = $p->nombre;
                    } else {
                        $e['pais'] = "";
                    }
                    $e['fechaterminacion'] = $es->fechaterminacion;
                    $e['valorpension10'] = $es->valorpension10;
                    $e['valorpension11'] = $es->valorpension11;
                    $e['formaobtuvotitulo'] = $es->formaobtuvotitulo;
                    $e['snp'] = $es->snp;
                    $e['tipoprueba'] = $es->tipoprueba;
                    $e['puntajeobtenido'] = $es->puntajeobtenido;
                    if ($es->ciudadpresentoprueba !== null) {
                        $c = Ciudad::find($es->ciudadpresentoprueba);
                        $e['ciudadpresentoprueba'] = $c->nombre;
                    } else {
                        $e['ciudadpresentoprueba'] = "";
                    }
                    $e['fechapresentoprueba'] = $es->fechapresentoprueba;
                    $e['caracter_colegio'] = $es->caracter_colegio;
                    $e['libro'] = $es->libro;
                    $e['folio'] = $es->folio;
                    $secundarios[] = $e;
                }
            }
            $response['secundarios'] = $secundarios;
            $univer = $est->estudiosuniversitariosests;
            $universitarios = null;
            if (count($univer) > 0) {
                foreach ($univer as $un) {
                    $u = null;
                    $u['programa'] = $un->programa;
                    $u['codigosnp'] = $un->codigosnp;
                    $u['periodoscursados'] = $un->periodoscursados;
                    $u['fechaterminacion'] = $un->fechaterminacion;
                    $u['tarjetaprofesional'] = $un->tarjetaprofesional;
                    $u['puntajeecaes'] = $un->puntajeecaes;
                    $u['registroecaes'] = $un->registroecaes;
                    if ($un->ciudad !== null) {
                        $c = Ciudad::find($un->ciudad);
                        $u['ciudad'] = $c->nombre;
                    } else {
                        $u['ciudad'] = "";
                    }
                    $universitarios[] = $un;
                }
            }
            $response['universitarios'] = $universitarios;
            $post = $est->estudiospostgradoests;
            $postgrados = null;
            if (count($post) > 0) {
                foreach ($post as $po) {
                    $p = null;
                    $p['programa'] = $po->programa;
                    $p['codigosnp'] = $po->codigosnp;
                    $p['fechaterminacion'] = $po->fechaterminacion;
                    if ($po->ciudad !== null) {
                        $c = Ciudad::find($po->ciudad);
                        $p['ciudad'] = $c->nombre;
                    } else {
                        $p['ciudad'] = "";
                    }
                    if ($po->pais !== null) {
                        $pai = Pais::find($po->pais);
                        $p['pais'] = $pai->nombre;
                    } else {
                        $p['pais'] = "";
                    }
                    $postgrados[] = $p;
                }
            }
            $response['postgrados'] = $postgrados;
            $docente = $est->experienciadocenteests;
            $expdocente = null;
            if (count($docente) > 0) {
                foreach ($docente as $exp) {
                    $e = null;
                    $e['institucion'] = $exp->institucion;
                    $e['nivel'] = $exp->nivel;
                    $e['area'] = $exp->area;
                    $e['tiemposervicio'] = $exp->tiemposervicio;
                    $expdocente[] = $e;
                }
            }
            $response['expdocente'] = $expdocente;
            $investigacion = $est->experienciainvestigacionests;
            $expinvestigacion = null;
            if (count($investigacion) > 0) {
                foreach ($investigacion as $in) {
                    $i = null;
                    $i['institucion'] = $i->institucion;
                    $i['proyecto'] = $i->proyecto;
                    $i['cargo'] = $i->cargo;
                    $i['anio'] = $i->anio;
                    $expinvestigacion[] = $i;
                }
            }
            $response['expinvestigacion'] = $expinvestigacion;
            $posres = Posesionresidenciaest::where('estudiante_id', $est->id)->get();
            $residencia = null;
            if (count($posres) > 0) {
                foreach ($posres as $po) {
                    $r = null;
                    $r['tipoposesion'] = $po->tipoposesion;
                    $r['valormensual'] = $po->vrmensualcuota;
                    $r['numcredito'] = $po->numcredito;
                    $r['dirhipotecado'] = $po->dirmueblehipotecado;
                    $r['vrmensualarriendo'] = $po->vrmensualarriendo;
                    $r['direccarrendador'] = $po->direccarrendador;
                    $r['telarrendador'] = $po->telarrendador;
                    $r['deudavivienda'] = $po->deudavivienda;
                    $residencia[] = $r;
                }
            }
            $response['posesionresidencia'] = $residencia;
            $publi = $est->publicacionests;
            $publicaciones = null;
            if (count($publi) > 0) {
                foreach ($publi as $pu) {
                    $p = null;
                    $p['nombre'] = $pu->nombre;
                    $p['tipoobra'] = $pu->tipoobra;
                    $p['anio'] = $pu->anio;
                    $p['entidaduspiciadora'] = $pu->entidaduspiciadora;
                    $publicaciones[] = $pu;
                }
            }
            $response['publicaciones'] = $publicaciones;
            $refe = $est->referenciaacademicaests;
            $referencias = null;
            if (count($refe) > 0) {
                foreach ($refe as $re) {
                    $r = null;
                    $r['nombre'] = $re->nombre;
                    $r['direccion'] = $re->direccion;
                    $r['telefono'] = $re->telefono;
                    $referencias[] = $re;
                }
            }
            $response['referencias'] = $referencias;
            $cur = $est->cursorealizadoests;
            $cursos = null;
            if (count($cur) > 0) {
                foreach ($cur as $cu) {
                    $c = null;
                    $c['titulo'] = $cu->titulo;
                    $c['institucion'] = $cu->institucion;
                    $c['fechaterminacion'] = $cu->fechaterminacion;
                    $c['duracion'] = $cu->duracion;
                    $cursos[] = $cu;
                }
            }
            $response['cursos'] = $cursos;
            $inf = $est->informacionfinancieraest;
            $informacion = null;
            if ($inf !== null) {
                $f = null;
                if ($i->situacionpadres !== null) {
                    $f['situacionpadres'] = $i->situacionpadres;
                } else {
                    $f['situacionpadres'] = "";
                }
                $f['numerofamiliares'] = $i->numerofamiliares;
                $f['numeromiembrostrabaja'] = $i->numeromiembrostrabaja;
                $f['ingresomensualfamilia'] = $i->ingresomensualfamilia;
                $f['egresomensualfamilia'] = $i->egresomensualfamilia;
                $f['quiencosteaestudios'] = $i->quiencosteaestudios;
                $f['conquienreside'] = $i->conquienreside;
                $f['situacioneconomica'] = $i->situacioneconomica;
                $f['sufragoelecciones'] = $i->sufragoelecciones;
                $f['rentagravable'] = $i->rentagravable;
                if ($i->sisben == 1) {
                    $f['sisben'] = "SI";
                } else {
                    $f['sisben'] = "NO";
                }
                $f['patrimoniogravable'] = $i->patrimoniogravable;
                $f['ingresosnogravables'] = $i->ingresosnogravables;
                $f['ingresoretenciones'] = $i->ingresoretenciones;
                $f['patrimoniobruto'] = $i->patrimoniobruto;
                $f['ingresobruto'] = $i->ingresobruto;
                $f['rentanogravable'] = $i->rentanogravable;
                $f['ingresosgravables'] = $i->ingresosgravables;
                $f['tipoliquidacion'] = $i->tipoliquidacion;
                $f['numhermanosestudiaunivers'] = $i->numhermanosestudiaunivers;
                $f['viveconfamilia'] = $i->viveconfamilia;
                $f['estrato'] = $i->estrato;
                $f['numerohermanos'] = $i->numerohermanos;
                $f['posicionhermanos'] = $i->posicionhermanos;
                $f['hermanosestudiandou'] = $i->hermanosestudiandou;
                $f['cajacompensacion'] = $i->cajacompensacion;
                $f['cajacompcategoria'] = $i->cajacompcategoria;
                $f['nivelsisben'] = $i->nivelsisben;
                $informacion[] = $f;
            }
            $response['financiera'] = $informacion;
            $aso = $est->asociacioncientificaests;
            $asociaciones = null;
            if (count($aso) > 0) {
                foreach ($aso as $as) {
                    $a = null;
                    $a['nombre'] = $as->nombre;
                    $a['objetosocial'] = $as->objetosocial;
                    $a['fechaingreso'] = $as->fechaingreso;
                    $asociaciones[] = $a;
                }
            }
            $response['asociaciones'] = $asociaciones;
            $san = $estpensum->sancions;
            $sanciones = null;
            if (count($san) > 0) {
                foreach ($san as $s) {
                    $sa = null;
                    $sa['fecha'] = $s->fecha;
                    $sa['tipodevigencia'] = $s->tipodevigencia;
                    $sa['numeroperiodos'] = $s->numeroperiodos;
                    $sa['fechainicio'] = $s->fechainicio;
                    $sa['fechatermino'] = $s->fechatermino;
                    $sa['estado'] = $s->estado;
                    $sa['faltareglamento'] = $s->faltareglamento->descripcion;
                    $sa['norma'] = $s->norma;
                    $sa['tiposancion'] = $s->tiposancion->descripcion;
                    $sanciones[] = $sa;
                }
            }
            $response['sanciones'] = $sanciones;
            $infacad['periodocronologico'] = $estpensum->periodocronologico;
            $infacad['fechaingreso'] = $estpensum->fechaingreso;
            $infacad['creditosaprobados'] = $estpensum->creditosaprobados;
            $infacad['codigomatricula'] = $estpensum->codigomatricula;
            $infacad['periodoacademico'] = $estpensum->periodoacademico;
            $infacad['fechavigencianorma'] = $estpensum->fechavigencianorma;
            $infacad['promediogeneral'] = $estpensum->promediogeneral;
            $infacad['promediosemestre'] = $estpensum->promediosemestre;
            $infacad['estado'] = $estpensum->estado;
            $infacad['situacionestudiante'] = $estpensum->situacionestudiante->descripcion;
            $infacad['categoria'] = $estpensum->categoria->descripcion;
            $infacad['pensum'] = $estpensum->pensum->descripcion." - ".$estpensum->pensum->estadopensum->descripcion;
            $infacad['programa'] = $estpensum->programaunidad->programa->nombre;
            $infacad['unidad'] = $estpensum->programaunidad->unidad->nombre;
            $infacad['tipoinscripcion'] = $estpensum->tipoinscripcion->descripcion;
            $peri = Periodoacademico::find($estpensum->periodoacademico_id);
            $infacad['periodoacademico'] = $peri->anio . " - " . $peri->periodo . " -> " . $peri->TipoPeriodo->descripcion;
            $response['academica'] = $infacad;
            if($response !== null){
                $hoy = getdate();
                $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                $response['hoy'] = $fecha;
                $pdf = PDF::loadView('reportes.print_estudiante', $response);
                return $pdf->stream('reporte.pdf');
            }else{
                 return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        }else{
             return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function matriculadosnuevo_numericos() {
        $tu = TipoUnidad::all()->pluck('descripcion', 'id');
        $met = Metodologia::all()->pluck('nombre', 'id');
        $ne = NivelEducativo::all()->pluck('descripcion', 'id');
        return view('reportes.matricula.nuevos')
                        ->with('location', 'reportes')
                        ->with('tu', $tu)
                        ->with('met', $met)
                        ->with('ne', $ne);
    }

    public function matriculadosnuevo_numericos_pdf($pro, $u, $per, $met, $ne, $mod) {
        $mat = Matriculaacademica::where([['periodoacademico_id', $per], ['unidad_id', $u], ['estado', 'ACTIVA']])->get();
        if (count($mat) > 0) {
            $und = Unidad::find($u);
            $per = Periodoacademico::find($per);
            $ne = NivelEducativo::find($ne);
            $me = Metodologia::find($met);
            $mo = Modalidad::find($mod);
            $prog = explode(",", $pro);
            $programas = null;
            foreach ($prog as $p) {
                $progra = explode(";", $p);
                $programas[] = $progra[1];
            }
            $response = null;
            $totales = null;
            foreach ($mat as $m) {
                if ($m->estudiantepensum !== null) {
                    if ($m->estudiantepensum->categoria_id == 2 || $m->estudiantepensum->categoria_id == 3) {
                        if (in_array($m->estudiantepensum->programaunidad_id, $programas)) {
                            if (isset($totales[$m->estudiantepensum->programaunidad_id])) {
                                $totales[$m->estudiantepensum->programaunidad_id] = ['programa' => $m->estudiantepensum->programaunidad->programa->nombre, 'total' => $totales[$m->estudiantepensum->programaunidad_id]['total'] + 1];
                            } else {
                                $totales[$m->estudiantepensum->programaunidad_id] = ['programa' => $m->estudiantepensum->programaunidad->programa->nombre, 'total' => 1];
                            }
                        }
                    }
                }
            }
        }
        if ($totales !== null) {
            if (count($totales) > 0) {
                $total = 0;
                foreach ($totales as $t) {
                    $total = $total + $t['total'];
                }
                $encabezado = [
                    'UNIDAD REGIONAL' => $und->nombre,
                    'CIUDAD' => $und->ciudad->nombre,
                    'PERÍODO ACADÉMICO' => $per->anio . " - " . $per->periodo . " => " . $per->TipoPeriodo->descripcion,
                    'METODOLOGÍA' => $me->nombre,
                    'NIVEL EDUCATIVO' => $ne->descripcion,
                    'MODALIDAD' => $mo->descripcion
                ];
                $cabeceras = ['Programa', 'Totales'];
                $filtros = [
                    'TOTAL MATRICULADOS' => $total
                ];
                $hoy = getdate();
                $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                $date['fecha'] = $fecha;
                $date['encabezado'] = $encabezado;
                $date['cabeceras'] = $cabeceras;
                $date['data'] = $totales;
                $date['nivel'] = 1;
                $date['titulo'] = "REPORTES DE MATRICULA NUMÉRICO - MATRICULADOS PRIMER SEMESTRE";
                $date['filtros'] = $filtros;
                $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                return $pdf->stream('reporte.pdf');
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function matriculados_numericos() {
        $tu = TipoUnidad::all()->pluck('descripcion', 'id');
        $met = Metodologia::all()->pluck('nombre', 'id');
        $ne = NivelEducativo::all()->pluck('descripcion', 'id');
        return view('reportes.matricula.periodos_numerico')
                        ->with('location', 'reportes')
                        ->with('tu', $tu)
                        ->with('met', $met)
                        ->with('ne', $ne);
    }

    public function matriculados_numericos_pdf($pro, $u, $per, $met, $ne, $mod) {
        $mat = Matriculaacademica::where([['periodoacademico_id', $per], ['unidad_id', $u], ['estado', 'ACTIVA']])->get();
        if (count($mat) > 0) {
            $und = Unidad::find($u);
            $per = Periodoacademico::find($per);
            $ne = NivelEducativo::find($ne);
            $me = Metodologia::find($met);
            $mo = Modalidad::find($mod);
            $prog = explode(",", $pro);
            $programas = null;
            foreach ($prog as $p) {
                $progra = explode(";", $p);
                $programas[] = $progra[1];
            }
            $response = null;
            $totales = null;
            foreach ($mat as $m) {
                if ($m->estudiantepensum !== null) {
                    if (in_array($m->estudiantepensum->programaunidad_id, $programas)) {
                        if (isset($totales[$m->estudiantepensum->programaunidad_id])) {
                            $totales[$m->estudiantepensum->programaunidad_id] = ['programa' => $m->estudiantepensum->programaunidad->programa->nombre, 'total' => $totales[$m->estudiantepensum->programaunidad_id]['total'] + 1];
                        } else {
                            $totales[$m->estudiantepensum->programaunidad_id] = ['programa' => $m->estudiantepensum->programaunidad->programa->nombre, 'total' => 1];
                        }
                    }
                }
            }
        }
        if ($totales !== null) {
            if (count($totales) > 0) {
                $total = 0;
                foreach ($totales as $t) {
                    $total = $total + $t['total'];
                }
                $encabezado = [
                    'UNIDAD REGIONAL' => $und->nombre,
                    'CIUDAD' => $und->ciudad->nombre,
                    'PERÍODO ACADÉMICO' => $per->anio . " - " . $per->periodo . " => " . $per->TipoPeriodo->descripcion,
                    'METODOLOGÍA' => $me->nombre,
                    'NIVEL EDUCATIVO' => $ne->descripcion,
                    'MODALIDAD' => $mo->descripcion
                ];
                $cabeceras = ['Programa', 'Totales'];
                $filtros = [
                    'TOTAL MATRICULADOS' => $total
                ];
                $hoy = getdate();
                $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                $date['fecha'] = $fecha;
                $date['encabezado'] = $encabezado;
                $date['cabeceras'] = $cabeceras;
                $date['data'] = $totales;
                $date['nivel'] = 1;
                $date['titulo'] = "REPORTES DE MATRICULA NUMÉRICO - MATRICULADOS PRIMER SEMESTRE";
                $date['filtros'] = $filtros;
                $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                return $pdf->stream('reporte.pdf');
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function buscar($array, $programa) {
        if ($array == null) {
            return false;
        } else {
            foreach ($array as $key => $value) {
                if ($key == $programa) {
                    return true;
                }
            }
        }
        return false;
    }

    public function edad($fecha_nacimiento) {
        $tiempo = strtotime($fecha_nacimiento);
        $ahora = time();
        $edad = ($ahora - $tiempo) / (60 * 60 * 24 * 365.25);
        $edad = floor($edad);
        return $edad;
    }

    function orderMultiDimensionalArray($toOrderArray, $field, $inverse = false) {
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
