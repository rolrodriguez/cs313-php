<?php
require_once('./app.php');
if(isset($_GET['logout'])){
  session_start();
  session_destroy();
  header('location:./');
}

app_processLogin();
app_head('Journal Login', Array('./css/style'));
app_login();
app_footer();

?>