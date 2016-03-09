<?php

class AlertData extends DataBase
{
	var		$AlertID;
	var 	$AlertData = array();
	
	public function __construct($AlertID='')
	{
		$this->Connect();
		$this->AlertID 		= $AlertID;
		
		$this->AlertData 	= $AlertID ? $this->fetchAssoc('select','alert','*',"alert_id = '".$this->AlertID."'") : '';
		$this->AlertData	= $this->AlertData[0];
	}
	
	public function InsertAlert($UserID='0',$Title='',$Description='',$Link='',$Status='N')
	{
		return $this->execQuery('insert','alert','user_id,title,description,link,status,creation_date',$UserID.",'".$Title."','".$Description."','".$Link."','".$Status."',NOW()");
	}

}

?>