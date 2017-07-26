<?PHP /* CABECERA DEL ARCHIVO EXCELL*/
    header("Content-type:application/charset='UTF-8'");
    header("Content-Disposition: attachment; filename = DISPONIBILIDAD_DE_PUNTOS ".date('d-m-Y').".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        tbody td, thead th{ padding: 8px 10px;}
        #tblEstadoFactura{border-collapse: separate;border-spacing: 1px;color: white;}
        #tblEstadoFactura tbody td{color:#811A80;font-size: 11px;}
        #tblEstadoFactura tr:nth-child(even){background: #e7e2f7;}
        #tblEstadoFactura tr:nth-child(odd){ background: #ffffff; }
        #tblEstadoFactura th{ background: #811A80;color: #fff; font-size: 14px;}
        #logo{margin: 10px 15px 10px;}
        .row{width: 100%;}
        .center{text-align: center!important;}
        .red-text{color: red;}
        .Mcolor {
            color: #831F82;
            font-size: 19px;
            font-family: 'robotoblack';
        }
    </style>
</head>
<body>

<h5 style="text-align: center;color: #811A80; font-family: 'robotoblack'; font-size: 18px;">REPORTE DE ESTADOS DE FACTURAS (SPINN)</h5>

<table id='tblEstadoFactura' class='TblDatos' style='width: 100%;'>
    <thead>
        <tr>
            <th>Nº</th>
            <th>FECHA</th>
            <th>FACTURA</th>
            <th>COD.</th>
            <th>CLIENTE</th>
            <th>P.ACUMULADOS</th>
            <th>P.DISPONIBLES</th>
            <th>ESTADO</th>
        </tr>
    </thead>
    <tbody>
    <?PHP
            $totalAcumulado =0;
            $totalDisponible =0;
            if(!($data)){
                } else {
                    foreach($data as $factura){
                        $totalDisponible += $factura['P_DISPONIBLES'];
                        $totalAcumulado += $factura['P_ACUMULADOS'];
                        echo "
                        <tr>
                            <td>".$factura['NUMERO']."</td>
                            <td>".$factura['FECHA']."</td>
                            <td>".$factura['FACTURA']."</td>
                            <td>".$factura['COD_CLIENTE']."</td>
                            <td class='negra'>".$factura['CLIENTE']."</td>
                            <td>".$factura['P_ACUMULADOS']."</td>
                            <td>".$factura['P_DISPONIBLES']."</td>
                            <td>".$factura['ESTADO']."</td>
                        </tr>
                    ";
                }
            }
    ?>
    </tbody>
</table>
<div class="row Mcolor">
    <h6 class="">TOTAL ACUMULADO: <span class="red-text" id="ttAcumulado"><?php echo $totalAcumulado; ?></span></h6>
    <h6 class="">TOTAL DISPONIBLE: <span class="red-text" id="ttDisponible"><?php echo $totalDisponible; ?></span></h6>
</div>