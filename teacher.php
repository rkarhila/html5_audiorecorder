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


/* From http://www.techaspirant.com/php-code-to-find-duration-of-an-audio-file/ */


function getDuration($file) {
  $fp = fopen($file, 'r');
  $size_in_bytes = filesize($file);
  fseek($fp, 20);
  $rawheader = fread($fp, 16);
  $header = unpack('vtype/vchannels/Vsamplerate/Vbytespersec/valignment/vbits',
		   $rawheader);
  $sec = ceil($size_in_bytes/$header['bytespersec']);
  return $sec;
  
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


  $eval_update_url = "<input type=hidden id='evalurl' value='".$conf['evaluation_url']."'>";

  $sqlcommand = "SELECT * FROM speakers WHERE teacher='$teacher'";
  
  $queryres=$db->query($sqlcommand);
  
  $students=[];
  while ($arr = $queryres->fetcharray()) {
    //print "<pre>";
    //print_r($arr);
    //print "</pre>";
    $speaker=$arr['username'];

    $targetdir = "uploads/$speaker/";
    
    $audiofiles=[];

    foreach (glob("$targetdir/*.mp3") as $audiofile) {
      $audioname=str_replace("$targetdir/$speaker-","", $audiofile);
      $audiolength=getDuration($audiofile);

      $link="<audio src=\"$audiofile\" controls></audio>";
      array_push($audiofiles,Array('name'=>$audioname,'length'=>$audiolength, 'link'=>$link));
    }
    $arr['samples']=$audiofiles;




    /* Fluency evaluation */


    $fluency_evaluationform="<select name='fluency_evaluation' id='fluency_eval_$speaker' onChange='updateFluencyEval(\"$speaker\");'>".PHP_EOL;
    
    if ($arr['fluency_evaluation'])
      $default="";
    else
      $default="selected";

    $fluency_evaluationform.="<option $default>Valitse</option>".PHP_EOL;

    foreach($conf['grading'] as $grade) {
      if ($arr['fluency_evaluation'] == $grade) {
	$default="selected";
      }
      else $default="";
      
      $fluency_evaluationform.="<option $default>$grade</option>".PHP_EOL;
    }
    $fluency_evaluationform.='</select>';

    $arr['fluency_evaluationform']=$fluency_evaluationform;





    /* Phonemes evaluation */


    $phones_evaluationform="<select name='phones_evaluation' id='phones_eval_$speaker' onChange='updatePhonesEval(\"$speaker\");'>".PHP_EOL;
    
    if ($arr['phones_evaluation'])
      $default="";
    else
      $default="selected";

    $phones_evaluationform.="<option $default>Valitse</option>".PHP_EOL;

    foreach($conf['grading'] as $grade) {
      if ($arr['phones_evaluation'] == $grade) {
	$default="selected";
      }
      else $default="";
      
      $phones_evaluationform.="<option $default>$grade</option>".PHP_EOL;
    }
    $phones_evaluationform.='</select>';

    $arr['phones_evaluationform']=$phones_evaluationform;

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


$phone_evaluation_tip='<div id="tips"> <a href="#"> <strong>?</strong><span> '.$conf['phones_help'].' </span></a> </div>';

$fluency_evaluation_tip='<div id="tips"> <a href="#"> <strong>?</strong><span>'.$conf['fluency_help'].'</span></a> </div>';



require('./templates/teacher.jade.php');

	
?>