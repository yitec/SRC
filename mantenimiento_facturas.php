<?
session_start();
require_once('cnx/conexion.php');
require_once('cnx/session_activa.php');
conectar();
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
<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 

<script src="includes/jquery.ui.core.js"></script>
<script src="includes/jquery.ui.widget.js"></script>
<script src="includes/jquery.ui.autocomplete.js"></script>
<script src="includes/jquery.ui.position.js"></script>
<script src="includes/datetimepicker_css.js"></script>
<script src="includes/Scripts_Facturas.js" type="text/javascript"></script> 



</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Facturas</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g"></div>
<div    class="contenido_gm">


<?
require_once('menu_superior.php');
?>


<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">
	<div class="Arial14Negro" style="margin-left:470px; float:left; margin-top:5px;   ">Factura:</div>
     <div class="ui-widget" style="float:left;"><input class="inputboxPequeno" size="20" id="txt_factura_buscar" name="txt_factura_buscar" type="text"  /></div>
    <input name="btn_buscar" id="btn_buscar" type="image" src="img/search.png" />

<input name="opcion" id="opcion" type="hidden" value="1" />
	<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;">Informaci&oacute;n General Facturas</div>
	<table>
	  <tr>
	    <td width="92" height="20" class="Arial14Negro">Empresa</td>
	    <td width="151" class="Arial14Negro">Número Factura</td>
        <td width="106" class="Arial14Negro">Mes</td>
	    <td width="175" class="Arial14Negro">Fecha Vencimiento</td>
	    <td width="109" class="Arial14Negro">Monto</td>        
        
        
	    </tr>
	  <tr>
	    <td height="49" class="Arial14Negro">
        <div id="1">
        
        <?
		$result=mysql_query("Select * from tbl_empresas");
		echo '<select name="cmb_empresa" id="cmb_empresa" class="combos">';
		while ($row=mysql_fetch_assoc($result)){
			
			echo '<option value="'.$row['id'].'">'.utf8_encode($row['nombre']).'</option>';
		}
		echo '</select>';
		mysql_free_result($result);		
		
	
		?>        
        </div>
        <div id="_1">
        <input  class="inputbox" name="txt_empresa_" id="txt_empresa_" size="12" type="text" />
        
        </div>
        
        </td>
        <td class="Arial14Negro">
        <div id="2">
        <input  class="inputbox" name="txt_numero" id="txt_numero" size="12" type="text" />
        </div>
        <div id="_2">
        <input  class="inputbox" name="txt_numero_" id="txt_numero_" size="12" type="text" />
        
        </div>
        
        </td>
	    <td class="Arial14Negro">
        <div id="3">
        <?
        echo '<select name="cmb_mes" id="cmb_mes" class="combos">';
					
			echo '<option value="1">Enero</option>';
			echo '<option value="2">Febrero</option>';
			echo '<option value="3">Marzo</option>';
			echo '<option value="4">Abril</option>';
			echo '<option value="5">Mayo</option>';
			echo '<option value="6">Junio</option>';
			echo '<option value="7">Julio</option>';
			echo '<option value="8">Agosto</option>';
			echo '<option value="9">Setiembre</option>';
			echo '<option value="10">Octubre</option>';
			echo '<option value="11">Noviembre</option>';
			echo '<option value="12">Diciembre</option>';
		echo '</select>';
        ?>
        </div>
        <div id="_3">
        <input  class="inputbox" name="txt_mes_" id="txt_mes_" size="12" type="text" />
        
        </div>

        </td>
	    <td class="Arial14Negro">
        <div id="4">
        <input type="text" name="fecha_ven" class="inputbox" id="fecha_ven" maxlength="20" size="12"/>
          <img src="img_calendar/cal.gif" onclick="javascript:NewCssCal('fecha_ven')" style="cursor:pointer"/>
          </div>
          
         <div id="_4">
        <input  class="inputbox" name="txt_ven_" id="txt_ven_" size="12" type="text" />
        
        </div>

          </td>
          <td class="Arial14Negro">
          <div id="5">
          <input type="text" name="txt_monto" class="inputbox" id="txt_monto" maxlength="10" size="12"/>
          </div>
         <div id="_5">
        <input  class="inputbox" name="txt_monto_" id="txt_monto_" size="12" type="text" />
        
        </div>

          </td>
	    </tr>

	  <tr>
	    <td height="38" class="Arial14Negro">Metodo pago</td>
	    <td class="Arial14Negro">Fecha Pago</td>
	    <td class="Arial14Negro">Estado</td>
	    </tr>
	  <tr>
	    <td class="Arial14Negro"><select name="cmb_tipo" id="cmb_tipo" class="combos">
	      <option value="1">Targeta</option>
	      <option value="2">Efectivo</option>          
	      <option value="3">Deposito</option>          

	      </select></td>
	    <td class="Arial14Negro"><input type="text" name="fecha_pago" class="inputbox" id="fecha_pago" maxlength="20" size="12"/>
          <img src="img_calendar/cal.gif" onclick="javascript:NewCssCal('fecha_pago')" style="cursor:pointer"/></td>
	    <td class="Arial14Negro"><select name="cmb_estado" id="cmb_estado" class="combos">
	      <option value="0">Pendiente</option>
	      <option value="1">Cancelado</option>          


	      </select></td>
	    </tr>
	  <tr>        
	  </table>
	<div align="center" style="margin-top:20px; margin-bottom:20px;"><input name="btn_guardar" id="btn_guardar" type="image" src="img/btn_guardar.png" /><input name="btn_eliminar" id="btn_eliminar" type="image" src="img/btn_eliminar.png" /></div>    

</div><!--fin cuadro blanco--> 
</div><!--fin cuadro azul--> 

	


</div><!--fin div de contenido cudro gm-->
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
