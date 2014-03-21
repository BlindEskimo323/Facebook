<!DOCTYPE html>
<html lang="en">
  <head>
	<?php
		session_start();
		if(!isset($_SESSION['current_user'])){
			header("Location: signin.html");
		}
	        $server = mysql_connect("eu-cdbr-azure-west-b.cloudapp.net","bab5e35687adc1", "08b0d06f");
	        $db =  mysql_select_db("facebook");
		include 'bar.html';
	?>
  </head>
  <body>
<form class="form-message" role="form" action="send.php" method="post">
<div class="form-group">
      <label for="name">Select person</label>
      <select class="form-control" name="name">
	<?php
		$circle = (isset($_POST["circle"]) ? $_POST["circle"]:null);
		$userquery = sprintf("SELECT CircleID FROM Circles WHERE Name='%s'", mysql_real_escape_string($circle));
		$result = mysql_fetch_assoc(mysql_query($userquery));
		$query = mysql_query(sprintf("SELECT us.Username FROM CircleMembers c Join Users us ON us.UserID = c.UserID WHERE CircleID='%s'",mysql_real_escape_string($result['CircleID'])));
	 	while ($row = mysql_fetch_array($query)) {
			echo "<option>".$row[Username]."</option>";
		}

	?>
</select>
</label>
</div>
</div>
<div>	
        <textarea class="form-control status-update" rows="3" placeholder="Message" name="message"></textarea>
</div>
<div>
<button class="btn btn-lg btn-primary btn-block" type="submit" id="send_button" name="send_button">Send</button>
</div>
</div>
</body>
</html>

