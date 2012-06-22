<?php

Header('X-Powered-By:inets/5.5.2');
ini_set('session.hash_function', 'whirlpool');
ini_set('session.name', 'sess');
ini_set('session.cookie_lifetime', '0');
ini_set('session.hash_bits_per_character', '5');
ini_set('session.upload_progress.freq', '5%');
ini_set('session.upload_progress.min-freq', '2');

session_set_cookie_params('3900');
session_start();

if(isset($_SESSION['count']))
  {
	$_SESSION['count']++;
  } 
else
  {
   $_SESSION['count'] = 1;
   $_SESSION['time']  = time();
  }

if((time()-$_SESSION['time'])>30)
{
  $_SESSION['time'] = time();
  session_regenerate_id();
}

?>