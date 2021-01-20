<?
$majors = ['Computer Science', 'Web Design and Development', 'Computer information Technology', 'Computer Engineering'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>W03 group assignment</title>
</head>
<body>
  <form action="result.php" method="post">
    <label for="name">Name: </label>
    <input type="text" name="name" id="name"></input>
    <label for="email">Email: </label>
    <input type="text" name="email" id="email"></input><br/>
    <label for="major">Major: </label><br/>
    <?
    foreach($majors as $id=>$major){

    $str = <<<EOT
    <input type="radio" name="major" value="${major}" id=${id}><label for="${id}">${major}</label></input><br/>
EOT;
    echo $str;
    }
    ?>

    <label for="continents[]">Continents visited: </label><br/>
    <input type="checkbox" name="continents[]" value="NA" id="cont_1"><label for="cont_1">North America</label></input><br />
    <input type="checkbox" name="continents[]" value="SA" id="cont_2"><label for="cont_2">South America</label></input><br />
    <input type="checkbox" name="continents[]" value="EU" id="cont_3"><label for="cont_3">Europe</label></input><br />
    <input type="checkbox" name="continents[]" value="AS" id="cont_4"><label for="cont_4">Asia</label></input><br />
    <input type="checkbox" name="continents[]" value="AU" id="cont_5"><label for="cont_5">Australia</label></input><br />
    <input type="checkbox" name="continents[]" value="AF" id="cont_6"><label for="cont_6">Africa</label></input><br />
    <input type="checkbox" name="continents[]" value="AN" id="cont_7"><label for="cont_7">Antartica</label></input><br />
     <br />
    <textarea name="comments" id="" cols="30" rows="10" placeholder="Comments" style="resize:none;"></textarea><br />
    <input type="submit" value="Submit"></input>
  </form>
</body>
</html>