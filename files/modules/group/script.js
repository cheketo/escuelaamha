$(function(){

	////// NEW-EDIT ADMIN ACTIONS //////
	$("#ButtonSubmit").click(function(){
		if(validate.validateFields('frm')){
			var process		= 'process.abm.php';
	 		var target		= 'list.php';
	 		var haveData	= function(returningData)
	 		{
	 			$("input,select").blur();
				msg.error(returningData,10000);
	 		}
	 		var noData		= function()
	 		{
	 			document.location = target;
	 		}
			sumbitFields(process,haveData,noData);
		}
	});
	
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

	// NEW USER //
	$("#ButtonNew").click(function(){
		document.location = 'new.php';
	});

	// RETURN //
	$("#ButtonBack").click(function(){
		document.location = 'list.php';
	});


	// TOGGLE MENUES
	$(".Parent").click(function(){
		var id = $(this).attr("id");
		$("#Child"+id).slideToggle();
		if($("#img"+id).hasClass("ArrowDown"))
		{
			$("#img"+id).removeClass("ArrowDown");
			$("#img"+id).addClass("ArrowLeft");
		}else{
			$("#img"+id).removeClass("ArrowLeft");
			$("#img"+id).addClass("ArrowDown");
		}
	});
	
	$(".MenuCheckbox").change(function(){
		var id	= $(this).val();
		if($(this).is(":checked"))
		{
			$("#Child"+id).slideDown();
			$(".Menu"+id).attr("disabled",false);
			$("#img"+id).removeClass("ArrowDown");
			$("#img"+id).addClass("ArrowLeft");
		}else{
		   	$(".Menu"+id).attr("checked",false); 
		   	$(".Menu"+id).change();
		   	$(".Menu"+id).attr("disabled",true);
           	
			//$("#Child"+id).slideUp();
		}
	});
	
});