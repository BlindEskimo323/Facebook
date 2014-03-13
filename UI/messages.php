<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['current_user'])){
	header("Location: signin.html");
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Inbox</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
    <div class="panel-heading">Inbox</div>
      <!-- Table -->
<!-- Placeholder PHP for table query 1/2    -->
	<?php
          $server = mysql_connect("localhost","root", "password");
          $db =  mysql_select_db("Facebook");
          $query = mysql_query("SELECT m.Content, us.Name Sender, ur.Name Reciever, m.Timestamp
FROM Messages m
JOIN Users us ON us.UserID = m.Sender
JOIN Users ur ON ur.UserID = m.Reciever
ORDER BY TIMESTAMP DESC
");
	?>
<!-- -->
  	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th>Time</th>
	      <th>From</th>
	      <th>Message</th>
	    </tr>
	  </thead>
	  <tbody>
<!-- Placeholder PHP for message table query 2/2 --> 
	    <?php
	      while ($row = mysql_fetch_array($query)) {
	       echo "<tr>";
	       echo "<td>".$row[Timestamp]."</td>";
	       echo "<td>".$row[Sender]."</td>";
	       echo "<td>".$row[Content]."</td>";
	       echo "</tr>";
	      }
	    ?>
<!-- -->
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

