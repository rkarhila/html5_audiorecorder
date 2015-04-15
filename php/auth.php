<?php

$login_message=null;

if (!isset($_SESSION['username'])) {

  /* Password checking implementation left outside the project    */
  /* for obvious security reasons (i.e. I'm not good in this so   */
  /* I'd rather not publicly display specific vulnerabilities.    */
  
  /* passwords.php must include a function "check_password"       */
  /* that takes a username and password and returns true or false */
  
  require('passwords.php');
  
  if (isset($_POST['username'])) {
    if (isset($_POST['password'])) {
      if (check_password($_POST['username'], $_POST['password'])) {
	$name=$_POST['username'];
	$_SESSION['username']=$name;
	$login_message=get_message('Successful login')."<b>".$name."</b>. <a href=logout.php>". get_message('Log out here.')."</a>";
      }
      else {
	$login_message=get_message('Unsuccessful login');
      }
    }  
  }
}
else {
  $name=$_SESSION['username'];

  $login_message=get_message('You\'re logged in as ')."<b>".$name."</b>. <a href=logout.php>". get_message('Log out here.')."</a>";
}





?>