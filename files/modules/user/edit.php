<?php
	include('../../includes/inc.main.php');
	$Head->setTitle("Editar Usuario Administrador");
	$Head->setHead();
	
	$Admin_id	= $_GET['id'];
	$AdminEdit	= new AdminData($Admin_id);
	$AdminData	= $AdminEdit->GetData();
	//$Result		= $DB->fetchAssoc('select','admin_user','*',"admin_id = ".$Admin_id);
	//insertElement('select','profile_id',$Result[0]['profile_id'],'Select Arial12px BlueCyan Bold','tabindex="8" validateEmpty="El perfil es obligatorio."',$DB->fetchAssoc('select','admin_profile','profile_id,title',"","profile_id"),'','Seleccione un perfil');
	
	$Status				= array();
	$Status['A']        = "Activo";
    $Status['I']        = "Inactivo";

?>
<body>
	<?php include("../../includes/inc.top.php"); ?>
    <div id="Content">
		<div class="FormWrapper">        
        	<form name="frm" id="frm" method="post" action="process.abm.php" enctype="multipart/form-data">
            <div class="ListTop BorderRadiusTop Noto14px">Editar Usuario Administrador</div>
            <div class="ListBody Noto12px">
                <?php echo insertElement("hidden","action","update"); ?>
                <?php echo insertElement("hidden","admin_id",$Admin_id); ?>
                <div class="ListInnerOptions Center">
                <?php 
                    echo insertElement('button','ButtonBack','VOLVER AL LISTADO','SubmitButton Center Arial14px BlackGray Bold','');
                    echo insertElement('hidden','target','list.php');
                ?>
                </div>
                <div>
                	<div class="Noto14px ColLeft">
                    	
                        <div>
                            <div class="LabelWrapper Left">
                            	Usuario:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','user',$AdminData['user'],'Input Arial12px BlueCyan Bold','tabindex="1" default="Usuario..." validateEmpty="El usuario es obligatorio." validateFromFile="process.abm.php/El nombre de usuario ya existe./actualuser:='.$AdminData['user'].'/action:=validate" validateMinLength="4/El usuario debe contener 4 caracteres como m&iacute;nimo"'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        <?php if($Admin->AdminData['profile_id']>2){ ?>
                        <div>
                            <div class="LabelWrapper Left">
                            	Contrase&ntilde;a Actual:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('password','oldpassword','','Input Arial12px BlueCyan Bold','tabindex="2" default="Contrase&ntilde;a Actual..." '); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        <?php } ?>
                        <div>
                            <div class="LabelWrapper Left">
                            	Nueva Contrase&ntilde;a:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('password','password','','Input Arial12px BlueCyan Bold','tabindex="2" default="Nueva Contrase&ntilde;a..." '); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        <?php if($Admin->AdminData['profile_id']>2){ ?>
                        <div>
                            <div class="LabelWrapper Left">
                            	Repita Contrase&ntilde;a:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('password','password2','','Input Arial12px BlueCyan Bold','tabindex="3" default="Nueva Contrase&ntilde;a..." validateEqualToField="password/Las contrase&ntilde;as deben coincidir."'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        <?php } ?>
                         <div>
                            <div class="LabelWrapper Left">
                            	Estado:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','status',$AdminData['status'],'Select Arial12px BlueCyan Bold','tabindex="4"',$Status,'','','A'); ?>
                            </div>
                         	<div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Menues Asociados:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo $AdminEdit->MakeMenuList(); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        
                    </div>
                    <div class="Noto14px ColRight">
                    
                    	 <div>
                            <div class="LabelWrapper Left" style="line-height:45px!important;">
                            	Im&aacute;gen:
                            </div>
                            <div class="InputWrapper Left">
                                <div class="FormAdminUserImg">
                                	<img src="<?php echo $AdminEdit->GetImg(); ?>" width="45" height="45" />
                                </div>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        
                        <div>
                            <div class="LabelWrapper Left">
                            	Cambiar Im&aacute;gen:
                            </div>
                            <div class="InputWrapper Left">
								<?php echo insertElement('file','img','','Input Arial12px BlueCyan Bold Pointer','tabindex="7" default="Seleccione una imagen..."'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                    
                    	<div>
                            <div class="LabelWrapper Left">
                            	Nombre:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','first_name',$AdminData['first_name'],'Input Arial12px BlueCyan Bold','tabindex="5" default="Nombre..."'); ?>
                            </div>
                         	<div class="Clear"></div>
                        </div>
                        
                        <div>
                            <div class="LabelWrapper Left">
                            	Apellido:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','last_name',$AdminData['last_name'],'Input Arial12px BlueCyan Bold','tabindex="6" default="Apellido..."'); ?>
                        	</div>
                            <div class="Clear"></div>
                        </div>
                        
                        <div>
                            <div class="LabelWrapper Left">
                            	Perfil:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','profile_id',$AdminData['profile_id'],'Select Arial12px BlueCyan Bold','tabindex="8" validateEmpty="El perfil es obligatorio."',$DB->fetchAssoc('select','admin_profile','profile_id,title',"","profile_id"),'','Seleccione un perfil'); ?>
                            </div>
                         	<div class="Clear"></div>
                        </div>

                        <?php 
                            $Groups = $DB->fetchAssoc('select','admin_group','*',"group_id IN (SELECT group_id FROM relation_group_profile WHERE profile_id = ".$AdminData['profile_id'].")","name"); 
                            if(count($Groups)<1) $Style = ' style="display:none;"';
                        ?>

                        <div id="groups" <?php echo $Style ?>>
                            <div class="LabelWrapper Left">
                                Grupo:
                            </div>
                            <div id="groupsInput" class="InputWrapper Left">
                                <?php

                                    $Groups = $DB->fetchAssoc('select','admin_group','*',"group_id IN (SELECT group_id FROM relation_group_profile WHERE profile_id = ".$AdminData['profile_id'].")","name");
                                    foreach ($Groups as $Group)
                                    {
                                        $Checked = in_array($Group['group_id'], $AdminEdit->GetGroups())? ' checked="checked" ' : '';
                                        echo '<div style="width:auto;">'.insertElement('checkbox','group_id',$Group['group_id'],'Arial12px BlueCyan Bold','tabindex="9" '.$Checked).' '.$Group['name'].'</div>';   
                                    }
                                ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                    </div>
                    <div class="Clear"></div>
                </div>
                
            </div>
            <div class="ListBot BorderRadiusBot Frutiger14px" style="padding:5px;">
            	<?php echo insertElement('button','ButtonSubmit','EDITAR USUARIO','SubmitButton Center Arial14px BlackGray Bold','tabindex="9"'); ?>
            </div>
            </form>
        </div>
    </div>
</body>
</html>