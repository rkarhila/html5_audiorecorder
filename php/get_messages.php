<?php

function get_message($msg, $lng='en') {

  $messages=Array( 'Successful login' => 'Tervetuloa, ',
		   'Unsuccessful login' => 'Tunnus ja salasana eivät täsmää.',
		   'Username' => 'Tunnus',
		   'Password' => 'Salasana',
		   'Who are you?' => 'Kuka olet?',
		   'Submit' => 'Anna mennä!',
		   'You\'re logged in as ' => 'Olet kirjautunut nimellä ',
		   'Log out here.' => 'Kirjaudu ulos tästä',
		   'You\'ve been logged out.' => 'Olet kirjautunut ulos',
		   'Start from beginning.' => "Aloita alusta.",
		   'Listen' => 'Kuuntele',
		   'Next task' => 'Seuraava tehtävä',
		   'Record<br>audio' => 'Aloita<br>äänitys',
		   'Re-record<br>audio' => 'Äänitä<br>uudelleen',
		   'Level meter' => 'Tasomittari tai mikä lie.',
		   ' uploaded.' => ' siirretty palvelimelle.',
		   ' could not be saved.' => '-tiedostoa ei voitu tallentaa',
		   'You are doing task ' => 'Tällä hetkellä työn alla tehtävä ',
		   'You can log out after the upload has finished.' => 'Voit kirjautua ulos kun tiedostojen siirto palvelimelle on valmistunut.',
		   'That\'s it! Thanks for your support!' => 'Det var det! Tack ska du ha!',
		   'Press the rec button and say into the microphone:' => 'Paina nauhoitusnappia ja puhu mikrofoniin:',
		   'Stop<br>and upload' => 'Lopeta ja<br>tallenna');

  
  if (isset($messages[$msg])) {
    return $messages[$msg];
  }
  else
    return '<span style="color:red;">'.$msg.'</span>';
}


function get_all_javascript_messages() {
 echo PHP_EOL.'<script type="text/javascript">'.PHP_EOL;
 echo '    var messages = new Object()'.PHP_EOL;
 echo '    messages[\'Record\']=\''.get_message('Record<br>audio').'\';'.PHP_EOL;
 echo '    messages[\'Rerecord\']=\''.get_message('Re-record<br>audio').'\';'.PHP_EOL;
 echo '    messages[\'You are doing task \']=\''.get_message('You are doing task ').'\';'.PHP_EOL;
 echo '    messages[\'You can log out after...\']=\''.get_message('You can log out after the upload has finished.').'\';'.PHP_EOL;
 echo '    messages[\'Thats it\']=\''.get_message('That\'s it! Thanks for your support!').'\';'.PHP_EOL;
 echo '    messages[\'Stop<br>and upload\']=\''.get_message('Stop<br>and upload').'\';'.PHP_EOL;
 echo '</script>'.PHP_EOL;

}