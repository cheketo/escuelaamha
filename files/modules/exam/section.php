<?php
	include('../../includes/inc.main.php');
	
	$SectionID 	= $_GET['id'];
	$Section 	= new Section($SectionID);
	$Data		= $Section->GetData();
	
	
	if(!$SectionID || !($Section->HavePermission($Admin->ProfileID,$Admin->GetGroups()) || $Admin->ProfileID<10)){header("location:../principal/main.php");die;}

	$Articles 	= /*$Admin->ProfileID>10 && $Data? $DB->fetchAssoc("select","article a INNER JOIN relation_article_profile p ON a.article_id = p.article_id","a.*","a.section_id = ".$SectionID." AND p.profile_id = ".$Admin->ProfileID." AND a.status='A' ","creation_date DESC") :*/ $DB->fetchAssoc("select","article","*","section_id = ".$SectionID." AND status='A' AND (NOW() BETWEEN start_date AND end_date || (start_date=end_date && start_date = '0000-00-00 00:00:00') )","start_date DESC, creation_date DESC");

	$Head->setTitle($Data['title']);
	$Head->setHead();

?>
<body>
	<?php include("../../includes/inc.top.php"); ?>
	<div id="Content" style="padding-top:0px!important; padding-bottom:0px!important;">
		<div class="SectionWrapper">
			<div class="Center Georgia25px DarkGray SectionTitle"><?php echo $Data['title']; ?></div>
			<?php foreach($Articles as $Article){ 

				$AuthorData = $DB->fetchAssoc("select","admin_user","*","admin_id = ".$Article['author_id']);
				$Author 	= $AuthorData[0];

				$StartDate 	= $Article['start_date'] != "0000-00-00 00:00:00"? $Article['start_date'] : $Article['creation_date'];
				$DateTime 	= explode(" ",$StartDate);
				$Date 		= $DateTime[0];
				$Width = 100;
			?>
			
			<div style="width:98%; margin:1%;">
				<div class="SectionArticleWrapper" target="<?php echo $Article['article_id']; ?>">
					<?php if(file_exists("../../../skin/images/articles/".$Article['article_id']."/main.jpeg")){ $Width = 70;?>
					<div class="Left" style="margin-left:1%; width:29%;height:250px;">
						<div class="SectionArticleImg Center" style="background:url(../../../skin/images/articles/<?php echo $Article['article_id']; ?>/main.jpeg) center center no-repeat;"></div>
					</div>
					<?php } ?>
					<div class="Left" style="width:<?php echo $Width; ?>%;">
						<div class="SectionArticleTitle Georgia18px DarkGray"><u><?php echo $Article['title'] ?></u></div>
						<?php if($Article['subtitle'] || $Article['subtitle']!=" "){ ?>
							<div class="SectionArticleSubTitle Georgia12px DarkBlue Bold"><?php echo $Article['subtitle'] ?></div>
						<?php } ?>
					</div>
					<div class="Clear"></div>
					<div class="SectionArticleAuthor Left Center Georgia12px White">Autor: <?php echo $Author['first_name']." ".$Author['last_name'] ?></div>
					<div class="SectionArticleAuthor Right Center Georgia12px White"><?php echo DateTimeFormat($Date); ?></div>
					<div class="Clear"></div>
					
				</div>
			</div>
			<?php } ?>	
				
			
			
		</div>
	</div>
</body>
</html>