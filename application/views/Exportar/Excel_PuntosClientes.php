<?PHP /* CABECERA DEL ARCHIVO EXCELL*/
    header("Content-type:application/charset='UTF-8'");
    header("Content-Disposition: attachment; filename = PUNTOS_CLIENTES_SPINN ".date('d-m-Y').".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        tbody td, thead th{ padding: 8px 10px;}
        #PtosCliente{border-collapse: separate;border-spacing: 1px;color: white;}
        #PtosCliente tbody td{color:#811A80;font-size: 11px;}
        #PtosCliente tr:nth-child(even){background: #e7e2f7;}
        #PtosCliente tr:nth-child(odd){ background: #ffffff; }
        #PtosCliente th{ background: #811A80;color: #fff; font-size: 14px;}
        #logo{margin: 10px 15px 10px;}
    </style>
</head>
<body>

<h5 style="text-align: center;color: #811A80; font-family: 'robotoblack'; font-size: 18px;">DETALLE DE PUNTOS DE CLIENTES (SPINN)</h5>

<table id='PtosCliente' class='TblDatos' style='width: 100%;'>
    <thead>
            <tr>
                <th>CÓDIGO</th>
                <th>CLIENTE</th>
                <th>VENDEDOR</th>
                <th>ACUMULADO</th>
                <th>DISPONIBLE</th>
                <th>TOTAL FACTURADO</th>
            </tr>
        </thead>
        <tbody>
           <?php
           if(!($Clientes)){
           } else {
            foreach($Clientes as $cliente){
                echo "
                <tr>
                    <td>".$cliente['CODIGO']."</td>
                    <td class='negra'>".$cliente['CLIENTE']."</td>
                    <td>".$cliente['VENDEDOR']."</td>
                    <td>".$cliente['ACUMULADO']."</td>
                    <td>".$cliente['DISPONIBLE']."</td>
                    <td>".$cliente['TOTAL']."</td>
                </tr>
                ";
            }
        }
        ?>
    </tbody>
</table>
