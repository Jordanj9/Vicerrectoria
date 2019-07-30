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
            <div class="bar bar-a" style="font-size: 20px !important;">Hoja de Vida de Programa</div>
            <div class="bar bar-n">Datos del Programa</div>
            <div>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center" align="center">Nombre</th>
                            <th align="center" align="center">Codigo Icfes</th>
                            <th align="center" align="center">Numero de Periodos</th>
                            <th align="center" align="center">Tipo</th>
                            <th align="center" align="center">Convenio</th>
                            <th align="center" align="center">Titulo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$nombre}}</td>
                            <td>{{$codicfes}}</td>
                            <td>{{$numper}}</td>
                            <td>{{$tipo}}</td>
                            <td>{{$convenio}}</td>
                            <td>{{$titulo}}</td>
                        </tr>
                    </tbody>
                </table>  
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center" align="center">Fecha Aprobación Icfes</th>
                            <th align="center" align="center">Estado</th>
                            <th align="center" align="center">Codigo Unidad</th></th>
                            <th align="center" align="center">Modalidad</th>
                            <th align="center" align="center">Metodologia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$fechaicf}}</td>
                            <td>{{$estado}}</td>
                            <td>{{$coduni}}</td>
                            <td>{{$mod}}</td>
                            <td>{{$met}}</td>

                        </tr>
                    </tbody>
                </table>
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center" align="center">Complejidad </th>
                            <th align="center" align="center">Abreviatura </th>
                            <th align="center" align="center">Jornada </th>
                            <th align="center" align="center">Norma</th>
                            <th align="center" align="center">Tipo Periodo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$complejidad}}</td>
                            <td>{{$abre}}</td>
                            <td>{{$jornada}}</td>
                            <td>{{$norma}}</td>
                            <td>{{$tipoper}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bar bar-n">Unidades Relacionadas</div>
            <div>
                @if($unidades !== null)
                @foreach($unidades as $u)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Unidad</th>
                            <th align="center">Relación</th>
                            <th align="center">Cupo Min</th>
                            <th align="center">Cupo Max</th>
                            <th align="center">Opcionados</th>
                            <th align="center">Es Facultad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$u['unidad']}}</td>
                            <td>{{$u['relacion']}}</td>
                            <td>{{$u['cupmin']}}</td>
                            <td>{{$u['cupmax']}}</td>
                            <td>{{$u['opc']}}</td>
                            <td>{{$u['fac']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Unidad</th>
                            <th align="center">Relación</th>
                            <th align="center">Cupo Min</th>
                            <th align="center">Cupo Max</th>
                            <th align="center">Opcionados</th>
                            <th align="center">Es Facultad</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Datos de Titulos</div>
            <div>
                @if($titulos !== null)
                @foreach($titulos as $t)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Titulo</th>
                            <th align="center">Fecha de Inicio</th>
                            <th align="center">Fecha Fin</th>
                            <th align="center">Norma</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$t['titulop']}}</td>
                            <td>{{$t['fechai']}}</td>
                            <td>{{$t['fechaf']}}</td>
                            <td>{{$t['norma']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Titulo</th>
                            <th align="center">Fecha de Inicio</th>
                            <th align="center">Fecha Fin</th>
                            <th align="center">Norma</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Cambios de Estados</div>
            <div>
                @if($estados !== null)
                @foreach($estados as $e)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Estado</th>
                            <th align="center">Estado Anterior</th>
                            <th align="center">Norma</th>
                            <th align="center">Justificación Snie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$e['estado']}}</td>
                            <td>{{$e['estadoanterior']}}</td>
                            <td>{{$e['norma']}}</td>
                            <td>{{$e['just']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Estado</th>
                            <th align="center">Estado Anterior</th>
                            <th align="center">Norma</th>
                            <th align="center">Justificación Snie</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Cambios de Periodo</div>
            <div>
                @if($periodos !== null)
                @foreach($periodos as $p)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Tipo Periodo Anterior</th>
                            <th align="center">Nuevo Nro. Periodos</th>
                            <th align="center">Anterior Nro. Periodos</th>
                            <th align="center">Tipo Periodo Actual</th>
                            <th align="center">Norma</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$p['anterior']}}</td>
                            <td>{{$p['nroanterior']}}</td>
                            <td>{{$p['nronuevos']}}</td>
                            <td>{{$p['tipoper']}}</td>
                            <td>{{$p['norma']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Tipo Periodo Anterior</th>
                            <th align="center">Nuevo Nro. Periodos</th>
                            <th align="center">Anterior Nro. Periodos</th>
                            <th align="center">Tipo Periodo Actual</th>
                            <th align="center">Norma</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Renovaciones</div>
            <div>
                @if($renovaciones !== null)
                @foreach($renovaciones as $r)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Numero</th>
                            <th align="center">Descripción</th>
                            <th align="center">Norma</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$r['numero']}}</td>
                            <td>{{$r['des']}}</td>
                            <td>{{$r['norma']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Numero</th>
                            <th align="center">Descripción</th>
                            <th align="center">Norma</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Acreditaciones</div>
            <div>
                @if($acreditaciones !== null)
                @foreach($acreditaciones as $a)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Años</th>
                            <th align="center">Observaciones</th>
                            <th align="center">Fecha</th>
                            <th align="center">Tipo de Acreditación</th>
                            <th align="center">Norma</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['anio']}}</td>
                            <td>{{$a['obser']}}</td>
                            <td>{{$a['fecha']}}</td>
                            <td>{{$a['tipo']}}</td>
                            <td>{{$a['norma']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Años</th>
                            <th align="center">Observaciones</th>
                            <th align="center">Fecha</th>
                            <th align="center">Tipo de Acreditación</th>
                            <th align="center">Norma</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Aspectos</div>
            <div>
                @if($aspectos !== null)
                @foreach($aspectos as $a)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Item de Fundamentación</th>
                            <th align="center">Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['item']}}</td>
                            <td>{{$a['text']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Item de Fundamentación</th>
                            <th align="center">Descripción</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Ciclos</div>
            <div>
                @if($ciclos !== null)
                @foreach($ciclos as $a)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Ciclo</th>
                            <th align="center">Ubicación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['ciclo']}}</td>
                            <td>{{$a['ubicacion']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Ciclo</th>
                            <th align="center">Ubicación</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
            <div class="bar bar-n">Revisiones</div>
            <div>
                @if($revisiones !== null)
                @foreach($revisiones as $a)
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$a['des']}}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @else
                <table class="table tb">
                    <thead>
                        <tr style="background-color: #ecf0f1 !important;">
                            <th align="center">Descripción</th>
                        </tr>
                    </thead>
                </table>
                @endif
            </div>
        </div>
    </body>
</html>
