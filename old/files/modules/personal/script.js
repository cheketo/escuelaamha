$(function(){
	// IMPORT ACTIONS
	$("#ButtonSubmit").click(function(){
		if(validate.validateFields('frm')){
			$("#frm").submit();
		}
	});
	
	$("#ButtonSearch").click(function(){
		if(validate.validateFields('frm')){
			window.location.href = "list.php?year="+$("#year").val()+"&month="+$("#month").val();
		}
	});
	
	$("input").keypress(function(e){
		if(e.which==13){
			$("#ButtonSubmit").click();
		}
	});
	
	$("#year,#month").keypress(function(e){
		if(e.which==13){
			$("#ButtonSearch").click();
		}
	});
	
	
	// LIST ACTIONS
	$("img").click(function(){
		var info	= $(this).attr("id").split('_');
		var action	= info[0];
		var id		= info[1];
		
		switch(action){
			case "view": 	window.location.href = "view.php?id="+id; break;
			case "edit": 	window.location.href = "edit.php?id="+id; break;
			case "delete": 	
							showPopUpConfirm('<div style="padding:10px;">¿Desea eliminar este registro?</div>');
							$("#PopUpConfirm").click(function(){
								var string		= 'id='+ id + '&action=delete';
								var	process		= "process.abm.php";
								
								$.ajax({
										type: "POST",
										url: process,
										data: string,
										cache: false,
										success: function(data){
											if(data){
													$("#Row"+id).slideUp();
											}
											
										}
								});
							});
			break;
		}
	});
	
});