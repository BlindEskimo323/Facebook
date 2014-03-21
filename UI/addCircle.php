<?php
if(isset($_POST["addCircle_Button"])){
	session_start();
	$sql = new mysqli("localhost", "root", "password", "Facebook");
	if($sql->connect_errno) {
		printf("Connection Failed: %s\n", $sql->connect_error);
		exit;
	}
	$currentUser = $_SESSION['current_user'];
	$circle = (isset($_POST["circleName"]) ? $_POST["circleName"]:null);
	if($currentUser != null && $circle !=null){
	$stmt = $sql->prepare("INSERT into Circles (Name, Owner) Select ?, (Select UserID FROM Users WHERE Username=?) AS Owner");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $sql->error);
		exit;
	}
	$stmt->bind_param('ss', mysql_real_escape_string($circle),mysql_real_escape_string($currentUser));
	$stmt->execute();
	$stmt->close();
	} 
	header("Location: circles.php");

}
else
header("Location: index.php");
?>
