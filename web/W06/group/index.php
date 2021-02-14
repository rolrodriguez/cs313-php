<?
  require_once('./db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>W06 assignment</title>
</head>
<body>
  <form method="post" action="./insertScripture.php">
    <label for="book">Book: </label><br/>
    <input type="text" name="book" id="book" placeholder="Book"><br/>
     <label for="chapter">Chapter: </label><br/>
    <input type="text" name="chapter" id="chapter" placeholder="Chapter"><br/>
     <label for="verse">Verse: </label><br/>
    <input type="text" name="verse" id="verse" placeholder="Verse"><br/>
    <label for="content">Content: </label><br/>
    <textarea name="content" id="content" cols="30" rows="10" style="resize: none;" placeholder="Content"></textarea><br/>
    <?php
        displayTopicsAsCheckboxes();
    ?>
    <input type="checkbox" name="newtopiccheck" id="newtopiccheck">
    <input type="text" name="newtopic" id="newtopic"><br/>
    <input type="submit" value="submit" id="submit">
  </form>

  <h2>Scriptures:</h2>
  <div id="responses">
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script>
  $(document).ready(function(){
    $.get('./getScriptures.php', function(res){
      $('#responses').html(res);
    });

    document.forms[0].onsubmit = function(e){
      e.preventDefault();
      $.post('./insertScripture.php', $("form").serializeArray() , function(){
            $.get('./getScriptures.php', function(res){
                $('#responses').html(res);
            });
      });
    }
  }
  );
  </script>
</body>
</html>