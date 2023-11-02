<?php 
  include 'includes/session.php';
  include 'header.php';
  ?>

    <div style="width:30%; height:100px; padding:10px; background-color:rgb(40, 40, 116); color:white;">
    <?php

        $conn = $pdo->open();

        try{
            $stmt = $conn->prepare("SELECT count(*) as nos FROM products ");
            $stmt->execute();
            $cat = $stmt->fetch();
            $mgrp = $cat['nos'];
		    echo "No.of Products   : ".$mgrp;
        }
        catch(PDOException $e){
            echo "There is some problem in connection: " . $e->getMessage();
        }
    
        $pdo->close();
    ?>
    </div>
<br>
    <div style="width:30%; height:100px; padding:10px; background-color:rgb(88, 165, 120); color:white;">
    <?php

        $conn = $pdo->open();

        try{
            $stmt = $conn->prepare("SELECT count(*) as nos FROM category ");
            $stmt->execute();
            $cat = $stmt->fetch();
            $mgrp = $cat['nos'];
		    echo "No.of Categories : ".$mgrp;
        }
        catch(PDOException $e){
            echo "There is some problem in connection: " . $e->getMessage();
        }
    
        $pdo->close();
    ?>
    </div>
<br>
    <div style="width:30%; height:100px; padding:10px; background-color:rgb(148, 102, 32); color:white;">
    <?php

        $conn = $pdo->open();

        try{
            $stmt = $conn->prepare("SELECT count(*) as nos FROM users ");
            $stmt->execute();
            $cat = $stmt->fetch();
            $mgrp = $cat['nos'];
		    echo "No.of Users      : ".$mgrp;
        }
        catch(PDOException $e){
            echo "There is some problem in connection: " . $e->getMessage();
        }
    
        $pdo->close();
    ?>

    </div>
</body>
</html>