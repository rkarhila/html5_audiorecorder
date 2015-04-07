<?php 

require('php/header.php');

echo '<body>'.PHP_EOL;


/* Password checking implementation left outside the project */
require('passwords.php');

if (isset($_POST['username'])) {
  if (isset($_POST['password'])) {
    if (check_password($_POST['username'], $_POST['password'])) {
      $name=$_POST['username'];
    }
    else {
      echo 'Username and password do not match.'.PHP_EOL;
    }
  }  
}

//$name="Tarzan";
$task="Svenska_1";
$prompt="Varför har jag så stora fötter?";




if ($name) {
  require('php/recording_html.php');
}
else {
  require('php/auth.php');
}

require('php/footer.php');
	
?>