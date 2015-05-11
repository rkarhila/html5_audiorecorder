<?php

// Get tasks 
// In the future, let's take them from a database. 

// For now, it's enough to get them an array;
//



$tasks=$conf['tasks'];

/*
The tasks are defined in this simple form:

$conf['tasks'] = Array(1 => Array ('name' => "filename_for_uploaded_text1", 'text'=> "Text to be read."),
                       2 => Array ('name' => "filename_for_uploaded_text2", 'text'=> "Another text to be read..."),
                       ...
                       ); 

The "name" field is prepended by username and appended by version number - The system allows 
several recordings of the same task.
*/





if ( isset($_GET['t']) && (int)$_GET['t'] > 0 && (int)$_GET['t'] <= sizeof($tasks) ) {
  $tasknr=$_GET['t'];
  $visibility="";
  $disablenext=" disabled ";
} else {
  $tasknr=1; // Until otherwise specified...
  $visibility='style="visibility: hidden;"';
  $disablenext="";
}

  

$prompt=$tasks[$tasknr]['text'];
$taskname=$tasks[$tasknr]['name'];


// Print a javascript array of commands in whatever language used.
$javascript_messages = get_all_javascript_messages();


$javascript_tasks='
        <script type="text/javascript">
             var tasks = new Object();
             var tasknames = new Object();
             var instructions = new Object();'.PHP_EOL;
$ct=1;
foreach ($tasks as $task) {
  $javascript_tasks.= "             tasks[$ct] = '".str_replace ( "\n" , "\\\n" , $task['text'])."';".PHP_EOL;
  $javascript_tasks.= "             tasknames[$ct] = '".$task['name']."';".PHP_EOL;
  $javascript_tasks.= "             instructions[$ct] = '".$task['instructions']."';".PHP_EOL;
  $ct++;
}
$javascript_tasks.= '             var currenttask = '.$tasknr.';'.PHP_EOL;  
$javascript_tasks.= '             var taskcount = '.sizeof($tasks).';'.PHP_EOL;
$javascript_tasks.= '             var speaker = \''.$name.'\';'.PHP_EOL;
$javascript_tasks.= '             var maxrectime = '.$conf['max_rec_time'].';'.PHP_EOL;
$javascript_tasks.= '       </script>'.PHP_EOL;


$javascript_navigation ='
        <script type="text/javascript">   
           location.hash = \''.$tasknr.'\';
        </script>'.PHP_EOL;

$doingtaskmessage=get_message('You are doing task ').$tasknr."/".sizeof($tasks);

$instructionsmessage=get_message('Press the <i>Record audio</i> button and say into the microphone:');

$audio_object="<audio id='recordedObject'></audio>";

$recordbutton='<button id="record" name="Record" onclick="toggleRecording(this);">'.get_message('Record<br>audio').'</button>';

$timer_element=get_message('Recording ').'<br><span id=timer>0</span> s (max.'.$conf['max_rec_time'].' s)';

$listenbutton='<input type="button" onClick=\'toggle_play();\' oncanplay\'canaudioplay=1\' id="listenButton" value="'.get_message('Listen').'" name="listen" disabled>';

$nextbutton='<input type="button" id="nextButton" value="'.get_message('Next task').'" name="next" onClick="nextTask();" '.$disablenext.' style="visibility: visible;">';

$uploadform='
      <form action="upload.php" method="post" id="upload" enctype="multipart/form-data">
        <input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="'.$conf['max_file_size'].'" />
        <input type="hidden" id="filename" name="filename" value="'.$name.'-'.$taskname.'" />
        <input hidden=hidden type="text" name="name" value="'.$name.'">
        <input hidden=hidden type="text" name="task" value="'.$taskname.'">
      </form>';


$fontsize_slider='<input id="fontslide" type="range" min="10" max="24" value="20" step="2" oninput=\'$id("prompt").style.fontSize=$id("fontslide").value+"px";\'/>';

$rowheight_slider='<input id="rowslide" type="range" min="1" max="2" value="1.5" step="0.25" oninput=\'$id("prompt").style.lineHeight=$id("rowslide").value+"em";\'/>';


?>