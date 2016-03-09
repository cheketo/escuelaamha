<?php 
	include('../../includes/inc.main.php');
	$Head->setTitle('Nuevo Examen');
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
            <div class="ListTop BorderRadiusTop Noto14px">Nuevo Examen</div>
            <div class="ListBody Noto12px">
                <?php echo insertElement("hidden","action","insert"); ?>
                <div>
                	<div class="Noto12px ColLeft">
                    	
                        <div>
                            <div class="LabelWrapper Left">
                            	Nombre:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','title','','Input Arial12px BlueCyan Bold','tabindex="1" default="Nombre..." validateEmpty="El nombre del examen es obligatorio." validateMinLength="3/El nombre debe contener 3 caracteres como m&iacute;nimo"'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Inicio de Publicaci&oacute;n:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','start_date','','Input datepciker Arial12px BlueCyan Bold Center','tabindex="7" default="Sin fecha"'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Fin de Publicaci&oacute;n:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','end_date','','Input datepciker Arial12px BlueCyan Bold Center','tabindex="8" default="Sin fecha"'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                    </div>

                    <div class="Noto12px ColRight">
                        
                        <div>
                            <div class="LabelWrapper Left">
                                Secciones:
                            </div>
                            <div class="InputWrapper Left">
                                <?php 
                                    $Sections  = $DB->fetchAssoc('select','section','*','','title');
                                    for($i=0;$i<count($Sections);$i++)
                                    {
                                        $Checked = ' checked="checked" ';
                                        echo '<div style="width:auto;">'.insertElement('checkbox','section',$Sections[$i]['section_id'],'Arial12px BlueCyan Bold','tabindex="9" mustBeChecked="1/Debe elegir una secci&oacute;n"'.$Checked).' '.$Sections[$i]['title'].'</div>';     
                                    }
                                    
                                ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                       

                    </div>

                    <div class="Clear"></div>
                    <!-- Questions (Begin) -->

                    <div class="Noto12px ColLeft">

                        <div>
                            <div class="LabelWrapper Left">
                                1&ordm; Pregunta:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('textarea','question_1','','Input Arial12px BlueCyan Bold','tabindex="1" default="Pregunta..." validateEmpty="La pregunta es obligatoria." validateMinLength="3/El nombre debe contener 3 caracteres como m&iacute;nimo"'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                    </div>
                    <div class="Noto12px ColRight">
                        
                        <div>
                            <div class="LabelWrapper Left" style="line-height:20px!important;">
                                <div>1&ordm; Respuesta:</div>
                                <div stytle="line-height:20px;"><?php echo insertElement('checkbox','correct_1','1','Arial12px BlueCyan Bold','tabindex="1" mustBeChecked="1/Seleccionar una respuesta correcta para la pregunta N&ordm; 1"'); ?>Correcta</div>

                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('textarea','answer_1_1','','Input Arial12px BlueCyan Bold','tabindex="1" default="Respuesta..." validateEmpty="La respuesta es obligatoria." validateMinLength="3/El nombre debe contener 3 caracteres como m&iacute;nimo"'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left" style="line-height:20px!important;">
                                <div>2&ordm; Respuesta:</div>
                                <div stytle="line-height:20px;"><?php echo insertElement('checkbox','correct_1','2','Arial12px BlueCyan Bold','tabindex="1" mustBeChecked="1/Seleccionar una respuesta correcta para la pregunta N&ordm; 1"'); ?>Correcta</div>
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('textarea','answer_1_2','','Input Arial12px BlueCyan Bold','tabindex="1" default="Respuesta..." validateEmpty="La respuesta es obligatoria." validateMinLength="3/El nombre debe contener 3 caracteres como m&iacute;nimo"'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div class="AddAnswer Center Bold">
                            <div class="Left" style="width:45px;padding-left:40px;background:url(../../../skin/images/body/icons/add_answer.png) no-repeat right center; height:40px;"></div>
                            <div class="Left" style="line-height:40px;width:150px;">Agregar Respuesta</div>
                            <div class="Clear"></div>
                        </div>

                    </div>
                    <div class="Clear"></div>

                    <div class="AddQuestion Center Bold">
                        <div class="Left" style="width:290px;padding-left:40px;background:url(../../../skin/images/body/icons/add_question.png) no-repeat right center; height:40px;"></div>
                        <div class="Left" style="line-height:40px;width:150px;">Agregar Pregunta</div>
                        <div class="Clear"></div>
                    </div>
                    <!-- Questions (End) -->

                </div>
                
            </div>
            <div class="ListBot BorderRadiusBot Frutiger14px" style="padding:5px;">
            	<?php echo insertElement('button','ButtonSubmit','CREAR EXAMEN','SubmitButton Center Arial14px BlackGray Bold','tabindex="99"'); ?>
            </div>
            </form>
        </div>
    </div>
</body>
</html>