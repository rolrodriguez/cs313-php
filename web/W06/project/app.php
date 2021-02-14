<?
// Dependencies
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
<? function app_foot($array=[]){?>
      </div>
      <? foreach($array as $item): ?>
        <script src="<? echo $item ?>"></script>
      <? endforeach; ?>
      </body>
      </html>
<?}?>
<? function app_header(){ ?>
        <header>
          <nav>
            <ul>
              <li><a href="./journals.php"> <i class="fa fa-home" aria-hidden="true"></i> Home</a> | </li>
              <li><a href="./vaultbuckets.php"> <i class="fa fa-archive" aria-hidden="true"></i> VaultBuckets</a> | </li>
              <li><a href="./logout.php"> <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
            </ul>
          </nav>
        </header>
<? } ?>
<? function app_footer($array=[]){ ?>  
  <footer>
    Journalese &copy; <? echo date('Y'); ?>
  </footer>
  <? app_foot($array); ?>
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
  <!-- <div id="link-register">Or create a new account <a href="./newuser.php">here</a></div> -->
<? } ?>
<? function app_register(){?>
  <div id="app-login-box">
    <h2 id="app-title">Journalese</h2>
    <i class="fa fa-book" aria-hidden="true"></i>
    <form method="POST" action="./">
      <label class="app-login-element" for="username">Username: </label>
        <input type="text" class="app-login-element" name="username" id="username" placeholder="Your username" autocomplete="off">
      <label class="app-login-element" for="password">Password: </label>
        <input type="password" class="app-login-element" name="password" id="password" placeholder="Your password">
      <label class="app-login-element" for="password">Password: </label>
        <input type="password" class="app-login-element" name="password-confirmation" id="password-confirmation" placeholder="Confirm your password">
      
      <button class="app-login-element" type="submit">Login</button>
    </form>
  </div>
<?}?>
<? function app_get_journals_by_userid($userid, $searchString=null){
      $db = dbConnect();
      if(!is_null($searchString)){
        $stmt = $db->query("select * from journals where userid = '$userid' and lower(journalname) LIKE lower('%$searchString%') order by lastmodifiedon");
      }
      else{
        $stmt = $db->query("select * from journals where userid = '$userid' order by lastmodifiedon DESC");
      }
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result as $row):?>

        <div class="list-result">
          <h3><a href="./journalentries.php?journal=<? echo urlencode($row['journalid']) ?>"><? echo $row['journalname'] ?></a></h3>
           <a class="link-edit" href="./editjournal.php?action=edit&id=<? echo urlencode($row['journalid']) ?>"><i class="fa fa-pencil icon-edit"></i></a> 
           <p><? echo $row['journaldescription'] ?></p>
          <p>Created on: <span> <? echo date('Y-m-d h:i a', strtotime($row['createdon'])) ?></span></p>
          <p>Last Modified on: <span> <? echo date('Y-m-d h:i a', strtotime($row['lastmodifiedon'])) ?></span></p>
          <i class="fa fa-trash icon-delete" data-id="journalid=<? echo urlencode($row['journalid']) ?>"></i>
        </div>

<? endforeach; }  ?>
<? function app_get_journalentries_from_journal($journalid, $searchString=null){ 
      $db = dbConnect();
      if(!is_null($searchString)){
        $stmt = $db->query("select * from journalentries where journalid = '$journalid' and lower(entrytitle) LIKE lower('%$searchString%') order by lastmodifiedon");
      }
      else{
        $stmt = $db->query("select * from journalentries where journalid = '$journalid' order by lastmodifiedon DESC");
      }
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result as $row):?>

        <div class="list-result">
          <h3><a href="./journalentrydetail.php?journalentry=<? echo urlencode($row['journalentryid']) ?>"><? echo $row['entrytitle'] ?></a></h3> 
          <a class="link-edit" href="./editjournalentry.php?action=edit&id=<? echo urlencode($row['journalentryid']) ?>"><i class="fa fa-pencil icon-edit"></i></a> 
          <p><? echo substr($row['entrytext'], 0, 50).'...' ?></p>
          <p>Created on: <span> <? echo date('Y-m-d h:i a', strtotime($row['createdon'])) ?></span></p>
          <p>Last Modified on: <span> <? echo date('Y-m-d h:i a', strtotime($row['lastmodifiedon'])) ?></span></p>
          <i class="fa fa-trash icon-delete" data-journalid="journalid=<? echo urlencode($row['journalid']) ?>" data-id="journalentryid=<? echo urlencode($row['journalentryid']) ?>"></i>
        </div>  
