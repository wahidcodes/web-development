<?php

include 'includes/session.php';

?>
<?php 
  include 'header.php';
?>

<?php
    $conn = $pdo->open();
	$mslug = $_GET['prodid'];

	try{
		$stmt = $conn->prepare("SELECT * FROM products WHERE id = :mslug");
		$stmt->execute(['mslug' => $mslug]);
		$cat = $stmt->fetch();

		$mgrpid = $cat['id'];
		$mgrp = $cat['slug'];
		$mname = $cat['name'];
		$mdesc = $cat['description'];
		$mbrand = $cat['itm_brand'];
		$mmodel = $cat['itm_model'];
		$msize = $cat['itm_size'];
		$mprice=$cat['price'];
		$mmrp = $cat['MRP'];
		$mphoto = $cat['photo'];

	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}
	$pdo->close();
?>

<!DOCTYPE html>
<html lang="en">
	<body>
		<link rel="stylesheet" href="includes/in.css">
		<title>Entry</title>

		<div class="white"><br>

			<form name="form1" method="post" action="pr_saveedit.php">

				<center><table class="bor">

				<tr>
					<th>Group ID</th>
					<td><input type="text" value =<?php echo $mgrpid;?>

						READONLY name="id">
					</td>
				</tr>

				<tr>
					<th>Category:</th>

					<td><select name="mcid" name="mgrp" value= "<?php echo $mgrp;?>">

					<?php 
						$conn = $pdo->open();
						$sql = "select id,name,cat_slug from category";
						$result = $conn->prepare($sql);
						$result->execute();
						while($row=$result->fetch(PDO::FETCH_ASSOC))
						{
							
							if ($row['cat_slug'] == $mgrp) {
								echo '<option selected="selected" value="'.$row['id'].'">'.$row['name'].'</option>';
							
							} else {

								echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
							}
						}
						$pdo->close();
					?>	
					</select></td>
				</tr>

				<tr>
					<th>Name</th>
					<td><input type="text" name="name" value= "<?php echo $mname;?>" height=100 size=50 required="required" autofocus   ></td>
				</tr>

				<tr>
					<th>Description</th>
					<td><textarea name="desc" rows="5" cols="50"><?php echo $mdesc;?></textarea></td>
				</tr>

				<tr>
					<th>Brand</th>
					<td><input type="text" name="brand" value= "<?php echo $mbrand;?>" height=100 size=50 required="required" autofocus   ></td>
				</tr>

				<tr>
					<th>Model</th>
					<td><input type="text" name="model" value= "<?php echo $mmodel;?>" height=100 size=50 required="required" autofocus   ></td>
				</tr>

				<tr>
					<th>Size</th>
					<td><input type="text" name="size" value= "<?php echo $msize;?>" height=100 size=50 required="required" autofocus   ></td>
				</tr>

				<tr>
					<th>Price</th>
					<td><input type="text" name="price" value=<?php echo $mprice;?> required="required" autofocus></td>    
				</tr>
        
				<tr>
					<th>MRP</th>
					<td><input type="text" name="mrp" value =<?php echo $mmrp;?> required="required" autofocus></td>    
				</tr>

				<tr>	
					<th>Photo</th>
					<td><input type="file" name="photo" placeholder = "<?php echo $mphoto;?>" ></td>    
				</tr>

				<tr>
					<td><input type="Submit" value="Submit"></input></td>    
				</tr>
                
				</center>
				</table>

			</form>

			<br><BR><BR><BR>

		</div>

	</body>
</html>
