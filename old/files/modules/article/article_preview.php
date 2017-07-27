<?php
	include('../../includes/inc.main.php');
		
	$ArticleID 	= $_GET['id'];
	$Article 	= new Article($ArticleID);
	$Data		= $Article->GetData();
	if(!$ArticleID || !$Admin->ProfileID<10){header("location:../principal/main.php");die;}
	
    $Files = $Article->GetFiles();
	$Head->setTitle($Data['title']);
	$Head->setHead();

	$ArticleSkin = empty($Files)? "OnlyArticleWrapper" : "ArticleWrapper";

    function ShowComments($Comment,$ArticleID,$Admin,$Data)
    {
        $Author = new AdminData($Comment['author_id']);
        $Reply  = $Comment['parent_id'] >0 || $Data['reply']=='N'? '': ' - <div class="BlueCyan reply" style="display:inline-block;cursor:pointer;" comment="'.$Comment['comment_id'].'">Responder</div>';
        $Comments = $Author->fetchAssoc('select','comment',"*","article_id=".$ArticleID." AND parent_id = ".$Comment['comment_id']);

        $Style  = $Comment['parent_id'] >0? '': ' style="border-bottom:1px dashed #666;padding-bottom:10px;"';

        $HTML = ' <div class="CommentContent" '.$Style.'>
                    <div class="Left CommentImg Center">
                        <img src="'.$Author->Img.'" class="BorderRadius" width:="47" height="47" />
                        <div class="BlueCyan Noto10px">'.$Author->FullName.'</div>
                    </div>
                    <div class="Left CommentBody">
                        <div class="Georgia12px DarkGray Margin10" style="margin-bottom:0px;">'.$Comment['message'].'</div>
                        <div class="Noto10px Gray Margin10" style="margin-top:5px;">'.DateTimeFormat($Comment['creation_date']).$Reply.'</div>';
                    if($Data['reply']=='Y'){
                        foreach($Comments as $Com)
                        {
                            $HTML .= ShowComments($Com,$ArticleID,$Admin,$Data);
                        }
                    }
        if($Comment['parent_id']==0){
        $HTML .=    '<div class="CommentContent comcont" style="width:100%;display:none;" id="CommentContainer'.$Comment['comment_id'].'">
                        <div class="Left CommentImg Center">
                            <img src="'.$Admin->Img.'" class="BorderRadius" width:="47" height="47" />
                            <div class="BlueCyan Noto10px">'.$Admin->FullName.'</div>
                        </div>
                        <div class="Left CommentBody" style="width:92%;margin-top:10px;">
                            <div style="width:100%;">'.insertElement('textarea','newcomment'.$Comment['comment_id'],'','Vertical Georgia12px BlueCyan Bold BorderRadius NewComment','tabindex="1" rows="3" default="Escribir comentario..." ').'</div>
                            <div style="text-align:right; width:99%;margin:10px 0px;">
                                '.insertElement('button','ButtonComment','PUBLICAR COMENTARIO','SubmitButton ButtonComment Center Arial14px BlackGray Bold','tabindex="99" parent="'.$Comment['comment_id'].'"').'
                            </div>
                        </div>
                        <div class="Clear"></div>
                    </div>';
        }
        $HTML .=    '</div>
                        <div class="Clear"></div>
                    </div>';

        return $HTML;
    }

