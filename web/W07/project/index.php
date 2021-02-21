<?php
/**
 * Journalese login page
 */

// Require app library
require_once('./app.php');

// Process login if a post request is done
app_processLogin();

// App head include stylesheets
app_head('Journal Login', 
Array('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min', 
'./css/style'), true);

// Login form
app_login();

// Site foot
app_foot();
?>