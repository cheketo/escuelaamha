<?php 
	include('../../includes/inc.main.php');
	$Head->setTitle('Importar Personas');
	$Head->setHead();
	
	$Months					= array();
	$Months['Enero']		= "01";
	$Months['Febrero']		= "02";
	$Months['Marzo']		= "03";
	$Months['Abril']		= "04";
	$Months['Mayo']			= "05";
	$Months['Junio']		= "06";
	$Months['Julio']		= "07";
	$Months['Agosto']		= "08";
	$Months['Septiembre']	= "09";
	$Months['Octubre']		= "10";
	$Months['Noviembre']	= "11";
	$Months['Diciembre']	= "12";
?>
<body>
	<?php include('../../includes/inc.top.php');?>
    <div id="Content">
    
    	<div class="FormWrapper">        
        	<form name="frm" id="frm" method="post" action="process.abm.php?movefile=yes" enctype="multipart/form-data">
            <div class="ListTop BorderRadiusTop Noto14px">Importar Personal</div>
            <div class="ListBody Noto12px">
                <?php echo insertElement("hidden","action","import"); ?>
                <div>
                		
                        <div>
                            <div class="LabelWrapper Left">
                            	Archivo Excel:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('file','excel','','Input Arial12px BlueCyan Bold Pointer','tabindex="1" default="Seleccione un archivo excel..."'); ?>
                            </div>
                            <div class="Clear"></div>
                        </div>
                		
                    	<div>
                            <div class="LabelWrapper Left">
                            	A&ntilde;o:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('text','year','','Input Arial12px BlueCyan Bold','tabindex="2" default="AAAA" validateEmpty="El a&ntilde;o es obligatorio."'); ?>
                            </div>
                         	<div class="Clear"></div>
                        </div>
                        
                        <div>
                            <div class="LabelWrapper Left">
                            	Mes:
                            </div>
                            <div class="InputWrapper Left">
                                <?php echo insertElement('select','month','','Select Arial12px BlueCyan Bold','tabindex="3" validateEmpty="El mes es obligatorio."',$Months,'','Seleccione un mes'); ?>
                        	</div>
                            <div class="Clear"></div>
                        </div>
                </div>
                
            </div>
            <div class="ListBot BorderRadiusBot Frutiger14px" style="padding:5px;">
            	<?php echo insertElement('button','ButtonSubmit','IMPORTAR PERSONAS','SubmitButton Center Arial14px BlackGray Bold','tabindex="4"'); ?>
            </div>
            </form>
        </div>
    </div>
</body>
</html>