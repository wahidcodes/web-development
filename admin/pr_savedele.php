<?php
	include 'includes/session.php';


        $conn = $pdo->open();
        
    
            $mid = $_POST['id'];
            
            $conn = $pdo->open();
    
            try{
                $stmt = $conn->prepare("DELETE FROM products WHERE id=:id");
                $stmt->execute(['id'=>$mid]);
    
                $_SESSION['success'] = 'Product deleted successfully';
            }
            catch(PDOException $e){
                $_SESSION['error'] = $e->getMessage();
            }
    
            $pdo->close();

	header('location: products.php');

?>
