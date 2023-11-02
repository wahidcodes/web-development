<?php
  include 'includes/session.php';

?>

<?php 
  include 'header.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="includes/in.css">
    <title>Entry</title>

	<div class="white"><br>

        <form name="form1" method="post" action="ca_savenew.php" enctype="multipart/form-data"> 
            <center><table>
            <tr>
                <th>Cat.ID</th>
                <td><input type="text" value = 

	    			<?php  
                        $conn = $pdo->open();

			    		$stmt = $conn->prepare("SELECT max(id)+1 as mid FROM category");
				    	$stmt->execute();
					    $cat = $stmt->fetch();
    					$catid = $cat['mid'];
                        echo $catid;
                    
                        $pdo->close();
			    	?> ;
				    READONLY name="cat_id">
    			</td>
            </tr>

            <tr>
                <th>Category</th>
                <td><input type="text" name="name" required="required" autofocus></td>    
            </tr>
        
	    	<tr>
                <th>Description</th>
                <td><input type="text" name="grp"></td>    
            </tr>

            <tr>
                <th>Photo</th>
                <td><input type="file" name="photo"></td>    
            </tr>

            <tr>
                <td><input type="Submit" value="Submit"></input></td>    
            </tr>
        
        </form>
        
        
    </table>
    <br><BR><BR><BR>

</div>
</center>

</body>
</html>