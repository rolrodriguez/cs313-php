<?php
require_once('./app.php');
session_start();
$userID = $_SESSION['userid'];

if(isset($userID)){
  $user = app_get_userdata_from_id($userID);
  $journalID = $_GET['journal'];
  if (!isset($journalID)){
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
      <div class="search-box">
        <form method="get" action="<? echo '.'.$_SERVER['host'].$_SERVER['REQUEST_URI']; ?>">
          <div class="search-bar">
            <input type="text" name="title" id="journal-search">
            <i class="search-icon fa fa-search"></i> 
          </div>
          <input id="search-submit" type="submit" value="Search">
          <input type="hidden" name="journal" value="<? echo $_GET['journal']?>">
        </form>
      </div>
      <div class="results">
        <?
        
          $search = cleanData($_GET['title']);
          if (isset($search) && !empty($search)){
            app_get_journalentries_from_journal($journalID, $search); 
          }
          else{
            app_get_journalentries_from_journal($journalID); 
          }
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