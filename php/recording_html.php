<?php

echo get_all_javascript_messages();

echo '
	<script src="scripts/audiodisplay.js"></script>
	<script src="scripts/recorder.js"></script>
	<script src="scripts/main.js"></script>'.PHP_EOL;



echo '<p>';
echo "You are doing the task: $task <br>".PHP_EOL;


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

	<input type="submit" id="nextButton" value="'.get_message('Next task').'" name="submit" disabled>
	</form>

    </p>
  </div>';


?>