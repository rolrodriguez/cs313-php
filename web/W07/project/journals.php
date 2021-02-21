<?php
require_once('./app.php');
session_start();
$userID = $_SESSION['userid'];
if(isset($userID)){
  $user = app_get_userdata_from_id($userID);
  if(isset($user)){
    app_head('Journal Dashboard', 
    Array(
    'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min', 
    './css/style'), true);
    app_header();
    ?>
    <main>
      <div class="search-box">
        <form method="get" action="./journals.php">
          <div class="search-bar">
            <input type="text" name="title" id="journal-search" autocomplete="off">
            <i class="search-icon fa fa-search"></i> 
          </div>
          <input id="search-submit" type="submit" value="Search">
        </form>
      </div>
      <div class="results">
        
        <div class="title-container"><h2 class="results-title">Journals</h2> <a href='./editjournal.php?action=new'> Add new</a></div>
        <? 
        $search = cleanData($_GET['title']);
        if (isset($search) && !empty($search)){
          app_get_journals_by_userid($userID, $search); 
        }
        else{
          app_get_journals_by_userid($userID); 
        }
        ?>
      </div>
    </main>
    <?

    app_footer(['https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js', './js/main.js']);
  }
  else{
    session_destroy();
    header('location:./');
    die();
  }
}
else{
  header('location:./');
  die();
}



?>