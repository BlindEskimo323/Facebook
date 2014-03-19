<!DOCTYPE html>
<html lang="en">
<body>
	<?php
include 'bar.html';
?>
<div class="container">
      <div class="jumbotron">
        <center>
		<?php
		session_start();
		if(!isset($_SESSION['current_user'])){
			header("Location: signin.html");
		} else if (isset($_POST["searchButton"])){
			$sql = new mysqli("localhost", "root", "password", "Facebook");
			if($sql->connect_errno) {
				printf("Connection Failed: %s\n", $mysqli->connect_error);
				exit;
			}
			$stmt = $sql->prepare("SELECT Name, Email FROM Users WHERE Username=?");
			if(!$stmt){
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit;
			}
			$username = mysql_real_escape_string($_POST['person']);
			$stmt->bind_param('s', $username);
			$stmt->execute();
			$stmt->bind_result($name, $email);
			if($stmt->fetch()){
				echo ("<h1>".$name."</h1>");
				echo ("<p>".$username."</p>");
			} else{
				echo ("<h1> User not found </h1>");
			}
			$stmt->close();

		} else{
			header("Location: index.php");
		}
		?>

        </center>
      </div>
    </div>

  </body>
</html>

