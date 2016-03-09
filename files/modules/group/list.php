
<?php
	include("../../includes/inc.main.php");
	$Head->setTitle("Grupos de Usuarios");
	$Head->setHead();

    $SerachFields = array();
    $SerachFields['name']['label']              = 'Grupo';

    $Group = new GroupData();
    
?>
<body>
	<?php include("../../includes/inc.top.php"); ?>
	<div id="Content">
    
    	<div class="ListWrapper">        
            <div class="ListTop BorderRadiusTop Noto14px">Listado de Grupos</div>
            <div class="ListOptions Center">
                <?php 
                    echo insertElement('button','ButtonNew','NUEVO GRUPO','SubmitButton Center Arial14px BlackGray Bold','');
                    echo insertElement('button','ButtonFilter','BUSCAR','SubmitButton Center Arial14px BlackGray Bold',''); 
                ?>
            </div>
            <div id="ListSearcher" class="ListSearcher Hidden Noto12px">
                <?php
                    $TotalRegs  = $Group->GetTotalRegs();
                    $Pager      = new Pager($TotalRegs);
                    echo $Pager->SetFields($SerachFields);
                    echo $Pager->GetHTML();
                ?>
            </div>
            <div class="ListBody Noto12px" id="ListBody">
                
                <?php 
                    
                    $Pager->SetPageRegs(15);
                    echo $Group->MakeList($Pager->CalculateRegFrom(),$Pager->GetPageRegs());
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