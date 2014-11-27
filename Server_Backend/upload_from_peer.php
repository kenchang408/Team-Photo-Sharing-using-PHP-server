<?php
/*
* The purpose of this file is to download files and receive file information sent solely
* from a peer server via POST then store the file information including the file path into
* a mySQL database.   
*/

putenv ("MY_NAME=ken")
require file_server_lib.php;
require mysql_lib.php;

//Variables to hold parameters passed via POST
$md5_id = "";
$title = "";
$category = "";
$description = "";

//Log.txt for debugging
$log = fopen("log.txt","a");

fwrite($log,date("h:i:sa")." get request\n");
fwrite($log,date("h:i:sa")." FILE: ".$_FILES['file']['name']."\n");
fwrite($log,date("h:i:sa")." FILE: ".$_FILES['file']['type']."\n");
fwrite($log,date("h:i:sa")." POST filename: ".$_POST['from']."\n");
fwrite($log,date("h:i:sa")." POST filename: ".$_POST['md5_id']."\n");
fwrite($log,date("h:i:sa")." POST filename: ".$_POST['title']."\n");
fwrite($log,date("h:i:sa")." POST category: ".$_POST['category']."\n");
fwrite($log,date("h:i:sa")." POST description: ".$_POST['desc']."\n");
fclose($log);

//Store the neccessary variables to receive files and their information
$uploadDir = "uploads/";
$file_path = $uploadDir.basename($_FILES["file"]["name"]);
$md5_id = $_POST['md5_id'];
$title = $_POST['title'];
$category = $_POST['category'];
$desc = $_POST['desc'];

//Setup for receiving files sent from client via POST 
$success = 1;
$errMsg = "";

if ($success) {
	if(move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
		
		echo "File uploaded successfully";
	} else {
		$success = 0;
		$errMsg = "File save error.";
	}

}else{
	echo $errMsg;
    }
    
?>

