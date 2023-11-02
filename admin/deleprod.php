
<?php 
  include 'header.php';
?>
<?php

include 'includes/session.php';

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
<head>
<link rel="stylesheet" href="includes/in.css">
    <title>Entry</title>
<center>
	<div class="white"><br>

    	<form name="form1" method="post" action="pr_savedele.php">
            <table>
            <tr>
                <th>Group ID</th>
                <td><input type="text" value =<?php echo $mgrpid;?>

				    READONLY name="id">
    			</td>
            </tr>

            <tr>
                <th>Category:</th>

    		    <td><select name="mcid" name="mgrp">
		
	        	<?php 
                    $conn = $pdo->open();
                    $sql = "select id,name from category";
        			$result = $conn->prepare($sql);
	        		$result->execute();
		        	while($row=$result->fetch(PDO::FETCH_ASSOC))
				
        	    	{
						echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                     }
                    $pdo->close();
                ?>
    	    	</select></td>
            </tr>

            <tr>
                <th>Category</th>
                <td><input type="text" name="catnam" value=<?php echo $mgrp;?> READONLY></td>    
            </tr>

            <tr>
                <th>Name</th>
                <td><input type="text" name="name" value=<?php echo $mname;?> READONLY></td>    
            </tr>
        
	    	<tr>
                <th>Description</th>
                <td><input type="text" name="desc" value= <?php echo $mdesc;?> READONLY   ></td>
            </tr>

	    	<tr>
                <th>Price</th>
                <td><input type="text" name="price" value=<?php echo $mprice;?> READONLY ></td>    
            </tr>
        
            <tr>
                <th>MRP</th>
                <td><input type="text" name="mrp" value =<?php echo $mmrp;?> READONLY ></td>    
            </tr>

            <tr>
                <td><input type="Submit" value="Delete"></input></td>    
            </tr>
        
        </form>
        
        
    </table>
    <br><BR><BR><BR>

</div>
</center>

</body>
</html>
