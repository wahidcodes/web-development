<?php

include 'includes/session.php';

?>

<?php
        $conn = $pdo->open();
        
    
            $mid = $_POST['id'];
            
            $conn = $pdo->open();
    
            try{
                $stmt = $conn->prepare("DELETE FROM category WHERE id=:id");
                $stmt->execute(['id'=>$mid]);
    
                $_SESSION['success'] = 'Category deleted successfully';
            }
            catch(PDOException $e){
                $_SESSION['error'] = $e->getMessage();
            }
    
            $pdo->close();

	header('location: category.php');

?>

