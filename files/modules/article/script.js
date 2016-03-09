$(document).ready(function()
{
	//////////////////////////////////////////////////// File Uploader /////////////////////////////////////////////////////
	$("#uploader").uploadFile({
		url:"process.abm.php",
		fileName: "uploadedfile",
		multiple:true,
		showDelete: true,
		showDone:false,
		statusBarWidth:578,
		dragdropWidth:545,
		formData: {"action":"upload","token": "admin"+$("#admin").val()},
		dragDropStr: "<span><b>Arrastre los archivos aqui.</b></span>",
		abortStr:"Abandonar",
		cancelStr:"Cancelar",
		deletelStr:"Borrar",
		doneStr:"OK",
		multiDragErrorStr: "Varios archivos no están permitidos.",
		extErrorStr:"No está permitido. Extensiones permitidas:",
		sizeErrorStr:"No está permitido. Tamaño máximo permitido:",
		uploadErrorStr:"No puede subir.",
		deleteCallback: function (data, pd) {
		   
	    	var i = 0;
	    	var file = "";
	    	for(i=2;i<(data.length-2);i++) file = file + data[i];
		    alertify.confirm(utf8_decode("¿Desea eliminar este archivo?"), function(e){
				if(e){
			        $.post("process.abm.php", {action: "deletefile",name: file,"token": "admin"+$("#admin").val()},
			            function (resp,textStatus, jqXHR) {
			                //Show Message	
			                //alert(resp);
			                //
			            }
			        );
			    	msg.success("Archivo Borrado",1000);
			    	pd.statusbar.hide(); //You choice.
				}
		   	});
		}
	});	

});

$(function(){

	//IMG ACTION
	$("img").click(function(){
		if($(this).attr("action")=="view"){
			window.location = $(this).attr("target");
		}
	})

	// DELETE FILES (EDIT)
	$(".FileDeleteButton").click(function(){
		 var fileObj = $(this);
		 alertify.confirm(utf8_decode("¿Desea eliminar este archivo?"), function(e){
		 	if(e){
		 		
				$.post("process.abm.php", {action: "deletefile",file: fileObj.attr("file"),name: fileObj.attr("name"),path: $("#article").val()},
				function (resp,textStatus, jqXHR) {
				    //alert(resp);
				});
				msg.success("Archivo Borrado",1000);
				fileObj.parent().hide();
			}
		});
	});

	////// NEW-EDIT ADMIN ACTIONS //////
	$("#ButtonSubmit").click(function(){
		if(validate.validateFields('frm')){
			var process		= 'process.abm.php';
	 		var target		= 'list.php';
	 		var haveData	= function(returningData)
	 		{
	 			$("textarea,input,select").blur();
				msg.error(returningData,10000);
	 		}
	 		var noData		= function()
	 		{
	 			document.location = target;
	 		}
			sumbitFields(process,haveData,noData);
		}
	});

	////// NEW COMMENT ACTIONS //////
	$(".ButtonComment").click(function(){
		submitComment($(this));
	});

	$(".reply").click(function(){
		replyToggle($(this));		
	});

	

	$("#newcomment0").click(function(){
		$(".comcont").slideUp();
	});

	function submitComment(elem)
	{
		var button 	= elem;
		var parent	= elem.attr("parent");
		var text	= $("#newcomment"+parent).val();
		var process = 'process.abm.php';
		//var string 	= 'action=newcomment&article='+$("#article").val()+'&parentid='+parent+'&message='+text;

		//alert(string);

		$.ajax({
			url: process,
			type:'POST',
			data:{action:"newcomment",article:$("#article").val(),parentid:parent,message:text},
			success: function(rs){
				if(rs)
				{
					if(parseInt(parent)>0)
						button.parent().parent().parent().before(rs);
					else
						$("#CommentContainer0").before(rs);
				}
				
				$("#newcomment"+parent).val('');
				$("#newcomment"+parent).blur();
			}
		});
	}

	function replyToggle(elem)
	{
		var comment = elem.attr("comment");
		if($("#CommentContainer"+comment).css("display")=="none"){
			$(".comcont").slideUp();
			$("#CommentContainer"+comment).slideDown();
		}else{
			$("#CommentContainer"+comment).slideUp();
		}
	}

	
	$("input").keypress(function(e){
		if(e.which==13){
			$("#ButtonSubmit").click();
		}
	});

	//// SEARCHER ////
	$("#ButtonFilter").click(function(){
		$("#ListSearcher").toggle();
		//$('#ListSearcher').animate({width: 'toggle'});
	})

	// NEW ARTICLE //
	$("#ButtonNew").click(function(){
		document.location = 'new.php';
	});

	// TOGGLE NOT PUBLIC PROFILES //
	$("#public").change(function(){
		if($(this).val()=='Y')
		{
			$("#notPublic").slideUp();
			$('input:checkbox[name="profile"]').each(function(){$(this).attr('disabled',true);});
		}else{
			$("#notPublic").slideDown();
			$('input:checkbox[name="profile"]').each(function(){$(this).attr('disabled',false);});
		}
	});
	
});