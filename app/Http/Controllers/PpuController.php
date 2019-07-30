<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoPeriodo;
use App\Unidad;
use App\Ppu;
use Illuminate\Support\Collection;

class PpuController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $ppus = Ppu::all();
        $ppus->each(function($item) {
            $item->unidad;
            $item->periodoacademico->TipoPeriodo;
        });
        return view('academico.recursos_academicos.calendario_academico.programar_periodo.list')
                        ->with('location', 'academico')
                        ->with('ppus', $ppus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $tipos = TipoPeriodo::all()->pluck('descripcion', 'id');
        $unds = Unidad::where('regional', '1')->pluck('nombre', 'id');
        return view('academico.recursos_academicos.calendario_academico.programar_periodo.create')
                        ->with('location', 'academico')
                        ->with('tipos', $tipos)
                        ->with('unds', $unds);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $periodo = new Ppu($request->all());
        $result = $periodo->save();
        if ($result) {
            flash("El período fue asociado a la unidad de forma exitosa!")->success();
            return redirect()->route('ppa.index');
        } else {
            flash("El período no pudo ser asociado a la unidad. Error: " . $result)->error();
            return redirect()->route('ppa.index');
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
        $periodo = Ppu::find($id);
        $result = $periodo->delete();
        if ($result) {
            flash("El período fue eliminado de forma exitosa!")->success();
            return redirect()->route('ppa.index');
        } else {
            flash("El período no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('ppa.index');
        }
    }

    /**
     * more options for asociación unidad-periodo
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function more($id) {
        $p = Ppu::find($id);
        $p->periodoacademico->TipoPeriodo;
        $p->unidad->ciudad;
        return view('academico.recursos_academicos.calendario_academico.programar_periodo.programar.menu')
                        ->with('location', 'academico')
                        ->with('p', $p);
    }

    /**
     * show all resource from a tipoperiodo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function periodos($id) {
        $tipo = Ppu::where('unidad_id', $id)->get();
        $periodo = collect();
        foreach ($tipo as $item){
            $periodo[] = $item->periodoacademico;
        }
        $periodos = $periodo->sortByDesc('anio');
        if (count($periodos) > 0) {
            $periodosf = null;
            foreach ($periodos as $value) {
                $obj["id"] = $value->id;
                $obj["value"] = $value->anio . " - " . $value->periodo." --> ".$value->TipoPeriodo->descripcion;
                $periodosf[] = $obj;
            }
            return json_encode($periodosf);
        } else {
            return "null";
        }
    }

}
