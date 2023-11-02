<?php
	include 'includes/session.php';

    $mid=$_POST["id"];
    $mname=$_POST["name"];
    $mgrp=$_POST["grp"];
    $mphoto=$_POST["photo"];

    $conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE category SET name=:name, cat_slug=:cat_slug, cat_image=:cat_image WHERE id=:id");
			$stmt->execute(['name'=>$mname, 'cat_slug'=>$mgrp, 'cat_image'=>$mphoto, 'id'=>$mid]);
			$_SESSION['success'] = 'Category updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();

	header('location: category.php');

?>
