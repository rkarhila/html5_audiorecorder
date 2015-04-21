<?php

echo '<div id="help_sidebar">';
echo "<h2>".get_message("Instructions")."[".get_message("Hide")."]</h2>";

echo "<ol>";
echo "<li>".get_message('Enable microphone:').PHP_EOL;
echo "<br><img src='images/microphone_share_firefox.png'><br>".PHP_EOL;
echo get_message('Choose the right microphone and share options from the drop-down menus. ').PHP_EOL;
echo "<li>".get_message('Say something into the microphone. ').PHP_EOL;
echo get_message('You should get a signal in the monitor: ').PHP_EOL;
echo "<br><img src='images/level_meter_sample.png'><br>".PHP_EOL;
echo "<ul>".PHP_EOL;
echo "<li>".get_message('If you have a straight line, check that your microphone is not muted. ').PHP_EOL;
echo "<li>".get_message('If you have a black box, refresh page and check the permissions. ').PHP_EOL;
echo "</ul>".PHP_EOL;
echo "<li>".get_message('The microphone levels should be automatically adjusted. ').PHP_EOL;
echo get_message('Green and yellow are acceptable levels. ').PHP_EOL;
echo get_message('If you do get red levels from microphone: ').PHP_EOL;
echo "<br><img src='images/level_meter_too_loud.png'><br>".PHP_EOL;
echo get_message('Try moving the microphone a little to the side.').PHP_EOL;
echo "<li>".get_message('When the mic is good, press the record button. ').PHP_EOL;
echo "<li>".get_message('Speak out the text. ').PHP_EOL;
echo "<li>".get_message('Press the record button again to stop recording. ').PHP_EOL;
echo "<li>".get_message('You can listen to your utterance. ').PHP_EOL;
echo "<li>".get_message('If you\'re satisfied with it, click on next task to continue. ').PHP_EOL;
echo "</ol>".PHP_EOL;
echo '</div>'.PHP_EOL;

?>
