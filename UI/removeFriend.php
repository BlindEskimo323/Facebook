<?php
	session_start();
	if(!isset($_SESSION['current_user'])){
		header("Location: signin.html");
	}
	echo $_POST['sender'];
	$sql = new mysqli("localhost", "root", "password", "Facebook");
	if($sql->connect_errno) {
		printf("Connection Failed: %s\n", $sql->connect_error);
		exit;
	}
	echo $_POST['sender'];
	$stmt = $sql->prepare("DELETE FROM Requests WHERE (Sender = (SELECT UserID FROM Users WHERE Username=?) OR Sender = (SELECT UserID FROM Users WHERE Username=?)) AND ( Reciever=(SELECT UserID FROM Users WHERE Username=?) OR Reciever=(SELECT UserID FROM Users WHERE Username=?)) AND Response=1");
	echo $_POST['sender'];
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$senderName = mysql_real_escape_string($_POST['sender']);

	$current = $_SESSION['current_user'];
	$stmt->bind_param('ssss', $senderName, $current, $senderName, $current);

	$stmt->execute();
	echo $_POST['sender'].$current;
	$stmt->close();
	header("Location: index.php");

?>
