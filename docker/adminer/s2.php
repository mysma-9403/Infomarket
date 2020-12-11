<?php
error_reporting(0);
$_GET['username'] = 's2user';
$_GET['password'] = 'mDlJ633Wy04R4qJO';
$_GET['server'] = '54.38.55.127';
$_GET['port'] = '8306';

define('ADMINER_USERNAME', 's2user');
define('ADMINER_PASS', 'mDlJ633Wy04R4qJO');
define('ADMINER_HOST', '54.38.55.127');
define('ADMINER_PORT', '8306');

$_GET['username'] = ADMINER_USERNAME;
$_GET['password'] = ADMINER_PASS;
$_GET['server'] = ADMINER_HOST;
$_GET['port'] = ADMINER_PORT;

function adminer_object()
{
    class AdminerSoftware extends Adminer
    {
        public function name()
        {
            // custom name in title and heading
            return 'Adminer - SON[DOCKER]';
        }

        public function credentials()
        {
            // server, username and password for connecting to database
            return [ADMINER_HOST, ADMINER_USERNAME, ADMINER_PASS];
        }

        public function login($login, $password)
        {
            // validate user submitted credentials
            return true;
        }
    }

    return new AdminerSoftware;
}

// include original Adminer or Adminer Editor
include './adminer-4.7.1.php';
