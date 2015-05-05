<!DOCTYPE html>
<html lang="en-us">
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" />
  <title dir="ltr"><?php echo $pageTitle ?></title>
  <meta name="viewport" content="width=device-width" initial-scale="1.0" />
  <link rel="stylesheet" media="screen" href="css/styles.css" />
  <body>
    <?php echo $logoutmessage ?>
  </body>
  <?php if ($feedbackform): ?>
    <form name="feedback" action="logout.php" method="post">
      <h1>Jätä palautetta äänityssysteemistä! </h1>
      <p>
        Palaute käsitellään erillään datasta ja anonyymisti, 
        jos et erikseen jätä yhteystietojasi, mikä lienee tarpeen
        vain jos kysyt jotain ja haluat saada vastauksen.
      </p>
      <p>Miten meni? Sana on vapaa, alla muutama johdantokysymys:</p>
      <ul>
        <li>
          Oliko järjestelmä helppokäyttöinen? Miten sitä voisi parantaa?
        </li>
        <li>
          Tuntuiko ruudulta lukeminen luontevalta? Artikuloitko eri tavalla kuin toiselle ihmiselle puhuessasi?
          Jos, niin miten, ja voisiko tätä ilmiötä jotenkin välttää?
        </li>
        <li>
          Tuntuivatko tehtävät järkeviltä? Olivatko luetut kappaleet ja dialogit luontevia?
        </li>
      </ul>
      <textarea name="feedback" cols="80" rows="20"></textarea>
      <p>
        Aalto-yliopiston sähkötekniikan korkeakoulun signaalinkäsittelyn ja
        akustiikan laitoksen puheentunnistusryhmä (joka on tämänkin projektin tekniikasta
        vastuussa) tekee muutamia kertoja vuodessa kuuntelukokeita, jotka kestävät yleensä
        n. 30-45 minuuttia ja niistä on tarjolla palkkioksi Finnkinon elokuvalippuja.
        Yleensä kokeet voi tehdä omalla tietokoneella/tabletilla omilla kuulokkeilla 
        mieleisessään rauhallisessa ympäristössä.
      </p>
      <p>
        Jos haluat liittyä sähköpostilistalle, jolla näistä kokeista tiedotetaan, jätä tietosi alle.
        Usko tai älä, mutta näitä tietoja ei yhdistetä äänityksiin tai mahdollisesti jättämääsi palautteeseen.
      </p>
      <p>
        Nimi
        <br />
        <input type="text" name="name" />
      </p>
      <p>
        Syntymävuosi
        <br />
        <input type="text" name="birthyear" />
      </p>
      <p>
        Sähköpostiosoite
        <br />
        <input type="text" name="email" />
      </p>
      <p>
        Äidinkieli (jos ei suomi)
        <br />
        <input type="text" name="nativelang" />
      </p>
      <p></p>
      <input type="submit" value="Jätä palautetta ja/tai liity postituslistalle" />
    </form>
  <?php else: ?>
    <h1>Kiitos palautteesta ja/tai ilmoittautumisesta!</h1>
    <?php echo $registermessage ?>
  <?php endif; ?>
</html>