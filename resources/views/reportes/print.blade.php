<html>
    <head>
        <link rel="shortcut icon" href="{{asset('img/logomi.png')}}">
        <style>
            body{
                font-size: 10px;
            }

            .container{
                width: 100%;
            }

            .row{
                width: 100%;
                border-left: 1px solid;
                border-right: 1px solid;
                border-bottom: 1px solid;
                padding: 5px;
            }

        </style>
    </head>
    <body>
        <div class="container">
            Fecha de Generación: {{$fecha}}  - Infotep - La Guajira
            <div class="row" style="border-top: 1px solid">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 15%;">
                            <img src="{{asset('img/left-bg3.png')}}" />
                        </td>
                        <td style="width: 85%; text-align: center;">
                            <b style="font-size:18px;">{{$titulo}}</b>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th style='width: 40% !important; background-color: #ed4c1b; color:#FFFFFF;'>DOCUMENTO</th>
                            <th style='width: 60% !important; background-color: #ed4c1b; color:#FFFFFF;'>ESTUDIANTE</th>
                        </tr>
                        <tr>
                            <th style='width: 40%; text-align: center; background-color:#2196F3; color:#FFFFFF;'>{{$numero}}</th>
                            <th style='width: 60%; text-align: center; background-color:#2196F3; color:#FFFFFF;'>{{$est}}</th>
                        </tr>
                        <tr>
                            <th style='width: 50% !important; background-color: #ed4c1b; color:#FFFFFF;'>CATEGORÁA</th>
                            <th style='width: 50% !important; background-color: #ed4c1b; color:#FFFFFF;'>SITUACIÓN</th>
                        </tr>
                        <tr>
                            <th style='width: 50%; text-align: center; background-color:#2196F3; color:#FFFFFF;'>{{$ep->categoria->descripcion}}</th>
                            <th style='width: 50%; text-align: center; background-color:#2196F3; color:#FFFFFF;'>{{$ep->situacionestudiante->descripcion}}</th>
                        </tr>
                    </thead>
                </table>
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th style='width: 40% !important; background-color: #ed4c1b; color:#FFFFFF;'>PROGRAMA</th>
                            <th style='width: 40% !important; background-color: #ed4c1b; color:#FFFFFF;'>PENSUM</th>
                            <th style='width: 20% !important; background-color: #ed4c1b; color:#FFFFFF;'>UBICACIÓN SEMESTRAL</th>
                        </tr>
                        <tr>
                            <th style='width: 40%; text-align: center; background-color:#2196F3; color:#FFFFFF;'>{{$ep->programaunidad->programa->nombre}}</th>
                            <th style='width: 40%; text-align: center; background-color:#2196F3; color:#FFFFFF;'>{{$ep->pensum->descripcion}}</th>
                            <th style='width: 20%; text-align: center; background-color:#2196F3; color:#FFFFFF;'>{{$ep->periodoacademico}}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="row">
                @foreach($record as $key=>$r)
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th style='width: 20%; text-align: center; background-color:#2196F3; color:#FFFFFF;'>Período</th>
                            <th style='width: 20%; text-align: center; background-color:#2196F3; color:#FFFFFF;'>Pond. Matriculada</th>
                            <th style='width: 20%; text-align: center; background-color:#2196F3; color:#FFFFFF;'>Pond. Aprobada</th>
                            <th style='width: 20%; text-align: center; background-color:#2196F3; color:#FFFFFF;'>Promedio Período</th>
                            <th style='width: 20%; text-align: center; background-color:#2196F3; color:#FFFFFF;'>Promedio Acumulado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style='width: 20%; text-align: center; background-color:#2196F3; color:#FFFFFF;'>{{$key}}</td>
                            <td style='width: 20%; text-align: center; background-color:#2196F3; color:#FFFFFF;'>{{$r['crd']}}</td>
                            <td style='width: 20%; text-align: center; background-color:#2196F3; color:#FFFFFF;'>{{$r['crdap']}}</td>
                            <td style='width: 20%; text-align: center; background-color:#2196F3; color:#FFFFFF;'>{{number_format($r['mat']->promedio,1)}}</td>
                            <td style='width: 20%; text-align: center; background-color:#2196F3; color:#FFFFFF;'>{{number_format($r['mat']->promediogeneral,1)}}</td>
                        </tr>
                    </tbody>
                </table>
                <table style="width: 100%;">
                    @if($r['grupos']!==null)
                    @foreach($r['grupos'] as $g)
                    <thead>
                        <tr style="background-color: #f0f3f4">
                            <th style='width: 10%;'>Código</th>
                            <th style='width: 35%;'>Materia</th>
                            <th style='width: 10%;'>Ponderación</th>
                            @if($r['grupos']!==null)
                            @foreach($g['nota'] as $n)
                            <th style='width: 15%;'>{{$n['descripcion']}}</th>
                            @endforeach
                            @else
                            <th style='width: 15%;'>Notas</th>
                            @endif
                            <th style='width: 10%;'>Final</th>
                            <th style='width: 10%;'>Habilitación</th>
                            <th style='width: 10%;'>Definitiva</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($r['grupos']!==null)
                        <?php $i = 1; ?>
                        @if($i%2==0)
                        <tr style="background-color: #f0f3f4">
                            @else
                        <tr>
                            @endif
                            <td style='width: 10%;'>{{$g['codigo']}}</td>
                            <td style='width: 35%;'>{{$g['materia']}}</td>
                            <td style='width: 10%;'>{{$g['pond']}}</td>
                            @foreach($g['nota'] as $n)
                            <td style='width: 15%;'>{{$n['nota']}}</td>
                            @endforeach
                            <td style='width: 10%;'>{{$g['final']}}</td>
                            <td style='width: 10%;'>{{$g['hab']}}</td>
                            <td style='width: 10%;'>@if($g['def']<3) <p style="color:red">{{$g['def']}}</p>@else {{$g['def']}} @endif</td>
                        </tr>
                        <?php $i = $i + 1; ?>
                        @endif
                    </tbody>
                    @endforeach
                    @endif
                </table>
                @endforeach
            </div>
        </div>
    </body>
</html>
