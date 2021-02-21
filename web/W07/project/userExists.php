<?php
require 'app.php';
/**
 * Short script to be called by javascript to confirm if the username exists
 */
if($_SERVER['REQUEST_METHOD'] = 'GET'){
  $username = $_GET['username'];
  echo userExists($username);
}
?>