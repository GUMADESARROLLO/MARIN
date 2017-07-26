<header class="demo-header mdl-layout__header ">
    <div class="centrado  ColorHeader">
        <span class=" title">BAJA CLIENTES</span>
    </div>
</header>

<main class="mdl-layout__content mdl-color--grey-100">
    <div class="contenedor">
        <div class=" row TextColor">
            <div class="col s5 m5 l12">
                DAR BAJA A LOS CLIENTES
            </div>
        </div>
        
        <div class="container">
            <div class=" Buscar row column">
                <div class="col s1 m1 l1 offset-l3 offset-s1">
                    <i class="material-icons ColorS">search</i>
                </div>
                
                <div class="input-field col s2 m3 l4 ">
                    <input  id="search" type="text" placeholder="Buscar" class="validate">
                    <label for="search"></label>
                </div>
            </div>
        </div>

        <div class="right row">
            <div class="col s12 m12 l3 ">
                <a href="#modal1" class="BtnEliminar waves-effect  btn modal-trigger">ELIMINAR</a>
            </div>
        </div>

        <table id="ClienteAdd" class="TblDatos">
            <thead>
                <tr>
                    <th>CLIENTE</th>
                    <th>RUC</th>
                    <th>DIRECCIÓN</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td id="NomCliente">xxxxxxxx xxxxxx</td>
                    <td>xxxxxxxx xxxxxx</td>
                    <td>xxxxxxxx xxxxxx</td>
                </tr>

                <tr>
                    <td id="NomCliente">xxxxxxxx xxxxxx</td>
                    <td>xxxxxxxx xxxxxx</td>
                    <td>xxxxxxxx xxxxxx</td>
                </tr>

                <tr>
                    <td id="NomCliente">xxxxxxxx xxxxxx</td>
                    <td>xxxxxxxx xxxxxx</td>
                    <td>xxxxxxxx xxxxxx</td>
                </tr>
            </tbody>
        </table>
    </div><!-- Fin Contenedor -->
</main>
<!--///////////////////////////////////////////////////////////////////////
                        MODALES
/////////////////////////////////////////////////////////////////////////->
<!-- MODAL 1 -->
<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <div class=" row">
            <div class="right col s3 m3 l3">
                <a href="#!" class=" BtnClose modal-action modal-close ">
                    <i class="material-icons">highlight_off</i>
                </a>
            </div>
        </div>

        <h6  class="center Mcolor">DESEA DAR DE BAJA:</h6>
        <div class="row">
            <div class="col s12">
                <table id="tblModal1" class="TheadColor">
                    <thead>
                        <tr>
                            <th>COD. UNIMARK.</th>
                            <th> CLIENTE</th>
                            <th>USUARIO VISYS</th>
                            <th>CONTRASEÑA</th>
                            <th>ELIMINAR</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>xxxxxxxxxxxxxxxxxxxxxxx</td>
                            <td id="black">LUNAN</td>
                            <td id="black">784512</td>
                            <td id="black">UMK!0000</td>
                            <td>
                                <i class=" BtnClose material-icons">highlight_off</i>
                            </td>
                        </tr>

                        <tr>
                            <td>xxxxxxxxxxxxxxxxxxxxxxx</td>
                            <td id="black">LUNAN</td>
                            <td id="black">784512</td>
                            <td id="black">UMK!0000</td>
                            <td>
                                <i class=" BtnClose material-icons">highlight_off</i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s10 m10 l10">
            <a href="#modal2" id="btn" class="Btnadd modal-action modal-close btn modal-trigger">DAR BAJA</a>
        </div>
    </div>

</div>
<!--///////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////-->

<!-- Modal #2-->
<!-- Modal Structure -->
<div id="modal2" class="modal">
    <div class="modal-content">
        <div class=" row">
            <div class="right col s3 m3 l3">
                <a href="#!" class=" BtnClose modal-action modal-close ">
                    <i class="material-icons">highlight_off</i>
                </a>
            </div>
        </div>
        
        <h6 class="center Mcolor">CLIENTES DE BAJA EN EL SISTEMA DE PUNTOS:</h6>
        <div class="container">
           <table id="tblModal2" class="TheadColor">
               <thead>
                    <tr>
                        <th>COD. UNIMARK</th>
                        <th>CLIENTE</th>
                    </tr>
               </thead>

               <tbody>
                    <tr>
                        <td id="black">03258</td>
                        <td>xxxxxx</td>

                    </tr>

                    <tr>
                        <td id="black">03258</td>
                        <td>xxxxxx</td>
                    </tr>
               </tbody>
           </table>
       </div>
    </div>
</div>