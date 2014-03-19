<?php
session_start();
if(!isset($_SESSION['current_user'])){
	header("Location: signin.html");
}
?>

<!DOCTYPE html>
<html lang="en">
  <body>
<?php
include 'bar.html';
?>
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

    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h3><a href="circles.php">Circles</a></h3>
          <p>List of Friend Circles here</p>

          <a href="#" class="btn btn-danger">Show All</a>

        </div>

        <div class="col-md-3">
          <h3><a href="#">Latest Updates</a></h3>
          <p>Show everyone else's updates here</p>

          <a href="#" class="btn btn-danger">Show All</a>

        </div>

        <div class="col-lg-3">
          <h3><a href="#">Messages</a></h3>
          <p>Show inbox here</p>

          <a href="#" class="btn btn-danger">Compose New Message</a>

        </div>

        <div class="col-lg-3">
          <h3><a href="#">Update Status</a></h3>
          <textarea class="form-control status-update" rows="3" placeholder="What's Up?"></textarea>

          <a href="#" class="btn btn-danger pull-right">Update</a>
          <p>List of latest status updates here</p>
        </div>

      </div>
    </div>

    <div class="navbar navbar-default navbar-fixed-bottom">
      <div class="container">
        <p class="navbar-text pull-right">Site by Daniel, Josh, and Sam  :P</p>
      </div>
    </div>

  </body>
</html>
