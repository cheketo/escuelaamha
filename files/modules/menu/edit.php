<?php
	include('../../includes/inc.main.php');
	$Head->setTitle("Editar Usuario Administrador");
	$Head->setHead();
	
	$Menu_id	= $_GET['id'];
	$MenuEdit	= new Menu($Menu_id);
	$MenuData	= $MenuEdit->GetData();
	
	$Status			= array();
	$Status['A']	= "Activo";
	$Status['I']	= "Inactivo";
    $Status['O']    = "Oculto";

    $MenuData['link']   = $MenuData['link']=="#"? "" : $MenuData['link'];

    $Bool       = array();
    $Bool['Y']  = "Si";
    $Bool['N']  = "No";

?>
<body>
	<?php include("../../includes/inc.top.php"); ?>
    <div id="Content">
		<div class="FormWrapper">        
        	<form name="frm" id="frm" method="post" action="process.abm.php" enctype="multipart/form-data">
            <div class="ListTop BorderRadiusTop Noto14px">Editar Menu</div>
            <div class="ListBody Noto12px">
                <?php echo insertElement("hidden","action","update"); ?>
                <?php echo insertElement("hidden","menu_id",$Menu_id); ?>
                <div>
                	<div class="Noto14px ColLeft">
                    	
                        <div>
                            <div class="LabelWrapper Left">
                            	Nombre:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','title',$MenuData['title'],'Input Arial12px BlueCyan Bold','tabindex="1" default="Nombre..." validateEmpty="El nombre es obligatorio." validateMinLength="3/El nombre debe contener 3 caracteres como m&iacute;nimo"'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        
                        <div>
                            <div class="LabelWrapper Left">
                                Link:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','link',$MenuData['link'],'Input Arial12px BlueCyan Bold','tabindex="2" default="Sin Link" validateMinLength="9/El link debe contener 9 caracteres como m&iacute;nimo"'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        
                         <div>
                            <div class="LabelWrapper Left">
                            	Estado:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','status',$MenuData['status'],'Select Arial12px BlueCyan Bold','tabindex="3"',$Status,'','','A'); ?>
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
                                <?php echo insertElement('select','parent_id',$MenuData['parent_id'],'Select Arial12px BlueCyan Bold','tabindex="4" ',$DB->fetchAssoc('select','menu','menu_id,title',"","title"),'0','Sin Padre'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        
                        <div>
                            <div class="LabelWrapper Left">
                                Posici&oacute;n:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','position',$MenuData['position'],'MiniInput Arial12px BlueCyan Bold Center','tabindex="5" default="Posici&oacute;n..." validateEmpty="La posici&oacute;n es obligatoria." validateOnlyNumbers="Ingrese &uacute;nicamente n&uacute;meros."'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Menu p&uacute;blico:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','public',$MenuData['public'],'Select Arial12px BlueCyan Bold','tabindex="6"',$Bool,'','','Y'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        
                    </div>
                    <div class="Clear"></div>
                </div>
                <?php 
                    /*
                    $Profiles = $DB->fetchAssoc("select","admin_profile","profile_id,title"); 
                    for($i=0;$i<count($Profiles);$i++)
                    {
                        echo $Profiles[$i]['title']." ".insertElement('checkbox','checkid',$Profiles[$i]['profile_id']).'<br>';
                    }
                    */
                ?>
                
            </div>
            <div class="ListBot BorderRadiusBot Frutiger14px" style="padding:5px;">
            	<?php echo insertElement('button','ButtonSubmit','EDITAR MENU','SubmitButton Center Arial14px BlackGray Bold','tabindex="6"'); ?>
            </div>
            </form>
        </div>
    </div>
</body>
</html>