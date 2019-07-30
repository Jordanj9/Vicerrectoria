<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Programaunidad;
use App\Cubrimientoprograma;
use Illuminate\Support\Facades\DB;
use App\Programa;
use App\TipoUnidad;
use App\Tipocubrimientosnies;
use App\Metodologia;
use App\Unidad;

class ProgramaunidadController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
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
        $pu = new Programaunidad($request->all());
        if ($request->relacion === 'L') {
            $c = new Cubrimientoprograma();
            $c->tipocubrimientosnie_codigo = $request->cubrimientoprograma_id;
            $c->metodologia_id = $request->metodologia_id;
        }
        $result = $pu->save();
        if ($result) {
            if ($request->relacion === "L") {
                $c->programaunidad_id = $pu->id;
                $c->save();
            }
            flash("Relación almacenada de forma exitosa!")->success();
            return redirect()->route('programas.unidad', $request->programa_id);
        } else {
            flash("La relación no pudo ser almacenada. Error: " . $result)->error();
            return redirect()->route('programas.unidad', $request->programa_id);
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
        $pu = Programaunidad::find($id);
        $puc = Cubrimientoprograma::where('programaunidad_id', $pu->id)->get();
        $p = Programa::find($pu->programa_id);
        $p->modalidad->NivelEducativo;
        $p->metodologia;
        $p->jornada;
        $tipos = Unidad::all()->pluck('nombre', 'id');
        $r = Programaunidad::where('programa_id', $p->id)->get();
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
                        ->with('modo', 'EDICION')
                        ->with('pu', $pu)
                        ->with('puc', $puc);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $pu = Programaunidad::find($id);
        $pu->unidad_id = $request->unidad_id;
        $pu->relacion = $request->relacion;
        if (isset($request->esfacultad)) {
            $pu->esfacultad = $request->esfacultad;
        }
        if ($request->relacion === 'L') {
            $c = Cubrimientoprograma::where('programaunidad_id', $pu->id)->get();
            $c[0]->tipocubrimientosnie_codigo = $request->cubrimientoprograma_id;
            $c[0]->metodologia_id = $request->metodologia_id;
        }
        $result = $pu->save();
        if ($result) {
            if ($request->relacion === "L") {
                $c[0]->save();
            }
            flash("Relación modificada de forma exitosa!")->success();
            return redirect()->route('programas.unidad', $request->programa_id);
        } else {
            flash("La relación no pudo ser modificada. Error: " . $result)->error();
            return redirect()->route('programas.unidad', $request->programa_id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $pu = Programaunidad::find($id);
        DB::table('cubrimientoprogramas')->where('programaunidad_id', '=', $id)->delete();
        $result = $pu->delete();
        if ($result) {
            flash("Relación eliminada de forma exitosa!")->success();
            return redirect()->route('programas.unidad', $pu->programa_id);
        } else {
            flash("La relación no pudo ser eliminada. Error: " . $result)->error();
            return redirect()->route('programas.unidad', $pu->programa_id);
        }
    }

}
