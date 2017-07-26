<html lang="en">
    <meta charset="UTF-8">
        <style>
        @page *{
            margin-header: 5mm; 
        }
        tbody td, thead th{ padding: 8px 10px;}
        #tblEstadoFactura{border-collapse: separate;border-spacing: 2px;color: white;}
        #tblEstadoFactura tbody td{color:black;font-size: 11px;}
        #tblEstadoFactura tr:nth-child(even){background: #ffffff;}
        #tblEstadoFactura tr:nth-child(odd){ background: #ffffff; }
        #tblEstadoFactura tr th{ background: white;color: black; font-size: 25px;}
        #tblEstadoFactura tr td{ font-size: 25px; font-family: verdana;}
       body{
        font-family: verdana;
        }
        .footer{
            color: black;
            font-size: 11px;
            font-family: verdana!important;
            font-weight: bold;
        }
        .center{text-align: center!important;}
        .negra{font-family: verdana!important;}
        .mediana{font-family: verdana!important;
        }.regular{font-family: verdana!important;}
        .noMargen{margin: 0px;}
        .fecha{font-size: 5px;margin-top: 0px;}
        .Mcolor {
            color: black;
            font-size: 12px;
            font-weight: bold;
            font-family: verdana!important;
        }
        .Mcolor2 {
            color: black;
            font-size: 12px;
            font-weight: bold;
            font-family: verdana!important;
        }
        .titulos{
            color: black;
            font-size: 12px;
            font-family: verdana!important;
            font-weight: bold;
        }
        .detalleencabezado{
            color: black;
            font-size: 10px;
           font-family: verdana!important;
        }
        .detalles{
            color: black;
            font-size: 10px;
            font-family: verdana!important;
        }.info{
            color: black;
            font-size: 12px;
            font-family: verdana!important;
        }
        .row{

            width: 100%!important;
        }
    </style>
    <div class="row" style="width:288px!important; margin-top:0px; padding:0px;">
         <div class="row">
            <div class="center">
                <p class="Mcolor noMargen">INNOVA INDUSTRIAS S.A SPINN</p>
            </div>
        </div>
        <div class="row">
            <div class="center">
                <p class="Mcolor2 noMargen">ESTADO DE CUENTA</p>
            </div>
        </div>
                <div style="float:left;width: 58%;outline: green solid thin">
                    <p id="acumulado" class="titulos noMargen">FECHA: <span class="detalleencabezado center"><?php echo date("d/m/Y H:i:s"); ?></span></p>
                </div>
                <div style="float:left;width: 40%;outline: green solid thin; text-align:left;">
                    <p id="acumulado" class="titulos noMargen">COD: <span class="detalleencabezado center"><?php echo $cliente[0]['COD_CLIENTE'];?></span></p>
                </div>
        <div class="row">            
                <div class="row">     
                    <p id="acumulado" class="titulos noMargen">CLIENTE: <span class="detalleencabezado center"><?php echo $cliente[0]['CLIENTE']; ?></span></p>
                </div>                                       
        </div>
        <div class="row" style="margin-top:7px;">
            <div class="row center">
                    <p class="titulos noMargen">PUNTOS</p>
                </div>
            <table id="tblEstadoFactura" style='width: 100%;'>
                <thead>
                    <tr>
                        <th>ACUMULADO</th>
                        <th>DISPONIBLE</th>                        
                        <th>CANJEADO</th>
                    </tr>
                </thead>
                <tbody>
                <?PHP
                        if(!($cliente)){
                            } else {
                                foreach($cliente as $factura){
                                    echo "
                                    <tr>
                                        <td class='center'>".number_format($factura['ACUMULADO'])."</td>
                                        <td class='center'>".number_format(($factura['DISPONIBLE']-$factura['CANJEADO']))."</td>
                                        <td class='center'>".number_format($factura['CANJEADO'])."</td>
                                    </tr>";
                            }
                        }
                ?>
                </tbody>
            </table>
        </div>
        <div class="row center" style="margin-top: 5px;">
            <p class="Mcolor2 noMargen">Siga participando!</p>
        </div>
        <hr>
    </div>
</html>