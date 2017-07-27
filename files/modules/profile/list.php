<?php
	include("../../includes/inc.main.php");
	$Head->setTitle("Listado de Perfiles");
	$Head->setHead();
?>
<body>
	<?php include("../../includes/inc.top.php"); ?>
	<div id="Content">
    <div class="FormWrapper">        
            <div class="ListTop BorderRadiusTop Noto14px">Listado de Perfiles </div>
            <div class="ListOptions Noto12px">
            	<?php echo insertElement('button','new_newprofile','NUEVO PERFIL','SubmitButton Center Arial14px BlackGray Bold NewProfileButton','tabindex="2"'); ?>
                <?php echo insertElement('button','edit_editprofile','EDITAR PERFILES','SubmitButton Center Arial14px BlackGray Bold NewProfileButton','tabindex="3"'); ?>
            </div>
            <div class="ListBody Noto12px">
                <?php 
					$Profiles = new ProfileData();
					echo $Profiles->MakeProfileList();  
				?>
            </div>
            <div class="ListBot BorderRadiusBot Frutiger14px"></div>
        </div>
    </div>
</body>
</html>