<?php

  function cleanData($input){
    $clean = trim($input);
    $clean = stripslashes($clean);
    $clean = htmlspecialchars($clean);
    return $clean;
  }

?>