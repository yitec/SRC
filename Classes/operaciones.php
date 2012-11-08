<?php
session_start();
require_once('../cnx/conexion.php');
conectar();

if($_GET['opcion']==1)
{
	
echo $fecha_ini=$_GET['fecha_ini'];
$dia=substr($fecha_ini, 3, 2);
$ano=substr($fecha_ini, 6, 4);
$mes=substr($fecha_ini, 0, 2);

$fecha_ini=$ano."-".$mes."-".$dia;


$fecha_fin=$_GET['fecha_fin'];	
$dia=substr($fecha_fin, 3, 2);
$ano=substr($fecha_fin, 6, 4);
$mes=substr($fecha_fin, 0, 2);
$fecha_fin=$ano."-".$mes."-".$dia;
	
$query="insert into tbl_campaing (id_usuario,id_empresa,nombre,fecha_ini,fecha_fin,total_sms,estado)values('".$_SESSION['usuario']."','".$_SESSION['empresa']."','".$_GET['txt_nombre']."','".$fecha_ini."','".$fecha_fin."','".$_SESSION['total_sms']."','"."1"."')";




$result = mysql_query($query);	
//mysql_fetch_assoc($result);
if (!$result) {//si da error que e despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
}


$result = mysql_query("select MAX(id) from tbl_campaing");	

$row = mysql_fetch_assoc($result);
$id_campaing=$row['id'];

//llena los datos del xcel a la tabla de envio
set_include_path(get_include_path() . PATH_SEPARATOR . '../Classes/');
/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objReader->setReadDataOnly(true);
$nombre="../files/".$nombre;
$objPHPExcel = $objReader->load($nombre);
$objWorksheet = $objPHPExcel->getActiveSheet();

foreach ($objWorksheet->getRowIterator() as $row) {		
  $cellIterator = $row->getCellIterator();
  $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
  foreach ($cellIterator as $cell) {
    
	$result = mysql_query("inser into tbl_mensajes (id_campaing,numero,estado)values('".$id_campaing."','".$cell->getValue()."','"."0"."')");	
	
	
	
	
	if (!$result) {//si da error que e despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
	} 

  }
}


//header("Location:resultado.php");

		
	
}//end if opcion 1


?>