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


		<button style="display:inline" class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>

<form  style="display:inline-block" method="POST" class="navbar-form navbar-center" action="searchcat.php">


	<div style="display:inline"class="mySlides">
		<button type="submit" name="keyword" value="A" >A</button>
		<button type="submit" name="keyword" value="B" >B</button>
		<button type="submit" name="keyword" value="C" >C</button>
		<button type="submit" name="keyword" value="D" >D</button>
		<button type="submit" name="keyword" value="E" >E</button>
		<button type="submit" name="keyword" value="F" >F</button>
		<button type="submit" name="keyword" value="G" >G</button>
		<button type="submit" name="keyword" value="H" >H</button>
		<button type="submit" name="keyword" value="I" >I</button>
	    <button type="submit" name="keyword" value="J" >J</button>
		
	</div>


	<div style="display:inline"class="mySlides">
		
		<button type="submit" name="keyword" value="I" >I</button>
		<button type="submit" name="keyword" value="J" >J</button>
		<button type="submit" name="keyword" value="K" >K</button>
		<button type="submit" name="keyword" value="L" >L</button>
		<button type="submit" name="keyword" value="M" >M</button>
		<button type="submit" name="keyword" value="N" >N</button>
		<button type="submit" name="keyword" value="O" >O</button>
		<button type="submit" name="keyword" value="P" >P</button>
		<button type="submit" name="keyword" value="Q" >Q</button>
		<button type="submit" name="keyword" value="R" >R</button>
		
	</div>
	
	
	<div style="display:inline"class="mySlides">
		
		<button type="submit" name="keyword" value="Q" >Q</button>
		<button type="submit" name="keyword" value="R" >R</button>
		<button type="submit" name="keyword" value="S" >S</button>
		<button type="submit" name="keyword" value="T" >T</button>
		<button type="submit" name="keyword" value="U" >U</button>
		<button type="submit" name="keyword" value="V" >V</button>
		<button type="submit" name="keyword" value="W" >W</button>
		<button type="submit" name="keyword" value="X" >X</button>
		<button type="submit" name="keyword" value="Y" >Y</button>
		<button type="submit" name="keyword" value="Z" >Z</button>
		
	</div>

	
	
</form>

		<button style="display:inline"class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>

	
<br><br>

		<?php
 
			try {
		       	$inc = 3;	
 
				$stmt = $DB->prepare("SELECT * FROM category WHERE name LIKE :finditem ");
				$stmt->execute(['finditem' => $finditem.'%' ]);
 
                $stmt->execute();
                $results = $stmt->fetchall();

				foreach ($results as $row) {
	                $gnam = $row['name'];
					$image = (!empty($row['cat_image'])) ? 'images/'.$row['cat_image'] : 'images/noimage.jpg';
					$inc = ($inc == 3) ? 1 : $inc + 1;
	       			
					echo " 
                        <div class='sid'>
	       				<button class='but'>			
	       								
						<button class='wa-box-1'>
						<span style='font-size:15px; color:black;'>
						<a class='font'  href='category.php?category=".$row['cat_slug']."'>
						<img src='".$image."' width='100%' height='100%'><br>

		       			<h6><span style='font-size:15px; color:black;'><a href='category.php?category=".$row['cat_slug']."'>".$row['name']."</a></span></h6>
						
						</span>
						</a>		
						</button>

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
		<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  
  x[slideIndex-1].style.display = "inline";  
}
</script>

</body>
</html>