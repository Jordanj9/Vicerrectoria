<html>
    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css')}}">
        <style>
            body{
                font-size: 12px;
            }
            .bar{
                padding: 3px 3px 3px 3px;
                width: 100%;
                color: #FFFFFF;
                text-align: center;
                font-size: 14px;
                font-weight: bold;
            }
            .bar-a{
                background-color: #1c84c6 !important;
            }
            .bar-n{
                background-color: #ed4c1b !important;
            }
            .bar-x{
                background-color: #f0f3f4 !important;
            }
            .tb{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-md-12">
                <p style="text-align: left;">Fecha de Generación: {{$hoy}}  - Infotep - La Guajira</p>
            </div>
            <div class="bar bar-a" style="font-size: 20px !important;">Hoja de Vida del Estudiante</div>
            <div class="bar bar-n">Datos Personales</div>
            <div>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center" align="center">Identificacion</th>
                            <th align="center" align="center">Nombre</th>
                            <th align="center" align="center">Lugar de Expedición</th>
                            <th align="center" align="center">Fecha de Expedición</th>
                            <th align="center" align="center">Libreta</th>
                            <th align="center" align="center">Distrito</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$identificacion}}</td>
                            <td>{{$nombre}}</td>
                            <td>{{$lugar_expedicion}}</td>
                            <td>{{$fecha_expedicion}}</td>
                            <td>{{$libreta}}</td>
                            <td>{{$distrito}}</td>
                        </tr>
                    </tbody>
                </table>  
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center" align="center">Estado Civil</th>
                            <th align="center" align="center">Rh</th>
                            <th align="center" align="center">Sexo</th>
                            <th align="center" align="center">Fecha de Nacimiento</th>
                            <th align="center" align="center">Pais</th>
                            <th align="center" align="center">Departamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$estadocivil}}</td>
                            <td>{{$rh}}</td>
                            <td>{{$sexo}}</td>
                            <td>{{$fecha_nacimiento}}</td>
                            <td>{{$paisn}}</td>
                            <td>{{$departamenton}}</td>

                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center" align="center">Ciudad </th>
                            <th align="center" align="center">Dirección </th>
                            <th align="center" align="center">Pais de Residencia</th>
                            <th align="center" align="center">Departamento de Residencia</th>
                            <th align="center" align="center">Ciudad de Residencia</th>
                            <th align="center" align="center">Telefono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$ciudadn}}</td>
                            <td>{{$direccion}}</td>
                            <td>{{$paisu}}</td>
                            <td>{{$departamento}}</td>
                            <td>{{$ciudadu}}</td>
                            <td>{{$telefono}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center" align="center">Celular </th>
                            <th align="center" align="center">Email </th>
                            <th align="center" align="center">Email Institucional</th>
                            <th align="center" align="center">Num. Pasaporte</th>
                            <th align="center" align="center">Otra Nacionalidad</th>
                            <th align="center" align="center">Religión</th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$celular}}</td>
                            <td>{{$email}}</td>
                            <td>{{$email_institucional}}</td>
                            <td>{{$num_pasaporte}}</td>
                            <td>{{$otra_nacionalidad}}</td>
                            <td>{{$religion}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bar bar-n">Información Académica</div>
            <div>
                @if($academica !== null)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Periodo Cronologico</th>
                            <th align="center">Fecha d Ingreso</th>
                            <th align="center">Creditos Aprobados</th>
                            <th align="center">Codigo Matricula</th>
                            <th align="center">Periodo Acdémico</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$academica['periodocronologico']}}</td>
                            <td>{{$academica['fechaingreso']}}</td>
                            <td>{{$academica['creditosaprobados']}}</td>
                            <td>{{$academica['codigomatricula']}}</td>
                            <td>{{$academica['periodoacademico']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Promedio General</th>
                            <th align="center">Promedio Semestre</th>
                            <th align="center">Estado</th>
                            <th align="center">Situación</th>
                            <th align="center">Categoria</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$academica['promediogeneral']}}</td>
                            <td>{{$academica['promediosemestre']}}</td>
                            <td>{{$academica['estado']}}</td>
                            <td>{{$academica['situacionestudiante']}}</td>
                            <td>{{$academica['categoria']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Pensum</th>
                            <th align="center">Programa</th>
                            <th align="center">Unidad</th>
                            <th align="center">Tipo de Inscripción</th>
                            <th align="center">Fecha Vigencia Norma</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$academica['pensum']}}</td>
                            <td>{{$academica['programa']}}</td>
                            <td>{{$academica['unidad']}}</td>
                            <td>{{$academica['tipoinscripcion']}}</td>
                            <td>{{$academica['fechavigencianorma']}}</td>
                        </tr>
                    </tbody>
                </table>
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Periodo Cronologico</th>
                            <th align="center">Fecha d Ingreso</th>
                            <th align="center">Creditos Aprobados</th>
                            <th align="center">Codigo Matricula</th>
                            <th align="center">Periodo Acdémico</th>
                        </tr>
                    </thead>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Promedio General</th>
                            <th align="center">Promedio Semestre</th>
                            <th align="center">Estado</th>
                            <th align="center">Situación</th>
                            <th align="center">Categoria</th>
                        </tr>
                    </thead>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Pensum</th>
                            <th align="center">Programa</th>
                            <th align="center">Unidad</th>
                            <th align="center">Tipo de Inscripción</th>
                            <th align="center">Fecha Vigencia Norma</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Grupo Familiar</div>
            <div>
                @if($grupofamiliar !== null)
                @foreach($grupofamiliar as $t)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Identificación</th>
                            <th align="center">Nombre</th>
                            <th align="center">Vive</th>
                            <th align="center">Ocupación</th>
                            <th align="center">Nivel Educativo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$t['cedula']}}</td>
                            <td>{{$t['nombrec']}}</td>
                            <td>{{$t['vive']}}</td>
                            <td>{{$t['ocupacion']}}</td>
                            <td>{{$t['niveleducativo']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Dirección</th>
                            <th align="center">Ciudad</th>
                            <th align="center">Lugar de Ocupación</th>
                            <th align="center">Edad</th>
                            <th align="center">Ingreso Mensual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$t['direccion']}}</td>
                            <td>{{$t['ciudad']}}</td>
                            <td>{{$t['sitio']}}</td>
                            <td>{{$t['edad']}}</td>
                            <td>{{$t['ingreso']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Telefono</th>
                            <th align="center">Institución</th>
                            <th align="center">Celular</th>
                            <th align="center">Cargo</th>
                            <th align="center">Rango Ingreso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$t['telefonoresidencia']}}</td>
                            <td>{{$t['nombreinstestudio']}}</td>
                            <td>{{$t['celular']}}</td>
                            <td>{{$t['cargo']}}</td>
                            <td>{{$t['ingresorango']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Ciudad Residencia</th>
                            <th align="center">Pais de Residencia</th>
                            <th align="center">Profesión</th>
                            <th align="center">Dirección de Trabajo</th>
                            <th align="center">Lee</th>
                            <th align="center">Parentesco</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$t['ciudadresidencia']}}</td>
                            <td>{{$t['paistrabajo']}}</td>
                            <td>{{$t['profesion']}}</td>
                            <td>{{$t['direccionempresa']}}</td>
                            <td>{{$t['lee']}}</td>
                            <td>{{$t['parentesco']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Identificación</th>
                            <th align="center">Vive</th>
                            <th align="center">Ocupación</th>
                            <th align="center">Nivel Educativo</th>
                            <th align="center">Dirección</th>
                        </tr>
                    </thead>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Dirección</th>
                            <th align="center">Ciudad</th>
                            <th align="center">Lugar de Ocupación</th>
                            <th align="center">Edad</th>
                            <th align="center">Ingreso Mensual</th>
                        </tr>
                    </thead>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Telefono</th>
                            <th align="center">Institución</th>
                            <th align="center">Celular</th>
                            <th align="center">Cargo</th>
                            <th align="center">Rango Ingreso</th>
                        </tr>
                    </thead>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Ciudad Residencia</th>
                            <th align="center">Pais de Residencia</th>
                            <th align="center">Profesión</th>
                            <th align="center">Dirección de Trabajo</th>
                            <th align="center">Lee</th>
                            <th align="center">Parentesco</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Jefes de Familia</div>
            <div>
                @if($jefesfamilia !== null)
                @foreach($jefesfamilia as $e)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Cedula</th>
                            <th align="center">Nombre</th>
                            <th align="center">Cargo</th>
                            <th align="center">Empresa</th>
                            <th align="center">Tiempo de Servicio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$e['cedula']}}</td>
                            <td>{{$e['nombrej']}}</td>
                            <td>{{$e['cargo']}}</td>
                            <td>{{$e['empresa']}}</td>
                            <td>{{$e['tiemposervicio']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Telefono del Trabajo</th>
                            <th align="center">Jefe Inmediato</th>
                            <th align="center">Dirección Laboral</th>
                            <th align="center">Ciudad</th>
                            <th align="center">Sueldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$e['teltrabajo']}}</td>
                            <td>{{$e['jefeinmediato']}}</td>
                            <td>{{$e['dirempresa']}}</td>
                            <td>{{$e['ciudad']}}</td>
                            <td>{{$e['sueldo']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Num. Personas a Cargo</th>
                            <th align="center">Jefe</th>
                            <th align="center">Celular</th>
                            <th align="center">Parentesco</th>
                            <th align="center">Ocupación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$e['numpersonascargo']}}</td>
                            <td>{{$e['jefe']}}</td>
                            <td>{{$e['celular']}}</td>
                            <td>{{$e['parentesco']}}</td>
                            <td>{{$e['ocupacion']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Nivel Educativo</th>
                            <th align="center">Ingresos</th>
                            <th align="center">Costea Estudios</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$e['niveleducativo']}}</td>
                            <td>{{$e['ingresos']}}</td>
                            <td>{{$e['costeaestudios']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Cedula</th>
                            <th align="center">Nombre</th>
                            <th align="center">Cargo</th>
                            <th align="center">Empresa</th>
                            <th align="center">Tiempo de Servicio</th>
                        </tr>
                    </thead>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Telefono del Trabajo</th>
                            <th align="center">Jefe Inmediato</th>
                            <th align="center">Dirección Laboral</th>
                            <th align="center">Ciudad</th>
                            <th align="center">Sueldo</th>
                        </tr>
                    </thead>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Num. Personas a Cargo</th>
                            <th align="center">Jefe</th>
                            <th align="center">Celular</th>
                            <th align="center">Parentesco</th>
                            <th align="center">Ocupación</th>
                        </tr>
                    </thead>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Nivel Educativo</th>
                            <th align="center">Ingresos</th>
                            <th align="center">Costea Estudios</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Idiomas</div>
            <div>
                @if($idiomas !== null)
                @foreach($idiomas as $p)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Idioma</th>
                            <th align="center">Lee</th>
                            <th align="center">Escribre</th>
                            <th align="center">Habla</th>
                            <th align="center">Escucha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$p['idioma']}}</td>
                            <td>{{$p['lee']}}</td>
                            <td>{{$p['escribe']}}</td>
                            <td>{{$p['habla']}}</td>
                            <td>{{$p['oir']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Idioma</th>
                            <th align="center">Lee</th>
                            <th align="center">Escribre</th>
                            <th align="center">Habla</th>
                            <th align="center">Escucha</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Pasatiempos</div>
            <div>
                @if($pasatiempos !== null)
                @foreach($pasatiempos as $r)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Pasatiempo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$r['pasatiempo']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Pasatiempo</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Estudios Secundarios</div>
            <div>
                @if($secundarios !== null)
                @foreach($secundarios as $a)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Titulo Obtenido</th>
                            <th align="center">Enfasis</th>
                            <th align="center">Codigo SNP</th>
                            <th align="center">Pais</th>
                            <th align="center">Fecha de Terminación</th>
                            <th align="center">Pension de 10</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['tituloobtenido']}}</td>
                            <td>{{$a['enfasis_mod_sec']}}</td>
                            <td>{{$a['codigo_snp']}}</td>
                            <td>{{$a['pais']}}</td>
                            <td>{{$a['fechaterminacion']}}</td>
                            <td>{{$a['valorpension10']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Pensión de 11</th>
                            <th align="center">Forma Obtuvo Titulo</th>
                            <th align="center">SNP</th>
                            <th align="center">Tipo Prueba</th>
                            <th align="center">Puntaje Obtenido</th>
                            <th align="center">Ciudad Presento Prueba</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['valorpension11']}}</td>
                            <td>{{$a['formaobtuvotitulo']}}</td>
                            <td>{{$a['snp']}}</td>
                            <td>{{$a['tipoprueba']}}</td>
                            <td>{{$a['puntajeobtenido']}}</td>
                            <td>{{$a['ciudadpresentoprueba']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Fecha de Presentación Prueba</th>
                            <th align="center">Colegio</th>
                            <th align="center">Libro</th>
                            <th align="center">Folio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['fechapresentoprueba']}}</td>
                            <td>{{$a['caracter_colegio']}}</td>
                            <td>{{$a['libro']}}</td>
                            <td>{{$a['folio']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Titulo Obtenido</th>
                            <th align="center">Enfasis</th>
                            <th align="center">Codigo SNP</th>
                            <th align="center">Pais</th>
                            <th align="center">Fecha de Terminación</th>
                            <th align="center">Pension de 10</th>
                        </tr>
                    </thead>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Pensión de 11</th>
                            <th align="center">Forma Obtuvo Titulo</th>
                            <th align="center">SNP</th>
                            <th align="center">Tipo Prueba</th>
                            <th align="center">Puntaje Obtenido</th>
                            <th align="center">Ciudad Presento Prueba</th>
                        </tr>
                    </thead>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Fecha de Presentación Prueba</th>
                            <th align="center">Colegio</th>
                            <th align="center">Libro</th>
                            <th align="center">Folio</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Estudios Universitarios</div>
            <div>
                @if($universitarios !== null)
                @foreach($universitarios as $a)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Programa</th>
                            <th align="center">Codigo SNP</th>
                            <th align="center">Periodos Cursados</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['programa']}}</td>
                            <td>{{$a['codigosnp']}}</td>
                            <td>{{$a['periodoscursados']}}</td>
                            <td>{{$a['fechaterminacion']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Terminación</th>
                            <th align="center">Puntaje ECAES</th>
                            <th align="center">Registro ECAES</th>
                            <th align="center">Ciudad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['tarjetaprofesional']}}</td>
                            <td>{{$a['puntajeecaes']}}</td>
                            <td>{{$a['registroecaes']}}</td>
                            <td>{{$a['ciudad']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Programa</th>
                            <th align="center">Codigo SNP</th>
                            <th align="center">Periodos Cursados</th>
                        </tr>
                    </thead>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Terminación</th>
                            <th align="center">Puntaje ECAES</th>
                            <th align="center">Registro ECAES</th>
                            <th align="center">Ciudad</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Postgrados</div>
            <div>
                @if($postgrados !== null)
                @foreach($postgrados as $a)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Programa</th>
                            <th align="center">Codigo SNP</th>
                            <th align="center">Terminación</th>
                            <th align="center">Ciudad</th>
                            <th align="center">Pais</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['programa']}}</td>
                            <td>{{$a['codigosnp']}}</td>
                            <td>{{$a['fechaterminacion']}}</td>
                            <td>{{$a['ciudad']}}</td>
                            <td>{{$a['pais']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Programa</th>
                            <th align="center">Codigo SNP</th>
                            <th align="center">Terminación</th>
                            <th align="center">Ciudad</th>
                            <th align="center">Pais</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Experiencia Docente</div>
            <div>
                @if($expdocente !== null)
                @foreach($expdocente as $a)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Institución</th>
                            <th align="center">Nivel</th>
                            <th align="center">Area</th>
                            <th align="center">Tiempo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['institucion']}}</td>
                            <td>{{$a['area']}}</td>
                            <td>{{$a['nivel']}}</td>
                            <td>{{$a['tiemposervicio']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Institución</th>
                            <th align="center">Nivel</th>
                            <th align="center">Area</th>
                            <th align="center">Tiempo</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Experiencia en Investigaciones</div>
            <div>
                @if($expinvestigacion !== null)
                @foreach($expinvestigacion as $a)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Institución</th>
                            <th align="center">Proyecto</th>
                            <th align="center">Cargo</th>
                            <th align="center">Año</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['institucion']}}</td>
                            <td>{{$a['proyecto']}}</td>
                            <td>{{$a['cargo']}}</td>
                            <td>{{$a['anio']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Institución</th>
                            <th align="center">Proyecto</th>
                            <th align="center">Cargo</th>
                            <th align="center">Año</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Publicaciones</div>
            <div>
                @if($publicaciones !== null)
                @foreach($publicaciones as $a)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Nombre</th>
                            <th align="center">Tipo de Obra</th>
                            <th align="center">Año</th>
                            <th align="center">Entidad Uspiciadora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['nombre']}}</td>
                            <td>{{$a['tipoobra']}}</td>
                            <td>{{$a['anio']}}</td>
                            <td>{{$a['entidaduspiciadora']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Nombre</th>
                            <th align="center">Tipo de Obra</th>
                            <th align="center">Año</th>
                            <th align="center">Entidad Uspiciadora</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Posesión de Residencias</div>
            <div>
                @if($posesionresidencia !== null)
                @foreach($posesionresidencia as $a)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Tipo de Posesión</th>
                            <th align="center">Valor Mensual</th>
                            <th align="center">Numero de Credito</th>
                            <th align="center">Dir. Inmueble Hipotecado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['tipoposesion']}}</td>
                            <td>{{$a['valormensual']}}</td>
                            <td>{{$a['numcredito']}}</td>
                            <td>{{$a['dirhipotecado']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Valor de Arriendo</th>
                            <th align="center">Dir. Arrendatario</th>
                            <th align="center">Tel. Arrendatario</th>
                            <th align="center">Deuda de la Vivienda</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['vrmensualarriendo']}}</td>
                            <td>{{$a['direccarrendador']}}</td>
                            <td>{{$a['telarrendador']}}</td>
                            <td>{{$a['deudavivienda']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Tipo de Posesión</th>
                            <th align="center">Valor Mensual</th>
                            <th align="center">Numero de Credito</th>
                            <th align="center">Dir. Inmueble Hipotecado</th>
                        </tr>
                    </thead>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Valor de Arriendo</th>
                            <th align="center">Dir. Arrendatario</th>
                            <th align="center">Tel. Arrendatario</th>
                            <th align="center">Deuda de la Vivienda</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Referencias Académicas</div>
            <div>
                @if($referencias !== null)
                @foreach($referencias as $a)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Nombre</th>
                            <th align="center">Dirección</th>
                            <th align="center">Telefono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['nombre']}}</td>
                            <td>{{$a['direccion']}}</td>
                            <td>{{$a['telefono']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Nombre</th>
                            <th align="center">Dirección</th>
                            <th align="center">Telefono</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Cursos Realizados</div>
            <div>
                @if($cursos !== null)
                @foreach($cursos as $a)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Titulo</th>
                            <th align="center">Institución</th>
                            <th align="center">Terminación</th>
                            <th align="center">Duración</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['titulo']}}</td>
                            <td>{{$a['institucion']}}</td>
                            <td>{{$a['fechaterminacion']}}</td>
                            <td>{{$a['duracion']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Titulo</th>
                            <th align="center">Institución</th>
                            <th align="center">Terminación</th>
                            <th align="center">Duración</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Información Financiera</div>
            <div>
                @if($financiera !== null)
                @foreach($financiera as $a)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Situación De los Padres</th>
                            <th align="center">Num. Familiares</th>
                            <th align="center">Num. Miembros que Trabajan</th>
                            <th align="center">Ingreso Mensual</th>
                            <th align="center">Egreso Mensual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['situacionpadres']}}</td>
                            <td>{{$a['numerofamiliares']}}</td>
                            <td>{{$a['numeromiembrostrabaja']}}</td>
                            <td>{{$a['ingresomensualfamilia']}}</td>
                            <td>{{$a['egresomensualfamilia']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">¿Quien Costea los Estudios?</th>
                            <th align="center">¿Con quien Reside?</th>
                            <th align="center">Situación Economica</th>
                            <th align="center">Sufrago Elecciones</th>
                            <th align="center">Renta Gravable</th>
                            <th align="center">Nivel del Sisben</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['quiencosteaestudios']}}</td>
                            <td>{{$a['conquienreside']}}</td>
                            <td>{{$a['situacioneconomica']}}</td>
                            <td>{{$a['sufragoelecciones']}}</td>
                            <td>{{$a['rentagravable']}}</td>
                            <td>{{$a['nivelsisben']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Siben</th>
                            <th align="center">Patrimonio Gravable</th>
                            <th align="center">Ingresos No Gravables</th>
                            <th align="center">Ingresos Retenciones</th>
                            <th align="center">Patrimonio Bruto</th>
                            <th align="center">Renta No Gravable</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['sisben']}}</td>
                            <td>{{$a['patrimoniogravable']}}</td>
                            <td>{{$a['ingresosnogravables']}}</td>
                            <td>{{$a['ingresoretenciones']}}</td>
                            <td>{{$a['ingresobruto']}}</td>
                            <td>{{$a['rentanogravable']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Ingresos Gravables</th>
                            <th align="center">Tipo Liquidación</th>
                            <th align="center">Num. Hermanos Est. Universidad</th>
                            <th align="center">Vive con Familia</th>
                            <th align="center">Estrato</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['ingresosgravables']}}</td>
                            <td>{{$a['tipoliquidacion']}}</td>
                            <td>{{$a['numhermanosestudiaunivers']}}</td>
                            <td>{{$a['viveconfamilia']}}</td>
                            <td>{{$a['estrato']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Num. Hermanos</th>
                            <th align="center">Posición entre Herm.</th>
                            <th align="center">Hermanos Estudiando</th>
                            <th align="center">Caja de Compensación</th>
                            <th align="center">Cat. Caja de Compensación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['numerohermanos']}}</td>
                            <td>{{$a['posicionhermanos']}}</td>
                            <td>{{$a['hermanosestudiandou']}}</td>
                            <td>{{$a['cajacompensacion']}}</td>
                            <td>{{$a['cajacompcategoria']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Situación De los Padres</th>
                            <th align="center">Num. Familiares</th>
                            <th align="center">Num. Miembros que Trabajan</th>
                            <th align="center">Ingreso Mensual</th>
                            <th align="center">Egreso Mensual</th>
                        </tr>
                    </thead>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">¿Quien Costea los Estudios?</th>
                            <th align="center">¿Con quien Reside?</th>
                            <th align="center">Situación Economica</th>
                            <th align="center">Sufrago Elecciones</th>
                            <th align="center">Renta Gravable</th>
                            <th align="center">Nivel del Sisben</th>
                        </tr>
                    </thead>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Siben</th>
                            <th align="center">Patrimonio Gravable</th>
                            <th align="center">Ingresos Gravables</th>
                            <th align="center">Ingresos Retenciones</th>
                            <th align="center">Patrimonio Bruto</th>
                            <th align="center">Renta No Gravable</th>
                        </tr>
                    </thead>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Siben</th>
                            <th align="center">Patrimonio Gravable</th>
                            <th align="center">Ingresos No Gravables</th>
                            <th align="center">Ingresos Retenciones</th>
                            <th align="center">Patrimonio Bruto</th>
                            <th align="center">Renta No Gravable</th>
                        </tr>
                    </thead>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Ingresos Gravables</th>
                            <th align="center">Tipo Liquidación</th>
                            <th align="center">Num. Hermanos Est. Universidad</th>
                            <th align="center">Vive con Familia</th>
                            <th align="center">Estrato</th>
                        </tr>
                    </thead>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Num. Hermanos</th>
                            <th align="center">Posición entre Herm.</th>
                            <th align="center">Hermanos Estudiando</th>
                            <th align="center">Caja de Compensación</th>
                            <th align="center">Cat. Caja de Compensación</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Asociaciones Cientificas</div>
            <div>
                @if($asociaciones !== null)
                @foreach($asociaciones as $a)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Nombre</th>
                            <th align="center">Objeto Social</th>
                            <th align="center">Fecha de Ingreso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['nombre']}}</td>
                            <td>{{$a['objetosocial']}}</td>
                            <td>{{$a['fechaingreso']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Nombre</th>
                            <th align="center">Objeto Social</th>
                            <th align="center">Fecha de Ingreso</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Sanciones</div>
            <div>
                @if($sanciones !== null)
                @foreach($sanciones as $a)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Fecha</th>
                            <th align="center">Tipo de Vigencia</th>
                            <th align="center">Num. Periodos</th>
                            <th align="center">Fecha Inicio</th>
                            <th align="center">Fecha Fin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['fecha']}}</td>
                            <td>{{$a['tipodevigencia']}}</td>
                            <td>{{$a['numeroperiodos']}}</td>
                            <td>{{$a['fechainicio']}}</td>
                            <td>{{$a['fechafin']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Estado</th>
                            <th align="center">Falta</th>
                            <th align="center">Norma</th>
                            <th align="center">Tipo Sanción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['estado']}}</td>
                            <td>{{$a['faltareglamento']}}</td>
                            <td>{{$a['norma']}}</td>
                            <td>{{$a['tiposancion']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Fecha</th>
                            <th align="center">Tipo de Vigencia</th>
                            <th align="center">Num. Periodos</th>
                            <th align="center">Fecha Inicio</th>
                            <th align="center">Fecha Fin</th>
                        </tr>
                    </thead>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Estado</th>
                            <th align="center">Falta</th>
                            <th align="center">Norma</th>
                            <th align="center">Tipo Sanción</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
        </div>
    </body>
</html>
