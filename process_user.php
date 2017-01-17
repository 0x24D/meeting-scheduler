<?php
  session_start();
  include 'classes/db.php';
  $db = new db();
  $tblName = 'users';
  if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type']))
  {
    // LOGIN
    if($_REQUEST['action_type'] == 'login')
    {
      if(!empty($_POST['empid']) && !empty($_POST['password']))
      {
        $empid = $_POST['empid'];
        $password = $_POST['password'];
        $login = $db->login($empid, $password);
        $statusMsg = $login?'You have sucessfully been logged in':'Incorrect Employee ID or Password';
        $_SESSION['statusMsg'] = $statusMsg;
        header("location:index.php");
      }
    }

    // CREATE
    else if($_REQUEST['action_type'] == 'add')
    {
      $data = array
      (
        'empid'     => $_POST['empid'],
        'password'  => password_hash($_POST['password'], PASSWORD_DEFAULT),
        'firstname' => $_POST['firstname'],
        'lastname'  => $_POST['lastname'],
        'email'     => $_POST['email']
      );
      $insert = $db->insert($tblName, $data);
      $statusMsg = $insert?'User data has been inserted successfully':'ERROR';
      $_SESSION['statusMsg'] = $statusMsg;
      header("Location:users.php");
    }

    // UPDATE
    elseif($_REQUEST['action_type'] == 'edit')
    {
      if(!empty($_POST['id']))
      {
        $data = array
        (
          'empid'     => $_POST['empid'],
          'password'  => password_hash($_POST['password'], PASSWORD_DEFAULT),
          'firstname' => $_POST['firstname'],
          'lastname'  => $_POST['lastname'],
          'email'     => $_POST['email']
        );
        $condition = array('id' => $_POST['id']);
        $update = $db->update($tblName, $data, $condition);
        $statusMsg = $update?'User data has been updated successfully.':'ERROR';
        $_SESSION['statusMsg'] = $statusMsg;
        header("Location:users.php");
      }
    }

    // DELETE
    elseif($_REQUEST['action_type'] == 'delete')
    {
      if(!empty($_GET['id']))
      {
        $condition = array('id' => $_GET['id']);
        $delete = $db->delete($tblName,$condition);
        $statusMsg = $delete?'User data has been deleted successfully':'ERROR';
        $_SESSION['statusMsg'] = $statusMsg;
        header("Location:users.php");
      }
    }
  }
?>
