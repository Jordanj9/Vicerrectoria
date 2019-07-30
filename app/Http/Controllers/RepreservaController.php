<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recursogeneral;
use App\Cliente;
use App\Conductor;
use App\Progmantenimiento;
use App\Historicomantrecurso;
use App\Histmantcorrectivo;
use App\Histmantpreventivo;
use App\Reserva;
use App\Detallereserva;
use App\Liquidacionreserva;
use App\Motivonoaprobacion;
use Illuminate\Support\Facades\DB;
use PDF;

class RepreservaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function recursotipo() {
        return view('reserva_recurso.reportes.recursos.portipo')
                        ->with('location', 'reserva-recurso');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function recursoestado() {
        return view('reserva_recurso.reportes.recursos.porestado')
                        ->with('location', 'reserva-recurso');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mantrecurso() {
        return view('reserva_recurso.reportes.mantenimientos.mantrecurso')
                        ->with('location', 'reserva-recurso');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function programados() {
        return view('reserva_recurso.reportes.mantenimientos.programados')
                        ->with('location', 'reserva-recurso');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function preventivo() {
        return view('reserva_recurso.reportes.mantenimientos.preventivo')
                        ->with('location', 'reserva-recurso');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function correctivo() {
        return view('reserva_recurso.reportes.mantenimientos.correctivo')
                        ->with('location', 'reserva-recurso');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reservaxfecha() {
        return view('reserva_recurso.reportes.reservas.porfecha')
                        ->with('location', 'reserva-recurso');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function noaprobadas() {
        return view('reserva_recurso.reportes.reservas.noaprobadas')
                        ->with('location', 'reserva-recurso');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ocupacion() {
        return view('reserva_recurso.reportes.recursos.ocupacion')
                        ->with('location', 'reserva-recurso');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function historicocliente() {
//        $clientes = Cliente::all();
//        $cli = null;
//        if (count($clientes) > 0) {
//            foreach ($clientes as $c) {
//                $cli[$c->identificacion] = $c->nombres . " " . $c->apellidos;
//            }
//        }
//        return view('reserva_recurso.reportes.reservas.porcliente')
//                        ->with('location', 'reserva-recurso')
//                        ->with('cli', $cli);
//    }

    /*
     * reporte Listado de Recursos segun su tipo
     */

    public function recursotipo_pdf($tipo) {
        $rec = null;
        $response = null;
        $cabeceras = null;
        if ($tipo === 'TODOS') {
            $rec = Recursogeneral::all();
            if (count($rec) > 0) {
                foreach ($rec as $r) {
                    $o = null;
                    $o[] = $r->descripcion;
                    $o[] = $r->nombre;
                    $o[] = $r->tipo;
                    $o[] = $r->estado;
                    $o[] = $r->valorxhora;
                    $response[] = $o;
                }
                $cabeceras = ['Descripción', 'Nombre', 'Tipo', 'Estado', 'Valor por Hora'];
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            $rec = Recursogeneral::where('tipo', $tipo)->get();
            if (count($rec) > 0) {
                foreach ($rec as $r) {
                    switch ($r->tipo) {
                        case 'FISICO':
                            $o = null;
                            $o[] = $r->descripcion;
                            $o[] = $r->nombre;
                            $o[] = $r->tipo;
                            $o[] = $r->estado;
                            $o[] = $r->nomenclatura;
                            $o[] = $r->capacidad;
                            $o[] = $r->espaciofisicor->descripcion;
                            $o[] = $r->valorxhora;
                            $response[] = $o;
                            $cabeceras = ['Descripción', 'Nombre', 'Tipo', 'Estado', 'Nomenclatrua', 'Capacidad', 'Espacio Fisico', 'Valor por Hora'];
                            break;
                        case 'TECNOLOGICO':
                            $o = null;
                            $o[] = $r->descripcion;
                            $o[] = $r->nombre;
                            $o[] = $r->tipo;
                            $o[] = $r->estado;
                            $o[] = $r->marca;
                            $o[] = $r->modelo;
                            $o[] = $r->color;
                            $o[] = $r->categoriar->descripcion;
                            $o[] = $r->especiffisicas;
                            $o[] = $r->especiftecnicas;
                            $o[] = $r->valorxhora;
                            $response[] = $o;
                            $cabeceras = ['Descripción', 'Nombre', 'Tipo', 'Estado', 'Marca', 'Modelo', 'Color', 'Categoria', 'Epecificaciones Físicas', 'Especificaciones Tecnicas', 'Valor por Hora'];
                            break;
                        case 'AUTOMOTOR':
                            $o = null;
                            $o[] = $r->descripcion;
                            $o[] = $r->nombre;
                            $o[] = $r->tipo;
                            $o[] = $r->estado;
                            $o[] = $r->marca;
                            $o[] = $r->modelo;
                            $o[] = $r->placa;
                            $o[] = $r->color;
                            $o[] = $r->motor_nro;
                            $o[] = $r->chasis_nro;
                            $o[] = $r->cilindraje;
                            $o[] = $r->clasevehiculo->descripcion;
                            $o[] = $r->fechainiciosoat;
                            $o[] = $r->fechafinsoat;
                            $o[] = $r->empresasoat;
                            $o[] = $r->fechainiciotecno;
                            $o[] = $r->fechafintecno;
                            $o[] = $r->tallertecno;
                            $o[] = $r->especiffisicas;
                            $o[] = $r->especiftecnicas;
                            $o[] = $r->valorxhora;
                            $response[] = $o;
                            $cabeceras = ['Descripción', 'Nombre', 'Tipo', 'Estado', 'Marca', 'Modelo', 'Placa', 'Color', 'Num. de Motor', 'Num. Chasis', 'Cilindraje', 'Clase de Vehiculo', 'Fecha Inicio SOAT',
                                'Fecha Fin SOAT', 'Aseguradora', 'Fecha Inicio Tecnomecanica', 'Fecha Fin Tecnomecanica', 'Taller', 'Epecificaciones Físicas', 'Especificaciones Tecnicas', 'Valor por Hora'];
                            break;
                    }
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        }
        if (count($response) > 0) {
            $filtros = ['TIPO' => $tipo];
            $hoy = getdate();
            $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
            $date['fecha'] = $fecha;
            $date['encabezado'] = null;
            $date['cabeceras'] = $cabeceras;
            $date['data'] = $response;
            $date['nivel'] = 1;
            $date['titulo'] = "REPORTES DE RESERVAS - RECURSOS POR TIPO";
            $date['filtros'] = $filtros;
            $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
            return $pdf->stream('reporte.pdf');
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    /*
     * reporte Listado de Recursos segun su estado
     */

    public function recursoestado_pdf($estado) {
        $rec = Recursogeneral::where('estado', $estado)->get();
        if (count($rec) > 0) {
            $response = null;
            foreach ($rec as $r) {
                $o = null;
                $o[] = $r->descripcion;
                $o[] = $r->nombre;
                $o[] = $r->tipo;
                $o[] = $r->estado;
                $o[] = $r->valorxhora;
                $response[] = $o;
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
        if (count($response) > 0) {
            $cabeceras = ['Descripción', 'Nombre', 'Tipo', 'Estado', 'Valor por Hora'];
            $filtros = ['ESTADO' => $estado];
            $hoy = getdate();
            $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
            $date['fecha'] = $fecha;
            $date['encabezado'] = null;
            $date['cabeceras'] = $cabeceras;
            $date['data'] = $response;
            $date['nivel'] = 1;
            $date['titulo'] = "REPORTES DE RESERVAS - RECURSOS POR ESTADO";
            $date['filtros'] = $filtros;
            $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
            return $pdf->stream('reporte.pdf');
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    /*
     * reporte Listado de Clientes
     */

    public function clientes_pdf() {
        $cli = Cliente::all();
        if (count($cli) > 0) {
            $response = null;
            foreach ($cli as $r) {
                $o = null;
                $o[] = $r->identificacion;
                $o[] = $r->nombres;
                $o[] = $r->apellidos;
                $o[] = $r->telefono;
                $o[] = $r->correo;
                $o[] = $r->direccion;
                $response[] = $o;
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
        if (count($response) > 0) {
            $cabeceras = ['Identificación', 'Nombres', 'Apellidos', 'Telefono', 'Correo', 'Dirección'];
            $hoy = getdate();
            $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
            $date['fecha'] = $fecha;
            $date['encabezado'] = null;
            $date['cabeceras'] = $cabeceras;
            $date['data'] = $response;
            $date['nivel'] = 1;
            $date['titulo'] = "REPORTES DE RESERVAS - LISTADO DE CLIENTES";
            $date['filtros'] = null;
            $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
            return $pdf->stream('reporte.pdf');
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    /*
     * reporte Listado de Conductores
     */

    public function conductores_pdf() {
        $cond = Conductor::all();
        if (count($cond) > 0) {
            $response = null;
            foreach ($cond as $r) {
                $o = null;
                $o[] = $r->identificacion;
                $o[] = $r->nombres . " " . $r->apellidos;
                $o[] = $r->fechanacimiento;
                $o[] = $r->estadocivil;
                $o[] = $r->celular;
                $o[] = $r->direccion;
                $o[] = $r->nombreeps;
                $o[] = $r->nombrearl;
                $o[] = $r->estado;
                $o[] = $r->gruposanguineo . " " . $r->factorrh;
                $response[] = $o;
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
        if (count($response) > 0) {
            $cabeceras = ['Identificación', 'Nombre', 'Fecha de Nacimiento', 'Estado Civil', 'Celular', 'Dirección', 'EPS', 'ARL', 'Estado', 'Grupo Sanguineo'];
            $hoy = getdate();
            $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
            $date['fecha'] = $fecha;
            $date['encabezado'] = null;
            $date['cabeceras'] = $cabeceras;
            $date['data'] = $response;
            $date['nivel'] = 1;
            $date['titulo'] = "REPORTES DE RESERVAS - LISTADO DE CONDUCTORES";
            $date['filtros'] = null;
            $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
            return $pdf->stream('reporte.pdf');
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    /*
     * reporte Listado de Conductores Ocupados
     */

    public function condocupados_pdf() {
        $cond = Conductor::where('estado', 'OCUPADO')->get();
        if (count($cond) > 0) {
            $response = null;
            foreach ($cond as $r) {
                $o = null;
                $o[] = $r->identificacion;
                $o[] = $r->nombres . " " . $r->apellidos;
                $o[] = $r->fechanacimiento;
                $o[] = $r->estadocivil;
                $o[] = $r->celular;
                $o[] = $r->direccion;
                $o[] = $r->nombreeps;
                $o[] = $r->nombrearl;
                $o[] = $r->estado;
                $o[] = $r->gruposanguineo . " " . $r->factorrh;
                $response[] = $o;
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
        if (count($response) > 0) {
            $cabeceras = ['Identificación', 'Nombre', 'Fecha de Nacimiento', 'Estado Civil', 'Celular', 'Dirección', 'EPS', 'ARL', 'Estado', 'Grupo Sanguineo'];
            $hoy = getdate();
            $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
            $date['fecha'] = $fecha;
            $date['encabezado'] = null;
            $date['cabeceras'] = $cabeceras;
            $date['data'] = $response;
            $date['nivel'] = 1;
            $date['titulo'] = "REPORTES DE RESERVAS - LISTADO DE CONDUCTORES OCUPADOS";
            $date['filtros'] = null;
            $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
            return $pdf->stream('reporte.pdf');
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    /*
     * reporte Listado de Conductores Ocupados
     */

    public function conddesocupados_pdf() {
        $c = Conductor::all();
        $cond = null;
        if (count($c) > 0) {
            foreach ($c as $value) {
                if ($value->estado !== 'OCUPADO') {
                    $cond[] = $value;
                }
            }
        }
        if ($cond !== null) {
            $response = null;
            foreach ($cond as $r) {
                $o = null;
                $o[] = $r->identificacion;
                $o[] = $r->nombres . " " . $r->apellidos;
                $o[] = $r->fechanacimiento;
                $o[] = $r->estadocivil;
                $o[] = $r->celular;
                $o[] = $r->direccion;
                $o[] = $r->nombreeps;
                $o[] = $r->nombrearl;
                $o[] = $r->estado;
                $o[] = $r->gruposanguineo . " " . $r->factorrh;
                $response[] = $o;
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
        if (count($response) > 0) {
            $cabeceras = ['Identificación', 'Nombre', 'Fecha de Nacimiento', 'Estado Civil', 'Celular', 'Dirección', 'EPS', 'ARL', 'Estado', 'Grupo Sanguineo'];
            $hoy = getdate();
            $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
            $date['fecha'] = $fecha;
            $date['encabezado'] = null;
            $date['cabeceras'] = $cabeceras;
            $date['data'] = $response;
            $date['nivel'] = 1;
            $date['titulo'] = "REPORTES DE RESERVAS - LISTADO DE CONDUCTORES DESOCUPADOS";
            $date['filtros'] = null;
            $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
            return $pdf->stream('reporte.pdf');
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    public function mantrecurso_pdf($tipo) {
        $rec = Recursogeneral::where('tipo', $tipo)->get();
        if (count($rec) > 0) {
            $response = null;
            foreach ($rec as $r) {
                $mant = Historicomantrecurso::where('recursogeneral_id', $r->id)->get();
                if (count($mant) > 0) {
                    $lmantr = null;
                    foreach ($mant as $m) {
                        $o = null;
                        $o[] = $m->fechainicio;
                        $o[] = $m->fechafin;
                        $o[] = $m->estado;
                        $o[] = $m->causa;
                        $o[] = $m->tratamiento;
                        $o[] = $m->responsable;
                        $lmantr[] = $o;
                    }
                    if ($lmantr !== null) {
                        $response[$r->descripcion] = $lmantr;
                    } else {
                        $response[$r->descripcion] = null;
                    }
                }
            }
            if ($response !== null) {
                $cabeceras = ['Fecha Inicio', 'Fecha Fin', 'Estado', 'Causa', 'Tratamiento', 'Responsable'];
                $filtros = ['TIPO' => $tipo];
                $hoy = getdate();
                $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                $date['fecha'] = $fecha;
                $date['encabezado'] = null;
                $date['cabeceras'] = $cabeceras;
                $date['data'] = $response;
                $date['nivel'] = 2;
                $date['titulo'] = "REPORTES DE RESERVAS - HISTORICO DE MANTENIMIENTOS POR TIPO";
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

    public function programados_pdf($estado) {
        $rec = Recursogeneral::where('tipo', 'AUTOMOTOR')->get();
        if (count($rec) > 0) {
            $response = null;
            foreach ($rec as $r) {
                if ($estado === 'TODOS') {
                    $mant = Progmantenimiento::where('recursogeneral_id', $r->id)->get();
                } else {
                    $mant = Progmantenimiento::where([['recursogeneral_id', $r->id], ['estado', $estado]])->get();
                }
                if (count($mant) > 0) {
                    $lmantr = null;
                    foreach ($mant as $m) {
                        $o = null;
                        $o[] = $m->fechamant;
                        $o[] = $m->descripcion;
                        $o[] = $m->detallestecnicos;
                        $o[] = $m->estado;
                        $lmantr[] = $o;
                    }
                    if ($lmantr !== null) {
                        $response[$r->descripcion] = $lmantr;
                    } else {
                        $response[$r->descripcion] = null;
                    }
                }
            }
            if ($response !== null) {
                $cabeceras = ['Fecha Progamada', 'Descripción', 'Detalles Técnicos', 'Estado'];
                $filtros = ['ESTADO' => $estado];
                $hoy = getdate();
                $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                $date['fecha'] = $fecha;
                $date['encabezado'] = null;
                $date['cabeceras'] = $cabeceras;
                $date['data'] = $response;
                $date['nivel'] = 2;
                $date['titulo'] = "REPORTES DE RESERVAS - MANT. PREVENTIVOS PROGRAMADOS POR ESTADO";
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

    public function preventivo_pdf($estado) {
        $rec = Recursogeneral::where('tipo', 'AUTOMOTOR')->get();
        if (count($rec) > 0) {
            $response = null;
            foreach ($rec as $r) {
                $mant = null;
                if ($estado === 'TODOS') {
                    $mantp = Progmantenimiento::where('recursogeneral_id', $r->id)->get();
                    if (count($mantp) > 0) {
                        foreach ($mantp as $ma) {
                            $mant[] = Histmantpreventivo::where('progmantenimiento_id', $ma->id)->get();
                        }
                    }
                } else {
                    $mantp = Progmantenimiento::where('recursogeneral_id', $r->id)->get();
                    if (count($mantp) > 0) {
                        foreach ($mantp as $ma) {
                            $mant[] = Histmantpreventivo::where([['progmantenimiento_id', $ma->id], ['estado', $estado]])->get();
                        }
                    }
                }
                if ($mant !== null) {
                    $lmantr = null;
                    foreach ($mant as $m) {
                        foreach ($m as $value) {
                            $o = null;
                            $o[] = $value->fechainicio . " - " . $value->fechafin;
                            $o[] = $value->estado;
                            $o[] = $value->responsable;
                            $o[] = "<p>Motor:" . $value->motor . "</p><p>Bateria:" . $value->bateria . "</p><p>Sist. Iluminación:" . $value->sistiluminacion . "</p><p>Frenos:" . $value->frenos . "</p><p>Llantas:" . $value->llantas . "</p><p>Sist. Escape:" . $value->sistescape . "</p><p>Sist. Suspensión:" . $value->sistsuspension . "</p><p>Dirección Hidraulica:" . $value->direccion . "</p><P>Filtros:" . $value->filtros . "</p><p>Aire:" . $value->aire . "</p><p>Aceite:" . $value->aceite . "</p><p>Gasolina:" . $value->gasolina . "</p>";
                            $o[] = $value->otros;
                            $lmantr[] = $o;
                        }
                    }
                    if ($lmantr !== null) {
                        $response[$r->descripcion] = $lmantr;
                    } else {
                        $response[$r->descripcion] = null;
                    }
                }
            }
            if ($response !== null) {
                $cabeceras = ['Fecha Inicio - Fecha Fin', 'Estado', 'Responsable', 'Verificado', 'Otros'];
                $filtros = ['ESTADO' => $estado];
                $hoy = getdate();
                $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                $date['fecha'] = $fecha;
                $date['encabezado'] = null;
                $date['cabeceras'] = $cabeceras;
                $date['data'] = $response;
                $date['nivel'] = 2;
                $date['titulo'] = "REPORTES DE RESERVAS - MANT. PREVENTIVOS POR ESTADO";
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

    public function correctivo_pdf($estado) {
        $rec = Recursogeneral::where('tipo', 'AUTOMOTOR')->get();
        if (count($rec) > 0) {
            $response = null;
            foreach ($rec as $r) {
                if ($estado === 'TODOS') {
                    $mant = Histmantcorrectivo::where('recursogeneral_id', $r->id)->get();
                } else {
                    $mant = Histmantcorrectivo::where([['recursogeneral_id', $r->id], ['estado', $estado]])->get();
                }
                if (count($mant) > 0) {
                    $lmantr = null;
                    foreach ($mant as $m) {
                        $o = null;
                        $o[] = $m->fechainicio;
                        $o[] = $m->fechafin;
                        $o[] = $m->estado;
                        $o[] = $m->novedad;
                        $o[] = $m->tipodanio;
                        $o[] = $m->taller;
                        $o[] = $m->informetecnico;
                        $lmantr[] = $o;
                    }
                    if ($lmantr !== null) {
                        $response[$r->descripcion] = $lmantr;
                    } else {
                        $response[$r->descripcion] = null;
                    }
                }
            }
            if ($response !== null) {
                $cabeceras = ['Fecha Inicio', 'Fecha Fin', 'Estado', 'Novedad', 'Tipo de Daño', 'Talle', 'Informe Técnico'];
                $filtros = ['ESTADO' => $estado];
                $hoy = getdate();
                $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                $date['fecha'] = $fecha;
                $date['encabezado'] = null;
                $date['cabeceras'] = $cabeceras;
                $date['data'] = $response;
                $date['nivel'] = 2;
                $date['titulo'] = "REPORTES DE RESERVAS - MANT. CORRECTIVO POR ESTADO";
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

    public function reservaxfecha_pdf($estado, $fi, $ff) {
        $res = null;
        $response = null;
        $re = DB::table('reservas')->whereBetween('fechainicioreserva', [$fi, $ff])->get();
        if ($re !== null) {
            $dr = null;
            if ($estado == 'TODOS') {
                $l = null;
                foreach ($re as $r) {
                    $dr = Detallereserva::where('reserva_id', $r->id)->get();
                    if (count($dr) > 0) {
                        $cli = Cliente::find($r->cliente_identificacion);
                        $list = null;
                        foreach ($dr as $d) {
                            $o = null;
                            $o[] = $r->fechareserva;
                            $o[] = $r->radicado;
                            $o[] = $r->estado;
                            $o[] = $r->fechainicioreserva . " - " . $r->horainicio[0] . $r->horainicio[1] . ":" . $r->horainicio[2] . $r->horainicio[3];
                            $o[] = $r->fechafinreserva . " - " . $r->horafin[0] . $r->horafin[1] . ":" . $r->horafin[2] . $r->horafin[3];
                            $o[] = $d->recursogeneral->descripcion;
                            $o[] = $d->recursogeneral->tipo;
                            $o[] = "$ " . $d->valortotal;
                            $list[] = $o;
                        }
                        if ($list !== null) {
                            $response[$cli->nombres . " " . $cli->apellidos . "-" . $r->radicado] = $list;
                        } else {
                            $response[$cli->nombres . " " . $cli->apellidos . "-" . $r->radicado] = null;
                        }
                    }
                }
            } else {
                foreach ($re as $r) {
                    if ($r->estado == $estado) {
                        $res[] = $r;
                    }
                }
                if ($res !== null) {
                    foreach ($res as $r) {
                        $dr = Detallereserva::where('reserva_id', $r->id)->get();
                        if (count($dr) > 0) {
                            $cli = Cliente::find($r->cliente_identificacion);
                            $list = null;
                            foreach ($dr as $d) {
                                $o = null;
                                $o[] = $r->fechareserva;
                                $o[] = $r->radicado;
                                $o[] = $r->estado;
                                $o[] = $r->fechainicioreserva . " - " . $r->horainicio[0] . $r->horainicio[1] . ":" . $r->horainicio[2] . $r->horainicio[3];
                                $o[] = $r->fechafinreserva . " - " . $r->horafin[0] . $r->horafin[1] . ":" . $r->horafin[2] . $r->horafin[3];
                                $o[] = $d->recursogeneral->descripcion;
                                $o[] = $d->recursogeneral->tipo;
                                $o[] = "$ " . $d->valortotal;
                                $list[] = $o;
                            }
                            if ($list !== null) {
                                $response[$cli->nombres . " " . $cli->apellidos . "-" . $r->radicado] = $list;
                            } else {
                                $response[$cli->nombres . " " . $cli->apellidos . "-" . $r->radicado] = null;
                            }
                        }
                    }
                }
            }
            if ($response !== null) {
                $cabeceras = ['Fecha de Reserva', 'Radicado', 'Estado', 'Fecha - Hora Inicio', 'Fecha - Hora Fin', 'Recurso', 'Tipo', 'Valor'];
                $filtros = ['ESTADO' => $estado,
                    'FECHA INICIO' => $fi,
                    'FECHA FIN' => $ff
                ];
                $hoy = getdate();
                $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                $date['fecha'] = $fecha;
                $date['encabezado'] = null;
                $date['cabeceras'] = $cabeceras;
                $date['data'] = $response;
                $date['nivel'] = 2;
                $date['titulo'] = "REPORTES DE RESERVAS - RESERVAS POR FECHA Y ESTADO";
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

    public function noaprobadas_pdf($fi, $ff) {
        $re = DB::table('reservas')->whereBetween('fechainicioreserva', [$fi, $ff])->get();
        if (count($re) > 0) {
            foreach ($re as $r) {
                if ($r->estado == 'NO APROBADA') {
                    $mot = Motivonoaprobacion::where('reserva_id', $r->id)->get();
                    if (count($mot) > 0) {
                        $cli = Cliente::find($r->cliente_identificacion);
                        $list = null;
                        foreach ($mot as $m) {
                            $o = null;
                            $o[] = $r->fechareserva;
                            $o[] = $r->radicado;
                            $o[] = $r->estado;
                            $o[] = $r->fechainicioreserva . " - " . $r->horainicio[0] . $r->horainicio[1] . ":" . $r->horainicio[2] . $r->horainicio[3];
                            $o[] = $r->fechafinreserva . " - " . $r->horafin[0] . $r->horafin[1] . ":" . $r->horafin[2] . $r->horafin[3];
                            $o[] = $m->detalles;
                            $o[] = $m->recursos;
                            $list[] = $o;
                        }
                        if ($list !== null) {
                            $response[$cli->nombres . " " . $cli->apellidos . "-" . $r->radicado] = $list;
                        } else {
                            $response[$cli->nombres . " " . $cli->apellidos . "-" . $r->radicado] = null;
                        }
                    }
                }
            }
            if (count($response) > 0) {
                $cabeceras = ['Fecha de Reserva', 'Radicado', 'Estado', 'Fecha - Hora Inicio', 'Fecha - Hora Fin', 'Motivo', 'Recursos NO Aprobados'];
                $filtros = ['ESTADO' => 'NO APROBADA',
                    'FECHA INICIO' => $fi,
                    'FECHA FIN' => $ff
                ];
                $hoy = getdate();
                $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                $date['fecha'] = $fecha;
                $date['encabezado'] = null;
                $date['cabeceras'] = $cabeceras;
                $date['data'] = $response;
                $date['nivel'] = 2;
                $date['titulo'] = "REPORTES DE RESERVAS - RESERVAS POR FECHA NO APROBADA";
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

    public function historicocliente_pdf() {
        $clientes = Cliente::all();
        if (count($clientes) > 0) {
            foreach ($clientes as $c) {
                $res = $c->reservas;
                if (count($res) > 0) {
                    $list = null;
                    foreach ($res as $r) {
                        $a = null;
                        $a[] = $r->fechareserva;
                        $a[] = $r->radicado;
                        $a[] = $r->estado;
                        $a[] = $r->fechainicioreserva . " - " . $r->horainicio[0] . $r->horainicio[1] . ":" . $r->horainicio[2] . $r->horainicio[3] . " / " . $r->fechafinreserva . " - " . $r->horafin[0] . $r->horafin[1] . ":" . $r->horafin[2] . $r->horafin[3];

                        $dr = Detallereserva::where('reserva_id', $r->id)->get();
                        if (count($dr) > 0) {
                            $o = "";
                            foreach ($dr as $d) {
                                $o = $o . "<p>" . $d->recursogeneral->descripcion . "  -  " . $d->recursogeneral->tipo . "</p>";
                            }
                            $a[] = $o;
                        } else {
                            $a[] = "---";
                        }
                        $list[] = $a;
                    }
                    if ($list !== null) {
                        $response[$c->identificacion . " - " . $c->nombres . " " . $c->apellidos] = $list;
                    } else {
                        $response[$c->identificacion . " - " . $c->nombres . " " . $c->apellidos] = null;
                    }
                }
            }
            if (count($response) > 0) {
                $cabeceras = ['Fecha de Reserva', 'Radicado', 'Estado', 'Fecha - Hora Inicio / Fecha - Hora Fin', 'Recursos'];
                $hoy = getdate();
                $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                $date['fecha'] = $fecha;
                $date['encabezado'] = null;
                $date['cabeceras'] = $cabeceras;
                $date['data'] = $response;
                $date['nivel'] = 2;
                $date['titulo'] = "REPORTES DE RESERVAS - HISTÓRICO DE RESERVAS POR CLIENTE";
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

    public function liquidacion_pdf() {
        $clientes = Cliente::all();
        if (count($clientes) > 0) {
            foreach ($clientes as $c) {
                $res = $c->reservas;
                if (count($res) > 0) {
                    $list = null;
                    foreach ($res as $r) {
                        $a = null;
                        $a[] = $r->fechareserva;
                        $a[] = $r->radicado;
                        $a[] = $r->estado;
                        $a[] = $r->fechainicioreserva . " - " . $r->horainicio[0] . $r->horainicio[1] . ":" . $r->horainicio[2] . $r->horainicio[3] . " / " . $r->fechafinreserva . " - " . $r->horafin[0] . $r->horafin[1] . ":" . $r->horafin[2] . $r->horafin[3];
                        $liq = Liquidacionreserva::where('reserva_id', $r->id)->get();
                        if (count($liq) > 0) {
                            foreach ($liq as $d) {
                                //$o = null;
                                $a[] = $d->referenciapago;
                                $a[] = $d->fechapago;
                                $a[] = $d->banco;
                                $a[] = $d->fechalimite;
                                $a[] = $d->estado;
                                $a[] = "$ " . $d->total;
                            }
                        }
                        $list[] = $a;
                    }
                    if ($list !== null) {
                        $response[$c->identificacion . " - " . $c->nombres . " " . $c->apellidos] = $list;
                    } else {
                        $response[$c->identificacion . " - " . $c->nombres . " " . $c->apellidos] = null;
                    }
                }
            }
            if (count($response) > 0) {
                $cabeceras = ['Fecha de Reserva', 'Radicado', 'Estado Reserva', 'Fecha - Hora Inicio / Fecha - Hora Fin', 'Referencia de Pago', 'Fecha de Pago', 'Banco - Cuenta', 'Fecha Limite', 'Estado Liquidación', 'Total'];
                $hoy = getdate();
                $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                $date['fecha'] = $fecha;
                $date['encabezado'] = null;
                $date['cabeceras'] = $cabeceras;
                $date['data'] = $response;
                $date['nivel'] = 2;
                $date['titulo'] = "REPORTES DE RESERVAS - HISTÓRICO LIQUIDACIONES";
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

    public function ocupacion_pdf($estado) {
        $rec = Recursogeneral::where('estado', 'ACTIVO')->get();
        $response = null;
        if (count($rec) > 0) {
            if ($estado === 'DISPONIBLE') {
                foreach ($rec as $r) {
                    if ($this->disponible($r->id) == false) {
                        $obj = null;
                        $obj[] = $r->descripcion;
                        $obj[] = $r->nombre;
                        $obj[] = $r->tipo;
                        $obj[] = $r->estado;
                        $response[] = $obj;
                    }
                }
            } else {
                foreach ($rec as $r) {
                    if ($this->disponible($r->id) == true) {
                        $obj = null;
                        $obj[] = $r->descripcion;
                        $obj[] = $r->nombre;
                        $obj[] = $r->tipo;
                        $obj[] = $r->estado;
                        $response[] = $obj;
                    }
                }
            }
            if ($response !== null) {
                $cabeceras = ['Descripción', 'Nombre', 'Tipo', 'Estado'];
                $filtros = ['ESTADO' => $estado];
                $hoy = getdate();
                $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                $date['fecha'] = $fecha;
                $date['encabezado'] = null;
                $date['cabeceras'] = $cabeceras;
                $date['data'] = $response;
                $date['nivel'] = 1;
                $date['titulo'] = "REPORTES DE RESERVAS - HISTÓRICO LIQUIDACIONES";
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

    public function disponible($id) {
        $fecha = date('Y-m-j');
        $ocupados = Detallereserva::where([['recursogeneral_id', $id], ['fechafin', '>=', $fecha]])->get();
        if (count($ocupados) > 0) {
            return true;
        }
        return false;
    }

}
