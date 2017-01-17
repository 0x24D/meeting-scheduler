<?php
  session_start();
  include 'classes/db.php';
  $db = new db();
  $tblName = 'meetings';
  $linker = 'meetingrooms';
  $linker2 = 'usermeetings';

  // CREATE
  // TODO: THIS CODE CAN BE REFINED ONCE THE FUNCTIONS IN DB.PHP HAVE
  // BEEN IMPROVED.
  if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type']))
  {
    if($_REQUEST['action_type'] == 'add')
    {
      $data = array
      (
        'meetingcreator'  => $_POST['meetingcreator'],
        'roomnumber'      => $_POST['roomnumber'],
        'date'            => $_POST['date'],
        'starttime'       => $_POST['starttime'],
        'endtime'         => $_POST['endtime']
      );
      $insert = $db->insert($tblName, $data);

      $meetingId = $db->getLastInsert();
      $linkerData = array
      (
        'meetingid' => $meetingId,
        'roomnumber' => $_POST['roomnumber']
      );
      $insert = $db->insertLinker($linker, $linkerData);

      // TODO: NEED A LOOP HERE TO MAKE A NEW COMMIT FOR EACH USER ENTERED.
      // MAYBE POSSIBLE TO CREATE AN ARRAY WITH JAVASCRIPT CLIENT SIDE
      // TO AVOID THIS.
      // ALSO NEEDS VALIDATION TO MAKE SURE THE USER EXISTS

      // CURRENTLY JUST INSERTING ONE USER FOR PROTOTYPE / DEMO PURPOSES
      $linker2Data = array
      (
        'meetingid' => $meetingId,
        'empid' => $_POST['attendee1']
      );
      $insert = $db->insertLinker2($linker2, $linker2Data);

      $statusMsg = $insert?'Meeting data has been inserted successfully':'ERROR';
      $_SESSION['statusMsg'] = $statusMsg;
      header("Location:meetings.php");
    }

    // UPDATE
    elseif($_REQUEST['action_type'] == 'edit')
    {
      if(!empty($_POST['id']))
      {
        $data = array
        (
          'meetingcreator'  => $_POST['meetingcreator'],
          'roomnumber'      => $_POST['roomnumber'],
          'date'            => $_POST['date'],
          'starttime'       => $_POST['starttime'],
          'endtime'         => $_POST['endtime']
        );
        $condition = array('id' => $_POST['id']);
        $update = $db->update($tblName, $data, $condition);
        $statusMsg = $update?'Meeting data has been updated successfully.':'ERROR';
        $_SESSION['statusMsg'] = $statusMsg;
        header("Location:meetings.php");
      }
    }

    // DELETE
    elseif($_REQUEST['action_type'] == 'delete')
    {
      if(!empty($_GET['id']))
      {
        $condition = array('id' => $_GET['id']);
        $delete = $db->delete($tblName,$condition);
        $statusMsg = $delete?'Meeting data has been deleted successfully':'ERROR';
        $_SESSION['statusMsg'] = $statusMsg;
        header("Location:meetings.php");
      }
    }
  }
?>
