<?php
session_start();
require_once('cnx/conexion.php');
conectar();

$fecha_ini=$_REQUEST['fecha_ini'];	
$dia=substr($fecha_ini, 3, 2);
$ano=substr($fecha_ini, 6, 4);
$mes=substr($fecha_ini, 0, 2);

$fecha_ini=$ano."-".$mes."-".$dia." ".$_REQUEST['cmb_ini'].":00";


$fecha_fin=$_REQUEST['fecha_fin'];	
$dia=substr($fecha_fin, 3, 2);
$ano=substr($fecha_fin, 6, 4);
$mes=substr($fecha_fin, 0, 2);
$fecha_fin=$ano."-".$mes."-".$dia." ".$_REQUEST['cmb_fin'].":00";

if($_REQUEST['opcion']==1)
{
	


	
$query="insert into tbl_campaing (id_usuario,id_empresa,nombre,fecha_ini,fecha_fin,mensaje,total_sms,tipo,estado)values('".$_SESSION['usuario']."','".$_SESSION['empresa']."','".$_REQUEST['txt_nombre']."','".$fecha_ini."','".$fecha_fin."','".$_REQUEST['txt_mensaje']."','".$_REQUEST['txt_total']."','"."1"."','"."0"."')";




$result = mysql_query(utf8_decode($query));	
//mysql_fetch_assoc($result);
if (!$result) {//si da error que e despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
}


$result = mysql_query("select MAX(id) as id from tbl_campaing");	
if (!$result) {//si da error que e despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
}

$row = mysql_fetch_assoc($result);

$id_campaing=$row['id'];



//llena los datos del xcel a la tabla de envio
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objReader->setReadDataOnly(true);

$objPHPExcel = $objReader->load($_SESSION['nombre_archivo']);
$objWorksheet = $objPHPExcel->getActiveSheet();

foreach ($objWorksheet->getRowIterator() as $row) {		
  $cellIterator = $row->getCellIterator();
  $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
  foreach ($cellIterator as $cell) {
    
	$result = mysql_query("insert into tbl_mensajes (id_campaing,mensaje,numero,estado)values('".$id_campaing."','".$_REQUEST['txt_mensaje']."','".$cell->getValue()."','"."0"."')");	
	
	
	
	
	if (!$result) {//si da error que e despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
	} 

  }
}




		
	
}//end if opcion 1

if($_POST['opcion']==2)
{
	
	$result=mysql_query("select c.total_sms,c.estado,(Select Count(numero)as totalp from tbl_mensajes where estado='0' and id_campaing='".$_POST['campaing']."') as pendientes,(Select Count(numero)as totale from tbl_mensajes where estado='1' and id_campaing='".$_POST['campaing']."') as enviados from tbl_campaing c where id='".$_POST['campaing']."'");
$row = mysql_fetch_object($result); 
$jsondata['total'] = $row->total_sms; 
$jsondata['pendientes'] = $row->pendientes; 
$jsondata['enviados'] = $row->enviados; 
$jsondata['estado'] = $row->estado; 


mysql_free_result($result);

echo json_encode($jsondata);

	
}//end opcion 2


if($_REQUEST['opcion']==3)
{
	


	
$query="insert into tbl_campaing (id_usuario,id_empresa,nombre,fecha_ini,fecha_fin,mensaje,total_sms,tipo,estado)values('".$_SESSION['usuario']."','".$_SESSION['empresa']."','".$_REQUEST['txt_nombre']."','".$fecha_ini."','".$fecha_fin."','".$_REQUEST['txt_mensaje']."','".$_REQUEST['txt_total']."','"."2"."','"."0"."')";




$result = mysql_query($query);	
//mysql_fetch_assoc($result);
if (!$result) {//si da error que e despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
}


$result = mysql_query("select MAX(id) as id from tbl_campaing");	
if (!$result) {//si da error que e despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
}

$row = mysql_fetch_assoc($result);

$id_campaing=$row['id'];



//llena los datos del xcel a la tabla de envio
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objReader->setReadDataOnly(true);

$objPHPExcel = $objReader->load($_SESSION['nombre_archivo']);
$objWorksheet = $objPHPExcel->getActiveSheet();
$highestRow = $objWorksheet->getHighestRow(); // e.g. 10
$highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'

$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5




 $highestRow = $objWorksheet->getHighestRow(); // e.g. 10
$highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'

$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5


for ($row = 1; $row <= $highestRow; ++$row) {

	  
	$result = mysql_query("insert into tbl_mensajes (id_campaing,mensaje,numero,estado)values('".$id_campaing."','".$objPHPExcel->getActiveSheet()->getCell('B'.$row)->getValue()."','".$objPHPExcel->getActiveSheet()->getCell('A'.$row)->getValue()."','"."0"."')");	



}



		
	
}//end if opcion 3


//*****************************************busco un nombre de campaña para ver si esta repetido********************
//*****************************************Invocado por=configura_simple.php/configura_variable.php****************
//*****************************************************************************************************************

if($_REQUEST['opcion']==4)
{
	$result = mysql_query("select nombre from tbl_campaing where nombre='".$_REQUEST['txt_nombre']."'");
	
	if (mysql_num_rows($result)>0){
		$jsondata['encontrado']=1;	
	}else{
		$jsondata['encontrado']=0;	
	}
	
	mysql_free_result($result);

echo json_encode($jsondata);
	
}


?>