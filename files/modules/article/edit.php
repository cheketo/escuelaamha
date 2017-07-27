<?php 
    include('../../includes/inc.main.php');
    $Head->setTitle('Editar Art&iacute;culo');
    $Head->setHead();
    
    $ArticleID  = $_GET['id'];
    $Article    = new Article($ArticleID);
    $Data       = $Article->GetData();
    $Files      = $Article->GetFiles();

    $Status         = array();
    $Status['A']    = "Activo";
    $Status['I']    = "Inactivo";

    $Bool       = array();
    $Bool['Y']  = "Si";
    $Bool['N']  = "No";

    function ArticleData($aDate)
    {
        $Date = explode(" ",$aDate);
        return $Date[0]!="0000-00-00"? implode("/",array_reverse(explode("-",$Date[0]))) : "";
    }
?>
<body>
    <?php include('../../includes/inc.top.php');?>
    <div id="Content">
    
        <div class="FormWrapper">        
            <form name="frm" id="frm" method="post" action="process.abm.php" enctype="multipart/form-data">
            <div class="ListTop BorderRadiusTop Noto14px">Editar Art&iacute;culo</div>
            <div class="ListBody Noto12px">
                <?php echo insertElement("hidden","action","update"); ?>
                <?php echo insertElement("hidden","admin",$Admin->AdminID); ?>
                <?php echo insertElement("hidden","article",$ArticleID); ?>
                <div>
                    <div>
                        <div class="LabelWrapperArticle Left">
                            T&iacute;tulo:
                        </div>
                        <div class="InputWrapperArticle Left">
                            <?php echo insertElement('text','title',$Data['title'],'InputArticle Arial12px BlueCyan Bold','tabindex="1" default="T&iacute;tulo..." validateEmpty="El t&iacute;tulo es obligatorio." validateMinLength="3/El t&iacute;tulo debe contener 3 caracteres como m&iacute;nimo"'); ?>
                        </div>
                        <div class="Clear"></div>
                    </div>

                    <div>
                        <div class="LabelWrapperArticle Left">
                            Copete:
                        </div>
                        <div class="InputWrapperArticle Left">
                            <?php echo insertElement('textarea','subtitle',$Data['subtitle'],'InputArticle Vertical Arial12px BlueCyan Bold','tabindex="2" rows="6" default="Copete..." validateEmpty="El copete es obligatorio." '); ?>
                        </div>
                        <div class="Clear"></div>
                    </div>

                    <div>
                        <div class="LabelWrapperArticle Left">
                            Cuerpo:
                        </div>
                        <div class="InputWrapperTinyMCE Left">
                            <?php echo insertElement('textarea','description',$Data['description'],'Arial12px BlueCyan Bold tinymce','tabindex="3" rows="20" '); ?>
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
                                <?php echo insertElement('select','public',$Data['public'],'Select Arial12px BlueCyan Bold','tabindex="4"',$Bool); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        <?php $Hidden   = $Data['public'] == 'Y'? ' class="Hidden" ': ''; ?>
                        <div id="notPublic" <?php echo $Hidden; ?>>
                            <div class="LabelWrapper Left">
                                Usuarios permitidos:
                            </div>
                            <div class="InputWrapper Left">
                                <?php 
                                    $Profiles  = $DB->fetchAssoc('select','admin_profile','*','profile_id > 10','title');
                                    //print_r($Article->GetAllowedProfiles());die;
                                    for($i=0;$i<count($Profiles);$i++)
                                    {
                                        $Checked    = in_array($Profiles[$i]['profile_id'],$Article->GetAllowedProfiles())? ' checked = "checked" ' : '';
                                        echo '<div style="width:auto;">'.insertElement('checkbox','profile',$Profiles[$i]['profile_id'],'Arial12px BlueCyan Bold','tabindex="5" '.$Checked).' '.$Profiles[$i]['title'].'</div>';     
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
                                <?php echo insertElement('select','important',$Data['important'],'Select Arial12px BlueCyan Bold','tabindex="6"',$Bool); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Habilitar comentarios:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','comment',$Data['comment'],'Select Arial12px BlueCyan Bold','tabindex="7"',$Bool); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Habilitar respuestas:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','reply',$Data['reply'],'Select Arial12px BlueCyan Bold','tabindex="8"',$Bool); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        
                    </div>
                    <div class="Noto12px ColRight">

                        <?php if(file_exists("../../../skin/images/articles/".$ArticleID."/main.jpeg")){ ?>
                        <div>
                            <div class="LabelWrapper Left" style="line-height:45px!important;">
                                Im&aacute;gen Principal:
                            </div>
                            <div class="InputWrapper Left">
                                <div class="FormAdminUserImg">
                                    <img src="../../../skin/images/articles/<?php echo $ArticleID; ?>/main.jpeg" width="100" height="80" />
                                </div>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        <?php } ?>
                        <div>
                            <div class="LabelWrapper Left">
                                Cambiar Im&aacute;gen:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('file','img','','Input Arial12px BlueCyan Bold Pointer','tabindex="9" default="Seleccione una imagen..."'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>


                        <div>
                            <div class="LabelWrapper Left">
                                Secci&oacute;n:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','section_id',$Data['section_id'],'Select Arial12px BlueCyan Bold','tabindex="10"',$Admin->AllowedSections()); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Inicio de Publicaci&oacute;n:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','start_date',ArticleData($Data['start_date']),'Input datepciker Arial12px BlueCyan Bold Center','tabindex=  "11" default="Sin fecha"'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>

                        <div>
                            <div class="LabelWrapper Left">
                                Fin de Publicaci&oacute;n:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','end_date',ArticleData($Data['end_date']),'Input datepciker Arial12px BlueCyan Bold Center','tabindex=  "12" default="Sin fecha"'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                        
                        
                       

                    </div>
                    <div class="Clear"></div>
                    
                    <div style="margin:20px 0px;border:2px solid #B55D0B; width:578px; margin-left:158px;" class="BorderRadius">
                        <div id="uploader">Adjuntar Archivos</div>
                        <?php foreach($Files as $File){ ?>
                        <div class="FileStatusbar" style="width: 578px;">
                            <div class="FileName"><?php echo $File['name']; ?></div>
                            <div class="FileProgress">
                                <div class="FileUploadBar" style="width: 100%;"></div>
                            </div>
                            <div class="FileDeleteButton" name="<?php echo $File['name']; ?>" file="<?php echo $File['file_id']; ?>">Borrar</div>
                        </div>
                        <?php } ?>
                    </div>
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