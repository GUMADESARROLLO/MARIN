<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <style>
        tbody td, thead th{ padding: 8px 10px;}
        #tblEstadoFactura{border-collapse: separate;border-spacing: 2px;color: white; font-family: 'robotoblack';}
        #tblEstadoFactura tbody td{color:#831f82;font-size: 11px;}
        #tblEstadoFactura tr:nth-child(even){background: #ffffff;}
        #tblEstadoFactura tr:nth-child(odd){ background: #e7e2f7; }
        #tblEstadoFactura th{ background: #831f82;color: #fff; font-size: 14px;}
        #logo{margin: 10px 15px 10px;}
        .negra{
            font-family: 'robotoblack'!important;
        }
        .mediana{
            font-family: 'robotomedium'!important;
        }
        .red-text{color: red;}
        .Mcolor {
            color: #831F82;
            font-size: 19px;
            font-family: 'robotoblack';
        }
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
<!--<div class="row">
    <p style="font-family: 'robotoblack';font-size: 14px; color: #831f82; font-weight:bold;">COD:
    <span style="font-size: 12px;" id="rpCodCliente" class="linea mediana mayuscula"><?php echo $detalles[0]['TELEFONO']; ?></span></p>

    <p style="font-family: 'robotoblack';font-size: 14px; color: #831f82; font-weight:bold;">DIR:
    <span style="font-size: 12px;" id="rpCodCliente" class="linea mediana mayuscula"><?php echo $detalles[0]['DIRECCION']; ?></span></p>
</div>-->
<div style="text-align:center" class="">
<h3 style="font-family: 'robotoblack';font-size: 18px; color: #831f82; font-weight:bold;">REPORTE DE DISPONIBILIDAD DE PUNTOS (SPINN)</h3>
</div>
<table id="tblEstadoFactura" style='width: 100%;'>
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
                            <td>".number_format($factura['P_ACUMULADOS'],2)."</td>
                            <td>".number_format($factura['P_DISPONIBLES'],2)."</td>
                            <td>".$factura['ESTADO']."</td>
                        </tr>
                    ";
                }
            }
    ?>
    </tbody>
</table>
</div>
<div class="row Mcolor">
    <h6 class="">TOTAL ACUMULADO: <span class="red-text" id="ttAcumulado"><?php echo number_format($totalAcumulado,2); ?></span></h6>
    <h6 class="">TOTAL DISPONIBLE: <span class="red-text" id="ttDisponible"><?php echo number_format($totalDisponible,2); ?></span></h6>
</div>
</body>
</html>