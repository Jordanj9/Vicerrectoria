<?php

namespace App\Http\Controllers;

use App\Unidad;
use App\NivelEducativo;
use App\Metodologia;
use App\Modalidad;
use App\Periodoacademico;
use App\Programaunidad;
use App\Liquidacion;
use PDF;
use App\Periodoprogunidad;
use Illuminate\Http\Request;

class RepliquidacionesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $unds = Unidad::where('regional', '1')->pluck('nombre', 'id');
        $ne = NivelEducativo::pluck('descripcion', 'id');
        $metodologias = Metodologia::where('estado', 'ACTIVA')->pluck('nombre', 'id');
        return view('reportes.liquidaciones.list')
                        ->with('location', 'reportes')
                        ->with('unds', $unds)
                        ->with('nivel', $ne)
                        ->with('metodologias', $metodologias);
    }

    /*
     * menu liquidaciones reporte por unidad
     */

    public function menu($u, $p, $met, $mod, $n) {
        $und = Unidad::find($u);
        $per = Periodoacademico::find($p);
        $ne = NivelEducativo::find($n);
        $me = Metodologia::find($met);
        $mo = Modalidad::find($mod);
        return view('reportes.liquidaciones.menu')
                        ->with('location', 'reportes')
                        ->with('u', $und)
                        ->with('ne', $ne)
                        ->with('me', $me)
                        ->with('mo', $mo)
                        ->with('per', $per);
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

    /*
     * reporte inscritos por programa PDF
     */

    public function matriculafinanciera_pdf($u, $per, $met, $mod, $ne) {
        $liq = Liquidacion::where([['unidad_id', $u], ['periodoacademico_id', $per]])->get();
        $und = Unidad::find($u);
        $per = Periodoacademico::find($per);
        if (count($liq) > 0) {
            $response = null;
            $esta = true;
            $total = 0;
            foreach ($liq as $c) {
                $pr = null;
                switch ($c->tipoliquidacion) {
                    case'ASPIRANTE':
                        if (count($c->formularioinscripcion) > 0) {
                            if (count($c->formularioinscripcion->programaxformularios) > 0) {
                                $pr = $c->formularioinscripcion->programaxformularios[0]->programaunidad_id;
                            } else {
                                $pr = "NO";
                            }
                        } else {
                            $pr = "NO";
                        }
                        break;
                    case'TRANSFERENCIAE':
                        $pr = $c->transferenciaexterna->programaunidad_id;
                        break;
                    case'TRANSFERENCIAI':
                        $pr = $c->transferenciainterna->programaunidad_id;
                        break;
                    case'ESTUDIANTE':
                        $pr = $c->estudiantepensum->programaunidad_id;
                        break;
                }
                if ($this->buscar($response, $pr)) {
                    $response[$pr]['totalli'] = $response[$pr]['totalli'] + $c->totalliquidado;
                    $response[$pr]['totalde'] = $response[$pr]['totalde'] + $c->totaldescuento;
                    $response[$pr]['favor'] = $response[$pr]['favor'] + $c->saldofavor;
                    $response[$pr]['contra'] = $response[$pr]['contra'] + $c->saldocontra;
                    $total = $response[$pr]['totalli'] - $response[$pr]['totalde'] - $response[$pr]['favor'] + $response[$pr]['contra'];
                    $response[$pr]['total'] = $total;
                    if ($c->planfinanciacion === null) {
                        $pago = $c->pagoliquidacions;
                        $t = 0;
                        if (count($pago) > 0) {
                            foreach ($pago as $p) {
                                $t = $t + $p->valorpagado;
                            }
                        }
                        $response[$pr]['totalpa'] = $response[$pr]['totalpa'] + $t;
                    } else {
                        $cuota = $c->planfinanciacion->planfcuotas;
                        $t = 0;
                        if (count($cuota) > 0) {
                            foreach ($cuota as $a) {
                                $pagos = $a->pagoliquidacions;
                                if (count($pagos) > 0) {
                                    foreach ($pagos as $i) {
                                        $t = $t + $i->valorpagado;
                                    }
                                }
                            }
                        }
                        $response[$pr]['totalpa'] = $response[$pr]['totalpa'] + $t;
                    }
                } else {
                    $pu = Programaunidad::find($pr);
                    if ($pu !== null) {
                        $response[$pr] = [
                            'nombre' => $pu->programa->nombre,
                            'totalli' => $c->totalliquidado,
                            'totalde' => $c->totaldescuento,
                            'favor' => $c->saldofavor,
                            'contra' => $c->saldocontra,
                            'total' => 0,
                            'totalpa' => 0
                        ];
                        $total = $response[$pr]['totalli'] - $response[$pr]['totalde'] - $response[$pr]['favor'] + $response[$pr]['contra'];
                        $response[$pr]['total'] = $total;
                        if ($c->planfinanciacion === null) {
                            $pago = $c->pagoliquidacions;
                            $t = 0;
                            if (count($pago) > 0) {
                                foreach ($pago as $p) {
                                    $t = $t + $p->valorpagado;
                                }
                            }
                            $response[$pr]['totalpa'] = $response[$pr]['totalpa'] + $t;
                        } else {
                            $cuota = $c->planfinanciacion->planfcuotas;
                            $t = 0;
                            if (count($cuota) > 0) {
                                foreach ($cuota as $a) {
                                    $pagos = $a->pagoliquidacions;
                                    if (count($pagos) > 0) {
                                        foreach ($pagos as $i) {
                                            $t = $t + $i->valorpagado;
                                        }
                                    }
                                }
                            }
                            $response[$pr]['totalpa'] = $response[$pr]['totalpa'] + $t;
                        }
                    }
                }
            }
            if (count($response) > 0) {
                $encabezado = [
                    'UNIDAD REGIONAL' => $und->nombre,
                    'CIUDAD' => $und->ciudad->nombre,
                    'PERÍODO ACADÉMICO' => $per->anio . " - " . $per->periodo . " => " . $per->TipoPeriodo->descripcion,
                ];
                foreach ($response as $key => $r) {
                    $response[$key]['totalli'] = "$ " . $r['totalli'];
                    $response[$key]['totalde'] = "$ " . $r['totalde'];
                    $response[$key]['favor'] = "$ " . $r['favor'];
                    $response[$key]['contra'] = "$ " . $r['contra'];
                    $response[$key]['total'] = "$ " . $r['total'];
                    $response[$key]['totalpa'] = "$ " . $r['totalpa'];
                }
                $cabeceras = ['Nombre', 'Total Liquidado', 'Total Descuentos', 'Saldo a Favor', 'Saldo en Contra', 'Total(TL-TD-SF+SC)', 'Total Pagado'];
                $hoy = getdate();
                $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                $date['fecha'] = $fecha;
                $date['encabezado'] = $encabezado;
                $date['cabeceras'] = $cabeceras;
                $date['data'] = $response;
                $date['nivel'] = 1;
                $date['titulo'] = "REPORTES DE ADMISIÓN - CONSOLIDADO MATRÍCULA FINANCIERA";
                $date['filtros'] = null;
                $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                return $pdf->stream('reporte.pdf');
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    /*
     * reporte liquidacion por unidad
     */

    public function liquidadoxunidad_pdf($u, $pe, $met, $mod, $ne) {
        $ppu = Periodoprogunidad::where([['unidad_id', $u], ['periodoacademico_id', $pe]])->get();
        $und = Unidad::find($u);
        $per = Periodoacademico::find($pe);
        if (count($ppu) > 0) {
            $pu = null;
            foreach ($ppu as $d) {
                $a = $d->programaunidad;
                if ($a->programa->metodologia_id == $met && $a->programa->modalidad_id == $mod) {
                    $pu[$a->id] = $a;
                }
            }
            $liq = Liquidacion::where([['unidad_id', $u], ['periodoacademico_id', $pe]])->get();
            if (count($liq) > 0) {
                $response = null;
                $esta = true;
                $total = $li = $des = $pag = 0;
                foreach ($liq as $c) {
                    $pr = null;
                    switch ($c->tipoliquidacion) {
                        case'ASPIRANTE':
                            if (count($c->formularioinscripcion) > 0) {
                                if (count($c->formularioinscripcion->programaxformularios) > 0) {
                                    $pr = $c->formularioinscripcion->programaxformularios[0]->programaunidad_id;
                                } else {
                                    $pr = "NO";
                                }
                            } else {
                                $pr = "NO";
                            }
                            break;
                        case'TRANSFERENCIAE':
                            $pr = $c->transferenciaexterna->programaunidad_id;
                            break;
                        case'TRANSFERENCIAI':
                            $pr = $c->transferenciainterna->programaunidad_id;
                            break;
                        case'ESTUDIANTE':
                            $pr = $c->estudiantepensum->programaunidad_id;
                            break;
                    }
                    if ($this->buscar($pu, $pr)) {
                        $total = $total + 1;
                        $li = $li + $c->totalliquidado;
                        $des = $des + $c->totaldescuento;
                        if ($c->planfinanciacion === null) {
                            $pago = $c->pagoliquidacions;
                            $t = 0;
                            if (count($pago) > 0) {
                                foreach ($pago as $p) {
                                    $t = $t + $p->valorpagado;
                                }
                            }
                            $pag = $pag + $t;
                        } else {
                            $cuota = $c->planfinanciacion->planfcuotas;
                            $t = 0;
                            if (count($cuota) > 0) {
                                foreach ($cuota as $a) {
                                    $pagos = $a->pagoliquidacions;
                                    if (count($pagos) > 0) {
                                        foreach ($pagos as $i) {
                                            $t = $t + $i->valorpagado;
                                        }
                                    }
                                }
                            }
                            $pag = $pag + $t;
                        }
                    }
                }
                $obj = [0 => $pag, 1 => $li, 2 => $des, 3 => $total];
                $response[] = $obj;
                if (count($response) > 0) {
                    $encabezado = [
                        'UNIDAD REGIONAL' => $und->nombre,
                        'CIUDAD' => $und->ciudad->nombre,
                        'PERÍODO ACADÉMICO' => $per->anio . " - " . $per->periodo . " => " . $per->TipoPeriodo->descripcion,
                    ];
                    foreach ($response as $key => $r) {
                        $response[$key][0] = "$ " . $r[0];
                        $response[$key][1] = "$ " . $r[1];
                        $response[$key][2] = "$ " . $r[2];
                        $response[$key][3] = $r[3];
                    }
                    $cabeceras = ['Total Pagado', 'Total Liquidado', 'Total Descuento', 'Total Estudiantes Verificados'];
                    $hoy = getdate();
                    $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fecha;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $response;
                    $date['nivel'] = 1;
                    $date['titulo'] = "REPORTES DE ADMISIÓN - CONSOLIDADO MATRÍCULA FINANCIERA POR UNIDAD";
                    $date['filtros'] = null;
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
    
    
    /*
     * reporte descuentos por programa PDF
     */

    public function descuentosporprograma_pdf($u, $per, $met, $mod, $ne) {
        $liq = Liquidacion::where([['unidad_id', $u], ['periodoacademico_id', $per]])->get();
        $und = Unidad::find($u);
        $per = Periodoacademico::find($per);
        if (count($liq) > 0) {
            $response = null;
            $esta = true;
            $total = 0;
            foreach ($liq as $c) {
                $pr = null;
                switch ($c->tipoliquidacion) {
                    case'ASPIRANTE':
                        if (count($c->formularioinscripcion) > 0) {
                            if (count($c->formularioinscripcion->programaxformularios) > 0) {
                                $pr = $c->formularioinscripcion->programaxformularios[0]->programaunidad_id;
                            } else {
                                $pr = "NO";
                            }
                        } else {
                            $pr = "NO";
                        }
                        break;
                    case'TRANSFERENCIAE':
                        $pr = $c->transferenciaexterna->programaunidad_id;
                        break;
                    case'TRANSFERENCIAI':
                        $pr = $c->transferenciainterna->programaunidad_id;
                        break;
                    case'ESTUDIANTE':
                        $pr = $c->estudiantepensum->programaunidad_id;
                        break;
                }
                if ($this->buscar($response, $pr)) {
                    $response[$pr]['totalde'] = $response[$pr]['totalde'] + $c->totaldescuento;
                } else {
                    $pu = Programaunidad::find($pr);
                    if ($pu !== null) {
                        $response[$pr] = [
                            'nombre' => $pu->programa->nombre,
                            'totalde' => $c->totaldescuento
                        ];
                    }
                }
            }
            if (count($response) > 0) {
                $encabezado = [
                    'UNIDAD REGIONAL' => $und->nombre,
                    'CIUDAD' => $und->ciudad->nombre,
                    'PERÍODO ACADÉMICO' => $per->anio . " - " . $per->periodo . " => " . $per->TipoPeriodo->descripcion,
                ];
                foreach ($response as $key => $r) {
                    $response[$key]['totalde'] = "$ " . $r['totalde'];
                }
                $cabeceras = ['Nombre', 'Total Descuentos'];
                $hoy = getdate();
                $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                $date['fecha'] = $fecha;
                $date['encabezado'] = $encabezado;
                $date['cabeceras'] = $cabeceras;
                $date['data'] = $response;
                $date['nivel'] = 1;
                $date['titulo'] = "REPORTES DE ADMISIÓN - DESCUENTOS POR PROGRAMA";
                $date['filtros'] = null;
                $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                return $pdf->stream('reporte.pdf');
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

}
