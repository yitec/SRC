<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SRC</title>
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />
<style>
a {color: #CCC } 
a:hover {color: #CCC} 
</style>
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Administrador</div><div align="right"><img src="img/yitec.png" /></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g"></div>
<div align="center"    class="contenido_gm">
<div style="margin-left:700px;" class="Arial10gris"><a href="menu.php">Volver</a>&nbsp;-&nbsp;<a href="login.php">Salir</a></div>
<div id="mainAzulFondo" style="padding: 20px; margin-top:80px; width:400px;">
<div id="mainBlancoFondo">
	<div align="center">
		<img src="img/PASO1.jpg" />
	</div>
    <br /><br />

	
  
  
  <table><tr>
  <td><div class="Arial18Azul">
 Seleccione un archivo de excel para subir</div>
  </td> 
  </tr>
    </table>
    <br />
  <form action="upload.php" method="post" enctype="multipart/form-data">
  <input name="archivo" type="file" size="35" />
  <input name="enviar" type="submit" value="Subir Archivo" />
  <input name="action" type="hidden" value="upload" />     
</form>
	<br />
  	
</div><!--Fin cuadro Blanco-->
</div><!--Fin cuadro azul-->







</div><!--fin contenido gm-->

<div class="der_lat_g"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g"></div>
<div class="der_inf_g"></div>

<div align="center">
<?
require_once('footer.php');
?>
</div>
</td></tr></table>

</div>




</body>

</html>
