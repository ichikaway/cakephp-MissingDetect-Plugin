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
* @subpackage Missingdetect.Propertycheck
* @license http://www.opensource.org/licenses/mit-license.php The MIT License
*/

class PropertycheckBehavior extends ModelBehavior{

	function setup(&$model, $config = array()){

		if(!empty($model->actAs)){
			$message = array('actAs' => 'You are using "actAs property" in your Mode. use "actsAs".');
			Configure::write('Missingdetect.Model', $message);
		}
	}

}
?>
