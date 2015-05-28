<?php
session_start();
require('php/get_messages.php');
require('php/auth.php');

require('conf.php');

$speaker=SQLITE3::escapeString($_GET['username']);
$value=SQLITE3::escapeString($_GET['eval']);
$type=SQLITE3::escapeString($_GET['type']);

$sqlcheck="select count(*) from speakers where teacher='$name' and username='$speaker'";



if ($type=='phones') {
  $field='phones_evaluation';
}
elseif ($type=='fluency') {
  $field='fluency_evaluation';
}

if (isset($field)) {
  if ( $db->querySingle($sqlcheck) == 1 ) {
    $sqlcommand="update speakers set $field='$value' where username='$speaker';";
    $success = $db->exec($sqlcommand);
    if ($success) 
      echo "ok!";
    else
      echo "Not good.";
  } else {
    echo "Houston, we have an id problem...";
  }
}
else {
  echo "Fuck off, joker.";
}

?>