?>
<body>
	<style>
		p:first {display:inline-block;text-align:justify; float:left;}
		p 		{text-align:justify;}
		
	</style>
	<?php include("../../includes/inc.top.php"); ?>

	<div id="Content">
    
    	<div class="<?php echo $ArticleSkin; ?> Left">        
            <div class="ListTop BorderRadiusTop Georgia25px"><?php echo $Data['title']; ?></div>
            <div class="ListBody Georgia14px" style="padding:10px 20px; padding-bottom:0px;">
            	<?php if(file_exists("../../../skin/images/articles/".$Data['article_id']."/main.jpeg")){ ?>
            		<img src="../../../skin/images/articles/<?php echo $Data['article_id']; ?>/main.jpeg" style="border:1px solid #999;margin-right:20px; margin-bottom:5px; float:left; display:inline-block;" />
                <?php } if($Data['subtitle']){ ?>
                <p><?php echo $Data['subtitle']; ?></p>
                <?php }
                    echo $Data['description'];
                   
                ?>
                <div class="Clear"></div>
            </div>
        	<div class="ListBot BorderRadiusBot"></div>

            <?php if($Data['comment']=='Y'){ ?>
            <div>
                <div class="ListTop BorderRadiusTop Georgia25px">Comentarios</div>
                <div class="ListBody Georgia14px" style="padding:0px;" id="MainComment">
                    <form name="frm" id="frm" method="post" action="process.abm.php" enctype="multipart/form-data">
                    <?php 
                        echo insertElement('hidden','article',$ArticleID);

                        $Comments = $DB->fetchAssoc('select','comment',"*","article_id=".$ArticleID." AND parent_id = 0"); 
                        foreach($Comments as $Comment)
                        {
                          echo ShowComments($Comment,$ArticleID,$Admin,$Data);
                        }
                    ?>
                   

                    <div class="CommentContent" style="width:100%;" id="CommentContainer0">
                        <div class="Left CommentImg Center">
                            <img src="<?php echo $Admin->Img; ?>" class="BorderRadius" width:="47" height="47" />
                            <div class="BlueCyan Noto10px"><?php echo $Admin->FullName; ?></div>
                        </div>
                        <div class="Left CommentBody" style="width:92%;margin-top:10px;">
                            <div style="width:100%;"><?php echo insertElement('textarea','newcomment0','','Vertical Georgia12px BlueCyan Bold BorderRadius NewComment','tabindex="1" rows="3" default="Escribir comentario..." '); ?></div>
                            <div style="text-align:right; width:99%;margin:10px 0px;">
                                <?php echo insertElement('button','ButtonComment','PUBLICAR COMENTARIO','SubmitButton ButtonComment Center Arial14px BlackGray Bold','tabindex="99" parent="0"'); ?>
                            </div>
                        </div>
                        <div class="Clear"></div>
                    </div>


                    </form>
                </div>
                <div class="ListBot BorderRadiusBot"></div>
                </div>
            </div>
            <?php } ?>

        <?php if(!empty($Files)){ ?>
        <div class="ArticleDownloadWrapper Left">        
            <div class="ListTop BorderRadiusTop Georgia20px">Descargas</div>
            <div class="ListBody Georgia14px">
            	<?php foreach($Files as $File){ 

            			$AuthorData = $DB->fetchAssoc("select","admin_user","*","admin_id = ".$File['author_id']);
						$Author 	= $AuthorData[0];
            	?>
            	
            		<div class="DownloadFile">
            			<a href="<?php echo $File['url']; ?>">
	            			<div class="Left" style="background:url(../../../skin/images/body/icons/<?php echo GetFileTypeImg($File['ext']); ?>.png) center center no-repeat; width:12%; height:32px; margin:1%;"></div>
	            			<div class="Left" style="margin-top:2px; width:85%;">
	            				<div class="Green Bold"><?php echo $File['name']; ?></div>
	            				<div class="Arial10px">Subido por <span class="BlueCyan"><?php echo $Author['first_name']." ".$Author['last_name']; ?></span> el <?php echo DateTimeFormat($File['creation_date']); ?></div>
	            				<div class="Arial10px"></div>
	            			</div>
	            			<div class="Clear"></div>
            			</a>
            		</div>
            	<?php } ?>
            </div>
        	<div class="ListBot BorderRadiusBot"></div>
        </div>
        <?php } ?>
        <div class="Clear"></div>
        
    	
    </div>

</body>
</html>