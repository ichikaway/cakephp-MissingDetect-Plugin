<?php

class PropertyModel extends CakeTestModel {
		var $useTable = false;
		var $actAs = array('dummy');
}


class PropertyTestController extends Controller {
	var $uses = array();
	var $components = array('Missingdetect.Propertycheck');
}

class PropertyWrongTestController extends Controller {
	var $uses = array();
	var $components = array('Missingdetect.Propertycheck');
	
	var $use = array('dummy');
	var $component = array('dummy');
	var $helper = array('dummy');
}


class PropertyModelTestController extends Controller {
	var $uses = array('PropertyModel');
	var $components = array('Missingdetect.Propertycheck');
	
}


class PropertyComponentTest extends CakeTestCase {

	var $fixtures = null;

	function startTest($method) {
		Configure::write('Missingdetect.Controller', null);
		parent::startTest($method);
	}

	function testCorrect() {

		$Controller =& new PropertyTestController();
		$Controller->constructClasses();

		$Controller->Component->init($Controller);
		$Controller->Component->initialize($Controller);

		$this->assertEqual(Configure::read('Missingdetect.Controller'), null);
	}	


	function testWrong() {

		$Controller =& new PropertyWrongTestController();
		$Controller->constructClasses();

		$Controller->Component->init($Controller);
		$Controller->Component->initialize($Controller);

    $expect = array(
      'use' => 'You are using "use property" in your Controller. use "uses".',
      'component' => 'You are using "component property" in your Controller. use "components".',
      'helper' => 'You are using "helper property" in your Controller. use "helpers".',
    );

		$this->assertEqual(Configure::read('Missingdetect.Controller'), $expect);

	}	


	function testModel() {

		$Controller =& new PropertyModelTestController();
		$Controller->constructClasses();

		$Controller->Component->init($Controller);
		$Controller->Component->initialize($Controller);

    $expect = array('actAs' => 'You are using "actAs property" in your Mode. use "actsAs".');
    $this->assertEqual(Configure::read('Missingdetect.Model'), $expect);

		Configure::delete('Missingdetect.Model', null);

	}	


}
?>
