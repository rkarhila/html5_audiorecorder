<?php

echo "<form method=post target=index.php>".PHP_EOL;
echo "<p>Who are you?<br>".PHP_EOL;
echo "<table><tr>".PHP_EOL;
echo "<td>Username</td>";
echo "<td><input type=text name=username size=12></td>".PHP_EOL;
echo "</tr><tr>";
echo "<td>Password</td>";
echo "<td><input type=password name=password size=12></td>".PHP_EOL;
echo "</tr></table>";

echo "<input type=submit value='Submit'>".PHP_EOL;



?>