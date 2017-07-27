<?php
	include("../../includes/inc.main.php");
	$Head->setTitle("Menues");
	$Head->setHead();

    $SerachFields = array();
    $SerachFields['title']['label']    = 'Nombre';
    $SerachFields['link']['label']     = 'Link';
    //$SerachFields['user']['label']     = 'Usuario';

    $Menu = new Menu();
?>
<body>
	<?php include("../../includes/inc.top.php"); ?>
	<div id="Content">
    
    	<div class="ListWrapper">        
            <div class="ListTop BorderRadiusTop Noto14px">Listado de Menues</div>
            <div class="ListOptions Center">
                <?php 
                    echo insertElement('button','ButtonNew','NUEVO MENU','SubmitButton Center Arial14px BlackGray Bold','');
                    echo insertElement('button','ButtonFilter','BUSCAR','SubmitButton Center Arial14px BlackGray Bold',''); 
                ?>
            </div>
            <div id="ListSearcher" class="ListSearcher Hidden Noto12px">
                <?php
                    $TotalRegs  = $Menu->GetTotalRegs();
                    $Pager      = new Pager($TotalRegs);
                    echo $Pager->SetFields($SerachFields);
                    echo $Pager->GetHTML();
                ?>
            </div>
            <div class="ListBody Noto12px" id="ListBody">
                
                <?php 
                    
                    $Pager->SetPageRegs(5);
                    echo $Menu->MakeList($Pager->CalculateRegFrom(),$Pager->GetPageRegs());
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