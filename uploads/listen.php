<html>
<body>
<?php

$files=scandir('.');

sort($files);

echo '<table>'.PHP_EOL;

foreach ($files as $filename) {

  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  if ($ext === "wav") {
    echo "<tr><td>$filename</td>";
    echo "<td><audio src=$filename controls></audio></td></tr>".PHP_EOL;
  }
}

echo "</table>";

?>
</body>
</html>