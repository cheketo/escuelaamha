$(document).ready(function() {
	$('#load').hide();
	$('#divMsg').hide();
	$('#divError').hide();
	
	$('input:radio').each(function(){
		if ($(this).attr('checked')){
			if($(this).val()=="Y"){
				$("#EnviosYfechas").show();
			}
		}
		});
		
		var checkDes	= $(".checkDesc").toArray();
		if(checkDes.length>0){
			if(checkDes[0].checked==true){
				$("#ContentDesc").show();
			}
		}
		
		
		$("#"+$("#repeticion").val()).show();
	
	
	
	
});

$(function() {
	
	$("div.ContentPendientes").hover(
	  function() {
		$(this).children(".AccionesPendiente").show();
	  },
	  function () {
		$(this).children(".AccionesPendiente").hide();
	  });
	
	
	$(".ContentTituloHistorial").click(function(){
		$(".ContentDescripcionHistorial").slideUp();
		if($(this).parent().children(".ContentDescripcionHistorial").css("display")=="none"){
			$(this).parent().children(".ContentDescripcionHistorial").slideDown();
		}
	});
	
	$(".DataPendiente").click(function(){
		$(".ContentDescripcionPendiente").slideUp();
		if($(this).parents('.ContentPendientes').children(".ContentDescripcionPendiente").css("display")=="none"){
			$(this).parents('.ContentPendientes').children(".ContentDescripcionPendiente").slideDown();
		}
	});
	
	
	/*UPDATE REMINDER LISTADO */
	$(".ChecksPendiente").click(
	  function(){
			
			
			
			var decoration	= $(this).parents(".CheckPendiente").parents(".ContentPendientes").children(".DataPendiente").children(".TituloPendiente").css("text-decoration");
			var estado;
			var check 		= $(this);
			var titulo		= $(this).parents(".CheckPendiente").parents(".ContentPendientes").children(".DataPendiente").children(".TituloPendiente");
			var fecha		= $(this).parents(".CheckPendiente").parents(".ContentPendientes").children(".DataPendiente").children(".FechaPendiente");
			var	id			= check.val();
			
			if(check.is(':checked')){
				estado='F';
			}else{estado='P';}
			
			
				
			
			var DATA	= 'estado='+estado+'&id='+id+'&action=updateReminder';
			
			
			$.ajax({
					type: "POST",
					url: "../inicio/action.php",
					data: DATA,
					cache: false,
					success: function(data){
						
						//$('#load').fadeOut();
						if(data==1){
							if(decoration=="line-through"){
								titulo.css("text-decoration","none");
							}else{
								titulo.css("text-decoration","line-through");
							}
						}else{
							if(!data) $("#divError").html("Error: No se pudo modificar el recordatorio."); else $("#divError").html(data);
							$("#divError").slideDown(300).delay(8000).slideUp(400);
						}
						
					}
			});
			
			
	});
	
	/*UPDATE REMINDER LISTADO */
	$(".ChecksPendienteHoy").click(
	  function(){
			
			
			
			var decoration	= $(this).parents(".CheckPendiente").parents(".ContentPendientes").children(".DataPendiente").children(".TituloPendiente").css("text-decoration");
			var estado;
			var check 		= $(this);
			var titulo		= $(this).parents(".CheckPendiente").parents(".ContentPendientes").children(".DataPendiente").children(".TituloPendiente");
			var fecha		= $(this).parents(".CheckPendiente").parents(".ContentPendientes").children(".DataPendiente").children(".FechaPendiente");
			var	id			= check.val();
			
			if(check.is(':checked')){
				estado='F';
			}else{estado='P';}
			
			
				
			
			var DATA	= 'estado='+estado+'&id='+id+'&action=updateReminder';
			
			
			$.ajax({
					type: "POST",
					url: "../inicio/action.php",
					data: DATA,
					cache: false,
					success: function(data){
						
						//$('#load').fadeOut();
						if(data==1){
							if(decoration=="line-through"){
								titulo.css("text-decoration","none");
								$("#CantReminders").text($("#CantReminders").text()-(1*(-1)));
								$("#R"+id).attr('checked',false);
								$("#R"+id).parents(".RegReminder").children(".ContentTitulo").css("text-decoration","none");
							}else{
								titulo.css("text-decoration","line-through");
								$("#CantReminders").text($("#CantReminders").text()-1);
								$("#R"+id).attr('checked',true);
								$("#R"+id).parents(".RegReminder").children(".ContentTitulo").css("text-decoration","line-through");
							}
						}else{
							if(!data) $("#divError").html("Error: No se pudo modificar el recordatorio."); else $("#divError").html(data);
							$("#divError").slideDown(300).delay(8000).slideUp(400);
						}
						
					}
			});
			
			
	});
	
	  /* ELIMINAR RECORDATORIO */   
	$(".deletePend").click(function() {
		var id 			= $(this).attr("id");
		var userData 	= id.split("_");
		var texto;
		
		
		if(userData[1]>0){
			texto = " Se eliminarán los recordatorios programados.";
		}else{
			texto = "";
		}
		
		if(confirm('¿Desea eliminar este recordatorio?'+texto)){
			$('#load').fadeIn();
			var id 					= $(this).attr("id");
			var string 				= 'reminder_id='+ userData[0] + '&repeticion_id='+ userData[1] +'&action=delete' ;
		
			$.ajax({
	   				type: "POST",
	   				url: "../inicio/action.php",
	   				data: string,
	   				cache: false,
	   				success: function(data){
						$('#load').fadeOut();
						
						if(data){
							ids= data.split(",");
							for(i=0;i<ids.length;i++){
								if(ids[i]!="0"){
									$("#"+ids[i]).parents(".RegReminder").slideUp('slow', function() {$(this).remove();});
									$("#CantReminders").text($("#CantReminders").text()-1);
								}
							}
							ids= data.split("_");
							for(i=0;i<ids.length;i++){
								$("#CONT"+ids[i]).slideUp();
							}
						}else{
							if(!data) $("#divError").html("Error: No se pudo eliminar el registro."); else $("#divError").html(data);
							$("#divError").slideDown(300).delay(8000).slideUp(400);
						}
	  				}
	   
	 		});
	
			return false;
		}
	});
	/* FIN: ELIMINAR RECORDATORIO */ 
	
	
	
	$("#repeticion").change(function (){
		
		var tipo	= $("#repeticion").val();
		
			$("#U").hide();
			$("#S").hide();
			$("#M").hide();
			$("#A").hide();
		$("#"+tipo).show();	
			
	
	});
	
	$("input[type=radio]").click(function(){
		
			if($(this).val()=="Y"){
				$("#EnviosYfechas").slideDown();
			}else{
				$("#EnviosYfechas").slideUp();
			}
		
	});
	
	$("#desc").change(function(){
		var checkDesc	= $(".checkDesc").toArray();
		
		if(checkDesc[0].checked==true){
			$("#ContentDesc").slideDown();
		}else{
			$("#ContentDesc").slideUp();
		}
	})
	
	
	/* NUEVO RECORDATORIO */   
	$(".newR").click(function() {
		
		var inicio				= true;
		
		var recordar			= $("#EnviosYfechas").css("display");
		var titulo				= $("#titulo").val();
		var aviso 				= $(".aviso").toArray();
		var repeticion			= $("#repeticion").val();
		var descripcion			= $("#descripcion").val();
		var dia_u				= $("#dia_u").val();
		var dia_m				= $("#dia_m").val();
		var dia_a				= $("#dia_a").val();
		var mes_u				= $("#mes_u").val();
		var mes_a				= $("#mes_a").val();
		var anio_u				= $("#anio_u").val();
		var semana				= $("#semana").val();
		var admin				= $(".admin").toArray();
		
		if(recordar=="none"){
			repeticion	= "R";
		}
		
		
		var DATA 				= 'titulo='+ titulo +
								  '&repeticion='+ repeticion +
								  '&descripcion='+ descripcion +
								  '&dia_u='+ dia_u +
								  '&mes_u='+ mes_u +
								  '&anio_u='+ anio_u +
								  '&dia_a='+ dia_a +
								  '&mes_a='+ mes_a +
								  '&dia_m='+ dia_m +
								  '&semana='+ semana +
								  '&action=nuevoRecordatorio';
								  
		
		
		
		if(aviso[0].checked==true){
			DATA 	= DATA + '&email=Y';
		}else{
			DATA 	= DATA + '&email=N';
		}
		
		
		DATA 		= DATA + '&admin_id=';
		
		for(i=0;i<admin.length;i++){
			
			if(admin[i].checked==true){
				
				if(inicio==true){
					DATA 	= DATA + admin[i].value;
					inicio 	= false;
				}else{
					DATA	= DATA + ',' + admin[i].value;
				}
			}
			
		}
		
		//http://docs.jquery.com/Plugins/Validation/Validator
		
		if( $("#formNuevoRecordatorio").valid()){
			
			$('#load').fadeIn();
			$.ajax({
					type: "POST",
					url: document.location,
					data: DATA,
					cache: false,
					success: function(data){
						
						$('#load').fadeOut();
						if(data>0){
							$("#divMsg").html("El recordatorio se ha creado exitosamente.");
							$("#divMsg").slideDown(300).delay(8000).slideUp(400);
						}else{
							if(!data) $("#divError").html("Error: No se pudo crear el recordatorio."); else $("#divError").html(data);
							$("#divError").slideDown(300).delay(8000).slideUp(400);
						}
						
					}
			});
			
		}
	
		return false;
		
	});
	/* FIN: NUEVO RECORDATORIO */ 
	
	
	/* EDITAR RECORDATORIO */   
	$(".editR").click(function() {
		
		var recordar			= $("#EnviosYfechas").css("display");
		var titulo				= $("#titulo").val();
		var aviso 				= $(".aviso").toArray();
		var descarray 			= $(".desc").toArray();
		var repeticion			= $("#repeticion").val();
		var descripcion			= $("#descripcion").val();
		var dia_u				= $("#dia_u").val();
		var dia_m				= $("#dia_m").val();
		var dia_a				= $("#dia_a").val();
		var mes_u				= $("#mes_u").val();
		var mes_a				= $("#mes_a").val();
		var anio_u				= $("#anio_u").val();
		var semana				= $("#semana").val();
		var admin				= $(".admin").toArray();
		var reminder_id			= $("#reminder_id").val();
		var repeticion_id		= $("#repeticion_id").val();
		
		if(recordar=="none"){
			repeticion	= "R";
		}
		
		
		var DATA 				= 'titulo='+ titulo +
								  '&repeticion='+ repeticion +
								  '&dia_u='+ dia_u +
								  '&mes_u='+ mes_u +
								  '&anio_u='+ anio_u +
								  '&dia_a='+ dia_a +
								  '&mes_a='+ mes_a +
								  '&dia_m='+ dia_m +
								  '&semana='+ semana +
								  '&reminder_id='+ reminder_id +
								  '&repeticion_id='+ repeticion_id +
								  '&action=editarRecordatorio';
								  
		
		if(descarray[0].checked!=true){
			descripcion="";
		}
		
		DATA 	= DATA + '&descripcion=' + descripcion;
		
		if(aviso[0].checked==true){
			DATA 	= DATA + '&email=Y';
		}else{
			DATA 	= DATA + '&email=N';
		}
		
		
		DATA 		= DATA + '&admin_id=';
		
		for(i=0;i<admin.length;i++){
			
			if(admin[i].checked==true){
				
				if(i==0){
					DATA 	= DATA + admin[i].value;
				}else{
					DATA	= DATA + ',' + admin[i].value;
				}
			}
			
		}
		
		//http://docs.jquery.com/Plugins/Validation/Validator
		
		if( $("#formEditRecordatorio").valid()){
			
			$('#load').fadeIn();
			$.ajax({
					type: "POST",
					url: document.location,
					data: DATA,
					cache: false,
					success: function(data){
						
						$('#load').fadeOut();
						if(data>0){
							//$("#divMsg").html("El recordatorio se ha modificado exitosamente.");
							//$("#divMsg").slideDown(300).delay(8000).slideUp(400);
							document.location = "inicio.php";
							
						}else{
							if(!data) $("#divError").html("Error: No se pudo modificar el recordatorio."); else $("#divError").html(data);
							$("#divError").slideDown(300).delay(8000).slideUp(400);
						}
						
					}
			});
			
		}
	
		return false;
		
	});
	/* FIN: EDITAR RECORDATORIO */ 
	
	
		   
	
	
	
	
	
	

	
	
	/* BUSCADOR */
	
	$(".buscar").click(function(){
		Url	= $("#urlBuscador").val();
		Clave	= $("#buscador").val();
		document.location = Url+Clave;
		
	});
	
	/* FIN BUSCADOR */
	
	
	

	
	
	
	/* RECARGAR SELECTS */
	$("#owner_id").change(function () {
		
		
		$("#owner_id option:selected").each(function () {
			//alert($(this).val());
			id=$("#owner_id").val();
			if(id==""){id="0";}
			//Pasamos el parametro elegido, para comparalo con nuestra consulta y asi rellenar nuestro segundo combo
			$.post("change.inmueble.php", { id: id }, function(data){
				$('.removeInmueble').remove();
				$("#property_id").html(data);
			});
		});
		
		
	});
	/* FIN RECARGAR SELECTS */
	
	
	$('input').focus(function() {
	  if($(this).val()==$(this).attr("predetermined")){
			//alert($(this).attr("predetermined"));
			$(this).val('');
		}
	});
	
	$('input').blur(function() {
	  if($(this).val()==''){
			//alert($(this).attr("predetermined"));
			$(this).val($(this).attr("predetermined"));
		}
	});
	
});
