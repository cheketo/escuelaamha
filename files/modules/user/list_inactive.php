<?php
	include("../../includes/inc.main.php");
	$Head->setTitle("Usuarios Administradores");
	$Head->setHead();

    $SerachFields = array();
    $SerachFields['user']['label']              = 'Usuario';
    $SerachFields['first_name']['label']        = 'Nombre';
    $SerachFields['last_name']['label']         = 'Apellido';
    $SerachFields['profile_id']['label']        = 'Perfil';
    $SerachFields['profile_id']['input']        = 'select';
    $SerachFields['profile_id']['query']        = $DB->fetchAssoc('select','admin_profile','profile_id,title',"profile_id>".$Admin->ProfileID,'title');
    $SerachFields['profile_id']['first_text']   = 'Seleccione un perfil';

    $OrderField['first_name'];
    $OrderField['last_name'];
    $OrderField['user'];

    $_SESSION['inactive_status'] = "I";
?>
<body>
	<?php include("../../includes/inc.top.php"); ?>
	<div id="Content">

    	<div class="ListWrapper">
            <div class="ListTop BorderRadiusTop Noto14px">Listado de Usuarios ELIMINADOS</div>
            <div class="ListOptions Center">
                <?php
                    echo insertElement('button','ButtonNew','NUEVO USUARIO','SubmitButton Center Arial14px BlackGray Bold','');
                    echo insertElement('button','ButtonFilter','BUSCAR','SubmitButton Center Arial14px BlackGray Bold','');
                ?>
            </div>
            <div id="ListSearcher" class="ListSearcher Hidden Noto12px">
                <?php
                    $TotalRegs  = $Admin->GetTotalRegs("",$_SESSION['inactive_status']);
                    $Pager      = new Pager($TotalRegs,1,"ListBody2");
                    echo $Pager->SetFields($SerachFields);
                    echo $Pager->GetHTML();
                ?>
            </div>
            <div class="ListBody Noto12px" id="ListBody2">

                <?php

                    $Pager->SetPageRegs(5);
                    echo $Admin->MakeListInactive($Pager->CalculateRegFrom(),$Pager->GetPageRegs());
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
