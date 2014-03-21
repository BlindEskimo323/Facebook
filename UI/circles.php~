<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['current_user'])){
	header("Location: signin.html");
}
include 'bar.html';
?>
<html lang="en">
  <body>
  <div class="panel panel-default">


<form class="form-message" role="form" action="editCircle.php" method="post">
<div class="form-group">
      <label for="name">Circles</label>
      <select class="form-control" name="circle">
	<?php
	$sql = new mysqli("eu-cdbr-azure-west-b.cloudapp.net", "bab5e35687adc1", "08b0d06f", "facebook");
		if($sql->connect_errno) {
			printf("Connection Failed: %s\n", $mysqli->connect_error);
			exit;
		}
		$stmt = $sql->prepare("SELECT Name FROM Circles WHERE Owner=(SELECT UserID FROM Users WHERE Username=?)");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}
		$username = $_SESSION['current_user'];
		$stmt->bind_param('s', $username);
		$stmt->execute();
		$stmt->bind_result($name);
		while($stmt->fetch()){
			echo "<option>".$name."</option>";
		}
		$stmt->close();
	    ?>
</select>
</label>
</div>
<div class="form-group">
<button class="btn btn-lg btn-primary btn-block" type="submit" id="login_button" name="login_button">Select Circle</button>
</div>
</form>


<form name="createCircle" role="formCreate" action="addCircle.php" class="form-message" method="POST">
    <div class="form-group">
        <input type="text" placeholder="New Circle Name" class="form-control" name="circleName"></input>
        <button type="submit" class="btn btn-default" name="addCircle_Button">Add Circle</button>
    </div>
</form>
</div>
</body>
</html>

