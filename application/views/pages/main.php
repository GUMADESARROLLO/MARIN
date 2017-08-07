<header class="demo-header mdl-layout__header ">
    <div class="centrado  ColorHeader"><span class=" title">BIENVENIDO AL MASTER DE ARTICULOS</span></div>
</header>

<main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-grid demo-content">       
        <div class="row TextColor center">catálogo de articulos</div>

        <div class="row" style="width:100%">
          <div class="container">
            <div class="Buscar row column">               
              <div class="col s1 m1 l1 offset-l3 offset-m1"><i class="material-icons ColorS">search</i></div>
                <div class="input-field col s12 m6 l4 offset-m1">
                    <input  id="searchCatalogo" type="text" placeholder="Buscar" class="validate mayuscula">
                    <label for="search"></label>
                </div>
            </div>
          </div>

        <div class="row center">
          <div class="col l12 s12 m12 scrollHorizontal">
            <table id="tblCatalogo2" class="TableBlank transparente">
                <thead>
                    <tr><th></th> <th></th> <th></th> <th></th></tr>
                </thead>
                
                <tbody>
                    <?php
                        if (!($catalogo)) {}
                        else{
                            foreach ($catalogo as $key) {
                            echo "<tr>";
                            
                            for($i=1; $i<5; ++$i){
                                if ($key['v_Puntos'.$i]!="0" and $key['v_Nombre'.$i]!="") {

                                    $ruta = base_url()."assets/img/catalogo/".$key['v_IMG'.$i];
                                    $ruta2 = base_url()."assets/img/catalogo/".$key['v_IMG2'.$i];

                                    echo"<td>
                                            <div class='images_ca'>
                                                <p><img class='circle responsive-img' onclick='viewiImg(".'"'.$ruta.'"'.")' src=".$ruta." alt=''></p>
                                                <p><img class='circle responsive-img' onclick='viewiImg(".'"'.$ruta2.'"'.")' src=".$ruta2." alt=''></p>
                                                <div class='descripImg'>
                                                <p class='codP'> ".$key['v_IdIMG'.$i]."</p>
                                                     <p class='descript'>".$key['v_Nombre'.$i]."</p>
                                                <p class='descript'>".str_replace(array("/A%", "/E%","/I%","/O%","/U%","/-%"),array("á", "é", "í","ó","ú","ñ"),  $key['v_Nombre2'.$i])."</p>
                                             ";

                                              echo"</div>
                                            </div>
                                        </td>";
                                    } else {
                                        echo"<td></td>";
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
</div>

</main>

</div>

<div id="modal1" class="modal" style="height: 300px">
    <div class="modal-content">
        <img id="idViewImg" width="100%" height="100%" >

    </div>
</div>