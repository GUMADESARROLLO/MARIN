<body onload="window.print();"><!-- Impresion de la Página al cargar... -->
<main class="mdl-layout__contents">
    <div class="">
        <div class=" row TextColor">
            <div class="col s5 m5 l12">
            </div>
        </div>

        <div class="container">
            <div class="right row">
                <div class="col s12 m12 l12">
                    <span id="detalleFrp">detalle fre</span>
                </div>
            </div>

            <div class="row">
                <div class="col s3 m3 l3">
                    <img src="<?PHP echo base_url();?>assets/img/Logo-Visys-color.png" width="50%" style="opacity: 0.5;">
                </div>
                
                <div class="col s6 m6 l6">
                    <p id="numFrp" class="RobotoB Color"> N° FRE F54009A10</p>
                    <p id="fechafrp" class="RobotoB Color">24/12/2016</p>
                    <p id="Farmafre" class="RobotoB Color">00449 farmacia castellón</p>
                    <p id="ruc" class="RobotoB">ruc 441200018300123h</p>
                </div>
            </div>

            <div class="row">
                <div class="col s4 m4 l3">
                    <p class="canjePts RobotoB">CANJE: 100,000 PTS.</p>
                </div>
                
                <div class="col s4 m4 l3 offset-l6 offset-s4 offset-m4">
                    <p class="canjePts RobotoB">EFECTIVO: C$ 100,000</p>
                </div>
            </div>

            <table  id="tblFREimpre" class=" TblDatos">
                <thead style="background: #1F0A71; color: #fff; font-size: 14px; font-family: 'robotobold';">
                    <tr>
                        <th>FECHA</th>
                        <th>#FACTURA</th>
                        <th>Pts.</th>
                        <th>Pts. a EFECT.</th>
                        <th>ESTADO</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>24/01/2016</td>
                        <td  id="black">067792</td>
                        <td  id="black">300,000 Pts.</td>
                        <td>C$ 300,000</td>
                        <td >PAGADO</td>
                    </tr>
                    
                    <tr>
                        <td>24/01/2016</td>
                        <td  id="black">067792</td>
                        <td  id="black">300,000 Pts.</td>
                        <td>C$ 300,000</td>
                        <td >PAGADO</td>
                    </tr>
                </tbody>
            </table>

            <div class="row">
                <form class="col s12">
                    <div class="row">
                        <div class="input-field col s11 m8 l12">
                            <p id="TxtObser" class="RobotoB Ccolor">OBSERVACIONES</p>
                            <textarea id="obser" class="materialize-textarea">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitationullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                            </textarea>
                        </div>
                    </div>
                </form>
            </div>

            <h6 class="center RegImp  RobotoB">imp0001/FRE</h6>
        </div>
    </div>
</main>