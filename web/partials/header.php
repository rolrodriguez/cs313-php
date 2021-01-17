<!-- Sections that include the banner and menu -->
<?php
  $menu = [
    "Home"=> "/",
    "Assignments" => "/assignments.php"
    ]
?>
<header>
CSE 341 - Rolando Rodriguez  
</header>
<menu>
  <div id="flex-box">
  <div id="ham">
    <div></div>
    <div></div>
    <div></div>
  </div>
  <div id="title">
    CSE 341 - Rolando Rodriguez
  </div>
  </div>
  <ul>
<?php

foreach ($menu as $name => $link){
  echo "<a href=\"$link\"><li class=\"menu-item\">$name</li></a>";
}

?>

  </ul>
</menu>
