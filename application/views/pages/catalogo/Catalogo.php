<header class="demo-header mdl-layout__header ">
    <div class="centrado  ColorHeader"><span class=" title">catálogo</span></div>
</header>

<!--  CONTENIDO PRINCIPAL -->
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="contenedor">        
        <!-- fin de agregar nuevo articulo -->
        <div class=" row TextColor center"><div class="col s12 m8 l12 offset-m1">BUSCAR</div></div>
   
        <div class="container">
            <div class="Buscar row column">               
                <div class="col s1 m1 l1 offset-l3 offset-m1"><i class="material-icons ColorS">search</i></div>
                
                <div class="input-field col s12 m6 l4 offset-m1">
                    <input  id="searchCatalogo" type="text" placeholder="..." class="validate mayuscula">
                    <label for="search"></label>
                </div>
            </div>
        </div>
        <div class="row ">
            

            <div class="right derecha col s12 m12 l7">

                <a class='redondo dropdown-button btn' href='#' id="subir" data-activates='dropdown1'><i class="material-icons right">insert_invitation</i>CREAR</a>

                <input id="txtCount" type="hidden" value="<?php echo $countItem;?>">


            </div>
            <div class="bold valign-wrapper noMargen left col s12 m12 l4 TextColor">
                <h6>MASTER DE ARTÍCULOS</h6>
            </div>
        </div>

        <div class="row center scrollHorizontal">
            <table id="tblCatalogo2" class="TableBlank transparente">
                <thead>
                    <tr><th></th><th></th><th></th><th></th></tr>
                </thead>
                
                <tbody>
                    <?php

                        if (!($catalogo)) {
                        } else {

                            foreach ($catalogo as $key) {
                                echo "<tr>";
                  
                                for($i=1; $i<5; ++$i){

                                    if ($key['v_Puntos'.$i]!="0" and $key['v_Nombre'.$i]!="") {

                                        echo "<td>
                                            <div class='images_ca'>
                                                <div class='row' >
                                                    <a class='right' href='#' onclick='darBaja(".'"'.$key['v_IdIMG'.$i].'","'.$key['v_IdCT'.$i].'"'.")'><i class='material-icons'>highlight_off</i></a>
                                                </div>

                                                <p><img class='circle responsive-img' src=".base_url()."assets/img/catalogo/".$key['v_IMG'.$i]." alt=''></p>

                                                <p><img class='circle responsive-img' src=".base_url()."assets/img/catalogo/".$key['v_IMG2'.$i]." alt=''></p>
                                                <div class='descripImg'>
                                                    <p class='codP'> ".$key['v_IdIMG'.$i]."</p>
                                                     <p class='descript'>".$key['v_Nombre'.$i]."</p>
                                                    <p class='descript'>".str_replace(array("/A%", "/E%","/I%","/O%","/U%","/-%"),array("á", "é", "í","ó","ú","ñ"),  $key['v_Nombre2'.$i])."</p>";

                                                echo"</div>
                                        
                                                <a href='#' onclick = 'editarArticulo(".'"'.$key['v_IMG2'.$i].'","'.''.$key['v_IMG'.$i].'","'.$key['v_IdIMG'.$i].'","'.str_replace(array("/A%", "/E%","/I%","/O%","/U%","/-%",'"'),array("á", "é", "í","ó","ú","ñ","pulg"),  $key['v_Nombre'.$i]).'","'.$key['v_Nombre2'.$i].'","'.$key['v_Und'.$i].'","'.$key['v_Puntos'.$i].'"'.")' id='modificar' class='btn'>modificar</a>
                                            </div>
                                        </td>";
                                    } else {
                                        echo "<td></td>";
                                    }
                                }          
                                echo "</tr>";
                            }
                         }
                    ?>
                </tbody>
            </table>
       </div>
    </div>
</div>
</main>

<div class="row center">
    <?php
        if(!($catalogo2)){
        } else {
            foreach($catalogo2 AS $row){
                echo "<input id='IdCatalogoActual' type='text' value=".$row['IdCT'].">";break;
            }
        }
    ?>
</div>
  
<!-- FIN CONTENIDO PRINCIPAL -->
<!-- Modal Structure -->
<div id="modalIMG" class="modal">
    <div class="btnCerrar right"><i style='color:red;' class="material-icons modal-action modal-close">highlight_off</i></div>
    
    <div class="modal-content center">
      <h5 class="medium" id="mensajeIMG"></h5>
      <a id="aceptarIMG" class="btnaceptar redondo green regular waves-effect waves-light btn">ACEPTAR</a>
    </div>
</div>

