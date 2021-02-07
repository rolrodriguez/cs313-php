<?php
require_once('./app.php');
session_start();
$userID = $_SESSION['userid'];

if(isset($userID)){
  $user = app_get_userdata_from_id($userID);
  $journalEntry = $_GET['journalentry'];
  if (!isset($journalEntry)){
    header('location:./journals.php');
  }
  if(isset($user)){
    app_head('Journal Dashboard', 
    Array(
    'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min', 
    './css/style',));
    app_header();
    ?>
    
    <main>   
      <div class="results">
        <?
          $search = cleanData($_GET['title']);
          app_get_journalentries_from_id($journalEntry);
        ?>
      </div>
    </main>
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