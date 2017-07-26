<header class="demo-header mdl-layout__header ">
    <div class="centrado  ColorHeader"><span class=" title">FACTURAS</span></div>
</header>

<!--//////////////////////////////////////////////////////////
                CONTENIDO
///////////////////////////////////////////////////////////-->
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="contenedor ">
       <div class="container">
           <div id="buscar" class=" row column">
               <div class="col s1 m1 l1 offset-s3  offset-l2"><i class="material-icons ColorS">search</i></div>

               <div id="InputSearch" class="input-field col s6 m16 l5">
                   <input  id="sFactura" type="text" placeholder="Buscar Facturas o Cliente" class="validate">
                   <label for="search"></label>
               </div>
           </div>
       </div>

        <div id="getAllFactura" >
            <table id="tblFacturas">
                <thead>
                    <tr>
                        <th>FECHA.</th>
                        <th>FACTURA</th>
                        <th>CLIENTE</th>
                        <th>NOMBRE</th>
                        <th>P.ACUMULADO</th>
                        <th>P.DISPONIBLE</th>
                        <th>VENDEDOR</th>
                        <th>VER</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($Facturas as $fac){
                            echo "<tr>
                                    <td>".substr($fac['FECHA'],0,10)."</td>
                                    <td>".$fac['FACTURA']." </td>
                                    <td>".$fac['COD_CLIENTE']."</td>
                                    <td class='negra'>".utf8_encode($fac['CLIENTE'])."</td>
                                    <td>".number_format($fac['ACUMULADO'])." Pts.</td>
                                    <td>".number_format($fac['DISPONIBLE'])." Pts.</td>
                                    <td>".utf8_encode($fac['VENDEDOR'])."</td>
                                    <td class='center'><a href='#' class='noHover' onclick='DFactura(".$fac['FACTURA'].")'> <i class='material-icons'>&#xE417;</i></a></td>
                                  </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</main>


<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                            Modales Detalles Facturas
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<div id="modal3" class="modal">
    <div class="modal-content">
        <div class=" row">
            <div class="right col s1 m1 l1">
                <a href="#!" class=" BtnClose modal-action modal-close noHover"><i class="material-icons">highlight_off</i></a>
            </div>
        </div>

        <h6  class="center Mcolor">FACTURA: <span id="codFactura">0.00</span></h6>
        <div class="row">
            <div class="col s12">
                <div id="progressFact" class="progress progress2" style="display:none"><div class="indeterminate violet"></div></div>
                <table id="tblModal1">
                    <thead>
                        <tr>
                            <th>ARTICULO.</th>
                            <th>DESCRIPCIÓN</th>
                            <th>CANTIDAD.</th>
                            <th>PUNTOS</th>
                        </tr>
                    </thead>

                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>