<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scaffolding</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/stylesheet.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-static-top">
      <div class="container">

        <a href="#" class="navbar-brand">COMP3013</a>

        <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse navHeaderCollapse">

        <form role="search" class="navbar-form navbar-left">
            <div class="form-group">
                <input type="text" placeholder="Search" class="form-control">
                <button type="submit" class="btn btn-default">Search</button>
            </div>
        </form>

          <ul class="nav navbar-nav navbar-right">

            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Profile</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Messages <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Inbox</a></li>
                <li><a href="#">Sent Messages</a></li>
              </ul>
            </li>
            <li><a href="#">About</a></li>
          </ul>
        </div>

      </div>
    </div>

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
          <h3><a href="#">Cliques</a></h3>
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
        <p class="navbar-text pull-left">Site by Daniel Beltran</p>
        <a href="#login" data-toggle="modal" class="navbar-btn btn btn-primary pull-right">Login/Register</a>
      </div>
    </div>

    <div class="modal fade" id="login" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <form class="form-horizontal" action="login.php" method="post">
            <div class="modal-header">
              <h4>Sign In or Register</h4>
            </div>

            <div class="modal-body">
              <div class="form-group">
                <label for="contact-uname" class="col-lg-2 control-label">Username:</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" id="contact-uname" name="contact-uname" placeholder="Enter Username Here">
                </div>
              </div>

              <div class="form-group">
                <label for="contact-pwd" class="col-lg-2 control-label">Password:</label>
                <div class="col-lg-10">
                  <input type="password" class="form-control" id="contact-pwd" name="contact-pwd" placeholder="Enter Password Here">
                </div>
              </div>

              <a href="#">Register Here!</a>
           </div>

            <div class="modal-footer">
              <a class="btn btn-default" data-dismiss="modal">Cancel</a>
              <button class="btn btn-primary" type="submit" id="login_button" name="login_button">Sign In</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
