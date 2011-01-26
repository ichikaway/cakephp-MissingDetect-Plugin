<?php

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
