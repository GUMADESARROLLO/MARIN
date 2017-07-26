<body onload="window.print();"><!-- Impresion de la Página al cargar... -->
    <style>
        #tblEstadoFactura{border-collapse: separate;border-spacing: 2px;color: white; font-family: 'robotoblack';}
        #tblEstadoFactura tbody td{color: #831f82;font-size: 14px;}
        #tblEstadoFactura tr:nth-child(even){background: #ffffff;}
        #tblEstadoFactura tr:nth-child(odd){ background: #e7e2f7; }
        #tblEstadoFactura th{ background: #831F82;color: #ffffff; font-size: 14px;}
        .Blank td {
            background: #ffffff;
        }
        .alert{
            color: #e74c3c ;
        }
        #view-source {
            position: fixed;
            display: block;
            right: 0;
            bottom: 0;
            margin-right: 40px;
            margin-bottom: 40px;
            z-index: 900;
        }
    </style>
    <div class="modal-content">
        <div class="left row" style="width:30%; float:left;">
            <div class="col s12 m3 l3" style="width:100%; text-align:left;" >
                <img src="<?php echo base_url();?>assets/img/sp_logo_para_impresion.png">
            </div>
        </div>
        <div class="row" style="width:100%; text-align:right;">
                <h4 class="center Mcolor AdUser">FECHA: <?php echo date('d-m-Y'); ?></h4>
        </div><br><br><br>
        <div class="row" style='width:100%; text-align:center;'>
            <div class="col s12 offset-m2 offset-l2 m5 l5">
                <h2 class="center Mcolor AdUser">REPORTE DE ESTADO DE FACTURAS</h2>
            </div>
        </div>
        <!--<div class="col s1" id="tituloReport1">  <p class="frpT pts">DATOS DEL CLIENTE</p></div>
        <div class="row">
            <div class="col s11 m12 l6" id="divCliente">
                <p class="cod Mcolor noMargen">COD: <span id="rpCodCliente" class="linea mediana mayuscula"></span></p>
                <p class="cod Mcolor noMargen">NOMBRE: <span id="rpNomCliente" class="linea mediana mayuscula"></span></p>
                <p class="cod Mcolor noMargen">DIRECCION: <span id="rpDireccion" class="linea mediana mayuscula"></span></p>
                <p class="cod Mcolor noMargen">TELEFONO: <span id="rpTelefono" class="linea mediana mayuscula"></span></p>
            </div>

            <div id="divFecha">
                <div class="col s12 m6 l3 " >
                    <p class="fecha" id="Modal1Fecha1" >00/00/0000</p>
                    <p class="rango">Desde</p>
                </div>
                <div class="col s12 m6 l3">
                    <p class="fecha" id="Modal1Fecha2">00/00/0000</p>
                    <p class="rango">Hasta</p>
                </div>
            </div>
        </div>-->
        <div class="row center">            
                <table id="tblEstadoFactura" class=" TblDatos">
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
        </div>
    </div>