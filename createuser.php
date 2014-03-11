<html>
<head>
<title>Facebook</title>
</head>
<body>
	Welcome to Facebook
	<form name="createuser" action="createuser.php" method="post">
	Name: <input type="text" name="name"><br>
	Username: <input type="text" name="username"><br>
	Password: <input type="password" name="password"><br>
	<input type="submit" name="create_user" value="Create User">
	</form>	
</body>
</html>

<?php
echo("start");
if(isset($_POST['create_user'])){
	session_start();
	mysql_connect("localhost", "root", "password");
	mysql_select_db("Facebook");

	$name = (isset($_POST["name"]) ? $_POST["name"]:null);
	$username = (isset($_POST["username"]) ? $_POST["username"]:null);
	$password = (isset($_POST["password"]) ? $_POST["password"]:null);

	if($username != null && $password != null && $name != null){
		$query = mysql_query("INSERT INTO Users (Username, Name, Password) VALUES ('$username','$name','$password')");
        	mysqli_close($connection);
		header("Location: login.php");
	} 




}
if(isset($_POST['create_button'])){
	header("Location: createuser.php");
}
?>
