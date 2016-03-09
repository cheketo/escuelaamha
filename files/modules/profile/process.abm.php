<?php

include('../../includes/inc.main.php');

switch($_POST['action'])
{
	case 'insert':
		
		$MenuID		= $_POST['id'];
		$ProfileID	= $_POST['profile'];
		
		$Insert		= $DB->execQuery('insert','relation_menu_profile','menu_id,profile_id',$MenuID.",".$ProfileID);
		
	break;
	case 'update': 
		$Insert		= $DB->execQuery('update','admin_user',"user='".$User."'".$PasswordFilter.",first_name='".$FirstName."',last_name='".$LastName."',status='".$Status."',profile_id='".$ProfileID."'".$ImgFilter,"admin_id=".$Admin_id);
	break;
	case 'delete_relation': 
	
		$MenuID		= $_POST['id'];
		$ProfileID	= $_POST['profile'];
		
		$Delete		= $DB->execQuery('delete','relation_menu_profile',"menu_id=".$MenuID." AND profile_id = ".$ProfileID);
	break;
	
	case 'fill':
		if(count($DB->fetchAssoc('select','admin_profile','profile_id,title',"profile_id = ".$_POST['id']))>0)
		{
			$Profiles = new ProfileData();
			echo utf8_encode($Profiles->MakeList($_POST['id'])); 
		}
	break;
	
	case 'delete':
		$ProfileID	= $_POST['id'];
		
		$DeleteRelations		= $DB->execQuery('delete','relation_menu_profile'," profile_id = ".$ProfileID);
		$Delete					= $DB->execQuery('delete','admin_profile'," profile_id = ".$ProfileID);
		print_r($Delete);
	break;
	
	case 'new':
		if(count($DB->fetchAssoc('select','admin_profile','profile_id',"title = '".$_POST['name']."'"))<1)
		{
			$Insert		= $DB->execQuery('insert','admin_profile','title',"'".$_POST['name']."'");
			$ProfileID	= $DB->fetchAssoc('select','admin_profile','profile_id',"title = '".$_POST['name']."'");
			echo $ProfileID[0]['profile_id'];
		}else{
			
		}	
	break;
}

?>