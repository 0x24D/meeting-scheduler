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

<div class="row">
  <div class="panel panel-default meetings-content">
    <div class="panel-heading">Meetings <a href="add-meeting.php" class="glyphicon glyphicon-plus"></a>
    </div>
    <table class="table">
      <tr>
        <th width="5%">#</th>
        <th width="20%">Meeting Creator</th>
        <th width="15%">Room Number</th>
        <th width="20%">Date</th>
        <th width="20%">Start Time</th>
        <th width="20%">End Time</th>
      </tr>
      <?php
        include 'classes/db.php';
        $db = new db();
        $meetings = $db->getRows('meetings',array('order_by'=>'id DESC'));
        if(!empty($meetings))
        {
          $count = 0;
          foreach($meetings as $meeting)
          {
            $count++;
            ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><?php echo $meeting['meetingcreator']; ?></td>
              <td><?php echo $meeting['roomnumber']; ?></td>
              <td><?php echo $meeting['date']; ?></td>
              <td><?php echo $meeting['starttime']; ?></td>
              <td><?php echo $meeting['endtime']; ?></td>
              <td>
                <a href="edit-meeting.php?id=<?php echo $meeting['id']; ?>" class="glyphicon glyphicon-edit"></a>
                <a href="process_meeting.php?action_type=delete&id=<?php echo $meeting['id']; ?>"
                  class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure?');"></a>
              </td>
            </tr>
          <?php }
        }else { ?>
        <tr><td colspan="6">No meeting(s) found ... </td></tr>
        <?php } ?>
    </table>
  </div>
</div>

<?php include_once 'includes/footer.inc.php'; ?>
