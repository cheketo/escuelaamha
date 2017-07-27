<?php

class Article extends DataBase
{
	var $ArticleID;
	var $SectionID;
	var $Data 				= array();
	var $Articles 			= array();
	var $Author 			= array();
	var $Profiles 			= array();
	var $AllowedProfiles	= array();
	var $Admins 			= array();
	var $SectionData		= array();
	var $Where				= "status = 'A'";

	
	public function __construct($ArticleID=0)
	{
		$this->Connect();
		$this->ArticleID 		= $ArticleID;
		$Data					= $ArticleID>0? $this->fetchAssoc('select','article','*',"article_id = ".$ArticleID) : array();
		$this->Data				= $Data[0];
		$Author					= count($this->Data)>0? $this->fetchAssoc('select','admin_user','*',"admin_id = ".$this->Data['author_id']) : array();
		$this->Author			= $Author[0];
		$this->SectionID 		= $this->Data['section_id'];
		$this->Data['active']	= $ArticleID>0? $this->SetActive() : 1;
		$Data					= $this->SectionID>0? $this->fetchAssoc('select','section','*',"section_id = ".$this->SectionID) : array();
		$this->SectionData 		= $Data[0];

		$this->Admins			= $this->SectionID ? $this->SetAdmins() : array();
		$this->AllowedProfiles	= $this->ArticleID ? $this->SetAllowedProfiles(): array();

	}

	public function SetSection($SectionID=0)
	{
		$this->Where 	= $SectionID>0? "status = 'A' AND section_id=".$SectionID : "status = 'A'";
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

	public function GetFiles()
	{
		$Files 	= array();
		$File = $this->fetchAssoc("select","article_file","*","article_id = ".$this->ArticleID,"creation_date DESC");

		for($i=0;$i<count($File);$i++)
		{
			$Ext 				= array_reverse(explode(".",$File[$i]['name']));
			$Extension 			= $Ext[0];
			$Files[$i]['url']	= $File[$i]['url'];
			$Files[$i]['ext']	= $Extension;
			$Files[$i]['name']	= $File[$i]['name'];
			$Files[$i]['author_id']= $File[$i]['author_id'];
			$Files[$i]['file_id']= $File[$i]['file_id'];
			$Files[$i]['creation_date']= $File[$i]['creation_date'];
		}
		return $Files;
	}

	public function SetAllowedProfiles()
	{
		$Profiles 	= array();
		$Rs 		= $this->fetchAssoc('select','relation_article_profile','*',"article_id=".$this->ArticleID,"profile_id");
		foreach ($Rs as $Row) {
			$Profiles[] = $Row['profile_id'];
		}
		return $Profiles;
	}

	public function GetAllowedProfiles()
	{
		return $this->AllowedProfiles;
	}

	public function SetWhere($Where)
	{
		$this->Where = $Where;
	}

	public function SetActive()
	{
		if($this->Data['start_date']!="0000-00-00 00:00:00" || $this->Data['end_date']!="0000-00-00 00:00:00")
		{
			$ActualDate = strtotime(date("d-m-Y 00:00:00",time()));
			$StartDate 	= strtotime($this->Data['start_date']);
			$EndDate 	= strtotime($this->Data['end_date']);
			return $ActualDate >= $StartDate && $ActualDate<=$EndDate ? 1 : 0;
			
			
		}else{
			return 1;
		}
	}

	public function IsActive()
	{
		return $this->Data['active'];
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
			$ArticleProfiles	= $this->AllowedProfiles;
			$String = "";

			for($i=0;$i<count($Profiles);$i++)
			{
				$Index								= intval($Profiles[$i]['profile_id']);
				$OrderedProfiles[$Index]['title']	= $Profiles[$i]['title'];
			}

			for($i=0;$i<count($ArticleProfiles);$i++)
			{
				$StringValue 	= $OrderedProfiles[$ArticleProfiles[$i]['profile_id']]['title'];
				$String 		.= $String==""? $StringValue : ", ".$StringValue;
			}
			return $String;
		}
	}