<!-- Modal Structure -->
<div id="modalIMG2" class="modal">
    <div class="btnCerrar right"><i  style='color:red;' class="material-icons modal-action modal-close">highlight_off</i></div>
    
    <div class="modal-content center">
        <h5 class="medium" id="mensajeIMG2"></h5>
        <a id="aceptarIMG2" class="btnaceptar redondo green regular waves-effect waves-light btn">ACEPTAR</a>
    </div>
</div>

<!-- Modal Structure -->
<div id="nuevoArticulo" class="modal">
    <div class="btnCerrar right"><i style='color:red;' class="material-icons modal-action modal-close">highlight_off</i></div>
    
    <div class="modal-content">
        <div class="row TextColor center">
            <div class="col s5 m8 l12">
                ingreso de artículo
            </div>
        </div>
     
        <div>
            <form id="formimagen" name="formNuevoArto" enctype="multipart/form-data" class="col s6 m6 l6" action="<?PHP echo base_url('index.php/subirImg');?>" method="post">
                <input id="bandera" name="bandera" type="hidden" value="0">


                
                <div class="">
                    <div id="articulo" class="row">
                        <div class="input-field col s6 l6 ">
                            <input  id="codigoArto"  onmousedown="return false" onkeydown="return false"  name="codigo" type="text" class="validate">
                            <label for="codigoArto">ID:</label><label id="labelCodigo" class="labelValidacion">REQUERIDO</label>
                        </div>
                    
                        <div class="input-field col s6 l6">
                            <input name="nombre" id="NombArto" type="text" class="validate mayuscula">
                            <label for="NombArto">Descrip. ESP</label><label id="labelDescripcion" class="labelValidacion">REQUERIDO</label>
                        </div>
                    </div>
          
                    <div class="row">
                        <div class="input-field col s6 l6">
                            <input name="puntos" min=0 step="any" id="PtArto" type="text" class="validate">
                            <label for="PtArto">Descrip ENG</label><label id="labelPuntos" class="labelValidacion">REQUERIDO</label>
                        </div>
                        <div class="input-field col s6 l6">
                            <input name="Und" min=0 step="any" id="UndArto" type="text" class="validate">
                            <label for="ArtoUnd">UND</label><label id="lblUnd" class="labelValidacion">DIGITE LA UNIDAD</label>
                        </div>
                    </div>
                    <div class="row center">
                        <div class="cosa">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div id="ImgContenedor" class="fileinput-new thumbnail" style="width: 250px; height: 150px; padding: 5px 0 10px !important;"></div>
                                <div id="ImgContenedor" class="fileinput-preview fileinput-exists thumbnail" style="max-width:250px; max-height:150px;"></div>

                                <div class="center">
                                    <label id="labelImagen" class="labelValidacion">PRINCIPAL IMAGEN</label>
                                    <label id="labelImagen3" class="labelValidacion">EL CÓDIGO NO COINCIDE</label>
                                </div>

                                <div class="center">
                            <span id="cargar" class="btn btn-default btn-file"><span class="fileinput-new">principal</span>
                            <span id="cancel" class="fileinput-exists">cambiar</span>
                            <input id="txtimagen" type="file" name="txtimagen"></span>
                                    <a id="cargar22" href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">cancelar</a>
                                </div>
                            </div>
                        </div>
                        <div class="cosa">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div id="ImgContenedor2" class="fileinput-new thumbnail" style="width: 250px; height: 150px; padding: 5px 0 10px !important;"></div>
                                <div id="ImgContenedor2" class="fileinput-preview fileinput-exists thumbnail" style="max-width:250px; max-height:150px;"></div>

                                <div class="center">
                                    <label id="labelImagen" class="labelValidacion">SELECCIONE UNA IMAGEN</label>
                                    <label id="labelImagen3" class="labelValidacion">EL CÓDIGO NO COINCIDE</label>
                                </div>

                                <div class="center">
                                        <span id="cargar" class="btn btn-default btn-file"><span class="fileinput-new">alterna</span>
                                        <span id="cancel" class="fileinput-exists">cambiar</span>
                                        <input id="txtimagen2" type="file" name="txtimagen2"></span>
                                    <a id="cargar22" href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">cancelar</a>
                                </div>

                            </div>

                        </div>

                        <div class="col offset-l10 offset-m5 offset-s4 l2 valign-wrapper" >
                            <a id="agregar" class="waves-effect btn-file waves-light btn" onclick="subirimagen()">GUARDAR</a>
                            <div id="loadIMG" style="display:none" class="preloader-wrapper big active">
                                <div class="spinner-layer spinner-blue-only">
                                    <div class="circle-clipper left"><div class="circle"></div></div>
                                    <div class="gap-patch"><div class="circle"></div></div>
                                    <div class="circle-clipper right"><div class="circle"></div></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
    

            </form>
        </div>
    </div>
</div>

