<?php
/**
* A CakePHP MissingDetect Plugin
*
* Copyright 2011, Yasushi Ichikawa http://github.com/ichikaway/
*
* Licensed under The MIT License
* Redistributions of files must retain the above copyright notice.
*
* @copyright Copyright 2011, Yasushi Ichikawa http://github.com/ichikaway/
* @package Missingdetect
* @subpackage Missingdetect.Propertycheck.test
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
*/

class PropertyBase extends CakeTestModel
{
	var $actsAs = array('Missingdetect.propertycheck');

	var $useTable = false;
	var $useDbConfig = false;

}

class PropertyCorrect extends PropertyBase
{

}


class PropertyWrong extends PropertyBase
{

	var $actAs = array('test_dummy');
}

class PropertyTestCase extends CakeTestCase
{
	var $fixtures = null;


	function startCase() {
	}

	function endCase() {
	}

	function testCheck() {
		$model = ClassRegistry::init('PropertyCorrect');
		$this->assertEqual(Configure::read('Missingdetect.Model'), null);
	}

	function testCheckFail() {
		$model = ClassRegistry::init('PropertyWrong');
		$expect = array('actAs' => 'You are using "actAs property" in your Mode. use "actsAs".');
		$this->assertEqual(Configure::read('Missingdetect.Model'), $expect);

	}

}
?>
