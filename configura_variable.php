<?
session_start();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
a {color: #CCC } 
a:hover {color: #CCC} 
</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SRC</title>

<link href="css/cuadros.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.pnotify.default.css" rel="stylesheet" type="text/css" />
<link href="css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />

<script src="includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="datetimepicker_css.js"></script>

<script>

$(document).ready(function(){
	
	$("#btn_guardar").live("click", function(event){
		
		permitido=1;
		
		if($("#txt_nombre").val()==""){
			$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'Debe indicar el nombre de la campaña',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
			permitido=0;
			$("#txt_nombre").focus();
			return;
		}else{
			
		
			$.ajax({ 
			data: "opcion=4&txt_nombre="+$("#txt_nombre").val(),
			type: "POST",
			async: false,
			dataType: "json",
			url: "operaciones.php",
			success: function(data){ 
				
				if(data.encontrado==1){
				
				$.pnotify({
			    pnotify_title: 'Campaña Repetida!!',
    			pnotify_text: 'Este nombre de camapaña ya existe',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
				$("#txt_nombre").focus();
				permitido=0;
				 return;
				}//end if data
				

				} 
			});
		}//fin vacio
		
		if($("#fecha_ini").val()==""){
			$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'Debe indicar la fecha inicial',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
				$("#fecha_ini").focus();
			permitido=0;
			return;
		}
		if($("#fecha_fin").val()==""){
			$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'Debe indicar la fecha final',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
				$("#fecha_fin").focus();
			permitido=0;
			return;
			
		}
		
		
		if (permitido==1){
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones.php",
        data: "opcion=3&txt_nombre="+$("#txt_nombre").val()+"&fecha_ini="+$("#fecha_ini").val()+"&fecha_fin="+$("#fecha_fin").val()+"&cmb_ini="+$("#cmb_ini").val()+"&cmb_fin="+$("#cmb_fin").val()+"&txt_total="+$("#txt_total").val(),
        success: function(datos){			

		}//end succces function
		});//end ajax function	
		
		location.href="resultado.php";
		
		}//fin permitido
		
		
});//end funcion guardar

	

})
</script>
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Administrador</div><div align="right"><img src="img/yitec.png" /></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:800px"></div>
<div align="center"    class="contenido_gm">
<div style=" margin-bottom:10px; margin-left:700px; " class="Arial10gris"><a href="menu.php">Inicio</a>&nbsp;-&nbsp;<a href="add.php">Volver</a>&nbsp;-&nbsp;<a href="login.php">Salir</a></div>
<div id="mainAzulFondo" style="padding: 20px; margin-top:10px; width:550px;">
<div id="mainBlancoFondo" style="width:500px;" >

<div align="center">
<img src="img/PASO2.jpg" />
</div>


  
  
  
  <table><tr>
  <td><div class="Arial18Azul">
 Programe su campa&ntilde;a</div>
  </td> 
  </tr>
    </table>
    <br />
  
  <input name="opcion" type="hidden" value="3" />
  <table>
    <tr>
    <td class="Arial14Morado">Nombre Campa&ntilde;a:</td>
    <td><input class="inputbox" name="txt_nombre" id="txt_nombre" type="text" maxlength="60" /></td>
    </tr>
    <tr>
    <td class="Arial14Morado">Fecha Inicio:</td>
    <td><input type="Text" name="fecha_ini" class="inputbox" id="fecha_ini" maxlength="20" size="20"/>     <img src="images2/cal.gif" onClick="javascript:NewCssCal('fecha_ini')" style="cursor:pointer"/></td>
    </tr>
    <tr>
    <td class="Arial14Morado">Fecha Fin:</td>
    <td><input type="Text" class="inputbox" id="fecha_fin" name="fecha_fin" maxlength="20" size="20"/>     <img src="images2/cal.gif" onClick="javascript:NewCssCal('fecha_fin')" style="cursor:pointer"/></td>
    </tr>
    <tr>
    <td class="Arial14Morado">Hora Inicio:</td>
    <td><label>
      <select class="combos" name="cmb_ini" id="cmb_ini">
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
      </select>
    </label></td>
    </tr>
    <tr>
    <td class="Arial14Morado">Hora F&iacute;n:</td>
    <td><label>
      <select class="combos" name="cmb_fin" id="cmb_fin">
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
      </select>
    </label> </td>
    </tr>
    <tr><td class="Arial14Morado">Total SMS:</td>
    <td><div class="Arial14Azul">
      <?=$_REQUEST['total_sms'];?>
      <input name="txt_total" id="txt_total" type="hidden" value="<?=$_REQUEST['total_sms'];?>" />
    </div></td></tr>
   
    
    </table>
    <table>
    <tr>
    <td><input name="btn_guardar" id="btn_guardar" type="image" src="img/btn_guardar.png" />
    </td></tr>
    </table>
  


</div><!--Fin Blanco-->  
</div><!--Fin azul-->  





</div>
<div class="der_lat_g" style="height:800px;"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g"></div>
<div class="der_inf_g"></div>

<div align="center" style=" margin-left:300px;float:left" class="Arial8negro">
Sistema de recordatorio de citas. Desarrollado por 
</div>
<div align="center" style="float:left" class="Arial8azul">
Yamato Tecnología.
</div>
<div align="center" style="float:left" class="Arial8negro">
Versi&oacute;n 1.0
</div>
</td></tr></table>

</div>




</body>

</html>
