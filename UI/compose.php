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
<form class="form-message" role="form" action="send.php" method="post">
<div class="form-group">
      <label for="name">Select person</label>
      <select class="form-control" name="name">
	<?php
	$circle = (isset($_POST["circle"]) ? $_POST["circle"]:null);
		$userquery = sprintf("SELECT CircleID FROM Circles WHERE Name='%s'", mysql_real_escape_string($circle));
		$result = mysql_fetch_assoc(mysql_query($userquery));
		$query = mysql_query(sprintf("SELECT us.Name FROM CircleMembers c Join Users us ON us.UserID = c.UserID WHERE CircleID='%s'",mysql_real_escape_string($result['CircleID'])));
	 	while ($row = mysql_fetch_array($query)) {
			echo "<option>".$row[Name]."</option>";
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

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

