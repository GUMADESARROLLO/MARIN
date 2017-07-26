<?php
/*session_start();
function SecuritySystem(){
    if (!$_SESSION){
    echo '<script language = javascript>    
    self.location = "index.php"
    </script>';
    }
}*/
class Main{  

    public static function Strg_ID_Pedido($str){

    switch (strlen($str)) {
        case '1':
            $varreturn="00000".$str;
        break;
        case '2':
            $varreturn="0000".$str;
        break;
        case '3':
            $varreturn="000".$str;
        break;
        case '4':
            $varreturn="00".$str;
        break;
        case '5':
            $varreturn="0".$str;
        break;
        case '6':
            $varreturn=$str;
        break;
    }
    return $varreturn; 
    } 
	public static function open_database_connectionSQL(){
	    $serverName = "192.168.1.112";
	    $connectionInfo = array( "UID"=>"sa","PWD"=>"Server2012!","Database"=>"PRODUCCION","CharacterSet"=>"UTF-8");
	    $LINK = sqlsrv_connect( $serverName, $connectionInfo);
	    return $LINK;
	}
    public static function open_database_connectionMYSQL(){
        $link = mysql_connect('localhost', 'root', 'a7m1425.');
        mysql_select_db('onlp', $link); 
        return $link;
    }
    public static function OPen_database_odbcSAp(){
        return odbc_connect("HANA","SYSTEM","B1Adminhana", SQL_CUR_USE_ODBC);
    }
	public static function cambiarFormatoFecha($fecha){     
        list($dias,$mes,$anos)=explode("/",$fecha); 
        if ($dias <= 9) {
            $Fd='0'.$dias;
        } else {
            $Fd=$dias;
        }
        if ($mes <= 9) {
            $Fm='0'.$mes;
        } else {
            $Fm=$mes;
        }
        return $anos."-".$Fm."-".$Fd; 
    } 
    public static function Inventarios(){
        $obj = new Vistas;
        $conn = $obj -> OPen_database_odbcSAp();  
        $query = 'SELECT * from SBO_INNOVA_INDUSTRIAS.MAC_INVS_X_BODEGAS where "Bodega"= '."'06'".' and "ItemCode" not like '."'%+%'".'';
        $resultado =  odbc_exec($conn,$query);
        $json = array();  
        $i=0;      
        while ($fila = odbc_fetch_array($resultado)){
            $json['data'][$i]['ItemCode'] = $fila['ItemCode'];  
            $json['data'][$i]['ItemName'] = utf8_encode($fila['ItemName']);  
            $json['data'][$i]['OnHand'] = utf8_encode(number_format($fila['OnHand'],2)).' [ '.$fila['InvntryUom'].' ] ';  
            $json['data'][$i]['IsCommited'] = utf8_encode(number_format($fila['IsCommited'],2));  
            $json['data'][$i]['Existencia'] = utf8_encode(number_format($fila['Existencia'],2));  
            $i++;
        }
        echo json_encode($json);
    }

