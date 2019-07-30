<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NivelEducativo;
use App\Formulario;
use App\Itemformulario;
use App\Parametrosins;
use App\Contratoinsc;
use App\Tipodoc;
use App\Estrato;
use App\Entidadsalud;
use App\Estadocivil;
use App\Pais;
use App\Mediodivulgacion;
use App\Circunscripcion;
use App\Estado;
use App\Unidad;
use App\Metodologia;
use App\Parentesco;
use App\Rangosalario;
use App\Ocupacionlaboral;
use App\Idioma;
use App\Pasatiempo;
use App\Tipodiscapacidad;
use App\Aspirante;
use App\Formularioinscripcion;
use App\Servicioperiodo;
use App\Pin;
use App\Programaxformulario;
use App\Convocatoria;
use App\Estudiossecundario;
use App\Institucionsecundaria;
use App\Estudiosuniversitario;
use App\Estudiospostgrado;
use App\Cursorealizado;
use App\Publicacion;
use App\Grupofamiliar;
use App\Informacionsocioeconomica;
use App\Posesionresidencia;
use App\Jefefamilia;
use App\Experienciaprofesional;
use App\Experienciadocente;
use App\Experienciainvestigacion;
use App\Referenciaacademica;
use App\Asociacioncientifica;
use App\Idiomaaspirante;
use App\Pasatiempoaspirante;
use App\Caracterizacion;
use App\Instsolicitudadmision;
use App\Discapacidad;
use App\Informacioncomplementaria;
use App\Programaunidad;
use App\Documentoinscripcion;
use App\Periodoprocesoacademico;
use App\Periodoprogunidad;
use PDF;
use App\Cajacompenfamiliar;

