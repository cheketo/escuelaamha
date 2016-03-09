<?php 
	include("../../includes/inc.main.php");
	$Head->setTitle("Login");
	$Head->setLink('http://fonts.googleapis.com/css?family=Press+Start+2P','stylesheet','text/css');
	$Head->setHead();
?>
<body class="BodyLogin">
    <div id="MessageWrapper" style="top:75%!important">
        <div id="MessageError" class="Center White Noto16px MessageErrorShadow"></div>
        <div id="MessageSuccess" class="Center White Noto16px MessageSuccessShadow"></div>
        <div id="MessageNormal" class="Center White Noto16px MessageNormalShadow"></div>
    </div>
	<div class="LoginContent Arial12px">
    	<div class="LogoLogin"></div>
    	<div class="TitleLogin Center Arial14px Gray Bold">Bienvenido al Campus Virtual</div>
        <div class="Center Arial12px Gray">Complete su usuario y contrase&ntilde;a para ingresar</div>
            <div class="UserLogin Arial12px Bold">Usuario:</div>
            <div class="Center">
            	<?php echo insertElement('text','user','','InputLogin Arial12px BlueCyan Bold','tabindex="1" validateEmpty="Debe ingresar su usuario" validateMinLength="4/El usuario debe contener 4 caracteres como m&iacute;nimo" default="Usuario..."'); ?>
            </div>
            <div class="UserLogin Arial12px Bold">Contrase&ntilde;a:</div>
            <div class="Center">
            	<?php echo insertElement('password','password','','InputLogin Arial12px BlueCyan Bold','tabindex="2" validateEmpty="Debe ingresar su password" default="Contrase&ntilde;a..."'); ?>
            </div>
        <div class="ButtonLogin Center Arial14px BlackGray Bold" style="nav-index:3;">INGRESAR</div>
    </div>
</body>
</html>