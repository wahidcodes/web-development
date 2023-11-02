<?php 
  include 'includes/session.php';
?>
<?php
  $data = 0;
  $where = '';
  if(isset($_GET['category'])){
    $catid = $_GET['category'];
    $where = 'WHERE category_id ='.$catid;
  }
?>

<?php 
  include 'header.php';
?>


<button style="background-color:#285bc9; border:none; width:80px; border-radius:5px; height:40px;">
<a href="newcate.php" style="color:white; text-decoration:none; font-size:16px;">New</a></button><br><br>

  			<table id="example1" class="bor">
                <thead>
                  <th>Name</th>
                  <th>Photo</th>
                  <th>Tools</th>
                </thead>
				<tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $now = date('Y-m-d');
                      $stmt = $conn->prepare("SELECT * FROM category $where");
                      $stmt->execute();
                      foreach($stmt as $row){
                        $image = (!empty($row['cat_image'])) ? '../images/'.$row['cat_image'] : '../images/noimage.jpg';
                        echo "
                          <tr>
                            <td>".$row['name']."</td>
                            <td>
                              <img src='".$image."' height='30px' width='30px'>
                              <span class='pull-right'><a href='#edit_photo' class='photo' data-toggle='modal' data-id='".$row['id']."'><i class='fa fa-edit'></i></a></span>
                            </td>


                            <td>

                              <button style='border:1px solid #b1b1b1; background-color:green; padding:2px; height:30px; width:50px'>
                              <a  style='text-decoration:none; color:white;' href='editcate.php?prodid=".$row['id']."' style='text-decoration:none'>Edit</a></button>
                              
                              <button style='border:1px solid #b1b1b1; background-color:Red; padding:2px; height:30px; width:50px'>
                              <a  style='text-decoration:none; color:white;' href='delecate.php?prodid=".$row['id']."' style='text-decoration:none'>Delete</a></button>

                            </td>
                          </tr>
                        ";
                      }
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
                    }

                    $pdo->close();
                  ?>
				</tbody>

			</table>
</body>
</html>