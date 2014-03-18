<!DOCTYPE html>
<html lang="en">
  <head>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script src="jquery-1.11.0.min.js"></script>

    <?php
session_start();
if(!isset($_SESSION['current_user'])){
	header("Location: signin.html");
}
          $server = mysql_connect("localhost","root", "password");
          $db =  mysql_select_db("Facebook");

?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="stylesheet.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
	
  <div class="navbar navbar-inverse navbar-static-top">
		<div="container">
			<a href="#" class="navbar-brand">COMP 3013</a>

  		<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
    		<span class="icon-bar"></span>
    		<span class="icon-bar"></span>
    		<span class="icon-bar"></span>
    	</button>
      <div class="collapse navbar-collapse navHeaderCollapse">
				
			<ul class="nav navbar-nav navbar-right">
				<li><a href="index.php">Home</a></li>
				<li><a href="#">Profile</a></li>
				<li class="active dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Messages <b class="caret"></b></a>
				    <ul class="dropdown-menu">
				      <li><a href="messages.php">Inbox</a></li>
				      <li><a href="sentMessages.php">Sent Messages</a></li>
				    </ul>
				</li>				
				<li><a href="about.html">About</a></li>
				<li><button type="button" class="btn btn-danger navbar-btn"><a href="#"`>Sign Out</a></button></li>
			</ul>
			</div>
		</div>
	</div>

	<div class="panel panel-default">
  	<!-- Default panel contents -->
  	<div class="panel-heading">Sent Messages</div>

<div>
   
<form class="form-message" role="form" action="compose.php" method="post">
<div class="form-group">
      <label for="name">Select circle</label>
      <select class="form-control" name="circle">
	<?php
	  $username = $_SESSION['current_user'];
$userquery = sprintf("SELECT UserID FROM Users WHERE Username='%s'", mysql_real_escape_string($username));
	$result = mysql_fetch_assoc(mysql_query($userquery));
	$query = mysql_query(sprintf("SELECT * FROM Circles WHERE Owner='%s'",
		mysql_real_escape_string($result['UserID'])));
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
	$stmt = $sql->prepare("SELECT m.Content, us.Name Send, ur.Name Rec, m.Timestamp
	FROM Messages m
	JOIN Users us ON us.UserID = m.Sender
	JOIN Users ur ON ur.UserID = m.Reciever
	WHERE us.Name = ?
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

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

