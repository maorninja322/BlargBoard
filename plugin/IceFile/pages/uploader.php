<?php
if (!defined('BLARG')) die();
MakeCrumbs(array(actionLink("uploader") => __("Uploader")), $links);
$title = __("Uploader");
$links = array();
if($_GET["mode"] == "upload") {
CheckPermission('forum.postreplies');
if(!$loguserid)
{
	Kill(__(Log in to access the uploader. If you do not have one already, please register one <a href="?page=register">here</a>.))
}
else
{
?>
	<table class="outline margin"><tr class="header1">
			<th colspan="2">
				Uploader
			</th>
		</tr>
		<tr class="cell0 center">
		<td colspan="2">
			<form action="#upload" method="post" enctype="multipart/form-data">
			<input accept="file" type="file" multiple="file" name="file" style="width:40%;"></input> <input type="submit" name="submit" value="Upload"/></input><br>
			</form></td></tr>
</table><?php
}
$submit = $_POST['submit']; //Port variable from HTML
$file = $_POST['file']; //Port variable from HTML
if($submit) //If you clicked on upload
{
	date_default_timezone_set('UTC');
	$target_dir = "uploads/"; //Target folder ./root/uploads
	$target_dir = $target_dir . basename( $_FILES["file"]["name"]); //Pack file for target folder
	$uploadOk = 1; //If ok
	$acceptedFormats = array('jpeg','gif','png','jpg','rar','7z','zip','gz','tar','txt','rtf','svg');
	if (file_exists($target_file)) {?>
	<table class="outline margin">
		<tr class="header1">
			<th>
				Error
			</th>
		</tr>
		<tr class="cell0 center">
		<td>
			File already exists. Please upload it with another name. Find unused filenames from us <a href="?page=uploadedpublic">here</a>.
		</td>
		</tr>
		</table>
	<?php}
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		?><table class="outline margin">
		<tr class="header1">
			<th>
				Error
			</th>
		</tr>
		<tr class="cell0 center">
		<td>
			File size too big. Please shrink the content.
		</td>
		</tr>
		</table><?php
	}
	if(!in_array(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION), $acceptedFormats))
	{
		?><table class="outline margin">
		<tr class="header1">
			<th>
				Error
			</th>
		</tr>
		<tr class="cell0 center">
		<td>
			File extension isn't allowed.
		</td>
		</tr>
		</table>
		<?php
	}
	else{
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir)) { //If uploading was successfully
			?>
			<table class="outline margin">
			<tbody><tr class="header1">
				<th>
					Successfully
				</th>
			</tr>
			<tr class="cell0 center">
			<td>
				Your file was successfully uploaded - <?php echo '<a href=\"uploads/". basename( $_FILES["file"]["name"])."\">Please follow this link</a>';?>
			</td>
			</tr>
			</table><?php
		}	
		else //If uploading was NOT successfully
		{
			?>
			<table class="outline margin"><tr class="header1">
				<th>
					Error
				</th>
			</tr>
			<tr class="cell0 center">
			<td>
				Unable to upload file
			</td>
			</tr>
			</table>
			<?php		
		}
	}
}
} else if($_GET["mode"] == "uploaded") {
	if (!defined('BLARG')) die();
	MakeCrumbs(array(actionLink("uploader") => __("Uploader")), $links);
	$title = __("Uploaded");
	$links = array(); echo '
	<table class="outline margin">
		<tbody><tr class="header1">
			<th>
				Uploaded
			</th>
		</tr>
		<tr class="cell0">
		<td align="center"><iframe style="width:100%;height:400px;background:white;" src="uploads/"></iframe>
		</td>
		</tr>
	</tbody></table>';
} else {
	echo '
		<table class="outline margin">
		<tbody><tr class="header1">
			<th>
				Uploader
			</th>
		</tr>
		<tr class="cell0">
		<td align="center"><a href="?page=uploader&mode=upload">Upload Public Files</a>
		</td>
		</tr>
		</tbody></table>
			<table class="outline margin">
				<tbody><tr class="header1">
					<th>
						Uploaded
					</th>
				</tr>
				<tr class="cell0">
				<td align="center"><a href="?page=uploader&mode=uploaded">Show Uploaded Files</a>
				</td>
				</tr>
		</tbody></table>';
}
?>
