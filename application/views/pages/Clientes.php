<header class="valign-wrapper demo-header mdl-layout__header ">
    <div class="centrado  ColorHeader">
        <span class=" title">CLIENTES</span>
    </div>
</header>
<!--//////////////////////////////////////////////////////////
                CONTENIDO
///////////////////////////////////////////////////////////-->
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="contenedor">
        <div class="center row TextColor">
            <div class="col s12 m12 l12">
                CLIENTES EN EL PROGRAMA DE PUNTOS
            </div>
        </div>

        <div class="container">
            <div class=" Buscar row column">
                <div class="col s1 m1 l1 offset-l2 offset-m2 ">
                    <i class="material-icons ColorS">search</i>
                </div>

                <div class="input-field col s6 m4 l4">
                    <input  id="searchClientes" type="text" placeholder="Buscar" class="validate">
                    <label for="search"></label>
                </div>

                <div class="col s2 m1 l1">
                    <a href="Exp_Clientes" class="noHover" onclick="exportar('FrmClientes');"> <img src="<?PHP echo base_url();?>assets/img/icono_excel.svg " width="30px"></a>
                </div>

                <div class="col s1 m1 l1 ">
                    <a href="ExpPDF" target="_blank" class="noHover" onclick="exportar('FrmClientes');"><img src="<?PHP echo base_url();?>assets/img/icono_pdf.svg " width="30px" ></a>
                </div>
            </div>
        </div>
        <div class="row">
            <form action="" name="FrmClientes" id="FrmClientes" method="post"> <!--Exportar datos a EXCEL -->
                <table id="ClienteAdd" class="table TblDatos">
                    <thead>
                    <tr>
                        <th>CÓDIGO</th>
                        <th>CLIENTE</th>
                        <th>RUC</th>
                        <th>DIRECCIÓN</th>
                        <th>VENDEDOR</th>
                        <?php 
                        if ($this->session->userdata('IdRol')==7 || $this->session->userdata('IdRol')==1) {
                            echo "<th>VOUCHER</th>";
                        }
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?PHP
                    if(!($Clientes)){
                    } else {
                        foreach($Clientes as $cliente){
                            echo "<tr>
                                            <td>".$cliente['CODIGO']."</td>
                                            <td class='negra'>
                                            <a class='noHover' href='#modalPtsCliente' onclick='clientesPuntos(".'"'.$cliente['NOMBRE'].'",'.'"'.$cliente['VENDEDOR'].'",'.'"'.$cliente['RUC'].'",'.'"'.$cliente['CODIGO'].'"'.")' class='modal-trigger'>".$cliente['NOMBRE']."</a>
                                            </td>
                                            <td>".$cliente['RUC']."</td>";
                        if ($this->session->userdata('IdRol')==7 || $this->session->userdata('IdRol')==1) {
                                            echo "<td class='searchDireccion'>".$cliente['DIRECCION']."</td>";
                                        }else{
                                            echo "<td>".$cliente['DIRECCION']."</td>";
                                        }
                                            echo "<td>".$cliente['VENDEDOR']."</td>";
                        if ($this->session->userdata('IdRol')==7 || $this->session->userdata('IdRol')==1) {
                                            echo "<td class='center'><a class='noHover' href='#' onclick='printVoucher(".'"'.base_url('index.php/PdfVoucher')."/".$cliente['CODIGO'].'"'.")'><i class='material-icons'>print</i></a></td>";
                                        }
                                        echo "</tr>";
                                }
                        }
                    
                    ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div><!-- Fin Contenedor -->
</main>
<!--///////////////////////////////////////////////////////////////////////
                        MODALES
////////////////////////////////////////////////////////////////////////-->
<!--Modal Structure -->
<div id="modalPtsCliente" class="modal">
    <div  class="modal-content">
        <div class="row noMargen center"><div id="loadIMG" style="display:none;" class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue-only">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>

                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>

                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="detalleCliente" class="row noMargen">
            <div class="row">
                <div class="right col s3 m3 l3">
                    <a href="#!" class=" BtnClose modal-action modal-close noHover">
                        <i class="material-icons">highlight_off</i>
                    </a>
                </div>
                <div class="center col s12 m12 l12">
                    <h6 class="Mcolor noMargen">INFORMACIÓN DEL CLIENTE</h6>
                </div>
            </div>

            <div class="row">
                <div class="col s12"><br>
                    <div class="col s12">
                        <p id="codCliente" class="center datos1 cod noMargen"></p>
                    </div>

                    <div class="col s12">
                        <h6 id="nomCliente" class="center datos1 user noMargen"></h6>
                    </div>

                    <div class="col s12">
                        <p id="rucCliente" class="center datos1 ruc"> RUC 4412000183001H</p>
                    </div>

                    <div class="col s12">
                        <p id="acumulado" class="center Datos negra noMargen">ACUMULADO: <span id="AcuT"></span> Pts.</p>
                    </div>

                    <div class="col s12">
                        <p id="acumulado" class="center Datos negra noMargen">DISPONIBLE: <span id="Disp"></span> Pts.</p>
                    </div>

                    <div class="col s12">
                        <p id="acumulado" class="center Datos negra">CANJEADO: <span id="Canj"></span> Pts.</p>
                    </div>

                    <div class="row noMargen">
                        <div class="col s12 m12 l12">
                            <p id="ModalFeet"  class="datos1 negra">VENDEDOR:<br><span id="vendedorCliente">250,000</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m12 l12 center">
            <a href="#" class="Btnadd modal-action modal-close btn">ACEPTAR</a>
        </div>
    </div>
</div>