<?php 
	include('../../includes/inc.main.php');
	$Head->setTitle('Nuevo Grupo');
	$Head->setHead();
	
	$Status				= array();
	$Status['A']        = "Activo";
    $Status['I']        = "Inactivo";
    $Group = new GroupData();
?>
<body>
	<?php include('../../includes/inc.top.php');?>
    <div id="Content">
    
    	<div class="FormWrapper">        
        	<form name="frm" id="frm" method="post" action="process.abm.php" enctype="multipart/form-data">
            <div class="ListTop BorderRadiusTop Noto14px">Nuevo Grupo</div>
            <div class="ListBody Noto12px">
                <?php echo insertElement("hidden","action","insert"); ?>
                <div class="ListOptions Center">
                <?php 
                    echo insertElement('button','ButtonBack','VOLVER AL LISTADO','SubmitButton Center Arial14px BlackGray Bold','');
                ?>
                </div>
                <div>
                	<div class="Noto14px ColLeft">
                    	
                        <div>
                            <div class="LabelWrapper Left">
                            	Nombre:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','name','','Input Arial12px BlueCyan Bold','tabindex="1" default="Nombre del Grupo..." validateEmpty="El nombre es obligatorio." validateFromFile="process.abm.php/El nombre de grupo ya existe./action:=validate" validateMinLength="3/El nombre debe contener 3 caracteres como m&iacute;nimo"'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        

                        <div>
                            <div class="LabelWrapper Left">
                                Menues Asociados:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo $Group->MakeMenuList(); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        
                    </div>
                    <div class="Noto14px ColRight">
                        

                        <div>
                            <div class="LabelWrapper Left">
                                Perfiles Asociados:
                            </div>
                            <div class="InputWrapper Left">
                                <?php 
                                    $Profiles = $DB->fetchAssoc('select','admin_profile','*',"profile_id > 1","title");
                                    foreach ($Profiles as $Profile)
                                    {
                                     echo '<div style="width:auto;">'.insertElement('checkbox','profiles',$Profile['profile_id'],'Arial12px BlueCyan Bold','tabindex="9"').' '.$Profile['title'].'</div>';   
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
            	<?php echo insertElement('button','ButtonSubmit','CREAR NUEVO GRUPO','SubmitButton Center Arial14px BlackGray Bold','tabindex="9"'); ?>
            </div>
            </form>
        </div>
    </div>
</body>
</html>