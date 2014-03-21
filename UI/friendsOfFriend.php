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
    <!-- Default panel contents -->
    <div class="panel-heading">Friends</div>
      <!-- Table -->
  	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th>Username</th>
	      <th>Name</th>
	      <th>Since</th>
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
	$stmt = $sql->prepare("SELECT us.Username send, us.Name sendName, ur.Username Rec, ur.Name RecName, r.Timestamp
	FROM Requests r
	JOIN Users us ON us.UserID = r.Sender
	JOIN Users ur ON ur.UserID = r.Reciever
	WHERE (ur.Username = ? OR us.Username = ?) AND r.Response = 1
	ORDER BY TIMESTAMP DESC");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$senderName = mysql_real_escape_string($_POST['sender']);
	$stmt->bind_param('ss', $senderName, $senderName);
	$stmt->execute();
	$stmt->bind_result($send, $sendName, $rec, $recName, $time);
	while($stmt->fetch()){
		echo "<tr>";
		if(strcmp($send, $senderName) == 0){
		echo "<td>".$rec."</td>";
		echo "<td>".$recName."</td>";
		echo "<td>".$time."</td>";
		} else { 
		echo "<td>".$send."</td>";
		echo "<td>".$sendName."</td>";
		echo "<td>".$time."</td>";
		}
		echo "</tr>";
	}
	$stmt->close();
	?>

	</tbody>
</table>
</div>

  </body>
</html>

