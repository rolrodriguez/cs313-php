<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Display Scripture & topic</title>
</head>
<body>
  <?php
    require('db.php');

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


    

  ?>
</body>
</html>