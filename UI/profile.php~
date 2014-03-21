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

<div class="container">
      <div class="jumbotron">
        <center>
<?php
	$sql = new mysqli("eu-cdbr-azure-west-b.cloudapp.net", "bab5e35687adc1", "08b0d06f", "facebook");
	if($sql->connect_errno) {
		printf("Connection Failed: %s\n", $mysqli->connect_error);
		exit;
	}
	$stmt = $sql->prepare("SELECT Name, Email FROM Users WHERE Username=?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$username = mysql_real_escape_string($_SESSION['current_user']);
	$stmt->bind_param('s', $username);
	$stmt->execute();
	$stmt->bind_result($name, $email);
	$stmt->fetch();
	$stmt->close();
	echo ("<h1>".$name."</h1>");
        echo ("<p>".$username."</p>");
        echo ("<p>".$email."</p>");
?>

        <!-- Button trigger modal -->
          <a data-toggle="modal" class="btn btn-primary" href="#editProfile">Edit Profle</a>

<!-- Filter Modal -->
        <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Update Profile</h4>
              </div>
              <div class="modal-body">
                <form class="sign-in" role="form" action="updateProfile.php" method="POST">
		 <div class="form-group">
		   <label for="updateName">Full Name</label>
		   <input type="text" class="form-control" id="updateName" name="updateName" placeholder="Enter new full name">
		 </div>
                 <div class="form-group">
                   <label for="updateEmail">Email address</label>
                   <input type="email" class="form-control" id="updateEmail" name="updateEmail" placeholder="Enter new email">
                 </div>
                 <div class="form-group">
                   <label for="updatePassword">Password</label>
                   <input type="password" class="form-control" id="updatePassword" name="updatePassword" placeholder="Enter new password">
                 </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" name="updateProfileSubmit">Save changes</button>
                </form>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        </center>
      </div>
    </div>

  </body>
</html>

