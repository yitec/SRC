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
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Administrador</div><div align="right"><img src="img/yitec.png" /></div> 
</div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g"></div>
<div    class="contenido_gm">

<div align="right" style="float:left" class="Arial8negro">Usuario=&nbsp; </div><div align="right" style="float:left" class="Arial8azul"><?=$_SESSION['nombre_usuario'];?>&nbsp;&nbsp;</div><div align="right" style="float:left" class="Arial8negro"> Empresa= &nbsp;</div><div align="right" style="float:left" class="Arial8azul"><?=$_SESSION['nombre_empresa'];?></div><br />
<div align="center" class="Arial24Azul">Sistema Recordatorio de Citas</div>
<br /><br /><br />
<?
include('menu_central.php');
?>
<br /><br />

<div align="center" class="Arial18Azul">Seleccione una de las opciones</div>

<div style="margin-left:700px;  margin-top:186px; " class="Arial10gris"><a href="login.php">Salir</a></div>
</div>
<div class="der_lat_g"></div>
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
