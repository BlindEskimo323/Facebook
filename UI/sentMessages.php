<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
session_start();
if(!isset($_SESSION['current_user'])){
	header("Location: signin.html");
}
          $server = mysql_connect("localhost","root", "password");
          $db =  mysql_select_db("Facebook");

?>
  </head>

  <body>
	<?php
include 'bar.html';
?>
  
   
<form class="form-message" role="form" action="compose.php" method="post">
<div class="form-group">
      <label for="name">Select circle</label>
      <select class="form-control" name="circle">
	<?php
		$username = $_SESSION['current_user'];
		$userquery = sprintf("SELECT UserID FROM Users WHERE Username='%s'", mysql_real_escape_string($username));
		$result = mysql_fetch_assoc(mysql_query($userquery));
		$query = mysql_query(sprintf("SELECT * FROM Circles WHERE Owner='%s'", mysql_real_escape_string($result['UserID'])));
	  	while ($row = mysql_fetch_array($query)) {
			echo "<option>".$row[Name]."</option>";
		}
	    ?>
</select>
</label>
</div>
<div class="form-group">
<button class="btn btn-lg btn-primary btn-block" type="submit" id="login_button" name="login_button">Select Person</button>
</div>
</form>
</div>
  	<!-- Table -->
  	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th>Time</th>
	      <th>To</th>
	      <th>Message</th>
	    </tr>
	  </thead>
	  <tbody>
<!-- Placeholder PHP for table query 1/2    -->
	<?php
	$sql = new mysqli("localhost", "root", "password", "Facebook");
	if($sql->connect_errno) {
		printf("Connection Failed: %s\n", $mysqli->connect_error);
		exit;
	}
	$stmt = $sql->prepare("SELECT m.Content, us.Username Send, ur.Username Rec, m.Timestamp
	FROM Messages m
	JOIN Users us ON us.UserID = m.Sender
	JOIN Users ur ON ur.UserID = m.Reciever
	WHERE us.Username = ?
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
		echo "<td>".$receiver."</td>";
		echo "<td>".$content."</td>";
		echo "</tr>";
	}
	$stmt->close();
	?>

  	
<!-- Placeholder PHP for message table query 2/2 
				 <?php
     	  	 while ($row = mysql_fetch_array($query)) {
          	 	 echo "<tr>";
          	 	 echo "<td>".$row[ID]."</td>";
          	 	 echo "<td>".$row[Name]."</td>";
          	 	 echo "<td>".$row[Title]."</td>";
          	 	 echo "</tr>";
      	 	 }
  		  ?>
-->
			</tbody>
		</table>
	</div>


  </body>
</html>

