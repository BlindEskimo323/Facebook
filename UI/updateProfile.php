<?php
	echo"HI";
if(isset($_POST["updateProfileSubmit"])){
        session_start();
        $sql = new mysqli("localhost", "root", "password", "Facebook");
        if($sql->connect_errno) {
                printf("Connection Failed: %s\n", $sql->connect_error);
                exit;
        }

        if(isset($_SESSION['current_user'])){
		$stmt = $sql->prepare("SELECT Name, Email, Password FROM Users WHERE Username=?");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $sql->error);
			exit;
		}
		$username = mysql_real_escape_string($_SESSION['current_user']);
		$stmt->bind_param('s', $username);
		$stmt->execute();
		$stmt->bind_result($name, $email, $password);
		$stmt->fetch();
		$stmt->close();


		$name = (isset($_POST["updateName"]) ? $_POST["updateName"]:$name);
		$email = (isset($_POST["updateEmail"]) ? $_POST["updateEmail"]:$email);
		$password = ($_POST["updatePassword"]!=null ? $_POST["updatePassword"]:$password);
		echo $name.$password.$email;
		$stmt = $sql->prepare("UPDATE Users SET Name=? WHERE Username=?");
		if(!$stmt){
		        printf("Query Prep Failed: %s\n", $sql->error);
		        exit;
		}
		$stmt->bind_param('ss', mysql_real_escape_string($name), $username);
		$stmt->execute();
		$stmt->close();

		header("Location: index.php");
		die();

        }
	echo "TEST";
}
?>
