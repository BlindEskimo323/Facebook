<?php
if(isset($_POST["login_button"])){
	session_start();
	mysql_connect("localhost", "root", "password");
	mysql_select_db("Facebook");
	$username = (isset($_POST["contact-uname"]) ? $_POST["contact-uname"]:null);
	$password = (isset($_POST["contact-pwd"]) ? $_POST["contact-pwd"]:null);
	if($username != null && $password != null){
		$query = sprintf("SELECT Username, Password FROM Users WHERE Username='%s'",
		mysql_real_escape_string($username));
		$result = mysql_fetch_assoc(mysql_query($query));
		
		if(strcmp($password, $result['Password'])==0){
			$_SESSION['current_user'] = $username;
			header("Location: index.php");
			die();
		}
		else{
			echo("Wrong Password");
		}
	} 

}
?>
