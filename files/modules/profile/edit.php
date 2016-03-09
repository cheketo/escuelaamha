<?php
	include("../../includes/inc.main.php");
	$Head->setTitle("Administraci&oacute;n de Perfiles");
    $Head->setHead();

    $Where = $Admin->ProfileID == 1 ? "" : "profile_id>1";
?> 
<body>
	<?php include("../../includes/inc.top.php"); ?>
	<div id="Content">
        <div class="FormWrapper">
            <div class="ListTop BorderRadiusTop Noto14px" id="list_title">Editar Perfil</div>
            <div class="ListBody Noto12px">
                <div class="MarginAuto EditProfiles">
                    <div id="new_profile" class="Hidden">
                        <form name="new" id="new" enctype="multipart/form-data" action="">
                            <?php echo insertElement('input','name','','Select Arial12px BlueCyan Bold','tabindex="1" validateEmpty="El nombre del perfil es obligatorio." default="Nombre..."'); ?>
                            <?php echo insertElement('button','SubmitButton','ACEPTAR','SubmitButton Center Arial14px BlackGray Bold NewProfileButton','tabindex="4"'); ?>
                            <?php echo insertElement('button','CancelButton','CANCELAR','SubmitButton Center Arial14px BlackGray Bold NewProfileButton','tabindex="5"'); ?>
                        </form>
                    </div>
                    <div id="profiles" class="Center">
                        <?php	echo insertElement('select','profile_id',$_GET['id'],'Select Arial12px BlueCyan Bold','tabindex="8"',$DB->fetchAssoc('select','admin_profile','profile_id,title',$Where,"title"),'0','Seleccione un perfil'); ?>
                        <?php echo insertElement('button','newProfile','NUEVO PERFIL','SubmitButton Center Arial14px BlackGray Bold NewProfileButton','tabindex="9"'); ?>
                        
                        <div id="profile_content">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="ListBot BorderRadiusBot Frutiger14px"></div>
        </div>
    </div>
</body>
</html>