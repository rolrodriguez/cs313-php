<?
// Dependencies
// require_once('./config.php');
require_once('./functions.php');
?>
<? function app_head($title, $stylesheets = Array()){ ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    <?php echo $title ?>
    </title>
    <?php foreach($stylesheets as $sheet):?>
        <link rel="stylesheet" href="<?php echo $sheet ?>.css">
    <?php endforeach; ?>
  </head>
  <body>
      <div id="app-container">
<? } ?>
<? function app_header(){ ?>
        <header>
          <nav>
            <ul>
              <li><a href="./journals.php"> <i class="fa fa-home" aria-hidden="true"></i> Home</a> | </li>
              <li><a href="./VaultBuckets.php"> <i class="fa fa-archive" aria-hidden="true"></i> VaultBuckets</a> | </li>
              <li><a href="./logout.php"> <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
            </ul>
          </nav>
        </header>
<? } ?>
<? function app_footer(){ ?>
  
  <footer>
    Journalese &copy; <? echo date('Y'); ?>
  </footer>
  </div>
  </body>
  </html>
<? } ?>
<? function app_login(){ ?>
  <div id="app-login-box">
    <h2 id="app-title">Journalese</h2>
    <i class="fa fa-book" aria-hidden="true"></i>
    <form method="POST" action="./">
      <label class="app-login-element" for="username">Username: </label>
        <input type="text" class="app-login-element" name="username" id="username" placeholder="Your username" autocomplete="off">
      <label class="app-login-element" for="password">Password: </label>
        <input type="password" class="app-login-element" name="password" id="password" placeholder="Your password">
      <button class="app-login-element" type="submit">Login</button>
    </form>
  </div>
<? } ?>
<? function app_get_journals_by_userid($userid, $searchString=null){
      $db = dbConnect();
      if(!is_null($searchString)){
        $stmt = $db->query("select * from journals where userid = '$userid' and lower(journalname) LIKE lower('%$searchString%') order by lastmodifiedon");
      }
      else{
        $stmt = $db->query("select * from journals where userid = '$userid' order by lastmodifiedon");
      }
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result as $row):?>

        <div class="list-result">
          <h3><a href="./journalentries.php?journal=<? echo urlencode($row['journalid']) ?>"><? echo $row['journalname'] ?></a></h3>
          <p><? echo $row['journaldescription'] ?></p>
          <p>Created on: <span> <? echo date('Y-m-d h:i a', strtotime($row['createdon'])) ?></span></p>
          <p>Last Modified on: <span> <? echo date('Y-m-d h:i a', strtotime($row['lastmodifiedon'])) ?></span></p>
        </div>

<? endforeach; }  ?>
<? function app_get_journalentries_from_journal($journalid, $searchString=null){ 
      $db = dbConnect();
      if(!is_null($searchString)){
        $stmt = $db->query("select * from journalentries where journalid = '$journalid' and lower(entrytitle) LIKE lower('%$searchString%') order by lastmodifiedon");
      }
      else{
        $stmt = $db->query("select * from journalentries where journalid = '$journalid' order by lastmodifiedon");
      }
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result as $row):?>

        <div class="list-result">
          <h3><a href="./journalentrydetail.php?journalentry=<? echo urlencode($row['journalentryid']) ?>"><? echo $row['entrytitle'] ?></a></h3>
          <p><? echo substr($row['entrytext'], 0, 50).'...' ?></p>
          <p>Created on: <span> <? echo date('Y-m-d h:i a', strtotime($row['createdon'])) ?></span></p>
          <p>Last Modified on: <span> <? echo date('Y-m-d h:i a', strtotime($row['lastmodifiedon'])) ?></span></p>
        </div>  
<? endforeach; } ?>
<? function app_get_journalentries_from_id($id){ 
      $db = dbConnect();
      $stmt = $db->query("select * from journalentries where journalentryid = '$id' order by lastmodifiedon");
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result as $row):?>

        <div class="list-result detail">
          <h3><? echo $row['entrytitle'] ?></h3>
          <p><? echo $row['entrytext'] ?></p>
          <p>Created on: <span> <? echo date('Y-m-d h:i a', strtotime($row['createdon'])) ?></span></p>
          <p>Last Modified on: <span> <? echo date('Y-m-d h:i a', strtotime($row['lastmodifiedon'])) ?></span></p>
          <p><a href="./journalentries.php?journal=<? echo urlencode($row['journalid']) ?>">Return to journal</a></p>
        </div>  
