<?php
// Start the session
session_start();
require('php/get_messages.php');
require('php/auth.php');


// Differentiate between direct calls and AJAX:
$fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);

if ($fn) {

  mkdir('uploads/'.$name);

  if (file_exists('uploads/'.$name.'/' . $fn)) {
      $errorcode= -1;
      $errortext= $fn . get_message(" already exists.");
      $msg=$errortext;
    }
  // AJAX call
  elseif (file_put_contents('uploads/' . $name . '/' . $fn, file_get_contents('php://input')) === false) {
      $errorcode= -1;
      $errortext= $fn . get_message(" could not be saved.");
      $msg=$errortext;

    echo json_encode (Array('errorcode' => -1, 'errortext' => "", 'msg' => $fn . get_message(" could not be saved.") ));
  }
  else {
      $errorcode= 0;
      $errortext= "";
      $msg= $fn . get_message(" uploaded.");
  }

  echo json_encode (Array('errorcode' => $errorcode,
			  'errortext' => $errortext, 
			  'msg' => $msg ));

  //echo "$fn uploaded";
  exit();
	
}
else {

  if (isset($name)) {

    //print "<pre>";
    //print_r ($_FILES);
    //print "</pre>";


    $errorcode=0;
    $errortext='';


    $target_dir = "uploads/";
    //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    $target_file = $target_dir . $_POST['name'] . '_' . $_POST['task'] .'.wav';

    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    /*
      if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
      } else {
      echo "File is not an image.";
      $uploadOk = 0;
      }
      }*/
    // Check if file already exists

    if (!isset($_FILES["fileToUpload"]["name"]))
      {
	$errorcode= -4;
	$errortext= "No file specified.";
	$uploadOk = 0;     
      }
    elseif (file_exists($target_file)) {
      $errorcode= -1;
      $errortext= "Sorry, file already exists.";
      $uploadOk = 0;
    }
    //echo "Uploading to $target_file\n".PHP_EOL;

    // Check file size
    // if ($_FILES["fileToUpload"]["size"] > 500 000) {
    elseif ($_FILES["fileToUpload"]["size"] > 2000000) {
      //echo "Sorry, your file is too large.";
      $errorcode= -2;
      $errortext= "File is too large";
      $uploadOk = 0;
    }
    // Allow certain file formats
    //if($imageFileType != "wav" ) {
    //    echo "Sorry, only wav files are allowed.";
    //    $uploadOk = 0;
    //}


    // Check if $uploadOk is set to 0 by an error
    elseif ($uploadOk == 0) {
      //echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file


    } else {
      //print "Does source exist? ".file_exists( $_FILES["fileToUpload"]["tmp_name"] ).PHP_EOL;
  
      //print "Does target exist? ".file_exists( $target_dir) .PHP_EOL;

      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	//echo "The file has been uploaded.";
      } else {
	$errorcode= -500;
	$errortext= "Something went wrong in server side";
      }
    }

    echo json_encode (Array('errorcode' => $errorcode, 'errortext' => $errortext));

  }
  else {
    echo json_encode (Array('errorcode' => -8, 'errortext' => get_message('Not logged in')));
  }
}
?>
