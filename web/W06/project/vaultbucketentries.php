<?php
require_once('./app.php');
session_start();
$userID = $_SESSION['userid'];

if(isset($userID)){
  $user = app_get_userdata_from_id($userID);
  $vaultID = $_GET['vault'];
  if (!isset($vaultID)){
    header('location:./vaultbuckets.php');
  }
  if(isset($user)){
    app_head('Vault Bucket Entries', 
    Array(
    'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min', 
    './css/style',));
    app_header();
    ?>
    
    <main>
      <div class="search-box">
        <form method="get" action="<? echo '.'.$_SERVER['host'].$_SERVER['REQUEST_URI']; ?>">
          <div class="search-bar">
            <input type="text" name="title" id="journal-search" autocomplete="off">
            <i class="search-icon fa fa-search"></i> 
          </div>
          <input id="search-submit" type="submit" value="Search">
          <input type="hidden" name="vault" value="<? echo $_GET['vault']?>">
        </form>
      </div>
      <div class="results">
        <div class="title-container"><h2 class="results-title">Vault Bucket Entries</h2>  <a href='./editvaultbucketentry.php?action=new&vaultid=<? echo $_GET['vault']?>'> Add new</a></div>
        <?
        
          $search = cleanData($_GET['title']);
          if (isset($search) && !empty($search)){
            app_get_vaultbucketentries_from_vault($vaultID, $search); 
          }
          else{
            app_get_vaultbucketentries_from_vault($vaultID); 
          }
        ?>
        <p class="returns"><a href="./vaultbucketentries.php?">Return to your vault buckets</a></p>
       
      </div>
    </main>
    <?

    app_footer(['https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js', './js/main.js']);
  }
  else{
    header('location:./');
  }
}
else{
  header('location:./');
}



?>