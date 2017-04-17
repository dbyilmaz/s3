<?php 
use Aws\S3\S3Client;
require 'vendor/autoload.php';
$config=require('config.php');

//s3
$s3=S3Client::factory([
	'key'=>$config['s3']['key'],
	'secret'=>$config['s3']['secret'],
	'signature'=>$config['s3']['signature'],
	'region'=>'ap-south-1'
	]);


?>