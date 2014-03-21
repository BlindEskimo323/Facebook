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
	      <th>Time</th>
	      <th>Status</th>
	    </tr>
	  </thead>
	  <tbody>
<!-- Placeholder PHP for table query 1/2    -->
	<?php
	$sql = new mysqli("eu-cdbr-azure-west-b.cloudapp.net", "bab5e35687adc1", "08b0d06f", "facebook");
	if($sql->connect_errno) {
		printf("Connection Failed: %s\n", $mysqli->connect_error);
		exit;
	}
	$stmt = $sql->prepare("SELECT us.Username send, us.Name sendName, ur.Username Rec, ur.Name RecName, r.Timestamp, r.Response
	FROM Requests r
	JOIN Users us ON us.UserID = r.Sender
	JOIN Users ur ON ur.UserID = r.Reciever
	WHERE (ur.Username = ? OR us.Username = ?)
	ORDER BY TIMESTAMP DESC");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$username = mysql_real_escape_string($_SESSION['current_user']);
	$stmt->bind_param('ss', $username, $username);
	$stmt->execute();
	$stmt->bind_result($send, $sendName, $rec, $recName, $time, $response);
	while($stmt->fetch()){
		echo "<tr>";
		if(strcmp($send, $username) == 0){
		echo "<td>".$rec."</td>";
		echo "<td>".$recName."</td>";
		} else { 
		echo "<td>".$send."</td>";
		echo "<td>".$sendName."</td>";
		}
		echo "<td>".$time."</td>";
		if($response){
		echo "<td>Accepted</td>";
		}else {
		echo "<td>Pending</td>";
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

