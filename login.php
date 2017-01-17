<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meeting Scheduler</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php include_once("includes/nav.inc.php");?>
<h1>Meeting Scheduler</h1>
<form class="form-horizontal" method="post" action="profile.php">
  <fieldset>
    <legend>Login</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="inputEmail" placeholder="Email">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Password</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </div>
  </fieldset>
</form>
</body>
</html>

<!--

TODO: ORIGINAL LOGIN FORM, NEEDS INSERTING ^

<div class="row">
  <div class="panel panel-default user-login">
    <div class="panel-heading">Login</div>
    <div class="panel-body">
      <form method="post" action="process_user.php" class="form" id="loginform">
        <div class="form-group">
          <label>Employee ID:</label>
          <input type="text" class="form-control" name="empid" required />
        </div>
        <div class="form-group">
          <label>Password:</label>
          <input type="password" class="form-control" name="password" required />
        </div>
        <input type="hidden" name="action_type" value="login" />
        <input type="submit" class="form-control btn-default" name="submit" value="Login" />
      </form>
    </div>
  </div>
</div>

-->
