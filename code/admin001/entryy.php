<?php

require("header.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Entry</title>

	<div class="white"><br>

	<form name="form1" method="post" action="savedata.php">
        <center><table>
        <tr>
            <th>Group ID</th>
            <td><input type="text" value = 

				<?php  

					$stmt = $DB->prepare("SELECT max(id)+1 as mid FROM products");
					$stmt->execute();
					$cat = $stmt->fetch();
					$catid = $cat['mid'];
					echo $catid;
				?> ;
				READONLY name="id">
			</td>
        </tr>

		<select name="mcid" name="mgrp">
		
		<?php 
			$sql = "select id,name from category";
			$result = $DB->prepare($sql);
			$result->execute();
			while($row=$result->fetch(PDO::FETCH_ASSOC))
				
		{
			echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
		 } ?>
		</select>

        <tr>
            <th>Name</th>
            <td><input type="text" name="name" required="required" autofocus></td>    
        </tr>
        
		<tr>
            <th>Description</th>
            <td><input type="text" name="desc"></td>    
        </tr>

		<tr>
            <th>Price</th>
            <td><input type="text" name="price" required="required" autofocus></td>    
        </tr>
        
        <tr>
            <th>MRP</th>
            <td><input type="text" name="mrp" required="required" autofocus></td>    
        </tr>

        <tr>
            <th>Photo</th>
            <td><input type="file" name="photo"></td>    
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