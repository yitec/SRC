<?
session_start();
require_once('../cnx/conexion.php');
conectar();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
a {color: #CCC } 
a:hover {color: #CCC} 
</style>
<script src="../includes/jquery-1.6.1.js" type="text/javascript"></script>
<script language="javascript">
$(document).ready(function() {

	$(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
});
</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SRC</title>
<link href="../css/cuadros.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />



</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g" style="width:1000px;"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Administrador</div><div align="right"><img src="../img/yitec.png" /></div> </div>
<div class="der_sup_g" style="margin-left:1001px;"></div>
<div class="lineaAzul" style="width:1008px;"></div>
<div class="izq_lat_g" style="height:5000px;"></div>
<div align="center"    class="contenido_gm">

<div id="mainAzulFondo" style="padding: 20px; margin-top:80px; width:860px;">
<div id="mainBlancoFondo" style="width:840px;">
<br />

<div align="center" class="Arial24Azul">Listado de Pagos</div>
<br />
    <br />
    <div align="center"  id="Exportar_a_Excel">
    <table width="830" class="table_td" border="0" cellpadding="0" cellspacing="0">
   
    	<tr>
        	<td width="118"   background="img/fondo1_grid.png" class="Arial14Morado" align="center">Factura</td>
        	<td width="129"  background="img/fondo1_grid.png" class="Arial14Morado" align="center">Mes</td>
                    	<td width="129"  background="img/fondo1_grid.png" class="Arial14Morado" align="center">Monto</td>
            <td width="155"  background="img/fondo1_grid.png" class="Arial14Morado" align="center">Fecha vencimiento</td>            <td width="110"  background="img/fondo1_grid.png" class="Arial14Morado" align="center">Fecha Pago</td>            
             <td width="110"  background="img/fondo1_grid.png" class="Arial14Morado" align="center">Estado</td>            
            
    	</tr>
        
<?
$enviados=0;
$pendientes=0;
$result=mysql_query("select * from tbl_facturas where id_empresa='".$_SESSION['empresa']."'");   
while($row=mysql_fetch_assoc($result)){
//Cambio el formato a la fecha


$ano=substr($row['fecha_vencimiento'], 0, 4);
$mes=substr($row['fecha_vencimiento'], 5, 2);
$dia=substr($row['fecha_vencimiento'], 8, 2);
$horas=substr($row['fecha_vencimiento'], 10, 10);



$fechav=$dia."-".$mes."-".$ano." ".$horas;

$ano=substr($row['fecha_pago'], 0, 4);
$mes=substr($row['fecha_pago'], 5, 2);
$dia=substr($row['fecha_pago'], 8, 2);
$horas=substr($row['fecha_pago'], 10, 10);



$fechap=$dia."-".$mes."-".$ano." ".$horas;
	

?>     
        <tr>
        	<td class="table_td"><div  align="center" id="r1" class="Arial11Negro"><?=$row['numero_factura']?></div></td>
			<td class="table_td"><div align="center" id="r3" class="Arial11Negro"><?=$row['mes']?></div></td>
            <td class="table_td"><div  align="center" id="r2" class="Arial11Negro"><?=$row['monto']?></div></td>
            <td class="table_td"><div  align="center" id="r4" class="Arial11Negro"><?=$fechav?></div></td>
            <td class="table_td"><div  align="center" id="r4" class="Arial11Negro"><?=$fechap?></div></td>
            
            <td class="table_td"><div  align="center" id="r4" class="Arial11Negro"><?
			if($row['estado']==1){
				echo "Cancelada";

			}else{
				echo "Pendiente";

			}
				
			?></div></td>
        </tr>
<?
}
?>
    </table>
    </div>
  <br />
  <br />
  <form action="reporte_xcel.php" method="post" target="_blank" id="FormularioExportacion">
<p class="Arial11Negro" align="right">Exportar a Excel  <img src="../img/xcel.png" class="botonExcel" width="28" height="28" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>    

  
</div><!--Fin Blanco-->
</div><!--Fin Azul-->

</div>
<div class="der_lat_g" style="margin-left:1000px; height:5000px;"></div>
<div align="center">
<?
require_once("../footer.php");
?>
</div>
</td></tr></table>

</div>




</body>

</html>
