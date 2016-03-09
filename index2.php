<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="es"/>
<link href="skin/images/body/icons/amha.ico" rel="shortcut icon" type="image/x-icon">

	<script src="files/js/script.jquery.min.js"></script>
    <script src="files/js/script.validate.js"></script>
	<script src="files/js/script.message.js"></script>
	<script src="files/js/script.common.js"></script>
  
    <link rel="stylesheet" href="skin/css/styles.css" type="text/css" />
    <link rel="stylesheet" href="skin/css/fonts.css" type="text/css" />
    <link rel="stylesheet" href="skin/css/colors.css" type="text/css" />
<title>Escuela de Posgrado AMHA | Campus Virtual</title>
<script type="text/javascript">

$(document).ready(function() {
	autoAdjust();
});

$(window).resize(function() {
	autoAdjust2();
});

function autoAdjust()
{
	var windowHeight				= window.innerHeight;
	if(!windowHeight) windowHeight	= window.outerHeight;
	if(!windowHeight)
	{
		margin = 30;
	}
	else
	{
		var margin		= (parseInt(windowHeight) - parseInt($("body").css("height")))/5;
	}
	 
	if(margin>0) $(".resize").css("margin-top",margin+"px");
}

function autoAdjust2()
{
	var windowHeight				= window.innerHeight;
	if(!windowHeight) windowHeight	= window.outerHeight;
	if(!windowHeight)
	{
		margin = 30;
	}
	else
	{
		var margin		= (parseInt(windowHeight)+120 - parseInt($("body").css("height")))/5;
	}
	 
	if(margin>0) $(".resize").css("margin-top",margin+"px");
}
</script>
</head>
<body class="cover" style="min-height:500px;">
	
	<div class="LightGray Frutiger50px Center resize" >Campus Virtual de la Escuela de Posgrado de la A.M.H.A.</div>
    <div class="Gray Frutiger25px Center resize">Disculpe las molestias, el Campus Virtual est&aacute; en construcci&oacute;n</div>
    
    <div class="Center resize"><img src="skin/images/body/logos/campus_logo3.png" width="400" height="378" /></div>
   
        <div class="MarginAuto resize" style="width:430px;" >
            <div class="Left"><img src="skin/images/body/logos/amha_logo.png" /></div>
            <div class="Montserrat20px LightGray Left" >
                <div style="line-height:30px; margin-left:10px; text-align:center; margin-top:10px;">CAMPUS VIRTUAL</div>
                <div style="text-align:center; margin-left:10px;" class="Montserrat16px">Escuela de Posgrado</div>
                <div style="border-bottom:3px solid #999; border-right:3px solid #999; margin-left:10px; padding-right:5px; padding-bottom:1px;" class="Montserrat14px">Asociaci&oacute;n M&eacute;dica Homeop&aacute;tica Argentina</div>
            </div>
            <div class="Clear"></div>
        </div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48988265-1', 'escuelaamha.com.ar');
  ga('send', 'pageview');

</script>
</body>
</html>