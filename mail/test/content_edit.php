<?php 
	session_start();
	$objConnect = mysql_connect("128.199.133.68","roparty","w,ji^hlbot8iy=");
    mysql_select_db('aegis_apps');
    mysql_query("SET NAMES UTF8");
	

	if(isset($_POST['update'])){
		$sql = "UPDATE apps_content SET content_text = '".$_POST['content']."', content_name = '".$_POST['name']."', content_link='".$_POST['link']."' WHERE content_id = '".$_SESSION['content_id']."'";
		mysql_query($sql);
		header('location:content_edit.php?page='.$_POST['link']);
	}else if(isset($_POST['save_page'])){
	
	}
	if(isset($_GET['page'])){
		$sql = "SELECT * FROM apps_content WHERE content_link ='".$_GET['page']."'";
		$rs = mysql_query($sql);
		$rows = mysql_fetch_array($rs);
		$_SESSION['content_id'] = $rows['content_id'];
	}

?>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>
<body>
Preview!! <br>
<?php echo $rows['content_text']; ?>
<form action="" method="post">
Page <input type="text" size="50" name="name" value="<?php echo $rows['content_name']; ?>"/>
Path <input type="text" size="50" name="link" value="<?php echo $rows['content_link']; ?>"/>
</br>
</br>
<textarea id="editor1" name="content" style="width:100%"><?php if(isset($_POST['content'])){ echo $_POST['content']; }else { echo $rows['content_text'];} ?></textarea>
<input type="submit" name="update" value="update"/><!--input type="submit" name="save_page" value="save"/-->
</form>
<script type="text/javascript">
	CKEDITOR.replace( 'editor1' ,{
	    filebrowserBrowseUrl: '/browser/browse.php',
		filebrowserImageBrowseUrl: '/browser/browse.php?type=Images',
		filebrowserUploadUrl: '/uploader/upload.php',
		filebrowserImageUploadUrl: '/uploader/upload.php?type=Images'
	});
</script>
<div class="preview" style="border: 1px solid #ccc;">
<?php echo $body; ?>
</div>
</body>
</html>