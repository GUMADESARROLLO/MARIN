<header class="demo-header mdl-layout__header ">
    <div class="centrado  ColorHeader">
        <span class=" title">detalle facturas</span>
    </div>
</header>
<!--//////////////////////////////////////////////////////////
                CONTENIDO
///////////////////////////////////////////////////////////-->

<main class="mdl-layout__content mdl-color--grey-100">
    <div class="contenedor">
        <div class=" row TextColor">
            <div class="col s5 m5 l12 offset-m3 offset-s2">
                farmacia aracely
            </div>
        </div>

        <div class="row text">
            <div class="col s4 m4 l4 offset-l3 offset-m1">
                <p>CÓDIGO: <span class="Datos">00179</span></p>
            </div>
            
            <div class="col s3 m4 l4 ">
                <p>RUC: <span class="Datos">20131035001Y</span></p>
            </div>
        </div>

        <div class=" right row column">
            <div class="col s2 m2 l5">
                <img src="<?PHP echo base_url();?>assets/img/icono_excel.png " width="30px">
            </div>
            
            <div class="col s2 m2 l5 ">
                <img src="<?PHP echo base_url();?>assets/img/icono-pdf.png " width="30px" >
            </div>
        </div>

        <table id="PtosCliente" class=" TblDatos">
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>FACTURA</th>
                    <th>PUNTOS</th>
                    <th>ESTADO</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td> xxxx</td>
                    <td id="Codigo"> <a  href="#modal1" class="modal-trigger">xxxxx</td></a>
                    <td id="black">454545 Pts</td>
                    <td>ACTIVO</td>
                </tr>

                <tr>
                    <td>xxxx</td>
                    <td id="Codigo">xxxxx</td>
                    <td id="black">454545 Pts</td>
                    <td id="aplicado">APLICADO</td>
                </tr>

                <tr>
                    <td>xxxx</td>
                    <td id="Codigo">xxxxx</td>
                    <td id="black">454545 Pts</td>
                    <td>ACTIVO</td>
                </tr>

                <tr>
                    <td>xxxx</td>
                    <td id="Codigo">xxxxx</td>
                    <td id="black">454545 Pts</td>
                    <td id="aplicado">APLICADO</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>



<!--///////////////////////////////////////////////////////////////////////
                        MODALES
////////////////////////////////////////////////////////////////////////-->

<!-- Modal #1
                Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <div class=" row">
            <div class="right col s1 m1 l1">
                <a href="#!" class=" BtnClose modal-action modal-close ">
                    <i class="material-icons">highlight_off</i>
                </a>
            </div>
        </div>
        
        <h6 class="center Mcolor">DETALLE FACTURA</h6>
        <div class="row">
            <div class="col s6 m6 l8">
                <span class="Datos">FARMACIA ARACELY</span>
            </div>

            <div class="col s6 m5 l4">
                <p class="Datos">FACTURA: <span class="redT">62209</span></p>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <table id="tblModal1" class="TheadColor">
                    <thead>
                        <tr>
                            <th>CANT.</th>
                            <th>COD. ARTÍCULO</th>
                            <th>DESCRIPCIÓN</th>
                            <th>PUNTOS</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>5</td>
                            <td>10301032</td>
                            <td>Acetominofen xxxxxxxxxx</td>
                            <td id="black"> 20 Pts.</td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td>10301032</td>
                            <td>Acetominofen xxxxxxxxxx</td>
                            <td  id="black">20 Pts.</td>
                        </tr>
                    </tbody>
                </table>
                <h6 class="center texttotal">TOTAL COMPRA 120 Pts.</h6>
            </div>
        </div>
    </div>
</div><!-- Fin de Modal#1-->