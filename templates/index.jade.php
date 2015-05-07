<!DOCTYPE html>
<html lang="en-us">
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" />
  <title dir="ltr"><?php echo $pageTitle ?></title>
  <meta name="viewport" content="width=device-width" initial-scale="1.0" />
  <link rel="stylesheet" media="screen" href="css/styles.css" />
  <body></body>
  <header>
    <?php if ($login_message) { ?>
      <div id="loginmessage">
        <?php echo $login_message ?>
      </div>
    <?php } ?>
  </header>
  <?php if ($name): ?>
    <?php echo $javascript_tasks ?>
    <?php echo $javascript_messages ?>
    <script src="scripts/audiodisplay.js"></script>
    <script src="scripts/recorder.js"></script>
    <script src="scripts/main.js"></script>
    <script src="scripts/uploadfile.js"></script>
    <script src="scripts/timer.js"></script>
    <script src="scripts/play_sample.js"></script>
    <?php echo $javascript_navigation ?>
    <script src="scripts/navigation.js"></script>
    <div id="main">
      <div id="doingtask">
        <?php echo $doingtaskmessage ?>
      </div>
      <div id="instructions">
        <?php echo $instructionsmessage ?>
      </div>
      <div id="prompt">
        <?php echo $prompt  ?>
      </div>
      <?php echo $audio_object    ?>
      <div id="viz">
        <div id="firstblock">
          <canvas id="analyser"></canvas>
        </div>
        <div id="secondblock">
          <?php echo $recordbutton ?>
          <div id="timercontainer">
            <?php echo $timer_element ?>
          </div>
          <br />
          <br />
          <canvas id="wavedisplay"></canvas>
          <br />
          <?php echo $listenbutton ?>
          <?php echo $nextbutton ?>
        </div>
        <?php echo $uploadform ?>
      </div>
      <div id="messages"></div>
      <div id="progress"></div>
    </div>
  <?php else: ?>
    <div id="logincontainer">
      <div id="recorderlogin">
        <h1>Kuka olet?</h1>
        <form name="login" action="index.php" method="post">
          <p>Tunnus: </p>
          <input type="text" name="username" />
          <p>Salasana: </p>
          <input type="password" name="password" />
          <p></p>
          <input type="submit" value="login" />
        </form>
      </div>
      <div id="teacherlogin">
        <?php echo $teacherlogin ?>
      </div>
    </div>
  <?php endif; ?>
</html>