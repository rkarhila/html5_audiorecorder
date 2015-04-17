<?php

// Get tasks 
// In the future, let's take them from a database. 

// For now, it's enough to get them an array;
//


$tasks=Array(1 => Array ('name' => "Sv1_varfor_har_j", 'text'=> "Varför har jag så stora fötter?"),
	     2 => Array ('name' => "Sv2_jag_vill_kop", 'text'=> "Jag vill köpä en Lenovo Thinkpad Yoga 11e 11,6\" Touch/Celeron N2930/4 Gt/500 Gt/Windows 8.1 64-bit"),
	     3 => Array ('name' => "Sv3_har_vilar_oc", 'text'=> "Här vilar och härifrån tvättas!"));




$tasknr=1; // Until otherwise specified...
$prompt=$tasks[$tasknr]['text'];


// Print a javascript array of commands in whatever language used.
get_all_javascript_messages();

echo '
	<script src="scripts/audiodisplay.js"></script>
	<script src="scripts/recorder.js"></script>
	<script src="scripts/main.js"></script>
	<script src="scripts/uploadfile.js"></script>'.PHP_EOL;

echo '
        <script type="text/javascript">
             var tasks = new Object();
             var tasknames = new Object();'.PHP_EOL;
$ct=1;
foreach ($tasks as $task) {
  echo "             tasks[$ct] = '".$task['text']."';".PHP_EOL;
  echo "             tasknames[$ct] = '".$task['name']."';".PHP_EOL;
  $ct++;
}
echo '             var currenttask = '.$tasknr.';'.PHP_EOL;  
echo '             var taskcount = '.sizeof($tasks).';'.PHP_EOL;

echo '       </script>'.PHP_EOL;
echo '
        <script type="text/javascript">   
           function nextTask() {
               currenttask += 1;
               if (currenttask > taskcount) {
                  $id("prompt").innerHTML= messages[\'Thats it\'];
                  $id("viz").innerHTML=\'<p>\'+messages[\'You can log out after...\'];
               }
               else {
                 $id("prompt").innerHTML=tasks[currenttask];
                 $id("nextButton").disabled=true;
  	         $id("listenButton").disabled = true;
  	         $id("record").innerHTML = messages[\'Record\'];
                 $id("doingtask").innerHTML=messages[\'You are doing the task nr \']+ currenttask + \'.\';
               }
           }
        </script>'.PHP_EOL;




echo '<div id="doingtask">'.PHP_EOL;
echo get_message('You are doing the task nr ').$tasknr.".<br>".PHP_EOL;
echo '</div>'.PHP_EOL;


echo '<br>'.PHP_EOL;
echo 'Press the rec button and say into the microphone: '.PHP_EOL;
echo '<div id="prompt">'. $prompt .'</div>'.PHP_EOL;

echo "<audio id='recordedObject'></audio>".PHP_EOL;

echo '<div id="viz">
    <p>'.get_message('Level meter').'<br>
      <canvas id="analyser" width="200" height="100"></canvas> <br>
      <button id="record" name="Record" onclick="toggleRecording(this);">'.get_message('Record<br>audio').'</button>
	<div id="news"></div>
    </p>

      <form action="index.php" method="post" id="uploadForm" enctype="multipart/form-data">
        <input hidden=hidden type="text" name="name" value="'.$name.'">
        <input hidden=hidden type="text" name="task" value="'.$task.'">

	<canvas id="wavedisplay" width="200" height="100"></canvas> <br>

	<input type="button" onClick=\'document.getElementById("recordedObject").play()\' id="listenButton" value="'.get_message('Listen').'" name="listen" disabled>

	<input type="button" id="nextButton" value="'.get_message('Next task').'" name="next" onClick="nextTask();"  disabled>
	</form>


      <form action="upload.php" method="post" id="upload" enctype="multipart/form-data">
          <input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="'.(40*16*44100).'" />
          <input type="hidden" id="filename" name="filename" value="'.$name.'-'.$task.'" />
      </form>
  </div>

<div id="messages"></div>

<div id="progress"></div>
';





?>