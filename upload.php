<?php
/*<script src="https://use.fontawesome.com/6892e344e3.js"></script>*/
use Aws\S3\Exception\S3Exception;
require 'app/start.php';
if (isset($_FILES['file'])) {
	$file=$_FILES['file'];

	$name=$file['name'];
	$temp_name=$file['tmp_name'];

	$extension=explode('.', $name);
	$extension=strtolower(end($extension));
	#var_dump($extension);

	$key=sha1(uniqid());
	$tmp_file_name="{$key}.{$extension}";
	$tmp_file_path="files/{$tmp_file_name}";
	#var_dump($tmp_file_name);

	move_uploaded_file($temp_name,$tmp_file_path);

	try {
		$s3->putObject([
			'Bucket'=>$config['s3']['bucket'],
			'Key'=>"uploads/{$name}",
       		'Body'   => fopen($tmp_file_path, 'rb'),
        	'ACL'    => 'public-read'
			]);

		unlink($tmp_file_path);

	} catch (S3Exception $e) {
		echo $e;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="file">
	<input type="submit" value="Upload">
</form>
</body>
</html>
