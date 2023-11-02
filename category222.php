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

<script>
function myfun(ordby){
	var x = document.getElementById("ordby").value;
	document.getElementById("demo").innerHTML =  x;
	
    var selectedText = ordby.options[ordby.selectedIndex].innerHTML;
	var selectedValue = ordby.value;
	var mordby = ordby.value;

	<?$mordby?> = ordby.value;
	
	alert("Selected Text: " + selectedText + " Value: " + selectedValue);

	}
</script>

<body>
	<div>
		<form name="form1" method="post">
		
			<label for="ordby">Order by	</label>

			<select name="ordby" id="ordby" onchange="myfun(this)" style="border:1px solid grey; border-radius:5px; height:40px; width:125px;">
				<Option value="MRP-price desc"<?php if($mordby == "MRP-price desc"){echo("selected");}?>>Discount</option>
				<Option value="price desc"<?php if($mordby == "price desc"){echo("selected");}?>>Price High-Low</option>
				<Option value="price"<?php if($mordby == "price"){echo("selected");}?>>Price Low-High</option>
				<Option value="name"<?php if($mordby == "name"){echo("selected");}?>>Name A-Z</option>
				<Option value="name desc"<?php if($mordby == "name desc"){echo("selected");}?>>Name Z-A</option>
			</select>
						
			<p id ="demo"></p>


<?php
		$mordby = $_GET['selectedValue'];
		
	?>
	
	
	
	
			
			<?php
				
			echo "$mordby";
			echo 'id';

			?>
		</form>
			
	</div>

	<?php

			try {
				$inc = 4;	
				$stmt = $DB->prepare("SELECT * FROM products WHERE category_id = :catid order by $mordby");
				$stmt->execute(['catid' => $catid]);
				$results = $stmt->fetchall();

				foreach ($results as $row) {
					$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
					$inc = ($inc == 2) ? 1 : $inc + 1;
	       			if($inc == 1) echo "<div class='row'>";
	       			echo "

                        <div class='sid2' > 

							<button style=' border: none; margin:5px; padding: 5px; margin-bottom: 30px; background-color: ; 
                                            width:200px;border:none; width:150px; height:180px; margin-left:3%;'>

								<span style='font-size:15px; color:black;'>
									<a class='font'  href='category.php?category=".$row['cat_slug']."'>
									
									<div style='position:relative; text-align:center; color:black; font-size:13px;'>
										<div style='background-color:red; padding:4px; float:right; width:40px; height:20px;'>
										<div style='position:absolute; top:10px; right:-5px;'>
										<span style='color:white; margin-right:10px;'>".number_format((($row['price']-$row['MRP'])/$row['MRP']*100), 0)."%</span>
										</div></div>
										<img src='".$image."' width='120px' height='100px'>
									</div>
                                    <hr>
                                    
									<!--Product Name-->
									<div style='height:45px;margin-top:-35px;'>
										<h6><span style='font-size:10px; color:black; '><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></span></h6>
									</div>
									
									<!--Product Prize-->
									<div style='height:50px; margin-top:10px; text-align:center; background-color: ;'>
										<strike><span style='font-size:12px;'><b>₨.".number_format($row['MRP'], 2)."</b></span></strike><br>
										<span style='color:red; font-size:14px;'><b>₨.".number_format($row['price'], 2)."</b></span><br>
									</div>												

									</a>		
								</span>

							</button>			
                        </div>
					";
	       			if($inc == 3) echo "</div>";
				}
				
				if($inc == 3) echo "<div></div><div></div></div>";
				if($inc == 1) echo "<div></div></div>";
                        
            } catch (Exception $ex) {
                echo errorMessage($ex->getMessage());
            }

	?>
 
</body>


</html>