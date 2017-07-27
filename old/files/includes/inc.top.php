<div id="MessageWrapper">
        <div id="MessageError" class="Center White Noto16px MessageErrorShadow"></div>
        <div id="MessageSuccess" class="Center White Noto16px MessageSuccessShadow"></div>
        <div id="MessageNormal" class="Center White Noto16px MessageNormalShadow"></div>
    </div>
<div id="BodyOverlay"></div>
<div id="PopUpWrapper">
	<div id="PopUpBody" class="Noto14px DarkGray"></div>
    <div class="PopUpOptions">
    	<?php
			echo insertElement('button','PopUpConfirm','Confirmar','PopUpButton Gray Bold');
			echo insertElement('button','PopUpCancel','Cancelar','PopUpButton Gray Bold');
		?>
    </div>
</div>
<div id="Top" class="Noto12px">
	<div class="TopContent">
        <div class="Shortcuts LightGray">
            <!--
            <div class="ShortcutButton">Link</div>
            <div class="ShortcutButton">Link</div>
            <div class="ShortcutButton">Link</div>
            <div class="ShortcutButton">Link</div>
            <div class="Clear"></div>
        -->
        </div>
        <div class="HeadShadowBot"></div>
        <?php if($Security->IsLogged){ ?>
        <div class="AdminUserBox">
        	<div class="AdminUserImg"><img src="<?php echo $Admin->Img; ?>" width="45" height="45" /></div>
            <div class="Right White">
            	<div class="AdminUserName"><?php echo $Admin->FullUserName; ?></div>
                <div class="AdminLogout"><a href="#" id="Logout">Cerrar Sesi&oacute;n</a><!-- | <a href="#" id="MyAccount">Mi Cuenta</a>--></div>
            </div>
        	<div class="Clear"></div>
        </div>
        <?php }else{ ?>
        <div class="AdminUserBox">
            <div class="AdminLogin BlueCyan Bold BorderRadius"><a href="../login/login.php" id="Login">Ingresar <img alt="Ingresar" style="width: 20px; height: 20px;" src="../../../skin/images/body/icons/login.png"></a></div>
        </div>
        <?php } ?>
        <div class="MinLogo">
        	<div class="Left"><img src="../../../skin/images/body/logos/amha_logo.png" /></div>
            <div class="Montserrat20px DarkGray Left" >
            	<div style="line-height:30px; margin-left:10px; text-align:center; margin-top:10px;">CAMPUS VIRTUAL</div>
                <div style="text-align:center; margin-left:10px;" class="Montserrat16px">Escuela de Posgrado</div>
                <div style="border-bottom:3px solid #333; border-right:3px solid #333; margin-left:10px; padding-right:5px; padding-bottom:1px;" class="Montserrat14px"><a href="http://www.amha.org.ar" target="_blank" style="color:#FFF;">Asociaci&oacute;n M&eacute;dica Homeop&aacute;tica Argentina</a></div>
            </div>
            <div class="Clear"></div>
        </div>
        <div class="HeadShadowTop"></div>
	</div>
	<div class="MenuContent White">
		<?php
			$Menu	= new Menu();
			$Menu	->insertMenu($_SESSION['profile_id'],$_SESSION['admin_id']);
		?>
    <div class="MenuShadowBot"></div>
    </div>
    
</div>