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
// require('php/header.php');



//echo '<body>'.PHP_EOL;

$pageTitle=get_message("Speech corpus collector -- ") . $conf['pagetitle'];


function randomstring($random_string_length) {
  $characters = 'abcdefghjkmnpqrstuvwxyz23456789';
  $string = '';
  for ($i = 0; $i < $random_string_length; $i++) {
    $string .= $characters[rand(0, strlen($characters) - 1)];
  }
  return $string;
}

if (isset($name) && $_SESSION['userclass'] == 'admin') {

  if (isset($_POST['usernames'])) {
    
    $newspeakers = [];
    
    foreach ( explode("\n",$_POST['usernames']) as $newuser  ) {

      $school=$_SESSION['user']['school'];
      
      $newname= strtolower($school)."_".randomstring(4);
      $sqlcommand = "SELECT count(*) FROM speakers WHERE username='$newname'";

      while ($db->querySingle($sqlcommand) > 0) {
	$newname= strtolower($_SESSION['user']['school'])."_".randomstring(4);
	$sqlcommand = "SELECT count(*) FROM speakers WHERE username='$newname'";
      }

      $newpassword=randomstring(5);

      $langchoice=$_POST['langchoice'];
      $yearinschool=$_POST['yearinschool'];
      $teacher=$_SESSION['user']['username'];

      $timestamp=date('Y-m-d h:i:s', time());


      $newspeaker=Array('username'=>$newname, 
			'yearinschool' => $yearinschool, 
			'langchoice' => $langchoice, 
			'password'=> $newpassword, 
			'realname'=> $newuser,
			'timestamp' => $timestamp,
			'teacher' => $teacher);




      $sqlcommand = "INSERT INTO speakers (username, password, school, teacher, langchoice, yearinschool, timestamp) ";
      $sqlcommand .= "values ('$newname','$newpassword','$school','$teacher','$langchoice','$yearinschool','$timestamp');";
      $trying = $db->exec($sqlcommand);

      if (!$trying) {
        print "<pre> Problem with SQL:".PHP_EOL ;
	print "$sqlcommand".PHP_EOL ;
	print "</pre>".PHP_EOL ;
      }

      array_push($newspeakers, $newspeaker);
    }
    
  }
  /*require('php/help_bar.php');*/
  //  echo "<div id=loginmessage>$login_message</div>";

  $teacher=$_SESSION['user']['username'];      
  $sqlcommand = "SELECT * FROM speakers WHERE teacher='$teacher'";
  
  $queryres=$db->query($sqlcommand);
  
  $students=[];
  while ($arr = $queryres->fetcharray()) {
    //print "<pre>";
    //print_r($arr);
    //print "</pre>";
    array_push($students, $arr);

  }

}
else {

  $teacherlogin="<a href=teacher/index.php>".get_message('Login for teachers')."</a>";
  /* authentication has not been performed */
  /* so let's do it here */
  // require('php/auth_form.php');
}

//require('php/footer.php');






require('./templates/teacher.jade.php');

	
?>