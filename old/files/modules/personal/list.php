<?php
	include("../../includes/inc.main.php");
	$Head->setTitle("Usuarios Administradores");
	$Head->setLink("../../../skin/css/table.css","stylesheet","text/css");
	$Head->setScript("../../js/script.datatables.js");
	$Head->setCharset("utf-8");
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
	
	$Year	= $_GET['year'];
	$Month	= $_GET['month'];
	$Data	= array();
	if($Year && $Month){
		
		$TableExists	= false;
		$Table	= 'personas_'.$Year.'_'.$Month;
		$Tables	= $DB->fetchRow('free',"SHOW TABLES FROM ".$DB->DataBase);
		
		for($i=0;$i<count($Tables);$i++)
		{
			if(in_array($Table,$Tables[$i])) $TableExists = true;
		}
		
		
		
		if($TableExists)
			$Data	= $DB->fetchRow('select',$Table,'*');
	}
		
?>
<body>
	<script type="text/javascript" charset="utf-8">
			/* Data set - can contain whatever information you want */
			var aDataSet = [

			<?php for($i=0;$i<count($Data);$i++){ 
					for($x=1;$x<count($Data[$i]);$x++) $Data[$i][$x] = addslashes(utf8_encode($Data[$i][$x]));
			?>
						
			['<?php echo $Data[$i][1]; ?>','<?php echo $Data[$i][2]; ?>','<?php echo $Data[$i][3]; ?>','<?php echo $Data[$i][4]; ?>','<?php echo $Data[$i][5]; ?>','<?php echo $Data[$i][6]; ?>','<?php echo $Data[$i][7]; ?>','<?php echo $Data[$i][8]; ?>','<?php echo $Data[$i][9]; ?>','<?php echo $Data[$i][10]; ?>','<?php echo $Data[$i][11]; ?>','<?php echo $Data[$i][12]; ?>','<?php echo $Data[$i][13]; ?>'],
			<?php } ?>
			
			];
			
			//alert(aDataSet[aDataSet.lenght-1]);
			if(navigator.userAgent.toLowerCase().indexOf('msie ') > -1)
				if(!aDataSet[aDataSet.lenght-1])
					aDataSet.pop();
		
			var asInitVals = new Array();
			
			$(document).ready(function() {
				var oTable = $('#example').dataTable( {
					"bPaginate": true,
					"bFilter": true,
					"bInfo": true,
					"sPaginationType": "full_numbers",
													"sDom": 'lrtip',
					"oLanguage": {
								"sLengthMenu": "_MENU_ registros por pagina",
								"sZeroRecords": "No se encontraron datos",
								"sInfo": "Mostrando _START_ a _END_ de un total de _TOTAL_ registros",
								"sInfoEmpty": "Mostrando 0 a 0 de un total de 0 registros",
								"sInfoFiltered": "(filtered from _MAX_ total records)",
								"sSearch": "Buscar",
								"sInfoFiltered": " - (Total sin filtrar: _MAX_ registros)",
								"oPaginate": {
									"sPrevious": "<",
									"sNext": ">",
									"sFirst": "<<",
									"sLast": ">>"
								}
							},
					"aaData": aDataSet,
					"bAutoWidth" : false,
					"sScrollX": "100%",
					"aoColumns": [
						{ "sTitle": "Legajo","sClass": "ColDataTable" },
						{ "sTitle": "Apellido y Nombres","sClass": "ColDataTable" },
						{ "sTitle": "CUIL","sClass": "ColDataTable" },
						{ "sTitle": "CCT","sClass": "ColDataTable"},
						{ "sTitle": "AFILIADO","sClass": "ColDataTable"},
						{ "sTitle": "Categoría","sClass": "ColDataTable"},
						{ "sTitle": "Puesto","sClass": "ColDataTable"},
						{ "sTitle": "Area","sClass": "ColDataTable"},
						{ "sTitle": "Ubicación Laboral","sClass": "ColDataTable"},
						{ "sTitle": "Remunerativo","sClass": "ColDataTable"},
						{ "sTitle": "No Remunerativo","sClass": "ColDataTable"},
						{ "sTitle": "Total Bruto","sClass": "ColDataTable"},
						{ "sTitle": "Linea","sClass": "ColDataTable"}
						
					]	
				} );
				

$("tfoot input").keyup( function () {
        /* Filter on the column (the index) of this element */
        oTable.fnFilter( this.value, $("tfoot input").index(this) );
    } );
	
$("tfoot input").each( function (i) {
        asInitVals[i] = this.value;
    } );
     
    $("tfoot input").focus( function () {
        if ( this.className == "search_init" )
        {
            this.className = "";
            this.value = "";
        }
    } );
     
    $("tfoot input").blur( function (i) {
        if ( this.value == "" )
        {
            this.className = "search_init";
            this.value = asInitVals[$("tfoot input").index(this)];
        }
    } );	
				
	} );
	
	$("body").css("height","auto");
		</script>
	<?php include("../../includes/inc.top.php"); ?>
	<div id="Content">
    
    	<div class="ListWrapper">        
            <div class="ListTop BorderRadiusTop Noto14px">Listado de Personal</div>
            <div class="ListBody Noto12px" style="padding-bottom:20px;">
               	<div style="width:100%; border-bottom:1px solid #999; margin-bottom:10px;">
                    <div class="Noto14px Col3Left">
                            <div>
                                <div class="LabelWrapper Left">
                                    A&ntilde;o:
                                </div>
                                <div class="InputWrapper Left">
                                    <?php echo insertElement('text','year',$Year,'Input Arial12px BlueCyan Bold','tabindex="2" default="AAAA" validateEmpty="El a&ntilde;o es obligatorio."'); ?>
                                </div>
                                <div class="Clear"></div>
                            </div>
                    </div>
                    <div class="Noto14px Col3Mid">
                        <div>
                                <div class="LabelWrapper Left">
                                    Mes:
                                </div>
                                <div class="InputWrapper Left">
                                    <?php echo insertElement('select','month',$Month,'Select Arial12px BlueCyan Bold','tabindex="3" validateEmpty="El mes es obligatorio."',$Months,'','Seleccione un mes'); ?>
                                </div>
                                <div class="Clear"></div>
                            </div>
                    </div>
                    <div class="Noto14px Col3Right">
                        <div class=" BorderRadiusBot Frutiger14px" style="padding:5px; margin-top:5px;">
                            <?php echo insertElement('button','ButtonSearch','BUSCAR PERSONAS','SubmitButton Center Arial14px BlackGray Bold','tabindex="4"'); ?>
                        </div>
                    </div>
                    <div class="Clear"></div>
                </div>
                <div style="margin:0 auto !important; width:100%!important;">
                <div id="container" class="Noto12px" style="width:100%!important;" >

                    <div id="dynamic" class="Noto12px" style="width:100%!important;">
                    
                        <table cellpadding="0" cellspacing="0" border="0" class="display Noto12px" id="example" style="overflow-x:scroll; overflow-y:hidden; width:100%!important;">
                            <tfoot>
                                <tr>
                                    <th><input type="text" name="search_legajo" value="Legajo" class="search_init" /></th>
                                    <th><input type="text" name="search_apellido_y_nombres" value="Apellido y Nombres" class="search_init" /></th>
                                    <th><input type="text" name="search_CUIL" value="CUIL" class="search_init" /></th>
                                    <th><input type="text" name="search_CCT" value="CCT" class="search_init" /></th>
                                    <th><input type="text" name="search_AFILIADO" value="AFILIADO" class="search_init" /></th>
                                    <th><input type="text" name="search_Categoría" value="Categoría" class="search_init" /></th>
                                    <th><input type="text" name="search_Puesto" value="Puesto" class="search_init" /></th>
                                    <th><input type="text" name="search_Area" value="Area" class="search_init" /></th>
                                    <th><input type="text" name="search_Ubicación Laboral" value="Ubicación Laboral" class="search_init" /></th>
                                    <th><input type="text" name="search_Remunerativo" value="Remunerativo" class="search_init" /></th>
                                    <th><input type="text" name="search_No Remunerativo" value="No Remunerativo" class="search_init" /></th>
                                    <th><input type="text" name="search_Total Bruto" value="Total Bruto" class="search_init" /></th>
                                    <th><input type="text" name="search_Linea" value="Linea" class="search_init" /></th>
                                
                                </tr>
                            </tfoot>
                        </table>			
                                
                    </div>

                </div>
                </div>
                <!--<iframe src="table.php" style="width:100%; max-height:300px; margin:0 auto;" frameborder="0"></iframe> -->
                
            </div>
            <div class="ListBot BorderRadiusBot Frutiger14px"></div>
        </div>
    </div>
</body>
</html>