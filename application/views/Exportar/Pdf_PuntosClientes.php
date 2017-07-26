<!doctype html>
<?php  ini_set("memory_limit","256M");  ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
        <style>
        tbody td, thead th{ padding: 8px 10px;}
        #PtosCliente{border-collapse: separate;border-spacing: 1px;color: white; font-family: 'robotoblack';}
        #PtosCliente tbody td{color:#831f82;font-size: 11px;}
        #PtosCliente tr:nth-child(even){background: #ffffff;}
        #PtosCliente tr:nth-child(odd){ background: #e7e2f7; }
        #PtosCliente th{ background: #831f82;color: #fff; font-size: 14px;}
        #logo{margin: 10px 15px 10px;}
        .negra{
            font-family: 'robotoblack'!important;
        }
        #DetallePtosCliente{border-collapse: separate;border-spacing: 1px;color: white; font-family: 'robotoblack';}
        #DetallePtosCliente tbody td{color:#831f82;font-size: 11px;}
        #DetallePtosCliente tr:nth-child(even){background: #ffffff;}
        #DetallePtosCliente tr:nth-child(odd){ background: #e7e2f7; }
        #PtosCliente th{ background: #831f82;color: #fff; font-size: 14px;}
        @font-face {
            font-family: 'robotoblack';
            src: url('roboto-black-webfont.eot');
            src: url('roboto-black-webfont.eot?#iefix') format('embedded-opentype'),
            url('roboto-black-webfont.woff2') format('woff2'),
            url('roboto-black-webfont.woff') format('woff'),
            url('roboto-black-webfont.ttf') format('truetype'),
            url('roboto-black-webfont.svg#robotoblack') format('svg');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'robotobold';
            src: url('roboto-bold-webfont.eot');
            src: url('roboto-bold-webfont.eot?#iefix') format('embedded-opentype'),
            url('roboto-bold-webfont.woff2') format('woff2'),
            url('roboto-bold-webfont.woff') format('woff'),
            url('roboto-bold-webfont.ttf') format('truetype'),
            url('roboto-bold-webfont.svg#robotobold') format('svg');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'robotomedium';
            src: url('roboto-medium-webfont.eot');
            src: url('roboto-medium-webfont.eot?#iefix') format('embedded-opentype'),
            url('roboto-medium-webfont.woff2') format('woff2'),
            url('roboto-medium-webfont.woff') format('woff'),
            url('roboto-medium-webfont.ttf') format('truetype'),
            url('roboto-medium-webfont.svg#robotomedium') format('svg');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'robotoregular';
            src: url('roboto-regular-webfont.eot');
            src: url('roboto-regular-webfont.eot?#iefix') format('embedded-opentype'),
            url('roboto-regular-webfont.woff2') format('woff2'),
            url('roboto-regular-webfont.woff') format('woff'),
            url('roboto-regular-webfont.ttf') format('truetype'),
            url('roboto-regular-webfont.svg#robotoregular') format('svg');
            font-weight: normal;
            font-style: normal;
        }
    </style>
</head>
<body>
<div class="row" style="margin-bottom:0">
    <div class="col l2" style="margin-left:35%;" >
        <img id="logo" src="<?PHP echo base_url();?>assets/img/spinnova_logo.png" width="30%">
    </div>
</div>
<br>
<div style="text-align:center" class="">
<h3 style="font-family: 'robotoblack';font-size: 18px; color: #831f82; font-weight:bold;">DETALLE DE PUNTOS DE CLIENTES (SPINN)</h3>
</div>    
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
                    <?php
                    /*if(!($Clientes)){
                        }else {
                            foreach($Clientes as $cliente){
                                echo "<table id='PtosCliente' class='TblDatos' style='width: 100%;'>
                                        <thead>
                                        <tr>
                                            <th>CÓDIGO</th>
                                            <th>CLIENTE</th>
                                            <th>VENDEDOR</th>
                                            <th>ACUMULADO</th>
                                            <th>DISPONIBLE</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                     <tr>
                                        <td>".$cliente['CODIGO']."</td>
                                        <td class='negra'>".$cliente['CLIENTE']."</td>
                                        <td>".$cliente['VENDEDOR']."</td>
                                        <td>".$cliente['ACUMULADO']."</td>
                                        <td>".$cliente['DISPONIBLE']."</td>
                                     </tr>
                                </tbody>
                                </table>";
                        if(!($Detalles)){
                        } else {
                            foreach($Detalles as $detalles){                                    
                             if ($detalles['COD_CLIENTE']==$cliente['CODIGO']) {
                                    echo'<table id="DetallePtosCliente" style="width: 100%;" class=" TblDatos">
                                            <thead>
                                            <tr style="background-color:green;">
                                                <th>FECHA</th>
                                                <th>FACTURA</th>
                                                <th>VENDEDOR</th>
                                                <th>ACUMULADO</th>
                                                <th>DISPONIBLE</th>
                                            </tr>
                                            </thead>
                                        <tbody>
                                        <tr>
                                            <td>'.$detalles['FECHA'].'</td>
                                            <td>'.$detalles['FACTURA'].'</td>
                                            <td>'.$detalles['VENDEDOR'].'</td>
                                            <td>'.$detalles['ACUMULADO'].'</td>
                                            <td>'.$detalles['DISPONIBLE'].'</td>
                                        </tr>
                                        </tbody>
                                        </table>';   
                                    }
                                     
                                }                                   
                            }
                        }
                    }*/
                    ?>            
</div>
</body>
</html>