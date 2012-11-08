<?php 
session_start();
$status = "";
$total_sms=0;

if ($_POST["action"] == "upload") {
	// obtenemos los datos del archivo 
	$tamano = $_FILES["archivo"]['size'];
	$tipo = $_FILES["archivo"]['type'];
	$archivo = $_FILES["archivo"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	
	if ($archivo != "") {
		// guardamos el archivo a la carpeta files
		$destino =  "files/".$prefijo."_".$archivo;
		$nombre=$prefijo."_".$archivo;
		if (copy($_FILES['archivo']['tmp_name'],$destino)) {
		
			$total_sms=cuenta_sms($nombre);	
			//$status = "Archivo subido: <b>".$archivo."</b>";
			header("Location:configura_simple.php?status=OK&archivo=".$archivo."&total_sms=".$total_sms);
		} else {
			//$status = "Error al subir el archivo";
			header("Location:configura_simple.php?status=error&archivo=".$archivo);
		}
	} else {
		$status = "Error al subir archivo";
	}
}

function cuenta_sms($nombre){
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';


$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objReader->setReadDataOnly(true);
$nombre="files/".$nombre;
$objPHPExcel = $objReader->load($nombre);
$objWorksheet = $objPHPExcel->getActiveSheet();


foreach ($objWorksheet->getRowIterator() as $row) {


		
  $cellIterator = $row->getCellIterator();
  $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
                                                     // even if it is not set.
                                                     // By default, only cells                                                     // that are set will                                                     // iterated.
  foreach ($cellIterator as $cell) {
    $total=$total+1;

  }
  

}
$_SESSION['nombre_archivo']=$nombre;

return $total;

}
?>
