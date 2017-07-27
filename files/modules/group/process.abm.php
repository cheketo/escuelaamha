<?php

include('../../includes/inc.main.php');

switch(strtolower($_POST['action']))
{
	case 'insert':
		
		$Name		= $_POST['name'];
		$Profiles	= $_POST['profiles'] ? explode(",",$_POST['profiles']) : array();
		$Menues		= $_POST['menu'] ? explode(",",$_POST['menu']) : array();
		
		$Insert		= $DB->execQuery('insert','admin_group','name',"'".$Name."'");
		$GroupID 	= $DB->GetInsertId();
		
		for($i=0;$i<count($Profiles);$i++)
		{
			$Values .= $i==0? $GroupID.",".$Profiles[$i] : "),(".$GroupID.",".$Profiles[$i];
		}
		$DB->execQuery('insert','relation_group_profile','group_id,profile_id',$Values);

		$Values = "";

		for($i=0;$i<count($Menues);$i++)
		{
			$Values .= $i==0? $GroupID.",".$Menues[$i] : "),(".$GroupID.",".$Menues[$i];
		}
		$DB->execQuery('insert','relation_menu_group','group_id,menu_id',$Values);
		die;
		
	break;
	case 'update': 
		$GroupID	= $_POST['group_id'];
		$Admin		= new AdminData($_POST['admin_id']);

		$Name		= $_POST['name'];
		$Profiles	= $_POST['profiles'] ? explode(",",$_POST['profiles']) : array();
		$Menues		= $_POST['menu'] ? explode(",",$_POST['menu']) : array();

		$DB->execQuery('update','admin_group',"name='".$Name."'","group_id=".$GroupID);
		$DB->execQuery('delete','relation_group_profile',"group_id = ".$GroupID);
		$DB->execQuery('delete','relation_menu_group',"group_id = ".$GroupID);

		for($i=0;$i<count($Profiles);$i++)
		{
			$Values .= $i==0? $GroupID.",".$Profiles[$i] : "),(".$GroupID.",".$Profiles[$i];
		}
		$DB->execQuery('insert','relation_group_profile','group_id,profile_id',$Values);

		$Values = "";

		for($i=0;$i<count($Menues);$i++)
		{
			$Values .= $i==0? $GroupID.",".$Menues[$i] : "),(".$GroupID.",".$Menues[$i];
		}
		$DB->execQuery('insert','relation_menu_group','group_id,menu_id',$Values);

		die;
	break;
	case 'delete': 
		$GroupID	= $_POST['id'];
		$DB->execQuery('delete','relation_group_profile',"group_id = ".$GroupID);
		$DB->execQuery('delete','relation_admin_group',"group_id = ".$GroupID);
		$DB->execQuery('delete','relation_menu_group',"group_id = ".$GroupID);
		$Delete		= $DB->execQuery('delete','admin_group',"group_id=".$GroupID);
		print_r($Delete);
		die;
	break;

	///////////////////////////////////// VALIDATIONS /////////////////////////////////////////////////
	case 'validate':
		$Name 			= strtolower($_POST['name']);
		$ActualName 	= strtolower($_POST['actualname']);

	    if($ActualName)
	    	$TotalRegs  = $DB->numRows('select','admin_group','*',"name = '".$Name."' AND name <> '".$ActualName."'");
    	else
		    $TotalRegs  = $DB->numRows('select','admin_group','*',"name = '".$Name."'");
		if($TotalRegs>0) echo $TotalRegs;
		die;
	break;

	//////////////////////////////////// PAGER ////////////////////////////////////////////////////////
	case 'pager':
		$Page 		= $_POST['page'];
		$Group 		= new GroupData();
		if($Page){
		   
		    $Pager = $_SESSION[$_POST['pagerid']];
		    $Pager->SetActualPage($Page);
		    echo $Group->MakeList($Pager->CalculateRegFrom(),$Pager->GetPageRegs(),$Pager->GetWhere());
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
		$Group 		= new GroupData();
		$Pager = $_SESSION[$_POST['pagerid']];
		$Pager->SetFieldValue($_POST['field'],$_POST['value']);
		$Pager->SetWhere($Pager->GetFields(),'admin_group');
		$Pager->SetTotalRegs($Group->GetTotalRegs($Pager->GetWhere()));
		$_SESSION[$_POST['pagerid']] = $Pager;
		die;
	break;
}

?>