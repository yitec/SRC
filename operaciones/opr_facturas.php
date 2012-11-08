<?php
session_start();
require_once('../cnx/conexion.php');
conectar();
$hoy=date("Y-m-d H:i:s");
//guarda un articulo en inventario
$dia=substr($_REQUEST['txt_fecha'], 3, 2);
$ano=substr($_REQUEST['txt_fecha'], 6, 4);
$mes=substr($_REQUEST['txt_fecha'], 0, 2);

$fecha=$ano."-".$mes."-".$dia." ".$_GET['cmb_ini'].":00";

if($_REQUEST['opcion']==1)
{

//busco si no existe el usuario
$result=mysql_query("select numero_factura from tbl_facturas where numero_factura='".$_REQUEST['txt_numero']."'");
$total=mysql_num_rows($result);
if($total>0){
	echo "repetido";
}else{
	$query="insert into tbl_facturas(id_empresa,numero_factura,mes,fecha_vencimiento,monto,estado)values('".$_REQUEST['cmb_empresa']."','".$_REQUEST['txt_numero']."','".$_REQUEST['cmb_mes']."','".$_REQUEST['fecha_ven']."','".$_REQUEST['txt_monto']."','"."0"."')";
	$result = mysql_query($query);	
	if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
	}
	echo "Success";
}

}//end if opcion 1



//Consultar usuarios
if($_REQUEST['opcion']==2)
{
	
	
	$result=mysql_query("select * from tbl_facturas where numero_factura='".$_REQUEST['factura']."'");
	$row=mysql_fetch_assoc($result);
	if (mysql_num_rows($result)>=1){
		
			$result2=mysql_query("select nombre from tbl_empresas where id='".$row['id_empresa']."'");
			$row2=mysql_fetch_assoc($result2);
		
	echo utf8_encode($row2['nombre'])."|".$row['numero_factura']."|".$row['mes']."|".$row['fecha_vencimiento']."|".$row['monto'] ; 	}else{
		echo "error";
	}
	
	desconectar();
}//end if opcion 2


//modificar factura
if($_REQUEST['opcion']==3)
{		
$result=mysql_query("update tbl_facturas set metodo_pago='".$_REQUEST['cmb_tipo']."',fecha_pago='".$_REQUEST['fecha_pago']."',estado='".$_REQUEST['cmb_estado']."' where numero_factura='".$_REQUEST['txt_factura_buscar']."'");


if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
} 
echo "Success";
desconectar();
}//end if opcion 3


if($_REQUEST['opcion']==4)
{		
	$result=mysql_query("delete from tbl_facturas where numero='".$_REQUEST['txt_factura_buscar']."'");
	

	if (!$result) {//si da error que me despliegue el error del query
		   echo $message  = 'Query invalido: ' . mysql_error() . "\n";
			$message .= 'Query ejecutado: ' . $query;
			
	} 
desconectar();
}//end if opcion 4

if($_REQUEST['opcion']==5)
{

	$result=mysql_query("select * from tbl_empresas	 ");
	while ($row=mysql_fetch_assoc($result)){
		$vector=$vector.",".utf8_encode($row['nombre']); 
	}
	echo $vector;
	desconectar();


}//end if opcion 6



	

?>