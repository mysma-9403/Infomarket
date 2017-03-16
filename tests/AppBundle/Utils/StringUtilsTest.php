<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Utils\StringUtils;

class StringUtilsTest extends WebTestCase
{
	public function testIsMailValid01() { $this->isMailValid('test@wp.pl', true); }
	public function testIsMailValid02() { $this->isMailValid('test13@wp.pl', true); }
	public function testIsMailValid03() { $this->isMailValid('test_13@wp.pl', true); }
	public function testIsMailValid04() { $this->isMailValid('jan_testowy@wp.pl', true); }
	public function testIsMailValid05() { $this->isMailValid('test.kowalski@infomarket.edu.pl', true); }
	public function testIsMailValid06() { $this->isMailValid('jan.kowalski@krk-dev.com', true); }
	
	public function testIsMailValid11() { $this->isMailValid('kąkol@krk-dev.com', false); }
	public function testIsMailValid12() { $this->isMailValid('pędzel@krk-dev.com', false); }
	public function testIsMailValid13() { $this->isMailValid('kłosek@krk-dev.com', false); }
	public function testIsMailValid14() { $this->isMailValid('test1@krk-dev.com test2@krk-dev.com', false); }
	
	public function testIsMailValid21() { $this->isMailValid('test@wp.pl ', false); }
	public function testIsMailValid22() { $this->isMailValid(' test@wp.pl', false); }
	public function testIsMailValid23() { $this->isMailValid('test@wp,pl', false); }
	
	public function testIsMailValid31() { $this->isMailValid('test@wp.pl;test2@wp.pl', false); }
	public function testIsMailValid32() { $this->isMailValid('test@wp.pl,test2@wp.pl', false); }
	
	public function testIsMailValid41() { $this->isMailValid('klosek@krk@dev.com', false); }
	public function testIsMailValid42() { $this->isMailValid('klosek@krk-dev..com', false); }
    
    protected function isMailValid($mail, $valid)
    {
    	$value = StringUtils::isMailValid($mail);
    	$this->assertEquals($valid, $value);
    }
}
