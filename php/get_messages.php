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
		   'Level meter' => 'Tasomittari tai mikä lie.');
  
  if (isset($messages[$msg])) {
    return $messages[$msg];
  }
  else
    return '<span style="color:red;">'.$msg.'</span>';
}


function get_all_javascript_messages() {
  $jsvars='<script type="javascript">';
  $jsvars.='    var msg_Record=\''.get_message('Record').'\';'.PHP_EOL;
  $jsvars.='    var msg_Rerecord=\''.get_message('Re-record<br>audio').'\';'.PHP_EOL;
  $jsvars.='</script>'.PHP_EOL;

}