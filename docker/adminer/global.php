<?php
error_reporting(0);
$_GET['username'] = 'root';
$_GET['password'] = 'root';
$_GET['server'] = '51.38.128.35';

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
            return array('51.38.128.35', 'root', 'root');
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
