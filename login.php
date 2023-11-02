<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<?php
  if(isset($_SESSION['user'])){
    header('location: index.php');
  }
?>
<head>


    <title>Kwality TV Ulagam</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/half-slider.css" rel="stylesheet">

	<link rel="stylesheet" href="style.css">

</head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

<body>

		<div style="position: sticky; top: 0; z-index: 1;">
			<div class="blackbox">
				<button class="box1"><a class="aa" href="index.php">HOME</a></button>
				<button class="box1"><a class="aa" href="aa">ABOUT US</a></button>
				<button class="box1"><a class="aa" href="aa">ELECTRONICS</a></button>
				<button class="box1"><a class="aa" href="aa">CONTACTS</a></button>
				<button class="box1"><a class="aa" href="aa">OFFERS</a></button>
			</div>
		</div><br><br>


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

    <div class="login">
      <br><br>
    	<h1>Sign in</h1>

    	<form action="verify.php" method="POST">
        <div >
      		<div>
            <input type="email" class="form-control" name="email" placeholder="Email" required  >
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <br>
          <div >
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      		<div class="row">
            <br>
    			<div >
          			<button type="submit" class="btn"  name="login"><i class="fa fa-sign-in"></i> Sign In</button>
        		</div>
      		</div>
    	</form>
      <br>
      <a href="index.php"><i class="fa fa-home"></i> Home</a>
      <br><br>
  	</div>
</div>
</div>
<br><Br><br>
<?php include 'includes/scripts.php' ?>
<?php include 'kty_footer.html '; ?>
</body>
</html>
