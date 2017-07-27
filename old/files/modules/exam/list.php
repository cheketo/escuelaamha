<?php
	include("../../includes/inc.main.php");
	$Head->setTitle("Secciones");
	$Head->setHead();

    $SerachFields = array();
    $SerachFields['title']['label']         = 'Nombre';
    $SerachFields['author_id']['label']     = 'Autor';
    $Title = "Listado de Secciones";

    $Section = new Section();

    if($_GET['status']=='I') 
    {
        $Section->SetWhere("status = 'I' ");
        $Title .= " Eliminadas";
    }
?>
<body>
	<?php include("../../includes/inc.top.php"); ?>
	<div id="Content">
    
    	<div class="ListWrapper">        
            <div class="ListTop BorderRadiusTop Noto14px"><?php echo $Title; ?></div>
            <div class="ListOptions Center">
                <?php 
                    echo insertElement('button','ButtonNew','NUEVA SECCI&Oacute;N','SubmitButton Center Arial14px BlackGray Bold','');
                    echo insertElement('button','ButtonFilter','BUSCAR','SubmitButton Center Arial14px BlackGray Bold',''); 
                ?>
            </div>
            <div id="ListSearcher" class="ListSearcher Hidden Noto12px">
                <?php
                    $TotalRegs  = $Section->GetTotalRegs();
                    $Pager      = new Pager($TotalRegs);
                    echo $Pager->SetFields($SerachFields);
                    echo $Pager->GetHTML();
                ?>
            </div>
            <div class="ListBody Noto12px" id="ListBody">
                
                <?php 
                    
                    $Pager->SetPageRegs(15);
                    if($Admin->ProfileID>2) $Where = " AND section_id IN (SELECT section_id FROM relation_section_admin WHERE admin_id = ".$Admin->AdminID.")";
                    echo $Section->MakeList($Pager->CalculateRegFrom(),$Pager->GetPageRegs(),$Where);
                    $_SESSION[$Pager->GetPagerID()]   = $Pager;
                ?>
                
            </div>
            <div class="ListBot BorderRadiusBot Frutiger14px">
                <div class="Left">
                <?php 
                    echo $Pager->InsertBtnBackAjax("<");
                    echo $Pager->InsertAjaxPager();
                    echo $Pager->InsertBtnFowardAjax(">");
                ?>
                </div>
                <div class="Right Center">
                <?php 
                    echo $Pager->InsertRegSelect();
                ?>
                </div>
                <div class="Clear"></div>
            </div>
        </div>
    </div>
</body>
</html>