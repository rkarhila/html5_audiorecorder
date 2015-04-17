<?php 
// Start the session
session_start();

require('php/get_messages.php');

// auth.php checks password and gives the $name variable
require('php/auth.php');


// Headers ie. styles etc:
require('php/header.php');



echo '<body>'.PHP_EOL;


if (isset($name)) {
  echo "<div id=loginmessage>$login_message</div>";
  require('php/recording_html.php');
}
else {
  /* authentication has not been performed */
  /* so let's do it here */
  require('php/auth_form.php');
}

require('php/footer.php');
	
?>