<?php
include_once 'includes/header.inc.php';
include_once 'includes/nav.inc.php';
?>
<div class="row">
  <div class="panel panel-default user-add-edit">
    <div class="panel-heading">Add User <a href="index.php" class="glyphicon glyphicon-arrow-left"></a>
    </div>
    <div class="panel-body">
      <form method="post" action="process_user.php" class="form" id="userform">
        <div class="form-group">
          <label>Employee ID: </label>
          <input type="text" class="form-control" name="empid" required />
        </div>
        <div class="form-group">
          <label>Password: </label>
          <input type="password" class="form-control" name="password" required />
        </div>
        <!-- TODO: Confirm password box. Can be implemented with PHP or JAVASCRIPT -->
        <div class="form-group">
          <label>First Name: </label>
          <input type="text" class="form-control" name="firstname" required />
        </div>
        <div class="form-group">
          <label>Second Name: </label>
          <input type="text" class="form-control" name="lastname" required />
        </div>
        <div class="form-group">
          <label>Email: </label>
          <input type="email" class="form-control" name="email" required />
        </div>
        <input type="hidden" name="action_type" value="add" />
        <input type="submit" class="form-control btn-default" name="submit" value="Add User" />
      </form>
    </div>
  </div>
</div>

<?php include_once 'includes/footer.inc.php';?>
