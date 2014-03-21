<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		session_start();
		if(!isset($_SESSION['current_user'])){
			header("Location: signin.html");
		}
		$circle = (isset($_POST["circle"]) ? $_POST["circle"]:null);

		$sql = new mysqli("localhost", "root", "password", "Facebook");
		if($sql->connect_errno) {
			printf("Connection Failed: %s\n", $mysqli->connect_error);
			exit;
		}
		include 'bar.html';
	?>
</head>
<body>
<form class="form-message" role="form" action="addToCircle.php" method="post">
<div class="form-group">
      <label for="name">Select person</label>
      <select class="form-control" name="personToAdd">
	<?php
		$stmt = $sql->prepare("SELECT us.Username, ur.Username 
FROM Requests r 
Join Users us ON us.UserID = r.Sender 
JOIN Users ur ON ur.UserID = r.Reciever
WHERE (us.Username = ? 
  OR ur.Username = ?) 
  AND r.Response = 1
  AND NOT EXISTS (
    SELECT 1 FROM Circles c
    JOIN CircleMembers cm ON c.CircleID = cm.CircleID
    WHERE c.Name = ?
    AND cm.UserID IN (us.UserID, ur.UserID)
  )" );
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $sql->error);
			exit;
		}
		$username = mysql_real_escape_string($_SESSION['current_user']);

		$stmt->bind_param('sss', $username, $username, $circle);
		$stmt->execute();
		$stmt->bind_result($sender, $receiver);
		while($stmt->fetch()){
			if(strcmp($sender, $username)==0){
				echo "<option>".$receiver."</option>";
			} else { 
				echo "<option>".$sender."</option>";
			}
		}
		$stmt->close();
		echo "<input type='hidden' name='circle' value='$circle'>";
	?>
</select>
</label>
</div>
<div>
<button class="btn btn-lg btn-danger btn-block" type="submit" id="send_button" name="add_button">Add to Circle</button>
</div>
</form>
<form class="form-message" role="form" action="removeFromCircle.php" method="post">
<div class="form-group">
      <label for="name">Select person</label>
      <select class="form-control" name="personToRemove">
	<?php
		$stmt = $sql->prepare("SELECT us.Username FROM CircleMembers c Join Users us ON us.UserID = c.UserID WHERE CircleID=(SELECT CircleID FROM Circles WHERE Name=?)");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}
		$username = mysql_real_escape_string($_POST['person']);
		$stmt->bind_param('s', $circle);
		$stmt->execute();
		$stmt->bind_result($name);
		while($stmt->fetch()){
			echo "<option>".$name."</option>";
		}
		$stmt->close();
		echo "<input type='hidden' name='circle' value='$circle'>";
	?>
</select>
</label>
</div>
<div>
<button class="btn btn-lg btn-danger btn-block" type="submit" id="send_button" name="remove_button">Remove</button>
</div>
</form>
</div>
</body>
</html>

