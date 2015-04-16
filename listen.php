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

  $files=scandir('uploads/'.$name);

  sort($files);

  echo '<table>'.PHP_EOL;

  foreach ($files as $filename) {

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if ($ext === "wav") {
      echo "<tr><td>$filename</td>";
      echo "<td><audio src=uploads/$name/$filename controls></audio></td></tr>".PHP_EOL;
    }
  }

  echo "</table>";

}
else {
  /* authentication has not been performed */
  /* so let's do it here */
  require('php/auth_form.php');
}

require('php/footer.php');
	
?>
