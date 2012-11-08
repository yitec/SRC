
$(document).ready(function(){
			$('#_1').hide();
			$('#_2').hide();			
			$('#_3').hide();
			$('#_4').hide();						
			$('#_5').hide();									   
//********cargo el vector de usuarios *********
var availableTags;
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_empresas.php",
        data: "opcion=5",
        success: function(datos){			
			 availableTags =datos;			
		}//end succces function
		});//end ajax function	
		availableTags=availableTags.split(",");
		$( "#txt_empresa_buscar" ).autocomplete({
			source: availableTags
		});
		
						   
						   
//busca un item en el inventario
$("#btn_buscar").live("click", function(event){
//$("#btn_buscar").click(function(event){
		event.preventDefault();			
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_facturas.php",
        data: "opcion=2&factura="+$('#txt_factura_buscar').val(),
        success: function(datos){
			//desconcateno el resultado la primera posicion me indica si fue exitoso
			if(datos=="error"){
				$.pnotify({
			    pnotify_title: 'La factura no se encontro',
    			pnotify_text: '',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
			}else{
			var v_resultado=datos.split("|");
			$('#1').hide();
			$('#2').hide();			
			$('#3').hide();
			$('#4').hide();						
			$('#5').hide();			
			$('#txt_empresa_').attr('value',v_resultado[0]);
			$('#txt_numero_').attr('value',v_resultado[1]);
			$('#txt_mes_').attr('value',v_resultado[2]);
			$('#txt_ven_').attr('value',v_resultado[3]);
			$('#txt_monto_').attr('value',v_resultado[4]);
			$('#_1').show();
			$('#_2').show();			
			$('#_3').show();
			$('#_4').show();						
			$('#_5').show();				
				
			$('#opcion').attr('value','3');
			}
		}//end succces function
		});//end ajax function	
});						   
	

$("#btn_guardar").click(function(event){
		
		event.preventDefault();	
		  
  
		
		if($('#opcion').val()==1){			
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_facturas.php",
        data: "opcion=1&cmb_empresa="+$('#cmb_empresa').val()+"&txt_numero="+$('#txt_numero').val()+"&cmb_mes="+$('#cmb_mes').val()+"&fecha_ven="+$('#fecha_ven').val()+"&txt_monto="+$('#txt_monto').val(),        		
		success: function(datos){


		if (datos=="Success"){
				$.pnotify({
			    pnotify_title: 'Nuevo Factura!!',
    			pnotify_text: 'La factura fue guardada exitosamente.',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});
		}else{
				$.pnotify({
			    pnotify_title: 'Error!!',
    			pnotify_text: 'El Cliente ya existe',
    			pnotify_type: 'error',
    			pnotify_hide: true
				});
			
		}
				
				
		}//end succces function
		});//end ajax function			
		$('#cmb_empresa').focus();	
		}else{

		//modifico los datos de la factura
		cadena="opcion=3&cmb_tipo="+$('#cmb_tipo').val()+"&fecha_pago="+$('#fecha_pago').val()+"&cmb_estado="+$('#cmb_estado').val()+"&txt_factura_buscar="+$('#txt_factura_buscar').val();
		$.ajax({
        type: "POST",
		async: false,
        url: "operaciones/opr_facturas.php",
        data: cadena,		
		success: function(datos){
		alert(datos);
				$.pnotify({
			    pnotify_title: 'Factura Modificada',
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
        url: "operaciones/opr_facturas.php",
        data: "opcion=4&txt_factura_buscar="+$('#txt_factura_buscar').val(),
        success: function(datos){

				$.pnotify({
			    pnotify_title: 'Factura Eliminado!!',
    			pnotify_text: '',
    			pnotify_type: 'info',
    			pnotify_hide: true
				});		

				
		}//end succces function
		});//end ajax function			

	
limpiar();

});

function limpiar(){
			$('#txt_numero').attr('value','');
			$('#txt_monto').attr('value','');
			$('#txt_numero_').attr('value','');
			$('#txt_monto_').attr('value','');
			$('#txt_mes_').attr('value','');			
			$('#txt_empresa_').attr('value','');
			$('#txt_ven_').attr('value','');
			
			$('#cmb_empresa option[value="1"]').attr("selected","selected");
			$('#cmb_mes option[value="1"]').attr("selected","selected");
			$('#cmb_tipo option[value="1"]').attr("selected","selected");
			$('#cmb_estado option[value="0"]').attr("selected","selected");
			$('#fecha_ven').attr('value','');
			$('#fecha_pago').attr('value','');
}

																   

})// JavaScript Document

					   
