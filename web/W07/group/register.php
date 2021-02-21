<?
require_once('db.php');

$user = cleanData($_POST['user']);
$pass = cleanData($_POST['pass']);
$passconfirm = cleanData($_POST['passconfirm']);
$validationPass = '';
if(!empty($user) && !empty($pass) && $pass == $passconfirm){
  $db = dbConnect();

  $stmt = $db->prepare("INSERT INTO W07_users (username, password, createdon) VALUES (:username, :password, NOW())");
  $stmt->bindValue(':username', $user);
  $stmt->bindValue(':password', password_hash($pass,PASSWORD_DEFAULT));
  $stmt->execute();
  
  header('Location: ./index.php');
  die();
}
elseif($pass != $passconfirm){
 $validationPass = "*Passwords do not match";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
</head>
<body>
  <div id="container">
    <div id="form-box">
      <form method="post">
        <h3>Register</h3>
        <label for="user">User:</label>
        <input type="text" name="user" id="user">
        <label for="pass">Password:</label>
        <input type="password" name="pass" id="pass">
        <label for="passconfirm">Password Confirmation: <span style="color: red;"><? echo $validationPass ?></span></label>
        <input type="password" name="passconfirm" id="pass">
        <input type="submit" value="Log In">
      </form>
    </div>
  </div>
</body>
</html>