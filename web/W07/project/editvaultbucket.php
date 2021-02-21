<?php
/**
 * Create and edit vault buckets
 */
require_once('./app.php');
session_start();
$userID = $_SESSION['userid'];
if(isset($userID)){
  $user = app_get_userdata_from_id($userID);
  if(isset($user)){

    // Process journal records
    $pAction = $_POST['action']; 

    switch($pAction){
      case 'new':
      if(empty($_POST['vaultname'])){
        header('Location:./editvaultbucket.php?action=new');
        die();
      }
      else{
        app_add_vaultbucket($userID, $_POST);
        header('Location:./vaultbuckets.php');
        die();
      }
      break;
      case 'edit':
      if(empty($_POST['vaultname'])){
        header('Location:./editvaultbucket.php?action=edit&id='.$_POST['vaultid']);
        die();
      }
      else{
        app_update_vaultbucket($userID, $_POST);
        header('Location:./vaultbuckets.php');
        die();
      }
      break;
    }

    // Check if the address to edit a vault is valid
    $action = $_GET['action'];
    $id = $_GET['id'];
    if(empty($action) || ( $action == 'edit' && empty($id)) || !($action == 'edit' || $action == 'new' )){
      header('Location:./vaultbuckets.php');
      die();
    }
    switch($action):
    case 'new':?>
       <?  app_head('Vault Bucket Dashboard', Array('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min', 
    './css/style'), true);?>
      <? app_header();?>
      <form method="post">
      <div class="list-result app-form">
          <label for="vaultname">Vault Bucket Name: </label>
          <input type="text" name="vaultname" id="vaultname" required>
          <input type="hidden" name="action" value="new">
          <input type="submit" class="btn-dark" value="Create Vault">
      </div>
      </form>
    <? break; ?>
    <?  case 'edit': ?>
        <? $vault = app_get_vaultbucket_by_id($id); ?>
        <?  app_head('Vault Bucket Dashboard', Array('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min', 
      './css/style',));?>
        <? app_header();?>
        <form method="post">
          <div class="list-result app-form">
            <label for="vaultname">Vault Bucket Name: </label>
            <input type="text" name="vaultname" id="vaultname" value="<? echo $vault[0]['vaultname'] ?>" required>
            <input type="hidden" name="vaultid" value="<? echo $vault[0]['vaultid'] ?>">
            <input type="hidden" name="action" value="edit">
            <input type="submit" class="btn-dark" value="Edit Vault">
          </div>
        </form>
    <?  break; ?>
    <? endswitch;?>

<?

    app_footer();
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