<div class="container-login">
    <div class="row">
        <div class="col s12 m12 l7">
            <div class="row hoja">
                <div class="hoja2 col s12 m0 l12">
                    <img class="hoja" src="<?PHP echo base_url();?>assets/img/login_hoja.png">
                </div>
            </div>

        </div>
        <div class="col center s12 l5">
            <form class="form" method="post" action="<?php echo base_url('index.php/login')?>">
                <div class="row login-logo center">
                        <img class="login-innova" src="<?PHP echo base_url();?>assets/img/login_logo_innva.png">
                </div>
                <div  class=" row">
                    <div class="input-field col s6 m6 l6 offset-l3 offset-m3 offset-s3">
                        <input  placeholder="USUARIO" name="txtUsuario" id="nombre" type="text" class=" validate">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 m6 l6 offset-l3 offset-m3 offset-s3">
                        <input placeholder="CONTRASEÑA" name="txtpassword" id="pass" type="password" class="validate">
                    </div>
                </div>                                
                <div class="row center">
                        <button id="Acceder" class="Btnadd modal-action modal-close btn" type="submit" name="action">ACCEDER</button>
                </div>
            </form><!-- Fin del Formulario de Identificación -->
        </div>
    </div>
</div>