<?php
/**
 * Create and edit journal entries
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
      if(empty($_POST['entrytitle']) || empty($_POST['entrytext'])){
        header('Location:./editjournalentry.php?action=new');
        die();
      }
      else{
        app_add_journalentry($_POST);
        header('Location:./journalentries.php?journal='.$_POST['journalid']);
        die();
      }
      break;
      case 'edit':
      if(empty($_POST['entrytitle']) || empty($_POST['entrytext'])){
        header('Location:./editjournalentry.php?action=edit&id='.$_POST['journalentryid']);
        die();
      }
      else{
        app_update_journalentry($_POST);
        header('Location:./journalentries.php?journal='.$_POST['journalid']);
        die();
      }
      break;
    }

    // Check if the address to edit a journal is valid
    $action = $_GET['action'];
    $id = $_GET['id'];
    if(empty($action) || ( $action == 'edit' && empty($id)) || !($action == 'edit' || $action == 'new' )){
      header('Location:./journalentries.php');
      die();
    }
    switch($action):
    case 'new':?>
       <?  app_head('Journal Dashboard', Array('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min', 
    './css/style',), true);?>
      <? app_header();?>
      <form method="post">
      <div class="list-result app-form">
          <label for="entrytitle">Entry title: </label>
          <input type="text" name="entrytitle" id="entrytitle" required>
          <label for="entrytext">Entry text: </label>
          <textarea name="entrytext" id="entrytext" rows="10" required></textarea>
          <input type="hidden" name="action" value="new">
          <input type="hidden" name="journalid" value="<? echo $_GET['journalid']?>">
          <input type="submit" class="btn-dark" value="Create Entry">
      </div>
      </form>
    <? break; ?>
    <?  case 'edit': ?>
        <? $journalentry = app_get_journalentry_by_id($id);?>
        <?  app_head('Journal Dashboard', Array('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min', 
      './css/style',));?>
        <? app_header();?>
        <form method="post">
          <div class="list-result app-form">
            <label for="entrytitle">Entry title: </label>
            <input type="text" name="entrytitle" id="entrytitle" value="<? echo $journalentry[0]['entrytitle'] ?>" required>
            <label for="entrytext">Journal Description: </label>
            <textarea name="entrytext" id="entrytext" rows="10" required><? echo $journalentry[0]['entrytext'] ?></textarea>
            <input type="hidden" name="journalentryid" value="<? echo $journalentry[0]['journalentryid'] ?>">
            <input type="hidden" name="journalid" value="<? echo $journalentry[0]['journalid']?>">
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