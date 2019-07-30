<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personanatural;
use App\Http\Requests\PnaturalRequest;
use App\Estadocivil;
use App\Tipodoc;
use App\Persona;
use App\Facultad;
use App\Cargo;

class PnaturalesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $docentes = Personanatural::all();
        return view('academico.recursos_academicos.carga_administrativa.personas_naturales.list')
                        ->with('location', 'academico')
                        ->with('docentes', $docentes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $tipodocs = Tipodoc::where('tipo_persona', 'N')->get()->pluck('descripcion', 'id');
        $facultades = Facultad::all()->pluck('nombre', 'id');
        return view('academico.recursos_academicos.carga_administrativa.personas_naturales.create')
                        ->with('location', 'academico')
                        ->with('tipodocs', $tipodocs)
                        ->with('facultades', $facultades);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $persona = new Persona();
        $persona->tipopersona = '1';
        $persona->direccion = strtoupper($request->direccion);
        $persona->mail = $request->email;
        $persona->celular = $request->telefono2;
        $persona->telefono = $request->telefono1;
        $persona->telefono2 = $request->telefono2;
        $persona->tipodoc_id = $request->tipodoc_id;
        $persona->numero_documento = $request->numero_documento;
        $persona->fecha_expedicion = $request->fecha_expedicion;
        $persona->lugar_expedicion = strtoupper($request->lugar_expedicion);
        $result = $persona->save();
        if ($result) {
            $pnatural = new Personanatural();
            $pnatural->primer_nombre = strtoupper($request->primer_nombre);
            $pnatural->segundo_nombre = strtoupper($request->segundo_nombre);
            $pnatural->primer_apellido = strtoupper($request->primer_apellido);
            $pnatural->segundo_apellido = strtoupper($request->segundo_apellido);
            $pnatural->sexo = $request->sexo;
            $pnatural->fecha_nacimiento = $request->fecha_nacimiento;
            $pnatural->libreta_militar = $request->libreta_militar;
            $pnatural->distrito_militar = $request->distrito_militar;
            $pnatural->rh = $request->rh;
            $pnatural->email_institucional = $request->email_institucional;
            $pnatural->persona_id = $persona->id;
            $pnatural->departamento_id = $request->departamento_id;
            $result2 = $pnatural->save();
            if ($result2) {
                flash("La Persona <strong>" . $pnatural->primer_nombre . " " . $persona->primer_apellido . "</strong> fue almacenado de forma exitosa!")->success();
                return redirect()->route('pnaturales.index');
            } else {
                $persona->delete();
                flash("La Persona <strong>" . $pnatural->primer_nombre . " " . $persona->primer_apellido . "</strong> no pudo ser almacenado. Error: " . $result2)->error();
                return redirect()->route('pnaturales.index');
            }
        } else {
            flash("La Persona con Identificación <strong>" . $persona->numero_documento . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('pnaturales.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $p = Personanatural::find($id);
        if ($p !== null) {
            $pe = $p->persona;
            if ($pe !== null) {
                $p->departamento;
                $p->cargo;
                $p->persona->tipodoc;
                return view('academico.recursos_academicos.carga_administrativa.personas_naturales.show')
                                ->with('location', 'academico')
                                ->with('p', $p);
            } else {
                flash("La Persona <strong>que está buscando</strong> no se encuentra registrada")->warning();
                return redirect()->route('pnaturales.index');
            }
        } else {
            flash("La Persona <strong>que está buscando</strong> no se encuentra registrada")->warning();
            return redirect()->route('pnaturales.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $p = Personanatural::find($id);
        if ($p === null) {
            flash("La Persona <strong>que está buscando</strong> no se encuentra registrada")->warning();
            return redirect()->route('pnaturales.index');
        }
        $pe = $p->persona;
        $p->persona->tipodoc;
        $tipodocs = Tipodoc::where('tipo_persona', 'N')->get()->pluck('descripcion', 'id');
        $facultades = Facultad::all()->pluck('nombre', 'id');
        $cargos = Cargo::all()->pluck('nombre', 'id');
        return view('academico.recursos_academicos.carga_administrativa.personas_naturales.edit')
                        ->with('location', 'academico')
                        ->with('p', $p)
                        ->with('tipodocs', $tipodocs)
                        ->with('facultades', $facultades);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $pnatural = Personanatural::find($id);
        $persona = Persona::find($pnatural->persona_id);
        $persona->tipopersona = '1';
        $persona->direccion = strtoupper($request->direccion);
        $persona->mail = $request->email;
        $persona->celular = $request->telefono2;
        $persona->telefono = $request->telefono1;
        $persona->direccion2 = strtoupper($request->direccion_correspondencia);
        $persona->telefono2 = $request->telefono2;
        $persona->tipodoc_id = $request->tipodoc_id;
        $persona->numero_documento = $request->numero_documento;
        $persona->fecha_expedicion = $request->fecha_expedicion;
        $persona->lugar_expedicion = strtoupper($request->lugar_expedicion);
        $result = $persona->save();
        if ($result) {
            $pnatural->primer_nombre = strtoupper($request->primer_nombre);
            $pnatural->segundo_nombre = strtoupper($request->segundo_nombre);
            $pnatural->primer_apellido = strtoupper($request->primer_apellido);
            $pnatural->segundo_apellido = strtoupper($request->segundo_apellido);
            $pnatural->sexo = $request->sexo;
            $pnatural->fecha_nacimiento = $request->fecha_nacimiento;
            $pnatural->libreta_militar = $request->libreta_militar;
            $pnatural->distrito_militar = $request->distrito_militar;
            $pnatural->rh = $request->rh;
            $pnatural->email_institucional = $request->email_institucional;
            $pnatural->persona_id = $persona->id;
            $pnatural->departamento_id = $request->departamento_id;
            $result2 = $pnatural->save();
            if ($result2) {
                flash("La Persona <strong>" . $pnatural->primer_nombre . " " . $persona->primer_apellido . "</strong> fue modificada de forma exitosa!")->success();
                return redirect()->route('pnaturales.index');
            } else {
                flash("La Persona <strong>" . $pnatural->primer_nombre . " " . $persona->primer_apellido . "</strong> no pudo ser modificada. Error: " . $result2)->error();
                return redirect()->route('pnaturales.index');
            }
        } else {
            flash("La Persona con Identificación <strong>" . $persona->numero_documento . "</strong> no pudo ser modificada. Error: " . $result)->error();
            return redirect()->route('pnaturales.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $pn = Personanatural::find($id);
        $p = $pn->persona;
        if(count($pn->docenteacademicos) > 0){
            dd($p);
            flash("El docente no pudo ser eliminado porque es un docente en comisión.")->error();
            return redirect()->route('pnaturales.index');
        }
        $result = $p->delete();
        if ($result) {
            flash("El docente fue eliminado de forma exitosa!")->success();
            return redirect()->route('pnaturales.index');
        } else {
            flash("El docente no pudo ser eliminado")->error();
            return redirect()->route('pnaturales.index');
        }
    }

    /**
     * get a persona natural to user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function personaNatural($id) {
        $p = Persona::where('numero_documento', $id)->first();
        $response = null;
        $response["error"] = "SI";
        if ($p !== null) {
            $pn = $p->personanaturals;
            if ($pn !== null) {
                $response["error"] = "NO";
                $response["identificacion"] = $id;
                $response["nombres"] = $pn[0]->primer_nombre . " " . $pn[0]->segundo_nombre;
                $response["apellidos"] = $pn[0]->primer_apellido . " " . $pn[0]->segundo_apellido;
                $response["mail"] = $p->mail;
            } else {
                $response["msg"] = "La persona con Identificación " . $id . " no es una persona natural.";
            }
        } else {
            $response["msg"] = "Ninguna coincidencia encontrada para Identificación: " . $id;
        }
        return json_encode($response);
    }

    /**
     * get a persona natural to user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function personaNatural2($id) {
        $p = Persona::where('numero_documento', $id)->get();
        $response = null;
        $response["error"] = "SI";
        $p1 = $p2 = null;
        if (count($p) > 0) {
            foreach ($p as $value) {
                $pn = $value->personanaturals;
                if (count($pn) > 0) {
                    foreach ($pn as $item) {
                        $o['id'] = $item->id;
                        $o["identificacion"] = $id;
                        $o["nombres"] = $item->primer_nombre . " " . $item->segundo_nombre;
                        $o["apellidos"] = $item->primer_apellido . " " . $item->segundo_apellido;
                        $o["mail"] = $value->mail;
                        $p1[] = $o;
                        $p2[$item->id] = $item->primer_nombre . " " . $item->segundo_nombre . " " . $item->primer_apellido . " " . $item->segundo_apellido . " - FECHA REGISTRO:" . $item->created_at;
                    }
                }
            }
            if (count($p1) > 0) {
                $response["error"] = "NO";
                $response["data1"] = $p1;
                $response["data2"] = $p2;
            } else {
                $response["msg"] = "La persona con Identificación " . $id . " no es una persona natural.";
            }
        } else {
            $response["msg"] = "Ninguna coincidencia encontrada para Identificación: " . $id;
        }
        return json_encode($response);
    }

}
