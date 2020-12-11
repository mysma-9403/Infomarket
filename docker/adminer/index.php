<?php
error_reporting(0);
if(getenv('APP_ENV') != 'local' && !isset($_COOKIE['S3tIFvcBAYQcxs5tg5hvf87IBuKnERqdE6o515jqozlISMXKEN40']))
{
    setcookie("S3tIFvcBAYQcxs5tg5hvf87IBuKnERqdE6o515jqozlISMXKEN40", 1,time()+3600*365);
    header('HTTP/1.0 403 Forbidden');
    die('Forbidden!');
}

define('ADMINER_USERNAME', 'root');
define('ADMINER_PASS', 'root');
define('ADMINER_HOST', 'db');

$_GET['username'] = ADMINER_USERNAME;
$_GET['password'] = ADMINER_PASS;
$_GET['server'] = ADMINER_HOST;

function adminer_object() {

  class AdminerSoftware extends Adminer {

    function name() {
      // custom name in title and heading
      return 'Adminer [DOCKER]';
    }

	  function credentials() {
		  // server, username and password for connecting to database
		  return [ADMINER_HOST, ADMINER_USERNAME, ADMINER_PASS];
	  }

	  function login($login, $password) {
		  // validate user submitted credentials
		  return true;
	  }
  }

  return new AdminerSoftware;
}

// include original Adminer or Adminer Editor
include './adminer-4.7.1.php';
