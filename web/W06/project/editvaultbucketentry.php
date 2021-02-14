<?php
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
      if(empty($_POST['entrytitle']) || empty($_POST['entrytext'])){
        header('Location:./editjournalentry.php?action=new');
      }
      else{
        app_add_journalentry($_POST);
        header('Location:./journalentries.php?journal='.$_POST['journalid']);
      }
      break;
      case 'edit':
      if(empty($_POST['entrytitle']) || empty($_POST['entrytext'])){
        header('Location:./editjournalentry.php?action=edit&id='.$_POST['journalentryid']);
      }
      else{
        app_update_journalentry($_POST);
        header('Location:./journalentries.php?journal='.$_POST['journalid']);
      }
      break;
    }

    // Check if the address to edit a journal is valid
    $action = $_GET['action'];
    $id = $_GET['id'];
    if(empty($action) || ( $action == 'edit' && empty($id)) || !($action == 'edit' || $action == 'new' )){
      header('Location:./journalentries.php');
    }
    switch($action):
    case 'new':?>
       <?  app_head('Journal Dashboard', Array('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min', 
    './css/style',));?>
      <? app_header();?>
      <form method="post">
      <div class="list-result app-form">
          <label for="recorddate">Record Date: </label>
            <input type="date" name="recorddate" id="recorddate" placeholder="YYYY-MM-DD">
            <label for="value">Value: </label>
            <input type="text" name="value" id="value">
            <label for="value">Comment: </label>
            <input type="text" name="comment" id="comment">
            <input type="hidden" name="bucketentryid" value="<? echo $vaultentry[0]['bucketentryid'] ?>">
            <input type="hidden" name="vaultid" value="<? echo $vaultentry[0]['vaultid']?>">
            <input type="hidden" name="action" value="edit"><input type="submit" value="Create Entry">
      </div>
      </form>
    <? break; ?>
    <?  case 'edit': ?>
        <? $vaultentry = app_get_vaultentry_by_id($id);?>
        <?  app_head('Journal Dashboard', Array('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min', 
      './css/style',));?>
        <? app_header();?>
        <form method="post">
          <div class="list-result app-form">
            <label for="recorddate">Record Date: </label>
            <input type="date" name="recorddate" id="recorddate" placeholder="YYYY-MM-DD" value="<? echo $vaultentry[0]['recorddate'] ?>">
            <label for="value">Value: </label>
            <input type="text" name="value" id="value" value="<? echo $vaultentry[0]['value'] ?>">
             <label for="value">Comment: </label>
            <input type="text" name="comment" id="comment" value="<? echo $vaultentry[0]['comment'] ?>">
            <input type="hidden" name="bucketentryid" value="<? echo $vaultentry[0]['bucketentryid'] ?>">
            <input type="hidden" name="vaultid" value="<? echo $vaultentry[0]['vaultid']?>">
            <input type="hidden" name="action" value="edit">
            <input type="submit" value="Edit Entry">
          </div>
        </form>
    <?  break; ?>
    <? endswitch;?>

<?

    app_footer();
  }
  else{
    header('location:./');
  }
}
else{
  header('location:./');
}
?>