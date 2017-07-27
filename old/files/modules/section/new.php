<?php 
	include('../../includes/inc.main.php');
	$Head->setTitle('Nueva Secci&oacute;n');
	$Head->setHead();
	
	$Status         = array();
	$Status['A']    = "Activo";
    $Status['I']    = "Inactivo";

    $Bool       = array();
    $Bool['Y']  = "Si";
    $Bool['N']  = "No";
?>
<body>
	<?php include('../../includes/inc.top.php');?>
    <div id="Content">
    
    	<div class="FormWrapper">        
        	<form name="frm" id="frm" method="post" action="process.abm.php" enctype="multipart/form-data">
            <div class="ListTop BorderRadiusTop Noto14px">Nueva Secci&oacute;n</div>
            <div class="ListBody Noto12px">
                <?php echo insertElement("hidden","action","insert"); ?>
                <div>
                	<div class="Noto12px ColLeft">
                    	
                        <div>
                            <div class="LabelWrapper Left">
                            	Nombre:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','title','','Input Arial12px BlueCyan Bold','tabindex="1" default="Nombre..." validateEmpty="El nombre es obligatorio." validateMinLength="3/El nombre debe contener 3 caracteres como m&iacute;nimo"'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Secci&oacute;n p&uacute;blica:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','public','','Select Arial12px BlueCyan Bold','tabindex="2"',$Bool,'','','Y'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Habilitar comentarios:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','comment','','Select Arial12px BlueCyan Bold','tabindex="3"',$Bool,'','','Y'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Habilitar respuestas:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','reply','','Select Arial12px BlueCyan Bold','tabindex="4"',$Bool,'','','Y'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Estado:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','status','','Select Arial12px BlueCyan Bold','tabindex="5"',$Status,'','','A'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Mostrar en:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','parent','','Select Arial12px BlueCyan Bold','tabindex="6"',$DB->fetchAssoc('select','menu','menu_id,title',"status = 'A'"),'-1','Menu Principal'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div id="notPublic" style="display:none;">
                            <div>
                                <div class="LabelWrapper Left">
                                    Usuarios permitidos:
                                </div>
                                <div class="InputWrapper Left">
                                    <?php 
                                        $Profiles  = $DB->fetchAssoc('select','admin_profile','*','profile_id <> 1 AND profile_id >= '.$Admin->ProfileID,'title');
                                        for($i=0;$i<count($Profiles);$i++)
                                        {
                                            $Checked = ' checked="checked" ';
                                            echo '<div style="width:auto;">'.insertElement('checkbox','profile',$Profiles[$i]['profile_id'],'Arial12px BlueCyan Bold','tabindex="8"'.$Checked).' '.$Profiles[$i]['title'].'</div>';     
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
                                        for($i=0;$i<count($Groups);$i++)
                                        {
                                            $Checked = ' checked="checked" ';
                                            echo '<div style="width:auto;">'.insertElement('checkbox','group',$Groups[$i]['group_id'],'Arial12px BlueCyan Bold','tabindex="9"'.$Checked).' '.$Groups[$i]['name'].'</div>';     
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
                                    for($i=0;$i<count($Users);$i++)
                                    {
                                        $Checked = $Users[$i]['admin_id'] == $Admin->AdminID? ' checked="checked" ' : '';
                                        echo '<div style="width:auto;">'.insertElement('checkbox','admin',$Users[$i]['admin_id'],'Arial12px BlueCyan Bold','tabindex="10"'.$Checked).' '.$Users[$i]['last_name'].' '.$Users[$i]['first_name'].'</div>';     
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
            	<?php echo insertElement('button','ButtonSubmit','CREAR NUEVA SECCI&Oacute;N','SubmitButton Center Arial14px BlackGray Bold','tabindex="99"'); ?>
            </div>
            </form>
        </div>
    </div>
</body>
</html>