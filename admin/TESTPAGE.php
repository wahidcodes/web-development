
if(!empty($filename)){
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	$new_filename = $slug.'.'.$ext;
	move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
} else {
	$new_filename = '';
}

<form name="form1" method="post" action="savedata.php" enctype="multipart/form-data"> 