	public function HavePermission($ProfileID,$Groups)
	{
		$GroupID 	= empty($Groups)? "0" : implode(',', $Groups);
		$Menu		= $this->fetchAssoc('select','section','menu_id',"section_id = ".$this->SectionID);
		$MenuID 	= $Menu[0]['menu_id'];
		$Profile 	= $this->numRows('select','relation_menu_profile','relation_id',"profile_id = ".$ProfileID." AND menu_id=".$MenuID);
		$Group 		= $this->numRows('select','relation_menu_group','relation_id',"group_id IN (".$GroupID.") AND menu_id = ".$MenuID);
		//echo $this->LastQuery();
		
		return ($Profile + $Group)>0;

		/*
		if($ProfileID>10)
			return in_array($ProfileID, $this->SetAllowedProfiles());
		else
			return true;
		*/
	}

	
	public function DeleteAll()
	{
		//$this->execQuery('delete','relation_article_profile',"article_id=".$this->ArticleID);
		$this->execQuery('update','article',"status='I'","article_id=".$this->ArticleID);
		$this->execQuery('update','menu',"status='I'","link = '../article/article.php?id=".$ArticleID."'");
	}
	


	public function MakeList($From=-1, $To=-1,$Where="")
	{	

		$Limit = $From>=0 && $To>=0 ? $From.",".$To : "";
		$Articles	= $this->fetchAssoc('select','article','*',$this->Where.$Where,"title",$Limit); 

		$AtLeastOne	= false;
		$this->SetProfiles();
		for($i=0;$i<count($Articles);$i++)
		{
			$Article	=	new Article($Articles[$i]['article_id']);
			
			$Actions	= 	'<img src="../../../skin/images/body/icons/magnifier.png" action="view" target="article_preview.php?id='.$Article->Data['article_id'].'" />';
			$Actions	.= 	'<img src="../../../skin/images/body/icons/pencil.png" action="edit" class="actionImg" target="edit.php" id="article_'.$Article->Data['article_id'].'" />';
			$Actions	.= 	'<img src="../../../skin/images/body/icons/cross.png" action="delete" class="actionImg" process="process.abm.php" id="article_'.$Article->Data['article_id'].'" />';
			

			switch(strtoupper($Article->Data['status']))
			{
				case 'A':
					$Status = 'Activo';
				break;
				case 'I':
					$Status = 'Inactivo';
				break;
			}			

			$Regs	.= '<div class="RegWrapper BlackGray" id="Row'.$Article->Data['article_id'].'">
							<div class="ImgWrapper Left"><img src="https://cdn2.iconfinder.com/data/icons/onebit/PNG/onebit_39.png" /></div>
							<div class="DataWrapper Left">
								<div class="BlueCyan">'.$Article->Data['title'].'</div>
								<div>Autor: '.$Article->Author['first_name'].' '.$Article->Author['last_name'].'</div>
								
							</div>
							<div class="DataWrapper Left">
								<div>Fecha de creaci&oacute;n: '.DateTimeFormat($Article->Data['creation_date']).'</div>
								<div>&Uacute;ltima modificaci&oacute;n: '.DateTimeFormat($Article->Data['last_modification']).'</div>
								<div class="Green">'.$Article->Data['subtitle'].'</div>
							</div>
							<div class="ActionsWrapper Right">'.$Actions.'</div>
							<div class="Clear"></div>
						</div>';  
			$AtLeastOne	= true;
        } 
        if(!$AtLeastOne) $Regs	.= '<div class="RegWrapper DarkRed" id="EmptyRow" style="text-align:center;padding:40px;font-size:20px;">No se encontraron art&iacute;culos.</div>';
		return $Regs;
	}

	public function GetTotalRegs($Where="")
	{
		return $this->numRows('select','article','*',$this->Where.$Where);
	}

}

?>