<?php
session_start();
require_once('../cnx/conexion.php');
conectar();
$hoy=date("Y-m-d H:i:s");
//guarda un articulo en inventario
$dia=substr($_REQUEST['txt_fecha'], 3, 2);
$ano=substr($_REQUEST['txt_fecha'], 6, 4);
$mes=substr($_REQUEST['txt_fecha'], 0, 2);

$fecha=$ano."-".$mes."-".$dia." ".$_GET['cmb_ini'].":00";


if($_REQUEST['opcion']==1)
{

	$result=mysql_query("select * from tbl_clientes ");
	while ($row=mysql_fetch_assoc($result)){
		$vector=$vector.",".utf8_encode($row['nombre']); 
	}
	echo $vector;
	desconectar();


}//end if opcion 1



//Consultar analisis
if($_REQUEST['opcion']==2)
{		

	$result=mysql_query("select * from tbl_categoriasanalisis where ids_categoriaMuestra='".$_REQUEST['valor']."' and id_laboratorio='".$_REQUEST['laboratorio']."' and precio>0");
		while ($row=mysql_fetch_assoc($result)){
			
			$vector=$vector."|".$row['id'].",".$row['id_laboratorio'].','.$row['nombre'].','.$row['precio'].','.$row['analisis_ligados']; 
	}
	//el extracto libre de nitrogeno lo agrego manual
	$vector=$vector."|1567,1,Extracto Libre Nitr�geno,0,0"; 
	echo utf8_encode($vector);
	desconectar();
}//end if opcion 2

//Consultar analisis
if($_REQUEST['opcion']==3)
{	
	if($_REQUEST['valor']==0){
		$valor=	$_REQUEST['valor']+1;
		$result=mysql_query("select * from tbl_subcatmuestras where id_categoria='".$valor."'");
	}else{
	$result=mysql_query("select * from tbl_subcatmuestras where id_categoria='".$_REQUEST['valor']."'");
	}
		while ($row=mysql_fetch_assoc($result)){
			
			$vector=$vector."|".$row['nombre']; 
	}
	echo utf8_encode($vector);
	desconectar();
}//end if opcion 2


//guardar datos analisis
if($_REQUEST['opcion']==4)
{		

	$v_datos=explode('|',$_REQUEST['datos']);	
	$size = sizeof($v_datos);//TAMA�O del vector
	$size=$size-2;//resto posiciones en blanco
	echo " size=".$size;
	

	for($i=0;$i<=$size;$i++){
		
		$v_analisis=explode(',',$v_datos[$i]);	
		if($i>=1){
			$id_analisis=$v_analisis[1];
			$id_laboratorio=$v_analisis[2];
			$muestra=$v_analisis[3]+1;
			$precio=$v_analisis[4];
		}else{
			$id_analisis=$v_analisis[0];
			$id_laboratorio=$v_analisis[1];
			$muestra=$v_analisis[2]+1;			
			$precio=$v_analisis[3];			
		}

		switch($id_laboratorio){
		case 1:
			$codigo=$_SESSION['contrato']."-LQ-".$muestra;
			break;
		case 2:
			$codigo=$_SESSION['contrato']."-MB-".$muestra;
			break;
		case 3:
			$codigo=$_SESSION['contrato']."-BR-".$muestra;	
			break;
		}//end switch
		
		$result=mysql_query("insert into tbl_analisis (id_contrato,codigo,id_laboratorio,id_muestra,id_analisis,precio,fecha_contrato,estado)values('".$_REQUEST['contrato']."','".$codigo."','".$id_laboratorio."','".$muestra."','".$id_analisis."','".$precio."','".$hoy."','"."0"."')");
	
	}//end for
	echo $lab;
	desconectar();
}//end if opcion 4


//guardar datos muestras
if($_REQUEST['opcion']==5)
{		
	$v_muestras=explode("|",$_REQUEST['observaciones']);//este vector tiene los datos de nombres de muestras y observaciones
	
	$tot=$_REQUEST['muestras']+1;
	for($i=1;$i<=$tot;$i++){
		
		$v_observaciones=explode(",",$v_muestras[$i]);
		$codigo=$_REQUEST['contrato']."-".$i;
//		$result=mysql_query("insert into tbl_muestras (id_contrato,numero_muestra,codigo,fecha_ingreso,estado)values('".$_REQUEST['contrato']."','".$i."','".$codigo."','".$hoy."','"."0"."')");
		$result=mysql_query("insert into tbl_muestras (id_contrato,numero_muestra,codigo,fecha_ingreso,estado,nombre_muestra,observaciones)values('".$_REQUEST['contrato']."','".$i."','".$codigo."','".$hoy."','"."0"."','".$v_observaciones[1]."','".$v_observaciones[2]."')");
		
	}
	desconectar();
}//end if opcion 5


