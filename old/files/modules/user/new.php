<?php 
	include('../../includes/inc.main.php');
	$Head->setTitle('Nuevo Usuario Administrador');
	$Head->setHead();
	
	$Status				= array();
	$Status['A']        = "Activo";
    $Status['I']        = "Inactivo";

    $AdminData  = new AdminData(0);
?>
<body>
	<?php include('../../includes/inc.top.php');?>
    <div id="Content">
    
    	<div class="FormWrapper">        
        	<form name="frm" id="frm" method="post" action="process.abm.php" enctype="multipart/form-data">
            <div class="ListTop BorderRadiusTop Noto14px">Nuevo Usuario Administrador</div>
            <div class="ListBody Noto12px">
                <?php echo insertElement("hidden","action","insert"); ?>
                <div class="ListInnerOptions Center">
                <?php 
                    echo insertElement('button','ButtonBack','VOLVER AL LISTADO','SubmitButton Center Arial14px BlackGray Bold','');
                ?>
                </div>
                <div>
                	<div class="Noto14px ColLeft">
                    	
                        <div>
                            <div class="LabelWrapper Left">
                            	Usuario:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','user','','Input Arial12px BlueCyan Bold','tabindex="1" default="Usuario..." validateEmpty="El usuario es obligatorio." validateFromFile="process.abm.php/El nombre de usuario ya existe./action:=validate" validateMinLength="4/El usuario debe contener 4 caracteres como m&iacute;nimo"'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        
                        <div>
                            <div class="LabelWrapper Left">
                            	Contrase&ntilde;a:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('password','password','','Input Arial12px BlueCyan Bold','tabindex="2" default="Contrase&ntilde;a..." validateEmpty="La contrase&ntilde;a es obligatoria."'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        
                        <div>
                            <div class="LabelWrapper Left">
                            	Repita Contrase&ntilde;a:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('password','password2','','Input Arial12px BlueCyan Bold','tabindex="3" default="Repita Contrase&ntilde;a..." validateEmpty="La contrase&ntilde;a es obligatoria." validateEqualToField="password/Las contrase&ntilde;as deben coincidir."'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        
                         <div>
                            <div class="LabelWrapper Left">
                            	Estado:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','status','','Select Arial12px BlueCyan Bold','tabindex="4"',$Status,'','','A'); ?>
                            </div>
                         	<div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Menues Asociados:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo $AdminData->MakeMenuList(); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        
                    </div>
                    <div class="Noto14px ColRight">
                    
                    	<div>
                            <div class="LabelWrapper Left">
                            	Nombre:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','first_name','','Input Arial12px BlueCyan Bold','tabindex="5" default="Nombre..."'); ?>
                            </div>
                         	<div class="Clear"></div>
                        </div>
                        
                        <div>
                            <div class="LabelWrapper Left">
                            	Apellido:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','last_name','','Input Arial12px BlueCyan Bold','tabindex="6" default="Apellido..."'); ?>
                        	</div>
                            <div class="Clear"></div>
                        </div>
                        
                        <div>
                            <div class="LabelWrapper Left">
                            	Im&aacute;gen:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('file','img','','Input Arial12px BlueCyan Bold Pointer','tabindex="7" default="Seleccione una imagen..."'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        
                        <div>
                            <div class="LabelWrapper Left">
                            	Perfil:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','profile_id','','Select Arial12px BlueCyan Bold','tabindex="8" validateEmpty="El perfil es obligatorio."',$DB->fetchAssoc('select','admin_profile','profile_id,title',"","profile_id"),'','Seleccione un perfil'); ?>
                            </div>
                         	<div class="Clear"></div>
                        </div>

                        <div id="groups" style="display:none;">
                            <div class="LabelWrapper Left">
                                Grupo:
                            </div>
                            <div class="InputWrapper Left" id="groupsInput">
                                <?php 
                                    $Groups = $DB->fetchAssoc('select','admin_group','*',"","name");
                                    foreach ($Groups as $Group)
                                    {
                                     echo '<div style="width:auto;">'.insertElement('checkbox','group_id',$Group['group_id'],'Arial12px BlueCyan Bold','tabindex="9"').' '.$Group['name'].'</div>';   
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
            	<?php echo insertElement('button','ButtonSubmit','CREAR NUEVO USUARIO','SubmitButton Center Arial14px BlackGray Bold','tabindex="9"'); ?>
            </div>
            </form>
        </div>
    </div>
</body>
</html>