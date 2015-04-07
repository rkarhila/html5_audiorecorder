<?php
echo '
	<script src="scripts/audiodisplay.js"></script>
	<script src="scripts/recorder.js"></script>
	<script src="scripts/main.js"></script>'.PHP_EOL;



echo '<p>';
echo "Your name is: $name <br>".PHP_EOL;
echo "You are doing the task: $task <br>".PHP_EOL;


echo '<br>'.PHP_EOL;
echo 'Press the rec button and say into the microphone: '.PHP_EOL;
echo '<div id="prompt">'. $prompt .'</div>'.PHP_EOL;

echo "<audio id='recordedObject'></audio>".PHP_EOL;

echo '<div id="viz">
    <p> Level meter <br>
      <canvas id="analyser" width="200" height="100"></canvas> <br>
      <button id="record" name="Record" onclick="toggleRecording(this);">Record<br>audio</button>
	<div id="news"></div>
    </p>

    <!--<p>Wave preview <br>-->
      <form action="index.php" method="post" id="uploadForm" enctype="multipart/form-data">
        <input hidden=hidden type="text" name="name" value="'.$name.'">
        <input hidden=hidden type="text" name="task" value="'.$task.'">
	<canvas id="wavedisplay" width="200" height="100"></canvas> <br>
	<!--<a id="save" href="#">Upload</a> -->
	<!--      <button id="save" name="Upload" onClick="uploadFile(this)">Upload</button> -->
	
	<!--<input hidden=hidden type="file" name="fileToUpload" id="fileToUpload">-->
	<!--<input type="submit" id="uploadSubmit" value="Upload audio" name="submit" disabled>-->


	<input type="button" onClick=\'document.getElementById("recordedObject").play()\' id="listenButton" value="Listen" name="listen" disabled>

	<input type="submit" id="nextButton" value="Next task" name="submit" disabled>
	</form>

    </p>
  </div>

  <!--
      <div id="controls">
    <button id="record" name="Record" onclick="toggleRecording(this);">Record</button><br>
    <button id="save" href="#">Upload</button>
  </div>
-->';

?>