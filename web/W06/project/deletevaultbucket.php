<?php
require_once('./app.php');
session_start();
$userID = $_SESSION['userid'];
if(isset($userID)){
  $user = app_get_userdata_from_id($userID);
  if(isset($user)){
    $vaultID = $_GET['vaultid'];
    
    if(!empty($vaultID)){
      app_delete_vaultbucket($userID, $vaultID); 
    }
    header('location:./vaultbuckets.php');
  }
  else{
    header('location:./');
  }
}
else{
  header('location:./');
}



?>