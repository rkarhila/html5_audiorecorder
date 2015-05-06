<?php
session_start();
require('php/get_messages.php');
require('php/auth.php');

require('conf.php');

$speaker=SQLITE3::escapeString($_GET['username']);
$value=SQLITE3::escapeString($_GET['eval']);

$sqlcheck="select count(*) from speakers where teacher='$name' and username='$speaker'";


if ( $db->querySingle($sqlcheck) == 1 ) {
  $sqlcommand="update speakers set evaluation='$value' where username='$speaker';";
  $success = $db->exec($sqlcommand);
  if ($success) 
    echo "ok!";
  else
    echo "Not good.";
}
echo "Houston, we have an id problem...";

?>