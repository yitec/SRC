

var v_reportes=new Array();
$(document).ready(function(){


//********cargo el vector de usuarios para el autocompletar *********
var availableTags;
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_usuarios.php",
        data: "opcion=6",
        success: function(datos){			
			 availableTags =datos;			
		}//end succces function
		});//end ajax function	
		availableTags=availableTags.split(",");
		$( "#txt_usuario_buscar" ).autocomplete({
			source: availableTags
		});


//busca un item en el inventario
$("#btn_buscar").live("click", function(event){
//$("#btn_buscar").click(function(event){
		event.preventDefault();			
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_usuarios.php",
        data: "opcion=2&usuario="+$('#txt_usuario_buscar').val(),
        success: function(datos){
			//desconcateno el resultado la primera posicion me indica si fue exitoso
			var v_resultado=datos.split("|");
			$('#txt_usuario').attr('value',v_resultado[0]);
			$('#txt_nombre').attr('value',v_resultado[1]);
			$('#txt_apellidos').attr('value',v_resultado[2]);
			$('#txt_cedula').attr('value',v_resultado[3]);
			$('#txt_pass').attr('value',v_resultado[4]);
			$('#txt_fecha').attr('value',v_resultado[5]);
			$('#opcion').attr('value','3');
			ids_reportes=v_resultado[7];
			//desconcateno el vector de permisos		
			v_resultado=v_resultado[6].split(",");
			if(v_resultado.indexOf("1")>=0){
				$("#chk_usuarios").attr("checked","checked");
			}
			if(v_resultado.indexOf("2")>=0){
				$("#chk_empresas").attr("checked","checked");
			}			
			if(v_resultado.indexOf("3")>=0){
				$("#chk_pagos").attr("checked","checked");
			}
			if(v_resultado.indexOf("4")>=0){
				$("#chk_simple").attr("checked","checked");
			}
			if(v_resultado.indexOf("5")>=0){
				$("#chk_variable").attr("checked","checked");
			}
			if(v_resultado.indexOf("6")>=0){
				$("#chk_detener").attr("checked","checked");
			}
			if(v_resultado.indexOf("7")>=0){
				$("#chk_reportes").attr("checked","checked");
				muestraReportes(ids_reportes);
			}			
		}//end succces function
		});//end ajax function	
});						   
	

$("#btn_guardar").click(function(event){
		
		var permisos=null;
		if ($("#chk_usuarios").is(":checked")){
			permisos=permisos+","+1;	
		}
		if ($("#chk_empresas").is(":checked")){
			permisos=permisos+","+2;	
		}		
		if ($("#chk_pagos").is(":checked")){
			permisos=permisos+","+3;	
		}
		if ($("#chk_simple").is(":checked")){
			permisos=permisos+","+4;	
		}
		if ($("#chk_variable").is(":checked")){
			permisos=permisos+","+5;	
		}
		if ($("#chk_detener").is(":checked")){
			permisos=permisos+","+6;	
		}
		if ($("#chk_reportes").is(":checked")){
			permisos=permisos+","+7;	
		}


		event.preventDefault();				  				
		if($('#opcion').val()==1){	
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_usuarios.php",
        data: "opcion=1&txt_nombre="+$('#txt_nombre').val()+"&txt_apellidos="+$('#txt_apellidos').val()+"&txt_cedula="+$('#txt_cedula').val()+"&txt_usuario="+$('#txt_usuario').val()+"&txt_pass="+$('#txt_pass').val()+"&txt_fecha="+$('#txt_fecha').val()+"&id_permisos="+permisos+"&ids_reportes="+v_reportes,        		
		success: function(datos){

		if (datos=="Success"){
				$.pnotify({
			    pnotify_title: 'Nuevo Usuario!!',
    			pnotify_text: 'El Usuario fue guardado exitosamente.',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
		}else{
				$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'El usuario ya existe',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
			
		}
				
				
		}//end succces function
		});//end ajax function			
		$('#txt_codigo').focus();	
		}else{

		//modifico los datos del producto
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_usuarios.php",
       data: "opcion=3&txt_nombre="+$('#txt_nombre').val()+"&txt_apellidos="+$('#txt_apellidos').val()+"&txt_cedula="+$('#txt_cedula').val()+"&txt_usuario="+$('#txt_usuario').val()+"&txt_pass="+$('#txt_pass').val()+"&txt_fecha="+$('#txt_fecha').val()+"&id_permisos="+permisos+"&ids_reportes="+v_reportes+"&txt_usuario_buscar="+$('#txt_usuario_buscar').val(),		
		success: function(datos){
				alert(datos);
				$.pnotify({
			    pnotify_title: 'Usuario Modificado',
    			pnotify_text: '',
    			pnotify_type: 'info',
    			pnotify_hide: true
			});		
		}//end succces function
		});//end ajax function			
		}//end if 
		
limpiar();
});


