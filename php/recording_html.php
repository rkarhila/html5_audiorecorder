<?php

// Get tasks 
// In the future, let's take them from a database. 

// For now, it's enough to get them an array;
//


$tasks=Array(1 => Array ('name' => "Ts1_Testi", 'text'=> "<p>
Alla näet tasomonitorin. Kun puhut mikrofoniin, sen pitäisi aaltoilla puheesi mukaan. Sivussa näkyvä palkki ilmoittaa sopivasta äänenpainetasosta.
<p>
Jos et näe monitorissa mitään liikettä, on mikrofonissasi ongelma. Annoitko luvan mikrofonin käyttöön? Jos et, voit ladata sivun uudestaan ja tarkistaa, että olet valinnut oikean mikrofonin. Onko mikrofoni päällä? Jos ei, sen voi laittaa päälle järjestelmäsi ääniasetuksista.
<p>
Jos monitori näyttää usein punaista, on mikrofonin äänenvoimakkuus liian kovalla. Voit säätää sitä järjestelmäsi ääniasetuksista.
<p>
Jos ei ota toimiakseen, niin kai siellä joku opettaja on, jonka voi pyytää avuksi?
<p>
Kun mikrofoni toimii, niin paina \"Seuraava tehtävä\"-nappia."),
	     2 => Array ('name' => "Uploadtest", 'text'=>'Nyt testaan ääninäytteen siirtoa palvelimelle. Kun olen puhunut tarpeeksi, lopetan äänityksen nappia painamalla, jolloin myös nauhoitukseni lähetetään automaattisesti palvelimelle. Jos siitä ei tule virhettä ruudun alareunaan, niin painan tuota jatka-nappia ja aloitan ruotsin nauhoittamisen.'),


	     3 => Array ('name' => "Sv1_varfor_har_j", 'text'=> "Varför har jag så stora fötter?"),
	     4 => Array ('name' => "Sv2_jag_vill_kop", 'text'=> "Jag vill köpa en Lenovo Thinkpad Yoga 11e 11,6\" Touch/Celeron N2930/4 Gt/500 Gt/Windows 8.1 64-bit"),
	     5 => Array ('name' => "Sv3_har_vilar_oc", 'text'=> "Här vilar och härifrån tvättas!"));


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
  echo "             tasks[$ct] = '".str_replace ( "\n" , "\\\n" , $task['text'])."';".PHP_EOL;
  echo "             tasknames[$ct] = '".$task['name']."';".PHP_EOL;
  $ct++;
}
echo '             var currenttask = '.$tasknr.';'.PHP_EOL;  
echo '             var taskcount = '.sizeof($tasks).';'.PHP_EOL;
echo '             var speaker = \''.$name.'\';'.PHP_EOL;
echo '             var maxrectime = '.$conf['max_rec_time'].';'.PHP_EOL;
echo '       </script>'.PHP_EOL;

echo '
       <script type="text/javascript">
           var timercounter=maxrectime+1;
           setInterval(function () {
               $id("timer").innerHTML=++timercounter;
               if (timercounter==maxrectime) {
                 $id("record").click();
               }
           }, 1000);
       </script>
'.PHP_EOL;



echo '
        <script type="text/javascript">   
           location.hash = \''.$tasknr.'\';'.PHP_EOL;

echo '
           function nextTask() {
               currenttask += 1;
               refreshTask();
           }
           function prevTask() {
               currenttask -= 1;
               refreshTask();
           }'.PHP_EOL;

echo '
           function refreshTask() {
               location.hash = currenttask;       
               if (currenttask > taskcount) {
                  $id("prompt").innerHTML= messages[\'Thats it\'];
                  $id("viz").innerHTML=\'<p>\'+messages[\'You can log out after...\'];
                  $id("doingtask").style.visibility = "hidden";
                  $id("instructions").style.visibility = "hidden";
                  /*window.history.pushState("foo","footitle","'.strtok($_SERVER['REQUEST_URI'],'?').'?t="+currenttask);*/
               }
               else if  (currenttask == 1) {
                 $id("doingtask").style.visibility = "hidden";
                 $id("secondblock").style.visibility = "hidden";
                 $id("instructions").style.visibility = "hidden";
                 $id("prompt").innerHTML=tasks[currenttask];
                 $id("nextButton").disabled=false;
  	         $id("listenButton").disabled = true;
               }
               else {
                 $id("doingtask").style.visibility = "visible";
                 $id("secondblock").style.visibility = "visible";
                 $id("instructions").style.visibility = "visible";
                 $id("prompt").innerHTML=tasks[currenttask];
                 $id("nextButton").disabled=true;
  	         $id("listenButton").disabled = true;
  	         $id("record").innerHTML = messages[\'Record\'];
                 $id("doingtask").innerHTML=messages[\'You are doing task \']+ currenttask + \'/\' + taskcount + \'.\';
                 /*window.history.pushState("foo","footitle","'.strtok($_SERVER['REQUEST_URI'],'?').'?t="+currenttask);*/
               }
           }'.PHP_EOL;
echo '
           window.onhashchange = function() {       
              if (location.hash.length > 0) {        
                   currenttask = parseInt(location.hash.replace(\'#\',\'\'),10);     
              } else {
                   currenttask = 1;
              }
              refreshTask();
           }'.PHP_EOL;
echo '
        </script>'.PHP_EOL;




echo '<div id="main">'.PHP_EOL;

echo '<div id="zerothblock">'.PHP_EOL;
echo '<div id="doingtask" '.$visibility.'>'.PHP_EOL;
echo get_message('You are doing task ').$tasknr."/".sizeof($tasks).".<br>".PHP_EOL;
echo '</div>'.PHP_EOL;


echo '<div id=instructions '.$visibility.'>'.PHP_EOL;
echo get_message('Press the <i>Record audio</i> button and say into the microphone:').PHP_EOL;
echo '</div>'.PHP_EOL;
echo '<div id="prompt">'. $prompt .'</div>'.PHP_EOL;

echo "<audio id='recordedObject'></audio>".PHP_EOL;
echo '</div>';

echo '<div id="viz">
<div id="firstblock">

      <canvas id="analyser" width="200" height="100"></canvas> <br>

</div>
<div id="secondblock" '.$visibility.'>

      <button id="record" name="Record" onclick="toggleRecording(this);">'.get_message('Record<br>audio').'</button>
        <div id=timercontainer>'.get_message('Recording ').'<br><span id=timer>0</span> s (max.'.$conf['max_rec_time'].' s)</div><br>

	<br><canvas id="wavedisplay" width="200" height="100"></canvas> <br>
	<input type="button" onClick=\'document.getElementById("recordedObject").play()\' id="listenButton" value="'.get_message('Listen').'" name="listen" disabled>
	<input type="button" id="nextButton" value="'.get_message('Next task').'" name="next" onClick="nextTask();" '.$disablenext.' style="visibility: visible;">

      <form action="upload.php" method="post" id="upload" enctype="multipart/form-data">
        <input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="'.$conf['max_file_size'].'" />
        <input type="hidden" id="filename" name="filename" value="'.$name.'-'.$task.'" />
        <input hidden=hidden type="text" name="name" value="'.$name.'">
        <input hidden=hidden type="text" name="task" value="'.$task.'">
      </form>

  </div>
</div>
<div id="messages"></div>

<div id="progress"></div>

';





?>