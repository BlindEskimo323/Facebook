<?php
session_start();
if(!isset($_SESSION['current_user'])){
	header("Location: signin.html");
}
include 'bar.html';
?>

<!DOCTYPE html>
<html lang="en">
  <body>
    <div class="container">
      <div class="jumbotron">
        <center>
        <h1>Welcome to THE social network</h1>
        <p>This will eventually be our COMP3013 Database project</p>
        <a class="btn btn-default">Learn more</a>
        <a href="mailto:daniel.beltran.13@ucl.ac.uk" class="btn btn-info">Contact Us</a>
        </center>
      </div>
    </div>

    <div class="navbar navbar-default navbar-fixed-bottom">
      <div class="container">
        <p class="navbar-text pull-right">Site by Daniel, Josh, and Sam  :P</p>
      </div>
    </div>

  </body>
</html>
