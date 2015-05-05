<?php
session_start();

// remove all session variables
session_unset();

// destroy the session 
session_destroy();

require('conf.php');
require('php/get_messages.php');


// Headers ie. styles etc:
//require('php/header.php');


//echo '<body>'.PHP_EOL;

if (!isset($_POST['feedback']) && !isset($_POST['name'])) {

  $logoutmessage="<p>".get_message('You\'ve been logged out.')."</p>
<p><a href=index.php>".get_message('Start from beginning.')."</a></p>";

  $feedbackform = TRUE;
}
else {
  if ( isset($_POST['feedback']) && strlen($_POST['feedback'])>0 ) {

    $timestamp = date('Y-m-d h:i:s', time());
    $ip1=$_SERVER['REMOTE_ADDR'];
    $ip2=$_SERVER['HTTP_X_FORWARDED_FOR'];

    $feedback=SQLite3::escapeString($_POST['feedback']);

    $sqlcommand = "INSERT INTO feedback (feedback,timestamp,ip1,ip2) ";
    $sqlcommand .= "VALUES ('$feedback','$timestamp', '$ip1', '$ip2'); ";
    $db->exec($sqlcommand);

  }
  

  if ( isset($_POST['email']) && strlen($_POST['email'])>3 ) {
 
    $timestamp = date('Y-m-d h:i:s', time());
    $ip1=$_SERVER['REMOTE_ADDR'];
    $ip2=$_SERVER['HTTP_X_FORWARDED_FOR'];

    $name=SQLite3::escapeString($_POST['name']);
    $email=SQLite3::escapeString($_POST['email']);
    $birthyear=SQLite3::escapeString($_POST['birthyear']);
    $nativelang=SQLite3::escapeString($_POST['nativelang']);

    $sqlcommand = "INSERT INTO subscriptions (name,email,birthyear,nativelang,timestamp,ip1,ip2) ";
    $sqlcommand .= "VALUES ('$name','$email','$birthyear','$nativelang','$timestamp', '$ip1', '$ip2'); ";
    $db->exec($sqlcommand);
   

    $registermessage = "<p>$email ".get_message('has been added to the mailing list and will receive a confirmation in the foreseeable future')."</p>";
  }
  
  $feedbackform = FALSE;
}


//require('php/footer.php');


	

require('./templates/logout.jade.php');


?>