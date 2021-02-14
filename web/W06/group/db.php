<?

// export DATABASE_URL='postgres://postgres@localhost:5432/postgres'

function dbConnect(){
  $db = null;
  try
  {
    $dbUrl = getenv('DATABASE_URL');
  
    $dbOpts = parse_url($dbUrl);
 
    $dbHost = $dbOpts["host"];
    $dbPort = $dbOpts["port"];
    $dbUser = $dbOpts["user"];
    $dbPassword = $dbOpts["pass"];
    $dbName = ltrim($dbOpts["path"],'/');

    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  }
  catch (PDOException $ex)
  {
    echo 'Error!: ' . $ex->getMessage();
    die();
  }
  return $db;
}

function get_topics(){
    $db = dbConnect();

    $stmt = $db->query('select * from topic');
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function displayTopicsAsCheckboxes(){
    $array = get_topics();
    foreach($array as $row){  ?>
    <input type="checkbox" name="topics[]" id="topic_<? echo $row['id'] ?>" value="<? echo $row['id'] ?>">
    <label for="topic_<? echo $row['id'] ?>"><? echo $row['name'] ?></label><br />
  <?}
}

function getScriptures(){
    $db = dbConnect();

    // Print scriptures
    $stmt = $db->query('SELECT id, book, chapter, verse, content from scripture');
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($result as $row){?>
      <p>
        <strong><? echo $row['book'].' '.$row['chapter'].':'.$row['verse'] ?></strong><br/>
        <? echo $row['content'] ?><br/>
        topics:

    <?
          // Print topics
      $stmt = $db->prepare(
        "SELECT name from topic t INNER JOIN linktable lt ON t.id = lt.topicID WHERE lt.scriptureID = :scriptureID"
      );
      $stmt->bindValue(':scriptureID', $row['id']); 
      $stmt->execute(); 

      while($topicRow = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo $topicRow['name'].' ';
      }
      ?>
      </p>
    <?

  }
}

?>