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
		   ' uploaded.' => ' siirretty palvelimelle.');
  
  if (isset($messages[$msg])) {
    return $messages[$msg];
  }
  else
    return '<span style="color:red;">'.$msg.'</span>';
}


function get_all_javascript_messages() {
 echo PHP_EOL.'<script type="text/javascript">'.PHP_EOL;
 echo '    var messages = new Object()'.PHP_EOL;
 echo '    messages[\'Record\']=\''.get_message('Record').'\';'.PHP_EOL;
 echo '    messages[\'Rerecord\']=\''.get_message('Re-record<br>audio').'\';'.PHP_EOL;
 echo '</script>'.PHP_EOL;

}