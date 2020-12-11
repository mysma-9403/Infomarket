<?php
error_reporting(0);
$_GET['username'] = 'root';
$_GET['password'] = 'root';
$_GET['server'] = 'son3-test-mysql';

function adminer_object() {

    class AdminerSoftware extends Adminer {

        function name() {
      // custom name in title and heading
      return 'Adminer - SON[DOCKER]';
    }

	  function credentials() {
		  // server, username and password for connecting to database
		  return array('son3-test-mysql', 'root', 'root');
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
