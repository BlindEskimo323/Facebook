<?php
if(isset($_POST["login_button"])){
	session_start();

	$host = "du7n801d1x.database.windows.net,1433";
	$user = "user";
	$pwd = "Abcd1234";
	$db = "Facebook";
	// Connect to database.
	try {
	    $sql = new PDO( "sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
	    $sql->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch(Exception $e){
	    die(var_dump($e));
	}
	
//	$sql = new mysqli("localhost", "root", "password", "Facebook");
//	if($sql->connect_errno) {
//		printf("Connection Failed: %s\n", $sql->connect_error);
//		exit;
//	}
	$username = (isset($_POST["contact-uname"]) ? $_POST["contact-uname"]:null);
	$password = (isset($_POST["contact-pwd"]) ? hash('sha256', $_POST["contact-pwd"]):null);
	if($username != null && $password != null){
		$stmt = $sql->prepare("SELECT Username, Password FROM Users WHERE Username=?");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $sql->error);
			exit;
		}
		$stmt->bind_param('s', $username);
		$stmt->execute();
		$stmt->bind_result($uname, $pass);
		$stmt->fetch();
		if(strcmp($password, $pass)==0){
			$_SESSION['current_user'] = $username;
			header("Location: index.php");
			die();
		}
		else{
			echo("Wrong Password");
		}
	} 

}
header("Location: index.php");
?>
