
$(document).ready(function() {
	var windowHeight	= window.innerHeight;
	if(!windowHeight) windowHeight	= window.outerHeight;
	if(!windowHeight) windowHeight	= 400;
	var marginTop		= (parseInt(windowHeight) - parseInt($(".LoginContent").css("height")))/2.5;
	$(".LoginContent").css("margin-top",marginTop+"px");
	
	if(get['error']=='login')
		msg.error("Debe tener permisos para ingresar.",5000)

});

function sumbitLogin(){
			var password 	= $("#password").val();
			var user		= $("#user").val();
			var target		= '../principal/main.php';
			var error		= 'Verifique los datos ingresados';
			var values		= 'user='+ user + '&password=' + password + '&target=' + target + '&error=' + error ;
			var	process		= "process.login.php";
			//var data		= submitAJAX(process,values);
			
			var info;
			$.ajax({
					type: "POST",
					url: process,
					data: values,
					cache: false,
					success: function(data){
						if(!data){
							document.location = target;
						}else{
							//alertify.error(error);
							//$("#ShowError").html(error);
							//$("#ShowErrorWrapper").fadeIn(1000).delay(5000).fadeOut(1000);//.setTimeout(function() {$("#ShowError").fadeOut();}, 5000);
							msg.error(error,5000);
						}
					}
			});
			
			
			

}

$(function(){
	$(".ButtonLogin").click(function(){
		if(validate.validateFields('')){
			sumbitLogin();
		}
	});
	
	$("input").keypress(function(e){
		if(e.which==13){
			$(".ButtonLogin").click();
		}
	});
	
});