//guardar datos del contrato
if($_REQUEST['opcion']==6)
{		
	$act_muestras=0;
	$act_oficiales=0;
	$act_forrajes=0;
	
		$result=mysql_query("insert	 into tbl_contratos(consecutivo,id_cliente,numero_muestras,monto_total,tipo_pago,fecha_ingreso,nombre_solicitante,telefono_solicitante,envio_correo,observaciones,estado)values('".$_SESSION['contrato']."','".$_SESSION['id_cliente']."','".$_REQUEST['txt_muestras']."','".$_SESSION['total']."','".$_SESSION['tipo_pago']."','".$hoy."','".$_SESSION['nombre']."','".$_SESSION['telefono']."','".$_SESSION['xcorreo']."','".utf8_decode($_REQUEST['txt_observacionesc'])."','"."1"."')");
		if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
		
		if ($_REQUEST['act_muestras']==1){
		$procedencia=$_REQUEST['cmb_provincia'].",".$_REQUEST['cmb_cantones'].",".$_REQUEST['cmb_distritos'];	
		$act_muestras=1;
		$result=mysql_query("insert into tbl_infmuestras (cons_contrato,tipo_alimento,nombre_producto,condicion_muestra,fecha_muestra,forma_muestreo,proceso_elaboracion,parte_planta,procedencia,importado,elaborado) values ('".$_SESSION['contrato']."','".utf8_decode($_REQUEST['txt_tipoAlimento'])."','".utf8_decode($_REQUEST['txt_nombreProducto'])."','".utf8_decode($_REQUEST['txt_condicionMuestra'])."','".utf8_decode($_REQUEST['txt_fechaMuestra'])."','".utf8_decode($_REQUEST['txt_formaMuestreo'])."','".utf8_decode($_REQUEST['txt_procesoElaboracion'])."','".utf8_decode($_REQUEST['txt_partePm'])."','".utf8_decode($procedencia)."','".utf8_decode($_REQUEST['rnd_importado'])."','".utf8_decode($_REQUEST['txt_elaborado'])."')");
			
		}
		
		if ($_REQUEST['act_oficiales']==1){
		$act_oficiales=1;
		$result=mysql_query("insert into tbl_infoficiales (cons_contrato,empresa,inspector,lisencia,boleta,muestreado,fecha_elaboracion,fecha_vencimiento) values ('".$_SESSION['contrato']."','".utf8_decode($_REQUEST['txt_empresa'])."','".utf8_decode($_REQUEST['txt_inspector'])."','".utf8_decode($_REQUEST['txt_lisencia'])."','".utf8_decode($_REQUEST['txt_boleta'])."','".utf8_decode($_REQUEST['txt_muestreado'])."','".utf8_decode($_REQUEST['txt_fechaE'])."','".utf8_decode($_REQUEST['txt_fechaV'])."')");
			
		}
		
		if ($_REQUEST['act_forrajes']==1){
			$act_forrajes=1;
		$result=mysql_query("insert into tbl_infforrajes (cons_contrato,tipo,origen,fertilizacion,aplicacion,edad) values ('".utf8_decode($_SESSION['contrato'])."','".utf8_decode($_REQUEST['txt_tipo'])."','".utf8_decode($_REQUEST['txt_origen'])."','".utf8_decode($_REQUEST['txt_fertilizacion'])."','".utf8_decode($_REQUEST['txt_aplicacion'])."','".utf8_decode($_REQUEST['txt_edad'])."')");
			
		}

		$result=mysql_query("insert into tbl_conscontratos (estado) values('"."1"."')");
		
		
		//actualizo el consumible del cliente de Investigacion
		if ($_SESSION['tipo_pago']=="Rebajar"){
				$mconsumido=$_SESSION['consumido']+$_SESSION['total'];
			$mconsumible=$_SESSION['consumible']-$_SESSION['total'];
			$result=mysql_query("update tbl_clientes set consumido='".$mconsumido."', consumible='".$mconsumible."' where id='".$_SESSION['id_cliente']."' ");
		}
		
		
		//$result=mysql_query("insert into tbl_conscontratos (estado) values('"."1"."')");
		header('Location:../resultado.php?contrato='.$_SESSION['contrato'].'&muestras='.$act_muestras.'&forrajes='.$act_forrajes.'&oficiales='.$act_oficiales.'&numero_muestras='.$_REQUEST['txt_muestras'].'&usuario='.$_SESSION['nombre_usuario']);
		
	
	desconectar();
}//end if opcion 6


