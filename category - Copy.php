<?php

require("libs/config.php");
require("includes/header.php");

?>

<?php
	$mslug55 = $_GET['category'];

	try{
		$stmt = $DB->prepare("SELECT * FROM products WHERE slug = :mslug");
		$stmt->execute(['mslug' => $mslug55]);
		$cat = $stmt->fetch();
		$catid = $cat['category_id'];
//		echo $mslug;
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kwality TV Ulagam</title>

    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<meta name="viewport" content="width=device-width, initial-scale=1">

<div id="mySidenav" class="sidenav">
	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

	<button type="button" class="collapsible">Price</button>
	<div class="content">
			<div class="list-group">
				<div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					<?php

						$query = "SELECT price_range FROM price_master ";
					
						// echo $query;
					
						$statement = $DB->prepare($query);
						$statement->execute();
						$result = $statement->fetchAll();
						foreach($result as $row)
						{
					?>

					<form method="post" id="test">
						<div class="list-group-item radio">
							<div  style="margin-left:20px;">

        <label><input type="radio" name="size" value="aaa" /> Small</label>
        <label><input type="radio" name="size" value="bbb" checked="checked" /> Medium</label>
        <label><input type="radio" name="size" value="ccc" /> Large</label>
						<input type="hidden" name="sz_tot" value="" />


							</div>
						</div>
					</form>
					
                    <?php
						}
                    ?>
				</div>
			</div>

		<div class="container">
			<div class="row">
				<div class="col-md-3">                				
					<div class="list-group">
						<form name="form1" id = "frm1" >  

							<p><label>Total:<input type="text" name="total" class="num" value="" readonly="readonly" /></label></p>

							<input type="text" id="minprice" size="4" value="0">
							<input type="text" id="maxprice" size="4" value="10000">
							<input type="submit" value="->" onclick="closeNav()">
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>

	<button type="button" class="collapsible">Items</button>
	<div class="content">
			<div class="list-group">
				<div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					<?php

						$query = "SELECT DISTINCT(itm_brand) FROM products ";
					
						// echo $query;
					
						$statement = $DB->prepare($query);
						$statement->execute();
						$result = $statement->fetchAll();
						foreach($result as $row)
						{
					?>
					<div class="list-group-item checkbox">
						<label><input type="checkbox" class="common_selector itm_brand" value="<?php echo $row['itm_brand']; ?>"  > <?php echo $row['itm_brand']; ?></label>
					</div>
                    <?php
						}
                    ?>
				</div>
			</div>
	</div>

	<button type="button" class="collapsible">Open Section 3</button>
	<div class="content">
		<p>hiiiiiiii</p>
	</div>

</div>

<div >
	<div style=" margin-right: 20px; float:left; padding-top:5px; padding-left:40px; background-color:MediumSeaGreen ;color:white; border:1px solid grey; border-radius:5px; height:40px; width:125px;">
		<span style="font-size:20px;cursor:pointer;" onclick="openNav()">  Filter</span>
	</div>

	<div>
		<form name="form1" method="post">

		<select name="ordby" onchange="get_order(this);" class="common_selector2" id="ordby" style="margin-right: 15px; float:right; background-color:#ff851b ;color:white; border:1px solid grey; border-radius:5px; height:40px; width:125px;">
			<Option value="MRP-price desc"<?php if($mordby == "MRP-price desc"){echo("selected");}?>>Discount</option>
			<Option value="price desc"<?php if($mordby == "price desc"){echo("selected");}?>>Price High-Low</option>
			<Option value="price"<?php if($mordby == "price"){echo("selected");}?>>Price Low-High</option>
			<Option value="name"<?php if($mordby == "name"){echo("selected");}?>>Name A-Z</option>
			<Option value="name desc"<?php if($mordby == "name desc"){echo("selected");}?>>Name Z-A</option>
		</select> 
		
<!--		<input type="submit" value="Submit"> -->

<!--		<br><br>  -->

		</form>
	</div>

	
</div>

						
		<!--	<p id ="demo"></p>  -->


<?php
		// $mordby = $_GET['selectedValue'];
		
	?>
	
	
	
	
			
			<?php
				
//			echo "$mordby";
//			echo 'id';

			?>
	
	
	
	
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-3">                				

			</div>
		
			<div class="list-group">
			</div>

		</div>

		<div class="col-md-9">
           <br />
            <div class="row filter_data">

            </div>
		</div>
	</div>

<style>

#loading
{
	text-align:center; 
	background: url('loader.gif') no-repeat center; 
	height: 150px;
}
</style>

<script>

$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');


    var form = document.getElementById('test');
    var sz = form.elements['size'];
    
    for (var i=0, len=sz.length; i<len; i++) {
        sz[i].onclick = getSizePrice;
    }

    // set sz_tot to value of selected
    form.elements['sz_tot'].value = getRadioVal(form, 'size');
	alert(form.elements['sz_tot'].value);

//    updatePizzaTotal(form);



		
        var action = 'fetch_data';

			var minimum_price = $("#minprice").val();
			var maximum_price = $("#maxprice").val();

        var itm_brand = get_filter('itm_brand');
        var itm_price = get_filter2('itm_price');
        var ram = get_filter('ram');
        var storage = get_filter('storage');
		var slug2 = <?php echo '"'.$mslug55.'"'?>; // "fan";
		var mordby = get_order()  // "price";
		
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, itm_brand:itm_brand, ram:ram, slug:slug2, itm_price:itm_price, ordby:mordby},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

	function get_order(){
		
		var ordby = document.getElementById("ordby").value;		
//		var order="price desc";
		return ordby;
	}

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });

        return filter;
    }

    function get_filter2(class_name)
    {
        var filter = $(class_name+':checked').val()
        ;

        return filter;
    }



function getRadioVal(form, name) {
    var radios = form.elements[name];
    var val;
    
    for (var i=0, len=radios.length; i<len; i++) {
        if ( radios[i].checked == true ) {
            val = radios[i].value;
            break;
        }
    }
    return val;
}


function getSizePrice(e) {
    this.form.elements['sz_tot'].value = this.value; // parseFloat( this.value );
    updatePizzaTotal(this.form);
}

function updatePizzaTotal(form) {
    var sz_tot = form.elements['sz_tot'].value ;   // parseFloat( form.elements['sz_tot'].value );
    form.elements['total'].value = sz_tot ;
}




		$("#frm1").submit(function(event){
			event.preventDefault();
			$("#minprice").val();
			$("#maxprice").val();
			filter_data();
		});
		

    $('.common_selector').click(function(){
        filter_data();
    });

    $('.common_selector2').change(function(){
        filter_data();
    });

});


</script>

<script>
	function MyFunc5(){
		
//		var ordby = document.getElementById("ordby").value;		
//		var order="price desc";
//		return ordby;

		var aa = document.getElementsByName('a1');
		alert(aa);

		aa.foreach(a1) => {
			if (a1.checked) {
			alert('${a1.value}');
			}
		}
	}	
</script>

</body>

</html>
