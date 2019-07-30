<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facultad;
use App\AuditoriaAcademico;

class FacultadController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $facultades = Facultad::all();
        return view('academico.recursos_academicos.estructura_curricular.informacion_basica.facultad.list')
                        ->with('location', 'academico')
                        ->with('facultades', $facultades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('academico.recursos_academicos.estructura_curricular.informacion_basica.facultad.create')
                        ->with('location', 'academico');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $facultad = new Facultad($request->all());
        foreach ($facultad->attributesToArray() as $key => $value) {
            $facultad->$key = strtoupper($value);
        }
        $result = $facultad->save();
        if ($result) {
            flash("La Facultad <strong>" . $facultad->nombre . "</strong> fue almacenada de forma exitosa!")->success();
            return redirect()->route('facultad.index');
        } else {
            flash("La Facultad <strong>" . $facultad->nombre . "</strong> no pudo ser almacenada. Error: " . $result)->error();
            return redirect()->route('facultad.index');
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
        $facultad = Facultad::find($id);
        return view('academico.recursos_academicos.estructura_curricular.informacion_basica.facultad.edit')
                        ->with('location', 'academico')
                        ->with('facultad', $facultad);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $facultad = Facultad::find($id);
        foreach ($facultad->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $facultad->$key = strtoupper($request->$key);
            }
        }
        $result = $facultad->save();
        if ($result) {
            flash("La Facultad <strong>" . $facultad->nombre . "</strong> fue modificada de forma exitosa!")->success();
            return redirect()->route('facultad.index');
        } else {
            flash("La Facultad <strong>" . $facultad->nombre . "</strong> no pudo ser modificada. Error: " . $result)->error();
            return redirect()->route('facultad.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $facultad = Facultad::find($id);
        if (count($facultad->departamentos) > 0) {
            flash("La Facultad <strong>" . $facultad->nombre . "</strong> no pudo ser eliminada porque tiene departamentos asociados.")->warning();
            return redirect()->route('facultad.index');
        } else {
            $result = $facultad->delete();
            if ($result) {
                flash("La Facultad <strong>" . $facultad->nombre . "</strong> fue eliminada de forma exitosa!")->success();
                return redirect()->route('facultad.index');
            } else {
                flash("La Facultad <strong>" . $facultad->nombre . "</strong> no pudo ser eliminada. Error: " . $result)->error();
                return redirect()->route('facultad.index');
            }
        }
    }

    /**
     * show all resource from a facultad.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDepartamentos($id) {
        $facultad = Facultad::find($id);
        $deptos = $facultad->departamentos;
        if (count($deptos) > 0) {
            $departamentos = null;
            foreach ($deptos as $value) {
                $obj["id"] = $value->id;
                $obj["value"] = $value->nombre;
                $departamentos[] = $obj;
            }
            return json_encode($departamentos);
        } else {
            return "null";
        }
    }

}
