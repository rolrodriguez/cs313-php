<?php
require_once('./app.php');
session_start();
$userID = $_SESSION['userid'];
if(isset($userID)){
  $user = app_get_userdata_from_id($userID);
  if(isset($user)){
    $journalID = $_GET['journalid'];
    
    if(!empty($journalID)){
      app_delete_journal($userID, $journalID); 
    }
    header('location:./journals.php');
  }
  else{
    header('location:./');
  }
}
else{
  header('location:./');
}



?>