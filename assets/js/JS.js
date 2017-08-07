var activo = false;

$(document).ready(function() {
    $('.materialboxed').materialbox();
    
    $(function() {//funcion para agregar el active en el menu, segun la pagina en la que se encuentre el usuario
        var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
        $("ul a li").each(function(){
            if($(this).attr("href") == pgurl || $(this).attr("href") == '' || $(this).attr("href")+"#" == pgurl)
            $(this).addClass("urlActual");
         })
    });

//$('#MFrp').openModal();

$(".carita").mouseenter(function(){
    $(".carita").empty();
    $(".carita").append('<i class="material-icons">sentiment_satisfied</i>');
});
$(".carita").mouseleave(function(){
    $(".carita").empty();
    $(".carita").append('<i class="material-icons">face</i>');
});

//$('#nuevoArticuloArchivo').openModal();

$('.datepicker').pickadate({ 
        selectMonths: true,selectYears: 15,format: 'dd-mm-yyyy',
        monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        weekdaysFull: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        showMonthsShort: undefined,showWeekdaysFull: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],today: 'Hoy',
        clear: 'BORRAR',close: 'CERRAR' });
$('select').material_select();
/*METODOS PARA BUSCAR CON LOS INPUT SUPERIORES EN LAS TABLAS*/
 $('#searchUsuarios').on( 'keyup', function () {
    var table = $('#TbCatalogo').DataTable();
    table.search( this.value ).draw();
} );

$('#searchFacturasClientes').on( 'keyup', function () {
    var table = $('#PtosCliente').DataTable();
    table.search( this.value ).draw();
} );
    $('#searchFRP').on( 'keyup', function () {
        var table = $('#FRP').DataTable();
        table.search( this.value ).draw();
    } );

$('#searchClientes').on( 'keyup', function () {
    var table = $('#ClienteAdd').DataTable();
    table.search( this.value ).draw();
} );

$('#searchTblCatalogoPasado').on( 'keyup', function () {
    var table = $('#tblCatalogoPasado').DataTable();
    table.search( this.value ).draw();
} );

$('#sFactura').on( 'keyup', function () {
    $('#tblFacturas').DataTable().search( this.value ).draw();
} );

$('#sFRP').on( 'keyup', function () {
    $('#FRP').DataTable().search( this.value ).draw();
} );

$('#searchCatalogo').on( 'keyup', function () {
    var table = $('#tblCatalogo2').DataTable();
    table.search( this.value ).draw();
} );
$('#checkTodos').change(function () {//funcion para seleccionar todos los checks
    var oTable = $('#tblCatalogoPasado').dataTable();
    $('input', oTable.fnGetNodes()).prop('checked',this.checked);// change .attr() to .prop()
});

$('#txtimagen').change(function(){
    //var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '');
    var file = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '')
    if ($('#bandera').val()==0){
        var codigo = file.split(".");
        //$('#codigoArto').val(codigo[0]);
    }
});
var idImagenGlobal;
var IdCatalogoGlobal;
var rowCount;
    var ttFRP =0;
