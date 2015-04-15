<?php 
// Start the session
session_start();

require('php/get_messages.php');

// auth.php checks password and gives the $name variable
require('php/auth.php');


// Headers ie. styles etc:
require('php/header.php');



echo '<body>'.PHP_EOL;

echo "<p>$login_message</p>";

// Get tasks etc. 
$task="Svenska_1";
$prompt="Varför har jag så stora fötter?";

if (isset($name)) {
  require('php/recording_html.php');
}
else {
  /* authentication has not been performed */
  /* so let's do it here */
  require('php/auth_form.php');
}

require('php/footer.php');
	
?>