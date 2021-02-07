<?php
require_once('./app.php');
app_processLogin();
app_head('Journal Login', 
Array('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min', 
'./css/style'));
app_login();?>
</div>
</body>
</html>