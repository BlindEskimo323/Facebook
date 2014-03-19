<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['current_user'])){
	header("Location: signin.html");
}
?>
<html lang="en">

  <body>
		<?php
include 'bar.html';
?>

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
	$sql = new mysqli("localhost", "root", "password", "Facebook");
	if($sql->connect_errno) {
		printf("Connection Failed: %s\n", $mysqli->connect_error);
		exit;
	}
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

