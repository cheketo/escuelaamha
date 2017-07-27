<?php 
	include('../../includes/inc.main.php');
	$Head->setTitle('Nuevo Art&iacute;culo');
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
            <div class="ListTop BorderRadiusTop Noto14px">Nuevo Art&iacute;culo</div>
            <div class="ListBody Noto12px">
                <?php echo insertElement("hidden","action","insert"); ?>
                <?php echo insertElement("hidden","admin",$Admin->AdminID); ?>
                <div>
                    <div>
                        <div class="LabelWrapperArticle Left">
                            T&iacute;tulo:
                        </div>
                        <div class="InputWrapperArticle Left">
                            <?php echo insertElement('text','title','','InputArticle Arial12px BlueCyan Bold','tabindex="1" default="T&iacute;tulo..." validateEmpty="El t&iacute;tulo es obligatorio." validateMinLength="3/El t&iacute;tulo debe contener 3 caracteres como m&iacute;nimo"'); ?>
                        </div>
                        <div class="Clear"></div>
                    </div>

                    <div>
                        <div class="LabelWrapperArticle Left">
                            Copete:
                        </div>
                        <div class="InputWrapperArticle Left">
                            <?php echo insertElement('textarea','subtitle','','InputArticle Vertical Arial12px BlueCyan Bold','tabindex="1" rows="6" default="Copete..." validateEmpty="El copete es obligatorio." '); ?>
                        </div>
                        <div class="Clear"></div>
                    </div>

                    <div>
                        <div class="LabelWrapperArticle Left">
                            Cuerpo:
                        </div>
                        <div class="InputWrapperTinyMCE Left">
                            <?php echo insertElement('textarea','description','','Arial12px BlueCyan Bold tinymce','tabindex="1" rows="20" '); ?>
                        </div>
                        <div class="Clear"></div>
                    </div>


                	<div class="Noto12px ColLeft">
                        <?php /*
                        <div>
                            <div class="LabelWrapper Left">
                                Art&iacute;culo p&uacute;blico:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','public','Y','Select Arial12px BlueCyan Bold','tabindex="2"',$Bool); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        
                        <div id="notPublic" style="display:none;">
                            <div class="LabelWrapper Left">
                                Usuarios permitidos:
                            </div>
                            <div class="InputWrapper Left">
                                <?php 
                                    $Profiles  = $DB->fetchAssoc('select','admin_profile','*','profile_id > 10','title');
                                    for($i=0;$i<count($Profiles);$i++)
                                    {
                                        $Checked = ' checked="checked" ';
                                        echo '<div style="width:auto;">'.insertElement('checkbox','profile',$Profiles[$i]['profile_id'],'Arial12px BlueCyan Bold','tabindex="8"'.$Checked).' '.$Profiles[$i]['title'].'</div>';     
                                    }
                                    
                                ?>
                            </div>
                            <div class="Clear"></div>

                             <div class="LabelWrapper Left">
                                Grupos permitidos:
                            </div>
                            <div class="InputWrapper Left">
                                <?php 
                                    $Groups  = $DB->fetchAssoc('select','admin_group','*','group_id IN (SELECT group_id FROM relation_group_profile WHERE profile_id >= '.$Admin->ProfileID.')','title');
                                    for($i=0;$i<count($Groups);$i++)
                                    {
                                        $Checked = ' checked="checked" ';
                                        echo '<div style="width:auto;">'.insertElement('checkbox','profile',$Groups[$i]['profile_id'],'Arial12px BlueCyan Bold','tabindex="8"'.$Checked).' '.$Groups[$i]['title'].'</div>';     
                                    }
                                    
                                ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        */?>

                        <div>
                            <div class="LabelWrapper Left">
                                Destacado:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','important','N','Select Arial12px BlueCyan Bold','tabindex="3"',$Bool); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Habilitar comentarios:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','comment','Y','Select Arial12px BlueCyan Bold','tabindex="3"',$Bool); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Habilitar respuestas:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','reply','Y','Select Arial12px BlueCyan Bold','tabindex="4"',$Bool); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        
                    </div>
                    <div class="Noto12px ColRight">
                        
                        <div>
                            <div class="LabelWrapper Left">
                                Im&aacute;gen Principal:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('file','img','','Input Arial12px BlueCyan Bold Pointer','tabindex="7" default="Seleccione una imagen..."'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>


                        <div>
                            <div class="LabelWrapper Left">
                                Secci&oacute;n:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','section_id','','Select Arial12px BlueCyan Bold','tabindex="6"',$Admin->AllowedSections()); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Inicio de Publicaci&oacute;n:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','start_date','','Input datepciker Arial12px BlueCyan Bold Center','tabindex=  "7" default="Sin fecha"'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Fin de Publicaci&oacute;n:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','end_date','','Input datepciker Arial12px BlueCyan Bold Center','tabindex=  "8" default="Sin fecha"'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        
                        
                       

                    </div>
                    <div class="Clear"></div>
                    
                    <div style="margin:20px 0px;border:2px solid #B55D0B; width:578px; margin-left:158px;" class="BorderRadius">
                        <div id="uploader">Adjuntar Archivos</div>
                    </div>
                </div>
                
            </div>
            <div class="ListBot BorderRadiusBot Frutiger14px" style="padding:5px;">
            	<?php echo insertElement('button','ButtonSubmit','CREAR NUEVO ART&Iacute;CULO','SubmitButton Center Arial14px BlackGray Bold','tabindex="99"'); ?>
            </div>
            </form>
        </div>
    </div>
</body>
</html>