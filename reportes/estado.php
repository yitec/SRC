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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SRC</title>
<link href="../css/cuadros.css" rel="stylesheet" type="text/css" />
<script src="../includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="../includes/Scripts_Reportes.js" type="text/javascript"></script> 

</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Administrador</div><div align="right"><img src="../img/yitec.png" /></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g"></div>
<div align="center"    class="contenido_gm">

<div id="mainAzulFondo" style="padding: 20px; margin-top:80px; width:600px;">
<div id="mainBlancoFondo" style="width:570px;">
<br />

<div align="center" class="Arial24Azul">Estado de Campa&ntilde;a</div>
<br />
  
  <table>
  <tr>
  	<td class="Arial14Negro">Seleccione la Campa&ntilde;a:</td>
    <td><select class="combos" id="cmb_campaing">
    	<option>Seleccione</option>
    	<? $result=mysql_query("select * from tbl_campaing where  id_usuario='".$_SESSION['usuario']."'");
			while($row=mysql_fetch_assoc($result))
			{
					echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
			}
		?>
    	</select>
    </td>
  </tr>
    </table>
    <br />
    <table width="514" cellpadding="0" cellspacing="0">
    	<tr>
        	<td width="118"  background="img/fondo1_grid.png" class="Arial14Morado" align="center">Total SMS</td>
        	<td width="129"  background="img/fondo1_grid.png" class="Arial14Morado" align="center">Total Enviados</td>
            <td width="155"  background="img/fondo1_grid.png" class="Arial14Morado" align="center">Total Pendientes</td>            <td width="110"  background="img/fondo1_grid.png" class="Arial14Morado" align="center">Estado</td>            
            
    	</tr>
        <tr>
        	<td><div  align="center" id="r1" class="Arial14Negro">0</div></td>
			<td><div align="center" id="r3" class="Arial14Negro">0</div></td>
            <td><div  align="center" id="r2" class="Arial14Negro">0</div></td>
            <td><div  align="center" id="r4" class="Arial14Negro"></div></td>
        </tr>
    </table>
  <br />
  <br />
  
</div><!--Fin Blanco-->
</div><!--Fin Azul-->

</div>
<div class="der_lat_g"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g"></div>
<div class="der_inf_g"></div>

<div align="center" >
<?
require_once('../footer.php');
?>
</div>
</td></tr></table>

</div>




</body>

</html>
