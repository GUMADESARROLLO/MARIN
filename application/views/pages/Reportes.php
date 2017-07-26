<header class="demo-header mdl-layout__header ">
    <div class="centrado  ColorHeader">
        <span class=" title">reportes</span>
    </div>
</header>
<!--//////////////////////////////////////////////////////////
                CONTENIDO
///////////////////////////////////////////////////////////-->
<main class="mdl-layout__content mdl-color--grey-100">
        <div  id="contenedor">
            <a href="#Filtros" class="noHover IconBlue modal-action modal-close modal-trigger ">
                <i class="medium material-icons iconoCenter">assignment</i>
                <p class="iconoCenter TextIconos">REPORTES</p>
            </a>
        </div>
</main>

<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                            Modal Filtros
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- Modal Cuenta por Cliente -->
<div id="Filtros" class="modal">
    <div class="modal-content">
        <div class="right row">
            <div class="col s1 m1 l1">
                <a href="#!" class="noHover BtnClose modal-action modal-close ">
                    <i class="material-icons">highlight_off</i>
                </a>
            </div>
        </div>
        <div class="center row TextColor">
            <div class="col s12 m12 l12">
               REPORTES
            </div>
        </div>
        <div class="row">
            <form action="ExpPDFEstadoFactura" id="FrmEstadoFactura" name="FrmEstadoFactura"  method="post" target="_blank">
                <input name="Codigo" type="hidden" id="txtCodigo" value="0">
                <input name="txtFecha1" type="hidden" id="txtFecha1" value="0">
                <input name="txtFecha2" type="hidden" id="txtFecha2" value="0">
                <input name="reporte" type="hidden" id="reporte" value="0">
                <input name="tipoReporte" type="hidden" id="tipoReporte" value="0">
                <div class="row">
                    <div class="col s12 s12 m6 l6">
                        <select class="chosen-select browser-default " id="idCliente">
                            <option value="0">Todos...</option>
                            <?PHP
                            if(!$Clientes){
                            } else {
                                foreach($Clientes as $cliente){
                                    echo '<option value="'.$cliente['CODIGO'].'">'.$cliente['NOMBRE'].'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <input name="fecha1" placeholder="Desde" id="fecha1" type="text" class="datepicker1">
                    </div>
                    <div class="input-field col s12 m6 l6">
                        <input name="fecha2" placeholder="Hasta" id="fecha2" type="text" class="datepicker1">
                    </div>
                </div>
                <div class="row">

                    <div class="input-field col s12 m6 offset-l1 l5">
                        <p>
                            <input class="with-gap" name="RptGrupo" type="radio" id="R1" checked />
                            <label for="R1">ESTADO DE FACTURA</label>
                        </p>
                    </div>
                    <div class="input-field col s12 m6  l5">
                        <p>
                            <input class="with-gap" name="RptGrupo" type="radio" id="R2" />
                            <label for="R2">DISPONIBILIDAD DE PUNTOS</label>
                        </p>
                    </div>
                </div>
            </form>
        </div>

        <div class="row center">
            <a href="#" id="BtnFiltroReporte" class="Btnadd btn">GENERAR </a>
        </div>
    </div>
</div>
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                            View Estado de Factura
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<div id="EstadoFactura" class="modal">
    <div class="modal-content">
        <div class="left row">
            <div class="col s12 m3 l3" >
                <img src="<?php echo base_url();?>assets/img/sp_logo_para_impresion.png">
            </div>
        </div>
        <div class="right row">
            <div class="col s1 m1 l1">
                <a href="#!" class="noHover BtnClose modal-action modal-close ">
                    <i class="material-icons">highlight_off</i>
                </a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col s12 offset-m2 offset-l2 m5 l5">
                <h6 class="center Mcolor AdUser">ESTADO DE FACTURAS</h6>
            </div>
        </div>
        <div class="col s1" id="tituloReport1">  <p class="frpT pts">DATOS DEL CLIENTE</p></div>

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
        </div>
        <div id="loadEstadoFactura" class="progress" style='display:none;'>
            <div class="indeterminate"></div>
        </div>
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
                    
                    </tbody>
                </table>
        </div>
        <div id="Iconos" class="center row">
            <div class="col offset-l5 s2 l1">
                <a class="noHover" href="#" onclick="exportarEstadoFactura(2)"><img src="<?PHP echo base_url();?>assets/img/ico_imprimir.png" width="38px"></a>
            </div>
            <div class="col s2 l1">
                <a class="noHover" href="#" onclick="exportarEstadoFactura(0)" ><img src="<?PHP echo base_url();?>assets/img/icono_excel.png" width="38px"></a>
            </div>
            <div class="col s2 l1">
                <a class="noHover" href="#" onclick="exportarEstadoFactura(1)"><img src="<?PHP echo base_url();?>assets/img/icono-pdf.png" width="38px"></a>
            </div>
        </div>
    </div>
</div>


<div id="DisponiblePuntos" class="modal">
    <div class="modal-content">
        <div class="left row">
            <div class="col s12 m3 l3" >
                <img src="<?php echo base_url();?>assets/img/sp_logo_para_impresion.png">
            </div>
        </div>
        <div class="right row">
            <div class="col s1 m1 l1">
                <a href="#!" class="noHover BtnClose modal-action modal-close ">
                    <i class="material-icons">highlight_off</i>
                </a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col s12 offset-m2 offset-l2 m5 l5">
                <h6 class="center Mcolor AdUser">DISPONIBILIDAD DE PUNTOS</h6>
            </div>
        </div>
        <div class="col s1" id="tituloReport1">  <p class="frpT pts">DATOS DEL CLIENTE</p></div>

        <div class="row">
            <div class="col s11 m12 l6" id="divCliente">
                <p class="cod Mcolor noMargen">COD: <span id="rpCodCliente2" class="linea mediana mayuscula"></span></p>
                <p class="cod Mcolor noMargen">NOMBRE: <span id="rpNomCliente2" class="linea mediana mayuscula"></span></p>
                <p class="cod Mcolor noMargen">DIRECCION: <span id="rpDireccion2" class="linea mediana mayuscula"></span></p>
                <p class="cod Mcolor noMargen">TELEFONO: <span id="rpTelefono2" class="linea mediana mayuscula"></span></p>
            </div>

            <div id="divFecha">
                <div class="col s6 m6 l3 " >
                    <p class="fecha" id="Modal1Fecha12" >00/00/0000</p>
                    <p class="rango">Desde</p>
                </div>
                <div class="col s6 m6 l3">
                    <p class="fecha" id="Modal1Fecha22">00/00/0000</p>
                    <p class="rango">Hasta</p>
                </div>
            </div>
        </div>
        <div id="loadDisponiblePuntos" class="progress" style='display:none;'>
            <div class="indeterminate"></div>
        </div>
        <div class="row center">
            <form action="" name="FrmDisponiblePuntos" id="FrmDisponiblePuntos" method="post">
                <table id="tblDisponibilidadPuntos" class=" TblDatos">
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
                    
                    </tbody>
                </table>
            </form>
        </div>
        <div class="row Mcolor">
            <h6 class="">TOTAL ACUMULADO: <span class="red-text" id="ttAcumulado"></span></h6>
            <h6 class="">TOTAL DISPONIBLE: <span class="red-text" id="ttDisponible"></span></h6>
        </div>
        <div id="Iconos" class="center row">
            <div class="col offset-l5 offset-m5 offset-s2 s2 m1 l1">
                <a class="noHover" href="#" onclick="exportarEstadoFactura(2)"><img src="<?PHP echo base_url();?>assets/img/ico_imprimir.png" width="38px"></a>
            </div>
            <div class="col s2 m1 l1">
                <a class="noHover" href="#" onclick="exportarEstadoFactura(0)"><img src="<?PHP echo base_url();?>assets/img/icono_excel.png" width="38px"></a>
            </div>
            <div class="col s2 m1 l1">
                <a class="noHover" href="#" onclick="exportarEstadoFactura(1)"><img src="<?PHP echo base_url();?>assets/img/icono-pdf.png" width="38px"></a>
            </div>
        </div>
    </div>
</div>