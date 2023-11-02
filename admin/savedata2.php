<?php

require("libs/config.php");

?>

<?php

$mcatid=$_POST["cat_id"]; 
$mname=$_POST["name"];
$mgrp=$_POST["grp"];
$mphoto=$_POST["photo"];

$sql = "INSERT INTO CATEGORY (id, name, cat_slug, cat_image, cat_pos)
values ($mcatid,'$mname','$mgrp', '$mphoto', $mcatid)";

if ($DB->query($sql) === TRUE) {
	echo "New record created sucessfully";
}else {
	echo "Error : " . $sql . "<br>" . $DB->error;
}
	header('location: entry2.php');

?>