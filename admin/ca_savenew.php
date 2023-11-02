<?php

include 'includes/session.php';

?>

<?php

$conn = $pdo->open();

$mcatid=$_POST["cat_id"]; 
$mname=$_POST["name"];
$mgrp=$_POST["grp"];
$mphoto=basename($_FILES["photo"]["name"]);


$target_dir = "../images/";
$target_file = $target_dir . basename($_FILES["photo"]["name"]);
$uploadOk = 1;
$imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
	$check = getimagesize($_FILES["photo"]["tmp_name"]);
	if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadok = 1;
	} else {
		echo "File is not an image - " . $check["mime"] . ".";
		$uploadok = 0;
	}
}

if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
	echo "The File " . basename($_FILES["photo"]["name"]). "has been uploaded.";
} else {
	echo "Sorry, there was an error uploading your file .";
}



$sql = "INSERT INTO CATEGORY (id, name, cat_slug, cat_image, cat_pos)
values ($mcatid,'$mname','$mgrp', '$mphoto', $mcatid)";

if ($conn->query($sql) === TRUE) {
	echo "New record created sucessfully";
}else {
	echo "Error : " . $sql . "<br>" . $conn->error;
}
	header('location: newcate.php');

?>