<? endforeach; } ?>
<? function app_get_journalentries_from_id($id){ 
      $db = dbConnect();
      $stmt = $db->query("select * from journalentries where journalentryid = '$id' order by lastmodifiedon DESC");
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
        $stmt = $db->query("select * from vaultbuckets where userid = '$userid' order by lastmodifiedon DESC");
      }
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result as $row):?>

        <div class="list-result">
          <h3><a href="./vaultbucketentries.php?vault=<? echo urlencode($row['vaultid']) ?>"><? echo $row['vaultname'] ?></a></h3>
          <a class="link-edit" href="./editvaultbucket.php?action=edit&id=<? echo urlencode($row['vaultid']) ?>"><i class="fa fa-pencil icon-edit"></i></a> 
          <p>Created on: <span> <? echo date('Y-m-d h:i a', strtotime($row['createdon'])) ?></span></p>
          <p>Last Modified on: <span> <? echo date('Y-m-d h:i a', strtotime($row['lastmodifiedon'])) ?></span></p>
          <i class="fa fa-trash icon-delete" data-id="vaultid=<? echo urlencode($row['vaultid']) ?>"></i>
        </div>

<? endforeach; }  ?>
<? function app_get_vaultbucketentries_from_vault($vaultid, $searchString=null){ 
      $db = dbConnect();
      if(!is_null($searchString)){
        $stmt = $db->query("select * from vaultbucketsentries where vaultid = '$vaultid' and lower(value) LIKE lower('%$searchString%') order by lastmodifiedon");
      }
      else{
        $stmt = $db->query("select * from vaultbucketsentries where vaultid = '$vaultid' order by lastmodifiedon DESC");
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
          <th>Edit</th>
          <th>Delete</th>
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
          <td><a class="link-edit" href="./editvaultbucketentry.php?action=edit&id=<? echo urlencode($row['bucketentryid']) ?>"><i class="fa fa-pencil icon-edit"></i></a></td>
          <td><i class="fa fa-trash icon-delete" data-vaultid="vaultid=<? echo urlencode($row['vaultid']) ?>" data-id="bucketentryid=<? echo urlencode($row['bucketentryid']) ?>"></i></td>
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

  function app_update_journal($userID, $formData){
    try {
      $db = dbConnect();
      $journalid = cleanData($formData['journalid']);
      $journalname = cleanData($formData['journalname']);
      $journaldescription = cleanData($formData['journaldescription']);
      $stmt = $db->prepare("UPDATE journals SET journalname = :journalname, journaldescription = :journaldescription, lastmodifiedon = NOW() WHERE journalid = :id and userid = :userid");
      $stmt->bindValue(':journalname', $journalname);
      $stmt->bindValue(':journaldescription', $journaldescription);
      $stmt->bindValue(':id', $journalid);
      $stmt->bindValue(':userid', $userID);
      $stmt->execute();
    } catch (PDOException $ex) {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }
  }

  function app_update_vaultbucket($userID, $formData){
    try {
      $db = dbConnect();
      $vaultid = cleanData($formData['vaultid']);
      $vaultname = cleanData($formData['vaultname']);
      $stmt = $db->prepare("UPDATE vaultbuckets SET vaultname = :vaultname, lastmodifiedon = NOW() WHERE vaultid = :id and userid = :userid");
      $stmt->bindValue(':vaultname', $vaultname);
      $stmt->bindValue(':id', $vaultid);
      $stmt->bindValue(':userid', $userID);
      $stmt->execute();
    } catch (PDOException $ex) {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }
  }

  function app_update_journalentry($formData){
    try {
      $db = dbConnect();
      $journalentryid = cleanData($formData['journalentryid']);
      $entrytitle = cleanData($formData['entrytitle']);
      $entrytext = cleanData($formData['entrytext']);
      $stmt = $db->prepare("UPDATE journalentries SET entrytitle = :entrytitle, entrytext = :entrytext, lastmodifiedon = NOW() WHERE journalentryid = :id");
      $stmt->bindValue(':entrytitle', $entrytitle);
      $stmt->bindValue(':entrytext', $entrytext);
      $stmt->bindValue(':id', $journalentryid);
      $stmt->execute();
    } catch (PDOException $ex) {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }
  }

  function app_update_vaultbucketentry($formData){
    try {
      $db = dbConnect();
      $bucketentryid = cleanData($formData['bucketentryid']);
      $recorddate = cleanData($formData['recorddate']);
      $value = cleanData($formData['value']);
      $comment = cleanData($formData['comment']);
      $stmt = $db->prepare('UPDATE vaultbucketsentries SET recorddate = :recorddate, value = :value, comment = :comment, lastmodifiedon = NOW() WHERE bucketentryid = :id');
      $stmt->bindValue(':recorddate', $recorddate);
      $stmt->bindValue(':value', $value);
      $stmt->bindValue(':comment', $comment);
      $stmt->bindValue(':id', $bucketentryid);
      $stmt->execute();
    } catch (PDOException $ex) {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }
  }

  function app_add_journal($userID, $formData){
    try {
      $db = dbConnect();
      $journalname = cleanData($formData['journalname']);
      $journaldescription = cleanData($formData['journaldescription']);
      $stmt = $db->prepare("INSERT INTO journals (journalname, journaldescription, userid, createdon, lastmodifiedon) VALUES (:journalname, :journaldescription, :userid, NOW(), NOW())");
      $stmt->bindValue(':journalname', $journalname);
      $stmt->bindValue(':journaldescription', $journaldescription);
      $stmt->bindValue(':userid', $userID);
      $stmt->execute();
    } catch (PDOException $ex) {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }
  }

    function app_add_vaultbucket($userID, $formData){
    try {
      $db = dbConnect();
      $vaultname = cleanData($formData['vaultname']);
      $stmt = $db->prepare("INSERT INTO vaultbuckets (vaultname, userid, createdon, lastmodifiedon) VALUES (:vaultname, :userid, NOW(), NOW())");
      $stmt->bindValue(':vaultname', $vaultname);
      $stmt->bindValue(':userid', $userID);
      $stmt->execute();
    } catch (PDOException $ex) {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }
  }


  function app_add_journalentry($formData){
    try {
      $db = dbConnect();
      $entrytitle = cleanData($formData['entrytitle']);
      $entrytext = cleanData($formData['entrytext']);
      $journalid = cleanData($formData['journalid']);
      $stmt = $db->prepare("INSERT INTO journalentries (journalid, entrytitle, entrytext, createdon, lastmodifiedon) VALUES (:journalid, :entrytitle, :entrytext, NOW(), NOW())");
      $stmt->bindValue(':journalid', $journalid);
      $stmt->bindValue(':entrytitle', $entrytitle);
      $stmt->bindValue(':entrytext', $entrytext);
      $stmt->execute();
    } catch (PDOException $ex) {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }
  }

  function app_add_vaultbucketentry($formData){
    try {
      $db = dbConnect();
      $recorddate = cleanData($formData['recorddate']);
      $value = cleanData($formData['value']);
      $vaultid = cleanData($formData['vaultid']);
      $comment= cleanData($formData['comment']);
      $stmt = $db->prepare("INSERT INTO vaultbucketsentries (vaultid, recorddate, value, comment, createdon, lastmodifiedon) VALUES (:vaultid, :recorddate, :value, comment, NOW(), NOW())");
      $stmt->bindValue(':vaultid', $vaultid);
      $stmt->bindValue(':recorddate', $recorddate);
      $stmt->bindValue(':value', $value);
      $stmt->bindValue(':comment', $comment);
      $stmt->execute();
    } catch (PDOException $ex) {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }
  }

  function app_delete_journal($userID, $journalID){
    try {
      $db = dbConnect();
      $stmt = $db->prepare("DELETE FROM journalentries WHERE journalid = :journalID");
      $stmt->bindValue(':journalID', $journalID);
      $stmt->execute();


      $stmt = $db->prepare("DELETE FROM journals WHERE journalid = :journalID and userid = :userID");
      $stmt->bindValue(':journalID', $journalID);
      $stmt->bindValue(':userID', $userID);
      $stmt->execute();
    } catch (PDOException $ex) {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }
  }

  function app_delete_vaultbucket($userID, $vaultID){
    try {
      $db = dbConnect();
      $stmt = $db->prepare("DELETE FROM vaultbucketsentries WHERE vaultid = :vaultID");
      $stmt->bindValue(':vaultID', $journalID);
      $stmt->execute();


      $stmt = $db->prepare("DELETE FROM vaultbuckets WHERE vaultid = :vaultID and userid = :userID");
      $stmt->bindValue(':vaultID', $vaultID);
      $stmt->bindValue(':userID', $userID);
      $stmt->execute();
    } catch (PDOException $ex) {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }
  }

  function app_delete_journalentry($journalID, $journalentryID){
    try {
      $db = dbConnect();
      $stmt = $db->prepare("DELETE FROM journalentries WHERE journalid = :journalid and journalentryid = :journalentryid");
      $stmt->bindValue(':journalid', $journalID);
      $stmt->bindValue(':journalentryid', $journalentryID);
      $stmt->execute();
    } catch (PDOException $ex) {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }
  }

  function app_delete_vaultbucketentry($vaultID, $bucketentryID){
    try {
      $db = dbConnect();
      $stmt = $db->prepare("DELETE FROM vaultbucketsentries WHERE vaultid = :vaultid and bucketentryid = :bucketentryid");
      $stmt->bindValue(':vaultid', $vaultID);
      $stmt->bindValue(':bucketentryid', $bucketentryID);
      $stmt->execute();
    } catch (PDOException $ex) {
      echo 'Error!: ' . $ex->getMessage();
      die();
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

  function app_get_journal_by_id($id){
      $db = dbConnect();
      $stmt = $db->query("select * from journals where journalid = '$id'"); 
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
  }

  function app_get_vaultbucket_by_id($id){
      $db = dbConnect();
      $stmt = $db->query("select * from vaultbuckets where vaultid = '$id'"); 
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
  }

  function app_get_journalentry_by_id($id){
      $db = dbConnect();
      $stmt = $db->query("select * from journalentries where journalentryid = '$id'"); 
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
  }

  function app_get_vaultentry_by_id($id){
      $db = dbConnect();
      $stmt = $db->query("select * from vaultbucketsentries where bucketentryid = '$id'"); 
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
  }
?>