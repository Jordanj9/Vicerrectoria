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
            <?php
            if ($encabezado !== null) {
                if (count($encabezado) > 0) {
                    ?>
                    <div class="row">
                        <table style="width: 100%;">
                            <?php
                            $i = $total = $van = 0;
                            $html = $row1 = $row2 = "";
                            $total = count($encabezado);
                            foreach ($encabezado as $key => $value) {
                                $i = $i + 1;
                                $van = $van + 1;
                                $row1 = $row1 . "<th style='width: 33.3% !important; background-color: #ed4c1b; color:#FFFFFF; font-size:13px;'>" . $key . "</th>";
                                $row2 = $row2 . "<th style='width: 33.3%; text-align: center; background-color:#2196F3; color:#FFFFFF; font-size:13px;'>" . $value . "</th>";
                                if ($i === 3) {
                                    $i = 0;
                                    $html = $html . "<tr>" . $row1 . "</tr><tr>" . $row2 . "</tr>";
                                    $row1 = $row2 = "";
                                } else {
                                    if ($van === $total) {
                                        $html = $html . "<tr>" . $row1 . "</tr><tr>" . $row2 . "</tr>";
                                        $row1 = $row2 = "";
                                    }
                                }
                            }
                            echo $html;
                            ?>
                        </table>
                    </div>
                    <?php
                }
            }
            if ($filtros !== null) {
                if (count($filtros) > 0) {
                    ?>
                    <div class="row">
                        <table style="width: 100%;">
                            <?php
                            $i = $total = $van = 0;
                            $html = $row1 = $row2 = "";
                            $total = count($filtros);
                            foreach ($filtros as $key => $value) {
                                $i = $i + 1;
                                $van = $van + 1;
                                $row1 = $row1 . "<th style='width: 33.3% !important; background-color: #ed4c1b; color:#FFFFFF;'>" . $key . "</th>";
                                $row2 = $row2 . "<td style='width: 33.3%; text-align: center; background-color:#2196F3; color:#FFFFFF;'>" . $value . "</td>";
                                if ($i === 3) {
                                    $i = 0;
                                    $html = $html . "<tr>" . $row1 . "</tr><tr>" . $row2 . "</tr>";
                                    $row1 = $row2 = "";
                                } else {
                                    if ($van === $total) {
                                        $html = $html . "<tr>" . $row1 . "</tr><tr>" . $row2 . "</tr>";
                                        $row1 = $row2 = "";
                                    }
                                }
                            }
                            echo $html;
                            ?>
                        </table>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="row">
                <br><br>
                @if(count($data)>0)
                @foreach($data as $key=>$value)
                <table style='width: 100%;'>
                    <thead>
                        <tr>
                            <th style='width: 100% !important; background-color: #ed4c1b; color:#FFFFFF; font-size:13px;'>DOCENTE CON ID: {{$key}}</th>
                        </tr>
                    </thead>
                </table>
                @foreach($value as $r)
                @if($r['rol']!='DOCENTE DE PLANTA' && $r['rol']!='DOCENTE CATEDRATICO')
                <table style='width: 100%;'>
                    <thead>
                        <tr>
                            <th style='width: 100% !important; background-color: #ed4c1b; color:#FFFFFF; font-size:13px;'>{{$r['ev_nombre']}}</th>
                        </tr>
                    </thead>
                </table>
                <div class="col-md-12">
                    <div class="responsive-table">
                        <table style='width: 100%;'>
                            <thead>
                                <tr>
                                    @foreach($cabeceras as $c)
                                    <th style='width: 20% !important; background-color:#2196F3; color:#FFFFFF; font-size: 13px'>{{$c}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($r['items'])>0)
                                @foreach($r['items'] as $i)
                                <tr>
                                    <td  style='width: 70% !important; background-color: #ecf0f1;'>{{$i['item']}}</td>
                                    <td  style='width: 30% !important; background-color: #ecf0f1;'>{{round($i['resultado'],2)." / ".$i['cualitativo']}}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr class="danger">
                                    <td>No hay Resultados para la evaluación!</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <table style='width: 100%;'>
                    <thead>
                        <tr>
                            <th style='width: 100% !important; background-color: #ed4c1b; color:#FFFFFF; font-size:13px;'>{{$r['ev_nombre']}}</th>
                        </tr>
                    </thead>
                </table>
                <div class="col-md-12">
                    <div class="responsive-table">
                        <table style='width: 100%;'>
                            <thead>
                                <tr>
                                    @foreach($cabeceras as $c)
                                    <th style='width: 20% !important; background-color:#2196F3; color:#FFFFFF; font-size: 13px'>{{$c}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($r['items'])>0)
                                <tr>
                                    <td style='width: 70% !important; background-color: #ecf0f1;'>  -------------  </td>
                                    <td style='width: 30% !important; background-color: #ecf0f1;'>{{round($r['final'],2)." / ".$r['cualitativo']}}</td>
                                </tr>
                                @else
                                <tr class="danger">
                                    <td>No hay Resultados para la evaluación!</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                @endforeach
                @endforeach
                @else
                <div class="col-md-12">
                    <div class="alert alert-danger alert-border alert-dismissible fade in" role="alert">
                        <h3>Error
                            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </h3>
                        <p>No hay Resultados para el docente!</p>
                    </div>
                </div>
                @endif
                <table style='width: 100%;'>
                    <thead>
                        <tr>
                            <th style='width: 50% !important; background-color: #ed4c1b; color:#FFFFFF; font-size:13px; padding: 15px;'>PROMEDIO PONDERADO (100%)</th>
                            <th style='width: 20% !important; background-color: #ed4c1b; color:#FFFFFF; font-size:13px; padding: 15px;'>{{round($finalt,2)}}</th>
                            <th style='width: 30% !important; background-color: #ed4c1b; color:#FFFFFF; font-size:13px; padding: 15px;'>{{$finalc}}</th>
                        </tr>
                    </thead>
                </table>
                <table style='width: 100%;'>
                    <thead>
                        <tr>
                            <th style='width: 100% !important; background-color: #ed4c1b; color:#FFFFFF; font-size:13px;'>ESCALA DE VALORACIÓN</th>
                        </tr>
                    </thead>
                </table>
                <table style='width: 100%;'>
                    <tbody>
                        <tr>
                            <th style='width: 15% !important; background-color:#2196F3; color:#FFFFFF; font-size: 13px'>NOTACIÓN</th>
                            <th style='width: 40% !important; background-color:#2196F3; color:#FFFFFF; font-size: 13px'>DESCRIPCIÓN</th>
                            <th style='width: 20% !important; background-color:#2196F3; color:#FFFFFF; font-size: 13px'>VALOR CUALITATIVO</th>
                            <th style='width: 25% !important; background-color:#2196F3; color:#FFFFFF; font-size: 13px'>RANGO CUANTITATIVO</th>
                        </tr>
                        @foreach($eval as $ev)
                        <tr>
                            <td style='width: 15% !important; background-color: #ecf0f1;'>{{$ev->acronimo}}</td>
                            <td style='width: 40% !important; background-color: #ecf0f1;'>{{$ev->descripcion}}</td>
                            <td style='width: 20% !important; background-color: #ecf0f1;'>{{$ev->valor_cualitativo}}</td>  
                            <td style='width: 25% !important; background-color: #ecf0f1;'>{{"DESDE ".$ev->valor_cuat1." HASTA ".$ev->valor_cuat2}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>