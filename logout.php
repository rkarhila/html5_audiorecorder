<?php
session_start();

// remove all session variables
session_unset();

// destroy the session 
session_destroy();


require('php/get_messages.php');


// Headers ie. styles etc:
require('php/header.php');


echo '<body>'.PHP_EOL;

echo "<p>".get_message('You\'ve been logged out.')."</p>";

echo "<p><a href=index.php>".get_message('Start from beginning.')."</a></p>";

require('php/footer.php');
	



?>