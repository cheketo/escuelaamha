<?php
	include("../../includes/inc.main.php");
	$Head->setTitle("Art&iacute;culos");
	$Head->setHead();

    $SectionID = $_GET['id'];

    $SerachFields = array();
    $SerachFields['title']['label']         = 'T&iacute;tulo';
    $SerachFields['author_id']['label']     = 'Autor';
    $Title = "Listado de Art&iacute;culos";

    $Article = new Article();
    if($SectionID) $Article->SetSection($SectionID);

    if($_GET['status']=='I') 
    {
        $Article->SetWhere("status = 'I' ");
        $Title .= " Eliminados";
    }

    if($Admin->ProfileID>2) $Where = " AND section_id IN (SELECT section_id FROM relation_section_admin WHERE admin_id = ".$Admin->AdminID.")";
?>
<body>
	<?php include("../../includes/inc.top.php"); ?>
	<div id="Content">
    
    	<div class="ListWrapper">        
            <div class="ListTop BorderRadiusTop Noto14px"><?php echo $Title; ?></div>
            <div class="ListOptions Center">
                <?php 
                    echo insertElement('button','ButtonNew','NUEVO ART&Iacute;CULO','SubmitButton Center Arial14px BlackGray Bold','');
                    echo insertElement('button','ButtonFilter','BUSCAR','SubmitButton Center Arial14px BlackGray Bold',''); 
                ?>
            </div>
            <div id="ListSearcher" class="ListSearcher Hidden Noto12px">
                <?php
                    $TotalRegs  = $Article->GetTotalRegs($Where);
                    $Pager      = new Pager($TotalRegs);
                    echo $Pager->SetFields($SerachFields);
                    echo $Pager->GetHTML();
                ?>
            </div>
            <div class="ListBody Noto12px" id="ListBody">
                
                <?php 
                    
                    $Pager->SetPageRegs(5);
                    echo $Article->MakeList($Pager->CalculateRegFrom(),$Pager->GetPageRegs(),$Where);
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