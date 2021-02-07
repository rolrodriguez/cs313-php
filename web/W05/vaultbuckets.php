<?php
require_once('./app.php');
session_start();
$userID = $_SESSION['userid'];

if(isset($userID)){
  $user = app_get_userdata_from_id($userID);
  if(isset($user)){
    app_head('Vault Buckets', 
    Array(
    'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min', 
    './css/style',));
    app_header();
    ?>
    <main>
      <div class="search-box">
        <form method="get" action="./vaultbuckets.php">
          <div class="search-bar">
            <input type="text" name="title" id="journal-search" autocomplete="off">
            <i class="search-icon fa fa-search"></i> 
          </div>
          <input id="search-submit" type="submit" value="Search">
        </form>
      </div>
      <div class="results">
        <h2 class="results-title">Vault Buckets</h2>
        <? 
        $search = cleanData($_GET['title']);
        if (isset($search) && !empty($search)){
          app_get_vaultbucket_by_userid($userID, $search); 
        }
        else{
          app_get_vaultbucket_by_userid($userID); 
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