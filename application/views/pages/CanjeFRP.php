<header class="demo-header mdl-layout__header ">
    <div class="centrado  ColorHeader">
        <span class=" title">canje de puntos</span>
    </div>
</header>
<!--//////////////////////////////////////////////////////////
                CONTENIDO
///////////////////////////////////////////////////////////-->

<main class="mdl-layout__content mdl-color--grey-100">
    <div class="contenedor">
        
        <div class=" row TextColor center"><div class="col s12 m12 l12">canje de puntos</div></div>
        <div id="search" class="Buscar row">
            <div class="offset-m2 offset-l3 col s1 m1 l1"><i class="material-icons ColorS">search</i></div>
            <div class="input-field col s11 m6 l3">
                <input  id="searchFRP" type="text" placeholder="Buscar" class="validate">
                <label for="search"></label>
            </div>
        </div>

        <?php if (($this->session->userdata('IdRol')==2) || $this->session->userdata('IdRol')==1) {
            echo    '<div class="right row">
                        <div class="col s2">
                            <a href="#MFrp" class="BtnBlue waves-effect  btn modal-trigger">canje</a>
                        </div>';
                }
            ?>
        </div>
        
        <table id="FRP" class=" TblDatos">
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>#FRP</th>
                    <th>COD. CLIENTE</th>
                    <th>NOMBRE</th>
                    <th>OPCIONES</th>
                </tr>
            </thead>
            <tbody>
            <?PHP
            if(!$Lista){
            } else {
                foreach($Lista as $frp){

                    if ($frp['Anulado'] == "S"){
                        $clase="tachado";
                        $delete="";
                    } else {
                        $clase="";
                        $delete = "<a  onclick='dellFrp(".$frp['IdFRP'].")' href='#!' class='Icono noHover modal-trigger'><i class='material-icons'>highlight_off</i></a>";
                    }
                    echo "<tr>
                                <td class='".$clase."'>".$frp['Fecha']."</td>
                                <td class='".$clase."'>".$frp['IdFRP']."</td>
                                <td class='".$clase."'>".$frp['IdCliente']."</td>
                                <td class='".$clase."' id='NomCliente'>".$frp['Nombre']."</td>
                                <td class='center'>
                                    <a  onclick='getview(".$frp['IdFRP'].")' href='#' class='noHover'><i class='material-icons'>&#xE417;</i></a>
                                    ".$delete."
                                </td>
                            </tr>";
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</main>
<!--//////////////////////////////////////////////////////////////////////////////////////////////
                                      MODALES
///////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- Modal #1 Modal Structure -->
<div id="MFrp" class="modal">
    <div class="modal-content">
        <div class="right row">
            <div class="col s1 m1 l1">
                <a href="#!" class=" BtnClose modal-action modal-close noHover">
                    <i class="material-icons">highlight_off</i>
                </a>
            </div>
        </div>

        <div class="row center TextColor">
            FORMATO DE REMISIÓN DE PUNTOS
        </div>    
        
        <div class="row noMargen center Mcolor">
            CLIENTE
        </div>
        <div class="row">
            <div class=" DatoFrp col s4 m3 l2">
                N° FRP: <input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" id="frp" type="text" class="validate">
            </div>            

            <div class="DatoFrp col col s4 m3 l2 offset-l8 offset-m4 offset-s4">
                FECHA:<input  type="text" id="date1" class="datepicker1">
            </div>

        </div>

        <div class="row" >
            <div class=" DatoFrp input-field line col s12 m4 l2 ">
               COD. CLIENTE:<input disabled id="ClienteFRP"  type="text" class="validate ">
            </div>
            <div class="input-field col s12 m8 l8">
                <select class="chosen-select browser-default " id="ListCliente">
                    <option value="0" selected >CLIENTES...</option>
                    
                    <?PHP
                        if(!$Clientes){
                        } else {
                            foreach($Clientes as $cliente){
                                echo '<option value="'.$cliente['CODIGO'].'">'.$cliente['CLIENTE'].'</option>';
                            }
                        }
                    ?>
                </select>
            </div>
            <div class=" DatoFrp input-field line col s12 m12 l2">
                PUNTOS:<input disabled id="PtsClientefrp" type="text" class="validate">
            </div>
        </div>
        <!-- datos de los premios a canjear  -->
        <div class="row">
            <div class="DatoFrp line input-field col s6 m4 l2">
                COD. PREMIO:<input disabled  id="CodPremioFRP" type="text" class="validate">
            </div>

            <div class="input-field col s6 m8 l6">
                <select class="chosen-select browser-default " name="PREMIO" id="ListCatalogo"  >
                    <option value="0" selected>...</option>
                        <?PHP
                            if(!$Catalogo){
                            } else {
                                foreach($Catalogo as $premios){
                                    echo '<option value="'.$premios['IdIMG'].'">'.$premios['Nombre'].'</option>';
                                }
                            }
                        ?>
                </select>
            </div>

            <div class="DatoFrp line input-field col s12 m9 l2 ">
                <input disabled id="ValorPtsPremioFRP"  type="text" class="validate">
            </div>
            
            <div class="DatoFrp line input-field col s12 m3 l2 ">
                CANTIDAD:<input  id="CantPremioFRP"  type="text" class="validate">
            </div>
        </div>
        <div class="right row">
            <div class="preloader-wrapper small active" style="display:none" id="prgLoad">
                <div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div>
                    <div class="gap-patch"><div class="circle"></div></div>
                    <div class="circle-clipper right"><div class="circle"></div></div>
                </div>
            </div>
            <div class="col s2 m2 l2">
                <a href="#" id="AddPremioTbl" class="BtnBlue waves-effect  btn ">agregar</a>
            </div>
        </div>

        <table id="tblpRODUCTOS" class=" TblDatos">
            <thead>
                <tr>
                    <th>CANT.</th>
                    <th>COD. PREMIO</th>
                    <th>DESCRIPCIÓN</th>
                    <th>Pts. </th>
                    <th>TOTAL Pts.</th>
                    <th>CANCELAR</th>
                </tr>
            </thead>

            <tbody></tbody>
        </table>
        <div id="Total" class="right row text">
            <div class="col s12 m12 l12"><p class="Dato">A APLICAR: <span class="dato" id="idttPtsFRP">0</span> Pts.</p></div>
        </div>

        <table id="tblFacturaFRP" class=" TblDatos">
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>FACTURA</th>
                    <th>Pts.</th>
                    <th>Pts. APLI.</th>
                    <th>Pts. DISP.</th>
                    <th></th>
                    <th>ESTADO</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <div class="row">
            <div id="Total" class="right row">
                <div class="col s12"><p class="Dato">PENDIENTES A APLICAR: <span class="dato" id="idttPtsCLsFRP">0</span> Pts.</p></div>
            </div>
        </div>
        <div class="center row noMargen">
            <a href="#!" id="btnProcesar" class="Procesar waves-effect modal-action modal-close btn modal-trigger">procesar</a>
        </div>
    </div>
</div>
<!-- Fin de Modal#1-->


<!--///////////////////////////////////////////////////////////////////////////////////////////////
                                     MODALES ELIMINACION DE FRP
////////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- Modal #2 -->
<!-- Modal Structure -->
<div id="Dell" class="modal">
    <div class="modal-content">
        <div class="right row noMargen">
                <a href="#!" class=" BtnClose modal-action modal-close noHover">
                    <i class="material-icons">highlight_off</i>
                </a>
        </div>
        <div class="row center ">
            <h6 class="Mcolor1">DESEA ELIMINAR EL FRP #<span class="redT1" id="spnDellFRP">#</span></h6>
        </div>
        <div class="row center">
                <a href="#!" id="idProcederDell" class="Procesar modal-action modal-close btn modal-trigger">Procesar</a>
        </div>
    </div>
</div>
<!-- Modal #3 -->
<!-- Modal Structure -->

<div id="DellRes" class="modal">
    <div class="modal-content">
        <div class="right row">
                <a href="#!" class=" BtnClose modal-action modal-close noHover">
                    <i class="material-icons">highlight_off</i>
                </a>
        </div>
        <h6 class="center Mcolor1">ELIMINADO CORRECTAMENTE FRP #<span class="redT1" id="dellCorrectoFRP">00351</span></h6>
    </div>
</div>

<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                        MODAL DETALLE FRP
//////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal #4 Modal Structure -->
<div id="Dfrp" class="modal">
    <div class="modal-content">
        <div class="row right">
            <a href="#!" class=" BtnClose modal-action modal-close noHover">
                <i class="material-icons">highlight_off</i>
            </a>
        </div>
            <div class="container center">
                <div class="col s1" >
                    <div class="row">
                        <div class="col s11"><span id="titulM" class="Mcolor"> DETALLE FRP</span></div>                        
                    </div>
                </div>

                <div class="row center " id="frpProgress">
                    <div class="preloader-wrapper big active">
                        <div class="spinner-layer spinner-blue-only">
                            <div class="circle-clipper left"><div class="circle"></div></div>
                            <div class="gap-patch"><div class="circle"></div></div>
                            <div class="circle-clipper right"><div class="circle"></div></div>
                        </div>
                    </div>
                </div>
                
                <div id="divTop">
                    <div class="col s5">
                        <span class="center datos1 frpT"> N° FRP <span id="spnFRP"> </span></span><br>
                        <span class="center datos1 lineas"> <span id="spnFecha"></span></span>
                    </div>

                    <div class="col s1">
                        <span id="Nfarmacia" class="center Mcolor">COD# <span id="spnCodCls"></span> NOMBRE: <span id="spnNombreCliente"></span></span><br>
                    </div>
                </div>
            </div>

           <div id="divTbl">
               <table id="tblModal1" class="TblDatos">
                   <thead>
                    <tr>
                        <th>FECHA</th>
                        <th>VOUCHER</th>
                        <th>Pts.</th>
                        <th>Pts. APLI.</th>
                        <th>Pts. DISP.</th>
                        <th>ESTADO</th>
                    </tr>
                   </thead>

                   <tbody></tbody>
               </table>
               <h6 class="center Mcolor">PREMIO A CANJEAR</h6>

               <table id="tblModal2" class="TblDatos">
                   <thead>
                    <tr>
                        <th>CANT.</th>
                        <th>COD. PREMIO</th>
                        <th>DESCRIPCIÓN</th>
                        <th>Pts. </th>
                        <th>TOTAL Pts.</th>
                    </tr>
                   </thead>

                   <tbody></tbody>
               </table>
               <h6 class="center Mcolor dat">TOTAL FRP <span class="dato"><span id="spnTotalFRP"></span></span> </h6>
               <div class="row center" style="">
                   <a class="noHover" href="#" onclick="callUrlPrint('ExpFRP','spnFRP')"  target="_blank"><img src="<?PHP echo base_url();?>assets/img/ico_imprimir.png " width="45px" ></a>
               </div>
           </div>
    </div>
</div>

<div id="idviewFRP" class="modal">
    <div class="modal-content">
            <div class="row right">
                    <a href="#!" class=" BtnClose modal-action modal-close noHover">
                        <i class="material-icons">highlight_off</i>
                    </a>
            </div>
            <div class="container center">            
            <div class="row">
                <div class="center col s12 m12 l12">
                    <h6 class="Mcolor noMargen">DETALLE FRP</h6>
                </div>
            </div>

                <div class="row center " id="vfrpProgress">
                    <div class="preloader-wrapper big active">
                        <div class="spinner-layer spinner-blue-only">
                            <div class="circle-clipper left"><div class="circle"></div></div>
                            <div class="gap-patch"><div class="circle"></div></div>
                            <div class="circle-clipper right"><div class="circle"></div></div>
                        </div>
                    </div>
                </div>
                
                <div id="vfrpTop">
                    <div class="col s5">
                        <span class="center datos1 frpT"> N° FRP <span id="spnviewFRP"> </span></span><br>
                        <span class="center datos1 lineas"> <span id="spnviewFecha"></span></span>
                    </div>

                    <div class="col s1">
                        <span id="Nfarmacia" class="center Mcolor">COD# <span id="spnviewCodCls"></span> NOMBRE: <span id="spnviewNombreCliente"></span></span><br>
                    </div>
                </div>
            </div>

           <div id="vfrpTop">
               <table id="tblviewDFacturaFRP" class="TblDatos">
                   <thead>
                        <tr>
                            <th>FECHA</th>
                            <th>FACTURA</th>
                            <th>Pts.</th>
                            <th>Pts. APLI.</th>
                            <th>Pts. DISP.</th>
                            <th>ESTADO</th>
                        </tr>
                   </thead>
                   
                   <tbody class="center"></tbody>
               </table>
               <h6 class="center Mcolor">PREMIO A CANJEAR</h6>

               <table id="tblviewDPremioFRP" class="TblDatos">
                   <thead>
                        <tr>
                            <th>CANT.</th>
                            <th>COD. PREMIO</th>
                            <th>DESCRIPCIÓN</th>
                            <th>Pts. </th>
                            <th>TOTAL Pts.</th>
                        </tr>
                   </thead>
                   
                   <tbody class="center"></tbody>
               </table>
               <h6 class="center Mcolor dat">TOTAL FRP <span class="dato"><span id="spnttFRP"></span> Pts.</span> </h6>
               <div style = "display:none;" id = "iconoPrint" class="row center">
                   <a class="noHover" href="#" onclick="callUrlPrint('ExpFRP','spnviewFRP')"><img src="<?PHP echo base_url();?>assets/img/ico_imprimir.png " width="45px" ></a>
               </div>
           </div>
    </div>
</div>
<!-- Fin de Modal#4-->