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
<a href="newprod.php" style="color:white; text-decoration:none; font-size:16px;"><i class="fa fa-plus" aria-hidden="true"></i>New</a></button>

                  <div style="float:right;">
                    <label>Category: </label>
                    <select class="gy" id="select_category">
                      <option value="0">ALL</option>

                      <?php
                        $conn = $pdo->open();

                        $stmt = $conn->prepare("SELECT * FROM category");
                        $stmt->execute();

                        foreach($stmt as $crow){
                          $selected = ($crow['id'] == $catid) ? 'selected' : ''; 
                          echo "
                            <option value='".$crow['id']."' ".$selected.">".$crow['name']."</option>
                          ";
                        }

                        $pdo->close();
                      ?>
                    </select>
                  </div>

<br><br>

  			<table  class="bor">
                <thead>
                  <th>Name</th>
                  <th>Photo</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Views Today</th>
                  <th>Tools</th>
                </thead>
				<tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $now = date('Y-m-d');
                      $stmt = $conn->prepare("SELECT * FROM products $where");
                      $stmt->execute();
                      foreach($stmt as $row){
                        $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/noimage.jpg';
                        $counter = ($row['date_view'] == $now) ? $row['counter'] : 0;
                        echo "
                          <tr>
                            <td>".$row['name']."</td>
                            <td>
                              <img src='".$image."' height='30px' width='30px'>
                              <span class='pull-right'><a href='#edit_photo' class='photo' data-toggle='modal' data-id='".$row['id']."'>
                              <i class='fa fa-edit'></i></a></span>
                            </td>

                            <td><button class='btn'>
                            <a href='#description' style='text-decoration:none;' data-toggle='modal' data-id='".$row['id']."'>
                            <i class='fa fa-search'></i> View</a></button></td>


                            <td>&#36; ".number_format($row['price'], 2)."</td>
                            <td style='text-align:center;'>".$counter."</td>


                            <td>

                              <button style='border:1px solid #b1b1b1; background-color:green; padding:2px; height:30px; width:50px'>
                              <a style='text-decoration:none; color:white;' href='editprod.php?prodid=".$row['id']."' >Edit</a></button>

                              <button style='border:1px solid #b1b1b1; background-color:Red; padding:2px; height:30px; width:50px'>
                              <a style='text-decoration:none; color:white;' href='deleprod.php?prodid=".$row['id']."'>Delete</a></button>

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