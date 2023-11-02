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
		$stmt = $conn->prepare("SELECT * FROM category WHERE id = :mslug");
		$stmt->execute(['mslug' => $mslug]);
		$cat = $stmt->fetch();

		$mgrpid = $cat['id'];
		$mgrp = $cat['cat_slug'];
		$mname = $cat['name'];
		$mphoto = $cat['cat_image'];

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
    <title>Edit Category</title>

	<div class="white"><br>

    	<form name="form1" method="post" action="ca_saveedit.php">
            <center><table class="bor">
            <tr>
                <th>Cat ID</th>
                <td><input type="text" value =<?php echo $mgrpid;?>

				    READONLY name="id">
    			</td>
            </tr>

            <tr>
                <th>Name</th>
                <td><input type="text" name="name" value=<?php echo $mname;?> required="required" autofocus></td>    
            </tr>
        
	    	<tr>
                <th>Group</th>
                <td><input type="text" name="grp" value= <?php echo $mgrp;?>    ></td>
            </tr>

            <tr>
                <th>Photo</th>
                <td><input type="file" name="photo" placeholder =<?php echo $mphoto;?>></td>    
            </tr>

            <tr>
                <th><input type="Reset" value="Reset"></input></th>
                <td><input type="Submit" value="Submit"></input></td>    
            </tr>
        
        </form>
        
        
    </table>
    <br><BR><BR><BR>

</div>
</center>

</body>
</html>
