<?php
if(isset($_POST["remove_button"])){
	session_start();
	$sql = new mysqli("localhost", "root", "password", "Facebook");
	if($sql->connect_errno) {
		printf("Connection Failed: %s\n", $sql->connect_error);
		exit;
	}
	$currentUser = $_SESSION['current_user'];
	$otherUser = (isset($_POST["personToRemove"]) ? $_POST["personToRemove"]:null);
	$circle = (isset($_POST["circle"]) ? $_POST["circle"]:null);
	if($currentUser != null && $otherUser != null && $circle !=null){

	$stmt = $sql->prepare(" DELETE FROM CircleMembers 
				WHERE CircleID = (SELECT CircleID FROM Circles WHERE Name=?) AND UserID = (SELECT UserID FROM Users WHERE Username=?)");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $sql->error);
		exit;
	}
	$stmt->bind_param('ss', mysql_real_escape_string($circle), mysql_real_escape_string($otherUser));
	$stmt->execute();
	$stmt->close();
	header("Location: circles.php");
	} 
	header("Location: circles.php");
}
header("Location: index.php");
?>
