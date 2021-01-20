<?php
  function cleanData($input){
    $clean = trim($input);
    $clean = stripslashes($clean);
    $clean = htmlspecialchars($clean);
    return $clean;
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Result</title>
</head>
<body>

<p>

<?php

if($_SERVER['REQUEST_METHOD']=='POST'){

$name = cleanData($_POST['name']);
$email = cleanData($_POST['email']);
$major = cleanData($_POST['major']);
$continents = $_POST['continents'];
$comments = $_POST['comments'];
$cont_Array = [
  "NA" => "North America",
  "SA" => "South America",
  "EU" => "Europe",
  "AS" => "Asia",
  "AU" => "Australia",
  "AF" => "Africa",
  "AN" => "Antartica"
];


  $output= <<<EOD
Your name is: ${name} <br />
Your email is: ${email} <br />
Your major is: ${major} <br />
You have visited:<br />
EOD;

foreach($continents as $continent){
  $output.=$cont_Array[cleanData($continent)].'<br/>';
}
$output.="Comments: ${comments} <br />";
echo $output;

}
  
?>

</p>
  
<a href="./">Return to index</a>
</body>
</html>