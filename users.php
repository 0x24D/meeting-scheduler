<?php
  session_start();
?>

<?php include_once 'includes/header.inc.php'; ?>

<?php
  if(!empty($_SESSION['statusMsg']))
  {
    echo '<div class="row"><div class="alert alert-info">'.$_SESSION['statusMsg'].'</div></div>';
    unset($_SESSION['statusMsg']);
  }
?>

<?php include_once 'includes/header.inc.php'; ?>

<div class="row">
  <div class="panel panel-default users-content">
    <div class="panel-heading">Users <a href="add-user.php" class="glyphicon glyphicon-plus"></a>
    </div>
    <table class="table">
      <tr>
        <th width="10%">#</th>
        <th width="20%">Employee ID</th>
        <th width="20%">First Name</th>
        <th width="20%">Second Name</th>
        <th width="30%">Email</th>
      </tr>
      <?php
        include 'classes/db.php';
        $db = new db();
        $users = $db->getRows('users',array('order_by'=>'id DESC'));
        if(!empty($users)){ $count = 0; foreach($users as $user){ $count++;?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><?php echo $user['empid']; ?></td>
          <td><?php echo $user['firstname']; ?></td>
          <td><?php echo $user['lastname']; ?></td>
          <td><?php echo $user['email']; ?></td>
          <td>
            <a href="edit-user.php?id=<?php echo $user['id']; ?>" class="glyphicon glyphicon-edit"></a>
            <a href="process_user.php?action_type=delete&id=<?php echo $user['id']; ?>"
              class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure?');"></a>
          </td>
        </tr>
        <?php } }else { ?>
        <tr><td colspan="4">No users(s) found ...</td></tr>
        <?php } ?>
    </table>
  </div>
</div>

<?php include_once 'includes/footer.inc.php'; ?>
