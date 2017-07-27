<?php

class GroupData extends DataBase
{
	var $Data;
	var $Profiles;
	var $GroupID;
	var $Parent = array();
	var $Menues = array();
	
	public function __construct($GroupID=0)
	{
		$this->Connect();
		$Rs 			= $GroupID>0? $this->fetchAssoc("select","admin_group","*","group_id = ".$GroupID) : array();
		$this->Data 	= $Rs[0];
		$this->GroupID 	= $GroupID;
	}

	public function GetData()
	{
		return $this->Data;
	}
	
	public function MakeList($From=-1, $To=-1,$Where="")
	{	

		$Limit = $From>=0 && $To>=0 ? $From.",".$To : "";
		$GroupRegs	= $this->fetchAssoc('select','admin_group','*',"1=1 ".$Where,"name",$Limit); 
		$AtLeastOne	= false;
		foreach($GroupRegs as $Reg)
		{
			
			$Actions	= 	'<img src="../../../skin/images/body/icons/pencil.png" action="edit" class="actionImg" target="edit.php" id="group_'.$Reg['group_id'].'" />';
			$Actions	.= 	'<img src="../../../skin/images/body/icons/cross.png" class="actionImg" action="delete" process="process.abm.php" id="group_'.$Reg['group_id'].'" />';
				
			$Regs	.= '<div class="RegWrapper BlackGray" id="Row'.$Reg['group_id'].'">
							<div class="DataWrapper Left BlueCyan Noto20px">'.$Reg['name'].'</div>
							<div class="ActionsWrapper Right">'.$Actions.'</div>
							<div class="Clear"></div>
						</div>';  
			$AtLeastOne	= true;
        } 
        if(!$AtLeastOne) $Regs	.= '<div class="RegWrapper DarkRed" id="EmptyRow" style="text-align:center;padding:40px;font-size:20px;">No hay registros.</div>';
		return $Regs;
	}

	public function GetProfiles()
	{
		if($this->Profiles){
			return $this->Profiles;
		}else{
			$Profiles = array();
			$Rs 	= $this->fetchAssoc('select','relation_group_profile','*',"group_id=".$this->GroupID,"profile_id");
			foreach ($Rs as $Row) {
				$Profiles[] = $Row['profile_id'];
			}
			$this->Profiles = $Profiles;
			return $Profiles;
		}

	}

	public function GetTotalRegs($Where="")
	{
		return $this->numRows('select','admin_group','*',"1=1 ".$Where);
	}

	public function MakeMenuList($Parent=0)
	{
		if($Parent==0)
		{
			$this->GetCheckedMenues($this->GroupID);
			$this->GetParents();
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
			
			$HTML	.= '<div>'.insertElement('checkbox','menu',$Menu['menu_id'],'Left Pointer MenuCheckbox Menu'.$Menu['parent_id'],$Selected.$Disabled).'<div class="Parent Left Frutiger12px BlueCyan" id="'.$Menu['menu_id'].'">'.$Menu['title'].'</div>'.$Arrow.'<div class="Clear"></div></div>';
			if($IsParent)
			{
				$HTML	.= '<div class="ProfileChild '.$Hidden.'" id="Child'.$Menu['menu_id'].'" >';
				$HTML	.= $this->MakeMenuList($Menu['menu_id']);
				$HTML	.= "</div>";
			}
		}
		
		return $HTML;
	}

	public function GetCheckedMenues()
	{
		$Relations	= $this->fetchAssoc('select','relation_menu_group','*',"group_id = ".$this->GroupID);
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
	
}


?>