//averiguo el tipo de cliente
if($_REQUEST['opcion']==7)
{		
	
		$result=mysql_query("select * from tbl_clientes where nombre='".utf8_decode($_REQUEST['nombre'])."'");
		if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
		$row=mysql_fetch_assoc($result);
		echo $row['tipo_cliente']."|".$row['consumible']."|".$row['consumido']."|".$row['credito'];						
						
	desconectar();
}//end if opcion 7



//*****************************************************Agrego muestras**********************************************
if($_REQUEST['opcion']==8)
{
	//primero saco cuentas muestras habias ya
	$result=mysql_query("select count(id_contrato) as total from tbl_muestras where id_contrato='".$_REQUEST['contrato']."'");
	$row=mysql_fetch_assoc($result);
	$nuevas=$row['total'];
	$nuevas++;
	$v_muestras=explode("|",$_REQUEST['observaciones']);//este vector tiene los datos de nombres de muestras y observaciones
	
	$tot=$_REQUEST['muestras']+1;
	for($i=1;$i<=$tot;$i++){
		
		$v_observaciones=explode(",",$v_muestras[$i]);
		$codigo=$_REQUEST['contrato']."-".$nuevas;

		$result=mysql_query("insert into tbl_muestras (id_contrato,numero_muestra,codigo,fecha_ingreso,estado,nombre_muestra,observaciones)values('".$_REQUEST['contrato']."','".$nuevas."','".$codigo."','".$hoy."','"."0"."','".$v_observaciones[1]."','".$v_observaciones[2]."')");
		$nuevas++;
	}
	desconectar();
}//end if opcion 8



//*******************************************agregar analisis de muestras**************************************//


if($_REQUEST['opcion']==9)

{		
	//primero saco cuentas muestras habias ya
	$result=mysql_query("select count(id_contrato) as total from tbl_muestras where id_contrato'".$_REQUEST['contrato']."'");
	$row=mysql_fetch_assoc($result);
	$nuevas=$row['total'];
	
	$v_datos=explode('|',$_REQUEST['datos']);	
	$size = sizeof($v_datos);//TAMA�O del vector
	$size=$size-2;//resto posiciones en blanco
	echo " size=".$size;
	

	for($i=0;$i<=$size;$i++){
		
		$v_analisis=explode(',',$v_datos[$i]);	
		if($i>=1){
			$id_analisis=$v_analisis[1];
			$id_laboratorio=$v_analisis[2];
			$muestra=$v_analisis[3]+1;
			$nuevas++;
			$precio=$v_analisis[4];
		}else{
			$id_analisis=$v_analisis[0];
			$id_laboratorio=$v_analisis[1];
			$muestra=$v_analisis[2]+1;			
			$nuevas++;
			$precio=$v_analisis[3];			
		}

		switch($id_laboratorio){
		case 1:
			$codigo=$_SESSION['contrato']."-QM-".$muestra;
			break;
		case 2:
			$codigo=$_SESSION['contrato']."-MC-".$muestra;
			break;
		case 3:
			$codigo=$_SESSION['contrato']."-BR-".$muestra;	
			break;
		}//end switch
		
		$result=mysql_query("insert into tbl_analisis (id_contrato,codigo,id_laboratorio,id_muestra,id_analisis,precio,fecha_contrato,estado)values('".$_REQUEST['contrato']."','".$codigo."','".$id_laboratorio."','".$nuevas."','".$id_analisis."','".$precio."','".$hoy."','"."0"."')");
	$nuevas++;
	}//end for
	echo $lab;
	desconectar();
}//end if opcion 9


//***********************************************averiguo los cantones***************************************//



