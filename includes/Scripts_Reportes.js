
$(document).ready(function(){

$("#cmb_campaing").change(function(event){
										  
		$.ajax({ 
		data: "opcion=2&campaing="+$('#cmb_campaing').val(),
		type: "POST",
		dataType: "json",
		url: "../operaciones.php",
		success: function(data){ 			
			$('#r1').html(data.total);
			$('#r2').html(data.pendientes);
			$('#r3').html(data.enviados);			
			switch(parseFloat(data.estado))
			{
				case 0:
				  $('#r4').html('Sin Iniciar');			
			  	break;
				case 1:
				  $('#r4').html('Iniciada');								
  				break;
				case 2:
				  $('#r4').html('Detenida');								
  				break;
				case 3:
				  $('#r4').html('Finalizada');								
  				break;
				
				default:
				  $('#r4').html('Error!!');								
			}
		} 
		});


});



})// JavaScript Document

					   
