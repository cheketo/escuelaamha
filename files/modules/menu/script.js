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
	
	$('input[type!="button"]').keypress(function(e){
		if(e.which==13){
			$("#ButtonSubmit").click();
		}
	});

	//// SEARCHER ////
	$("#ButtonFilter").click(function(){
		$("#ListSearcher").toggle();
		//$('#ListSearcher').animate({width: 'toggle'});
	})

	// NEW MENU //
	$("#ButtonNew").click(function(){
		document.location = 'new.php';
	});
	
});