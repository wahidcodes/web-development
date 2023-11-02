<?php

require("libs/config.php");
require("includes/header.php");

?>

<head>

    <title>Kwality TV Ulagam</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/half-slider.css" rel="stylesheet">

</head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

<?php
	$mslug = $_GET['category'];

	try{
		$stmt = $DB->prepare("SELECT * FROM products WHERE slug = :mslug");
		$stmt->execute(['mslug' => $mslug]);
		$cat = $stmt->fetch();
		$catid = $cat['category_id'];
//		echo $catid;
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

?>

<?php
$mordby = 'name';
			if(isset($_POST["ordby"]))
			{

				$mordby = $_POST["ordby"];
			}

?>

<!DOCTYPE html>
<html lang="en">


<div style="position: sticky; top: 0; z-index: 1;">
			<div class="blackbox" >
				<button class="box1"><a class="aa" href="index.php">HOME</a></button>
				<button class="box1"><a class="aa" href="aa">ABOUT US</a></button>
				<button class="box1"><a class="aa" href="aa">ELECTRONICS</a></button>
				<button class="box1"><a class="aa" href="aa">CONTACTS</a></button>
				<button class="box1"><a class="aa" href="aa">OFFERS</a></button>
			</div>
		</div><br><br>


	<body>
	<div>
		<form name="form1" method="post">

		
		<label for="ordby">Order by	</label>

		<select name="ordby" id="ordby" style="border:1px solid grey; border-radius:5px; height:40px; width:125px;">
			<Option value="price desc"<?php if($mordby == "price desc"){echo("selected");}?>>Price High-Low</option>
			<Option value="price"<?php if($mordby == "price"){echo("selected");}?>>Price Low-High</option>
			<Option value="name"<?php if($mordby == "name"){echo("selected");}?>>Name A-Z</option>
			<Option value="name desc"<?php if($mordby == "name desc"){echo("selected");}?>>Name Z-A</option>
		</select> 

		<label for="filtby">Filter By:</label>
		<select style="border:1px solid grey; border-radius:5px; height:40px; width:150px;">
           <option></option>
		   <option></option>
		   <option></option>
		</select><BR><BR>
		
		<input type="submit" value="Submit" style=" padding:10px; border:2px solid red; background-color:white;">
		
		<br><br>
		</form>
		</div>
	</body>

		<?php


		       			try{
		       			 	$inc = 4;	
						    $stmt = $DB->prepare("SELECT * FROM products WHERE category_id = :catid order by $mordby");
						    $stmt->execute(['catid' => $catid]);
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 2) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
								<div class='sid2' style='display:inline-block;'>
									<button class='but2' style='width:140px; border:1px solid grey; height:200px;>			
										<button style='width:140px; border:1px solid grey; height:200px;>

											<span style='font-size:15px; color:black;'>
												<a class='font'  href='category.php?category=".$row['cat_slug']."'>
												<img src='".$image."' width='100%' height='100%'><br>
												
												<div style='height:60px;'>
													<h6><span style='font-size:10px; color:black;'><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></span></h6>
												</div>
												
												<div style='height:60px;'>
													<strike><span style='font-size:12px;'><b>₨ ".number_format($row['MRP'], 2)."</b></span></strike><br>
													<span style='color:red; font-size:14px;'><b>₨ ".number_format($row['price'], 2)."</b></span></br>
												</div>												
												</a>		
											</span>
										</button>
		
								   </button>			
								   <br><Br><br><BR>
								</div>
								";
	       						if($inc == 4) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-3'></div><div class='col-sm-3'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-3'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}
		?>
		
</body>
</html>