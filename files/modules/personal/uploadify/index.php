<?php $timestamp = time();?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UploadiFive Test</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="uploadify.css">

<link href="http://hayageek.github.io/jQuery-Upload-File/uploadfile.min.css" rel="stylesheet">
<script src="http://hayageek.github.io/jQuery-Upload-File/jquery.uploadfile.min.js"></script>


<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
</style>
</head>

<body>
	<h1>Uploadify Demo</h1>
	<form>
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
		<?php //echo $_SERVER['DOCUMENT_ROOT'].'/uploads'; ?>
		<br>
		<br>
		<div id="fileuploader">Upload</div>

	</form>

	<script>
		$(document).ready(function()
		{
			$("#fileuploader").uploadFile({
			url:"uploadify.php",
			fileName:"myfile"
			});
		});
	</script>

	<script type="text/javascript">
		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'swf'      : 'uploadify.swf',
				'uploader' : 'uploadify.php'
			});
		});
	</script>
</body>
</html>