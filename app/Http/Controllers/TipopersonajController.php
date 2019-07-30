<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipopersonaj;
use App\Http\Requests\TipopersonajRequest;

class TipopersonajController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tipos = Tipopersonaj::all();
        return view('academico.datos_generales.instituciones.datos_generales.tipo_persona_juridica.list')
                        ->with('location', 'academico')
                        ->with('tipos', $tipos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('academico.datos_generales.instituciones.datos_generales.tipo_persona_juridica.create')
                        ->with('location', 'academico');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipopersonajRequest $request) {
        $tipopersonaj = new Tipopersonaj($request->all());
        foreach ($tipopersonaj->attributesToArray() as $key => $value) {
            $tipopersonaj->$key = strtoupper($value);
        }
        $result = $tipopersonaj->save();
        if ($result) {
            flash("El tipo de persona jurídica <strong>" . $tipopersonaj->descripcion . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('tipopersonaj.index');
        } else {
            flash("El tipo de persona jurídica <strong>" . $tipopersonaj->descripcion . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('tipopersonaj.index');
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
        $tipopersonaj = Tipopersonaj::find($id);
        return view('academico.datos_generales.instituciones.datos_generales.tipo_persona_juridica.edit')
                        ->with('location', 'academico')
                        ->with('tipopersonaj', $tipopersonaj);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $tipopersonaj = Tipopersonaj::find($id);
        foreach ($tipopersonaj->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $tipopersonaj->$key = strtoupper($request->$key);
            }
        }
        $result = $tipopersonaj->save();
        if ($result) {
            flash("El tipo de persona jurídica <strong>" . $tipopersonaj->descripcion . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('tipopersonaj.index');
        } else {
            flash("El tipo de persona jurídica <strong>" . $tipopersonaj->descripcion . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('tipopersonaj.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $tipopersonaj = Tipopersonaj::find($id);
//        if (count($tipopersonaj->personas) > 0) {
//            flash("El tipo de persona jurídica <strong>" . $tipopersonaj->descripcion . "</strong> no pudo ser eliminado porque tiene personas asociadss.")->warning();
//            return redirect()->route('tipopersonaj.index');
//        } else {
        $result = $tipopersonaj->delete();
        if ($result) {
            flash("El tipo de persona jurídica <strong>" . $tipopersonaj->descripcion . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('tipopersonaj.index');
        } else {
            flash("El tipo de persona jurídica <strong>" . $tipopersonaj->descripcion . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('tipopersonaj.index');
        }
//        }
    }

}
