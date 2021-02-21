<?php
/**
 * Deletes journal entries
 */
require_once('./app.php');
session_start();
$userID = $_SESSION['userid'];
if(isset($userID)){
  $user = app_get_userdata_from_id($userID);
  if(isset($user)){
    $journalID = $_GET['journalid'];
    $entryID = $_GET['journalentryid'];
    if(!empty($journalID) && !empty($entryID)){
      app_delete_journalentry($journalID, $entryID); 
    }
    header('location:./journalentries.php?journal='.$journalID);
    die();
  }
  else{
    header('location:./');
    die();
  }
}
else{
  header('location:./');
  die();
}



?>