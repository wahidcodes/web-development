
<?php

	$mordby = $_POST['ordby'];
	
	echo "$mordby";
	
	
?>


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

							<button style=' border: none; margin:5px; padding: 5px; margin-bottom: 30px; background-color: white ; 
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
	
