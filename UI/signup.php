<?php
if(isset($_POST["signupSubmit"])){
	session_start();
	$sql = new mysqli("localhost", "root", "password", "Facebook");
	if($sql->connect_errno) {
		printf("Connection Failed: %s\n", $mysqli->connect_error);
		exit;
	}

	$name = (isset($_POST["signUpName"]) ? $_POST["signUpName"]:null);
	$email = (isset($_POST["signUpEmail"]) ? $_POST["signUpEmail"]:null);
	$username = (isset($_POST["signUpUserName"]) ? $_POST["signUpUserName"]:null);
	$password = (isset($_POST["signUpPassword"]) ? $_POST["signUpPassword"]:null);
	if($username != null && $password != null && $email != null && $name != null){
		$stmt = $sql->prepare("insert into Users (Name, Username, Password, Email) values (?, ?, ?, ?)");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $sql->error);
			exit;
		}
		$stmt->bind_param('ssss', mysql_real_escape_string($name), mysql_real_escape_string($username), mysql_real_escape_string($password), mysql_real_escape_string($email));
		$stmt->execute();
		$stmt->close();
	
		$_SESSION['current_user'] = $username;
		header("Location: index.php");
		die();
		
	} 

}
?>