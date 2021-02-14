<?
  if(isset($_POST)){
    
    try{
      require('./db.php');
    
    $book = $_POST['book'];
    $chapter = $_POST['chapter'];
    $verse = $_POST['verse'];
    $content = $_POST['content'];
    $topics = $_POST['topics'];
    $newtopiccheck = $_POST['newtopiccheck'];
    $newtopic = $_POST['newtopic'];
    
   


    $db = dbConnect();
    $sql = 'INSERT INTO scripture(book, chapter, verse, content) VALUES (:book, :chapter, :verse, :content)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':book', $book);
    $stmt->bindValue(':chapter', $chapter);
    $stmt->bindValue(':verse', $verse);
    $stmt->bindValue(':content', $content);

    $stmt->execute();

    $scriptureID = $db->lastInsertId('scripture_id_seq');
    
    if($newtopiccheck=='on' and !empty($newtopic)){
      $stmt = $db->prepare('INSERT INTO topic (name) VALUES (:name)');
      $stmt->bindValue(':name', $newtopic);
      $stmt->execute();
      
      $lasttopicID = $db->lastInsertId('topic_id_seq');
      if(is_null($topics)){
        $topics= array();
      }
      
      array_push($topics, $lasttopicID);
      
      
    } 



      foreach($topics as $topic){
        $stmt = $db->prepare('INSERT INTO linktable (scriptureID, topicID) VALUES (:scripture, :topic)');
        $stmt->bindValue(':scripture', $scriptureID);
        $stmt->bindValue(':topic', $topic);
        $stmt->execute();


      }
    }
    catch(Exception $ex){
      echo "Error with DB. Details: $ex";
	    die();
    }
    header('Location: ./index.php');
    die();
  }
?>