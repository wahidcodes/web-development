<?php

include 'includes/session.php';

?>

<?php
    $conn = $pdo->open();

	$mslug = $_POST['mcid'];

	try{
		$stmt = $conn->prepare("SELECT * FROM category WHERE id = :mslug");
		$stmt->execute(['mslug' => $mslug]);
		$cat = $stmt->fetch();
		$mgrp = $cat['cat_slug'];
//		echo $catid;
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}
	$pdo->close();

$mid=$_POST["id"]; 
$mcatid=$_POST["mcid"]; 
$mname=$_POST["name"];
$mdesc=$_POST["desc"];
// $mgrp=$_POST["mgrp"];
// $mgrp=$_POST["grp"];
$mprice=$_POST["price"];
$mmrp=$_POST["mrp"];
$filename = $_FILES['photo']['name'];
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

$sql = "INSERT INTO products (id, category_id, name, description, slug, price, MRP, photo)
values ($mid,$mcatid,'$mname','$mdesc','$mgrp',$mprice,$mmrp, '$mphoto')";

$conn = $pdo->open();

if ($conn->query($sql) === TRUE) {
	echo "New record created sucessfully";
}else {
	echo "Error : " . $sql . "<br>" . $conn->error;
}
	header('location: newprod.php');

$pdo->close();

?>