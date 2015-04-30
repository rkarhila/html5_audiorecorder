<?php

function get_message($msg, $lng='en') {

  $messages=Array( 
		  'Speech corpus collector -- ' => 'Puhekorpuksen kerääjä -- ',
		  'Successful login' => 'Tervetuloa, ',
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
		   'Press the <i>Record audio</i> button and say into the microphone:' => 'Paina <i>Aloita äänitys</i>-nappia ja puhu mikrofoniin:',
		   'Stop<br>and upload' => 'Lopeta ja<br>tallenna',
		   'Recording ' => 'Nauhoittaa ',
		   "Instructions" => "Ohjeet",
		   "Hide" => "Piilota",
		   "Enable microphone:" => "Aktivoi mikrofoni: ",
		   "Choose the right microphone and share options from the drop-down menus. " => "Valitse pudotusvalikoista oikea mikrofoni ja anna sille lupa. ",
		   "Say something into the microphone. " => "Puhu jotain mikrofoniin",
		   "You should get a signal in the monitor: " => "Tasomonitoriin pitäisi tulla signaali: ",
		   "If you have a straight line, check that your microphone is not muted. " => "Jos näet vain suoran viiva, tarkista että mikrofoni ei ole mykkä (mute). ",
		   "If you have a black box, refresh page and check the permissions. " => "Jos näet mustan laatikon, koeta aktivoida mikrofoni lataamalla sivu uudestaan. ",
		   "The microphone levels should be automatically adjusted. " => "Mikrofonin tasot säätyvät automaattisesti. ",
		   "Green and yellow are acceptable levels. " => "Vihreä ja keltainen ovat sopivia tasoja. ",
		   "If you do get red levels from microphone: " => "Jos tasomonitori menee punaiselle: ",
		   "Try moving the microphone a little to the side." => "Koeta siirtää mikrofonia hieman sivuun. ",
		   "When the mic is good, press the record button. " => "Kun mikrofoni toimii oikein, paina \"äänitä\"-nappia. ",
		   "Speak out the text. " => "Lue näytetty teksti.",
		   "Press the record button again to stop recording. " => "Paina äänitysnappia uudestaan lopettaaksesi äänityksen. ",
		   "You can listen to your utterance. " => "Voit kuunnella äänityksen. ",
		   'If you\'re satisfied with it, click on next task to continue. ' => "Jos olet siihen tyytyväinen, jatka seuraavaan tehtävään. ",
		   'Attention: Next page will ask you to enable your microphone.' => 'Huomio! Seuraava sivu pyytää sinua aktivoimaan mikrofonin.',
		   'On Firefox, the permission box looks like this:' => 'Firefox-selaimella luvan pyytäminen näyttää suunnilleen tältä:');
		   

  
  if (isset($messages[$msg])) {
    return $messages[$msg];
  }
  else
    return '<span style="color:red;">'.$msg.'</span>';
}


function get_all_javascript_messages() {
  $js_messages= '    <script type="text/javascript">'.PHP_EOL;
  $js_messages.= '    var messages = new Object()'.PHP_EOL;
  $js_messages.= '    messages[\'Record\']=\''.get_message('Record<br>audio').'\';'.PHP_EOL;
  $js_messages.= '    messages[\'Rerecord\']=\''.get_message('Re-record<br>audio').'\';'.PHP_EOL;
  $js_messages.= '    messages[\'You are doing task \']=\''.get_message('You are doing task ').'\';'.PHP_EOL;
  $js_messages.= '    messages[\'You can log out after...\']=\''.get_message('You can log out after the upload has finished.').'\';'.PHP_EOL;
  $js_messages.= '    messages[\'Thats it\']=\''.get_message('That\'s it! Thanks for your support!').'\';'.PHP_EOL;
  $js_messages.= '    messages[\'Stop<br>and upload\']=\''.get_message('Stop<br>and upload').'\';'.PHP_EOL;
  $js_messages.= '</script>'.PHP_EOL;

 return $js_messages;

}



?>