<? endforeach; } ?>
<? function app_get_vaultbucket_by_userid($userid, $searchString=null){
      $db = dbConnect();
      if(!is_null($searchString)){
        $stmt = $db->query("select * from vaultbuckets where userid = '$userid' and lower(vaultname) LIKE lower('%$searchString%') order by lastmodifiedon");
      }
      else{
        $stmt = $db->query("select * from vaultbuckets where userid = '$userid' order by lastmodifiedon");
      }
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result as $row):?>

        <div class="list-result">
          <h3><a href="./vaultbucketentries.php?vault=<? echo urlencode($row['vaultid']) ?>"><? echo $row['vaultname'] ?></a></h3>
          <p>Created on: <span> <? echo date('Y-m-d h:i a', strtotime($row['createdon'])) ?></span></p>
          <p>Last Modified on: <span> <? echo date('Y-m-d h:i a', strtotime($row['lastmodifiedon'])) ?></span></p>
        </div>

<? endforeach; }  ?>
<? function app_get_vaultbucketentries_from_vault($vaultid, $searchString=null){ 
      $db = dbConnect();
      if(!is_null($searchString)){
        $stmt = $db->query("select * from vaultbucketsentries where vaultid = '$vaultid' and lower(value) LIKE lower('%$searchString%') order by lastmodifiedon");
      }
      else{
        $stmt = $db->query("select * from vaultbucketsentries where vaultid = '$vaultid' order by lastmodifiedon");
      }?>
      <div class="table-box">
      <table class="vault-table">
        <thead>
        <tr>
          <th>Record Date</th>
          <th>Value</th>
          <th>Comment</th>
          <th>Created</th>
          <th>Modified</th>
        </tr>
        </thead><tbody>
      <?
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result as $row):?>

        <tr class="list-row">
          <td><? echo $row['recorddate']; ?></td>
          <td><? echo $row['value']; ?></td>
          <td><? echo $row['comment']; ?></td>
          <td><? echo date('Y-m-d h:i a', strtotime($row['createdon'])); ?></td>
          <td><? echo date('Y-m-d h:i a', strtotime($row['lastmodifiedon'])); ?></td>
        </tr>  
<? endforeach; ?>
      </tbody></table></div>
<? } ?>
<?
  function app_processLogin(){
      session_start();
      if(isset($_SESSION['userid'])){
        header('location:./journals.php');
      }
      if(isset($_POST['username']) && isset($_POST['password'])){
        $user = cleanData($_POST['username']);
        $pass = cleanData($_POST['password']);
         if(!empty($user) && !empty($pass)){
          $userID = app_get_userid_from_credentials($user, $pass);
          if(!empty($userID)){     
            $_SESSION['userid'] = $userID;
            app_update_user_field($userID, "lastloggedon", 'NOW()');
            header('location:./journals.php');
            
          }
          else{
            echo "The username and password provided are not valid credentials";
          }
         }
      }
  }

  function app_get_userid_from_credentials($user, $pass){
    $db = dbConnect();
    $hashPass = hash('sha256', $pass);
    $stmt = $db->query("SELECT userid FROM users WHERE username = '$user' and password = '$hashPass'");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result[0]['userid'];
  }

  function app_get_userdata_from_id($id){
    $db = dbConnect();
    $stmt = $db->query("SELECT * FROM users WHERE userid = '$id'");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $user = null;
    if (isset($result)){
      unset($result[0]['password']);
      unset($result[0]['userid']);
      $user = $result[0];
    }
    return $user;

  }

  function app_update_user_field($id, $fieldName, $valueExpression){
    $db = dbConnect();
    $stmt = $db->query("UPDATE users SET ${fieldName} = ${valueExpression} WHERE userid = '${id}'");
  }

?>