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
$finditem = '';
			if(isset($_POST["keyword"]))
			{

				$finditem = $_POST["keyword"];
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
		</div>

		<form  method="POST" class="navbar-form navbar-center" action="search.php">
          <div  class="input-group"> 
              <input type="text" class="form-control" id="navbar-search-input" name="keyword" placeholder="Looking for.....?" required>
              <span class="input-group-btn" id="searchBtn" style="display:none;">
                  <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search"></i> </button>
              </span>
          </div>
        </form>


		<?php


			try {
				$inc = 4;	
						    $stmt = $DB->prepare("SELECT * FROM products WHERE name LIKE :finditem");
						    $stmt->execute(['finditem' => '%'.$finditem.'%' ]);

				$results = $stmt->fetchall();

				foreach ($results as $row) {
					$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
					$inc = ($inc == 2) ? 1 : $inc + 1;
	       			if($inc == 1) echo "<div class='row'>";
	       			echo "

                        <div class='sid2'> 

							<button class='but2' style='width:150px; border:1px solid grey; height:180px; margin-left:3%; margin-top:30%;'>

								<span style='font-size:15px; color:black;'>
									<a class='font'  href='category.php?category=".$row['cat_slug']."'>
									
									<div style='position:relative; text-align:center; color:black; font-size:13px;'>
										<div style='background-color:red; padding:4px; float:right; width:40px; height:20px;'>
										<div style='position:absolute; top:10px; right:-5px;'>
										<span style='color:white; margin-right:10px;'>".number_format((($row['price']-$row['MRP'])/$row['MRP']*100), 0)."%</span>
										</div></div>
										<img src='".$image."' width='100%' height='100%'><br>	
									</div>
                                    
									<!--Product Name-->
									<div style='height:40px;margin-top:20px;'>
										<h6><span style='font-size:10px; color:black; '><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></span></h6>
									</div>
									
									<!--Product Prize-->
									<div style='height:150px; margin-top:-5px;'>
										<strike><span style='font-size:12px;'><b>₨ ".number_format($row['MRP'], 2)."</b></span></strike></br>
										<span style='color:red; font-size:14px;'><b>₨ ".number_format($row['price'], 2)."</b></span></br>
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