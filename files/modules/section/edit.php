<?php
	include('../../includes/inc.main.php');
	$Head->setTitle("Editar Secci&oacute;n");
	$Head->setHead();
	
	$Section_id	   = $_GET['id'];
	$Section       = new Section($Section_id);
	$Data          = $Section->GetData();
	
	$Status			= array();
	$Status['A']	= "Activo";
	$Status['I']	= "Inactivo";

    $Bool       = array();
    $Bool['Y']  = "Si";
    $Bool['N']  = "No";

?>
<body>
	<?php include("../../includes/inc.top.php"); ?>
    <div id="Content">
		<div class="FormWrapper">        
        	<form name="frm" id="frm" method="post" action="process.abm.php" enctype="multipart/form-data">
            <div class="ListTop BorderRadiusTop Noto14px">Editar Secci&oacute;n</div>
            <div class="ListBody Noto12px">
                <?php echo insertElement("hidden","action","update"); ?>
                <?php echo insertElement("hidden","section_id",$Section_id); ?>
                 <div>
                    <div class="Noto12px ColLeft">
                        
                        <div>
                            <div class="LabelWrapper Left">
                                Nombre:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','title',$Data['title'],'Input Arial12px BlueCyan Bold','tabindex="1" default="Nombre..." validateEmpty="El nombre es obligatorio." validateMinLength="3/El nombre debe contener 3 caracteres como m&iacute;nimo"'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Secci&oacute;n p&uacute;blica:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','public',$Data['public'],'Select Arial12px BlueCyan Bold','tabindex="2"',$Bool,'','','Y'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Habilitar comentarios:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','comment',$Data['comment'],'Select Arial12px BlueCyan Bold','tabindex="3"',$Bool,'','','Y'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Habilitar respuestas:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','reply',$Data['reply'],'Select Arial12px BlueCyan Bold','tabindex="4"',$Bool,'','','Y'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Estado:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','status',$Data['status'],'Select Arial12px BlueCyan Bold','tabindex="5"',$Status,'','','A'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Mostrar en:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','parent',$Data['parent'],'Select Arial12px BlueCyan Bold','tabindex="6"',$DB->fetchAssoc('select','menu','menu_id,title',"status = 'A'"),'-1','Menu Principal'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                         <?php 
                            $Hidden     = $Data['public'] == 'Y'? ' class="Hidden" ': ''; 
                            $Disabled   = $Data['public'] == 'Y'? ' disabled="disabled" ': '';
                         ?>
                        <div id="notPublic" <?php echo $Hidden; ?>>
                            <div>
                                <div class="LabelWrapper Left">
                                    Usuarios permitidos:
                                </div>
                                <div class="InputWrapper Left">
                                    <?php 
                                        $Profiles  = $DB->fetchAssoc('select','admin_profile','*','profile_id <> 1 AND profile_id >= '.$Admin->ProfileID,'title');
                                        foreach($Profiles as $Profile)
                                        {
                                            $Checked    = in_array($Profile['profile_id'],$Section->GetAllowedProfiles())? ' checked="checked" ' : '';
                                            echo '<div style="width:auto;">'.insertElement('checkbox','profile',$Profile['profile_id'],'Arial12px BlueCyan Bold',' tabindex="8"'.$Checked.$Disabled).' '.$Profile['title'].'</div>';     
                                        }
                                        
                                    ?>
                                </div>
                                <div class="Clear"></div>
                            </div>

                            <div>
                                <div class="LabelWrapper Left">
                                    Grupos permitidos:
                                </div>
                                <div class="InputWrapper Left">
                                    <?php
                                        $Groups  = $DB->fetchAssoc('select','admin_group','*','group_id IN (SELECT group_id FROM relation_group_profile WHERE profile_id <> 1 AND profile_id >= '.$Admin->ProfileID.')','name');
                                        foreach($Groups as $Group)
                                        {   
                                            $Checked    = in_array($Group['group_id'],$Section->GetAllowedGroups())? ' checked="checked" ' : '';
                                            echo '<div style="width:auto;">'.insertElement('checkbox','group',$Group['group_id'],'Arial12px BlueCyan Bold',' tabindex="9"'.$Checked.$Disabled).' '.$Group['name'].'</div>';     
                                        }
                                        
                                    ?>
                                </div>
                                <div class="Clear"></div>
                            </div>
                        </div>

                    </div>
                    <div class="Noto12px ColRight">
                        
                        <div>
                            <div class="LabelWrapper Left">
                                Administradores:
                            </div>
                            <div class="InputWrapper Left">
                                <?php 
                                    $Users  = $DB->fetchAssoc('select','admin_user','admin_id,first_name,last_name','profile_id<10 AND profile_id>1','last_name,first_name');
                                    foreach($Users as $User)
                                    {
                                        $Checked = in_array($User['admin_id'], $Section->GetAdmins())? ' checked="checked" ' : '';
                                        echo '<div style="width:auto;">';     
                                        echo insertElement('checkbox','admin',$User['admin_id'],'Arial12px BlueCyan Bold','mustBeChecked="1/Al menos 1 usuario debe estar seleccionado." tabindex="10"'.$Checked).' '.$User['last_name'].' '.$User['first_name'];
                                        echo '</div>';
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
                <?php echo insertElement('button','ButtonSubmit','GUARDAR CAMBIOS','SubmitButton Center Arial14px BlackGray Bold','tabindex="99"'); ?>
            </div>
            </form>
        </div>
    </div>
</body>
</html>