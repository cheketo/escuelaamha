<?php

class Head
{
	var $Title;
	//var $HTML		= '<html xmlns="http://www.w3.org/1999/xhtml">';
var $HTML		= '<html>';
	//var $DocType	= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
var $DocType	= '<!DOCTYPE>';
	var $Link		= array();
	var $Script		= array();
	var $Meta		= array();
	var $Favicon	= '';
	//var $Charset	= "iso-8859-1";
var $Charset	= "UTF-8";
	
	function __construct()
	{
		
	}
	
	function setHTML($HTML)
	{
		$this->HTML	= $HTML;
	}
	
	function setTitle($Title)
	{
		$this->Title	= "<title>".$Title."</title>";
	}
	
	function setHead(){
		echo $this->DocType;
		echo $this->HTML;
		echo "<head>";
		//echo '<meta http-equiv="Content-Type" content="application/xhtml+xml; charset='.$this->Charset.'">';
                
                echo '<meta http-equiv="Content-Type" content="text/html;charset='.$this->Charset.'">';


    	echo '<meta charset="'.$this->Charset.'" >';
		include("../../includes/inc.head.php");
		echo $this->Title;
		echo $this->Favicon;
		$this->echoLink();
		$this->echoMeta();
		$this->echoScript();
		echo "</head>";
	}
	
	function setDocType($DocType)
	{
		$this->DocType	= $DocType;
	}
	
	function setLink($href,$rel,$type)
	{
		$this->Link[]	= '<link href="'.$href.'" rel="'.$rel.'" type="'.$type.'" />';
	}
	
	function setScript($src)
	{
		$this->Script[]	= '<script src="'.$src.'" ></script>';
	}
	
	function setMeta($param1,$param2,$param3)
	{
		$this->Meta[]	= '<meta '.$param1.' '.$param2.' '.$param3.' />';
	}
	
	function echoLink(){
		foreach($this->Link as $Link)
		{
			echo $Link;
		}
	}
	
	function echoScript(){
		foreach($this->Script as $Script)
		{
			echo $Script;
		}
		
	}
	
	function echoMeta(){
		foreach($this->Meta as $Meta)
		{
			echo $Meta;
		}
	}
	
	function setFavicon($Rute)
	{
		$this->Favicon = "<link href='".$Rute."' rel='shortcut icon' type='image/x-icon'>";
	}
	
	function setCharset($Charset)
	{
		$this->Charset	= $Charset;
	}
		
}

?>