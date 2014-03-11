<html>
<head>
<title>Facebook</title>
</head>
<body>
	Welcome to Facebook
	<form name="login" action="login.php" method="post">
	Username: <input type="text" name="username"><br>
	Password: <input type="password" name="password"><br>
	<input type="submit" name="login_button" value="Login">
	<input type="submit" name="create_button" value="Create User">
	</form>	
</body>
</html>

<?php
if(isset($_POST['login_button'])){
	session_start();
	mysql_connect("localhost", "root", "password");
	mysql_select_db("Facebook");
	echo("connected");
	$username = (isset($_POST["username"]) ? $_POST["username"]:null);
	$password = (isset($_POST["password"]) ? $_POST["password"]:null);
	echo($username . $password);
	if($username != null && $password != null){
		$query = sprintf("SELECT Username, Password FROM Users WHERE Username='%s'",
		mysql_real_escape_string($username));
		$result = mysql_fetch_assoc(mysql_query($query));
		
		if(strcmp($password, $result['Password'])==0){
			$_SESSION['current_user'] = $username;
			header("Location: home.php");
			die();
		}
		else{
			echo("Wrong Password");
		}
	} 




}
if(isset($_POST['create_button'])){
	header("Location: createuser.php");
}
?>