$("#btn_eliminar").click(function(event){
	event.preventDefault();	
	$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_usuarios.php",
        data: "opcion=4&txt_usuario_buscar="+$('#txt_usuario_buscar').val(),
        success: function(datos){
			alert(datos);
				$.pnotify({
			    pnotify_title: 'Usuario Eliminado!!',
    			pnotify_text: '',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});		

				
		}//end succces function
		});//end ajax function			

	
limpiar();

});


/****************************Activar checkbox de Reportes*********/
$("#chk_reportes").click(function(event){

		if ($("#chk_reportes").attr("checked")){
			$('#reportes').show();	
			
		}else{
			$('#reportes').hide();						   								 
		}								
});




/****************************Marcar todos los checkbox de Reportes*********/
$("#chk_todosReporte").click(function(event){
	var encontrado=false;
	$(".rp:checkbox:not(:checked)").attr("checked", "checked");							 
		$.ajax({
		        type: "POST",
				async: false,
        		url: "operaciones/opr_usuarios.php",
        		data: "opcion=7",
        		success: function(datos){
					
					var v_resultado=datos.split("|");
					for (i=0;i<v_resultado.length;i++) { 
						encontrado=false;
						if(v_reportes.length>0){
						for (j=0;j<v_reportes.length;j++) { 
							
							if (v_reportes[j]==v_resultado[i]){
							v_reportes.splice(j,1);
							encontrado=true;
							}		
						} //END FOR 2
						}else{
							v_reportes[i]=v_resultado[i];
							encontrado=true
						}
					if(encontrado==false){
						v_reportes[j]=v_resultado[i];			
					}	

					
					}//end for 1

				}//end succces function
				});//end ajax function		
});


//********************************Muestra los reportes*****************

					   
function muestraReportes(ids){
	//recibo el vector de ids de analisis como parametro
			v_ids=ids.split(",");
			
				
			var cont=0;		
			$.ajax({
		        type: "POST",
				async: false,
        		url: "operaciones/opr_usuarios.php",
        		data: "opcion=11",
        		success: function(datos){
					$('.checkboxReportes').html("");
					var v_datos=datos.split("|");
					posiciones=v_datos.length-1;
					for (i=0;i<posiciones;i++) { 
						
						var v_detalles=v_datos[i].split(",");
						
						residuo=i%2
						
								//si esta en el vector de ids lo marco
							if(v_ids.indexOf(v_detalles[0])>=0){
							
							$('.checkboxReportes').append('<div style="float:left; width:400px;"><input type="checkbox" class="rp" checked onclick="agregaReporte('+v_detalles[0]+')" name="CheckboxGroupReportes" value="'+v_detalles[0]+'" id="CheckboxGroupReportes_'+cont+'" />'+v_detalles[1]+'</div><br>');
							pos=v_reportes.length;
							v_reportes[pos]=v_detalles[0];
							}else{

							$('.checkboxReportes').append('<div style="float:left; width:400px;"><input type="checkbox" class="rp" onclick="agregaReporte('+v_detalles[0]+')" name="CheckboxGroupReportes" value="'+v_detalles[0]+'" id="CheckboxGroupReportes_'+cont+'" />'+v_detalles[1]+'</div><br>');
								
								}
								
						
					cont++;
					
					}//end for
				
				  }//end succces function
				});//end ajax function

			
}


/****************************Activar checkbox de quimica*********/
$("#chk_quimica").click(function(event){
		if ($("#chk_quimica").attr("checked")){
			$('#quimica').show();						   								 
		}else{
			$('#quimica').hide();						   								 
		}								
});

/****************************Activar checkbox de microbiologia*********/
$("#chk_microb").click(function(event){
		if ($("#chk_microb").attr("checked")){
			$('#microbiologia').show();						   								 
		}else{
			$('#microbiologia').hide();						   								 
		}																
});

/****************************Activar checkbox de bromatologia*********/
$("#chk_broma").click(function(event){

		if ($("#chk_broma").attr("checked")){
			$('#bromatologia').show();						   								 
		}else{
			$('#bromatologia').hide();						   								 
		}								
});


function limpiar(){
			$('#txt_nombre').attr('value','');
			$('#txt_apellidos').attr('value','');
			$('#txt_cedula').attr('value','');
			$('#txt_usuario').attr('value','');
			$('#txt_pass').attr('value','');
			$('#txt_fecha').attr('value','');
			$('#txt_usuario_buscar').attr('value','');						
			$('#opcion').attr('value','1');
			$(".ck:checkbox:checked").removeAttr("checked");
			$(".rp:checkbox:checked").removeAttr("checked");
	
	
}

																   

})// JavaScript Document

//*********************************Agregar Reportes*********************************
function agregaReporte(id){

//esta funcionrecibe en el parametro el id del reporte que deseo agregar al perfil
		
		var encontrado=false;
		
		 //metos los datos de los analisis en un array y luego los mando a guardar
		for (i=0;i<v_reportes.length;i++) { 
			if (v_reportes[i]==id){
				v_reportes.splice(i,1);
				encontrado=true;
			}		
		} 
		if(encontrado==false){
			v_reportes[i]=String(id);			
		}	
		 

		  

}//end agrega analisis

					   
