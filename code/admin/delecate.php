<?php

include 'includes/session.php';

?>

<?php
    $conn = $pdo->open();
	$mslug = $_GET['prodid'];

	try{
		$stmt = $conn->prepare("SELECT * FROM category WHERE id = :mslug");
		$stmt->execute(['mslug' => $mslug]);
		$cat = $stmt->fetch();

		$mgrpid = $cat['id'];
		$mname = $cat['name'];
		$mdesc = $cat['cat_slug'];

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

	<div class="white"><br>

    	<form name="form1" method="post" action="ca_savedele.php">
            <center><table>
            <tr>
                <th>Group ID</th>
                <td><input type="text" value =<?php echo $mgrpid;?>

				    READONLY name="id">
    			</td>
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
                <td><input type="Submit" value="Delete"></input></td>    
            </tr>
        
        </form>
        
        
    </table>
    <br><BR><BR><BR>

</div>
</center>

</body>

</html>
