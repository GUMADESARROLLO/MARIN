
<?PHP /* CABECERA DEL ARCHIVO EXCELL*/
    header("Content-type:application/charset='UTF-8'");
    header("Content-Disposition: attachment; filename = CLIENTES_SPINN ".date('d-m-Y').".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        tbody td, thead th{ padding: 8px 10px;}
        #ClienteAdd{border-collapse: separate;border-spacing: 1px;color: white;}
        #ClienteAdd tbody td{color:#811A80;font-size: 11px;}
        #ClienteAdd tr:nth-child(even){background: #e7e2f7;}
        #ClienteAdd tr:nth-child(odd){ background: #ffffff; }
        #ClienteAdd th{ background: #811A80;color: #fff; font-size: 14px;}
        #logo{margin: 10px 15px 10px;}
    </style>
</head>
<body>

<h5 style="text-align: center;color: #811A80; font-family: 'robotoblack'; font-size: 18px;">CLIENTES REGISTRADOS EN EL SISTEMA DE PUNTOS INNOVA (SPINN)</h5>

<table width="100px;"id="ClienteAdd" >
   <thead>
            <tr>
                <th>CÓDIGO</th>
                <th>CLIENTE</th>
                <th>RUC</th>
                <th>DIRECCIÓN</th>
                <th>VENDEDOR</th>
            </tr>
            </thead>
            <tbody>
               <?PHP
                if(!($Clientes)){
                    } else {
                        foreach($Clientes as $cliente){
                            echo "
                                 <tr>
                                    <td>".$cliente['CODIGO']."</td>
                                    <td class='negra'>".$cliente['NOMBRE']."</td>
                                    <td>".$cliente['RUC']."</td>
                                    <td>".$cliente['DIRECCION']."</td>
                                    <td>".$cliente['VENDEDOR']."</td>
                                 </tr>
                            ";
                        }
                    }
                ?>
            </tbody>
</table>