$('#tblCatalogoPasado').DataTable( {
            "info":    false,
            "bPaginate": false,
            "paging": false,
            "lengthMenu": [[5,10,50,100,-1], [5,10,50,100,"Todo"]],
            "language": {
                "paginate": {
                    "first":      "Primera",
                    "last":       "Última ",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
                "lengthMenu": "MOSTRAR _MENU_ REGISTROS",
                "search":     "BUSCAR"
            }
        });

$('#tblCatalogo2,#tblCatalogoActual').DataTable( {
            "info":    false,
            "bPaginate": false,
            "lengthMenu": [[10,20,50,100,-1], [10,20,50,100,"Todo"]],
            "language": {
                "paginate": {
                    "first":      "Primera",
                    "last":       "Última ",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
                "lengthMenu": "MOSTRAR _MENU_ REGISTROS",
                "emptyTable": "No hay datos disponibles en la tabla",
                "search":     "BUSCAR"
            }
        });
$('#tblCatalogoActualModal').DataTable({            
            "info":    false,
            "bPaginate": false,
            "paging": false,
            "lengthMenu": [[5,10,50,100,-1], [5,10,50,100,"Todo"]],
            "language": {
                "paginate": {
                    "first":      "Primera",
                    "last":       "Última ",
                    "next":       "Siguiente",
                    "previous":   "Anterior"                    
                },
                "lengthMenu": "MOSTRAR _MENU_",
                "emptyTable": "No hay datos disponibles en la tabla",
                "search":     "BUSCAR"
            }
        });
         $('#tblCatalogoActualModal tbody').on( 'click', 'tr', function () {
                $('#tblCatalogoActualModal tbody').on( 'click', 'tr', function () {
                    $(this).toggleClass('selected');
                } );
            } );         
    $('#btnborrarSeleccionados').click( function () {
        var table = $('#tblCatalogoActualModal').DataTable();
        $("#tblCatalogoActualModal .selected").each(function (index){   
            table.row('.selected').remove().draw(false);
        })
    } );
    /******Agregar clase Activo a items del Menú******/
 $('#tblCatalogo').DataTable();
    $(".nav li a").each(function() {
        if(this.href.trim() == window.location){
            $(this).parent().addClass("active");
            activo = true;
        }
    });
    if(!activo){
        $('.nav li a:first').addClass("active");
    }
    /****** Seccíon del Menú ******/

    /**** DATATABLES ****/
    $('#tblFREimpre,#TbCatalogo,#TblMaVinetas,#MCXP,#tblFacturas,#ClienteAdd,#BajaCliente,#PtosCliente,#tblFacturaFRP,#FRP,#tblpRODUCTOS,#tblModals').DataTable(
        {
            "info":    false,
            //"order": [[ 2, "asc" ]],
            //"searching": false,
            "bLengthChange": true,
            "lengthMenu": [[10,15,32,100,-1], [10,15,32,100,"Todo"]],
            "language": {
                "paginate": {
                    "first":      "Primera",
                    "last":       "Última ",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
                "lengthMenu":"Mostrar _MENU_",

                "emptyTable": "No hay datos disponibles en la tabla",
                "search":     "" 
            }
        }
    );

   /**** END DATATABLES ****/

    $('.modal-trigger').leanModal();// INICIAR LOS MODALES
    Materialize.toast();
    //CARGAR LOS CLIENTES Y/O VENDEDORES EN EL SELECT (AGREGAR USUAARIO AL SISTEMA)
    $("#rol").change(function(){
        $("#vendedor").attr("disabled","disabled"); // inhabilitar el select
        str = $( "#rol option:selected" ).val();

        if(str=="Vendedor"||str=="Cliente"){
            if (str=="Vendedor"){
                str = "LoadVendedores";
            }else {
                str = "LoadCliente";
            }

            $.ajax({
                url: str,
                type: "get",

                async:true,
                success:
                    function(){
                        $("#vendedor").removeAttr("disabled");// habilitar el select
                        $("#vendedor").load(str);
                    }
            });

        }else{
            $("#vendedor option").remove();
        }
    });// FIN CARGAR LOS CLIENTES Y/O VENDEDORES EN EL SELECT (AGREGAR USUAARIO AL SISTEMA

} );//Fin Document ready

/* FUNCIONES */
//ENVIO DE DATOS DEL FORMULARIO
function EnviodeDatos(){
    $('#labelCodigo').hide();$('#labelDescripcion').hide();
    $('#labelPuntos').hide();$('#labelImagen').hide();$('#labelRol').hide();
    var user = $('#NombreUser').val();var nombre = $('#NombreUser2').val();
    var clave = $('#Contra').val();var clave2 = $('#Contra2').val();
    var rol = $('#rol option:selected').val();var idVendedor = $("#vendedorid option:selected").val();
    var vendedores = $("#vendedorid option:selected").text();
    //alert(rol);
    if (user=="") {$('#labelNombre').show(); return false;}
    if (clave=="") {$('#labelPass').show();return false;}
    if (clave2=="") {$('#labelPass2').show();return false;}
    if (rol=="") {$('#labelRol').show();return false;}
    if (clave!=clave2) {$('#labelPass2').show();return false;}
    if (rol == 3 && idVendedor =="") {$('#labelVendedor').show();return false;}
    else{        
        if(vendedores=='SELECCIONE VENDEDOR'){
            vendedores = '0';idVendedor='0';
        }$('#Adduser').hide();$('.progress').show();
        $.ajax({
            url: "NuevoUsuario/"+user+"/"+nombre+"/"+clave+"/"+rol+"/"+vendedores+"/"+idVendedor,
            type: "post",
            async:true,
            success:
                function(json){
                    mensaje("EL USUARIO SE AGREGÓ CORRECTAMENTE","");
                    var myVar = setInterval(myTimer, 2000);
                }
            });
        }
    }

function myTimer() {
    $(location).attr('href',"Usuarios");
}

//CAMBIAR DE ESTADO AL USUARIO EKISDE
function DellUsers(IdUser, Estado){
    $('#CsUser').openModal();

    if(Estado==1){
        $("p").html("DESEA CAMBIAR EL ESTADO ACTIVO AL USUARIO");
    }else{
        $("p").html("DESEA CAMBIAR EL ESTADO INACTIVO AL USUARIO");
    }

    $("#DellUsers").click(function(){
        $('#progressActUser').show();
        $('#TbCatalogo').hide();
        $.ajax({
            url: "ActUser/"+IdUser+"/"+Estado,
            type: "post",
            async:true,
            success: function(json){
                 $(location).attr('href',"Usuarios");
            }
        });
    });
}

function AddClients(){
    //$('#CsUser').openModal();
    $('#ClienteAdd tr').each( function () {
        if($(this).is('.selected')) {
            var cliente = $(this).find("td").eq(0).html();

            console.log(cliente);
            var patron="%20";

            var cadena=cliente.replace(patron,'');
            console.log(cadena);
            $.ajax({
                url: "FindClient/"+cadena,
                type: "post",
                async:true,
                success: function(json){
                   $(location).attr('Clientes');
                }
            });
        }
    });
}
    function exportar(formulario)
    {
        document.getElementById(formulario).submit();
    }

/*funcion para ingresar un nuevo articulo al catalogo*/
function subirimagen()
{    
    var file2 = $('#txtimagen').val().replace(/C:\\fakepath\\/i, '');
    //alert(file);
    var codigo = file2.split(".");
    //$('#txtimagen').hide(); 
    // $('#cargar22').hide();
    $('#labelCodigo').hide();   $('#labelDescripcion').hide();
    $('#labelPuntos').hide();   $('#labelImagen').hide();
    $('#lblUnd').hide();
    if ($('#bandera')==0){
    if ($('#txtimagen').val()=="") {$('#labelImagen').show(); return false;}
    if(codigo[0]!=$('#codigoArto').val()){$('#labelImagen3').show();return false;}
    }
    
    if ($('#codigoArto').val()=="") {$('#labelCodigo').show();return false;}
    if ($('#NombArto').val()=="") {$('#labelDescripcion').show();return false;}
    if ($('#PtArto').val()=="") {$('#labelPuntos').show();return false;}
    if ($('#UndArto').val()=="") {$('#lblUnd').show();return false;}
    else{   
    $('#agregar').hide();$('#loadIMG').show();
            var formData = new FormData($('#formimagen')[0]);
            //alert(formData[0]);
           /* $.ajax({
                url: "verificarImg/"+$('#bandera').val(),
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    if (datos!=0) {
                    $("#mensajeIMG").html(datos);
                    $('#modalIMG').openModal(); 
                    $('#agregar').show();
                    $('#loadIMG').hide();
                    }else{

                    }
                }
            });*/
        $('#formimagen').submit();
        }
}

/*funcion para mandar a traer el catalogo de productos pasado EKISDE*/
    $('#cmbCatalogos').change(function(){
        $('#checkTodos').attr('checked', false);
        limpiarTabla(tblCatalogoPasado);
            $('#tblCatalogoPasado').DataTable({
                "order": [[ 1, "desc" ]],
                ajax: "AjaxCatalogoPasado/"+ this.value,
                "info":    false,
                "bPaginate": false,
                "paging": false,
                "pagingType": "full_numbers",
                "lengthMenu": [[10, -1], [10, "Todo"]],
                "language": {
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "lengthMenu": '_MENU_ ',
                    "search": '<i class=" material-icons">search</i>',
                    "loadingRecords": "",
                    "paginate": {
                        "first": "Primera",
                        "last": "Última ",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    }
                },
               columns: [
                    { "data": "CodigoImg" },
                    { "data": "Nombre" },
                    { "data": "Imagen" },
                    { "data": "Puntos" },
                    { "data": "check" }
              ]
            });
        $('#listaArticulos').openModal();
    });

    $("#aceptarIMG2").click(function(){
        $('#formimagen2').submit();
    });

    $("#aceptarIMG").click(function(){
        $('#formimagen').submit();
    });

    /*RECORRER LAS FILAS CHEKEADAS Y AGREGARLAS A LA TABLA DE CATALOGO ACTUAL EKISDE*/
    $('#addCatalogoAntiguo').click(function(){
         $("#tblCatalogoPasado input:checkbox:checked").each(function(index) {
            var valores = "";
            var table = $('#tblCatalogoActualModal').DataTable();
            var campo1 = "";
            var campo2 = "";
            var campo3 = "";
            var campo4 = ""; var campo5 = ""; var bandera = 0; 
            $(this).parents("tr").find("td").each(function(){
                switch($(this).parent().children().index($(this))) {//obtengo el index de la columna EKISDE
                    case 0:
                        campo1 = $(this).html();
                        break;
                    case 1:
                        campo2 = $(this).html();
                        break;
                    case 2:
                        campo3 = $(this).html();
                        break;
                    case 3:
                        campo4 = $(this).html()+'<input id="'+campo1+'" type="hidden" value="'+$('#cmbCatalogos').val()+'"/>';
                        break;
                    case 5:
                        campo5 = $(this).html();
                        break;
                    default:x="";
                }
            });/*valido si el articulo ya esta agregado*/
            table.cells().eq(0).each( function ( index ) {
                var cell = table.cell(index);             
                var data = cell.data();
                if (campo1 == data) {bandera=1;};
            } );
            if (bandera == 0) {
            table.row.add([
                        campo1,
                        campo2,
                        campo3,
                        campo4
                    ]).draw(false);
            mensaje("ARTÍCULO AGREGADO","");
            }
            else{
                var $toastContent = $('<span class="center">EL ARTICULO: <h6 class="negra noMargen">"'+campo2+'"</h6> YA ESTA AGREGADO</span>');
                Materialize.toast($toastContent, 3500,'rounded error');
            }
        });
    });

    function ActualizarPuntos(codImagen,IdCatalogo) {
        $('#tblCatalogoActual').hide();
        $('.progress2').show();
        $.ajax({
            url: "actualizarPuntos/"+codImagen+"/"+IdCatalogo+"/"+$('#'+codImagen).val(),
            type: "get",
            async:true,
            success: function(json){
                $(location).attr('href','NuevoCatalogo');
            }
        });
        //$('#tblCatalogoActual').show();
    }
    $("#darBajaOK").on('click',function(){

    $('#EditEstado').show();$('#darBajaOK').hide();
    var form_data = {
                idarticulo: idImagenGlobal,
                catalogo: IdCatalogoGlobal
                };
        $.ajax({
                url: "ActualizarEstadoArticulo",
                type: "post",
                async:true,
                data: form_data,
                success:
                    function(json){
                        var myVar = setInterval(myTimer3, 2000);
                    }
                });
    });

    function myTimer3() {
        mensaje("SE GUARDARON LOS CAMBIOS EN EL CATALOGO, ESPERE..","");
        $(location).attr('href',"Catalogo");
    }

     /*metodo para guardar el catalogo, con los nuevos articulos agregados*/
    $("#guardarCatalogo").on('click',function(){
            var contador = 0; var table2 = $('#tblCatalogoActualModal').DataTable();
            var rowCount = table2.page.info().recordsTotal;
            var codigo = ""; var articulo = ""; 
            var puntos = ""; var IdCatalogoArticulo = ""; var bandera = 0; 
            var IdCatalogo = $('#IdCatalogoActual').val(); $('#guardarCatalogo').hide();
            var table = $('#tblCatalogo2').DataTable();            
            $('.progress2').show();$('#tblCatalogoActualModal').hide();
            $("#tblCatalogoActualModal tbody tr").each(function(index) {
                $(this).children("td").each(function(index2){/*metodo para recorrer la tabla*/
                    switch($(this).parent().children().index($(this))) {//obtengo el index de la columna EKISDE
                        case 0:
                            codigo = $(this).html();
                            break;
                        case 1:
                            articulo = $(this).html();
                            break;
                        case 2:
                            break;
                        case 3:
                            puntos = $(this).html().split("<");
                            puntos = puntos[0];
                            IdCatalogoArticulo = $('#'+codigo+'').val();
                            break;
                        default: 
                    }
                });
                
            table.cells().eq(0).each( function ( index ) {/*VALIDO SI EL ARTICULO YA ESTA AGREGADO EN LA TABLA*/
                var cell = table.cell(index);             
                var data = cell.data();
                if (codigo == data) {bandera=1;};
            } );
            if (bandera!=1) {
            var form_data = {
                codigo: codigo,
                puntos: puntos,
                articulo: articulo,
                IdCatalogo: IdCatalogo,
                IdCatalogoArticulo: IdCatalogoArticulo
                };
             $.ajax({
                url: "actualizarCatalogo",
                type: "post",
                async:true,
                data: form_data,
                success:
                    function(json){
                        contador++;//alert(bandera);
                        //alert(rowCount+" contador "+ contador);
                        if (contador==rowCount) {var myVar = setInterval(myTimer2, 3500);};
                    }
                });}
             else{
                var $toastContent = $('<span class="center">EL ARTICULO: <h6 class="negra noMargen">"'+articulo+'"</h6> YA EXISTE Y NO SE AGREGO</span>');
                Materialize.toast($toastContent, 3500,'rounded error');
                }
            });
    });

    function myTimer2() {
        mensaje("SE GUARDARON LOS CAMBIOS EN EL CATALOGO, ESPERE...","");
        $(location).attr('href',"Catalogo");
    }

    function darBaja(r){
         var table = $('#tblCatalogoActualModal').DataTable();
         
            $('#tblCatalogoActualModal tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            } );         
            $('#button').click( function () {
                table.row('.selected').remove().draw( false );
            } );
    }

    function darBaja(idImagen,IdCatalogo){
         $('#darBaja').openModal();
         idImagenGlobal = idImagen;
         IdCatalogoGlobal = IdCatalogo;
      } 

    $("#CrearCatalogo").on('click',function(){
        $('#labelDescripcion').hide();  $('#labelFecha2').hide();
        $('#labelDescripcion2').hide();
        if ($('#descripcionCat').val()=="") {$('#labelDescripcion2').show(); return false;}   
        if ($('#fechaCat2').val()=="") {$('#labelFecha2').show();return false;}
        else{
            $('#CrearCatalogo').hide(); $('#loadCrearCatalogo').show();
            $('#formNuevoCatalogo').submit();
            }
    });

    function traerDireccionTelefono (IdCLiente){
        $.ajax({//AJAX PARA TRAER LA DIRECCION Y EL TELEFONO DEL CLIENTE
                url: "ajaxDireccionTelefono/"+IdCLiente,
                type: "GET",
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(datos)
                {                    
                    $.each(datos, function(i, item) {
                        if($('#R1').is(':checked') ){
                        $("#rpDireccion").html(item.DIRECCION);
                        $("#rpTelefono").html(item.TELEFONO);
                        }
                        else if($('#R2').is(':checked') ){
                        $("#rpDireccion2").html(item.DIRECCION);
                        $("#rpTelefono2").html(item.TELEFONO);
                        }
                    });
                }
            });
    }

    function exportarEstadoFactura(tipo) {
        $('#tipoReporte').val(tipo);
        $('#txtCodigo').val($("#idCliente").val());
        $('#txtFecha1').val(($("#fecha1").val()=="")? "0":$("#fecha1").val());
        $('#txtFecha2').val(($("#fecha2").val()=="")? "0":$("#fecha2").val());
        $('#FrmEstadoFactura').submit();
    }

    function ExportardisponibilidadPuntos() {
        // body...
    }

    function limpiar () {
        $('#rpCodCliente').empty();     $('#rpNomCliente').empty();
        $('#rpCodCliente2').empty();    $('#rpNomCliente2').empty();
        $("#Modal1Fecha22").empty();    $("#Modal1Fecha12").empty();
        $("#Modal1Fecha1").empty();     $("#Modal1Fecha2").empty();
    }

    $("#BtnFiltroReporte").click(function() {//funcion para generar reporte
        limpiar();
        var Cls = $("#idCliente").val();    var f1  = $("#fecha1").val();
        var f2  = $("#fecha2").val();   $('#rpCodCliente').text(Cls);
        $('#rpNomCliente').text($("#idCliente option:selected").html());
        $("#divFecha,#divFecha2").show(); $("#loadEstadoFactura").show();
        $("#tituloReport1,#tituloReport2,#divCliente,#divCliente2").show();
        $("#Modal1Fecha1").html(f1);    $("#Modal1Fecha2").html(f2);
        if (Cls!=0) {traerDireccionTelefono(Cls);}        
        if (f1=="" || f2==""){
            f1=0;f2=0;
            $("#divFecha,#divFecha2").hide();
        };

        if(Cls == 0){
            $("#tituloReport1,#tituloReport2,#divCliente,#divCliente2").hide();
        }

        if($('#R1').is(':checked') ){$("#reporte").val(0);
            limpiarTabla(tblEstadoFactura);
            $('#tblEstadoFactura').DataTable({
                "order": [[ 2, "desc" ]],
                ajax: "ajaxEstadoFacturas/"+Cls+"/"+f1+"/"+f2,
                "info":    false,
                "bPaginate": false,
                "paging": true,
                "pagingType": "full_numbers",
                "lengthMenu": [[10, -1], [10, "Todo"]],
                "language": {
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "lengthMenu": '_MENU_ ',
                    "search": '<i class=" material-icons">search</i>',
                    "loadingRecords": "",
                    "paginate": {
                        "first": "Primera",
                        "last": "Última ",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    }
                },
               columns: [
                    { "data": "NUMERO" },
                    { "data": "FECHA" },
                    { "data": "FACTURA" },
                    { "data": "COD_CLIENTE" },
                    { "data": "CLIENTE" },
                    { "data": "ESTADO" }
              ]
            });
            $('#EstadoFactura').openModal();
            $('#tblEstadoFactura').on( 'init.dt', function () {
                $("#loadEstadoFactura").hide();
            }).dataTable();
            
        }

        if($('#R2').is(':checked') ){$("#reporte").val(1);
            var totalAcumulado=0; var totalDisponible=0;
            $("#Modal1Fecha12").html(f1);    $("#Modal1Fecha22").html(f2);
            $('#rpCodCliente2').text(Cls);   $("#reporte").val(1);
            $('#rpNomCliente2').text($("#idCliente option:selected").html());
            $('#loadDisponiblePuntos').show();
            limpiarTabla(tblDisponibilidadPuntos);
            $('#tblDisponibilidadPuntos').DataTable({
                "order": [[ 1, "desc" ]],
                ajax: "ajaxDisponibilidadPuntos/"+Cls+"/"+f1+"/"+f2,
                "info":    false,
                "bPaginate": false,
                "paging": true,
                "pagingType": "full_numbers",
                "lengthMenu": [[10, -1], [10, "Todo"]],
                "language": {
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "lengthMenu": '_MENU_ ',
                    "search": '<i class=" material-icons">search</i>',
                    "loadingRecords": "",
                    "paginate": {
                        "first": "Primera",
                        "last": "Última ",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    }
                },
               columns: [
                    { "data": "NUMERO" },
                    { "data": "FECHA" },
                    { "data": "FACTURA" },
                    { "data": "COD_CLIENTE" },
                    { "data": "CLIENTE" },
                    { "data": "P_ACUMULADOS" },
                    { "data": "P_DISPONIBLES" },
                    { "data": "ESTADO" }
              ]
            });
            $('#tblDisponibilidadPuntos').on( 'init.dt', function () {
                $("#loadDisponiblePuntos").hide();
                obj = $('#tblDisponibilidadPuntos').DataTable();
                obj.rows().data().each( function (index,value) {
                    totalAcumulado += parseInt(obj.row(value).data().P_ACUMULADOS);
                    totalDisponible += parseInt(obj.row(value).data().P_DISPONIBLES);
                    //alert (obj.row(value).data().P_DISPONIBLES);
                });
                $("#ttAcumulado").text(formatNumber(totalAcumulado));
                $("#ttDisponible").text(formatNumber(totalDisponible));
            }).dataTable();
            $('#DisponiblePuntos').openModal();            
        }        
    });


    

    /*$("#idPreloader,#getOneFactura,#getAllFactura").hide();
    $("#search").keypress(function(e) {
        if(e.which == 13) {
            var filtro = $("#search").val();
            $("#getOneFactura,#getAllFactura").hide();
            if ((!jQuery.isEmptyObject(filtro)) && (filtro.length > 5)) {
                $("#idImgBack").hide();
                $("#idPreloader").show();
                if (filtro.toUpperCase().indexOf('CL') != -1) {
                    $("#getAllFactura").show();
                } else {
                    $("#getOneFactura").show();
                }
                $("#idPreloader").hide();
            } else{
                $("#idImgBack").show();
                alert("Contenido esta vacio o menor a 5 caracteres");
            }

        }
    });*/
    $( "#ListCliente").change(function() {
        var Cls = $(this).val();
        if(Cls !=0){
            $.ajax({
                url: "getAplicadoP" + "/" + Cls,
                type: "post",
                async:true,
                success:
                    function(clsAplicados){
                        $("#PtsClientefrp").val(parseInt(clsAplicados));
                    }
            });

            $("#ClienteFRP,#ClienteFRPPremio").val(Cls);
            limpiarTabla(tblFacturaFRP);
            $('#tblFacturaFRP').DataTable({
                ajax: "getFacturaFRP/"+ Cls,
                "info":    false,
                "bPaginate": false,
                "paging": false,
                "pagingType": "full_numbers",
                columns: [
                    { "data": "FECHA" },
                    { "data": "FACTURA" },
                    { "data": "DISPONIBLE" },
                    { "data": "CAM1" },
                    { "data": "CAM2" },
                    { "data": "CAM3" },
                    { "data": "CAM4" },
                ]
            });

        }else{
            alert("No Selecciono ningun cliente");
        }
    });

    function apliAutomatic(pts){
        var obj = $('#tblFacturaFRP').DataTable();
        var disp = 0;
        var sFactura = 0;
        obj.rows().data().each( function (index,value) {
            var FACTURA   = obj.row(value).data().FACTURA;
            $("#AP1" + FACTURA).html("");
            $("#DIS" + FACTURA).html("");
            $("#EST" + FACTURA).html("");
            $("#CHK"+FACTURA).prop('checked', false);
        });

        if (pts > 0 ){
            obj.rows().data().each( function (index,value) {
                var FACTURA   =  obj.row(value).data().FACTURA;

                disp = parseInt(obj.row(value).data().DISPONIBLE)
                if (isNaN(parseInt($("#AP1" + FACTURA).text()))){ apl = 0 } else { apl = parseInt($("#AP1" + FACTURA).text()) }
                if (pts > 0){
                    if (disp >= pts){
                        sFactura = disp - pts;
                        $("#AP1" + FACTURA).html(pts);
                        pts = 0;
                        $("#DIS" + FACTURA).html(sFactura);
                    } else {
                        pts = pts - disp ;
                        $("#AP1" + FACTURA).html(disp);
                        $("#DIS" + FACTURA).html("0");
                    }
                }
                var ESTADO = $("#DIS" + FACTURA).text();
                if (ESTADO != ""){
                    if (parseInt(ESTADO) == 0){
                        $("#EST" + FACTURA).html("APLICADO");
                    } else {
                        $("#EST" + FACTURA).html("PARCIAL");
                    }
                    $("#CHK"+FACTURA).prop('checked', true);
                }
            });
        }
    }

    function isVerificar(posicion,fact){
        ttFRP = parseInt($("#idttPtsCLsFRP").text());
        ptsFRP = parseInt($("#idttPtsFRP").text());
        var FACTURA   = $('#tblFacturaFRP').DataTable().row(posicion).data().DISPONIBLE;
        
        if($("#CHK"+fact).is(':checked') ) {
            if (ttFRP == 0){
                $("#CHK"+fact).prop('checked', false);
                mensaje("TODOS LOS PUNTOS FUERON APLICADOS","error");
            } else {
                if( ptsFRP == 0){
                    ttFRP = 0;
                    $("#CHK"+fact).prop('checked', false);
                    mensaje("Error: SELECCIONE UN ARTICULO","error");
                } else {
                    if (FACTURA > ttFRP){
                        $("#AP1" + fact).html(ttFRP);
                        $("#EST" + fact).html("PARCIAL");
                        sfactura = FACTURA - ttFRP;
                        $("#DIS" + fact).html(sfactura);
                        ttFRP=0;
                    } else {
                        $("#AP1" + fact).html(FACTURA);
                        ttFRP = ttFRP - FACTURA;
                        $("#DIS" + fact).html("0");
                        $("#EST" + fact).html("APLICADO");
                    }
                }
            }
        } else {
            ttFRP = ttFRP + parseInt($("#AP1" + fact).text());
            $("#AP1" + fact).html("");
            $("#DIS" + fact).html("");
            $("#EST" + fact).html("");
        }
        $("#idttPtsCLsFRP").html(ttFRP)
    }

    $("#AddPremioTbl").on('click',function(){
        var Permitir = 0
        Objtable = $('#tblpRODUCTOS').DataTable();
        obj = $('#tblFacturaFRP').DataTable();
        obj.rows().data().each( function (index,value) {
            if($("#CHK" + obj.row(value).data().FACTURA).is(':checked') ) {
                Permitir = 1;
            }
        });

        var cod= $( "#ListCatalogo option:selected" ).val();
        var ttClPts = parseInt($("#PtsClientefrp").val());
        if (cod != 0){
            var name = $( "#ListCatalogo option:selected" ).html();
            var pts    = $("#ValorPtsPremioFRP").val();
            var cant   = $("#CantPremioFRP").val();
            var totalPts = parseInt(cant) * parseInt(pts);
            var ttPts = parseInt($("#idttPtsFRP").text());
            ttPts = ttPts + totalPts;

            if (ttPts <= ttClPts){
                $("#idttPtsFRP").text(ttPts);
                Objtable.row.add( [
                    cant,
                    cod,
                    name,
                    pts,
                    totalPts,
                    '<a href="#!" id="RowDelete" class="BtnClose"><i class="material-icons">highlight_off</i></a>'
                ] ).draw( false );
                //$('#ListCatalogo').val("...").trigger('change');
                $("#CodPremioFRP,#ValorPtsPremioFRP,#CantPremioFRP").val("");
                apliAutomatic(ttPts);

            }else{
                mensaje("NO CUENTA CON LOS PUNTOS NECESARIOS","error");
            }
        }else{
            mensaje("SELECCIONE UN ARTICULO DEL CATALOGO","error");
        }
        $('#float-select-producto > option[value="0"]').attr('selected', 'selected');
    });

    $("#tblpRODUCTOS").delegate("a", "click", function(){
            $('#tblpRODUCTOS').DataTable().row('.selected').remove().draw( false );

            ttPts = 0;
            $('#tblpRODUCTOS').DataTable().column(4).data().each( function ( value, index ) {
                ttPts += parseInt(value);
            } );
            $("#idttPtsFRP").text(ttPts);

            apliAutomatic(ttPts);
    });

    $('#tblpRODUCTOS tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );

    $("#btnProcesar").click(function(){
        numFRP = $("#frp").val();
        var fchFRP = $("#date1").val();
        var pCambiar = $("#idttPtsCLsFRP").text();
        tblFactura = $("#tblFacturaFRP").DataTable();
        tblPremios = $("#tblpRODUCTOS").DataTable();
        mss = 'INGRESE NUMERO DE FRP.';

        $.ajax({
            url: "BuscaFRP/" + numFRP,
            type: "post",
            async:false,
            success:
                function(clsAplicados){
                    if (parseInt(clsAplicados) > 0) {
                        mss = 'NUMERO YA EXISTE!!!, INGRESE OTRO NUMERO DE FRP.';
                        numFRP = "";
                    }
                }
        });

        if ( (numFRP =="") || (numFRP.length < 4)){
            $("#frp").focus();
            mensaje(mss, "error");
        } else {
            if ( (fchFRP =="") && (fchFRP.length < 4) ){
                $("#frp").focus();
                mensaje("SELECCIONE LA FECHA.", "error");
            } else {
                if ( !tblFactura.data().any() ){
                    mensaje("TABLA DE FACTURAS VACIA.", "error");
                } else {
                    if ( !tblPremios.data().any() ){
                        mensaje("TABLA DE PREMIO VACIA.", "error");
                    } else {
                        if  ( pCambiar != 0){
                            mensaje("SELECCIONE LA FACTURAS A APLICAR.", "error");
                        } else {
                            $('#Dfrp').openModal();
                            $("#frpProgress").show();
                            $("#divTop,#divTbl").hide();
                            SaveFRP(numFRP,fchFRP);
                        }
                    }
                }
            }
        }
    });

    function SaveFRP(idFrp,Fecha){
        var linea = 0;
        var remanente =0;
        var detallesFactura  = new Array();
        var logFactura       = new Array();
        var detallesArticulo = new Array();

        var i=0;

        var IdCliente = $( "#ListCliente option:selected" ).val();
        var Nombre    = $( "#ListCliente option:selected" ).html();

        obj = $('#tblpRODUCTOS').DataTable();
        ofact = $('#tblFacturaFRP').DataTable();
        total  = parseInt($("#idttPtsFRP").text());
        FPunto = 0;
        Posi=0;
        var ultima = -1;
        var global = 0;
        var contador = ofact.rows().count();
        
        obj.rows().data().each( function (ip) {
            remanente = parseInt(ip[4]);
            if (ultima!=-1) {
                        linea = ultima;
                        ultima = -1;
                    };
            ofact.rows().data().each( function (index,value) {
                    
                    if (linea<contador) {
                        if($('#CHK'+ofact.row(linea).data().FACTURA).is(':checked')) { 
                        
                        var FAC = ofact.row(linea).data().FACTURA;
                        var FCH = ofact.row(linea).data().FECHA;
                        var FLPunto = ofact.row(linea).data().DISPONIBLE;
                        valor = 0;
                        apl = parseInt($("#AP1" + FAC).text());
                        dis = parseInt($("#DIS" + FAC).text());
                        est = ($("#EST" + FAC).text());

                        if (FPunto>0) {apl=FPunto;}
                        if (FPunto == 0){FPunto = ofact.row(linea).data().DISPONIBLE;}
                        
                        if (remanente > apl){
                            valor = apl;
                            FPunto = FPunto - apl;
                        }else{
                            valor = remanente;
                            FPunto = FPunto - remanente;
                            if (remanente != 0){apl = Math.abs(FPunto);}
                        }
                        if (FPunto==dis) {
                            FPunto=0;
                        }
                        if (remanente == 0) {
                            return false;
                        } else {
                            console.log(FAC + "," + "Puntos:" + FLPunto +", Aplica: " + valor + ", Pendiente: " + apl);
                            detallesFactura[Posi] = idFrp+","+FAC+","+FLPunto+","+ip[1]+","+ip[2]+","+valor+","+ip[0]+","+FCH;
                            Posi++;
                        }

                        if (remanente > valor) {
                            remanente = remanente - apl;
                        } else {
                            if (FPunto < 0) {
                                remanente = Math.abs(FPunto);
                                FPunto = 0;
                            } else {
                                remanente = 0;                                
                            }
                        }
                        linea++;
                    }
                    else{
                        linea++;
                    }
                    if (remanente==0 && (FLPunto-valor)>0) {
                        ultima = linea-1;
                    }
                }
            });
            if (remanente!=0) {
                linea--;    
            }
            
        });
    
        totalFinalFRP =0;

        obj = $('#tblpRODUCTOS').DataTable();
        var viewProductos     = new Array();
        obj.rows().data().each( function (index) {
            viewProductos[i]=new Array(5);
            detallesArticulo[i] = idFrp + "," + index[1] + "," + index[2] + "," + index[3] + "," + index[0];
            viewProductos[i][0] = index[0];
            viewProductos[i][1] = index[1];
            viewProductos[i][2] = index[2];
            viewProductos[i][3] = index[3];
            viewProductos[i][4] = index[4];
            totalFinalFRP += parseInt(index[4]);

            i++;
        });

        i=0;
        obj = $('#tblFacturaFRP').DataTable();
        var viewFacturas     = new Array();

        obj.rows().data().each( function (index,value) {
            var FAC = obj.row(value).data().FACTURA;
            var FCH = obj.row(value).data().FECHA;
            var FLPunto = obj.row(value).data().DISPONIBLE;
            var apl = $("#AP1" + FAC).text();
            dis = parseInt($("#DIS" + FAC).text());
            est = ($("#EST" + FAC).text());
            
            if($("#CHK"+FAC).is(':checked') ) {
                logFactura[i]      = IdCliente + "," + FAC + "," + apl+ "," + FLPunto;
                viewFacturas[i]=new Array(6);
                viewFacturas[i][0] = FCH;
                viewFacturas[i][1] = FAC;
                viewFacturas[i][2] = FLPunto;
                viewFacturas[i][3] = apl;
                viewFacturas[i][4] = dis;
                viewFacturas[i][5] = est;
                i++;
            }
        });

        $('#Dfrp').openModal();

        var form_data = {
            top: [idFrp, Fecha, IdCliente,Nombre],
            art: detallesArticulo,
            fac: detallesFactura,
            log: logFactura
        };

        $.ajax({
            url: "saveFRP",
            type: "post",
            async:true,
            data: form_data,
            success:
                function(data){
                    if (data==1){
                        $("#spnFRP").text(idFrp);
                        $("#spnFecha").text(Fecha);
                        $("#spnCodCls").text(IdCliente);
                        $("#spnNombreCliente").text(Nombre);

                        $('#tblModal1').DataTable( {
                            data: viewFacturas,
                            "info":    false,
                            //"order": [[ 2, "asc" ]],
                            //"searching": false,
                            "bLengthChange": true,
                            "bPaginate": false,
                            "lengthMenu": [[10,15,32,100,-1], [10,15,32,100,"Todo"]],
                            "language": {
                                "paginate": {
                                    "first":      "Primera",
                                    "last":       "Última ",
                                    "next":       "Siguiente",
                                    "previous":   "Anterior"
                                },
                                "lengthMenu":"Mostrar _MENU_",
                                "emptyTable": "No hay datos disponibles en la tabla",
                                "search":     ""},
                                columns: [
                                { title: "FECHA" },
                                { title: "BOUCHER" },
                                { title: "Pts." },
                                { title: "Pts. APLI." },
                                { title: "Pts. DISP." },
                                { title: "ESTADO" }
                            ]
                        } );

                        $('#tblModal2').DataTable( {
                            data: viewProductos,
                            "info":    false,
                            //"order": [[ 2, "asc" ]],
                            //"searching": false,
                            "bLengthChange": true,
                            "bPaginate": false,
                            "lengthMenu": [[10,15,32,100,-1], [10,15,32,100,"Todo"]],
                            "language": {
                                "paginate": {
                                    "first":      "Primera",
                                    "last":       "Última ",
                                    "next":       "Siguiente",
                                    "previous":   "Anterior"
                                },
                                "lengthMenu":"Mostrar _MENU_",

                                "emptyTable": "No hay datos disponibles en la tabla",
                                "search":     ""
                            },
                            columns: [
                                { title: "CANT." },
                                { title: "COD. PREMIO" },
                                { title: "DESCRIPCIÓN" },
                                { title: "Pts." },
                                { title: "TOTAL Pts." }
                            ]
                        } );

                        $("#spnTotalFRP").text(totalFinalFRP);



                        $("#frpProgress").hide();
                        $("#divTop,#divTbl").show();
                    } else {
                        mensaje("ERROR AL CREAR EL FRP","error");
                    }
                }
        });
    }
    

    function callUrlPrint(targetURL,id){
        var a = document.createElement('a');
        a.href = targetURL + "/" + $("#" + id ).text();
        a.target = '_blank';
        window.open(a);
    }

    function dellFrp(id){
        $("#Dell").openModal();
        $("#spnDellFRP").text(id);
    }

    $("#idProcederDell").click(function(){
        $("#Dell").closeModal();
        $("#DellRes").openModal();
        id = $("#spnDellFRP").text();
        var form_data = {
            frp: id
        };

        $.ajax({
            url: "delFRP",
            type: "post",
            async:true,
            data: form_data,
            success:
                function(data){
                    console.log(data)
                    if (data != 1){
                        mensaje("SELECCIONE UN CLIENTE PRIMERO","error");
                    } else {
                        window.setTimeout($(location).attr('href',"Frp"), 2000);
                        $("#dellCorrectoFRP").text(id);
                    }
                }
        });
    });

    function getview(id){
        $('#idviewFRP').openModal();
        $("#vfrpProgress").show();
        $("#vfrpTop,#vfrpTop").hide();
        $('#iconoPrint').hide();
        var form_data = {
            frp: id
        };

        $.ajax({
            url: "getviewFRP",
            type: "post",
            async:true,
            data: form_data,
            success:
            function(data){
                    $("#vfrpProgress").hide();
                    $("#vfrpTop,#vfrpTop").show();

                    var dataJson = JSON.parse(data);
                    console.log(dataJson);

                    var DF="",DP="";
                    if (dataJson.DFactura[0].Anulado == "N"){
                        $('#iconoPrint').show();
                    }
                    $("#spnviewFRP").text(dataJson.top[0].IdFRP);
                    $("#spnviewFecha").text(dataJson.top[0].Fecha);
                    $("#spnviewCodCls").text(dataJson.top[0].IdCliente);
                    $("#spnviewNombreCliente").text(dataJson.top[0].Nombre);

                    for (f=0;f<dataJson.DFactura.length;f++){

                        if( dataJson.DFactura[f].SALDO > 0) {ESTAD ="PARCIAL"}else {ESTAD ="APLICADO"}
                        DF +=   "<tr>" +
                                    "<td>" +dataJson.DFactura[f].Fecha + "</td>" +
                                    "<td>" +dataJson.DFactura[f].Factura+ "</td>" +
                                    "<td>" +formatNumber(dataJson.DFactura[f].Faplicado)+ "</td>" +
                                    "<td>" +formatNumber(dataJson.DFactura[f].Puntos)+ "</td>" +
                                    "<td>" +formatNumber(dataJson.DFactura[f].SALDO)+ "</td>" +
                                    "<td>" +ESTAD+ "</td>" +
                                    "</tr>"
                    }

                    var ttff=0;

                    for (p=0;p<dataJson.DArticulo.length;p++){
                        DP +=   "<tr>" +
                                    "<td>" +dataJson.DArticulo[p].Cantidad + "</td>" +
                                    "<td>" +dataJson.DArticulo[p].IdArticulo+ "</td>" +
                                    "<td class='negra'>" +dataJson.DArticulo[p].Descripcion+ "</td>" +
                                    "<td>" +formatNumber(parseInt(dataJson.DArticulo[p].Puntos))+ "</td>" +
                                    "<td>" +formatNumber(parseInt(dataJson.DArticulo[p].Cantidad*dataJson.DArticulo[p].Puntos))+ "</td>" +
                                "</tr>"

                        ttff += parseInt(dataJson.DArticulo[p].Total);
                    }

                    $("#tblviewDFacturaFRP > tbody").html(DF);
                    $("#tblviewDPremioFRP > tbody").html(DP)
                    $("#spnttFRP").text(ttff);
                }
        });
    }

    function DFactura(factura){
        $("#codFactura").text(factura); $('#progressFact').show();        
        limpiarTabla(tblModal1);
        $('#tblModal1').DataTable({
            ajax: "getDetalleFactura/"+ factura,
            "info":    false,
                "bPaginate": false,
                "paging": true,
                "pagingType": "full_numbers",
                "lengthMenu": [[10, -1], [10, "Todo"]],
                "language": {
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "lengthMenu": '_MENU_ ',
                    "search": '<i class=" material-icons">search</i>',
                    "loadingRecords": "",
                    "paginate": {
                        "first": "Primera",
                        "last": "Última ",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    }
                },
            columns: [
                { "data": "COD_ARTICULO" },
                { "data": "ARTICULO" },
                { "data": "CANTIDAD" },
                { "data": "TT_PUNTOS" }
            ]
        });
        $('#modal3').openModal();
        $('#tblModal1').on( 'init.dt', function () {
                $("#progressFact").hide();
            }).dataTable();
    }

    $( "#ListCatalogo").change(function() {
        if ($("#ListCliente").val()!=0){
            $("#AddPremioTbl").hide();
            $("#prgLoad").show();
            var Prm = $(this).val();
            $("#CodPremioFRP").val(Prm);
            $("#CantPremioFRP").val("1");

            var form_data = {
                codigo: Prm
            };
            $.ajax({
                url: "viewPtsItemCatalogo",
                type: "post",
                async:true,
                data: form_data,
                success:
                    function(json){
                        $("#ValorPtsPremioFRP").val(json)
                        $("#AddPremioTbl").show();
                        $("#prgLoad").hide();
                    }
            });
        }else{
            mensaje("SELECCIONE UN CLIENTE PRIMERO","error");
        }
    });

    $("#cambiarImagen").on('click',function(){
        $('.cosaEdicion').hide();
        $('.cosa2').show();
        $(this).hide();
    });

     $('#subir').click( function () {
        $('#nuevoArticulo').openModal();$('#bandera').val(0);
        //$('#cargar22').trigger('click');
        $( 'img' ).remove( '#quitar' );
        $('#codigoArto').val(parseInt($("#txtCount").val()) + 1 );$('#NombArto').val("");$('#PtArto').val("");
         $('#UndArto').val("");
         $('#obser').val("");
         $("#txtCount").text();

    } );
    $("#ImgContenedor").click(function(){
        viewiImg($("#ImgContenedor").html());
    });
    $("#ImgContenedor2").click(function(){
        viewiImg($("#ImgContenedor2").html());
    });


    function editarArticulo(imagen2,imagen,codigo,descripcion,descripcion2,unidad,v,Ubicacion){


        $('#bandera').val(1);
        $('#codigoArto').val(codigo);
        $('#NombArto').val(descripcion.replace('pulg','"'));
        $('#PtArto').val(descripcion2);
        $('#UndArto').val(unidad);
        $('#obser').val(Ubicacion);
        $('#nuevoArticulo').openModal();        
        $("#cargar22").trigger("click");
        document.getElementById("ImgContenedor").innerHTML = ['<img id="quitar" src="../assets/img/catalogo/'+imagen+'" title="', escape('Imagen_Actual'), '"/>'].join('');
        document.getElementById("ImgContenedor2").innerHTML = ['<img id="quitar" src="../assets/img/catalogo/'+imagen2+'" title="', escape('Imagen_Actual'), '"/>'].join('');
    }

    function clientesPuntos(cliente,vendedor,ruc,codigo) {
        $('#loadIMG').show();$('#detalleCliente').hide();$('#modalPtsCliente').openModal();
        $('#nomCliente').text(cliente);$('#codCliente').text("COD: "+codigo);$('#rucCliente').text("RUC: "+ruc);
        $('#vendedorCliente').text(vendedor);
        $.ajax({//AJAX PARA TRAER LOS PUNTOS TOTALES DEL CLIENTE
                url: "PuntosCliente/"+codigo,
                type: "GET",
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(datos)
                {                    
                    //$("#AcuT").html(datos[0]['ACUMULADO']);
                    $.each(datos, function(i, item) {
                        $("#AcuT").html(formatNumber(item.ACUMULADO));
                        $("#Disp").html(formatNumber(item.DISPONIBLE-item.CANJEADO));
                        $("#Canj").html(formatNumber(item.CANJEADO));
                    });
                    $('#detalleCliente').show();
                    $('#loadIMG').hide();
                }
            });
    }

    function formatNumber(x) {//solo funciona con exteros
        return isNaN(x)?"":x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    
    // agrego evento para abrir y cerrar los detalles
    $('#PtosCliente').on('click', 'tbody .detallesFactura', function () {
        var table = $('#PtosCliente').DataTable();
        var tr = $(this).closest('tr'); $(this).addClass("detallesFacturOrange");
        var row = table.row(tr);
        var data = table.row( $(this).parents('tr') ).data();//obtengo todos los datos de la fila que di click
        //alert (data[1]); //este es el dato de la segunda columna

        if (row.child.isShown()) {// esta fila ya se encuentra visible - cierrala
            row.child.hide();
            tr.removeClass('shown');
            $(this).removeClass("detallesFacturOrange");            
        } else {// muestra la fila
            $('#loader'+data[1]).show();
            $('#detail'+data[1]).hide();
            //$('.loadFlotante').show("slow");
            format(row.child,data[1],data[1]);
            tr.addClass('shown');
        }           
    });

     $('#ClienteAdd tbody').on('click', 'tr td.searchDireccion', function () {
        var table = $('#ClienteAdd').DataTable();
        var data = table.row( this ).data();
        var cell = table.cell( this );
        cell.data('<div class="progress"><div class="indeterminate"></div></div>').draw();
        $.ajax({//AJAX PARA TRAER LA DIRECCION COMPLETA DEL CLIENTE
                url: "ajaxDireccionCliente/"+data[0],
                type: "GET",
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $.each(datos, function(i, item) {
                        cell.data(item.DIRECCION).draw();                        
                    });
                }
            });
    } );

    function format(callback,noPedido,div) {//funcion para traer llos datos y tabla de detalles
      var ia=0;
            $.ajax({
            url:'ajaxFacturasXcliente/'+noPedido,
            dataType: "json",
            complete: function (response) {
                var data = JSON.parse(response.responseText);
                console.log(data);
                    var thead = '',  tbody = '';
                    for (var key in data) {
                        thead += '<th class="negra center">FECHA</th>';
                        thead += '<th class="negra center">FACTURA</th>';
                        thead += '<th class="negra center">VENDEDOR</th>';
                        thead += '<th class="negra center">ACUMULADO</th>';
                        thead += '<th class="negra center">DISPONIBLE</th>';
                    }
                    $.each(data, function (i, d) {
                      $.each(d, function (a, b) {
                         ia++;
                      });
                        for (var x=0; x<ia; x++) {
                        tbody += '<tr class="center">' +
                                      '<td>' + d[x]["FECHA"] + '</td>'+
                                      '<td class="negra">' + d[x]["FACTURA"] + '</td>'+
                                      '<td>' + d[x]["VENDEDOR"] + '</td>'+
                                      '<td>' + d[x]["ACUMULADO"] + '</td>'+
                                      '<td>' + d[x]["DISPONIBLE"] + '</td>'+
                                  '</tr>';
                          }                   
                    });
                //console.log('<table>' + thead + tbody + '</table>');
                callback($('<table id="tblReportDetalles">' + thead + tbody + '</table>')).show();
                 $('#loader'+div).hide();
                 $('#detail'+div).show();
            },
            error: function () {
                $('#output').html('Hubo un error al cargar los detalles!');
            }
        });
      }

function articulosInactivos(){
    $('#listaArticulosInactivos').openModal();
    limpiarTabla(tblArticulosInactivos);
        $('#tblArticulosInactivos').DataTable({
            ajax: "getArticulosInactivos",
            "info":    false,
                "bPaginate": false,
                "paging": true,
                "pagingType": "full_numbers",
                "lengthMenu": [[10, -1], [10, "Todo"]],
                "language": {
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "lengthMenu": '_MENU_ ',
                    "search": '<i class=" material-icons">search</i>',
                    "loadingRecords": "",
                    "paginate": {
                        "first": "Primera",
                        "last": "Última ",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    }
                },
            columns: [
                { "data": "CodigoImg" },
                { "data": "Nombre" },
                { "data": "Imagen" },
                { "data": "Puntos" },
                { "data": "check" }
            ]
        });
    $('#tblArticulosInactivos').on( 'init.dt', function () {
        $("#progressFact").hide();
    }).dataTable();
}

$('#guardarActiculosInactivos').click(function(){
        var table = $('#tblArticulosInactivos').DataTable();
        var rowCount = table.page.info().recordsTotal;
        var contador=0; $('#loadArticulosInactivos').show(); $('#guardarActiculosInactivos').hide();
         $("#tblArticulosInactivos input:checkbox:checked").each(function(index) {
            var valores = "";
            //var table = $('#tblCatalogoActualModal').DataTable();
            var codigo = "";            
            $(this).parents("tr").find("td").each(function(){
                switch($(this).parent().children().index($(this))) {//obtengo el index de la columna EKISDE
                    case 0:
                        codigo = $(this).html();
                        break;
                        default: break;
                }
            });

            $.ajax({//AJAX PARA TRAER LOS PUNTOS TOTALES DEL CLIENTE
                url: "activarArticulos/"+codigo,
                type: "GET",
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(datos)
                {      
                    mensaje('EL ARTÍCULO "'+codigo+'" FUE ACTIVADO CORRECTAMENTE','');
                }
            });
        });
        var myVar = setInterval(myTimer3, 6000);;
         
    });

function printVoucher (url) {
        window.open(url, '_blank');
}
function limpiarTabla (idTabla) {
        idTabla = $(idTabla).DataTable();
        idTabla.destroy();
        idTabla.clear();
        idTabla.draw();
}
function mensaje (mensaje,clase) {
    var $toastContent = $('<span class="center">'+mensaje+'</span>');
    if (clase == 'error'){
        return Materialize.toast($toastContent, 3500,'rounded error');
    }
    return  Materialize.toast($toastContent, 3500,'rounded');    
}

function subirEXCEL () {//funcion para subir el catalogo atravez de excel
    var imagenes = $('#imagenes').val().replace(/C:\\fakepath\\/i, '');
    var excel = $('#csv').val().replace(/C:\\fakepath\\/i, '');
    var tipoExcel = excel.split(".");
    if (excel=="") {
        mensaje("SELECCIONE EL EXCEL DEL CATALOGO","error")
        return false;
    }if (tipoExcel[1]!="xls"){
        mensaje("EL ARCHIVO NO ES UN EXCEL 97-2003(xls)","error")        
        return false;
    }if (imagenes=="") {
        mensaje("SELECCIONE AL MENOS 1 IMAGEN","error")
        return false;
    }else{
        $('#agregarExcel').hide(); $('#loadArchivoExcel').show();
        $('#formVariasImagenes').submit();    
    }    
}

function viewiImg(id){
    document.getElementById("imgView").innerHTML = [id].join('');
    $("#modal1").openModal();
}