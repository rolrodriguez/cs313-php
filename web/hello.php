<?php
  $date = date('Y-m-d H:i:s a T');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hello World</title>
  <style>
    html{
      width: 100%;
      height: 100%;
      margin: 0;
    }
    body{
      width: 100%;
      height: 100%;
      margin: 0;
      background: #f6f6f6;
    }
    #container{
      width: 600px;
      margin: auto auto;
      border: 1px solid black;
      text-align: center;
    }

    #message{
      background-color: turquoise;
      color: black;
      font-size: 40px;
    }  

    #time{
      background-color: gray;
      font-size: 20px;
      font-family: monospace;
      color: white;
    }
  </style>
</head>
<body>

  <div id="container">
  <div id="message">Hello World!!! <br /> From the Dominican Republic</div>
  <div id="time">
  <?php
    echo "Timestamp: {$date}";
  ?>
  </div>
  </div>
</body>
</html>