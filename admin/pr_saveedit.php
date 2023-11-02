<?php
	include 'includes/session.php';


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

		$mbrand = $_POST['brand'];
		$mmodel = $_POST['model'];
		$msize = $_POST['size'];

    $mprice=$_POST["price"];
    $mmrp=$_POST["mrp"];
    $mphoto=$_POST["photo"];

    $conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE products SET name=:name, slug=:slug, 
			category_id=:category, price=:price, description=:description, mrp=:mrp, photo=:photo,
			itm_brand=:itm_brand, itm_model=:itm_model, itm_size=:itm_size 
			WHERE id=:id");
			
			$stmt->execute(['name'=>$mname, 'slug'=>$mgrp, 
			'category'=>$mcatid, 'price'=>$mprice, 'description'=>$mdesc, 'mrp'=>$mmrp, 'photo'=>$mphoto, 
			'itm_brand'=>$mbrand, 'itm_model'=>$mmodel, 'itm_size'=>$msize,
			'id'=>$mid]);
			
			$_SESSION['success'] = 'Product updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();

	header('location: products.php');

?>
