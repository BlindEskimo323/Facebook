<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['current_user'])){
	header("Location: signin.html");
}
include 'bar.html';
	$sql = new mysqli("eu-cdbr-azure-west-b.cloudapp.net", "bab5e35687adc1", "08b0d06f", "facebook");
	if($sql->connect_errno) {
		printf("Connection Failed: %s\n", $mysqli->connect_error);
		exit;
	}
?>
<html lang="en">

  <body>

<form class="form-message" role="form" action="compose.php" method="post">
<div class="form-group">
      <label for="name">Select circle</label>
      <select class="form-control" name="circle">
	<?php
		$username = $_SESSION['current_user'];
		$stmt = $sql->prepare("SELECT Name FROM Circles WHERE Owner=(SELECT UserID FROM Users WHERE Username=?)");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}
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
<button class="btn btn-lg btn-primary btn-block" type="submit" id="login_button" name="login_button">Select Person</button>
</div>
</form>
  <div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Inbox</div>
      <!-- Table -->
  	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th>Time</th>
	      <th>From</th>
	      <th>Message</th>
	    </tr>
	  </thead>
	  <tbody>
<!-- Placeholder PHP for table query 1/2    -->
	<?php

	$stmt = $sql->prepare("SELECT m.Content, us.Username Send, ur.Username Rec, m.Timestamp
	FROM Messages m
	JOIN Users us ON us.UserID = m.Sender
	JOIN Users ur ON ur.UserID = m.Reciever
	WHERE ur.Username = ?
	ORDER BY TIMESTAMP DESC");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$senderName = mysql_real_escape_string($_SESSION['current_user']);
	$stmt->bind_param('s', $senderName);
	$stmt->execute();
	$stmt->bind_result($content, $sender, $receiver, $time);
	while($stmt->fetch()){
		echo "<tr>";
		echo "<td>".$time."</td>";
		echo "<td>".$sender."</td>";
		echo "<td>".$content."</td>";
		echo "</tr>";
	}
	$stmt->close();
	?>

	</tbody>
</table>
</div>

  </body>
</html>

