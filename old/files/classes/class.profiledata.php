<?php

class ProfileData extends DataBase
{
	var $Menues = array();
	var $Parents = array();
	
	public function __construct()
	{
		$this->Connect();
	}
	
	public function MakeProfileList()
	{
		$ProfileRegs	= $this->fetchAssoc('select','admin_profile','*','profile_id>1',"title"); 
			
		for($i=0;$i<count($ProfileRegs);$i++)
		{
			//$AdminReg	=	new AdminData($AdminRegs[$i]['admin_id']);
			$Actions	= 	'<img src="../../../skin/images/body/icons/pencil.png" id="edit_'.$ProfileRegs[$i]['profile_id'].'" />';
			$Actions	.= 	'<img src="../../../skin/images/body/icons/cross.png" id="delete_'.$ProfileRegs[$i]['profile_id'].'" />';
				
			$Regs	.= '<div class="RegWrapper BlackGray" id="Row'.$ProfileRegs[$i]['profile_id'].'">
							
							<div class="DataWrapper Left">
								<div class="BlueCyan Frutiger16px">'.$ProfileRegs[$i]['title'].'</div>
								<div>Usuarios con este perfil: '.count($this->Users($ProfileRegs[$i]['profile_id'])).'</div>
								<div>Permisos del perfil: '.count($this->GetRelations($ProfileRegs[$i]['profile_id'])).'</div>
							</div>
							
							<div class="ActionsWrapper Right">'.$Actions.'</div>
							<div class="Clear"></div>
						</div>';
            
        } 
			
		return $Regs;
	}
	
	public function MakeList($ProfileID=1,$Parent=0)
	{
		if($Parent==0)
		{
			$this->GetCheckedMenues($ProfileID);
			$this->GetParents();
			$HTML	.= insertElement('hidden','ProfileID',$ProfileID);
		}
		
		$Menues	= $this->fetchAssoc('select','menu','*',"parent_id = ".$Parent." AND status <> 'I'"); 
		
		foreach($Menues as $Menu)
		{
			$IsParent = in_array($Menu['menu_id'],$this->Parents);
			
			if(in_array($Menu['menu_id'],$this->Menues))
			{
				$Hidden 	= '';
				$Selected	= ' checked = "checked" ';
				$Arrow	= $IsParent? '<div class="Arrow ArrowLeft" id="img'.$Menu['menu_id'].'"></div>' : "";
				
			}else{
				$Hidden 	= ' Hidden ';
				$Selected	= '';
				$Arrow	= $IsParent? '<div class="Arrow ArrowDown" id="img'.$Menu['menu_id'].'"></div>' : "";
			}
			
			if($Parent!=0)$Disabled	= $this->IsDisabled($Menu['parent_id']);
			
			$HTML	.= '<div>'.insertElement('checkbox','menu'.$Menu['menu_id'],$Menu['menu_id'],'Left Pointer MenuCheckbox Menu'.$Menu['parent_id'],$Selected.$Disabled).'<div class="Parent Left Frutiger12px BlueCyan" id="'.$Menu['menu_id'].'">'.$Menu['title'].'</div>'.$Arrow.'<div class="Clear"></div></div>';
			if($IsParent)
			{
				$HTML	.= '<div class="ProfileChild '.$Hidden.'" id="Child'.$Menu['menu_id'].'" >';
				$HTML	.= $this->MakeList($ProfileID,$Menu['menu_id']);
				$HTML	.= "</div>";
			}
		}
		
		return $HTML;
	}
	
	
	public function GetCheckedMenues($ProfileID)
	{
		$Relations	= $this->fetchAssoc('select','relation_menu_profile','*',"profile_id = ".$ProfileID);
		foreach($Relations as $Relation)
		{
			$this->Menues[]	= $Relation['menu_id'];
		}
	}
	
	public function GetParents()
	{
		$Parents	= $this->fetchAssoc('select','menu','DISTINCT(parent_id)',"parent_id <> 0 AND status <> 'I'");
		
		foreach($Parents as $Parent){
			$this->Parents[] = $Parent['parent_id'];
		}
	}
	
	public function IsDisabled($ParentID)
	{
		return in_array($ParentID,$this->Menues) ? '' : ' disabled="disabled" ';
	}
	
	public function GetRelations($ProfileID)
	{
		return $this->fetchAssoc('select','relation_menu_profile','*',"profile_id = ".$ProfileID);
	}
	
	public function Users($ProfileID)
	{
		return $this->fetchAssoc('select','admin_user','*',"profile_id = ".$ProfileID." AND status <> 'I'");
		
	}
	
}


?>