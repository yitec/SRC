<?
session_start();
require_once('../cnx/conexion.php');
conectar();
$hoy=date("Y-m-d H:i:s");
$ano=substr($_REQUEST['fecha_ini'], 0, 4);
$mes=substr($_REQUEST['fecha_ini'], 5, 2);
$dia=substr($_REQUEST['fecha_ini'], 8, 2);
 
$fecha_ini=$ano."-".$mes."-".$dia." ".$_REQUEST['cmb_ini'].":00";


$ano=substr($_REQUEST['fecha_fin'], 0, 4);
$mes=substr($_REQUEST['fecha_fin'], 5, 2);
$dia=substr($_REQUEST['fecha_fin'], 8, 2);

$fecha_fin=$ano."-".$mes."-".$dia." ".$_REQUEST['cmb_fin'].":00";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
a {color: #CCC } 
a:hover {color: #CCC} 
</style>
<script src="../includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="../includes/datetimepicker_css.js"></script>
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

<div align="center" class="Arial24Azul">SMS entre fechas</div>
<br />
 <form action="listado_x_fechas.php"> 
 <table>
    
    <tr>
    <td class="Arial14Negro">Fecha Inicio:</td>
    <td><input type="Text" name="fecha_ini" class="inputbox" id="fecha_ini" maxlength="20" size="20"/>     <img src="../img_calendar/cal.gif" onClick="javascript:NewCssCal('fecha_ini')" style="cursor:pointer"/></td>
    </tr>
    <tr>
    <td class="Arial14Negro">Fecha Fin:</td>
    <td><input type="Text" class="inputbox" id="fecha_fin" name="fecha_fin" maxlength="20" size="20"/>     <img src="../img_calendar/cal.gif" onClick="javascript:NewCssCal('fecha_fin')" style="cursor:pointer"/></td>
    </tr>
    <tr>
    <td class="Arial14Negro">Hora Inicio:</td>
    <td><label>
      <select class="combos" name="cmb_ini" id="cmb_ini">
      <option>00:00</option>
      <option>01:00</option>
      <option>02:00</option>
      <option>03:00</option>
      <option>04:00</option>
      <option>05:00</option>                        
      <option>06:00</option>
      <option>07:00</option>      
      <option>08:00</option>
      <option>09:00</option>
      <option>10:00</option>
      <option>11:00</option>
      <option>12:00</option>
      <option>13:00</option>
      <option>14:00</option>
      <option>15:00</option>
      <option>16:00</option>
      <option>17:00</option>
      <option>18:00</option>
      <option>19:00</option>
      <option>20:00</option>
      <option>21:00</option>
      <option>22:00</option>
      <option>23:00</option>
      </select>
    </label></td>
    </tr>
    <tr>
    <td class="Arial14Negro">Hora F&iacute;n:</td>
    <td><label>
      <select class="combos" name="cmb_fin" id="cmb_fin">
      <option>00:00</option>
      <option>01:00</option>
      <option>02:00</option>
      <option>03:00</option>
      <option>04:00</option>
      <option>05:00</option>                        
      <option>06:00</option>
      <option>07:00</option>      
      <option>08:00</option>
      <option>09:00</option>
      <option>10:00</option>
      <option>11:00</option>
      <option>12:00</option>
      <option>13:00</option>
      <option>14:00</option>
      <option>15:00</option>
      <option>16:00</option>
      <option>17:00</option>
      <option>18:00</option>
      <option>19:00</option>
      <option>20:00</option>
      <option>21:00</option>
      <option>22:00</option>
      <option>23:00</option>

      </select>
    </label> <input name="opcion" type="hidden" value="1" /></td>
    </tr>
    
    
    
    </table>
 <br />
  <input type="image" name="btn_generar" id="btn_generar" src="../img/btn_generar.png" />
 </form>
    <br />
    <div align="center"  id="Exportar_a_Excel">
    <table width="830" class="table_td" border="0" cellpadding="0" cellspacing="0">
   
    	<tr>
        	<td width="118"   background="img/fondo1_grid.png" class="Arial14Morado" align="center">N&uacute;mero</td>
        	<td width="129"  background="img/fondo1_grid.png" class="Arial14Morado" align="center">Mensaje</td>
            <td width="155"  background="img/fondo1_grid.png" class="Arial14Morado" align="center">Resultado</td>            <td width="110"  background="img/fondo1_grid.png" class="Arial14Morado" align="center">Fecha envio</td>            
                        <td width="110"  background="img/fondo1_grid.png" class="Arial14Morado" align="center">Estado</td>            
            
    	</tr>
        
<?
$enviados=0;
$pendientes=0;


	
$result=mysql_query(utf8_decode("select * from tbl_mensajes where id_campaing='".$row2['id']."' and fecha_envio>='".$fecha_ini."' and fecha_envio<='".$fecha_fin."'"));   
while($row=mysql_fetch_assoc($result)){
	

?>     
        <tr>
        	<td class="table_td"><div  align="center" id="r1" class="Arial11Negro"><?=$row['numero']?></div></td>
			<td class="table_td"><div align="center" id="r3" class="Arial11Negro"><?=$row['mensaje']?></div></td>
            <td class="table_td"><div  align="center" id="r2" class="Arial11Negro"><?=$row['resultado']?></div></td>
            <td class="table_td"><div  align="center" id="r4" class="Arial11Negro"><?=$row['fecha_envio']?></div></td>
            <td class="table_td"><div  align="center" id="r4" class="Arial11Negro"><?
			if($row['estado']==1){
				echo "Enviado";
				$enviados++;
			}else{
				echo "Pendiente";
				$pendientes++;
			}
				
			?></div></td>
        </tr>
<?
}//endo while 1

?>
    </table>
    <div align="center" class="Arial14Morado">Total = <?=$enviados+$pendientes;?> </div>
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

<div align="center" ><?
require_once('../footer.php');
?>
</div>
</td></tr></table>

</div>




</body>

</html>
