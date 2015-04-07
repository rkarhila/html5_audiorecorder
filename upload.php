<?php
//print "<pre>";
print_r ($_FILES);
//print "</pre>";






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
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
else
  echo "Uploading to $target_file\n".PHP_EOL;

// Check file size
// if ($_FILES["fileToUpload"]["size"] > 500 000) {
if ($_FILES["fileToUpload"]["size"] > 2000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
//if($imageFileType != "wav" ) {
//    echo "Sorry, only wav files are allowed.";
//    $uploadOk = 0;
//}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file


} else {
  print "Does source exist? ".file_exists( $_FILES["fileToUpload"]["tmp_name"] ).PHP_EOL;
  
  print "Does target exist? ".file_exists( $target_dir) .PHP_EOL;

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>