<!-- Modal Structure DAR DE BAJA-->
<div id="darBaja" class="modal">
    <div class="btnCerrar right"><i style='color:red;' class="material-icons modal-action modal-close">highlight_off</i></div>
    
    <div class="modal-content">
        <div class="row TextColor center">
            <div class="col s5 m8 l12">¿está seguro que desea dar de baja a este artículo?</div>
        </div>
        
        <div class="row center">
            <div id="EditEstado" style="display:none" class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue-only">
                    <div class="circle-clipper left"><div class="circle"></div></div>
                    <div class="gap-patch"><div class="circle"></div></div>
                    <div class="circle-clipper right"><div class="circle"></div></div>
                </div>
            </div>
            
            <a id="darBajaOK" class="redondo waves-effect waves-light btn">ACEPTAR</a>
        </div>         
    </div>
</div>

<!--Modal Structure nuevo catalogo-->
<div id="modalNuevoCatalogo" class="modal">
    <div class="btnCerrar right"><i style='color:red;' class="material-icons modal-action modal-close">highlight_off</i></div>
  
    <div class="modal-content">
        <div class="row TextColor center"><div class="col s5 m8 l12 offset-m1">creación de nuevo catalogo</div></div>
   
        <form id="formNuevoCatalogo" action="<?PHP echo base_url('index.php/crearCatalogo');?>" method="post" name="formNuevoArto">
            <div class="row TextColor center">
                <div class="input-field offset-l1 col s12 m5 l5 ">
                    <input name="descripcion" id="descripcionCat" type="text" class="validate mayuscula">
                    <label for="descripcionCat">DESCRIPCIÓN:</label><label id="labelDescripcion2" class="labelValidacion">DIGITE LA DESCRIPCIÓN</label>
                </div>
            
                <div class="input-field col s2 m6 l5">
                    <input id="fechaCat2" name="fecha" type="date" class="datepicker">
                    <label for="fechaCat">FECHA:</label><label id="labelFecha2" class="labelValidacion">SELECCIONE UNA FECHA</label>
                </div> 
            </div>
        </form>
        
        <div class="row center">
            <a id="CrearCatalogo" class="redondo waves-effect waves-light btn">GUARDAR</a>
            <div id="loadCrearCatalogo" style="display:none" class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue-only">
                    <div class="circle-clipper left"><div class="circle"></div></div>
                    <div class="gap-patch"><div class="circle"></div></div>
                    <div class="circle-clipper right"><div class="circle"></div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modal Structure lista de articulos DE CATALOGO ACTUAL-->
