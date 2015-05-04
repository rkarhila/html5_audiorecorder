<!DOCTYPE html>
<html lang="en-us">
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" />
  <title dir="ltr"><?php echo $pageTitle ?></title>
  <meta name="viewport" content="width=device-width" initial-scale="1.0" />
  <link rel="stylesheet" media="screen" href="css/styles.css" />
  <body></body>
  <header>
    <div id="loginmessage">
      <?php echo $login_message ?>
    </div>
  </header>
  <?php if ($name): ?>
    <h1>Tämä on ylläpidon käyttöliittymä.</h1>
    <p>
      Sinä olet 
      <?php echo $name ?>
      ja koulusi on 
      <?php echo $user['school'] ?>
    </p>
    <?php if ($newspeakers) { ?>
      <h2>Juuri lisäämäsi puhujat:</h2>
      <p>Kopioi tästä ennenkuin maailma vie oikeat nimet mennessään!</p>
      <table id="readerstable">
        <th>Vuosikurssi</th>
        <th>A/B-ruotsi</th>
        <th>Tunnus</th>
        <th>Salasana</th>
        <th>Oikea nimi</th>
        <?php foreach ($newspeakers as $student) { ?>
          <tr>
            <td class="readerstd">
              <?php echo $student['yearinschool'] ?>
            </td>
            <td class="readerstd">
              <?php echo $student['langchoice'] ?>
            </td>
            <td class="readerstd">
              <?php echo $student['username'] ?>
            </td>
            <td class="readerstd">
              <?php echo $student['password'] ?>
            </td>
            <td class="readerstd">
              <?php echo $student['realname'] ?>
            </td>
          </tr>
        <?php } ?>
      </table>
    <?php } ?>
    <h2>Kaikki tämänhetkiset puhujasi:</h2>
    <table id="readerstable">
      <th>Lisäysaika</th>
      <th>Vuosikurssi</th>
      <th>A/B-ruotsi</th>
      <th>Tunnus</th>
      <th>Salasana</th>
      <th>Kuuntele</th>
      <?php foreach ($students as $student) { ?>
        <tr>
          <td class="readerstd">
            <?php echo $student['timestamp'] ?>
          </td>
          <td class="readerstd">
            <?php echo $student['yearinschool'] ?>
          </td>
          <td class="readerstd">
            <?php echo $student['langchoice'] ?>
          </td>
          <td class="readerstd">
            <?php echo $student['username'] ?>
          </td>
          <td class="readerstd">
            <?php echo $student['password'] ?>
          </td>
          <td class="readerstd">
            <?php echo $student['samples'] ?>
          </td>
        </tr>
      <?php } ?>
    </table>
    <h2>Lisää puhujia:</h2>
    <form name="newstudents" action="teacher.php" method="post">
      <p>Kopioi allaolevaan kenttään oppilaittesi nimet, valitse vuosikurssi ja A/B-ruotsi, niin saat tunnukset heille:</p>
      <textarea name="usernames" cols="80" rows="20"></textarea>
      <br />
      Vuosikurssi:
      <table>
        <tr>
          <td>
            <input type="radio" name="yearinschool" value="1" />
          </td>
          <td>1</td>
        </tr>
        <tr>
          <td>
            <input type="radio" name="yearinschool" value="2" />
          </td>
          <td>2</td>
        </tr>
        <tr>
          <td>
            <input type="radio" name="yearinschool" value="2" />
          </td>
          <td>3</td>
        </tr>
      </table>
      Kielivalinta (A/B):
      <table>
        <tr>
          <td>
            <input type="radio" name="langchoice" value="A" />
          </td>
          <td>A</td>
        </tr>
        <tr>
          <td>
            <input type="radio" name="langchoice" value="B" />
          </td>
          <td>B</td>
        </tr>
      </table>
      <br />
      <input type="submit" value="Tee tunnukset" />
    </form>
  <?php else: ?>
    <h1>Admin interface</h1>
    <div id="logincontainer">
      <div id="recorderlogin">
        <h1>Kuka olet?</h1>
        <form name="login" action="teacher.php" method="post">
          <p>Tunnus: </p>
          <input type="text" name="username" />
          <p>Salasana: </p>
          <input type="password" name="password" />
          <p></p>
          <input type="submit" value="login" />
        </form>
      </div>
    </div>
  <?php endif; ?>
</html>