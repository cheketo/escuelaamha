<?php 
	include('../../includes/inc.main.php');
	$Head->setTitle('Nuevo Menu');
	$Head->setHead();
	
	$Status             = array();
	$Status['A']   = "Activo";
    $Status['I']    = "Inactivo";
    $Status['O']    = "Oculto";

    $Bool       = array();
    $Bool['Y']  = "Si";
    $Bool['N']  = "No";
?>
<body>
	<?php include('../../includes/inc.top.php');?>
    <div id="Content">
    
    	<div class="FormWrapper">        
        	<form name="frm" id="frm" method="post" action="process.abm.php" enctype="multipart/form-data">
            <div class="ListTop BorderRadiusTop Noto14px">Nuevo Menu</div>
            <div class="ListBody Noto12px">
                <?php echo insertElement("hidden","action","insert"); ?>
                <div>
                	<div class="Noto14px ColLeft">
                    	
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
                                Link:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','link','','Input Arial12px BlueCyan Bold','tabindex="2" default="Sin Link" validateMinLength="9/El link debe contener 9 caracteres como m&iacute;nimo"'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Estado:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','status','','Select Arial12px BlueCyan Bold','tabindex="3"',$Status,'','','A'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        
                    </div>
                    <div class="Noto14px ColRight">
                        
                        <div>
                            <div class="LabelWrapper Left">
                            	Padre:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','parent_id','','Select Arial12px BlueCyan Bold','tabindex="8" ',$DB->fetchAssoc('select','menu','menu_id,title',"","title"),'0','Sin Padre'); ?>
                            </div>
                         	<div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Posici&oacute;n:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','position','','Input Arial12px BlueCyan Bold','tabindex="9" default="Posici&oacute;n..." validateEmpty="La posici&oacute;n es obligatoria." validateOnlyNumbers="Ingrese &uacute;nicamente n&uacute;meros."'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Menu p&uacute;blico:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','public','','Select Arial12px BlueCyan Bold','tabindex="10"',$Bool,'','','Y'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                    </div>
                    <div class="Clear"></div>
                </div>
                
            </div>
            <div class="ListBot BorderRadiusBot Frutiger14px" style="padding:5px;">
            	<?php echo insertElement('button','ButtonSubmit','CREAR NUEVO MENU','SubmitButton Center Arial14px BlackGray Bold','tabindex="99"'); ?>
            </div>
            </form>
        </div>
    </div>
</body>
</html>