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

//		echo $mslug55;
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

?>

<?php
$mfinditem = '';
			if(isset($_POST["keyword"]))
			{

				$mfinditem = $_POST["keyword"];
			}
//		echo $mfinditem;

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
				<div style="height: 250px; overflow-y: auto; overflow-x: hidden;">
					<form method="post" id="test">

					<?php

						$query = "SELECT price_range FROM price_master ";
					
						// echo $query;
					
						$statement = $DB->prepare($query);
						$statement->execute();
						$result = $statement->fetchAll();
						foreach($result as $row)
						{
					?>

						<div class="list-group-item radio">
							<div  style="margin-left:20px;">

						<label><input type="radio" name="size" value="<?php echo $row['price_range']; ?>"/><?php echo $row['price_range']; ?></label>


							</div>
						</div>

                    <?php
						}
                    ?>

						<input type="hidden" name="sz_tot" value="" />
							<br>
							<input type="text" name="minprice" id="minprice" size="6" value="" />
							<input type="text" name="maxprice" id="maxprice" size="6" value="" />
							<input type="submit" value="->" onclick="closeNav()">

					</form>
					
				</div>
			</div>
	</div>

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
		
		//	alert(form.elements['sz_tot'].value);

		//    updatePizzaTotal(form);

        var action = 'fetch_data';

			var minimum_price = $("#minprice").val();
			var maximum_price = $("#maxprice").val();

        var itm_brand = get_filter('itm_brand');
        var itm_price = get_filter2('itm_price');
        var ram = get_filter('ram');
        var storage = get_filter('storage');
		var slug2 = <?php echo '"'.$mslug55.'"'?>; // "fan";
		var mordby = get_order();  // "price";
		var mfinditem2 = <?php echo '"'.$mfinditem.'"'?>; // "fan";

//		var minimum_price = get_price2();

//		alert($("#minprice").val());

//		alert(mfinditem2);
		
		alert($mslug55);
		
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, itm_brand:itm_brand, ram:ram, slug:slug2, itm_price:itm_price, ordby:mordby, keyword:mfinditem2},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

	function get_price2(){
	}

	function get_order(){
		
		var ordby = document.getElementById("ordby").value;		
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
	
	var pos = this.value.indexOf("-");
	var myval = this.value.substring(0,pos);
	var myval2 = this.value.substring(pos+1,pos+8);
//	alert(pos);
	
//    alert(this.value);	// 0-500

    this.form.elements['minprice'].value = Number(myval);		// sz_tot ;
    this.form.elements['maxprice'].value = Number(myval2); // myval.substring(2,2);  // this.value;		// sz_tot ;

//	form1.elements['minimum_price'].value = this.value;

// $("#minprice").val = this.value;

//    updatePizzaTotal(this.form);
}

function updatePizzaTotal(form) {
    var sz_tot = form.elements['sz_tot'].value ;   // parseFloat( form.elements['sz_tot'].value );
//	alert(sz_tot);
	
    form.elements['total'].value = sz_tot ;
}

		$("#test").submit(function(event){
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
