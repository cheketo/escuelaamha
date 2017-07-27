<?php

class Section extends DataBase
{
	var $SectionID;
	var $Data 				= array();
	var $Articles 			= array();
	var $Author 			= array();
	var $Profiles 			= array();
	var $AllowedProfiles	= array();
	var $Admins 			= array();
	var $Where				= "status = 'A' ";

	
	public function __construct($SectionID=0)
	{
		$this->Connect();
		$Data			= $SectionID>0? $this->fetchAssoc('select','section','*',"section_id = ".$SectionID) : array();
		$Articles		= $SectionID>0? $this->fetchAssoc('select','article','*',"section_id = ".$SectionID) : array();
		$Author			= count($Data[0])>0? $this->fetchAssoc('select','admin_user','*',"admin_id = ".$Data[0]['author_id']) : array();
		$Parent			= count($Data[0])>0? $this->fetchAssoc('select','menu','parent_id',"menu_id =".$Data[0]['menu_id']) : array();

		$this->SectionID 		= $SectionID;
		$this->Data				= $Data[0];
		$this->Data['parent']	= $Parent[0]['parent_id'];
		$this->Articles			= $Articles;
		$this->Author			= $Author[0];

		if($SectionID>0)
		{
			$this->Admins			= $this->SetAdmins();
			$this->AllowedProfiles	= $this->SetAllowedProfiles();
			$this->AllowedGroups	= $this->SetAllowedGroups();
		}

	}

	public function SetAdmins()
	{
		$Admins = array();
		$Rs 	= $this->fetchAssoc('select','relation_section_admin','*',"section_id=".$this->SectionID,"admin_id");
		foreach ($Rs as $Row) {
			$Admins[] = $Row['admin_id'];
		}
		return $Admins;
	}

	public function GetAdmins()
	{
		return $this->Admins;
	}

	public function SetAllowedProfiles()
	{
		$Profiles 	= array();
		$Rs 		= $this->fetchAssoc('select','relation_menu_profile','*',"menu_id=".$this->Data['menu_id'],"profile_id");
		foreach ($Rs as $Row) {
			$Profiles[] = $Row['profile_id'];
		}
		return $Profiles;
	}

	public function GetAllowedProfiles()
	{
		return $this->AllowedProfiles;
	}

	public function SetAllowedGroups()
	{
		$Groups 	= array();
		$Rs 		= $this->fetchAssoc('select','relation_menu_group','*',"menu_id=".$this->Data['menu_id'],"group_id");
		foreach ($Rs as $Row) {
			$Groups[] = $Row['group_id'];
		}
		return $Groups;
	}

	public function GetAllowedGroups()
	{
		return $this->AllowedGroups;
	}

	public function SetWhere($Where)
	{
		$this->Where = $Where;
	}

	public function GetData()
	{
		return $this->Data;
	}

	public function GetArticles()
	{
		return $this->Articles;
	}

	public function GetAuthor()
	{
		return $this->Author;
	}
	
	public function SetProfiles()
	{
		$this->Profiles		= $this->fetchAssoc('select','admin_profile','*',"","profile_id");
	}

	public function GetProfilesNames($Profiles)
	{
		if($this->Data['public']=="Y")
		{
			return "P&uacute;blico";
		}else{
			$SectionProfiles	= $this->fetchAssoc('select','relation_section_profile','*',"section_id=".$this->SectionID,"profile_id");
			$String = "";

			for($i=0;$i<count($Profiles);$i++)
			{
				$Index								= intval($Profiles[$i]['profile_id']);
				$OrderedProfiles[$Index]['title']	= $Profiles[$i]['title'];
			}

			for($i=0;$i<count($SectionProfiles);$i++)
			{
				$StringValue 	= $OrderedProfiles[$SectionProfiles[$i]['profile_id']]['title'];
				$String 		.= $String==""? $StringValue : ", ".$StringValue;
			}
			return $String;
		}
	}

