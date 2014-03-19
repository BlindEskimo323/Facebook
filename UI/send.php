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
	$stmt = $sql->prepare("SELECT UserID FROM Users WHERE Username=?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$senderName = mysql_real_escape_string($_SESSION['current_user']);
	$stmt->bind_param('s', $senderName);
	$stmt->execute();
	$stmt->bind_result($sender);
	$stmt->fetch();
	$stmt->close();

	$stmt = $sql->prepare("SELECT UserID FROM Users WHERE Username=?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$receiverName = mysql_real_escape_string($_POST['name']);
	$stmt->bind_param('s', $receiverName);
	$stmt->execute();
	$stmt->bind_result($receiver);
	$stmt->fetch();
	$stmt->close();
	$stmt = $sql->prepare("insert into Messages (Content, Sender, Reciever) values (?, ?, ?)");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $sql->error);
		exit;
	}
	$stmt->bind_param('sii', mysql_real_escape_string($message), $sender, $receiver);
	$stmt->execute();
	$stmt->close();
	header("Location: sentMessages.php");
	} 

}
?>
