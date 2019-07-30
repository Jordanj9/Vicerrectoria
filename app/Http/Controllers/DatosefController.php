<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Espaciofisico;
use App\Http\Requests\EspaciofisicoRequest;
use App\Localidad;
use App\Tipoposesion;
use App\Tiposef;
use App\AuditoriaAcademico;
use Illuminate\Support\Facades\Auth;

class DatosefController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $ef = Espaciofisico::all();
        $ef->each(function($item) {
            $item->tipoposesion;
            $item->tiposef;
            $item->localidad;
        });
        return view('academico.recursos_academicos.recursos_fisicos.datosef.list')
                        ->with('location', 'academico')
                        ->with('ef', $ef);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $l = Localidad::pluck('descripcion', 'id');
        $tef = Tiposef::pluck('descripcion', 'id');
        $tp = Tipoposesion::pluck('descripcion', 'id');
        return view('academico.recursos_academicos.recursos_fisicos.datosef.create')
                        ->with('location', 'academico')
                        ->with('l', $l)
                        ->with('tef', $tef)
                        ->with('tp', $tp);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EspaciofisicoRequest $request) {
        $ef = new Espaciofisico($request->all());
        foreach ($ef->attributesToArray() as $key => $value) {
            $ef->$key = strtoupper($value);
        }
        $result = $ef->save();
        if ($result) {
            $aud = new AuditoriaAcademico();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE ESPACIOS FÍSICOS. DATOS: ";
            foreach ($ef->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El espacio físico <strong>" . $ef->descripcion . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('datosef.index');
        } else {
            flash("El espacio físico <strong>" . $ef->descripcion . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('datosef.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $ef = Espaciofisico::find($id);
        $ef->tipoposesion;
        $ef->tiposef;
        $ef->localidad;
        return view('academico.recursos_academicos.recursos_fisicos.datosef.show')
                        ->with('location', 'academico')
                        ->with('ef', $ef);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $l = Localidad::pluck('descripcion', 'id');
        $tef = Tiposef::pluck('descripcion', 'id');
        $tiposp = Tipoposesion::pluck('descripcion', 'id');
        $ef = Espaciofisico::find($id);
        return view('academico.recursos_academicos.recursos_fisicos.datosef.edit')
                        ->with('location', 'academico')
                        ->with('l', $l)
                        ->with('tef', $tef)
                        ->with('tiposp', $tiposp)
                        ->with('ef', $ef);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $l = Espaciofisico::find($id);
        $lo = new Espaciofisico($l->attributesToArray());
        foreach ($l->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $l->$key = strtoupper($request->$key);
            }
        }
        $result = $l->save();
        if ($result) {
            $aud = new AuditoriaAcademico();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICIÓN DE DATOS DEL ESPACIO FISICO. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($lo->attributesToArray() as $key => $value) {
                if ($key == 'tipoposesion_id') {
                    $str2 = $str2 . ", " . $key . ": " . $value . ", tipoposesion:" . $lo->tipoposesion->descripcion;
                } elseif ($key == 'tiposef_id') {
                    $str2 = $str2 . ", " . $key . ": " . $value . ", tiposef:" . $lo->tiposef->descripcion;
                } elseif ($key == 'localidad_id') {
                    $str2 = $str2 . ", " . $key . ": " . $value . ", localidad:" . $lo->localidad->descripcion;
                } else {
                    $str2 = $str2 . ", " . $key . ": " . $value;
                }
            }
            foreach ($l->attributesToArray() as $key => $value) {
                if ($key == 'tipoposesion_id') {
                    $str = $str . ", " . $key . ": " . $value . ", tipoposesion:" . $l->tipoposesion->descripcion;
                } elseif ($key == 'tiposef_id') {
                    $str = $str . ", " . $key . ": " . $value . ", tiposef:" . $l->tiposef->descripcion;
                } elseif ($key == 'localidad_id') {
                    $str2 = $str2 . ", " . $key . ": " . $value . ", localidad:" . $l->localidad->descripcion;
                } else {
                    $str = $str . ", " . $key . ": " . $value;
                }
            }
            $aud->detalles = $str . " - " . $str2;
            $aud->save();
            flash("El Espacio Fisico <strong>" . $l->descripcion . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('datosef.index');
        } else {
            flash("El Espacio Fisico <strong>" . $l->descripcion . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('datosef.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $ef = Espaciofisico::find($id);
//        if (count($l->localidads) > 0) {
//            flash("El Tipo de posesión <strong>" . $l->descripcion . "</strong> no fue eliminado porque tiene localidades asociadas.")->warning();
//            return redirect()->route('losesion.index');
//        } else {
        $result = $ef->delete();
        if ($result) {
            $aud = new AuditoriaAcademico();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE DATOS DEL ESPACIO FISICO. DATOS ELIMINADOS: ";
            foreach ($ef->attributesToArray() as $key => $value) {
                if ($key == 'tipoposesion_id') {
                    $str = $str . ", " . $key . ": " . $value . ", tipoposesion:" . $ef->tipoposesion->descripcion;
                } elseif ($key == 'tiposef_id') {
                    $str = $str . ", " . $key . ": " . $value . ", tiposef:" . $ef->tiposef->descripcion;
                } elseif ($key == 'localidad_id') {
                    $str = $str . ", " . $key . ": " . $value . ", localidad:" . $ef->localidad->descripcion;
                } else {
                    $str = $str . ", " . $key . ": " . $value;
                }
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El Espacio Fisico <strong>" . $ef->descripcion . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('datosef.index');
        } else {
            flash("El Espacio Fisico <strong>" . $ef->descripcion . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('datosef.index');
        }
        //}
    }

    /**
     * show all resource from a estado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function recursosfisicos($id) {
        $ef = Espaciofisico::find($id);
        if ($ef !== null) {
            $rf = $ef->recursofisicos;
            if (count($rf) > 0) {
                $espaciosf = null;
                foreach ($rf as $value) {
                    $obj["id"] = $value->id;
                    $str = "RECURSO: " . $value->nomenclatura . ",   CAPACIDAD REAL: " . $value->capreal . ",   NIVEL: " . $value->nivel;
                    if ($value->estado == "I") {
                        $str = $str . ",   ESTADO: DESOCUPADO";
                    } else {
                        $str = $str . ",   ESTADO: OCUPADO";
                    }
                    $obj["value"] = $str;
                    $espaciosf[] = $obj;
                }
                return json_encode($espaciosf);
            } else {
                return "null";
            }
        } else {
            return "null";
        }
    }

}
