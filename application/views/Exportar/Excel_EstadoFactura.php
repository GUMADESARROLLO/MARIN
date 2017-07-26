<?PHP /* CABECERA DEL ARCHIVO EXCELL*/
    header("Content-type:application/charset='UTF-8'");
    header("Content-Disposition: attachment; filename = ESTADO_FACTURAS ".date('d-m-Y').".xls");
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
            <th>ESTADO</th>
        </tr>
    </thead>
    <tbody>
            <?PHP
            if(!($data)){
                } else {
                    foreach($data as $factura){
                        echo "
                        <tr>
                            <td>".$factura['NUMERO']."</td>
                            <td class='negra'>".$factura['FECHA']."</td>
                            <td>".$factura['FACTURA']."</td>
                            <td>".$factura['COD_CLIENTE']."</td>
                            <td>".$factura['CLIENTE']."</td>
                            <td>".$factura['ESTADO']."</td>
                        </tr>
                    ";
                }
            }
    ?>
    </tbody>
</table>
