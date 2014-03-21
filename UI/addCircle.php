<?php
if(isset($_POST["addCircle_Button"])){
	session_start();
	$sql = new mysqli("eu-cdbr-azure-west-b.cloudapp.net", "bab5e35687adc1", "08b0d06f", "facebook");
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
	echo $currentUser.$circle;
	$stmt->bind_param('ss', mysql_real_escape_string($circle),mysql_real_escape_string($currentUser));
	$stmt->execute();
	$stmt->close();
	header("Location: circles.php");
	} 
	header("Location: circles.php");

}
header("Location: index.php");
?>
