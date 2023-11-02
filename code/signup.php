<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: cart_view.php');
  }

  if(isset($_SESSION['captcha'])){
    $now = time();
    if($now >= $_SESSION['captcha']){
      unset($_SESSION['captcha']);
    }
  }

?>

<head>
  <title>Kwality TV Ulagam</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/half-slider.css" rel="stylesheet">

  <link rel="stylesheet" href="style.css">
</head>

   <meta name="viewport" content="width=device-width, initial-scale=1">

<body class="hold-transition register-page">

	<div style="position: sticky; top: 0; z-index: 1;">
			<div class="blackbox">
				<button class="box1"><a class="aa" href="index.php">HOME</a></button>
				<button class="box1"><a class="aa" href="aa">ABOUT US</a></button>
				<button class="box1"><a class="aa" href="aa">ELECTRONICS</a></button>
				<button class="box1"><a class="aa" href="aa">CONTACTS</a></button>
				<button class="box1"><a class="aa" href="aa">OFFERS</a></button>
			</div>
	</div><br><br>
    

    <div class="login">
      <br><br>
    	<?php
		if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
		}

		if(isset($_SESSION['success'])){
        echo "
          <div class='callout callout-success text-center'>
            <p>".$_SESSION['success']."</p> 
          </div>
        ";
        unset($_SESSION['success']);
		}
		?>

 <div style="margin-left:15%">
    	
		<div class="register-box-body">
    	<p class="login-box-msg">Register a new membership</p>

    	<form action="register.php" method="POST">
			<div class="form-group has-feedback">
				<input type="text" class="form-control" name="firstname" placeholder="Firstname" value="<?php echo (isset($_SESSION['firstname'])) ? $_SESSION['firstname'] : '' ?>" required>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
        
			<div class="form-group has-feedback">
				<input type="text" class="form-control" name="lastname" placeholder="Lastname" value="<?php echo (isset($_SESSION['lastname'])) ? $_SESSION['lastname'] : '' ?>"  required>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
      		<div class="form-group has-feedback">
        		<input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo (isset($_SESSION['email'])) ? $_SESSION['email'] : '' ?>" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" name="password" placeholder="Password" required>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" name="repassword" placeholder="Retype password" required>
				<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
			</div>

			<hr>
      		
    		<div>
          		<button type="submit" class="btn" name="signup"><i class="fa fa-pencil" aria-hidden="true"></i> Sign Up</button>
			</div>
      		
    	</form>
		<br>
		<a href="login.php">I already have a membership</a><br><bR>
		<a href="index.php"><i class="fa fa-home"></i> Home</a>
		<br><br>
	</div>
</div><br><br>
	
<?php include('includes/scripts.php');?>
<?php include 'kty_footer.html' ?>
	
</body>
</html>