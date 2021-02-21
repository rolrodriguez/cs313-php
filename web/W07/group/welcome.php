<?
session_start();
if(!isset($_SESSION['userid'])){
  header('Location: ./');
  die();
}
else{
  require_once('db.php');
  $db = dbConnect();
  $id = $_SESSION['userid'];
  $stmt = $db->prepare('SELECT username FROM W07_users WHERE id = :id');
  $stmt->bindValue(':id', $id);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Welcome <? echo $results[0]['username'];  ?></h1>

  <a href="./index.php?action=logout">Log out</a>
</body>
</html>