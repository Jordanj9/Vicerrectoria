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
            <div class="bar bar-a" style="font-size: 20px !important;">Inscripcion en Linea</div>
            <div class="bar bar-n">Datos Personales</div>
            <div>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center" align="center">Identificación</th>
                            <th align="center" align="center">Tipo Documento</th>
                            <th align="center" align="center">Fecha Expedición</th>
                            <th align="center" align="center">Lugar Expedición</th>
                            <th align="center" align="center">Sexo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$numerodocumento}}</td>
                            <td>{{$tipodoc['descripcion']}}</td>
                            <td>{{$fecha_expedicion}}</td>
                            <td>{{$lugar_expedicion}}</td>
                            <td>{{$sexo}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Primer Nombre</th>
                            <th align="center">Segundo Nombre</th>
                            <th align="center">Primer Apellido</th>
                            <th align="center">Segundo Apellido</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$primer_nombre}}</td>
                            <td>{{$segundo_nombre}}</td>
                            <td>{{$primer_apellido}}</td>
                            <td>{{$segundo_apellido}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bar bar-n">Datos Generales</div>
            <div>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Libreta Militar</th>
                            <th align="center">Distrito</th>
                            <th align="center">Étnia</th>
                            <th align="center">Tipo Sanguíneo</th>
                            <th align="center">Estado Civil</th>
                            <th align="center">Estrato</th>
                            <th align="center">Circunscripción</th>
                            <th align="center">Sisben</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$libreta_militar}}</td>
                            <td>{{$distrito_militar}}</td>
                            <td>{{$etnia}}</td>
                            <td>{{$tiposanguineo}}</td>
                            <td>{{$estadocivil['descripcion']}}</td>
                            <td>{{$estrato['estrato']}}</td>
                            <td>{{$circunscripcion['descripcion']}}</td>
                            <td>{{$estrato['sisben']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Fecha de Nacimiento</th>
                            <th align="center">Ciudad</th>
                            <th align="center">Departamento</th>
                            <th align="center">Pais</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$fecha_nacimiento}}</td>
                            <td>{{$cn['nombre']}}</td>
                            <td>{{$dn['nombre']}}</td>
                            <td>{{$pn['nombre']}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bar bar-n">Datos de Ubicación</div>
            <div>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Dirección</th>
                            <th align="center">Barrio</th>
                            <th align="center">Ciudad</th>
                            <th align="center">Departamento</th>
                            <th align="center">Pais</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$direccion_residencia}}</td>
                            <td>{{$barrio_residencia}}</td>
                            <td>{{$cr['nombre']}}</td>
                            <td>{{$dr['nombre']}}</td>
                            <td>{{$pr['nombre']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Teléfono Residencia</th>
                            <th align="center">Teléfono Celular</th>
                            <th align="center">Correo Electrónico</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$telefono_residencia}}</td>
                            <td>{{$telefonocelular}}</td>
                            <td>{{$email}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bar bar-n">Estudios Secundarios</div>
            <div>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Código Institución</th>
                            <th align="center">Nombre Institución</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$ess['codigo_snp']}}</td>
                            <td>{{$inst['nombre']}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Fecha de Terminación</th>
                            <th align="center">SNP Icfes</th>
                            <th align="center">Tipo de Prueba</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$ess['fechaterminacion']}}</td>
                            <td>{{$ess['snp']}}</td>
                            <td>{{$ess['tipoprueba']}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bar bar-n">Idiomas</div>
            <div>
                <table class="table tb">
                    <tbody>
                        @foreach($idiomas as $i)
                        <tr>
                            <td>{{$i['idioma']['descripcion']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="bar bar-n">Pasatiempos</div>
            <div>
                <table class="table tb">
                    <tbody>
                        @foreach($pasa as $i)
                        <tr>
                            <td>{{$i['pasatiempo']['descripcion']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="bar bar-n">Formulario(s) Diligenciado(s)</div>
            <div>
                @foreach($form as $i)
                <div class="bar bar-a">
                    <table class="table tb">
                        <thead>
                            <tr>
                                <th align="center">Formulario</th>
                                <th align="center">Programa</th>
                                <th align="center">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$i['id']}}</td>
                                <td>{{$i['prog']}}</td>
                                <td>{{$i['estado']}}</td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th align="center">Periodo</th>
                                <th align="center">Unidad</th>
                                <th align="center">Ciudad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$periodo['anio']." - ".$periodo['periodo']}}</td>
                                <td>{{$i['und']}}</td>
                                <td>{{$i['cd']}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endforeach
            </div>
        </div>
    </body>
</html>
