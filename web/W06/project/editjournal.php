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
      if(empty($_POST['journalname']) || empty($_POST['journaldescription'])){
        header('Location:./editjournal.php?action=new');
      }
      else{
        app_add_journal($userID, $_POST);
        header('Location:./journals.php');
      }
      break;
      case 'edit':
      if(empty($_POST['journalname']) || empty($_POST['journaldescription'])){
        header('Location:./editjournal.php?action=edit&id='.$_POST['journalid']);
      }
      else{
        app_update_journal($userID, $_POST);
        header('Location:./journals.php');
      }
      break;
    }

    // Check if the address to edit a journal is valid
    $action = $_GET['action'];
    $id = $_GET['id'];
    if(empty($action) || ( $action == 'edit' && empty($id)) || !($action == 'edit' || $action == 'new' )){
      header('Location:./journals.php');
    }
    switch($action):
    case 'new':?>
       <?  app_head('Journal Dashboard', Array('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min', 
    './css/style',));?>
      <? app_header();?>
      <form method="post">
      <div class="list-result app-form">
          <label for="journalname">Journal Name: </label>
          <input type="text" name="journalname" id="journalname">
          <label for="journaldescription">Journal Description: </label>
          <input type="text" name="journaldescription" id="journaldescription">
          <input type="hidden" name="action" value="new">
          <input type="submit" value="Create Journal">
      </div>
      </form>
    <? break; ?>
    <?  case 'edit': ?>
        <? $journal = app_get_journal_by_id($id); ?>
        <?  app_head('Journal Dashboard', Array('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min', 
      './css/style',));?>
        <? app_header();?>
        <form method="post">
          <div class="list-result app-form">
            <label for="journalname">Journal Name: </label>
            <input type="text" name="journalname" id="journalname" value="<? echo $journal[0]['journalname'] ?>">
            <label for="journaldescription">Journal Description: </label>
            <input type="text" name="journaldescription" id="journaldescription" value="<? echo $journal[0]['journaldescription'] ?>">
            <input type="hidden" name="journalid" value="<? echo $journal[0]['journalid'] ?>">
            <input type="hidden" name="action" value="edit">
            <input type="submit" value="Edit Journal">
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