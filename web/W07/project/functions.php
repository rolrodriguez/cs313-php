<?php

/**
 * Returns a connection to a database. The Url is defined as a environment variable
 */
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

/**
 * Clean data to process forms
 */
function cleanData($input){
    $clean = trim($input);
    $clean = stripslashes($clean);
    $clean = htmlspecialchars($clean);
    return $clean;
}




?>