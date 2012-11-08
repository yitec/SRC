<?php
/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';


$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objReader->setReadDataOnly(true);

$objPHPExcel = $objReader->load("test.xlsx");
$objWorksheet = $objPHPExcel->getActiveSheet();


foreach ($objWorksheet->getRowIterator() as $row) {


		
  $cellIterator = $row->getCellIterator();
  $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
                                                     // even if it is not set.
                                                     // By default, only cells
                                                     // that are set will be
                                                     // iterated.
  foreach ($cellIterator as $cell) {
    $total=$total+1;

  }
  

}
echo '</table>' . "\n";
echo 'total='.$total
?>
