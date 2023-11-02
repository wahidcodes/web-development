<?php

//fetch_data.php
require("libs/config.php");

?>

<?php

//	$mordby2 = $_POST['ordby'];
	
//	echo "hai";
//	echo $mordby2;

?>

<?php
//	$mslug = $_GET['slug'];

//	try{
//		$stmt = $DB->prepare("SELECT * FROM products WHERE slug = :mslug");
//		$stmt->execute(['mslug' => $mslug]);
//		$cat = $stmt->fetch();
//		$catid = $cat['category_id'];
		
//		echo $mslug;
//		echo "hai";
//		echo "hai2";

//	}
//	catch(PDOException $e){
//		echo "There is some problem in connection: " . $e->getMessage();
//	}

?>

<?php
// $mordby = 'name';
//			if(isset($_POST["ordby"]))
//			{

//				$mordby = $_POST["ordby"];
//			}

?>

<meta name="viewport" content="width=device-width, initial-scale=1">

<head>

    <title>Kwality TV Ulagam</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/half-slider.css" rel="stylesheet">

<!--	<script src="cat_ord.js" ></script>   -->


</head>

<div style="position: sticky; top: 0; z-index: 1;">
	<div class="blackbox" >
		<button class="box1"><a class="aa" href="index.php">HOME</a></button>
		<button class="box1"><a class="aa" href="aa">ABOUT US</a></button>
		<button class="box1"><a class="aa" href="aa">ELECTRONICS</a></button>
		<button class="box1"><a class="aa" href="aa">CONTACTS</a></button>
		<button class="box1"><a class="aa" href="aa">OFFERS</a></button>
	</div>
</div><br><br>

<?php

if(isset($_POST["action"]))
{

// echo $POST["itm_price"];
// echo $POST["slug"];

// echo 'hai';
// echo $_POST["keyword"];

//echo $POST["minimum_price"];
//echo $POST["maximum_price"];

	$query = "
		SELECT * FROM products WHERE id > 0
	";

// '%'.$finditem.'%'

	if(isset($_POST["keyword"]))
	{
		$query .= "
		 AND name LIKE '%".$_POST["keyword"]."%' 
		";
	}

	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["slug"]) && !empty($_POST["slug"]))
	{
		$item_filter = $_POST["slug"];  //  implode("','", $_POST["slug"]);
		$query .= "
		 AND slug = ('".$item_filter."')
		";
	}
	if(isset($_POST["itm_brand"]))
	{
		$brand_filter = implode("','", $_POST["itm_brand"]);
		$query .= "
		 AND itm_brand IN('".$brand_filter."')
		";
	}

	if(isset($_POST["ordby"]))
	{

		$mordby = $_POST["ordby"];

		$query .= "
			order by $mordby
		";

	}

	$inc = 4;

// echo $mordby;
// echo $query;

	$statement = $DB->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
				foreach ($result as $row) {

					$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';

					$inc = ($inc == 2) ? 1 : $inc + 1;
	       			if($inc == 1) echo "<div class='row'>";
	       			echo "

                        <div class='sid2' > 

							<button style=' border: none; margin:3px; padding: 3px; margin-bottom: 30px; background-color: white ; 
                                            width:150px;border:none; width:130px; height:180px; margin-left:3px;'>

								<span style='font-size:15px; color:black;'>
									<a class='font'  href='category.php?category=".$row['cat_slug']."'>
									
									<div style='position:relative; text-align:center; color:black; font-size:13px;'>
										<div style='background-color:red; padding:4px; float:right; width:40px; height:20px;'>
										<div style='position:absolute; top:10px; right:-5px;'>
										<span style='color:white; margin-right:10px;'>".number_format((($row['price']-$row['MRP'])/$row['MRP']*100), 0)."%</span>
										</div></div>
										<img src='".$image."' width='110px' height='100px'>
									</div>
                                    
									<!--Product Name-->
									<div style='height:45px;margin-top:0px;'>
										<h6><span style='font-size:10px; color:black; '><a href='product.php?product=".$row['id']."'>".$row['name']."</a></span></h6>
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
	}
	else
	{
		$output = '<h3>No Data Found</h3>';
	}
	echo $output;
}

?>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
