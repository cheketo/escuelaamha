<?php

include('../../includes/inc.main.php');

switch(strtolower($_POST['action']))
{
	case 'insert':

		$Token			= "admin".$_POST['admin'];
		$Title			= $_POST['title'];
		$Subtitle		= $_POST['subtitle'];
		$Description	= html_entity_decode($_POST['description']);

		//$Public			= $_POST['public'];
		$Important		= $_POST['important'];
		$Comment		= $_POST['comment'];
		$Reply			= $_POST['reply'];
		$SectionID		= $_POST['section_id'];
		$StartDate		= $_POST['start_date'] ? implode("-",array_reverse(explode("/",$_POST['start_date']))) : "0000-00-00";
		$EndDate		= $_POST['end_date'] ? implode("-",array_reverse(explode("/",$_POST['end_date']))) : "0000-00-00";
		
		//$ProfileID		= $Public!='Y'? explode(",",$_POST['profile']) : array();
		//$GroupID		= $Public!='Y'? explode(",",$_POST['group']) : array();
		$OldDir			= "../../../skin/files/articles/token/".$Token."/";
		$UploadedFile	= GetDirFiles($OldDir);
		

		$DB->execQuery('insert','article','section_id,title,subtitle,description,public,important,comment,reply,start_date,end_date,author_id,creation_date',$SectionID.",'".$Title."','".$Subtitle."','".$Description."','N','".$Important."','".$Comment."','".$Reply."','".$StartDate."','".$EndDate."',".$Admin->AdminID.",NOW()");
		$ArticleID 	= $DB->GetInsertId();

		
		if(count($_FILES['img'])>0)
		{
			$ImgDir		= "../../../skin/images/articles/".$ArticleID."/";
			if(!is_dir($ImgDir)) mkdir($ImgDir);
			$Name		= "main";
			$Img		= new FileData($_FILES['img'],$ImgDir,$Name);
			$Image		= $Img	-> BuildImage(370,230,"strict");
			$DB->execQuery('insert','article_img','article_id,url,main,position',$ArticleID.",'".$Image."','Y',1");
		}

		/*
		if(!empty($ProfileID))
		{
			for($i=0;$i<count($ProfileID);$i++)
			{
				$Values .= $i==0? $ArticleID.",".$ProfileID[$i] : "),(".$ArticleID.",".$ProfileID[$i];
			}
			$DB->execQuery('insert','relation_article_profile','article_id,profile_id',$Values);
		}

		$Values 	= "";

		if(!empty($GroupID))
		{
			for($i=0;$i<count($GroupID);$i++)
			{
				$Values .= $i==0? $ArticleID.",".$GroupID[$i] : "),(".$ArticleID.",".$GroupID[$i];
			}
			$DB->execQuery('insert','relation_article_group','article_id,group_id',$Values);
		}

		$Values 	= "";
		*/

		if(!empty($UploadedFile))
		{
			$FilesDir	= "../../../skin/files/articles/".$ArticleID."/";
			if(!is_dir($FilesDir)) mkdir($FilesDir);
			$Values 	= "";
			for($i=0;$i<count($UploadedFile);$i++)
			{
				$UploadedFile[$i] = ReplaceLatin($UploadedFile[$i]);
				$OldFileUrl	= $OldDir.$UploadedFile[$i];
				$FileUrl	= $FilesDir.$UploadedFile[$i];
				rename($OldFileUrl,$FileUrl);
				$Values .= $i==0? $ArticleID.",".$Admin->AdminID.",'".$UploadedFile[$i]."','".$FileUrl."',NOW()" : "),(".$ArticleID.",".$Admin->AdminID.",'".$UploadedFile[$i]."','".$FileUrl."',NOW()";	
			}
			$DB->execQuery('insert','article_file','article_id,author_id,name,url,creation_date',$Values);
		}

		die;
		
	break;
	case 'update': 
		
		$ArticleID	= $_POST['article'];
		
		$Token			= "admin".$_POST['admin'];
		$Title			= $_POST['title'];
		$Subtitle		= $_POST['subtitle'];
		$Description	= $_POST['description'];

		//$Public			= $_POST['public'];
		$Important		= $_POST['important'];
		$Comment		= $_POST['comment'];
		$Reply			= $_POST['reply'];
		$SectionID		= $_POST['section_id'];
		$StartDate		= $_POST['start_date'] ? implode("-",array_reverse(explode("/",$_POST['start_date']))) : "0000-00-00";
		$EndDate		= $_POST['end_date'] ? implode("-",array_reverse(explode("/",$_POST['end_date']))) : "0000-00-00";
		
		//$ProfileID		= $Public!='Y'? explode(",",$_POST['profile']) : array();
		//$GroupID		= $Public!='Y'? explode(",",$_POST['group']) : array();
		$OldDir			= "../../../skin/files/articles/token/".$Token."/";
		$UploadedFile	= GetDirFiles($OldDir);

		$DB->execQuery('update','article',"section_id=".$SectionID.",title='".$Title."',subtitle='".$Subtitle."',description='".$Description."',public='N',important='".$Important."',comment='".$Comment."',reply='".$Reply."',start_date='".$StartDate."',end_date='".$EndDate."',last_modification_id=".$Admin->AdminID.",last_modification=NOW()","article_id = ".$ArticleID);


		if(count($_FILES['img'])>0)
		{
			$MainImg = "../../../skin/images/articles/".$ArticleID."/main.jpeg";
			if(file_exists($MainImg)) unlink($MainImg);
			$ImgDir		= "../../../skin/images/articles/".$ArticleID."/";
			if(!is_dir($ImgDir)) mkdir($ImgDir);
			$Name		= "main";
			$Img		= new FileData($_FILES['img'],$ImgDir,$Name);
			$Image		= $Img	-> BuildImage(370,230,"strict");
			if(!file_exists($MainImg)) $DB->execQuery('insert','article_img','article_id,url,main,position',$ArticleID.",'".$Image."','Y',1");
		}
		/*
		if(!empty($ProfileID))
		{
			$DB->execQuery("delete","relation_article_profile","article_id = ".$ArticleID);
			
			for($i=0;$i<count($ProfileID);$i++)
			{
				$Values .= $i==0? $ArticleID.",".$ProfileID[$i] : "),(".$ArticleID.",".$ProfileID[$i];					
			}
			$DB->execQuery('insert','relation_article_profile','article_id,profile_id',$Values);
		}

		$Values 	= "";

		if(!empty($GroupID))
		{
			$DB->execQuery("delete","relation_article_group","article_id = ".$ArticleID);
			
			for($i=0;$i<count($GroupID);$i++)
			{
				$Values .= $i==0? $ArticleID.",".$GroupID[$i] : "),(".$ArticleID.",".$GroupID[$i];					
			}
			$DB->execQuery('insert','relation_article_group','article_id,group_id',$Values);
		}

		$Values 	= "";
		*/
		if(!empty($UploadedFile))
		{
			$FilesDir	= "../../../skin/files/articles/".$ArticleID."/";
			if(!is_dir($FilesDir)) mkdir($FilesDir);
			$Values 	= "";
			for($i=0;$i<count($UploadedFile);$i++)
			{
				$UploadedFile[$i] = ReplaceLatin($UploadedFile[$i]);
				$OldFileUrl	= $OldDir.$UploadedFile[$i];
				$FileUrl	= $FilesDir.$UploadedFile[$i];
				rename($OldFileUrl,$FileUrl);
				$Values .= $i==0? $ArticleID.",".$Admin->AdminID.",'".$UploadedFile[$i]."','".$FileUrl."',NOW()" : "),(".$ArticleID.",".$Admin->AdminID.",'".$UploadedFile[$i]."','".$FileUrl."',NOW()";	
			}
			$DB->execQuery('insert','article_file','article_id,author_id,name,url,creation_date',$Values);
		}

		die;
	break;
	case 'delete': 
		$Article = new Article($_POST['id']);
		$Article->DeleteAll();
		die($_POST['id']);
	break;
	////////////////////////////////////////////////////////////////////////////////// COMMENT ///////////////////////////////////////////////////////////////////////////
	case 'newcomment': 
		
		$Message	= $_POST['message'];
		$Article	= $_POST['article'];
		$Parent		= $_POST['parentid'];
		$Author		= $Admin->AdminID;
		$AuthorData = $DB->fetchAssoc("select","admin_user","*","admin_id=".$Author);
		$Values		= "'".$Message."',".$Article.",".$Author.",".$Parent.",NOW()";
		$DB->execQuery('insert','comment','message,article_id,author_id,parent_id,creation_date',$Values);
		$CommentID 	= $DB->GetInsertId();
		$Comment 	= $DB->fetchAssoc("select","comment","*","comment_id = ".$CommentID);
		$Data 		= $DB->fetchAssoc("select","article","*","article_id = ".$Article);
		$Reply 		= $Parent>0 || $Data[0]['reply']=='N'? "" : ' - <div class="BlueCyan reply'.$CommentID.'" style="display:inline-block;cursor:pointer;" comment="'.$CommentID.'">Responder</div>';
		$Alert = new AlertData();
		$Alert->InsertAlert($Data[0]['author_id'],'Nuevo Comentario',$AuthorData[0]['first_name'].' '.$AuthorData[0]['last_name'].' hizo un comentario en el artículo '.$Data[0]['title'],'../article/article.php?id='.$Article);

		$Style  = $Parent >0? '': ' style="border-bottom:1px dashed #666;padding-bottom:10px;"';

		if($Parent >0){
			$ParentData = $DB->fetchAssoc("select","comment","*","comment_id = ".$Parent);
			$Alert->InsertAlert($ParentData[0]['author_id'],'Respondieron un comentario tuyo',$Admin->FullName.' respondió un comentario tuyo en el artículo '.$Data[0]['title'],'../article/article.php?id='.$Article);	
		}

		$HTML = '<div class="CommentContent" '.$Style.'>
                <div class="Left CommentImg Center">
                    <img src="'.$Admin->Img.'" class="BorderRadius" width:="47" height="47" />
                    <div class="BlueCyan Noto10px">'.$Admin->FullName.'</div>
                </div>
                <div class="Left CommentBody">
                    <div class="Georgia12px DarkGray Margin10" style="margin-bottom:0px;">'.$Comment[0]['message'].'</div>
                    <div class="Noto10px Gray Margin10" style="margin-top:5px;">'.DateTimeFormat($Comment[0]['creation_date']).$Reply.'</div>';
         if($Parent==0){
        $HTML .=    '<div class="CommentContent comcont" style="width:100%;display:none;" id="CommentContainer'.$CommentID.'">
                        <div class="Left CommentImg Center">
                            <img src="'.$Admin->Img.'" class="BorderRadius" width:="47" height="47" />
                            <div class="BlueCyan Noto10px">'.$Admin->FullName.'</div>
                        </div>
                        <div class="Left CommentBody" style="width:92%;margin-top:10px;">
                            <div style="width:100%;">'.insertElement('textarea','newcomment'.$CommentID,'','Vertical Georgia12px BlueCyan Bold BorderRadius NewComment','tabindex="1" rows="3" default="Escribir comentario..." ').'</div>
                            <div style="text-align:right; width:99%;margin:10px 0px;">
                                '.insertElement('button','ButtonComment','PUBLICAR COMENTARIO','SubmitButton ButtonComment'.$CommentID.' Center Arial14px BlackGray Bold','tabindex="99" parent="'.$CommentID.'"').'
                            </div>
                        </div>
                        <div class="Clear"></div>
                    </div><script>
                    	$(".reply'.$CommentID.'").click(function(){
							var comment = $(this).attr("comment");
							if($("#CommentContainer"+comment).css("display")=="none"){
								$(".comcont").slideUp();
								$("#CommentContainer"+comment).slideDown();
							}else{
								$("#CommentContainer"+comment).slideUp();
							}
						});

						$(".ButtonComment'.$CommentID.'").click(function(){
							var button 	= $(this);
							var parent	= $(this).attr("parent");
							var text	= $("#newcomment"+parent).val();
							var process = "process.abm.php";

							$.ajax({
								url: process,
								type:\'POST\',
								data:{action:"newcomment",article:$("#article").val(),parentid:parent,message:text},
								success: function(rs){
									if(rs)
									{
										if(parseInt(parent)>0)
											button.parent().parent().parent().before(rs);
										else
											$("#CommentContainer0").before(rs);
									}
									
									$("#newcomment"+parent).val("");
									$("#newcomment"+parent).blur();
								}
							});
						});
                    </script>';
        }
        
        $HTML .= '</div>
                <div class="Clear"></div>
            </div>';

        echo $HTML;
        die;
	break;
	/////////////////////////////////////////////////////////////////////////////// FILES ////////////////////////////////////////////////////////////////////////////////
	case 'upload':

			$Token	= $_POST['token'];
			$Dir = "../../../skin/files/articles/token/".$Token;
			if(!is_dir ($Dir)) mkdir($Dir);

			if(isset($_FILES["uploadedfile"]))
			{
				$ret = array();

				$error =$_FILES["uploadedfile"]["error"];
				//You need to handle  both cases
				//If Any browser does not support serializing of multiple files using FormData() 
				if(!is_array($_FILES["uploadedfile"]["name"])) //single file
				{

			 	 	$FileName 	= ReplaceLatin($_FILES["uploadedfile"]["name"]);
			 		$FileUrl 	= $Dir."/".$FileName;
			 		if(file_exists($FileUrl)) unlink($FileUrl);
			 		move_uploaded_file($_FILES["uploadedfile"]["tmp_name"],$FileUrl);
			    	$ret[]= $FileName;
				}
				else  //Multiple files, file[]
				{
				  $fileCount = count($_FILES["uploadedfile"]["name"]);
				  for($i=0; $i < $fileCount; $i++)
				  {
				  	$FileName = ReplaceLatin($_FILES["uploadedfile"]["name"][$i]);
				  	$FileUrl 	= $Dir."/".$FileName;
			 		if(file_exists($FileUrl)) unlink($FileUrl);
					move_uploaded_file($_FILES["uploadedfile"]["tmp_name"][$i],$FileUrl);
				  	$ret[]= $FileName;
				  }
				
				}
			    echo json_encode($ret);
			 }
		die;
	break;

	case 'deletefile':
		//unlink("../../../skin/files/articles/token/admin1/".$_POST['name']);
		
		$Token	= $_POST['token'];
		$Path	= $_POST['path'];
		$FileID	= $_POST['file'];
		

		$Dir = $Path? "../../../skin/files/articles/".$Path : "../../../skin/files/articles/token/".$Token;
		//if(!is_dir ($Dir)) mkdir($Dir);

		if(isset($_POST['name']))
		{
			$FileName = ReplaceLatin($_POST['name']);
			$filePath = $Dir."/".$FileName;
			if(file_exists($filePath)) 
			{
		        unlink($filePath);
		    }
		    if($FileID) $DB->execQuery("delete","article_file","file_id = ".$FileID);
		}
		die;
	break;

	//////////////////////////////////////////////////////////////// PAGER //////////////////////////////////////////////////////////////////////
	case 'pager':
		$Page 		= $_POST['page'];
		if($Page){
		   	$Article = new Article();
		    $Pager = $_SESSION[$_POST['pagerid']];
		    $Pager->SetActualPage($Page);
		    if($Admin->ProfileID>2) $Where = " AND section_id IN (SELECT section_id FROM relation_section_admin WHERE admin_id = ".$Admin->AdminID.")";
		    echo utf8_encode($Article->MakeList($Pager->CalculateRegFrom(),$Pager->GetPageRegs(),$Pager->GetWhere().$Where));
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
		$Article 	= new Article();
		
		$Pager 	= $_SESSION[$_POST['pagerid']];
		$Pager->SetFieldValue($_POST['field'],$_POST['value']);
		$Pager->SetWhere($Pager->GetFields(),$Table);
		if($Admin->ProfileID>2) $Where = " AND section_id IN (SELECT section_id FROM relation_section_admin WHERE admin_id = ".$Admin->AdminID.")";
		$Pager->SetTotalRegs($Article->GetTotalRegs($Pager->GetWhere().$Where));
		$_SESSION[$_POST['pagerid']] = $Pager;
		die;
	break;
}

?>