if($_REQUEST['opcion']==10)
{		
		$i=0;
		$v_datos="0,Seleccione|";
		$result=mysql_query("select * from tbl_cantones where id_provincia='".$_REQUEST['cmb_provincia']."'");
		if (!$result) {//si da error que me despliegue el error del query
        
		echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
		while($row=mysql_fetch_assoc($result)){
			
			$v_datos=$v_datos.$row['id'].",".$row['nombre']."|";						
			
	
		}
		
		echo utf8_encode($v_datos);
						
	desconectar();
}//end if opcion 10


//***********************************************averiguo los distrito*******************************//
if($_REQUEST['opcion']==11)
{		
		$i=0;
		$v_datos="0,Seleccione|";
		$result=mysql_query("select * from tbl_distritos where id_canton='".$_REQUEST['cmb_cantones']."'");
		if (!$result) {//si da error que me despliegue el error del query
        
		echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
		while($row=mysql_fetch_assoc($result)){
			
			$v_datos=$v_datos.$row['id'].",".$row['nombre']."|";						
			
	
		}
		
		echo utf8_encode($v_datos);
						
	desconectar();
}//end if opcion 11





//*******************************************guardar datos  mantenimientos analisis***********************************/
if($_REQUEST['opcion']==12)
{		

	$v_datos=explode('|',$_REQUEST['datos']);	
	$size = sizeof($v_datos);//TAMA�O del vector
	$size=$size-2;//resto posiciones en blanco
	echo " size=".$size;
	$total=0;

	for($i=0;$i<=$size;$i++){
		
		$v_analisis=explode(',',$v_datos[$i]);	
		if($i>=1){
			$id_analisis=$v_analisis[1];
			$id_laboratorio=$v_analisis[2];
			$muestra=$v_analisis[3];
			$precio=$v_analisis[4];
			$total=$total+$precio;
		}else{
			$id_analisis=$v_analisis[0];
			$id_laboratorio=$v_analisis[1];
			$muestra=$v_analisis[2];			
			$precio=$v_analisis[3];			
			$total=$total+$precio;			
		}

		switch($id_laboratorio){
		case 1:
			$codigo=$_REQUEST['contrato']."-LQ-".$muestra;
			break;
		case 2:
			$codigo=$_REQUEST['contrato']."-MB-".$muestra;
			break;
		case 3:
			$codigo=$_REQUEST['contrato']."-BR-".$muestra;	
			break;
		}//end switch
		
//Pregunto si deseo ingresarlos en molienda o en analisis
if ($_REQUEST['molienda']==1){
	$result=mysql_query("insert into tbl_analisis (id_contrato,codigo,id_laboratorio,id_muestra,id_analisis,precio,fecha_contrato,estado)values('".$_REQUEST['contrato']."','".$codigo."','".$id_laboratorio."','".$muestra."','".$id_analisis."','".$precio."','".$hoy."','"."0"."')");
	$result=mysql_query("update tbl_contratos set estado='"."1"."' where consecutivo='".$_REQUEST['contrato']."'");
}else{
	$result=mysql_query("insert into tbl_analisis (id_contrato,codigo,id_laboratorio,id_muestra,id_analisis,precio,fecha_contrato,fecha_molienda,estado)values('".$_REQUEST['contrato']."','".$codigo."','".$id_laboratorio."','".$muestra."','".$id_analisis."','".$precio."','".$hoy."','".$hoy."','"."1"."')");
}//end if
		
	}//end for
	
	$result=mysql_query("select monto_total from tbl_contratos where consecutivo='".$_REQUEST['contrato']."'");
		$row=mysql_fetch_assoc($result);
		$actual=$row['monto_total'];
		$actual=$total+$actual;
		
		$result=mysql_query("update tbl_contratos set monto_total='".$actual."' where consecutivo='".$_REQUEST['contrato']."'");
	echo $lab;
	desconectar();
}//end if opcion 4



//*************************************************Obtengo el precio de un analisis ligado***********************
if($_REQUEST['opcion']==13)
{

	$result=mysql_query("select precio from tbl_categoriasanalisis where id='".$_REQUEST['id']."' ");
	$row = mysql_fetch_object($result); 
	if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
	echo $row->precio;

	desconectar();


}//end if opcion 13


//*************************************************Busco contratos para firmas***********************
if($_REQUEST['opcion']==14)
{

	$result=mysql_query("select * from tbl_contratos where consecutivo='".$_REQUEST['contrato']."' ");
	$row = mysql_fetch_assoc($result); 
	if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
	if (mysql_num_rows($result)>=1){
		echo $row['fecha_equimica']."|".$row['fecha_fquimica']."|".$row['fecha_emicro']."|".$row['fecha_fmicro']."|".$row['fecha_ebroma']."|".$row['fecha_fbroma']."|".$row['fecha_ezootecnia']."|".$row['fecha_fzootecnia'];
	}else{
	echo "error"; 	
	}
	desconectar();


}//end if opcion 13


//*************************************************Modificar firmas***********************
if($_REQUEST['opcion']==15)
{	
$result=mysql_query("update tbl_contratos set fecha_equimica='".$_REQUEST['txt_equimica']."',fecha_fquimica='".$_REQUEST['txt_fquimica']."',fecha_emicro='".$_REQUEST['txt_emicro']."',fecha_fmicro='".$_REQUEST['txt_fmicro']."',fecha_ebroma='".$_REQUEST['txt_ebroma']."',fecha_fbroma='".$_REQUEST['txt_fbroma']."',fecha_ezootecnia='".$_REQUEST['txt_ezootecnia']."',fecha_fzootecnia='".$_REQUEST['txt_fzootecnia']."' where consecutivo='".$_REQUEST['contrato']."'");

if (!$result) {//si da error que me despliegue el error del query
      echo $message  = 'Error: ' . mysql_error() . "\n";
       
		
}else{
	echo "Success";	
}
	
desconectar();
}//end if opcion 3



	

?>