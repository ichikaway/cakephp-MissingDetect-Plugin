<?php
class PropertyBehavior extends ModelBehavior{

	function setup(&$model, $config = array()){

		if(!empty($model->actAs)){
			$message = array('actAs' => 'You are using actAs property in your Mode. use "actsAs".');
			Configure::write('Missingdetect.Model', $message);
		}
	}

}
?>
