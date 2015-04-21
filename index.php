<?php 
// Start the session
session_start();
require('conf.php');

// Expire session in so-and-so-many minutes:
// From http://stackoverflow.com/questions/520237/how-do-i-expire-a-php-session-after-30-minutes
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $conf['session_expiration_time'])) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp


require('php/get_messages.php');

// auth.php checks password and gives the $name variable
require('php/auth.php');


// Headers ie. styles etc:
require('php/header.php');



echo '<body>'.PHP_EOL;


if (isset($name)) {
  require('php/help_bar.php');
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