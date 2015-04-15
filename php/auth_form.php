<?php


echo "<form method=post action=\"".$_SERVER['PHP_SELF']."\">".PHP_EOL;
echo "<p>".get_message('Who are you?')."<br>".PHP_EOL;
echo "<table><tr>".PHP_EOL;
echo "<td>".get_message('Username')."</td>";
echo "<td><input type=text name=username size=12></td>".PHP_EOL;
echo "</tr><tr>";
echo "<td>".get_message('Password')."</td>";
echo "<td><input type=password name=password size=12></td>".PHP_EOL;
echo "</tr></table>";

echo "<input type=submit value='".get_message('Submit')."'>".PHP_EOL;



?>