	public function SearchAllowedGroups($Groups)
	{
		$AllowedGroups = $this->SetAllowedGroups();
		$IsAllowed = false;
		foreach($Groups as $Group)
		{
			if(!$IsAllowed) $IsAllowed = in_array($Group, $AllowedGroups);
		}
		return $IsAllowed;
	}

	public function HavePermission($ProfileID,$Groups)
	{
		if($ProfileID>10)
			return (in_array($ProfileID, $this->SetAllowedProfiles()) || $this->SearchAllowedGroups($Groups));
		else
			return true;
	}

	public function DeleteAll()
	{
		$this->execQuery('update','menu',"status='I'","menu_id=".$this->Data['menu_id']);
		$this->execQuery('update','article',"status='I'","section_id=".$this->SectionID);
		$this->execQuery('update','section',"status='I'","section_id=".$this->SectionID);
		$this->execQuery('update','menu',"status='I'","link = '../section/section.php?id=".$SectionID."'");
	}


	public function MakeList($From=-1, $To=-1,$Where="")
	{	

		$Limit = $From>=0 && $To>=0 ? $From.",".$To : "";
		$Sections	= $this->fetchAssoc('select','section','*',$this->Where.$Where,"title",$Limit);

		$AtLeastOne	= false;
		$this->SetProfiles();
		for($i=0;$i<count($Sections);$i++)
		{
			$Section	=	new Section($Sections[$i]['section_id']);
			
			//$Actions	= 	'<img src="../../../skin/images/body/icons/mini_article.png" action="article" target="../article/list.php?id='.$Section->Data['section_id'].'" id="seccion_'.$Section->Data['section_id'].'" />';
			$Actions	= 	'<img src="../../../skin/images/body/icons/magnifier.png" action="view" class="actionImg" target="section.php?id='.$Section->Data['section_id'].'" id="seccion_'.$Section->Data['section_id'].'" />';
			$Actions	.= 	'<img src="../../../skin/images/body/icons/pencil.png" action="edit" class="actionImg" target="edit.php" id="seccion_'.$Section->Data['section_id'].'" />';
			$Actions	.= 	'<img src="../../../skin/images/body/icons/cross.png" action="delete" class="actionImg" process="process.abm.php" id="seccion_'.$Section->Data['section_id'].'" />';
			

			switch(strtoupper($Section->Data['status']))
			{
				case 'A':
					$Status = 'Activo';
				break;
				case 'I':
					$Status = 'Inactivo';
				break;
			}			

			$Regs	.= '<div class="RegWrapper BlackGray" id="Row'.$Section->Data['section_id'].'">
							<div class="ImgWrapper Left"><img src="../../../skin/images/body/icons/section.png" /></div>
							<div class="DataWrapper Left">
								<div class="BlueCyan">'.$Section->Data['title'].'</div>
								<div>Creador: '.$Section->Author['first_name'].' '.$Section->Author['last_name'].'</div>
								<div>Usuarios Permitidos: '.$Section->GetProfilesNames($this->Profiles).'</div>
							</div>
							<div class="DataWrapper Left">
								<div>Fecha de creaci&oacute;n: '.DateTimeFormat($Section->Data['creation_date']).'</div>
								<div>&Uacute;ltima modificaci&oacute;n: '.DateTimeFormat($Section->Data['modification_date']).'</div>
								<div>Estado: '.$Status.'</div>
							</div>
							<div class="ActionsWrapper Right">'.$Actions.'</div>
							<div class="Clear"></div>
						</div>';  
			$AtLeastOne	= true;
        } 
        if(!$AtLeastOne) $Regs	.= '<div class="RegWrapper DarkRed" id="EmptyRow" style="text-align:center;padding:40px;font-size:20px;">No se encontraron secciones.</div>';
		return $Regs;
	}

	public function GetTotalRegs()
	{
		return $this->numRows('select','section','*',$this->Where);
	}

}

?>