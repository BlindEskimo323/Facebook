<?php
if(isset($_POST["acceptFriend"])){
	session_start();

	$sql = new mysqli("eu-cdbr-azure-west-b.cloudapp.net", "bab5e35687adc1", "08b0d06f", "facebook");
	if($sql->connect_errno) {
		printf("Connection Failed: %s\n", $mysqli->connect_error);
		exit;
	}

	$sender = (isset($_POST["sender"]) ? $_POST["sender"]:null);

	if($sender != null){
		$senderName = mysql_real_escape_string($sender);
		$receiver = mysql_real_escape_string($_SESSION['current_user']);
		$receiverName = mysql_real_escape_string($receiver);

		$stmt = $sql->prepare("UPDATE Requests SET Response=1 WHERE 
			sender= (SELECT userID FROM Users WHERE Username=?) and 
			Reciever = (SELECT userID FROM Users WHERE Username=?)");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $sql->error);
			exit;
		}
		$stmt->bind_param('ss', $sender, $receiverName);
		$stmt->execute();
		$stmt->close();
		header("Location: index.php");
	} 

}
else
header("Location: index.php");
?>
