<?php

echo "<form method=post action=\"".$_SERVER['PHP_SELF']."\">".PHP_EOL;
echo "<div style=\"margin-bottom: 25px;\">".PHP_EOL;
echo "<p>".get_message('Who are you?')."<br>".PHP_EOL;
echo "<table><tr>".PHP_EOL;
echo "<td>".get_message('Username')."</td>";
echo "<td><input type=text name=username size=12></td>".PHP_EOL;
echo "</tr><tr>";
echo "<td>".get_message('Password')."</td>";
echo "<td><input type=password name=password size=12></td>".PHP_EOL;
echo "</tr></table>";

echo "</div>";

echo '<div id=prompt  style="margin-bottom: 25px;">'.PHP_EOL;
echo get_message('Attention: Next page will ask you to enable your microphone.').PHP_EOL;
echo "<p>";
echo get_message('On Firefox, the permission box looks like this:').PHP_EOL;
echo "<br><img src='images/microphone_share_firefox.png'><br>".PHP_EOL;
echo get_message('Choose the right microphone and share options from the drop-down menus. ').PHP_EOL;
echo '</div>'.PHP_EOL;

echo '<div>'.PHP_EOL;
echo "<input type=submit value='".get_message('Submit')."'>".PHP_EOL;
echo '</div>'.PHP_EOL;

?>