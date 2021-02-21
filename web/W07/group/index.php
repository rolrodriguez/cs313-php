<?
require_once('db.php');

$action = $_GET['action'];
session_start();

if($action == 'logout'){
  session_destroy();
  header('Location: ./');
  die();
}

if(isset($_SESSION['userid'])){
  header('Location: ./welcome.php');
}

$user = cleanData($_POST['user']);
$pass = cleanData($_POST['pass']);

if(!empty($user) && !empty($pass)){
  $db = dbConnect();

  $stmt = $db->prepare("SELECT * from W07_users WHERE username = :username");
  $stmt->bindValue(':username', $user);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if(password_verify($pass, $results[0]['password'])){
    $_SESSION['userid'] = $results[0]['id'];
    header('Location: ./welcome.php');
    die();
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  <div id="container">
    <div id="form-box">
    
      <form method="post">
        <h3>Log in</h3>
        <label for="user">User:</label>
        <input type="text" name="user" id="user">
        <label for="pass">Password:</label>
        <input type="password" name="pass" id="pass">
        <input type="submit" value="Log In">
      </form>
    </div>
    <div id="form-footer">
      <p>Or <a href="register.php">sign in</a></p>
    </div>
  </div>
</body>
</html>