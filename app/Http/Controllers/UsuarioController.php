<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UsuarioRequest;
use App\Grupousuario;
use Illuminate\Support\Facades\DB;
use App\Estudiantepensum;
use App\Docenteacademico;
use App\Persona;
use App\Personanatural;
use App\TipoUnidad;
use App\Metodologia;
use App\NivelEducativo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $usuarios = User::all();
        $usuarios->each(function ($usuario) {
            $usuario->grupousuarios;
        });
        return view('usuarios.usuarios.list')
                        ->with('location', 'usuarios')
                        ->with('usuarios', $usuarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $grupos = Grupousuario::all()->sortBy('nombre')->pluck('nombre', 'id');
        return view('usuarios.usuarios.create')
                        ->with('location', 'usuarios')
                        ->with('grupos', $grupos);
    }

    /**
     * Show the form for make operations width a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function operaciones() {
        $user = User::where('identificacion', $_POST["id"])->first();
        if ($user === null) {
            flash("<strong>El usuario</strong> consultado no se encuentra registrado!")->error();
            return redirect()->route('admin.usuarios');
        }
        $user->grupousuarios;
        $grupos = Grupousuario::all()->sortBy('nombre')->pluck('nombre', 'id');
        return view('usuarios.usuarios.edit')
                        ->with('location', 'usuarios')
                        ->with('grupos', $grupos)
                        ->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request) {
        $user = new User($request->all());
        foreach ($user->attributesToArray() as $key => $value) {
            if ($key === 'email') {
                $user->$key = $value;
            } elseif ($key === 'password') {
                $user->$key = bcrypt($value);
            } else {
                $user->$key = strtoupper($value);
            }
        }
        $result = $user->save();
        $user->grupousuarios()->sync($request->grupos);
        if ($result) {
            flash("El usuario <strong>" . $user->nombres . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('admin.usuarios');
        } else {
            flash("El usuario <strong>" . $user->nombres . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('admin.usuarios');
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
        $user = User::find($id);
        foreach ($user->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                if ($key === 'email') {
                    $user->$key = $request->$key;
                } elseif ($key !== 'password') {
                    $user->$key = strtoupper($request->$key);
                }
            }
        }
        $result = $user->save();
        $user->grupousuarios()->sync($request->grupos);
        if ($result) {
            flash("El usuario <strong>" . $user->nombres . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('admin.usuarios');
        } else {
            flash("El usuario <strong>" . $user->nombres . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('admin.usuarios');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $user = User::find($id);
        $result = $user->delete();
        DB::table('grupousuario_user')->where('user_id', '=', $id)->delete();
        if ($result) {
            flash("El usuario <strong>" . $user->nombres . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('admin.usuarios');
        } else {
            flash("El usuario <strong>" . $user->nombres . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('admin.usuarios');
        }
    }

    /*
     * convierte los estudiantes en usuario del sistema sino existe
     */

    public function vistaestudiante() {
        $tu = TipoUnidad::pluck('descripcion', 'id');
        $ne = NivelEducativo::pluck('descripcion', 'id');
        $met = Metodologia::pluck('nombre', 'id');
        $grupos = Grupousuario::all()->sortBy('nombre')->pluck('nombre', 'id');
        return view('usuarios.convertir.estudiantes')
                        ->with('location', 'usuarios')
                        ->with('grupos', $grupos)
                        ->with('tu', $tu)
                        ->with('met', $met)
                        ->with('ne', $ne);
    }

    public function convertir(Request $request) {
        $v = explode(';', $request->programa);
        $ep = Estudiantepensum::where([['programaunidad_id', $v[1]], ['pensum_id', $v[2]], ['unidad_id', $request->unidad_id]])->get();
        $si = $no = 0;
        if (count($ep) > 0) {
            foreach ($ep as $e) {
                $e1 = $e->estudiante;
                if ($e1 !== null) {
                    $pn = $e1->personanatural;
                    if ($pn !== null) {
                        $p = $pn->persona;
                        if ($p !== null) {
                            $u = User::where('identificacion', $p->numero_documento)->first();
                            if ($u === null) {
                                $nu = null;
                                $nu = $this->getUser($e);
                                if ($nu->save()) {
                                    $nu->grupousuarios()->sync($request->grupo);
                                    $si = $si + 1;
                                } else {
                                    $no = $no + 1;
                                }
                            }
                        } else {
                            $no = $no + 1;
                        }
                    } else {
                        $no = $no + 1;
                    }
                } else {
                    $no = $no + 1;
                }
            }
            flash("Se han procesado " . $si . " estudiantes correctamente, no se han podido procesar " . $no . " estudiantes. Le recomendamos repetir el proceso si hubo estudiantes sin procesar.")->success();
            return redirect()->route('usuario.vistaestudiante');
        } else {
            flash("No hay estudiantes para procesar")->error();
            return redirect()->route('usuario.vistaestudiante');
        }
    }

    public function getUser($e) {
        $u = new User();
        $u->identificacion = $e->estudiante->personanatural->persona->numero_documento;
        $u->nombres = strtoupper($e->estudiante->personanatural->primer_nombre . " " . $e->estudiante->personanatural->segundo_nombre);
        $u->apellidos = strtoupper($e->estudiante->personanatural->primer_apellido . " " . $e->estudiante->personanatural->segundo_apellido);
        $u->email = $e->estudiante->personanatural->persona->mail;
        $u->password = bcrypt('0000');
        $u->estado = "ACTIVO";
        return $u;
    }

    /*
     * convierte los docentes en usuario del sistema sino existe
     */

    public function vistadocente() {
        $grupos = Grupousuario::all()->sortBy('nombre')->pluck('nombre', 'id');
        return view('usuarios.convertir.docentes')
                        ->with('location', 'usuarios')
                        ->with('grupos', $grupos);
    }

    public function convertirdocente(Request $request) {
        $da = Docenteacademico::all();
        $si = $no = 0;
        if (count($da) > 0) {
            foreach ($da as $d) {
                $pn = $p = null;
                $pn = Personanatural::where('persona_id', $d->pege)->first();
                if ($pn !== null) {
                    $p = $pn->persona;
                    if ($p !== null) {
                        $u = User::where('identificacion', $p->numero_documento)->first();
                        if ($u === null) {
                            $nu = null;
                            $nu = $this->getUser2($pn, $p);
                            if ($nu->save()) {
                                $nu->grupousuarios()->sync($request->grupo);
                                $si = $si + 1;
                            } else {
                                $no = $no + 1;
                            }
                        } else {
                            $no = $no + 1;
                        }
                    } else {
                        $no = $no + 1;
                    }
                } else {
                    $no = $no + 1;
                }
            }
            flash("Se han procesado " . $si . " docentes correctamente, no se han podido procesar " . $no . " docentes. Le recomendamos repetir el proceso si hubo docentes sin procesar.")->success();
            return redirect()->route('usuario.vistadocente');
        } else {
            flash("No hay docentes para procesar")->error();
            return redirect()->route('usuario.vistadocente');
        }
    }

    public function getUser2($pn, $p) {
        $u = new User();
        $u->identificacion = $p->numero_documento;
        $u->nombres = strtoupper($pn->primer_nombre . " " . $pn->segundo_nombre);
        $u->apellidos = strtoupper($pn->primer_apellido . " " . $pn->segundo_apellido);
        $u->email = $p->mail;
        $u->password = bcrypt('0000');
        $u->estado = "ACTIVO";
        return $u;
    }

    /*
     * vista para cambiar la contraseña
     */

    public function vistacontrasenia() {
        return view('pass')->with('location', '');
    }

    /*
     * cambia la contraseña
     */

    public function cambiarcontrasenia(Request $request) {
        $u = Auth::user();
        if ($u !== null) {
            if (Hash::check($request->pass0, $u->password)) {
                if (strlen($request->pass1) < 6 or strlen($request->pass2) < 6) {
                    flash('La nueva contraseña no puede tener menos de 6 caracteres.')->error();
                    return redirect()->route('usuario.vistacontrasenia');
                } else {
                    if ($request->pass1 !== $request->pass2) {
                        flash('Las contraseñas no coinciden.')->error();
                        return redirect()->route('usuario.vistacontrasenia');
                    } else {
                        $u->password = bcrypt($request->pass1);
                        if ($u->save()) {
                            flash('Contraseña cambiada con exito.')->success();
                            return redirect()->route('usuario.vistacontrasenia');
                        } else {
                            flash('La contraseña no pudo ser cambiada.')->error();
                            return redirect()->route('usuario.vistacontrasenia');
                        }
                    }
                }
            } else {
                flash('La contraseña actual ingresada no es correcta.')->error();
                return redirect()->route('usuario.vistacontrasenia');
            }
        } else {
            flash('No se ha podido establecer el usuario, no se cambio la contraseña.')->error();
            return redirect()->route('usuario.vistacontrasenia');
        }
    }

    //cambia la contraseña de cualquier usuario
    public function cambiarPass(Request $request) {
        if (strlen($request->pass1) < 6 or strlen($request->pass2) < 6) {
            flash('La nueva contraseña no puede tener menos de 6 caracteres.')->error();
            return redirect()->route('admin.usuarios');
        } else {
            if ($request->pass1 !== $request->pass2) {
                flash('Las contraseñas no coinciden.')->error();
                return redirect()->route('admin.usuarios');
            } else {
                $u = User::where('identificacion', $request->identificacion2)->first();
                $u->password = bcrypt($request->pass1);
                if ($u->save()) {
                    flash('Contraseña cambiada con exito.')->success();
                    return redirect()->route('admin.usuarios');
                } else {
                    flash('La contraseña no pudo ser cambiada.')->error();
                    return redirect()->route('admin.usuarios');
                }
            }
        }
    }

}