     public static function Catalogo(){
        $obj = new Vistas;
        $conn = $obj -> open_database_connectionSQL();  
        $tsql = "SELECT ARTICULO,DESCRIPCION,LABORATORIOS FROM dbo.M_ARTIC_2015 ";        
        $json = array();        
        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_query( $conn, $tsql , $params, $options );          
        if(sqlsrv_num_rows($stmt)){
            $i=0;
            while($row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){                                                           
                $json['data'][$i]['ARTICULO'] = $row['ARTICULO'];  
                $json['data'][$i]['DESCRIPCION'] = $row['DESCRIPCION'];  
                $json['data'][$i]['LABORATORIOS'] = $row['LABORATORIOS'];                  
                $i++;            
            }
            
        }
        echo json_encode($json);
    }
    public static function Liq6(){
        $obj = new Vistas;
        $conn = $obj -> open_database_connectionSQL();  
        $tsql = "SELECT ARTICULO,DESCRIPCION,DIAS_VENCIMIENTO,CANT_DISPONIBLE,UNIDAD_VENTA,fecha_vencimientoR,LOTE FROM dbo.Vencimientos_6meses ";        
        $json = array();        
        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_query( $conn, $tsql , $params, $options );          
        if(sqlsrv_num_rows($stmt)){
            $i=0;
            while($row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){                                                           
                $json['data'][$i]['ARTICULO'] = $row['ARTICULO'];  
                $json['data'][$i]['DESCRIPCION'] = $row['DESCRIPCION'];  
                $json['data'][$i]['DIAS_VENCIMIENTO'] = $row['DIAS_VENCIMIENTO'];                  
                $json['data'][$i]['CANT_DISPONIBLE'] = $row['CANT_DISPONIBLE'].' - [ '. $row['UNIDAD_VENTA'].' ] ';   
                $json['data'][$i]['fecha_vencimientoR'] = $row['fecha_vencimientoR'];                  
                $json['data'][$i]['LOTE'] = $row['LOTE'];
                $i++;            
            }
            
        }
        echo json_encode($json);
    }
    public static function MTCLALL(){       
        $obj = new Vistas;
        $conn = $obj -> OPen_database_odbcSAp();  
        $query = 'SELECT * from SBO_INNOVA_INDUSTRIAS.MAC_SNSO ';      
        $resultado =  odbc_exec($conn,$query);
        $json = array();  
        $i=0;      
        while ($fila = odbc_fetch_array($resultado)){            
            $json['data'][$i]['DT_RowId']= "row_"."$i";                                                                    
            $json['data'][$i]['CardCode'] = utf8_encode($fila['COD_CLIENTE']);  
            $json['data'][$i]['SlpName'] = utf8_encode($fila['CLIENTE']);              
            $json['data'][$i]['Address'] = utf8_encode($fila['DIR']);  
            $json['data'][$i]['Balance'] = utf8_encode($fila['TEF1']);  
            $json['data'][$i]['Cedula'] = utf8_encode($fila['CEDU']);  
            $json['data'][$i]['BOTON']=utf8_encode($fila['VENDEDOR']);
            $json['data'][$i]['PEDIDOS']=utf8_encode($fila['PEDIDOS']);
            $json['data'][$i]['ANULADOS']=utf8_encode($fila['ANULADOS']);
            $i++;
        }
        $i++;
        echo json_encode($json);
    }
    public static function MTCLALLFILTRADO($ID){       
        $obj = new Vistas;
        $conn = $obj -> OPen_database_odbcSAp();  
        if ($ID=="0") {
            $query = 'SELECT * from SBO_INNOVA_INDUSTRIAS.MAC_SNSO  ';              
        } else {
            $query = 'SELECT * from SBO_INNOVA_INDUSTRIAS.MAC_SNSO WHERE "COD_VENDEDOR"='."'".$ID."'".' ';              
        }        
        
        $resultado =  odbc_exec($conn,$query);
        $json = array();  
        $i=0;      
        while ($fila = odbc_fetch_array($resultado)){            
            $json['data'][$i]['DT_RowId']= "row_"."$i";                                                                    
            $json['data'][$i]['CardCode'] = utf8_encode($fila['COD_CLIENTE']);  
            $json['data'][$i]['SlpName'] = utf8_encode($fila['CLIENTE']);              
            $json['data'][$i]['Address'] = utf8_encode($fila['DIR']);  
            $json['data'][$i]['Balance'] = utf8_encode($fila['TEF1']);  
            $json['data'][$i]['Cedula'] = utf8_encode($fila['CEDU']);  
            $json['data'][$i]['BOTON']=utf8_encode($fila['VENDEDOR']);
            $json['data'][$i]['PEDIDOS']=utf8_encode($fila['PEDIDOS']);
            $json['data'][$i]['ANULADOS']=utf8_encode($fila['ANULADOS']);
            $i++;
        }
        $i++;
        echo json_encode($json);
    }
    public static function MTCL(){       
        $obj = new Vistas;

        $conn = $obj -> OPen_database_odbcSAp();  
        $link = $obj ->open_database_connectionMYSQL();

        $query = 'SELECT * from SBO_INNOVA_INDUSTRIAS.MAC_MTCL where "SLPCODE"='.$_SESSION['Rutas'].' ';      
        $resultado =  odbc_exec($conn,$query);
        
        $consultaMYSQL= "SELECT distinct ordr.SlpCode,ocrd.* FROM ordr inner join ocrd on ordr.CardCode=ocrd.IdCl where (SlpCode='".$_SESSION['Rutas']."') and (ocrd.Estado='0')";
        $resultadoMYSQL= mysql_query($consultaMYSQL,$link) or die (mysql_error());     

        $i=0;              
        $json = array();  
        while($rowMYSQL=mysql_fetch_array($resultadoMYSQL)){                                                                       
            $json['data'][$i]['CardCode'] = utf8_encode($rowMYSQL['IdCl']);  
            $json['data'][$i]['SlpName'] = utf8_encode($rowMYSQL['Nombre']);              
            $json['data'][$i]['Address'] = utf8_encode($rowMYSQL['Direccion']);  
            $json['data'][$i]['Balance'] = "C$ 0";  
            $json['data'][$i]['BOTON']="<a class='btn btn-blue waves-button waves-effect waves-light' href='LineasPedido.html?Cls=".$rowMYSQL['IdCl']."' ><span class='icon icon-2x'>shopping_cart</span></a>";            
            $i++;            
        }        
        while ($fila = odbc_fetch_array($resultado)){            
          	$json['data'][$i]['CardCode'] = utf8_encode($fila['CARDCODE']);  
            $json['data'][$i]['SlpName'] = utf8_encode($fila['CARDNAME']);              
            $json['data'][$i]['Address'] = utf8_encode($fila['ADDRESS']);  
            $json['data'][$i]['Balance'] = "C$ ".utf8_encode($fila['BALANCE']);  
            $json['data'][$i]['BOTON']="<a class='btn btn-blue waves-button waves-effect waves-light' href='LineasPedido.html?Cls=".$fila['CARDCODE']."' ><span class='icon icon-2x'>shopping_cart</span></a>";
            $i++;
        }                
        echo json_encode($json);
    }
    public static function LoadRuta(){       
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consultaMYSQL= "SELECT * from oslp where Privilegio='1'";
        $resultadoMYSQL= mysql_query($consultaMYSQL,$link) or die (mysql_error());     
        $i=0;              
        $json = array();  
        while($rowMYSQL=mysql_fetch_array($resultadoMYSQL)){                                                                       
            $json['Rutadata'][$i]['Nombre'] = utf8_encode($rowMYSQL['Nombre']);  
            $json['Rutadata'][$i]['Idvn'] = utf8_encode($rowMYSQL['Idvn']);              
            $i++;            
        }        
        echo json_encode($json);
    }
    public static function LoadPro(){
        $obj = new Vistas;
        $conn = $obj -> OPen_database_odbcSAp();  
        //$query = 'SELECT * FROM SBO_INNOVA_INDUSTRIAS.MAC_PRFL';      
        //$Qpapel = 'SELECT * FROM SBO_INNOVA_INDUSTRIAS.MAC_DETALLE_FULLPRODUCT Where  ("ItemCode" like '."'6%'".') or ("ItemCode" like '."'7%'".') ORDER BY "ItemCode"';                
        $Qpapel = 'select * from  "SBO_INNOVA_INDUSTRIAS"."MAC_INST_FINAL_2015_TODO" Where "ItemCode" in (
'."'6IN00002'".',
'."'6IN00009'".',
'."'6IN00010'".',
'."'6IN00043'".',
'."'6IN00001'".',
'."'6IN00046'".',
'."'6IN00047'".',
'."'7IN00022'".',
'."'7IN00023'".',
'."'6IN00044'".',
'."'6IN00051'".'
 ) ORDER BY "ItemCode"
 ';
        $ResultPapel =  odbc_exec($conn,$Qpapel);
        $json = array();  
        $i=0; 
        $json['Pro'][$i]['ARTICULO'] ="xxxx";
        $json['Pro'][$i]['DESCRIPCION'] =" * * * * * CANTALOGO DE PAPEL * * * * * " ;
        $i=1; 
        while ($RowPapal = odbc_fetch_array($ResultPapel)){            
            $json['Pro'][$i]['ARTICULO'] = utf8_encode($RowPapal['ItemCode']);  
            $json['Pro'][$i]['DESCRIPCION'] = " [ ".utf8_encode($RowPapal['ItemCode'])." ] ".utf8_encode($RowPapal['ItemName']);
            $i++;
        }
        $QOTC = 'SELECT * FROM SBO_INNOVA_INDUSTRIAS.MAC_DETALLE_FULLPRODUCT Where ("ItemCode" in (
'."'8IN00077'".',
'."'8IN00078'".',
'."'8IN00079'".',
'."'8IN00080'".',
'."'8IN00081'".',
'."'8IN00082'".',
'."'8IN00083'".',
'."'8IN00084'".',
'."'8IN00085'".',
'."'8IN00086'".'
 ))  ORDER BY "ItemCode"';                
        //$QOTC = $Qpapel ;

        $ResultOTC =  odbc_exec($conn,$QOTC);
        
        
        $json['Pro'][$i]['ARTICULO'] ="xxxx";
        $json['Pro'][$i]['DESCRIPCION'] =" * * * * * CATALOGO DE PRODUCTO OTC * * * * * " ;
        $i++;
        while ($RowOTC = odbc_fetch_array($ResultOTC)){            
            $json['Pro'][$i]['ARTICULO'] = utf8_encode($RowOTC['ItemCode']);  
            $json['Pro'][$i]['DESCRIPCION'] = " [ ".utf8_encode($RowOTC['ItemCode'])." ] ".utf8_encode($RowOTC['ItemName']);
            $i++;
        }

        echo json_encode($json);
    }
    public static function OUOM($Pro){
        $obj = new Vistas;
        $Sufijo = substr($Pro, 0,1);
        $conn = $obj -> OPen_database_odbcSAp();  
        //$query = 'SELECT * FROM SBO_INNOVA_INDUSTRIAS.MAC_PRFL';              
        if (($Sufijo =='6') or ($Sufijo=='7')) {
            $query = 'SELECT * FROM SBO_INNOVA_INDUSTRIAS.OUOM where "UomEntry" Between '."'-1'".' and '."'7'".'';
        } else {
            $query = 'SELECT * FROM SBO_INNOVA_INDUSTRIAS.OUOM where "UomEntry" Between '."'8'".' and '."'100'".'';
        }
        $resultado =  odbc_exec($conn,$query);
        $json = array();  
        $i=0;      
        while ($fila = odbc_fetch_array($resultado)){            
            $json['Pro'][$i]['UomEntry'] = utf8_encode($fila['UomEntry']);  
            $json['Pro'][$i]['UomName'] = utf8_encode($fila['UomName']);
            $i++;
        }
        echo json_encode($json);
    }
    public static function LoadProPrice($ID){
        $obj = new Vistas;
        $Sufijo = substr($ID, 0,1);
        $conn = $obj -> OPen_database_odbcSAp();  
        $consulta ='SELECT "ItemCode","ItemName","ListName","Price","PriceList","SalUnitMsr" from SBO_INNOVA_INDUSTRIAS.MAC_INST_FINAL_2015_TODO Where  "ItemCode"='."'".$ID."'".' ';
        
        
        $resultado =  odbc_exec($conn,$consulta);
        while ($row = odbc_fetch_array($resultado)){
                $ArraRows[]=$row;
        }
        if (!isset($ArraRows)) {            
             echo '<option value="">----</option>';
        } else {
            foreach ($ArraRows as $key) {   
               if (($Sufijo=="6") or ($Sufijo=="7")) {
                   $Price = $key['Price'] / 24;
                    $PL = $key['Price'] / 12;
                    $P2= $Price * 2;
                    $P4= $Price * 4;

                    echo '<option value="0">Seleccione Precio</option>';
                    echo '<option value="'.$key['Price'].'">BOLSON [C$ '.$key['Price'].' ]</option>';
                    
                    switch ($key['ItemCode']) {                             
                        case '6IN00009':
                            //echo '<option value="'.$key['Price'].'">Bolson [C$ '.$key['Price'].' ]</option>';
                            echo '<option value="'.$P2.'">'.'2PACK [C$ '.number_format($P2,2).' ]</option>';
                        break;
                        case '6IN00035': case '6IN00036': case '6IN00037':
                            //echo '<option value="'.$key['Price'].'">Bolson [C$ '.$key['Price'].' ]</option>';
                            echo '<option value="'.$PL.'">'.'ROLLO [C$ '.number_format($PL,2).' ]</option>';
                        break;
                        case '6IN00010':
                            //echo '<option value="'.$key['Price'].'">Bolson [C$ '.$key['Price'].' ]</option>';
                            echo '<option value="'.$P4.'">'.'4PACK [C$ '.number_format($P4,2).' ]</option>';
                        break;  
                        default:
                            //echo '<option value="'.$key['Price'].'">Bolson [C$ '.$key['Price'].' ]</option>';
                            echo '<option value="'.$Price.'">'.'ROLLO [C$ '.number_format($Price,2).' ]</option>';
                        break; 
                    }
                } else {
                    
                    
                    echo '<option value="0">Seleccione Precio</option>';
                    echo '<option value="'.$key['Price'].'">'.$key['SalUnitMsr'].' [C$ '.$key['Price'].' ]</option>';
                

                }   
                  echo '<option value="0.00">BONI [C$ 0.00 ]</option>';                 
            }
        }
    }
    public static function LoadPrecio($id){
        $obj = new Vistas;
        $conn = $obj -> open_database_connectionSQL();  
        $tsql = "SELECT TOP 10 PRECIO,NIVEL_PRECIO FROM dbo.PEDIDOS_UMK where ARTICULO='".$id."' AND NIVEL_PRECIO='FARMACIA' ";        
        $json = array();        
        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_query( $conn, $tsql , $params, $options );          
        if(sqlsrv_num_rows($stmt)){
            $i=0;
            while($row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){                                                           
                $json['ProPrice'][$i]['PRECIO'] = number_format($row['PRECIO'],2);  
                $json['ProPrice'][$i]['NIVEL_PRECIO'] = $row['NIVEL_PRECIO'];  
                $i++;            
            }
            
        }
        echo json_encode($json);
    }
    public static function FormatoCedula($Cdls){                        
        return substr(str_replace("-", "", $Cdls), 0,3).'-'.substr(str_replace("-", "", $Cdls), 3,6).'-'.substr(str_replace("-", "", $Cdls), 9,5);
    }
    public static function FormatoTelefono($Celular){                                
        return substr(str_replace("-", "", $Celular), 0,4).'-'.substr(str_replace("-", "", $Celular), 4,4);
    }
    public static function SaveLine ($Name,$Dire,$Tlf1,$Tlf2,$Cdl,$Celular){
        $obj = new Vistas;
        $conn = $obj -> open_database_connectionMYSQL();            
        $FrmCdl = $obj -> FormatoCedula($Cdl);
        $T1 = $obj -> FormatoTelefono($Tlf1);
        $T2 = $obj -> FormatoTelefono($Tlf2);
        $Celu = $obj -> FormatoTelefono($Celular);
        $insert_Linea="INSERT INTO  ocrd (Nombre,Direccion,Telefono,Telefono2,Identidad,Celular) VALUES('".$Name."','".$Dire."','".$T1."','".$T2."','".$FrmCdl."','".$Celu."')";                
        mysql_query($insert_Linea,$conn)or die(mysql_error());
        echo mysql_insert_id();
    }
    public static function SavePedido($Pedido,$Cliente,$Monto,$DueDate,$Name,$Rerencia){
        $obj = new Vistas;
        $conn = $obj -> open_database_connectionMYSQL();                    
        $insert_Linea="INSERT INTO  ordr (DocNum,DocDate,CardCode,SlpCode,DocCur,DocLastDate,DocLastDateCred,DocDueDate,Mnt,CardName,Referencia) VALUES('".$Pedido."','".date('Y-m-d')."','".$Cliente."','".$_SESSION['Rutas']."','COR','".date('Y-m-d h:i:s')."','".date('Y-m-d h:i:s')."','".$DueDate."','".$Monto."','".$Name."','".$Rerencia."')";        
        echo $insert_Linea;
        mysql_query($insert_Linea,$conn)or die(mysql_error());

        $NewID=intval(substr($Pedido, 6, 7));
        $update="UPDATE oslp SET ConseCutivo='".$NewID."' WHERE Idvn='".$_SESSION['Rutas']."'";
        mysql_query($update,$conn);

        echo "hola";
    }
    public static function ClearCLS($Valor){
        $obj = new Vistas;
        $conn = $obj -> open_database_connectionMYSQL();  
        $CantElement = count((explode(",",str_replace('"', "",$Valor))));
        //$update="UPDATE ordr.SlpCode,ordr.DocNum,ocrd.* FROM ordr inner join ocrd on ordr.CardCode=ocrd.IdCl WHERE DocNum IN ('".$Valor."')";        
        $update="UPDATE ordr inner join ocrd on ordr.CardCode=ocrd.IdCl SET ocrd.Estado = '1' WHERE DocNum IN ('".$Valor."')";        
        mysql_query($update,$conn);
        echo $update;
    }
    public static function UpdateLineClear($Valor){
        $obj = new Vistas;
        $conn = $obj -> open_database_connectionMYSQL();  
        $CantElement = count((explode(",",str_replace('"', "",$Valor))));
        $update="UPDATE ordr SET Estado = '1' WHERE DocNum IN (".$Valor.")";        
        mysql_query($update,$conn);        
        $obj -> ClearCLS(str_replace('"', "",$Valor));
        $insert ="INSERT INTO logc (Pedidos,Cant,Fecha,IDUsuario) VALUES ('".$Valor."','".$CantElement."','".date('Y-m-d h:i:s')."','".$_SESSION['IdUser']."') ";
        mysql_query($insert,$conn);        

    }
    public static function UpdatePedido($id,$IDSaP){
        $obj = new Vistas;
        $conn = $obj -> open_database_connectionMYSQL();     
        $TimeDesfase = $obj -> TimeRemanente($id);
        
        $update="UPDATE ordr SET Comment='Este Pedido Fue Cambiado al estado Procesado por el Usuario #".$_SESSION['Rutas']."',rdrt='".utf8_encode($TimeDesfase)."',SlpCodeUpd='".$_SESSION['IdUser']."',DocEntry='".$IDSaP."',Estado='1',DocLastDate='".date('Y-m-d h:i:s')."' WHERE DocNum='".$id."'";
        mysql_query($update,$conn);
        $obj -> ClearCLS($id);
    }

    public static function UpdateLine($Valor,$Linea,$Campo){
        $obj = new Vistas;
        $conn = $obj -> open_database_connectionMYSQL();  
         switch ($Campo) {
            case 'Q':
                $update="UPDATE rdr1 SET Quantity='".$Valor."' WHERE IDL='".$Linea."'";
            break;
            case 'W':
                $update="UPDATE rdr1 SET WhsCode='".$Valor."' WHERE IDL='".$Linea."'";
            break;
            case 'U':
                $NwId =$obj -> UoMEntry($Valor);
                $update="UPDATE rdr1 SET unitMsr='".$Valor."', UomEntry='".$NwId."' WHERE IDL='".$Linea."'";            break;
            case 'P':
                $update="UPDATE rdr1 SET Price='".$Valor."' WHERE IDL='".$Linea."'";
            break;
        }
        mysql_query($update,$conn);
    }
    public static function SavePedidoLinea($Articulo,$UniArti,$CntArti,$PrecioUND,$LineNum,$Pedido,$DescripCion){
        $obj = new Vistas;
        $conn = $obj -> open_database_connectionMYSQL();                    
        $UNID = $obj -> UoMEntry($UniArti);                    
        $Bodega = $obj -> WhsCode($Articulo);
        $insert_Linea="INSERT INTO  rdr1 (ItemCode,Quantity,unitMsr,Price,Currency,SlpCode,LineNum,DocNum,Dscription,UomEntry,WhsCode) VALUES('".$Articulo."','".$CntArti."','".$UniArti."','".$PrecioUND."','COR','".$_SESSION['Rutas']."','".$LineNum."','".$Pedido."','".$DescripCion."','".$UNID."','".$Bodega."')";
        mysql_query($insert_Linea,$conn)or die(mysql_error());
    }
    public static function UoMEntry($UND){
        switch ($UND) {
            case 'Manual':
                $VarUoME = "-1";
            break;
            case 'BOLSON':
                $VarUoME = "1";
            break;
            case '6PACK':
                $VarUoME = "2";
            break;
            case 'ROLLO':
                $VarUoME = "3";
            break;
            case '4PACK':
                $VarUoME = "4";
            break;
            case '2PACK':
                $VarUoME = "5";
            break;
            case '3PACK':
                $VarUoME = "6";
            break;            
            case 'Unidad':
                $VarUoME = "7";
            break;            
            case 'CAJA':
                $VarUoME = "8";
            break;            
            case 'POMO':
                $VarUoME = "9";
            break;            
            case 'FRASCO':
                $VarUoME = "10";
            break;            
            case 'LOCION':
                $VarUoME = "11";
            break;            
            default:
                $VarUoME = "0";
            break;
        }
        return $VarUoME;
    }
     public static function WhsCode($WHS){
        switch (substr($WHS, 0,1)) {
            case '6':
                $VarWhs = "06";
            break;
            case '7':
                $VarWhs = "06";
            break;
            case '8':
                $VarWhs = "09";
            break;
        }
        return $VarWhs;
    }



    public static function TimeRemanente($id){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consulta= "SELECT * FROM onlp_orts WHERE DocNum='".$id."'"; 
        $resultado= mysql_query($consulta,$link) or die (mysql_error());
        $fila=mysql_fetch_array($resultado);
        
        if (!$fila[0]) {  
        } else {          
            $String = $fila['ANIOS'].' Anios'.$fila['MESES'].' Meses'.$fila['DIAS'].' Dias '.$fila['HMS'];
        }
         
        return $String;


    }
     public static function CalcBoni($Art,$Canti){
        $obj = new Vistas;
        $CNX = $obj -> open_database_connectionSQL();  
        $SQL ="SELECT * FROM dbo.ESCALA_BONIF WHERE ARTICULO = '".$Art."' and NIVEL_PRECIO='FARMACIA'";
        $json = array(); 
        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_query( $CNX, $SQL , $params, $options ); 
        $VarBoni = "0";

        
        while ($RowsQuerry = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){

            $Arras[]=$RowsQuerry;            
        }

        if (!isset($Arras)) {

            $json['ProBoni'][0]['Cant']="0";  

        } else {

            $i=0;
            foreach ($Arras as $key) {                
                if (($Canti >= $key['MIN_ART_FACT']) and ($Canti <= $key['MAX_ART_FACT'])) {                    
                    $json['ProBoni'][$i]['Cant']=number_format($key['UNIDADES_BONIF'],0);  
                    $i++;
                } else {                 
                }

            }
        }
        echo json_encode($json);
    }

    public static function Liq12(){
        $obj = new Vistas;
        $conn = $obj -> open_database_connectionSQL();  
        $tsql = "SELECT ARTICULO,DESCRIPCION,DIAS_VENCIMIENTO,CANT_DISPONIBLE,UNIDAD_VENTA,fecha_vencimientoR,LOTE FROM dbo.Vencimientos_12meses ";        
        $json = array();        
        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_query( $conn, $tsql , $params, $options );          
        if(sqlsrv_num_rows($stmt)){
            $i=0;
            while($row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){                                                           
                $json['data'][$i]['ARTICULO'] = $row['ARTICULO'];  
                $json['data'][$i]['DESCRIPCION'] = $row['DESCRIPCION'];  
                $json['data'][$i]['DIAS_VENCIMIENTO'] = $row['DIAS_VENCIMIENTO'];                  
                $json['data'][$i]['CANT_DISPONIBLE'] = $row['CANT_DISPONIBLE'].' - [ '. $row['UNIDAD_VENTA'].' ] ';   
                $json['data'][$i]['fecha_vencimientoR'] = $row['fecha_vencimientoR'];                  
                $json['data'][$i]['LOTE'] = $row['LOTE'];
                $i++;            
            }
            
        }
        echo json_encode($json);
    }
    
    public static function Login($Nameuser){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consulta= "SELECT * FROM oslp WHERE Pass='".$Nameuser."'"; 
        $resultado= mysql_query($consulta,$link) or die (mysql_error());
        $fila=mysql_fetch_array($resultado);
        $json = array();
        if (!$fila[0]) {                        
            $json['UserLogin'][0]['TipoU'] = "XX";
        } else {
            $_SESSION['IdUser'] = $fila['IdUser'];
            $_SESSION['NombreCompleto']= $fila['FullNAme'];                            
            $_SESSION['Privilegio']= $fila['Privilegio'];
            $_SESSION['Rutas']= $fila['Idvn'];

            $json['UserLogin'][0]['Correcto'] ="1";  
            $json['UserLogin'][0]['TipoU'] = $fila['Privilegio'];
        }
        echo json_encode($json);
    }

    public static function ConseCutivo(){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consulta= "SELECT  MAX(ID)+1 AS ConseCutivo from ordr"; 
        $resultado= mysql_query($consulta,$link) or die (mysql_error());
        $fila=mysql_fetch_array($resultado);
        $json = array(); 
        if (!$fila[0]) {  
        } else {          
             $json['JsonConseCutivo'][0]['Contador'] = "PRV".$_SESSION['Rutas']."-". $obj ->Strg_ID_Pedido($fila['ConseCutivo']+1);
        }
         echo json_encode($json); 
    }
    public static function MisPedidos(){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consulta= "SELECT * FROM ordr where SlpCode='".$_SESSION['Rutas']."'"; 
        $resultado= mysql_query($consulta,$link) or die (mysql_error());     
        $json = array();    
        $i=0;
        while($row=mysql_fetch_array($resultado)){                                                                       
            $json['data'][$i]['DocNum'] = '<a href="PedidoLinea.html?Pedido='.$row['DocNum'].'&Clinete='.$row['CardCode'].'" >'.$row['DocNum'].'</a>';
            $json['data'][$i]['CardCode'] = $row['CardCode'];  
            $json['data'][$i]['NombreCls'] = utf8_encode($row['CardName']);              
            $json['data'][$i]['DocDueDate'] = $row['DocDueDate'];  
            $json['data'][$i]['DocDate'] = $row['DocLastDateCred'];  
            
            if ($row['Estado']=="0") {
                $json['data'][$i]['Estado'] = '<a class="btn btn-alt waves-button waves-effect waves-light">Enviado</a>';
            } else {
                $json['data'][$i]['Estado'] = '<a class="btn btn-red waves-button waves-effect waves-light">Ingresado</a>';
            }
            
            $i++;            
        }
        echo json_encode($json);
    }
     public static function log(){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consulta= "SELECT * FROM tbllog"; 
        $resultado= mysql_query($consulta,$link) or die (mysql_error());     
        $json = array();    
        $i=0;
        while($row=mysql_fetch_array($resultado)){                                                           
            $json['data'][$i]['RecordUser'] = $row['RecordUser'];  
            $json['data'][$i]['daterecord'] = $row['daterecord'];  
            $json['data'][$i]['Hrs'] = $row['Hrs'];                          
            $i++;            
        }
        echo json_encode($json);
    }
    public static function Documentos($Cls){
        $obj = new Vistas;        
        $conn = $obj -> open_database_connectionSQL();          
        $tsql = "SELECT  DOCUMENTO,CONVERT (CHAR,FECHA_DOCUMENTO,101) AS FECHA_DOCUMENTO,MONTO_DOCUMENTO FROM dbo.CxCUMK where CLIENTE='".$Cls."'";        
        $json = array();        
        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_query( $conn, $tsql , $params, $options );          
        if(sqlsrv_num_rows($stmt)){
            $i=0;
            while($row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){                                                           
                $json['data'][$i]['DOCUMENTO'] = $row['DOCUMENTO'];  
                $json['data'][$i]['FECHA_DOCUMENTO'] = $row['FECHA_DOCUMENTO'];  
                $json['data'][$i]['MONTO_DOCUMENTO'] = "C$ ".number_format($row['MONTO_DOCUMENTO'],2);                                  
                $i++;            
            }
            
        }        
        echo json_encode($json); 
    }

     public static function logxdate($D1,$D2){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consulta= "SELECT * FROM tbllog where daterecord between '".$D1."' and '".$D2."'"; 
        
        $resultado= mysql_query($consulta,$link) or die (mysql_error());     
        $json = array();    
        $i=0;
        while($row=mysql_fetch_array($resultado)){                                                           
            $json['data'][$i]['RecordUser'] = $row['RecordUser'];  
            $json['data'][$i]['daterecord'] = $row['daterecord'];  
            $json['data'][$i]['Hrs'] = $row['Hrs'];                          
            $i++;            
        }
        echo json_encode($json);
    }
     public static function JsonDetalle($IDS){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consulta= "SELECT * FROM rdr1 where DocNum='".$IDS."'"; 
        $resultado= mysql_query($consulta,$link) or die (mysql_error());     
        $json = array();    
        $i=0;
        while($row=mysql_fetch_array($resultado)){                                                                       
            $json['dataDetalle'][$i]['IDL'] = $row['IDL'];  
            $json['dataDetalle'][$i]['ItemCode'] = $row['ItemCode'];  
            $json['dataDetalle'][$i]['Dscription'] = $row['Dscription'];  
            $json['dataDetalle'][$i]['Quantity'] =  $row['Quantity'];  
            $json['dataDetalle'][$i]['Price'] =  $row['Price'];  
            $json['dataDetalle'][$i]['WhsCode'] = $row['WhsCode'];              
            $json['dataDetalle'][$i]['unitMsr'] = $row['unitMsr'];              
            $i++;            
        }
        echo json_encode($json);
    }
    public static function SAC(){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consulta= "SELECT * FROM ordr where Estado='0'"; 
        $resultado= mysql_query($consulta,$link) or die (mysql_error());     
        $json = array();    
        $i=0;
        while($row=mysql_fetch_array($resultado)){                                                           
            $json['data'][$i]['IDPedidos'] = '<a href="PedidoLinea.html?Pedido='.$row['DocNum'].'&Clinete='.$row['CardCode'].'" >'.$row['DocNum'].'</a>';
            $json['data'][$i]['IdCliente'] = $row['CardCode'];  
            $json['data'][$i]['NameCliente'] = utf8_encode($row['CardName']);  
            $json['data'][$i]['IDCreador'] =  $obj ->SlpName($row['SlpCode']);  
            $json['data'][$i]['FechaPedido'] = $row['DocLastDateCred'];              
            if ($row['Estado']=="0") {
                $json['data'][$i]['StatusPedido'] = '<a class="btn btn-red waves-button waves-effect waves-light">PENDIENTE</a>';
            } else {
                $json['data'][$i]['StatusPedido'] = '<a class="btn btn-alt waves-button waves-effect waves-light">Ingresado</a>';
            }
            $json['data'][$i]['Eliminar']='<a class="btn btn-red waves-button waves-effect waves-light" onclick="EliminarPedido('."'".$row['DocNum']."'".')"><span class="icon icon-2x">highlight_off</span></a>';           
            
            $i++;            
        }
        echo json_encode($json);
    }
    public static function ViewSacBatch($IDS){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $Ruls = strval(base64_decode($IDS));
        $consulta= "SELECT * FROM ordr where DocNum in ".'('.$Ruls.')'."";         
        //echo $consulta;
        
        $resultado= mysql_query($consulta,$link) or die (mysql_error());     
        $json = array();    
        $i=0;
        while($row=mysql_fetch_array($resultado)){   
            $json['data'][$i]['DT_RowId']= "row_"."$i";                                                                    
            $json['data'][$i]['IDPedidos'] = $row['DocNum'];  
            $json['data'][$i]['IdCliente'] = $row['CardCode'];  
            $json['data'][$i]['NameCliente'] = $row['CardName'];  
            $json['data'][$i]['IDCreador'] =  $obj ->SlpName($row['SlpCode']);  
            $json['data'][$i]['FechaPedido'] = $row['DocLastDateCred'];              
            
            $i++;            
        }
        echo json_encode($json);
    }
     public static function SAC2(){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consulta= "SELECT * FROM ordr where Estado <> '6'"; 
        $resultado= mysql_query($consulta,$link) or die (mysql_error());     
        $json = array();    
        $i=0;
        while($row=mysql_fetch_array($resultado)){                                                           
             $json['data'][$i]['IDPedidos'] = '<a href="PedidoLinea.html?Pedido='.$row['DocNum'].'&Clinete='.$row['CardCode'].'" >'.$row['DocNum'].'</a>';
            $json['data'][$i]['IdCliente'] = $row['CardCode'];  
            $json['data'][$i]['NameCliente'] = utf8_encode($row['CardName']);  
            $json['data'][$i]['IDCreador'] = $obj ->SlpName($row['SlpCode']);  
            $json['data'][$i]['FechaPedido'] = $row['DocLastDateCred'];              
            if ($row['Estado']=="0") {
                $json['data'][$i]['StatusPedido'] = '<a class="btn btn-red waves-button waves-effect waves-light">PENDIENTE</a>';
            } else {
                $json['data'][$i]['StatusPedido'] = '<a class="btn btn-alt waves-button waves-effect waves-light">Ingresado</a>';
            }
            
            $i++;            
        }
        echo json_encode($json);
    }

    public static function SlpName($Id){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consulta= "SELECT * FROM oslp WHERE Idvn='".$Id."'"; 
        $resultado= mysql_query($consulta,$link) or die (mysql_error());
        $fila=mysql_fetch_array($resultado);
        $json = array();        
        return $fila['Nombre']; 
    }
    public static function ViewSuperVisor(){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consulta= "SELECT * FROM onlp_ortr WHERE Estado='0'"; 
        $resultado= mysql_query($consulta,$link) or die (mysql_error());     
        $json = array();    
        $i=0;
        while($row=mysql_fetch_array($resultado)){                                                           
            $json['data'][$i]['IDPedidos'] = '<a href="PedidoLinea.html?Pedido='.$row['DocNum'].'&Clinete='.$row['CardCode'].'" >'.$row['DocNum'].'</a>';
            $json['data'][$i]['IdCliente'] = $row['CardCode'];  
            $json['data'][$i]['NameCliente'] = utf8_encode($row['CardName']);  
            $json['data'][$i]['IDCreador'] = $obj ->SlpName($row['SlpCode']);  
            $json['data'][$i]['FechaPedido'] = $row['DocLastDateCred'];              
            $json['data'][$i]['Time'] = $row['ANIOS'].' Años '.$row['MESES'].' Mes '.$row['DIAS'].' Dia '.$row['HMS'];              
            if ($row['Estado']=="0") {
                $json['data'][$i]['StatusPedido'] = '<a class="btn btn-red waves-button waves-effect waves-light">PENDIENTE</a>';
            } else {
                $json['data'][$i]['StatusPedido'] = '<a class="btn btn-alt waves-button waves-effect waves-light">Ingresado</a>';
            }
            
            $i++;            
        }
        echo json_encode($json);
    }
    public static function InformacionPedido($ID){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consulta= "SELECT * FROM ordr WHERE DocNum='".$ID."'"; 
        $resultado= mysql_query($consulta,$link) or die (mysql_error());     
        $json = array();    
        $i=0;
        while($row=mysql_fetch_array($resultado)){                                                                       
            $json['dataPedido'][$i]['Referencia'] = $row['Referencia'];  
            $json['dataPedido'][$i]['DocDueDate'] = $row['DocDueDate'];              
            $i++;            
        }
        echo json_encode($json);
    }
    public static function ViewMasterSuperVisor(){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consulta= "SELECT * FROM onlp_orts WHERE Estado='1'"; 
        $resultado= mysql_query($consulta,$link) or die (mysql_error());     
        $json = array();    
        $i=0;
        while($row=mysql_fetch_array($resultado)){                                                           
             $json['data'][$i]['IDPedidos'] = '<a href="PedidoLinea.html?Pedido='.$row['DocNum'].'&Clinete='.$row['CardCode'].'" >'.$row['DocNum'].'</a>';
            $json['data'][$i]['IdCliente'] = $row['CardCode'];  
            $json['data'][$i]['NameCliente'] = utf8_encode($row['CardName']);  
            $json['data'][$i]['IDCreador'] =  $obj ->SlpName($row['SlpCode']);  
            $json['data'][$i]['FechaPedido'] = $row['DocLastDateCred'];              
            $json['data'][$i]['Time'] = $row['ANIOS'].' Años '.$row['MESES'].' Mes '.$row['DIAS'].' Dia '.$row['HMS'];              
            if ($row['Estado']=="0") {
                $json['data'][$i]['StatusPedido'] = '<a class="btn btn-red waves-button waves-effect waves-light">PENDIENTE</a>';
            } else {
                $json['data'][$i]['StatusPedido'] = '<a class="btn btn-alt waves-button waves-effect waves-light">Ingresado</a>';
            }
            
            $i++;            
        }
        echo json_encode($json);
    }
    public static function EliminarLine($id){
        $obj = new Vistas;
        $conn = $obj -> open_database_connectionMYSQL();            
        $SqlDeleteUser="Delete FROM tblfacturaslineas WHERE IdFactLine='".$id."'";
        mysql_query($SqlDeleteUser) or die(mysql_error());  

    }
     public static function EliminarPedido($id){
        $obj = new Vistas;
        $conn = $obj -> open_database_connectionMYSQL();                    
        $DeleteFactura="UPDATE ordr SET SlpCodeUpd='".$_SESSION['IdUser']."',Comment='Este Pedido Fue Cambiado al estado Eliminado por el Usuario #".$_SESSION['Rutas']."',Estado='6',DocLastDate = '".date('Y-m-d h:i:s')."' WHERE DocNum='".$id."'";
        mysql_query($DeleteFactura) or die(mysql_error());  
    }
    public static function PedidosLinea($id){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consulta= "SELECT * FROM rdr1 where DocNum='".$id."'"; 
        $resultado= mysql_query($consulta,$link) or die (mysql_error());     
        $json = array();    
        $i=0;
        while($row=mysql_fetch_array($resultado)){                                                           
            $json['data'][$i]['IdFactLine'] = $row['IDL'];  
            $json['data'][$i]['ItemCode'] = $row['ItemCode'];
            $json['data'][$i]['NameProducto'] = $row['Dscription'];
            $json['data'][$i]['Quantity'] = $row['Quantity'];
            $json['data'][$i]['unitMsr'] = $row['unitMsr'];
            $json['data'][$i]['Price'] = "C$ ".number_format($row['Price'],2);
            $json['data'][$i]['PriceLine'] = "C$ ".number_format($row['Quantity'] * $row['Price'],2);
            $i++;            
        }
        echo json_encode($json);
    }
    public static function PedidoBoucherLinea($id){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consulta= "SELECT * FROM rdr1 where DocNum='".$id."'"; 
        $resultado= mysql_query($consulta,$link) or die (mysql_error());     
                
        while($row=mysql_fetch_array($resultado)){ 

        echo '
         <tr>
            <td>'. $row['ItemCode'].'</td>
            <td>'.$row['Quantity'].'</td>
            <td>'.$row['unitMsr'].'</td>
            <td>'."C$ ".number_format($row['Price'],2).'</td>
            <td>'."C$ ".number_format($row['Quantity'] * $row['Price'],2).'</td>
          </tr>

          <tr>
            <td colspan="4" class="t1">'.$row['Dscription'].'</td>
          </tr>

        ';    

        }
        
    }
    public static function PedidoEstado($id){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consulta= "SELECT * FROM ordr where DocNum='".$id."'"; 
        $resultado= mysql_query($consulta,$link) or die (mysql_error());     
        $json = array();    
        $i=0;
        while($row=mysql_fetch_array($resultado)){                                                           
            $json['StadoPedido'][$i]['StatusPedido'] = $row['Estado'];              
            $json['StadoPedido'][$i]['DocEntry'] = $row['DocEntry'];              
            $i++;            
        }
        echo json_encode($json);
    }
    public static function LOG_OUT(){
        session_destroy();
        //echo '<script language = javascript> self.location = "index.php"</script>';      
    }
    public static function InformacionUsuario(){
        if (isset($_SESSION['NombreCompleto'])) {
            $json = array();

            $json['JsonCliente'][0]['IdUser'] =$_SESSION['IdUser']; 
            $json['JsonCliente'][0]['Nombre'] =$_SESSION['NombreCompleto']; 
            $json['JsonCliente'][0]['Privilegio'] =$_SESSION['Privilegio'];   
            $json['JsonCliente'][0]['Ruta']=$_SESSION['Rutas'];   
            $json['JsonCliente'][0]['Secion'] ="OK";
        }else{
            $json['JsonCliente'][0]['Secion'] ="APAGADA";
        }
        echo json_encode($json); 
    }
    public static function ValidarSession(){

        $pagina = "index";
        if (isset($_SESSION['Privilegio'])){ 
             switch ($_SESSION['Privilegio']) {
                case '0':                 
                 $pagina ="menu";
                break;
                case '1':                    
                    $pagina ="menu";
                break;
                case '2':                    
                    $pagina ="menu";
                break;
                case '3':                    
                    $pagina ="SAC";
                break;
                case '4':                    
                    $pagina ="SuperVisor";
                break;           

            }
            
            
        }
        echo $pagina;

        
    }

    public static function InformacionCLIENTE_SAP($CLS){
        $obj = new Vistas;
        $conn = $obj -> OPen_database_odbcSAp();  
        $query = 'SELECT * from SBO_INNOVA_INDUSTRIAS.MAC_MTCL where "CARDCODE"= '."'".$CLS."'".'';        
        $resultado =  odbc_exec($conn,$query);
        $json = array();  
        $i=0;      
        while ($row = odbc_fetch_array($resultado)){
            $json['InfoCLinete'][$i]['CLIENTE'] = $row['CARDCODE'];  
            $json['InfoCLinete'][$i]['NOMBRE'] =  utf8_encode($row['CARDNAME']);  
            $json['InfoCLinete'][$i]['DIRECCION'] = utf8_encode($row['ADDRESS']);                  
            $json['InfoCLinete'][$i]['TELEFONO1'] = utf8_encode($row['PHONE1']);                               
            $json['InfoCLinete'][$i]['TELEFONO2'] = utf8_encode($row['PHONE1']);   
            $json['InfoCLinete'][$i]['Celular'] = utf8_encode($row['CELLULAR']);                                                           
            $json['InfoCLinete'][$i]['LicTradNum'] = utf8_encode($row['LICTRADNUM']);                               
            $i++;

        }
        echo json_encode($json);
    }
    public static function JsonFACT($CLS){
        $obj = new Vistas;
        $conn = $obj -> OPen_database_odbcSAp();  
        $query = 'SELECT * from SBO_INNOVA_INDUSTRIAS.MAC_SNPD where "CODIGO"= '."'".$CLS."'".'';        
        
        $resultado =  odbc_exec($conn,$query);
        $json = array();  
        $i=0;      
        while ($row = odbc_fetch_array($resultado)){            
            $json['dataDetalle'][$i]['PEDIDO'] =  utf8_encode($row['PEDIDO']);  
            $json['dataDetalle'][$i]['TOTAL'] = utf8_encode($row['TOTAL']);                              
            $json['dataDetalle'][$i]['FECHA_CREADA'] = substr(utf8_encode($row['FECHA_CREADA']), 0,10);                              
            $json['dataDetalle'][$i]['FECHA_ENTREGA'] = substr(utf8_encode($row['FECHA_ENTREGA']), 0,10);                              
            $i++;

        }
        echo json_encode($json);
    }
    public static function JsonFACTLinea($CLS){
        $obj = new Vistas;
        $conn = $obj -> OPen_database_odbcSAp();  
        $query = 'SELECT * from SBO_INNOVA_INDUSTRIAS.MAC_SNDT where "CODIGO"= '."'".$CLS."'".'';        
        
        $resultado =  odbc_exec($conn,$query);
        $json = array();  
        $i=0;      
        while ($row = odbc_fetch_array($resultado)){            
            $json['dataDetalle'][$i]['ARTICULO'] =  utf8_encode($row['ARTICULO']);  
            $json['dataDetalle'][$i]['DESCRIPCION'] = utf8_encode($row['DESCRIPCION']);                              
            $json['dataDetalle'][$i]['UNIDAD'] = utf8_encode($row['UNIDAD']);                              
            $json['dataDetalle'][$i]['CANTIDAD'] = utf8_encode($row['CANTIDAD']);                              
            $json['dataDetalle'][$i]['PRECIO'] = utf8_encode($row['PRECIO']);                              
            $json['dataDetalle'][$i]['TOTAL'] = utf8_encode($row['TOTAL']);                              
            $i++;

        }
        echo json_encode($json);
    }
     public static function InformacionCLIENTE_MYSQL($CLS){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consulta= "SELECT * FROM ocrd where IdCl='".$CLS."'"; 
        $resultado= mysql_query($consulta,$link) or die (mysql_error());     
        $json = array();    
        $i=0;
        while($row=mysql_fetch_array($resultado)){                                                                       
            $json['InfoCLinete'][$i]['CLIENTE'] = $row['IdCl'];  
            $json['InfoCLinete'][$i]['NOMBRE'] = $row['Nombre'];  
            $json['InfoCLinete'][$i]['DIRECCION'] = $row['Direccion'];                  
            $json['InfoCLinete'][$i]['TELEFONO1'] = $row['Telefono'];                               
            $json['InfoCLinete'][$i]['TELEFONO2'] = $row['Telefono2'];                               
            $json['InfoCLinete'][$i]['Celular'] = $row['Celular'];                               

            $i++;            
        }
        echo json_encode($json);
        
    }
     public static function InformacionPEdidoCLiente($PRV){
        $obj = new Vistas;
        $link = $obj ->open_database_connectionMYSQL();
        $consulta= "SELECT * FROM ordr where DocNum='".$PRV."'"; 
        $resultado= mysql_query($consulta,$link) or die (mysql_error());     
        $json = array();    
        $i=0;
        while($row=mysql_fetch_array($resultado)){                                                                       
            $json['PedisCLS'][$i]['CardCode'] = $row['CardCode'];  
            $json['PedisCLS'][$i]['Mnt'] = $row['Mnt'];  
            
            $i++;            
        }
        echo json_encode($json);
        
    }
    public static function CXCCliente($id){
        $obj = new Vistas;
        $conn = $obj -> open_database_connectionSQL();          
        $tsql = "SELECT * FROM dbo.CxCUMK_AGRUPADO where CLIENTE='".$id."'";
        $params = array();
        $Saldo="";
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_query( $conn, $tsql , $params, $options );          
        if(sqlsrv_num_rows($stmt)){            
            while($row=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){                                                           
                $Saldo = $row['SALDO_CLIENTE'];                 
            }
        }    

    if ($Saldo==null) {
        $Saldo="0.00";
    }
    
    return $Saldo;
    }
}
?>