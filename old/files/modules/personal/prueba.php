<?php 
	function GetDirFiles($Path)
	{
		$Files 	= array();
	    $Dir 	= opendir($Path);   
	    while ($Element = readdir($Dir)){
	        if( $Element != "." && $Element != ".."){
	            if( is_dir($Path.$Element) ){
	                //Add Dir Files
	                $Files[] = GetDirFiles($Element);
	            } else {
	                //Add File
	                $Files[] = $Element;
	            }
	        }
	    }
	    return $Files;
	}

$UploadedFile = GetDirFiles("../../../skin/files/articles/token/admin1/");

$OldDir			= "../../../skin/files/articles/token/admin1/";

$FilesDir	= "../../../skin/files/articles/1/";
//if(!is_dir($FilesDir)) mkdir($FilesDir);
$Values 	= "";
for($i=0;$i<count($UploadedFile);$i++)
{
	$OldFileUrl	= $OldDir.$UploadedFile[$i];
	$FileUrl	= $FilesDir.$UploadedFile[$i];
	echo "Old: ".$OldFileUrl."<br><br>New:".$FileUrl."<br><br><br><br><br>";
	//rename($OldFileUrl,$FileUrl);
	//$Values .= $i==0? $ArticleID.",".$Admin->AdminID.",'".$UploadedFile[$i]."','".$FileUrl."',NOW()" : "),(".$ArticleID.",".$UploadedFile[$i];	
}
//$DB->execQuery('insert','article_file','article_id,author_id,name,url,creation_date',$Values);


?>