class PublicController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $servicioperiodo, $pro) {
        $f = Formulario::where('nivel_educativo_id', $id)->get();
        if (count($f) > 0) {
            $arr = null;
            foreach ($f as $value) {
                $obj["f_id"] = $value->id;
                $obj["panel"] = $value->panel->titulo;
                $arr[] = $obj;
            }
            $arr = collect($arr);
            $final = null;
            $arr = $arr->sortBy('panel');
            foreach ($arr as $value) {
                $obj2["panel"] = $value["panel"];
                $e = Itemformulario::where('formulario_id', $value["f_id"])->get();
                $elem = null;
                foreach ($e as $i) {
                    $m["obligatorio"] = $i->obligatorio;
                    $m["elemento"] = $i->elemento->titulo;
                    $m["nomenclatura"] = $i->elemento->nomenclatura;
                    $elem[] = $m;
                }
                $obj2["items"] = $elem;
                $final[] = $obj2;
            }
            $estrato = Estrato::all()->pluck('descripcion', 'id');
            $p = Parametrosins::where('nivel_educativo_id', $id)->first();
            $c = Contratoinsc::where([['nivel_educativo_id', $id], ['activo', '1'], ['tipo', 'INSCRIPCION']])->first();
            $td = Tipodoc::where('tipo_persona', 'N')->pluck('descripcion', 'id');
            $esalud = Entidadsalud::all()->pluck('nombre', 'id');
            $esalud['OTRA'] = 'OTRA';
            $caja = Cajacompenfamiliar::all()->pluck('nombre', 'id');
            $estado_civil = Estadocivil::all()->pluck('descripcion', 'id');
            $mdivulgacion = Mediodivulgacion::where('tipo', 'OTRO')->get();
            $mdiv = null;
            foreach ($mdivulgacion as $value) {
                $mdiv[$value->id] = $value->otromediodivulgacion->descripcion;
            }
            $paises = Pais::all()->pluck('nombre', 'id');
            $circuns = Circunscripcion::where('nivel_educativo_id', $id)->get();
            $cir = null;
            $dptos = Estado::all()->pluck('nombre', 'id');
            foreach ($circuns as $value) {
                $cir[$value->id] = "CIRCUNSCRIPCIÓN: " . $value->descripcion . "  -- DESCRIPCIÓN: " . $value->observacion;
            }
            $nivel = NivelEducativo::find($id);
            $ne[$nivel->id] = $nivel->descripcion;
            $unds = Unidad::where('regional', '1')->get()->pluck('nombre', 'id');
            $met = Metodologia::where('estado', 'ACTIVA')->get()->pluck('nombre', 'id');
            $parent = Parentesco::all()->pluck('descripcion', 'id');
            $rangos = Rangosalario::all()->pluck('descripcion', 'id');
            $ocpl = Ocupacionlaboral::all()->pluck('descripcion', 'id');
            $idiomas = Idioma::all()->pluck('descripcion', 'id');
            $pasat = Pasatiempo::all()->pluck('descripcion', 'id');
            $tdisc = Tipodiscapacidad::all()->pluck('nombre', 'id');
            $serp = Servicioperiodo::find($servicioperiodo);
            return view('inscripcion_publico.formulario')
                            ->with('mostrar', 'SI')
                            ->with('conf', $final)
                            ->with('p', $p)
                            ->with('c', $c)
                            ->with('td', $td)
                            ->with('estrato', $estrato)
                            ->with('esalud', $esalud)
                            ->with('estado_civil', $estado_civil)
                            ->with('paises', $paises)
                            ->with('mdivulgacion', $mdiv)
                            ->with('circuns', $cir)
                            ->with('dptos', $dptos)
                            ->with('nivel', $ne)
                            ->with('unds', $unds)
                            ->with('metodologias', $met)
                            ->with('serp', $servicioperiodo)
                            ->with('parent', $parent)
                            ->with('rangos', $rangos)
                            ->with('ocpl', $ocpl)
                            ->with('idiomas', $idiomas)
                            ->with('pasat', $pasat)
                            ->with('tdisc', $tdisc)
                            ->with('procesoa', $pro)
                            ->with('serpe', $serp->periodoacademico_id)
                            ->with('caja', $caja)
                            ->with('nivelid', $id);
        } else {
            flash("No hay formulario de inscripción valido para su solicitud. <a href='" . config('app.url') . "' class='btn btn-xs btn-default'> Ir al inicio</a>")->error();
            return view('inscripcion_publico.formulario')
                            ->with('mostrar', 'NO');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agregaraspte($id) {
        $estrato = Estrato::all()->pluck('descripcion', 'id');
        $td = Tipodoc::where('tipo_persona', 'N')->pluck('descripcion', 'id');
        $esalud = Entidadsalud::all()->pluck('nombre', 'id');
        $esalud['OTRA'] = 'OTRA';
        $caja = Cajacompenfamiliar::all()->pluck('nombre', 'id');
        $estado_civil = Estadocivil::all()->pluck('descripcion', 'id');
        $mdivulgacion = Mediodivulgacion::where('tipo', 'OTRO')->get();
        $mdiv = null;
        foreach ($mdivulgacion as $value) {
            $mdiv[$value->id] = $value->otromediodivulgacion->descripcion;
        }
        $paises = Pais::all()->pluck('nombre', 'id');
        $circuns = Circunscripcion::where([['nivel_educativo_id', $id], ['transferenciaexterna', '1']])->get();
        $cir = null;
        $dptos = Estado::all()->pluck('nombre', 'id');
        foreach ($circuns as $value) {
            $cir[$value->id] = "CIRCUNSCRIPCIÓN: " . $value->descripcion . "  -- DESCRIPCIÓN: " . $value->observacion;
        }
        $nivel = NivelEducativo::find($id);
        $ne[$nivel->id] = $nivel->descripcion;
        $met = Metodologia::where('estado', 'ACTIVA')->get()->pluck('nombre', 'id');
        $parent = Parentesco::all()->pluck('descripcion', 'id');
        $rangos = Rangosalario::all()->pluck('descripcion', 'id');
        $ocpl = Ocupacionlaboral::all()->pluck('descripcion', 'id');
        $idiomas = Idioma::all()->pluck('descripcion', 'id');
        $pasat = Pasatiempo::all()->pluck('descripcion', 'id');
        $tdisc = Tipodiscapacidad::all()->pluck('nombre', 'id');
        return view('admisiones.inscripcion_linea.agregar_aspirante.formulario')
                        ->with('location', 'admisiones')
                        ->with('mostrar', 'SI')
                        ->with('td', $td)
                        ->with('estrato', $estrato)
                        ->with('esalud', $esalud)
                        ->with('estado_civil', $estado_civil)
                        ->with('paises', $paises)
                        ->with('mdivulgacion', $mdiv)
                        ->with('circuns', $cir)
                        ->with('dptos', $dptos)
                        ->with('nivel', $ne)
                        ->with('metodologias', $met)
                        ->with('parent', $parent)
                        ->with('rangos', $rangos)
                        ->with('ocpl', $ocpl)
                        ->with('idiomas', $idiomas)
                        ->with('pasat', $pasat)
                        ->with('tdisc', $tdisc)
                        ->with('caja', $caja)
                        ->with('nivelid', $id)
                        ->with('nid', $id);
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
        //aspirante, datos personales, datos de ubicacion, circunscripcion
        $aspi = new Aspirante();
        $aspi->tipodoc_id = (isset($request->tipodoc_id)) ? $request->tipodoc_id : 0;
        $aspi->numerodocumento = (isset($request->numero_documento)) ? $request->numero_documento : 0;
        $aspi->lugar_expedicion = (isset($request->lugar_expedicion)) ? $request->lugar_expedicion : null;
        $aspi->fecha_expedicion = (isset($request->fecha_expedicion)) ? $request->fecha_expedicion : null;
        $aspi->sexo = (isset($request->sexo)) ? $request->sexo : null;
        $aspi->estatura = (isset($request->estatura)) ? $request->estatura : null;
        $aspi->primer_nombre = (isset($request->primer_nombre)) ? $request->primer_nombre : "";
        $aspi->segundo_nombre = (isset($request->segundo_nombre)) ? $request->segundo_nombre : null;
        $aspi->primer_apellido = (isset($request->primer_apellido)) ? $request->primer_apellido : "";
        $aspi->segundo_apellido = (isset($request->segundo_apellido)) ? $request->segundo_apellido : null;
        $aspi->libreta_militar = (isset($request->libreta_militar)) ? $request->libreta_militar : null;
        $aspi->claselibretamilitar = (isset($request->clase_libreta_militar)) ? $request->clase_libreta_militar : null;
        $aspi->distrito_militar = (isset($request->distrito_militar)) ? $request->distrito_militar : null;
        $aspi->tiposanguineo = (isset($request->tipo_sanguineo)) ? $request->tipo_sanguineo : null;
        if (isset($request->eps)) {
            if ($request->eps == "OTRA") {
                $aspi->eps = $request->aspi_eps;
            } else {
                $aspi->entidadsalud_id = $request->eps;
            }
        }
        $aspi->estadocivil_id = (isset($request->estado_civil)) ? $request->estado_civil : null;
        $aspi->pais_nacimiento = (isset($request->pais_id)) ? $request->pais_id : null;
        $aspi->dpto_nacimiento = (isset($request->dpto_id)) ? $request->dpto_id : null;
        $aspi->ciudad_nacimiento = (isset($request->ciudad_id)) ? $request->ciudad_id : null;
        $aspi->fecha_nacimiento = (isset($request->fecha_nacimiento)) ? $request->fecha_nacimiento : null;
        $aspi->numerovisa = (isset($request->numero_visa)) ? $request->numero_visa : null;
        $aspi->estadovisa = (isset($request->estado_visa)) ? $request->estado_visa : null;
        $aspi->fechavencevisa = (isset($request->fechavence_visa)) ? $request->fechavence_visa : null;
        $aspi->mediodivulgacion_id = (isset($request->mediodivulgacion_id)) ? $request->mediodivulgacion_id : null;
        $aspi->nivelacademico = (isset($request->nivelacademico)) ? $request->nivelacademico : null;
        $aspi->nivel_educativo_id = (isset($request->nivel_educativo_id)) ? $request->nivel_educativo_id : null;
        $aspi->circunscripcion_id = (isset($request->circunscripcion_id)) ? $request->circunscripcion_id : null;
        $aspi->pais_residencia = (isset($request->pais2_id)) ? $request->pais2_id : null;
        $aspi->dpto_residencia = (isset($request->dpto2_id)) ? $request->dpto2_id : null;
        $aspi->ciudad_residencia = (isset($request->ciudad2_id)) ? $request->ciudad2_id : null;
        $aspi->sectorciudad_id = (isset($request->sectorciudad_id)) ? $request->sectorciudad_id : null;
        $aspi->direccion_residencia = (isset($request->direccion_aspirante)) ? $request->direccion_aspirante : null;
        $aspi->barrio_residencia = (isset($request->barrio_aspirante)) ? $request->barrio_aspirante : null;
        $aspi->barrio_id = (isset($request->barrio_id)) ? $request->barrio_id : null;
        $aspi->vereda_residencia = (isset($request->vereda_aspirante)) ? $request->vereda_aspirante : null;
        $aspi->etnia = (isset($request->etnia_aspirante)) ? $request->etnia_aspirante : null;
        $aspi->telefono_residencia = (isset($request->telefono_contacto)) ? $request->telefono_contacto : null;
        $aspi->telefonocelular = (isset($request->telefono_celular)) ? $request->telefono_celular : null;
        $aspi->email = (isset($request->correo)) ? $request->correo : null;
        $aspi->dpto_residenciasec = (isset($request->dpto3_id)) ? $request->dpto3_id : null;
        $aspi->ciudad_residenciasec = (isset($request->ciudad3_id)) ? $request->ciudad3_id : null;
        $aspi->direccion_residenciasec = (isset($request->direccion_ec)) ? $request->direccion_ec : null;
        $aspi->direccion_estudio = (isset($request->direccion_ciudade)) ? $request->direccion_ciudade : null;
        $aspi->telefonoestudio = (isset($request->telefono_ciudade)) ? $request->telefono_ciudade : null;
        $response = null;
        if (count($aspi) > 0) {
            if ($aspi->save()) {
                $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información básica del aspirante</p>";
                //formulario, pin
                $foin = new Formularioinscripcion();
                $foin->medioinscripcion = "ON LINE";
                $foin->simultaneidad = "NINGUNO";
                $foin->aspirante_id = $aspi->id;
                $foin->estadoadmision = "ASPIRANTE";
                $foin->servicioperiodo_id = $request->serp;
                $pr = Programaunidad::find($request->programaunidad_id);
                $codigo = substr($pr->programa_id, strlen($pr->programa_id) - 2, 2) . substr(date('Y'), strlen(date('Y')) - 2, 2) . substr($request->numero_documento, strlen($request->numero_documento) - 3, 3);
                $foin->codigo = $codigo;
                $sp = Servicioperiodo::find($request->serp);
                if (count($sp) > 0) {
                    $foin->tipoinscripcion_id = $sp->servicioinscripcion->tipoinscripcion_id;
                } else {
                    $foin->tipoinscripcion_id = 1;
                }
                $pin = Pin::where('pin', $request->pin)->first();
                if (count($pin) > 0) {
                    if ($pin->estado == "USADO") {
                        $foin->pin_id = $pin->id;
                    } else {
                        //no puede seguir la inscripcion
                        flash("El PIN que ingresó no ha sido vendido en el banco. Si usted compro el PIN, por favor Acérquese a la oficina de registro y control para validar su PIN.")->error();
                        return redirect()->route('inscripcion.inscribirse', [$request->nivel_educativo_id, $request->serp,]);
                    }
                } else {
                    //no puede seguir la inscripcion
                    flash("El PIN que ingresó es inválido. No puede continuar.")->error();
                    return redirect()->route('inscripcion.inscribirse', [$request->nivel_educativo_id, $request->serp,]);
                }
                if (count($foin) > 0) {
                    if ($foin->save()) {
                        $response = $response . "<p style='font-size:14px; color:green;'>Se ha creado el formulario de inscripción del aspirante</p>";
                        //programaXformulario
                        $pxf = new Programaxformulario();
                        $pxf->prioridad = 1;
                        $pxf->puntajeobtenido = 0;
                        $pxf->puesto = 0;
                        $pxf->formularioinscripcion_id = $foin->id;
                        $pxf->programaunidad_id = $request->programaunidad_id;
                        $conv = Convocatoria::where([['programaunidad_id', $request->programaunidad_id], ['periodoacademico_id', $sp->periodoacademico_id]])->first();
                        if (count($conv) > 0) {
                            $pxf->convocatoria_id = $conv->id;
                        }
                        if (count($pxf) > 0) {
                            if ($pxf->save()) {
                                $response = $response . "<p style='font-size:14px; color:green;'>El programa que ha seleccionado ha sido asociado al aspirante</p>";
                                //estudios secundarios
                                $esse = new Estudiossecundario();
                                $esse->pais = (isset($request->paisn_id)) ? $request->paisn_id : null;
                                $esse->ciudad = (isset($request->ciudadn_id)) ? $request->ciudadn_id : null;
                                $esse->codigo_snp = (isset($request->iem_id)) ? $request->iem_id : null;
                                $esse->enfasis_mod_sec = (isset($request->enfasis)) ? $request->enfasis : null;
                                $esse->fechaterminacion = (isset($request->ft)) ? $request->ft : null;
                                $esse->formaobtuvotitulo = (isset($request->forma_obt_titulo)) ? $request->forma_obt_titulo : null;
                                $esse->valormatricula10 = (isset($request->vmd)) ? $request->vmd : null;
                                $esse->valorpension10 = (isset($request->vpd)) ? $request->vpd : null;
                                $esse->valorpension11 = (isset($request->vpu)) ? $request->vpu : null;
                                $esse->valormatricula11 = (isset($request->vmu)) ? $request->vmu : null;
                                $esse->libro = (isset($request->libro)) ? $request->libro : null;
                                $esse->folio = (isset($request->folio)) ? $request->folio : null;
                                $esse->snp = (isset($request->snp_aspirante)) ? $request->snp_aspirante : null;
                                $esse->puntajeobtenido = (isset($request->poes)) ? $request->poes : null;
                                $esse->ciudadpresentoprueba = (isset($request->ciudad5_id)) ? $request->ciudad5_id : null;
                                $esse->fechapresentopruebas = (isset($request->fpes)) ? $request->fpes : null;
                                if ($esse->fechapresentopruebas !== null) {
                                    $time = strtotime($esse->fechapresentopruebas);
                                    $newformat = date('Y-m-d', $time);
                                    $fff = explode("-", $newformat);
                                    $aniop = $fff[0];
                                    $mesp = $fff[1];
                                    if ($aniop < 2014) {
                                        $esse->tipoprueba = "ANTIGUA";
                                    }
                                    if ($aniop == 2014 && $mesp < 6) {
                                        $esse->tipoprueba = "ANTIGUA";
                                    }
                                    if ($aniop == 2014 && $mesp > 6) {
                                        $esse->tipoprueba = "NUEVA";
                                    }
                                    if ($aniop > 2014) {
                                        $esse->tipoprueba = "NUEVA";
                                    }
                                }
                                $esse->tipodocicfes = (isset($request->tipodoc_prueba)) ? $request->tipodoc_prueba : null;
                                $esse->documentoicfes = (isset($request->dipi)) ? $request->dipi : null;
                                $esse->aspirante_id = $aspi->id;
                                if (count($esse) > 0) {
                                    if ($esse->save()) {
                                        $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de estudios secundarios</p>";
                                    }
                                }
                                $tb1 = $tb2 = $tb3 = $tb4 = $tb5 = $tb6 = $tb7 = $tb8 = $tb9 = $tb10 = $tb11 = $tb12 = $tb13 = $tb14 = $tb15 = $tb16 = null;
                                //tb1 lista inst en las que estudió institucionsecundaria
                                if (isset($request->tb1)) {
                                    foreach ($request->tb1 as $value) {
                                        $is = new Institucionsecundaria();
                                        $v = explode(";", $value);
                                        $is->institucionestudio = (strlen($v[0]) > 0) ? $v[0] : null;
                                        $is->fechainicial = (strlen($v[1]) > 0) ? $v[1] : date('Y-m-d', strtotime('00-00-0000'));
                                        $is->fechafin = (strlen($v[2]) > 0) ? $v[2] : date('Y-m-d', strtotime('00-00-0000'));
                                        $is->aspirante_id = $aspi->id;
                                        $tb1[] = $is;
                                    }
                                }
                                if (count($tb1) > 0) {
                                    foreach ($tb1 as $value) {
                                        $value->save();
                                    }
                                    $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de instituciones donde estudió.</p>";
                                }
                                //tb2 estudios de pregrado
                                if (isset($request->tb2)) {
                                    foreach ($request->tb2 as $value) {
                                        $eu = new Estudiosuniversitario();
                                        $v = explode(";", $value);
                                        $eu->codigosnp = $v[0];
                                        $eu->programa = $v[1];
                                        $eu->periodoscursados = $v[2];
                                        $eu->fechaterminacion = $v[3];
                                        $eu->tarjetaprofesional = $v[4];
                                        $eu->ciudadrural = $v[5];
                                        if ($v[6] == "PRESENTO") {
                                            $eu->registroecaes = $v[7];
                                            $eu->puntajeecaes = $v[8];
                                        }
                                        $eu->aspirante_id = $aspi->id;
                                        $tb2[] = $eu;
                                    }
                                }
                                if (count($tb2) > 0) {
                                    foreach ($tb2 as $value) {
                                        $value->save();
                                    }
                                    $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de pregrado.</p>";
                                }
                                //tb3 estudios de postgrado
                                if (isset($request->tb3)) {
                                    foreach ($request->tb3 as $value) {
                                        $ep = new Estudiospostgrado();
                                        $v = explode(";", $value);
                                        $ep->codigosnp = $v[0];
                                        $ep->programa = $v[1];
                                        $ep->fechaterminacion = $v[2];
                                        $ep->aspirante_id = $aspi->id;
                                        $tb3[] = $ep;
                                    }
                                }
                                if (count($tb3) > 0) {
                                    foreach ($tb3 as $value) {
                                        $value->save();
                                    }
                                    $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de postgrado.</p>";
                                }
                                //tb4 cursos realizados
                                if (isset($request->tb4)) {
                                    foreach ($request->tb4 as $value) {
                                        $cr = new Cursorealizado();
                                        $v = explode(";", $value);
                                        $cr->titulo = $v[0];
                                        $cr->institucion = $v[1];
                                        $cr->fechaterminacion = $v[2];
                                        $cr->aspirante_id = $aspi->id;
                                        $tb4[] = $cr;
                                    }
                                }
                                if (count($tb4) > 0) {
                                    foreach ($tb4 as $value) {
                                        $value->save();
                                    }
                                    $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de cursos realizados.</p>";
                                }
                                //tb5 publicaciones
                                if (isset($request->tb5)) {
                                    foreach ($request->tb5 as $value) {
                                        $p = new Publicacion();
                                        $v = explode(";", $value);
                                        $p->nombre = $v[0];
                                        $p->tipoobra = $v[1];
                                        $p->anio = $v[2];
                                        $p->entidadauspiciadora = $v[3];
                                        $p->aspirante_id = $aspi->id;
                                        $tb5[] = $p;
                                    }
                                }
                                if (count($tb5) > 0) {
                                    foreach ($tb5 as $value) {
                                        $value->save();
                                    }
                                    $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de publicaciones.</p>";
                                }
                                //tb6 familiares
                                if (isset($request->tb6)) {
                                    foreach ($request->tb6 as $value) {
                                        $g = new Grupofamiliar();
                                        $v = explode(";", $value);
                                        $g->sitiotrabajoestudio = $v[0];
                                        $g->ciudad = $v[1];
                                        $g->parentesco_id = (count($v[4]) > 0) ? $v[4] : 0;
                                        $g->cedula = $v[5];
                                        $g->nombrecompleto = $v[6];
                                        $g->vive = $v[7];
                                        $g->ocupacion = $v[8];
                                        $g->profesion = $v[9];
                                        $g->edad = $v[10];
                                        $g->niveleducativo = $v[11];
                                        $g->ingresomensual = $v[12];
                                        $g->ingresomensual_rango = $v[13];
                                        $g->lee = $v[14];
                                        $g->ciudadresidencia = $v[16];
                                        $g->direccion = $v[17];
                                        $g->telefonoresidencia = $v[18];
                                        $g->ciudadresidencia = $v[19];
                                        $g->direccionempresa = $v[20];
                                        $g->celular = $v[21];
                                        $g->aspirante_id = $aspi->id;
                                        $tb6[] = $g;
                                    }
                                }
                                if (count($tb6) > 0) {
                                    foreach ($tb6 as $value) {
                                        $value->save();
                                    }
                                    $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de familiares.</p>";
                                }
                                //informacion socioeconomica
                                $ise = new Informacionsocioeconomica();
                                $ise->situacionpadres = (isset($request->sdlp)) ? $request->sdlp : null;
                                $ise->numerofamiliares = (isset($request->nmf)) ? $request->nmf : null;
                                $ise->numeromiembrostrabaja = (isset($request->pqt)) ? $request->pqt : null;
                                $ise->numerohermanos = (isset($request->nhise)) ? $request->nhise : null;
                                $ise->posicionhermanos = (isset($request->pelh)) ? $request->pelh : null;
                                $ise->ingresomensualfamilia = (isset($request->imaf)) ? $request->imaf : null;
                                $ise->egresomensualfamilia = (isset($request->emaf)) ? $request->emaf : null;
                                $ise->hermanosestudiandou = (isset($request->nheu)) ? $request->nheu : null;
                                $ise->viveconfamilia = (isset($request->vcsf)) ? $request->vcsf : null;
                                $ise->numhermanosestudiaunivers = (isset($request->nhceu)) ? $request->nhceu : null;
                                $ise->quiencosteaestudios = (isset($request->cdse)) ? $request->cdse : null;
                                $ise->conquienreside = (isset($request->edr)) ? $request->edr : null;
                                $ise->estrato = (isset($request->eise)) ? $request->eise : null;
                                $ise->situacioneconomica = (isset($request->se)) ? $request->se : null;
                                $ise->sufragoelecciones = (isset($request->selue)) ? $request->selue : null;
                                $ise->rentagravable = (isset($request->rg)) ? $request->rg : null;
                                $ise->patrimoniogravable = (isset($request->pg)) ? $request->pg : null;
                                $ise->ingresoretenciones = (isset($request->iyr)) ? $request->iyr : null;
                                $ise->sisben = (isset($request->tsise)) ? $request->tsise : null;
                                $ise->nivelsisben = (isset($request->nivelsisben)) ? $request->nivelsisben : null;
                                $ise->cajacompensacion = (isset($request->ccf)) ? $request->ccf : null;
                                $ise->ingresosnogravables = (isset($request->ing)) ? $request->ing : null;
                                $ise->patrimoniobruto = (isset($request->pb)) ? $request->pb : null;
                                $ise->ingresobruto = (isset($request->ib)) ? $request->ib : null;
                                $ise->rentanogravable = (isset($request->rng)) ? $request->rng : null;
                                $ise->ingresosgravables = (isset($request->ig)) ? $request->ig : null;
                                $ise->aspirante_id = $aspi->id;
                                if (count($ise) > 0) {
                                    if ($ise->save()) {
                                        $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información socioeconómica.</p>";
                                    }
                                }
                                //posesion de residencia
                                $pos = new Posesionresidencia();
                                if (isset($request->PROPIA)) {
                                    if ($request->PROPIA == "PROPIA") {
                                        $pos->tipoposesion = "PROPIA";
                                    }
                                }
                                if (isset($request->pppc)) {
                                    if ($request->pppc == "CASA PROPIA") {
                                        $pos->tipoposesion = "CASA PROPIA";
                                        $pos->deudavivienda = (isset($request->ddlv)) ? $request->ddlv : null;
                                        $pos->vrmensualcuota = (isset($request->vmc)) ? $request->vmc : null;
                                        $pos->dirmueblehipotecado = (isset($request->ddih)) ? $request->ddih : null;
                                        $pos->numcredito = (isset($request->ndc)) ? $request->ndc : null;
                                    }
                                }
                                if (isset($request->aoa)) {
                                    if ($request->aoa == "ARRENDADA") {
                                        $pos->tipoposesion = "ARRENDADA";
                                        $pos->vrmensualarriendo = (isset($request->vma)) ? $request->vma : null;
                                        $pos->vrdelanticres = (isset($request->vdac)) ? $request->vdac : null;
                                        $pos->nombrearrendador = (isset($request->nda)) ? $request->nda : null;
                                        $pos->ciudadarrendador = (isset($request->cda)) ? $request->cda : null;
                                        $pos->direccarrendador = (isset($request->dda)) ? $request->dda : null;
                                        $pos->telarrendador = (isset($request->tda)) ? $request->tda : null;
                                    }
                                }
                                if (isset($request->ndla)) {
                                    if ($request->ndla == "NINGUNA POSESION") {
                                        $pos->tipoposesion = "NINGUNA POSESION";
                                    }
                                }
                                $pos->aspirante_id = $aspi->id;
                                if (count($pos) > 0) {
                                    if ($pos->save()) {
                                        $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de residencia.</p>";
                                    }
                                }
                                //tb7 jefes de familia
                                if (isset($request->tb7)) {
                                    foreach ($request->tb7 as $value) {
                                        $jf = new Jefefamilia();
                                        $v = explode(";", $value);
                                        $jf->nombre = $v[0];
                                        $jf->empresa = $v[1];
                                        $jf->cargo = $v[2];
                                        $jf->tiemposervicio = $v[3];
                                        $jf->sueldo = $v[4];
                                        $jf->jefeinmediato = $v[5];
                                        $jf->areadesempenio = $v[6];
                                        $jf->teltrabajo = $v[7];
                                        $jf->numpersonascargo = $v[8];
                                        $jf->eljefedefamiliaeselpadre = $v[9];
                                        $jf->ciudad = $v[11];
                                        $jf->dirempresa = $v[12];
                                        $jf->parentesco_id = (count($v[13]) > 0) ? $v[13] : 0;
                                        $jf->celular = $v[14];
                                        $jf->niveleducativo = $v[15];
                                        $jf->ocupacionlaboral_id = $v[16];
                                        $jf->tipodoc_id = $v[17];
                                        $jf->documentoidentidad = $v[18];
                                        $jf->aspirante_id = $aspi->id;
                                        $tb7[] = $jf;
                                    }
                                }
                                if (count($tb7) > 0) {
                                    foreach ($tb7 as $value) {
                                        $value->save();
                                    }
                                    $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de jefes de familia.</p>";
                                }
                                //tb8 experiencia profesional
                                if (isset($request->tb8)) {
                                    foreach ($request->tb8 as $value) {
                                        $ep = new Experienciaprofesional();
                                        $v = explode(";", $value);
                                        $ep->institucion = $v[0];
                                        $ep->cargo = $v[1];
                                        $ep->rangosalario_id = $v[2];
                                        $ep->fechaingreso = $v[3];
                                        $ep->fecharetiro = $v[4];
                                        $ep->telefonotrabajo = $v[5];
                                        $ep->aspirante_id = $aspi->id;
                                        $tb8[] = $ep;
                                    }
                                }
                                if (count($tb8) > 0) {
                                    foreach ($tb8 as $value) {
                                        $value->save();
                                    }
                                    $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de experiencia profesional.</p>";
                                }
                                //tb9 experiencia docente
                                if (isset($request->tb9)) {
                                    foreach ($request->tb9 as $value) {
                                        $ep = new Experienciadocente();
                                        $v = explode(";", $value);
                                        $ep->institucion = $v[0];
                                        $ep->nivel = $v[1];
                                        $ep->area = $v[2];
                                        $ep->tiemposervicio = $v[3];
                                        $ep->aspirante_id = $aspi->id;
                                        $tb9[] = $ep;
                                    }
                                }
                                if (count($tb9) > 0) {
                                    foreach ($tb9 as $value) {
                                        $value->save();
                                    }
                                    $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de experiencia docente.</p>";
                                }
                                //tb10 experiencia en investigacion
                                if (isset($request->tb10)) {
                                    foreach ($request->tb10 as $value) {
                                        $ep = new Experienciainvestigacion();
                                        $v = explode(";", $value);
                                        $ep->institucion = $v[0];
                                        $ep->proyecto = $v[1];
                                        $ep->cargo = $v[2];
                                        $ep->anio = $v[3];
                                        $ep->aspirante_id = $aspi->id;
                                        $tb10[] = $ep;
                                    }
                                }
                                if (count($tb10) > 0) {
                                    foreach ($tb10 as $value) {
                                        $value->save();
                                    }
                                    $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de investigación.</p>";
                                }
                                //tb11 referencias
                                if (isset($request->tb11)) {
                                    foreach ($request->tb11 as $value) {
                                        $ep = new Referenciaacademica();
                                        $v = explode(";", $value);
                                        $ep->nombre = $v[0];
                                        $ep->direccion = $v[1];
                                        $ep->telefono = $v[2];
                                        $ep->aspirante_id = $aspi->id;
                                        $tb11[] = $ep;
                                    }
                                }
                                if (count($tb11) > 0) {
                                    foreach ($tb11 as $value) {
                                        $value->save();
                                    }
                                    $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de referencias.</p>";
                                }
                                //tb12 Asociaciones Científicas, Sociales y Culturales
                                if (isset($request->tb12)) {
                                    foreach ($request->tb12 as $value) {
                                        $ep = new Asociacioncientifica();
                                        $v = explode(";", $value);
                                        $ep->nombre = $v[0];
                                        $ep->objetosocial = $v[1];
                                        $ep->fechaingreso = $v[2];
                                        $ep->aspirante_id = $aspi->id;
                                        $tb12[] = $ep;
                                    }
                                }
                                if (count($tb12) > 0) {
                                    foreach ($tb12 as $value) {
                                        $value->save();
                                    }
                                    $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información científica.</p>";
                                }
                                //tb13 idiomas
                                if (isset($request->tb13)) {
                                    foreach ($request->tb13 as $value) {
                                        $ep = new Idiomaaspirante();
                                        $v = explode(";", $value);
                                        $ep->idioma_id = $v[0];
                                        $ep->oir = $v[1];
                                        $ep->habla = $v[2];
                                        $ep->lee = $v[3];
                                        $ep->escribe = $v[4];
                                        $ep->aspirante_id = $aspi->id;
                                        $tb13[] = $ep;
                                    }
                                }
                                if (count($tb13) > 0) {
                                    foreach ($tb13 as $value) {
                                        $value->save();
                                    }
                                    $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de idiomas.</p>";
                                }
                                //tb14 pasatiempos
                                if (isset($request->tb14)) {
                                    foreach ($request->tb14 as $value) {
                                        $ep = new Pasatiempoaspirante();
                                        $v = explode(";", $value);
                                        $ep->pasatiempo_id = $v[0];
                                        $ep->aspirante_id = $aspi->id;
                                        $tb14[] = $ep;
                                    }
                                }
                                if (count($tb14) > 0) {
                                    foreach ($tb14 as $value) {
                                        $value->save();
                                    }
                                    $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de pasatiempos.</p>";
                                }
                                //caracterizacion
                                $car = new Caracterizacion();
                                $car->practicadeporte = (isset($request->pd)) ? $request->pd : null;
                                $car->deporte = (isset($request->cd)) ? $request->cd : null;
                                $car->frecuenciadeporte = (isset($request->fp)) ? $request->fp : null;
                                $car->formadeporte = (isset($request->flp)) ? $request->flp : null;
                                $car->porquenodeporte = (isset($request->pnpd)) ? $request->pnpd : null;
                                $car->eventopreferido = (isset($request->ecp)) ? $request->ecp : null;
                                $car->frecuenciaeventopreferido = (isset($request->fca)) ? $request->fca : null;
                                $car->practicaartistica = (isset($request->paa)) ? $request->paa : null;
                                $car->actividadartistica = (isset($request->caa)) ? $request->caa : null;
                                $car->formaactividadartistica = (isset($request->felp)) ? $request->felp : null;
                                $car->ocupatiempolibre = (isset($request->eotl)) ? $request->eotl : null;
                                $car->fuma = (isset($request->f)) ? $request->f : null;
                                $car->frecuenciafuma = (isset($request->ccpd)) ? $request->ccpd : null;
                                $car->bebe = (isset($request->cl)) ? $request->cl : null;
                                $car->frecuenciabebe = (isset($request->cqfcl)) ? $request->cqfcl : null;
                                $car->sustanciapsicoactivas = (isset($request->cssa)) ? $request->cssa : null;
                                $car->frecuenciasustancia = (isset($request->cqfcssa)) ? $request->cqfcssa : null;
                                $car->relacionessexuales = (isset($request->htrs)) ? $request->htrs : null;
                                $car->edadprimrelacion = (isset($request->epr)) ? $request->epr : null;
                                $car->metodoanticonceptivo = (isset($request->ma)) ? $request->ma : null;
                                $car->numerohijos = (isset($request->nh)) ? $request->nh : null;
                                $car->gradoaceptacion = (isset($request->gasm)) ? $request->gasm : null;
                                $car->depresionsinmotivo = (isset($request->sdsm)) ? $request->sdsm : null;
                                $car->gradoconcentracion = (isset($request->gcc)) ? $request->gcc : null;
                                $car->aspirante_id = $aspi->id;
                                if (count($car) > 0) {
                                    if ($car->save()) {
                                        $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de caracterización.</p>";
                                    }
                                }
                                //tb15 inst donde ha soliscitado admision
                                if (isset($request->tb15)) {
                                    foreach ($request->tb15 as $value) {
                                        $p = new Instsolicitudadmision();
                                        $v = explode(";", $value);
                                        $p->codigosnp = $v[0];
                                        $p->programa = $v[1];
                                        $p->anio = $v[2];
                                        $p->aceptado = $v[3];
                                        $p->aspirante_id = $aspi->id;
                                        $tb15[] = $p;
                                    }
                                }
                                if (count($tb15) > 0) {
                                    foreach ($tb15 as $value) {
                                        $value->save();
                                    }
                                    $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de instituciones donde solicitó admisión.</p>";
                                }
                                //tb16 datos de discapacitados
                                if (isset($request->tb16)) {
                                    foreach ($request->tb16 as $value) {
                                        $p = new Discapacidad();
                                        $v = explode(";", $value);
                                        $p->tipodiscapacidad_id = (count($v[0]) > 0) ? $v[0] : 1;
                                        $p->nombre = $v[1];
                                        $p->fechadiagnostico = $v[2];
                                        $p->aspirante_id = $aspi->id;
                                        $tb16[] = $p;
                                    }
                                }
                                if (count($tb16) > 0) {
                                    foreach ($tb16 as $value) {
                                        $value->save();
                                    }
                                    $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de discapacidades.</p>";
                                }
                                //otros datos
                                $inf = new Informacioncomplementaria();
                                $inf->tienehijos = (isset($request->tienehijos)) ? $request->tienehijos : null;
                                $inf->cuantoshijos = (isset($request->chdi)) ? $request->chdi : null;
                                $inf->sisben = (isset($request->sisben)) ? $request->sisben : null;
                                $inf->desplazado = (isset($request->desplazado)) ? $request->desplazado : null;
                                $inf->laboraactualmente = (isset($request->labora)) ? $request->labora : null;
                                $inf->telefonocontactosec = (isset($request->tcs)) ? $request->tcs : null;
                                $inf->otrocorreocontacto = (isset($request->cec)) ? $request->cec : null;
                                $inf->personastrabajanfam = (isset($request->cptgf)) ? $request->cptgf : null;
                                $inf->cuentaequipocomputo = (isset($request->ccec)) ? $request->ccec : null;
                                $inf->accesointernet = (isset($request->eaie)) ? $request->eaie : null;
                                $inf->aspirante_id = $aspi->id;
                                if (count($tb1) > 0) {
                                    if ($inf->save()) {
                                        $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información complementaria.</p>";
                                    }
                                }
                                $pu = Programaunidad::find($request->programaunidad_id);
                                $requisitos = null;
                                if (count($pu) > 0) {
                                    $docins = Documentoinscripcion::where([['circunscripcion_id', $request->circunscripcion_id], ['programa_id', $pu->programa_id]])->get();
                                    if (count($docins) > 0) {
                                        foreach ($docins as $item) {
                                            $obj["ob"] = $item->obligatorio;
                                            $obj["item"] = $item->tipodocanexo->descripcion;
                                            $requisitos[] = $obj;
                                        }
                                    }
                                }
                                return view('inscripcion_publico.resultado_inscripcion')
                                                ->with('doc', $aspi->id)
                                                ->with('requisitos', $requisitos)
                                                ->with('rta', $response)
                                                ->with('sp', $request->serp);
                            } else {
                                $foin->delete();
                                $aspi->delete();
                                flash("Se ha encontrado un error y la inscripción no pudo ser completada. Intentelo nuevamente.")->error();
                                return redirect()->route('inscripcion.inscribirse', [$request->nivel_educativo_id, $request->serp,]);
                            }
                        } else {
                            $foin->delete();
                            $aspi->delete();
                            flash("No hay datos válidos para diligenciar el formulario de inscripción. No se puede continuar.")->error();
                            return redirect()->route('inscripcion.inscribirse', [$request->nivel_educativo_id, $request->serp,]);
                        }
                    } else {
                        $aspi->delete();
                        flash("Se ha encontrado un error y la inscripción no pudo ser completada. Intentelo nuevamente.")->error();
                        return redirect()->route('inscripcion.inscribirse', [$request->nivel_educativo_id, $request->serp,]);
                    }
                } else {
                    $aspi->delete();
                    flash("No hay datos válidos para diligenciar el formulario de inscripción. No se puede continuar.")->error();
                    return redirect()->route('inscripcion.inscribirse', [$request->nivel_educativo_id, $request->serp,]);
                }
            } else {
                flash("Se ha encontrado un error y la inscripción no pudo ser completada. Intentelo nuevamente.")->error();
                return redirect()->route('inscripcion.inscribirse', [$request->nivel_educativo_id, $request->serp,]);
            }
        } else {
            flash("No hay datos válidos para diligenciar el formulario de inscripción. No se puede continuar.")->error();
            return redirect()->route('inscripcion.inscribirse', [$request->nivel_educativo_id, $request->serp,]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeasptranse(Request $request) {
        //aspirante, datos personales, datos de ubicacion, circunscripcion
        $aspi = new Aspirante();
        $aspi->tipodoc_id = (isset($request->tipodoc_id)) ? $request->tipodoc_id : 0;
        $aspi->numerodocumento = (isset($request->numero_documento)) ? $request->numero_documento : 0;
        $aspi->lugar_expedicion = (isset($request->lugar_expedicion)) ? $request->lugar_expedicion : null;
        $aspi->fecha_expedicion = (isset($request->fecha_expedicion)) ? $request->fecha_expedicion : null;
        $aspi->sexo = (isset($request->sexo)) ? $request->sexo : null;
        $aspi->estatura = (isset($request->estatura)) ? $request->estatura : null;
        $aspi->primer_nombre = (isset($request->primer_nombre)) ? $request->primer_nombre : "";
        $aspi->segundo_nombre = (isset($request->segundo_nombre)) ? $request->segundo_nombre : null;
        $aspi->primer_apellido = (isset($request->primer_apellido)) ? $request->primer_apellido : "";
        $aspi->segundo_apellido = (isset($request->segundo_apellido)) ? $request->segundo_apellido : null;
        $aspi->libreta_militar = (isset($request->libreta_militar)) ? $request->libreta_militar : null;
        $aspi->claselibretamilitar = (isset($request->clase_libreta_militar)) ? $request->clase_libreta_militar : null;
        $aspi->distrito_militar = (isset($request->distrito_militar)) ? $request->distrito_militar : null;
        $aspi->tiposanguineo = (isset($request->tipo_sanguineo)) ? $request->tipo_sanguineo : null;
        if (isset($request->eps)) {
            if ($request->eps == "OTRA") {
                $aspi->eps = $request->aspi_eps;
            } else {
                $aspi->entidadsalud_id = $request->eps;
            }
        }
        $aspi->estadocivil_id = (isset($request->estado_civil)) ? $request->estado_civil : null;
        $aspi->pais_nacimiento = (isset($request->pais_id)) ? $request->pais_id : null;
        $aspi->dpto_nacimiento = (isset($request->dpto_id)) ? $request->dpto_id : null;
        $aspi->ciudad_nacimiento = (isset($request->ciudad_id)) ? $request->ciudad_id : null;
        $aspi->fecha_nacimiento = (isset($request->fecha_nacimiento)) ? $request->fecha_nacimiento : null;
        $aspi->numerovisa = (isset($request->numero_visa)) ? $request->numero_visa : null;
        $aspi->estadovisa = (isset($request->estado_visa)) ? $request->estado_visa : null;
        $aspi->fechavencevisa = (isset($request->fechavence_visa)) ? $request->fechavence_visa : null;
        $aspi->mediodivulgacion_id = (isset($request->mediodivulgacion_id)) ? $request->mediodivulgacion_id : null;
        $aspi->nivelacademico = (isset($request->nivelacademico)) ? $request->nivelacademico : null;
        $aspi->nivel_educativo_id = (isset($request->nivel_educativo_id)) ? $request->nivel_educativo_id : null;
        $aspi->circunscripcion_id = (isset($request->circunscripcion_id)) ? $request->circunscripcion_id : null;
        $aspi->pais_residencia = (isset($request->pais2_id)) ? $request->pais2_id : null;
        $aspi->dpto_residencia = (isset($request->dpto2_id)) ? $request->dpto2_id : null;
        $aspi->ciudad_residencia = (isset($request->ciudad2_id)) ? $request->ciudad2_id : null;
        $aspi->sectorciudad_id = (isset($request->sectorciudad_id)) ? $request->sectorciudad_id : null;
        $aspi->direccion_residencia = (isset($request->direccion_aspirante)) ? $request->direccion_aspirante : null;
        $aspi->barrio_residencia = (isset($request->barrio_aspirante)) ? $request->barrio_aspirante : null;
        $aspi->barrio_id = (isset($request->barrio_id)) ? $request->barrio_id : null;
        $aspi->vereda_residencia = (isset($request->vereda_aspirante)) ? $request->vereda_aspirante : null;
        $aspi->etnia = (isset($request->etnia_aspirante)) ? $request->etnia_aspirante : null;
        $aspi->telefono_residencia = (isset($request->telefono_contacto)) ? $request->telefono_contacto : null;
        $aspi->telefonocelular = (isset($request->telefono_celular)) ? $request->telefono_celular : null;
        $aspi->email = (isset($request->correo)) ? $request->correo : null;
        $aspi->dpto_residenciasec = (isset($request->dpto3_id)) ? $request->dpto3_id : null;
        $aspi->ciudad_residenciasec = (isset($request->ciudad3_id)) ? $request->ciudad3_id : null;
        $aspi->direccion_residenciasec = (isset($request->direccion_ec)) ? $request->direccion_ec : null;
        $aspi->direccion_estudio = (isset($request->direccion_ciudade)) ? $request->direccion_ciudade : null;
        $aspi->telefonoestudio = (isset($request->telefono_ciudade)) ? $request->telefono_ciudade : null;
        $response = null;
        if (count($aspi) > 0) {
            if ($aspi->save()) {
                $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información básica del aspirante</p>";
                //formulario, pin
                $foin = new Formularioinscripcion();
                $foin->medioinscripcion = "ON LINE";
                $foin->simultaneidad = "NINGUNO";
                $foin->aspirante_id = $aspi->id;
                $foin->estadoadmision = "ASPIRANTE";
                $foin->tipoinscripcion_id = 4;
                $pin = Pin::where('pin', $request->pin)->first();
                if (count($pin) > 0) {
                    if ($pin->estado == "USADO") {
                        $foin->pin_id = $pin->id;
                    } else {
                        //no puede seguir la inscripcion
                        flash("El PIN que ingresó no ha sido vendido en el banco. Si usted compro el PIN, por favor Acérquese a la oficina de registro y control para validar su PIN.")->error();
                        return redirect()->route('inscripcion.agregaraspte', $request->nivel_educativo_id);
                    }
                } else {
                    //no puede seguir la inscripcion
                    flash("El PIN que ingresó es inválido. No puede continuar.")->error();
                    return redirect()->route('inscripcion.agregaraspte', $request->nivel_educativo_id);
                }
                if (count($foin) > 0) {
                    if ($foin->save()) {
                        $response = $response . "<p style='font-size:14px; color:green;'>Se ha creado el formulario de inscripción del aspirante</p>";
//estudios secundarios
                        $esse = new Estudiossecundario();
                        $esse->pais = (isset($request->paisn_id)) ? $request->paisn_id : null;
                        $esse->ciudad = (isset($request->ciudadn_id)) ? $request->ciudadn_id : null;
                        $esse->codigo_snp = (isset($request->iem_id)) ? $request->iem_id : null;
                        $esse->enfasis_mod_sec = (isset($request->enfasis)) ? $request->enfasis : null;
                        $esse->fechaterminacion = (isset($request->ft)) ? $request->ft : null;
                        $esse->formaobtuvotitulo = (isset($request->forma_obt_titulo)) ? $request->forma_obt_titulo : null;
                        $esse->valormatricula10 = (isset($request->vmd)) ? $request->vmd : null;
                        $esse->valorpension10 = (isset($request->vpd)) ? $request->vpd : null;
                        $esse->valorpension11 = (isset($request->vpu)) ? $request->vpu : null;
                        $esse->valormatricula11 = (isset($request->vmu)) ? $request->vmu : null;
                        $esse->libro = (isset($request->libro)) ? $request->libro : null;
                        $esse->folio = (isset($request->folio)) ? $request->folio : null;
                        $esse->snp = (isset($request->snp_aspirante)) ? $request->snp_aspirante : null;
                        $esse->puntajeobtenido = (isset($request->poes)) ? $request->poes : null;
                        $esse->ciudadpresentoprueba = (isset($request->ciudad5_id)) ? $request->ciudad5_id : null;
                        $esse->fechapresentopruebas = (isset($request->fpes)) ? $request->fpes : null;
                        if ($esse->fechapresentopruebas !== null) {
                            $time = strtotime($esse->fechapresentopruebas);
                            $newformat = date('Y-m-d', $time);
                            $fff = explode("-", $newformat);
                            $aniop = $fff[0];
                            $mesp = $fff[1];
                            if ($aniop < 2014) {
                                $esse->tipoprueba = "ANTIGUA";
                            }
                            if ($aniop == 2014 && $mesp < 6) {
                                $esse->tipoprueba = "ANTIGUA";
                            }
                            if ($aniop == 2014 && $mesp > 6) {
                                $esse->tipoprueba = "NUEVA";
                            }
                            if ($aniop > 2014) {
                                $esse->tipoprueba = "NUEVA";
                            }
                        }
                        $esse->tipodocicfes = (isset($request->tipodoc_prueba)) ? $request->tipodoc_prueba : null;
                        $esse->documentoicfes = (isset($request->dipi)) ? $request->dipi : null;
                        $esse->aspirante_id = $aspi->id;
                        if (count($esse) > 0) {
                            if ($esse->save()) {
                                $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de estudios secundarios</p>";
                            }
                        }
                        $tb1 = $tb2 = $tb3 = $tb4 = $tb5 = $tb6 = $tb7 = $tb8 = $tb9 = $tb10 = $tb11 = $tb12 = $tb13 = $tb14 = $tb15 = $tb16 = null;
                        //tb1 lista inst en las que estudió institucionsecundaria
                        if (isset($request->tb1)) {
                            foreach ($request->tb1 as $value) {
                                $is = new Institucionsecundaria();
                                $v = explode(";", $value);
                                $is->institucionestudio = (strlen($v[0]) > 0) ? $v[0] : null;
                                $is->fechainicial = (strlen($v[1]) > 0) ? $v[1] : date('Y-m-d', strtotime('00-00-0000'));
                                $is->fechafin = (strlen($v[2]) > 0) ? $v[2] : date('Y-m-d', strtotime('00-00-0000'));
                                $is->aspirante_id = $aspi->id;
                                $tb1[] = $is;
                            }
                        }
                        if (count($tb1) > 0) {
                            foreach ($tb1 as $value) {
                                $value->save();
                            }
                            $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de instituciones donde estudió.</p>";
                        }
                        //tb6 familiares
                        if (isset($request->tb6)) {
                            foreach ($request->tb6 as $value) {
                                $g = new Grupofamiliar();
                                $v = explode(";", $value);
                                $g->sitiotrabajoestudio = $v[0];
                                $g->ciudad = $v[1];
                                $g->parentesco_id = (count($v[4]) > 0) ? $v[4] : 0;
                                $g->cedula = $v[5];
                                $g->nombrecompleto = $v[6];
                                $g->vive = $v[7];
                                $g->ocupacion = $v[8];
                                $g->profesion = $v[9];
                                $g->edad = $v[10];
                                $g->niveleducativo = $v[11];
                                $g->ingresomensual = $v[12];
                                $g->ingresomensual_rango = $v[13];
                                $g->lee = $v[14];
                                $g->ciudadresidencia = $v[16];
                                $g->direccion = $v[17];
                                $g->telefonoresidencia = $v[18];
                                $g->ciudadresidencia = $v[19];
                                $g->direccionempresa = $v[20];
                                $g->celular = $v[21];
                                $g->aspirante_id = $aspi->id;
                                $tb6[] = $g;
                            }
                        }
                        if (count($tb6) > 0) {
                            foreach ($tb6 as $value) {
                                $value->save();
                            }
                            $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de familiares.</p>";
                        }
                        //informacion socioeconomica
                        $ise = new Informacionsocioeconomica();
                        $ise->situacionpadres = (isset($request->sdlp)) ? $request->sdlp : null;
                        $ise->numerofamiliares = (isset($request->nmf)) ? $request->nmf : null;
                        $ise->numeromiembrostrabaja = (isset($request->pqt)) ? $request->pqt : null;
                        $ise->numerohermanos = (isset($request->nhise)) ? $request->nhise : null;
                        $ise->posicionhermanos = (isset($request->pelh)) ? $request->pelh : null;
                        $ise->ingresomensualfamilia = (isset($request->imaf)) ? $request->imaf : null;
                        $ise->egresomensualfamilia = (isset($request->emaf)) ? $request->emaf : null;
                        $ise->hermanosestudiandou = (isset($request->nheu)) ? $request->nheu : null;
                        $ise->viveconfamilia = (isset($request->vcsf)) ? $request->vcsf : null;
                        $ise->numhermanosestudiaunivers = (isset($request->nhceu)) ? $request->nhceu : null;
                        $ise->quiencosteaestudios = (isset($request->cdse)) ? $request->cdse : null;
                        $ise->conquienreside = (isset($request->edr)) ? $request->edr : null;
                        $ise->estrato = (isset($request->eise)) ? $request->eise : null;
                        $ise->situacioneconomica = (isset($request->se)) ? $request->se : null;
                        $ise->sufragoelecciones = (isset($request->selue)) ? $request->selue : null;
                        $ise->rentagravable = (isset($request->rg)) ? $request->rg : null;
                        $ise->patrimoniogravable = (isset($request->pg)) ? $request->pg : null;
                        $ise->ingresoretenciones = (isset($request->iyr)) ? $request->iyr : null;
                        $ise->sisben = (isset($request->tsise)) ? $request->tsise : null;
                        $ise->nivelsisben = (isset($request->nivelsisben)) ? $request->nivelsisben : null;
                        $ise->cajacompensacion = (isset($request->ccf)) ? $request->ccf : null;
                        $ise->ingresosnogravables = (isset($request->ing)) ? $request->ing : null;
                        $ise->patrimoniobruto = (isset($request->pb)) ? $request->pb : null;
                        $ise->ingresobruto = (isset($request->ib)) ? $request->ib : null;
                        $ise->rentanogravable = (isset($request->rng)) ? $request->rng : null;
                        $ise->ingresosgravables = (isset($request->ig)) ? $request->ig : null;
                        $ise->aspirante_id = $aspi->id;
                        if (count($ise) > 0) {
                            if ($ise->save()) {
                                $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información socioeconómica.</p>";
                            }
                        }
                        //tb13 idiomas
                        if (isset($request->tb13)) {
                            foreach ($request->tb13 as $value) {
                                $ep = new Idiomaaspirante();
                                $v = explode(";", $value);
                                $ep->idioma_id = $v[0];
                                $ep->oir = $v[1];
                                $ep->habla = $v[2];
                                $ep->lee = $v[3];
                                $ep->escribe = $v[4];
                                $ep->aspirante_id = $aspi->id;
                                $tb13[] = $ep;
                            }
                        }
                        if (count($tb13) > 0) {
                            foreach ($tb13 as $value) {
                                $value->save();
                            }
                            $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de idiomas.</p>";
                        }
                        //tb14 pasatiempos
                        if (isset($request->tb14)) {
                            foreach ($request->tb14 as $value) {
                                $ep = new Pasatiempoaspirante();
                                $v = explode(";", $value);
                                $ep->pasatiempo_id = $v[0];
                                $ep->aspirante_id = $aspi->id;
                                $tb14[] = $ep;
                            }
                        }
                        if (count($tb14) > 0) {
                            foreach ($tb14 as $value) {
                                $value->save();
                            }
                            $response = $response . "<p style='font-size:14px; color:green;'>Se guardó la información de pasatiempos.</p>";
                        }
                        flash($response)->success();
                        return redirect()->route('inscripcion.agregaraspte', $request->nivel_educativo_id);
                    } else {
                        $foin->delete();
                        $aspi->delete();
                        flash("Se ha encontrado un error y la inscripción no pudo ser completada. Intentelo nuevamente.")->error();
                        return redirect()->route('inscripcion.agregaraspte', $request->nivel_educativo_id);
                    }
                } else {
                    $aspi->delete();
                    flash("Se ha encontrado un error y la inscripción no pudo ser completada. Intentelo nuevamente.")->error();
                    return redirect()->route('inscripcion.agregaraspte', $request->nivel_educativo_id);
                }
            } else {
                $aspi->delete();
                flash("No hay datos válidos para diligenciar el formulario de inscripción. No se puede continuar.")->error();
                return redirect()->route('inscripcion.agregaraspte', $request->nivel_educativo_id);
            }
        } else {
            flash("No hay datos válidos para diligenciar el formulario de inscripción. No se puede continuar.")->error();
            return redirect()->route('inscripcion.agregaraspte', $request->nivel_educativo_id);
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
//
    }

    public function imprimir($id, $sp) {
        $aspi = Aspirante::find($id);
        $aspi->tipodoc;
        $aspi->estadocivil;
        $aspi->circunscripcion;
        $aspi->estrato = Informacionsocioeconomica::where('aspirante_id', $aspi->id)->first();
        $aspi->cn = \App\Ciudad::where('id', $aspi->ciudad_nacimiento)->first();
        $aspi->dn = Estado::where('id', $aspi->dpto_nacimiento)->first();
        $aspi->pn = Pais::where('id', $aspi->pais_nacimiento)->first();
        $aspi->cr = \App\Ciudad::where('id', $aspi->ciudad_residencia)->first();
        $aspi->dr = Estado::where('id', $aspi->dpto_residencia)->first();
        $aspi->pr = Pais::where('id', $aspi->pais_residencia)->first();
        $aspi->ess = Estudiossecundario::where('aspirante_id', $aspi->id)->first();
        $aspi->inst = \App\Institucion::where('codigosnp', $aspi->ess->codigo_snp)->first();
        $idiomas = Idiomaaspirante::where('aspirante_id', $aspi->id)->get();
        $idiomas->each(function($i) {
            $i->idioma;
        });
        $aspi->idiomas = $idiomas;
        $pasa = Pasatiempoaspirante::where('aspirante_id', $aspi->id)->get();
        $pasa->each(function($i) {
            $i->pasatiempo;
        });
        $aspi->pasa = $pasa;
        $form = Formularioinscripcion::where([['aspirante_id', $aspi->id], ['servicioperiodo_id', $sp]])->get();
        $pxfs = null;
        foreach ($form as $value) {
            $pxf = $value->programaxformularios;
            if (count($pxf) > 0) {
                foreach ($pxf as $item) {
                    $obj['id'] = $value->id;
                    $obj['estado'] = $value->estadoadmision;
                    $obj['prog'] = $item->programaunidad->programa->nombre;
                    $obj['und'] = $item->programaunidad->unidad->nombre;
                    $obj['cd'] = $item->programaunidad->unidad->ciudad->nombre;
                }
                $pxfs[] = $obj;
            }
        }
        $aspi->form = $pxfs;
        $spe = Servicioperiodo::find($sp);
        $aspi->periodo = $spe->periodoacademico;
        $hoy = getdate();
        $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
        $aspi->hoy = $fecha;
        $pdf = PDF::loadView('inscripcion_publico.print', $aspi);
        return $pdf->stream('formulario.pdf');
    }

    public function validarfechas($per, $proc, $prog) {
        $ppu = Periodoprogunidad::where([['programaunidad_id', $prog], ['periodoacademico_id', $per]])->first();
        if ($ppu !== null) {
            $p = Periodoprocesoacademico::where([['procesoacademico_id', $proc], ['periodoprogunidad_id', $ppu->id]])->get();
            $arr = null;
            if (count($p) > 0) {
                $cont = 0;
                $h = getdate();
                $fecha = $h['year'] . '-' . $h['mon'] . '-' . $h['mday'] . ' ' . $h['hours'] . ':' . $h['minutes'] . ':' . $h['seconds'];
                foreach ($p as $value) {
                    if ($this->check_in_range($value->fechahorainicial, $value->fechahorafinal, $fecha)) {
                        $o['actual'] = $fecha;
                        $o['inicial'] = $value->fechahorainicial;
                        $o['final'] = $value->fechahorafinal;
                        $o['¿?'] = "SI";
                        $arr[] = $o;
                        $cont += 1;
                    } else {
                        $o['actual'] = $fecha;
                        $o['inicial'] = $value->fechahorainicial;
                        $o['final'] = $value->fechahorafinal;
                        $o['¿?'] = "NO";
                        $arr[] = $o;
                    }
                }
                if ($cont > 0) {
                    return "SI";
                } else {
                    return "NO3";
                }
            } else {
                return "NO2";
            }
        } else {
            return "NO1";
        }
    }

    //saber si una fecha esta en el rango
    function check_in_range($fecha_inicio, $fecha_fin, $fecha) {
        setlocale(LC_ALL, "es_ES");
        $fecha_inicio = strtotime($fecha_inicio);
        $fecha_fin = strtotime($fecha_fin);
        $fecha = strtotime($fecha);
        if (($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin)) {
            return true;
        } else {
            return false;
        }
    }

    //verifica si un aspirante ya posee inscripcion a un programa para un determinado periodo academico
    public function validaraspirante($sp, $nd) {
        $asp = Aspirante::where('numerodocumento', $nd)->get();
        if (count($asp) > 0) {
            foreach ($asp as $value) {
                if (count($value->formularioinscripcions) > 0) {
                    foreach ($value->formularioinscripcions as $item) {
                        if ($item->servicioperiodo_id == $sp) {
                            return $value->id;
                        }
                    }
                    return "NO";
                } else {
                    return "NO";
                }
            }
            return "NO";
        } else {
            return "NO";
        }
    }

    //presenta la vista para que un aspirante se inscriba a varios programas en un mismo periodo
    public function inscripcion2($id, $sp, $pin, $n, $per, $proc) {
        $unds = Unidad::where('regional', '1')->get()->pluck('nombre', 'id');
        $aspi = Aspirante::find($id);
        $aspi->tipodoc;
        $aspi->estadocivil;
        $aspi->circunscripcion;
        $aspi->estrato = Informacionsocioeconomica::where('aspirante_id', $aspi->id)->first();
        $aspi->cn = \App\Ciudad::where('id', $aspi->ciudad_nacimiento)->first();
        $aspi->dn = Estado::where('id', $aspi->dpto_nacimiento)->first();
        $aspi->pn = Pais::where('id', $aspi->pais_nacimiento)->first();
        $aspi->cr = \App\Ciudad::where('id', $aspi->ciudad_residencia)->first();
        $aspi->dr = Estado::where('id', $aspi->dpto_residencia)->first();
        $aspi->pr = Pais::where('id', $aspi->pais_residencia)->first();
        $aspi->ess = Estudiossecundario::where('aspirante_id', $aspi->id)->first();
        $aspi->inst = \App\Institucion::where('codigosnp', $aspi->ess->codigo_snp)->first();
        $idiomas = Idiomaaspirante::where('aspirante_id', $aspi->id)->get();
        $idiomas->each(function($i) {
            $i->idioma;
        });
        $aspi->idiomas = $idiomas;
        $pasa = Pasatiempoaspirante::where('aspirante_id', $aspi->id)->get();
        $pasa->each(function($i) {
            $i->pasatiempo;
        });
        $aspi->pasa = $pasa;
        $met = Metodologia::where('estado', 'ACTIVA')->get()->pluck('nombre', 'id');
        $form = null;
        if (count($aspi->formularioinscripcions) > 0) {
            foreach ($aspi->formularioinscripcions as $item) {
                $obj = null;
                if ($item->servicioperiodo_id == $sp) {
                    foreach ($item->programaxformularios as $pxf) {
                        $obj['id'] = $item->id;
                        $obj['estado'] = $item->estadoadmision;
                        $obj['prog'] = $pxf->programaunidad->programa->nombre;
                        $obj['und'] = $pxf->programaunidad->unidad->nombre;
                        $obj['cd'] = $pxf->programaunidad->unidad->ciudad->nombre;
                    }
                    $form[] = $obj;
                }
            }
        }
        $aspi->forms = $form;
        $spe = Servicioperiodo::find($sp);
        $aspi->periodo = $spe->periodoacademico;
        $aspi->speriodo = $sp;
        $nivel = NivelEducativo::find($n);
        $ne[$nivel->id] = $nivel->descripcion;
        $circuns = Circunscripcion::where('nivel_educativo_id', $n)->get();
        $cir = null;
        foreach ($circuns as $value) {
            $cir[$value->id] = "CIRCUNSCRIPCIÓN: " . $value->descripcion . "  -- DESCRIPCIÓN: " . $value->observacion;
        }
        return view('inscripcion_publico.inscripcion2')
                        ->with('aspi', $aspi)
                        ->with('unds', $unds)
                        ->with('metodologias', $met)
                        ->with('nivel', $ne)
                        ->with('pin', $pin)
                        ->with('procesoa', $proc)
                        ->with('serpe', $per)
                        ->with('circuns', $cir);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store2(Request $request) {
        $response = "";
        //formulario, pin
        $aspi = Aspirante::find($request->aspirante_id);
        $foin = new Formularioinscripcion();
        $foin->medioinscripcion = "ON LINE";
        $foin->simultaneidad = "NINGUNO";
        $foin->aspirante_id = $request->aspirante_id;
        $foin->estadoadmision = "ASPIRANTE";
        $foin->servicioperiodo_id = $request->servicioperiodo_id;
        $pr = Programaunidad::find($request->programaunidad_id);
        $codigo = substr($pr->programa_id, strlen($pr->programa_id) - 2, 2) . substr(date('Y'), strlen(date('Y')) - 2, 2) . substr($aspi->numero_documento, strlen($aspi->numero_documento) - 3, 3);
        $foin->codigo = $codigo;
        $sp = Servicioperiodo::find($request->servicioperiodo_id);
        if (count($sp) > 0) {
            $foin->tipoinscripcion_id = $sp->servicioinscripcion->tipoinscripcion_id;
        } else {
            $foin->tipoinscripcion_id = 1;
        }
        $pin = Pin::where('pin', $request->pin)->first();
        if ($pin !== null) {
            if ($pin->estado == "USADO") {
                $foin->pin_id = $pin->id;
            } else {
                //no puede seguir la inscripcion
                flash("El PIN que ingresó no ha sido vendido en el banco. Si usted compro el PIN, por favor Acérquese a la oficina de registro y control para validar su PIN.")->error();
                return redirect()->route('inscripcion2', [$request->aspirante_id, $request->servicioperiodo_id, $request->pin, $request->nivel_educativo_id, $request->serpe, $request->procesoa]);
            }
        } else {
            //no puede seguir la inscripcion
            flash("El PIN que ingresó por alguna razón desconocida no pudo ser validado. No puede continuar.")->error();
            return redirect()->route('inscripcion2', [$request->aspirante_id, $request->servicioperiodo_id, $request->pin, $request->nivel_educativo_id, $request->serpe, $request->procesoa]);
        }
        if ($foin->save()) {
            $response = $response . "<p style='font-size:14px; color:green;'>Se ha creado el formulario de inscripción del aspirante</p>";
            //programaXformulario
            $pxf = new Programaxformulario();
            $pxf->prioridad = 1;
            $pxf->puntajeobtenido = 0;
            $pxf->puesto = 0;
            $pxf->formularioinscripcion_id = $foin->id;
            $pxf->programaunidad_id = $request->programaunidad_id;
            $conv = Convocatoria::where([['programaunidad_id', $request->programaunidad_id], ['periodoacademico_id', $sp->periodoacademico_id]])->first();
            if (count($conv) > 0) {
                $pxf->convocatoria_id = $conv->id;
            }
            if ($pxf->save()) {
                $response = $response . "<p style='font-size:14px; color:green;'>El programa que ha seleccionado ha sido asociado al aspirante</p>";
                $requisitos = null;
                if (count($pr) > 0) {
                    $docins = Documentoinscripcion::where([['circunscripcion_id', $request->circunscripcion_id], ['programa_id', $pr->programa_id]])->get();
                    if (count($docins) > 0) {
                        foreach ($docins as $item) {
                            $obj["ob"] = $item->obligatorio;
                            $obj["item"] = $item->tipodocanexo->descripcion;
                            $requisitos[] = $obj;
                        }
                    }
                }
                return view('inscripcion_publico.resultado_inscripcion')
                                ->with('doc', $aspi->id)
                                ->with('requisitos', $requisitos)
                                ->with('rta', $response)
                                ->with('sp', $request->servicioperiodo_id);
            } else {
                $foin->delete();
                flash("El programa seleccionado no pudo ser asociado al aspirante, no se guardó ninguna información. Repita el proceso de inscripción y si persiste el error diríjase a la oficina de registro y control académico.")->error();
                return redirect()->route('inscripcion2', [$request->aspirante_id, $request->servicioperiodo_id, $request->pin, $request->nivel_educativo_id, $request->serpe, $request->procesoa]);
            }
        } else {
            flash("Error desconocido, no se guardó ninguna información. Repita el proceso de inscripción y si persiste el error diríjase a la oficina de registro y control académico.")->error();
            return redirect()->route('inscripcion2', [$request->aspirante_id, $request->servicioperiodo_id, $request->pin, $request->nivel_educativo_id, $request->serpe, $request->procesoa]);
        }
    }

}