<div id="listaArticulosCatalogoActual" class="modal">
    <div class="btnCerrar right"><i style='color:red;' class="material-icons modal-action modal-close">highlight_off</i></div>
    
    <div class="modal-content">
        <div class="row noMargen TextColor center">
            <div class="col s12 m12 l12">REUTILIZACIÓN DE CATÁLOGO</div>
            
            <div class="row noMargen">
                <div class="input-field col s12 l3">
                    <select id="cmbCatalogos" class="negra">
                        <option value="" disabled selected>AGREGAR ARTÍCULOS DE:</option>                        
                        <?php 
                            if (!($catalogos)){
                            } else {
                                foreach ($catalogos as $key) {
                                    $año = date_format(date_create($key['Fecha']),"Y");
                                    echo "<option value='".$key['IdCT']."'>".$key['Descripcion']." ".$año."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
        
                <div class="input-field offset-l6 col s12 l3">
                    <a id="btnborrarSeleccionados" class="waves-effect waves-light btn BtnBlue">
                    <i class="material-icons right">delete_forever</i>BORRAR</a>
                </div>
            </div>
        </div>

        <div class="progress progress2" style="display:none"><div class="indeterminate violet"></div></div>
      
        <div class="row noMargen TextColor center">
            <table id="tblCatalogoActualModal" class="table TblDatos">
                <thead>
                    <tr>
                        <th>CÓDIGO</th>
                        <th>ARTÍCULO</th>
                        <th>MINIATURA</th>
                        <th>PUNTOS</th>
                    </tr>
                </thead>
        
                <tbody></tbody>
            </table>      
        </div><br>
    
        <div class="row center">
            <a id="guardarCatalogo" class="redondo waves-effect waves-light btn">GUARDAR</a>
        </div>         
    </div>
</div>

<!--Modal Structure lista de articulos-->
<div id="listaArticulos" class="modal">
    <div class="btnCerrar right">
        <i  style='color:red;' class="material-icons modal-action modal-close">highlight_off</i>
    </div>
    
    <div class="modal-content">
        <div class="row TextColor center">
            <div class="col s12 m12 l18 ">reutilización de catálogo</div>
            
            <div class="col offset-s8 offset-m9 offset-l10 s2 m2 l2 ">
                <p>
                    <input type="checkbox" id="checkTodos" />
                    <label for="checkTodos">TODOS</label>
                </p>
            </div>
        </div>
        <div class="container">
            <div class="Buscar row column">               
                <div class="col s1 m1 l1 offset-l3 offset-m1"><i class="material-icons ColorS">search</i></div>
                
                <div class="input-field col s12 m6 l5 offset-m1">
                    <input  id="searchTblCatalogoPasado" type="text" placeholder="Buscar" class="validate mayuscula">
                    <label for="search"></label>
                </div>
            </div>
        </div>
  
        <div class="row TextColor center">
            <table id="tblCatalogoPasado" class="table TblDatos">
                <thead>
                    <tr>
                        <th>CÓDIGO</th>
                        <th>ARTÍCULO</th>
                        <th>MINIATURA</th>
                        <th>PUNTOS</th>
                        <th>SELECCIONAR</th>
                    </tr>
                </thead>
                
                <tbody></tbody>
            </table>
        </div>
  
        <div class="row center"><a id="addCatalogoAntiguo" class="redondo waves-effect waves-light btn">AGREGAR</a></div>         
    </div>
</div>


<!-- Modal Structure -->
<div id="nuevoArticuloArchivo" class="modal">
    <div class="btnCerrar right"><i style='color:red;' class="material-icons modal-action modal-close">highlight_off</i></div>
    
    <div class="modal-content">
        <div class="row TextColor center">
            <div class="col s12 m12 l12">
                ingreso de artículos atravez de archivo<i class="material-icons">assignment_turned_in</i>
            </div>
        </div>
     
        <div>
            <form id="formVariasImagenes" name="formImagenes" enctype="multipart/form-data" class="col s6 m6 l6" action="<?PHP echo base_url('index.php/subirVariasImagenes');?>" method="post">
                <input id="bandera" name="bandera" type="hidden" value="0">
                
                    <div class="row">
                        <div class="input-field offset-l1 col s12 m6 l5" style="margin-top: 0rem;">
                             <div class="file-field input-field">
                              <div class="btn btnArchivo">
                                <span>ARCHIVO EXCEL</span>
                                <input name='file' id="csv" type="file">
                              </div>
                              <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder"INGRESE EL ARCHIVO CSV">
                              </div>
                            </div>
                        </div>                    
                        <div class="input-field col s12 m6 l6" style="margin-top: 0rem;">
                            <div class="file-field input-field">
                              <div class="btn btnArchivo">
                                <span>IMAGENES</span>
                                <input name='imagenes[]' id="imagenes" type="file" multiple>
                              </div>
                              <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder"INGRESE EL ARCHIVO CSV">
                              </div>
                            </div>
                        </div>
                    </div>
          
                    <div class="row">                        
                        <div id="BtnAddArto" class="col s12 m12 l12 center">
                            <a id="agregarExcel" class="waves-effect btn-file waves-light btn" onclick="subirEXCEL()">GUARDAR</a>
                            
                            <div id="loadArchivoExcel" style="display:none" class="preloader-wrapper big active">
                                <div class="spinner-layer spinner-blue-only">
                                    <div class="circle-clipper left"><div class="circle"></div></div>
                                    <div class="gap-patch"><div class="circle"></div></div>
                                    <div class="circle-clipper right"><div class="circle"></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>


<!--Modal Structure lista de articulos INACTIVOS-->
<div id="listaArticulosInactivos" class="modal">
    <div class="btnCerrar right"><i style='color:red;' class="material-icons modal-action modal-close">highlight_off</i></div>
    
    <div class="modal-content">
        <div class="row noMargen TextColor center">
            <div class="col s12 m12 l12">ARTÍCULOS INACTIVOS</div>        
        </div>

        <div class="progress progress2" style="display:none"><div class="indeterminate violet"></div></div>
      
        <div class="row noMargen TextColor center">
            <table id="tblArticulosInactivos" class="table TblDatos">
                <thead>
                    <tr>
                        <th>CÓDIGO</th>
                        <th>ARTÍCULO</th>
                        <th>MINIATURA</th>
                        <th>PUNTOS</th>
                        <th>ACTIVAR</th>
                    </tr>
                </thead>        
                <tbody></tbody>
            </table>
        </div><br>
        <div class="row center">
            <a id="guardarActiculosInactivos" class="redondo waves-effect waves-light btn">GUARDAR</a>
            <div id="loadArticulosInactivos" style="display:none" class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue-only">
                    <div class="circle-clipper left"><div class="circle"></div></div>
                    <div class="gap-patch"><div class="circle"></div></div>
                    <div class="circle-clipper right"><div class="circle"></div></div>
                </div>
            </div>
        </div>
    </div>
</div>