<?php 

	/* INCLUDES */
	include("../../includes/inc.main.php");	
	
	/* INICIALIZATION */
	$Login	= new Login($_POST['user'],$_POST['password']);
	//$Login	= new Login('admin','admin');
	
	/* PROCESS */
	if($Login->UserExist){ /* User Existence */
		
		if($Login->IsMaxTries){ /* Attempts to Login */
			$Login->queryMaxTries(); /* Max Tries Reached */
			echo "1";
		}
		else
		{
			if($Login->PassMatch) /* Password Match*/
			{
				$Login->setSessionVars();
				$Login->setCookies();
				$Login->queryLogin();
			}
			else
			{
				$Login->queryPasswordFail(); /* Password does not Match*/
				echo "1";
			}
		}
	}
	else
	{
		$Login->queryWrongUser(); /* Nonexistent User */
		echo "1";
	}
?>