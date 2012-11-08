<?
session_start();
include ('cnx/conexion.php');
conectar();
require_once('cnx/session_activa.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>..::SRC::..</title>
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />

<link href="css/jquery.pnotify.default.css" rel="stylesheet" type="text/css" />
<link href="css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />

<script src="includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="includes/datetimepicker_css.js"></script>

<script src="includes/jquery.ui.core.js"></script>
<script src="includes/jquery.ui.widget.js"></script>
<script src="includes/jquery.ui.autocomplete.js"></script>
<script src="includes/jquery.ui.position.js"></script>

<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="includes/Scripts_Usuarios.js" type="text/javascript"></script> 
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>

</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Usuarios</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style=" height:2800px;"></div>
<div    class="contenido_gm">


<?
require_once('menu_superior.php');
?>

<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">
	<div class="Arial14Negro"  style="margin-left:550px; float:left; margin-top:5px;   ">Usuario:</div>
    <div class="ui-widget" style="float:left;"><input class="inputboxPequeno" size="10" id="txt_usuario_buscar" name="txt_usuario" type="text"  /></div>
    <input name="btn_buscar" id="btn_buscar" type="image" src="img/search.png" />

	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Informaci&oacute;n General</div>
    
	<table>
    
    <tr>
    	<td class="Arial14Morado">Nombre</td>
    	<td class="Arial14Morado">Apellidos</td> 
        <td class="Arial14Morado">C&eacute;dula</td>               
    </tr>
    <tr>
    	<td height="34" class="Arial14Negro"><input name="txt_nombre" id="txt_nombre" class="inputbox" type="text" /><input id="opcion" name="opcion" type="hidden" value="1" /></td>
    	<td class="Arial14Negro"><input name="txt_apellidos" id="txt_apellidos" class="inputbox" type="text" /></td>        
    	<td class="Arial14Negro"><input name="txt_cedula" id="txt_cedula" class="inputbox" type="text" /></td>                
    </tr>
	<tr>
    	<td class="Arial14Morado">Usuario</td>
    	<td class="Arial14Morado">Password</td> 
        <td class="Arial14Morado">Fecha Caducidad</td>               
    </tr>
    <tr>
    	<td class="Arial14Negro"><input name="txt_usuario" id="txt_usuario" class="inputbox" type="text" /></td>
    	<td class="Arial14Negro"><input name="txt_pass" id="txt_pass" class="inputbox" type="password" /></td>        
        <td class="Arial14Negro"><input name="txt_fecha" id="txt_fecha" class="inputbox" type="text" /><img src="img_calendar/cal.gif" onClick="javascript:NewCssCal('txt_fecha')" style="cursor:pointer"/></td>        
    </tr>    
    </table>
    
    <table width="740" >
    <tr>
    	<td width="202" align="center" class="Arial18Azul">Permisos</td>
    </tr>
    </table>
    <table width="740">
      <tr>
      <td align="center" ><img src="img/azul.jpg" width="460" height="1" /></td></tr>
</table>
    
    <table width="740" >
      <tr>
    <td width="109" height="27" class=" Arial14Azul">Reportes=</td>
    	<td width="167" class="Arial14Negro"><input class="ck" name="chk_reportes" id="chk_reportes" type="checkbox" value="" />Activar 
    	  </td>
        <td width="355" class=" Arial10Negro"><div id="reportes" class="checkboxReportes">
        <div align="" class="Arial14Azul">Marcar Todos<input id="chk_todosReporte" type="checkbox" value="" /></div><br />
    	  <? 
		  	$cont=1;
			$result=mysql_query("select * from tbl_reportes where estado='"."1"."'");
			while ($row=mysql_fetch_assoc($result))
			{	
				$numero=2;
				$res = ($cont % $numero);
			
				
					echo '<div style=" width:400px;"><input type="checkbox" class="rp" onclick="agregaReporte('.$row['id'].')" name="CheckboxGroupReportes" value="'.$row['id'].'" id="CheckboxGroupReportes_'.$cont.'" />'.utf8_encode($row['nombre']).'</div><br>';
				
		  ?>
    	    
           <?
		   $cont++;
		   }//end while
		   ?>
    	</div></td>
        <td width="89" class="Arial14Negro">&nbsp;</td>
    </tr>
  </table>
    <table width="740">
      <tr>
      <td align="center"><img src="img/azul.jpg" width="460" height="1" /></td></tr>
</table>
    <table width="740" >
    <tr>
      <td width="114" class="Arial14Azul">General=</td>
    	
        <td width="204" class="Arial14Negro"><input class="ck" name="chk_usuarios" id="chk_usuarios" type="checkbox" value="" />Mantenimiento Usuarios</td>
        <td width="213" class="Arial14Negro"><input class="ck" name="chk_clientes" id="chk_empresas" type="checkbox" value="" />
        Mantenimiento Empresas</td>
        <td width="213" class="Arial14Negro"><input class="ck"  id="chk_pagos" type="checkbox" value="" />
          Mantenimiento Pagos</td>
    </tr>  
    <tr>
      <td width="114" class="Arial14Azul"></td>
    	<td width="204" class="Arial14Negro"><input class="ck" id="chk_simple" type="checkbox" value="" />
    	Crear campaña simple</td>
       <!-- <td width="189" class="Arial14Negro"><input class="ck"  id="chk_mMuestras" type="checkbox" value="" />Mantenimiento Muestras</td>-->
        <td width="213" class="Arial14Negro"><input class="ck"  id="chk_variable" type="checkbox" value="" />
        Crear campaña variable</td>
        <td width="213" class="Arial14Negro"><input class="ck"  id="chk_detener" type="checkbox" value="" />
        Detener campaña</td>
    </tr>          
    </table>
<div align="center" style="margin-top:20px; margin-bottom:20px;"><input name="btn_guardar" id="btn_guardar" type="image" src="img/btn_guardar.png" /><input name="btn_eliminar" id="btn_eliminar" type="image" src="img/btn_eliminar.png" /></div>    

</div><!--fin cuadro gris--> 
</div><!--fin cuadro gris--> 




</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:2800px;"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g"></div>
<div class="der_inf_g"></div>

<?
require_once('footer.php');
?>

</td></tr></table>

</div>




</body>

</html>
