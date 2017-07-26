<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/******** MIS RUTAS **********/
// LOGIN
$route['login'] = 'login_controller/Acreditar';
$route['salir'] = 'login_controller/Salir';
// FIN LOGIN

// RUTAS MENU
$route['Main'] = 'vista_controller/main';
$route['Facturas'] = 'vista_controller/Facturas';

/* CLIENTES */
$route['Clientes'] = 'clientes_controller/Clientes';
$route['FindClient/(:any)'] = 'clientes_controller/FindClient/$1';
$route['BajaClientes'] = 'vista_controller/BajaClientes';
$route['PuntosClientes'] = 'clientes_controller/facturasClientes';
$route['ajaxDireccionCliente/(:any)'] = 'clientes_controller/ajaxDireccionCliente/$1';

$route['PuntosCliente/(:any)'] = 'clientes_controller/puntosCliente/$1';
$route['DetalleFact'] = 'vista_controller/DetalleFact';
$route['getDetalleFactura/(:any)'] = 'vista_controller/getDetalleFactura/$1';
$route['getFacturaFRP/(:any)'] = 'frp_controller/getFacturaFRP/$1';
$route['Frp'] = 'frp_controller/CanjeFrp';
$route['saveFRP'] = 'frp_controller/SaverFRP';
$route['viewPtsItemCatalogo'] = 'vista_controller/getPuntosArticulosCatalogo';
$route['FRE'] = 'vista_controller/CanjeFre';
$route['ajaxFacturasXcliente/(:any)'] = 'clientes_controller/ajaxFacturasXcliente/$1';

/*USUARIOS*/
$route['Usuarios'] = 'Usuario_controller/Usuarios'; //cargar usuarios
$route['NuevoUsuario/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Usuario_controller/addUser/$1/$2/$3/$4/$5/$6'; //agregar usuario
$route['ActUser/(:any)/(:any)'] = 'Usuario_controller/ActUser/$1/$2'; //cambiar estado de usuario
$route['LoadVendedores'] = 'Usuario_controller/LoadVendedor';
$route['LoadCliente'] = 'Usuario_controller/LoadClient';// cargar los clientes
/*USUARIOS*/

$route['Reportes'] = 'vista_controller/Reportes';

/*RUTAS DE CATALOGO*/
$route['NuevoCatalogo'] = 'catalogo_controller/NuevoCatalogo';
$route['Catalogo'] = 'catalogo_controller/index';
$route['subirImg'] = 'catalogo_controller/subirImg';
$route['crearCatalogo'] = 'catalogo_controller/crearCatalogo';
$route['verificarImg/(:any)'] = 'catalogo_controller/verificarImg/$1';//verifico si la imagen existe ekisde
$route['ActualizarEstadoArticulo'] = 'catalogo_controller/ActualizarEstadoArticulo';
$route['AjaxCatalogoPasado/(:any)'] = 'catalogo_controller/CatalogoPasado/$1';
$route['actualizarPuntos/(:any)/(:any)/(:any)'] = 'catalogo_controller/actualizarPuntos/$1/$2/$3';
$route['actualizarCatalogo'] = 'catalogo_controller/actualizarCatalogo';//ruta para guardar los nuevos articulos en el catalogo
$route['subirVariasImagenes'] = 'catalogo_controller/subirVariasImagenes';
$route['getArticulosInactivos'] = 'catalogo_controller/getArticulosInactivos';
$route['activarArticulos/(:any)'] = 'catalogo_controller/activarArticulos/$1';
// FIN CATALOGO

// RUTA IMPRESION
$route['DetalleFRP'] = 'impresion_controller/DetalleFRP';
$route['DetalleFRE'] = 'impresion_controller/DetalleFRE';
$route['PdfVoucher/(:any)'] = 'exportacion_controller/PdfVoucher/$1';
// FIN IMPRESION

// RUTA EXPORTACIÓN PDF Y EXCEL
$route['Exp_Clientes'] = 'exportacion_controller/ExpoClients';
$route['ExpPDF'] = 'exportacion_controller/ExpoPdf';
$route['ExpFRP/(:any)'] = 'exportacion_controller/ExpoFrp/$1';

$route['ExpPDFpuntosCliente'] = 'exportacion_controller/ExpoPdfPuntosClientes';
$route['ExpEXCELpuntosCliente'] = 'exportacion_controller/ExpoExcelPuntosClientes';
$route['getviewFRP'] = 'frp_controller/viewFrp';
$route['delFRP'] = 'frp_controller/inactivar';
$route['ExpPDFEstadoFactura'] = 'exportacion_controller/ExpEstadoFactura';
$route['getAplicadoP/(:any)'] = 'frp_controller/getAplicadoP/$1';
$route['BuscaFRP/(:any)'] = 'frp_controller/BuscaFRP/$1';
// FIN EXPORTACIÓN

// RUTAS VISTA REPORTES
$route['ajaxEstadoFacturas/(:any)/(:any)/(:any)'] = 'reportes_controller/ajaxEstadoFacturas/$1/$2/$3';

$route['ajaxDisponibilidadPuntos/(:any)/(:any)/(:any)'] = 'reportes_controller/ajaxDisponibilidadPuntos/$1/$2/$3';
$route['ajaxDireccionTelefono/(:any)'] = 'reportes_controller/ajaxDireccionTelefono/$1';


