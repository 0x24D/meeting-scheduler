<?php
include_once 'includes/header.inc.php';
include_once 'includes/nav.inc.php';
?>
<div class="row">
  <div class="panel panel-default meeting-add-edit">
    <div class="panel-heading">Add Meeting <a href="index.php" class="glyphicon glyphicon-arrow-left"></a>
    </div>
    <div class="panel-body">
      <form method="post" action="process_meeting.php" class="form" id="meetingform">
        <div class="form-group">
          <label>Meeting Creator: </label>
          <input type="text" class="form-control" name="meetingcreator" required />
        </div>
        <div class="form-group">
          <label>Room Number: </label>
          <input type="text" class="form-control" name="roomnumber" required />
        </div>
        <div class="form-group">
          <label>Date: </label>
          <input type="date" class="form-control" name="date" required />
        </div>
        <div class="form-group">
          <label>Start Time: </label>
          <input type="time" class="form-control" name="starttime" required />
        </div>
        <div class="form-group">
          <label>End Time: </label>
          <input type="time" class="form-control" name="endtime" required />
        </div>
        <div class="form-group">
            <label>Meeting attendees:&nbsp;&nbsp; <span class="fa fa-lg fa-plus-circle" aria-hidden="true"></span></label>
            <div id="a">
            <input type="text" class="form-control" name="attendee1" required>
            </div>
        </div>

        <!--  IDEA:
              Have another hidden field here which uses JavaScript to copy in each inserted employee ID from above
              fields. It will also copy the meeting creator id.

              So the hidden field will have a value something like "b5017909, b1010101, b1031031"
              this can then be sent to the PHP back end and imploded to remove the commas and create an array
              with the values like array(55017909, b1010101, b1031031);

              The PHP backend can then loop array.size() amount of times creating a table row for each user
              in this list.
        -->

        <input type="hidden" name="action_type" value="add" />
        <input type="submit" class="form-control btn-default" name="submit" value="Add Meeting" />
      </form>
    </div>
  </div>
</div>
<?php include_once 'includes/footer.inc.php'; ?>
