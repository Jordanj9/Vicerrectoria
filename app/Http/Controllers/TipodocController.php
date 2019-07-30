<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipodoc;
use App\Http\Requests\TipodocRequest;

class TipodocController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tipos = Tipodoc::all();
        return view('academico.datos_generales.tipo_documento.list')
                        ->with('location', 'academico')
                        ->with('tipos', $tipos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('academico.datos_generales.tipo_documento.create')
                        ->with('location', 'academico');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipodocRequest $request) {
        $tipo = new Tipodoc($request->all());
        foreach ($tipo->attributesToArray() as $key => $value) {
            $tipo->$key = strtoupper($value);
        }
        $result = $tipo->save();
        if ($result) {
            flash("El tipo de documento <strong>" . $tipo->descripcion . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('tipodoc.index');
        } else {
            flash("El tipo de documento <strong>" . $tipo->descripcion . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('tipodoc.index');
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
        $tipo = Tipodoc::find($id);
        return view('academico.datos_generales.tipo_documento.edit')
                        ->with('location', 'academico')
                        ->with('tipo', $tipo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $tipo = Tipodoc::find($id);
        foreach ($tipo->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $tipo->$key = strtoupper($request->$key);
            }
        }
        $result = $tipo->save();
        if ($result) {
            flash("El tipo de documento <strong>" . $tipo->descripcion . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('tipodoc.index');
        } else {
            flash("El tipo de documento <strong>" . $tipo->descripcion . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('tipodoc.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $tipo = Tipodoc::find($id);
        if (count($tipo->personas) > 0) {
            flash("El tipo de documento <strong>" . $tipo->descripcion . "</strong> no pudo ser eliminado porque tiene personas asociadss.")->warning();
            return redirect()->route('tipodoc.index');
        } else {
            $result = $tipo->delete();
            if ($result) {
                flash("El tipo de documento <strong>" . $tipo->descripcion . "</strong> fue eliminado de forma exitosa!")->success();
                return redirect()->route('tipodoc.index');
            } else {
                flash("El tipo de documento <strong>" . $tipo->descripcion . "</strong> no pudo ser eliminado. Error: " . $result)->error();
                return redirect()->route('tipodoc.index');
            }
        }
    }

}
