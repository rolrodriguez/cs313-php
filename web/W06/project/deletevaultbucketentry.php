<?php
require_once('./app.php');
session_start();
$userID = $_SESSION['userid'];
if(isset($userID)){
  $user = app_get_userdata_from_id($userID);
  if(isset($user)){
    $vaultID = $_GET['vaultid'];
    $bucketentryID = $_GET['bucketentryid'];
    if(!empty($vaultID) && !empty($bucketentryID)){
      app_delete_vaultbucketentry($vaultID, $bucketentryID); 
    }
    header('location:./vaultbucketentries.php?vault='.$vaultID);
  }
  else{
    header('location:./');
  }
}
else{
  header('location:./');
}

?>