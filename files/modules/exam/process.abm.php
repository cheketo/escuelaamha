<?php

include('../../includes/inc.main.php');

switch(strtolower($_POST['action']))
{
	case 'insert':

		$Title		= $_POST['title'];
		$Public		= strtoupper($_POST['public']);
		$Comment	= $_POST['comment'];
		$Reply		= $_POST['reply'];
		$Status		= $_POST['status'];
		$Parent		= $_POST['parent'] == -1? 0 : $_POST['parent'];
		$AdminID	= explode(",",$_POST['admin']);
		$ProfileID	= $Public!='Y'? explode(",",$_POST['profile']) : array();
		$GroupID	= $Public!='Y'? explode(",",$_POST['group']) : array();
		
		$DB->execQuery('insert','section','title,public,comment,reply,status,author_id,creation_date',"'".$Title."','".$Public."','".$Comment."','".$Reply."','".$Status."',".$Admin->AdminID.",NOW()");
		$SectionID 	= $DB->GetInsertId();

		$DB->execQuery('insert','menu','title,parent_id,link,status,position,public',"'".$Title."',".$Parent.",'../section/section.php?id=".$SectionID."','A',99,'".$Public."'");
		$MenuID 	= $DB->GetInsertId();

		$DB->execQuery('update','section',"menu_id = ".$MenuID,"section_id = ".$SectionID);

		$Exceptions = $DB->fetchAssoc('select','menu','menu_id',"link='../article/list.php' OR link='../article/new.php' OR link='../article/edit.php' OR menu_id=7");

		$Values 	= "";
		foreach($AdminID as $Adm)
		{
			foreach($Exceptions as $Menu)
			{
				$Rows = $DB->numRows("select","menu_exception","*","menu_id = ".$Menu['menu_id']." AND admin_id = ".$Adm);
				if($Rows<1) $Values .= $Values==""? $Menu['menu_id'].",".$Adm : "),(".$Menu['menu_id'].",".$Adm;
			}
		}
		$DB->execQuery('insert','menu_exception','menu_id,admin_id',$Values);
		
		$Values 	= "";
		for($i=0;$i<count($AdminID);$i++)
		{
			$Values .= $i==0? $SectionID.",".$AdminID[$i] : "),(".$SectionID.",".$AdminID[$i];	
		}
		$DB->execQuery('insert','relation_section_admin','section_id,admin_id',$Values);
		

		if(!empty($ProfileID))
		{
			$Values 	= "";
			for($i=0;$i<count($ProfileID);$i++)
			{
				$Values .= $i==0? $MenuID.",".$ProfileID[$i] : "),(".$MenuID.",".$ProfileID[$i];				
			}
			$DB->execQuery('insert','relation_menu_profile','menu_id,profile_id',$Values);
		}

		if(!empty($GroupID))
		{
			$Values 	= "";
			for($i=0;$i<count($GroupID);$i++)
			{
				$Values .= $i==0? $MenuID.",".$GroupID[$i] : "),(".$MenuID.",".$GroupID[$i];				
			}
			$DB->execQuery('insert','relation_menu_group','menu_id,group_id',$Values);
		}

		die;
		
	break;
	case 'update':

		$Section_id	= $_POST['section_id'];
		
		$Title		= $_POST['title'];
		$Public		= $_POST['public'];
		$Comment	= $_POST['comment'];
		$Reply		= $_POST['reply'];
		$Status		= $_POST['status'];
		$Parent		= $_POST['parent'] == -1? 0 : $_POST['parent'];
		$AdminID	= explode(",",$_POST['admin']);
		$ProfileID	= $Public!='Y'? explode(",",$_POST['profile']) : array();
		$GroupID	= $Public!='Y'? explode(",",$_POST['group']) : array();

		$Update		= $DB->execQuery('update','section',"title='".$Title."',public='".$Public."',comment='".$Comment."',status='".$Status."',reply='".$Reply."',last_update_id=".$Admin->AdminID,"section_id=".$Section_id);
		$SecMenu	= $DB->fetchAssoc('select','section','menu_id',"section_id = ".$Section_id);
		$MenuID 	= $SecMenu[0]['menu_id'];
		
		if($MenuID==0)
		{
			$SecMenu	= $DB->fetchAssoc('select','menu','menu_id',"link = '../section/section.php?id=".$Section_id."'");
			$MenuID 	= $SecMenu[0]['menu_id'];
			if($MenuID==0 || !$MenuID)
			{
				$DB->execQuery('insert','menu','title,parent_id,link,status,position',"'".$Title."',".$Parent.",'../section/section.php?id=".$Section_id."','A',99");
				$MenuID 	= $DB->GetInsertId();
			}
			$DB->execQuery('update','section',"menu_id=".$MenuID,"section_id=".$Section_id);
		}
		
		$Exceptions = $DB->fetchAssoc('select','menu','menu_id',"link='../article/list.php' OR link='../article/new.php' OR link='../article/edit.php' OR menu_id=7");

		foreach ($Exceptions as $Exception) {
			$Excep[] = $Exception['menu_id'];
		}

		$DeleteMenu	= implode(",",$Excep);

		$Values 	= "";

		$DB->execQuery('update','menu',"title='".$Title."',parent_id = ".$Parent,"menu_id = ".$MenuID);
		
		//$Menu 	= $DB->fetchAssoc("select","menu","menu_id","link = '../section/section.php?id=".$Section_id."'");
		//$MenuID = $Menu[0]['menu_id'];

		$AdminsDelete	= $DB->fetchAssoc('select','relation_section_admin',"admin_id, COUNT(*) as 'cantidad'","section_id = ".$Section_id." GROUP BY admin_id");
		foreach($AdminsDelete as $AdminDelete)
		{
			if($AdminDelete['cantidad']<2) $Admins[] = $AdminDelete['admin_id'];
		}
		$AdminsToDeleteException = implode(",",$Admins);
		$DB->execQuery('delete','menu_exception',"admin_id IN (".$AdminsToDeleteException.") AND menu_id IN (".$DeleteMenu.")");

		$DB->execQuery('delete','relation_section_admin',"section_id=".$Section_id);
		$DB->execQuery('delete','relation_menu_profile',"menu_id = ".$MenuID);
		$DB->execQuery('delete','relation_menu_group',"menu_id = ".$MenuID);

		$Values 	= "";
		foreach($AdminID as $Adm)
		{
			foreach($Exceptions as $Menu)
			{
				$Rows = $DB->numRows("select","menu_exception","*","menu_id = ".$Menu['menu_id']." AND admin_id = ".$Adm);
				if($Rows<1) $Values .= $Values==""? $Menu['menu_id'].",".$Adm : "),(".$Menu['menu_id'].",".$Adm;
			}
		}
		$DB->execQuery('insert','menu_exception','menu_id,admin_id',$Values);
		
		$Values 	= "";
		for($i=0;$i<count($AdminID);$i++)
		{
			$Values .= $i==0? $Section_id.",".$AdminID[$i] : "),(".$Section_id.",".$AdminID[$i];	
		}
		$DB->execQuery('insert','relation_section_admin','section_id,admin_id',$Values);
		

		if(!empty($ProfileID))
		{
			$Values 	= "";
			for($i=0;$i<count($ProfileID);$i++)
			{
				$Values .= $i==0? $MenuID.",".$ProfileID[$i] : "),(".$MenuID.",".$ProfileID[$i];				
			}
			$DB->execQuery('insert','relation_menu_profile','menu_id,profile_id',$Values);
		}

		if(is_array($GroupID))
		{
			if(!empty($GroupID))
			{
				$Values 	= "";
				for($i=0;$i<count($GroupID);$i++)
				{
					$Values .= $i==0? $MenuID.",".$GroupID[$i] : "),(".$MenuID.",".$GroupID[$i];				
				}
				$DB->execQuery('insert','relation_menu_group','menu_id,group_id',$Values);
			}
		}else{
			$DB->execQuery('insert','relation_menu_group','menu_id,group_id',$MenuID.','.$GroupID);
		}

		die;
	break;
	case 'delete': 
		$Section = new Section($_POST['id']);
		$Section->DeleteAll();
		die;
	break;
	case 'pager':
		$Page 		= $_POST['page'];
		if($Page){
		   	$Section = new Section();
		    $Pager = $_SESSION[$_POST['pagerid']];
		    $Pager->SetActualPage($Page);
		    if($Admin->ProfileID>2) $Where = " AND section_id IN (SELECT section_id FROM relation_section_admin WHERE admin_id = ".$Admin->AdminID.")";
		    echo utf8_encode($Section->MakeList($Pager->CalculateRegFrom(),$Pager->GetPageRegs(),$Pager->GetWhere().$Where));
		    $_SESSION[$_POST['pagerid']] = $Pager;
	   	}
	   	die;
	break;
	case 'changepagerview':
		$Regs 		= $_POST['regs'];
		if($Regs){
			$ID 	= $_POST['pagerid'];
			$Pager 	= $_SESSION[$ID];
			$Pager ->SetPageRegs($Regs);
			$Result	= $Pager->CalculatePages()>1? $Pager->InsertAjaxPager() : "erase";
			echo  $Result;
			$_SESSION[$ID] = $Pager;
			die;
	   	}
	break;
	case 'searcher': 
		$Table 	= 'section';
		$Section 	= new Section();
		
		$Pager 	= $_SESSION[$_POST['pagerid']];
		$Pager->SetFieldValue($_POST['field'],$_POST['value']);
		$Pager->SetWhere($Pager->GetFields(),$Table);
		if($Admin->ProfileID>2) $Where = " AND section_id IN (SELECT section_id FROM relation_section_admin WHERE admin_id = ".$Admin->AdminID.")";
		$Pager->SetTotalRegs($Section->GetTotalRegs($Pager->GetWhere().$Where));
		$_SESSION[$_POST['pagerid']] = $Pager;
		die;
	break;
}

?>