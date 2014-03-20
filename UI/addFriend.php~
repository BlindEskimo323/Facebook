<?php
if(isset($_POST["addFriend"])){
	session_start();

	$sql = new mysqli("localhost", "root", "password", "Facebook");
	if($sql->connect_errno) {
		printf("Connection Failed: %s\n", $mysqli->connect_error);
		exit;
	}

	$receiver = (isset($_POST["receiver"]) ? $_POST["receiver"]:null);

	if($receiver != null){
		$senderName = mysql_real_escape_string($_SESSION['current_user']);
		$receiverName = mysql_real_escape_string($receiver);

		$stmt = $sql->prepare("INSERT INTO Requests (sender, reciever) 
			SELECT 
			(SELECT userID FROM Users WHERE Username=?) AS sender,
			(SELECT userID FROM Users WHERE Username=?) AS reciever");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $sql->error);
			exit;
		}
		$stmt->bind_param('ss', $senderName, $receiverName);
		$stmt->execute();
		$stmt->close();
		header("Location: index.php");
	} 

}
?>
