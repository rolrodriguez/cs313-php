<?php
  $assignments = [
    "W02" => [
      "Group assignment" => "./W02/groupAssignment/",
      "Assignment: Home" => "/"
    ],
    "W03" => [
      "Group assignment" => "./W03/groupAssignment/",
      "Assignment: Shopping Cart" => "./W03/assignment/browseItems.php"
    ],
    "W05" => [
      "Assignment: DB" => "./W05/"
    ]
  ]
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CSE 341 - Rolando Rodriguez - Assignments</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
  

  <div id="container">
  <?php
    include_once('./partials/header.php');
  ?>
  <main>
    
      <ul>
      <? foreach ($assignments as $period => $assignment) :?>
        <li><? echo $period ?></li>
        <ul>
          <? foreach ($assignment as $name => $url) : ?>
                <li><a href="<? echo $url; ?>"><? echo $name; ?></a></li>
          <? endforeach ?>
        </ul>
      <? endforeach ?>
      </ul>
  </main>
  <?php
    include_once('./partials/footer.php');
    ?>
  </div>

</body>
<script src="./js/main.js"></script>
</html> 