<?
session_start();
?>
<style>
a:visited{
	text-decoration:none;
	font-size:14px;
	color:#000;
	font-family:arial;
 	
}

a:link{
	text-decoration:none;
	font-size:14px;
	color:#000;
	font-family:arial;
 	
}

a:hover{
	text-decoration:none;
	font-size:14px;
	color:#000;
	font-family:arial;
 	
}


</style>

<body>

<div id="mainGris" style="height:300px;"><!--Cuadro Gris-->
	<? if (in_array(1, $_SESSION['perfil'])){
	?>
	<div id="mainBlancoMenu"  style=" margin-left:10px; margin-top:10px;  float:left;">
    <div align="center" class="Arial14Negro"><a href="add.php"><img src="img/add.png" width="48" height="48"></a><a href="add.php">Campa&ntilde;a Simple</a></div>
    </div>
    <? } ?>
    <? if (in_array(2, $_SESSION['perfil'])){
	?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="add_variables.php"><img src="img/add.png" width="48" height="48">Campa&ntilde;a Variable</a></div>
    </div>
    <? } ?>
    <? if (in_array(3, $_SESSION['perfil'])){
	?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><img src="img/stop.png" width="48" height="48"><br>Detener Campa&ntilde;a</div>
    </div>
    <? } ?>
    
	<? if (in_array(4, $_SESSION['perfil'])){
	?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="reportes/reportes.php"><img src="img/xcel.png" width="48" height="48"></a>Reportes Generales</div>
    </div>
    <? } ?>

	<? if (in_array(5, $_SESSION['perfil'])){
	?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="mantenimiento_usuario.php"><img src="img/usuarios.png" width="48" height="48"></a>Mantenimiento Usuarios</div>
    </div>
    <? } ?>
	<? if (in_array(6, $_SESSION['perfil'])){
	?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="mantenimiento_empresas"><img src="img/empresas.png" width="48" height="48"></a>Mantenimiento Empresas</div>
    </div>
    <? } ?>
	<? if (in_array(7, $_SESSION['perfil'])){
	?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="mantenimiento_facturas.php"><img src="img/precios.png" width="48" height="48"></a>Mantenimiento Facturas</div>
    </div>
    <? } ?>
    

	<? if (in_array(8, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="resultados_micro.php"><img src="img/resultados.png" width="48" height="48"></a>Resultados Micro</div>
    </div>
    <? } ?>
    <? if (in_array(9, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="resultados_quimica.php"><img src="img/resultados.png" width="48" height="48"></a>Resultados Qu&iacute;mica</div>
    </div>
    <? } ?>
    <? if (in_array(10, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><img src="img/resultados.png" width="48" height="48">Resultados Bromatolog&iacute;a</div>
    </div>
    <? } ?>
	<? if (in_array(11, $_SESSION['perfil'])){	?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="reportes/reportes.php"><img src="img/xcel.png" width="48" height="48"></a>Visualizar Reportes</div>
    </div>
    <? } ?>
    
    <? if (in_array(12, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="mantenimiento_usuario.php"><img src="img/usuarios.png" width="48" height="48"></a>Mantenimiento Usuarios</div>
    </div>
    <? } ?>
    <? if (in_array(13, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="mantenimiento_clientes.php"><img src="img/clientes.png" width="48" height="48"></a>Mantenimiento Clientes</div>
    </div>
    <? } ?>
     <? if (in_array(14, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="reimprime_etiquetas.php"><img src="img/printing.png" width="48" height="48"></a>Reimprimir Etiqueta</div>
    </div>
    <? } ?>
    <? if (in_array(15, $_SESSION['perfil'])){
	?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="mantenimiento_muestras.php"><img src="img/edit.png" width="48" height="48"></a>Mantenimiento Muestras</div>
    </div>
    <? } ?>
    <? if (in_array(16, $_SESSION['perfil'])){
	?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><img src="img/edit.png" width="48" height="48">Mantenimiento An&aacute;lisis</div>
    </div>
    <? } ?>




</div><!--Fin Cuadro Gris-->

</body>
</html>
