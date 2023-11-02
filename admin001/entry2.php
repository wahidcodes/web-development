

<?php

require("../libs/config.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Entry</title>
    
<div class="white"><br>

    <form name="form1" method="post" action="savedata2.php">
	
        <center><table>
        <tr>
            <th>Category ID</th>
            <td><input type="text" value = 

				<?php  

					$stmt = $DB->prepare("SELECT max(id)+1 as mid FROM category");
					$stmt->execute();
					$cat = $stmt->fetch();
					$catid = $cat['mid'];
					echo $catid;
				?> ;
				READONLY name="cat_id">
			</td>
        </tr>
        <tr>
            <th>Name</th>
            <td><input type="text" name="name" required="required" autofocus></td>    
        </tr>
        <tr>
            <th>Group</th>
            <td><input type="text" name="grp" required="required" autofocus></td>    
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

