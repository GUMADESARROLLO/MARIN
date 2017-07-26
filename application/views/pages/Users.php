<header class="demo-header mdl-layout__header ">
    <div class="centrado  ColorHeader">
        <span class=" title">usuarios</span>
    </div>
</header>
<!--//////////////////////////////////////////////////////////
                CONTENIDO
///////////////////////////////////////////////////////////-->
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="contenedor">
        <div class="row center TextColor">
            <div class="col s12 m12 l12">
               usuarios en sistema de puntos
            </div>
        </div>

        <div class="container">
            <div class="Buscar row column">               
                <div class="col s1 m1 l1 offset-l3 offset-m2">
                    <i class="material-icons ColorS">search</i>
                </div>
                <div class="input-field col s12 m6 l4">
                    <input  id="searchUsuarios" type="text" placeholder="Buscar" class="validate">
                    <label for="search"></label>
                </div>
            </div>
        </div>
        
        <div class="right row">
            <div class="col s3">
                <a href="#AUsuario" class="BtnBlue waves-effect  btn modal-trigger ">AGREGAR</a>
            </div>
        </div>
        
        <div class="progress" id="progressActUser" style="display:none">
            <div class="indeterminate violet"></div>
        </div>

        <table id="TbCatalogo" class="TblDatos center">
            <thead>
                <tr>
                    <th>FECHA CREACIÓN</th>
                    <th>CÓDIGO</th>
                    <th>USUARIO</th>
                    <th>ESTADO</th>
                    <th>ACCIÓN</th>
                </tr>
            </thead>
            <tbody>
                <?PHP
                    if(!($Luser)){
                    } else {
                        foreach($Luser as $user){
                            $Mmensaje = "CAMBIAR A INACTIVO";
                            $Micono="highlight_off";
                            $MColor="#831F82";
                            $mIcono = "#ff0000";
                            $activo='Activo';

                            if($user['Estado']==0){
                                $activo='Inactivo';
                                $MColor="#ff0000";
                                $Micono="done_all";
                                $Mmensaje = "CAMBIAR A ACTIVO";
                                $mIcono = "#4caf50";
                            }

                            echo "<tr>
                                    <td>".date('d/m/Y',strtotime(substr($user['FechaCreacion'], 0,10)))."</td>
                                    <td>".$user['IdUsuario']."</td>
                                    <td class='bold'>".$user['Nombre']."</td>
                                    <td id='activo' style='color:".$MColor."'>".$activo."</td>
                                    <td><a data-tooltip='$Mmensaje' class='btn-flat tooltipped noHover' onclick='DellUsers(".'"'.$user['IdUsuario'].'",'.'"'.$user['Estado'].'"'.")'><i style='color:".$mIcono."' class=' material-icons'>$Micono</i></td></a>
                                 </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
   </main>
<!--/////////////////////////////////////////////////////////////////////////////////////////
                                        MODALES
//////////////////////////////////////////////////////////////////////////////////////////-->
<!-- AGREGAR USUARIO -->
<div id="AUsuario" class="modal">
    <div class="modal-content">
        <div class="right row">
            <div class="col s1 m1 l1">
                <a href="#!" class=" BtnClose modal-action modal-close noHover">
                    <i class="material-icons">highlight_off</i>
                </a>
            </div>
        </div>
        <div class="row noMargen center">
            <div class="noMargen col s12 m12 l12">
                <h6 class="Mcolor AdUser">AGREGAR USUARIO SPINN </h6>
            </div>
        </div>
        <div class="row">
            <form class="col s12"  method="post" name="formAddUser">
                <div class="row">
                    <div class="input-field col s12 m6 s6">
                        <input class="mayuscula" name="user" placeholder="NOMBRE DE USUARIO" id="NombreUser" type="text" class="required">
                        <label id="labelNombre" class="labelValidacion">DIGITE EL USUARIO</label>
                    </div>
                    
                    <div class="input-field col s12 m6 s6">
                        <input class="mayuscula" name="user2" placeholder="NOMBRE COMPLETO" id="NombreUser2" type="text" class="required">
                        <label id="labelNombre2" class="labelValidacion">DIGITE EL NOMBRE COMPLETO</label>
                    </div>
                </div>
                
                <div class="row">
                    <div class="input-field col s12 m6 s6">
                        <input name="pass" placeholder="CONTRASEÑA" id="Contra" type="password" class="validate">
                        <label id="labelPass" class="labelValidacion">DIGITE LA CONTRASEÑA</label>
                    </div>
                    
                    <div class="input-field col s12 m6 s6">
                        <input name="pass2" placeholder="REPITA CONTRASEÑA" id="Contra2" type="password" class="validate">
                        <label id="labelPass2" class="labelValidacion">REPITA LA CONTRASEÑA</label>
                    </div>
                </div>
                
                <div class="row">
                    <div class="input-field col s12 m6 l12">
                        <select name="rol" id="rol">
                            <option value="" disabled selected>SELECCIONE UN ROL</option>
                            <?PHP
                                if(!($Lrol)){
                                } else {
                                    foreach($Lrol as $rol){
                                        echo '<option value="'.$rol['IdRol'].'">'.$rol['Descripcion'].'</option>';
                                     }
                                 }
                            ?>
                        </select><label id="labelRol" class="labelValidacion">SELECCIONE UN ROL</label>
                    </div>

                    <div class="input-field col s12 m6 s6" style="visibility: hidden">
                        <select name="vendedor" id="vendedorid">
                            <option value="" disabled selected>SELECCIONE VENDEDOR</option>
                            <?PHP
                                if(!($Lven)){
                                } else {
                                     foreach($Lven as $rol){
                                        echo '<option value="'.$rol['CODIGO'].'">'.$rol['NOMBRE'].'</option>';
                                     }
                                 }
                            ?>
                        </select>
                        <label id="labelVendedor" class="labelValidacion">SELECCIONE UN VENDEDOR</label>
                    </div>
                </div>

                <div class="row">
                    <div class="progress" style="display:none">
                          <div class="indeterminate violet"></div>
                    </div>
                    
                    <div class="col offset-l3 s12 l6">
                        <a  class="Btnadd btn" id="Adduser"  onclick="EnviodeDatos()">GUARDAR</a>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- FIN DEL CONTENIDO DEL MODAL -->
</div>
<!-- MODAL cambio de estado de usuario -->
<!-- Modal Structure -->
<div id="CsUser" class="modal">
    <div class="modal-content">
        <div class=" row">
            <div class="col s12 m12 l12">
                <p id="TxtObser" class="center Mcolor"></p>
            </div>
        </div>

        <div class="row">
            <div class="col s1 m1 l1 offset-l4 offset-m3">
                <a href="#" id="DellUsers" class=" modal-action modal-close ">
                    <i class="material-icons">done_all</i>
                </a>
            </div>
            <div class="col s1 m1 l1 offset-l2 offset-s2 offset-m2">
                <a href="#!" class=" BtnClose modal-action modal-close ">
                    <i class="material-icons">highlight_off</i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- MODAL DETALLES USUARIO -->