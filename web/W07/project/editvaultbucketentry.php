<?php
/**
 * Create and edit vault bucket entries
 */
require_once('./app.php');
session_start();
$userID = $_SESSION['userid'];
if(isset($userID)){
  $user = app_get_userdata_from_id($userID);
  if(isset($user)){
    $pAction = $_POST['action'];
    switch($pAction){
      case 'new':
      if(empty($_POST['recorddate']) || empty($_POST['value']) || empty($_POST['comment'])){
        header('Location:./editvaultbucketentry.php?action=new');
        die();
      }
      else{
        app_add_vaultbucketentry($_POST);
        header('Location:./vaultbucketentries.php?vault='.$_POST['vault']);
        die();
      }
      break;
      case 'edit':
      if(empty($_POST['recorddate']) || empty($_POST['value']) || empty($_POST['comment'])){
        header('Location:./editvaultbucketentry.php?action=edit&id='.$_POST['bucketentryid']);
        die();
      }
      else{
        app_update_vaultbucketentry($_POST);
        header('Location:./vaultbucketentries.php?vault='.$_POST['vaultid']);
        die();
      }
      break;
    }

    $action = $_GET['action'];
    $id = $_GET['id'];
    if(empty($action) || ( $action == 'edit' && empty($id)) || !($action == 'edit' || $action == 'new' )){
      header('Location:./vaultbucketentries.php');
      die();
    }
    switch($action):
    case 'new':?>
       <?  app_head('Vault Bucket Entries', Array('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min', 
    './css/style'), true);?>
      <? app_header();?>
      <form method="post">
      <div class="list-result app-form">
          <label for="recorddate">Record Date: </label>
            <input type="text" name="recorddate" id="recorddate" placeholder="YYYY-MM-DD" pattern="\d{4}-\d{2}-\d{2}" required>
            <label for="value">Value: </label>
            <input type="text" name="value" id="value" required>
            <label for="value">Comment: </label>
            <input type="text" name="comment" id="comment" required>
            <input type="hidden" name="vault" value="<? echo $_GET['vaultid']?>">
            <input type="hidden" name="action" value="new"><input type="submit" class="btn-dark" value="Create Entry">
      </div>
      </form>
    <? break; ?>
    <?  case 'edit': ?>
        <? $vaultentry = app_get_vaultentry_by_id($id); ?>
        <?  app_head('Vault Bucket Entries', Array('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min', 
      './css/style',));?>
        <? app_header();?>
        <form method="post">
          <div class="list-result app-form">
            <label for="recorddate">Record Date: </label>
            <input type="text" name="recorddate" id="recorddate" placeholder="YYYY-MM-DD" pattern="\d{4}-\d{2}-\d{2}" value="<? echo $vaultentry[0]['recorddate'] ?>" required >
            <label for="value">Value: </label>
            <input type="text" name="value" id="value" value="<? echo $vaultentry[0]['value'] ?>" required>
             <label for="value">Comment: </label>
            <input type="text" name="comment" id="comment" value="<? echo $vaultentry[0]['comment'] ?>" required>
            <input type="hidden" name="bucketentryid" value="<? echo $vaultentry[0]['bucketentryid'] ?>">
            <input type="hidden" name="vaultid" value="<? echo $vaultentry[0]['vaultid']?>">
            <input type="hidden" name="action" value="edit">
            <input type="submit" class="btn-dark" value="Edit Entry">
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