<?php
if(isset($_POST["send_button"])){
	session_start();
	$sql = new mysqli("localhost", "root", "password", "Facebook");
	if($sql->connect_errno) {
		printf("Connection Failed: %s\n", $mysqli->connect_error);
		exit;
	}
	$username = (isset($_POST["name"]) ? $_POST["name"]:null);
	$message = (isset($_POST["message"]) ? $_POST["message"]:null);
	if($username != null && $message != null){
	$senderName = mysql_real_escape_string($_SESSION['current_user']);
	$receiverName = mysql_real_escape_string($_POST['name']);

	$stmt = $sql->prepare("insert into Messages(Content, Sender, Reciever)
				SELECT ?,
				(SELECT userID FROM Users WHERE Username=?) AS Sender,
				(SELECT userID FROM Users WHERE Username=?) AS Reciever");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $sql->error);
		exit;
	}
	$stmt->bind_param('sss', mysql_real_escape_string($message), $senderName, $receiverName);
	$stmt->execute();
	$stmt->close();
	header("Location: sentMessages.php");
	} 
	header("Location: sentMessages.php");

}
?>
