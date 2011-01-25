<?php
class PropertyComponent extends Object {

		var $message = array(
			'use' => 'You are using use property in your Controller. use "uses".',
			'component' => 'You are using component property in your Controller. use "components".',
			'helper' => 'You are using helper property in your Controller. use "helpers".',
		);

		var $errors = null;

    function initialize(&$controller, $settings=array()){
			if(!Configure::read('debug')){
				return;
			}

			$keys = array_keys($this->message);
			foreach ($keys as $key) {
				if(isset($controller->{$key})) {
					$this->errors[$key] = $this->message[$key];
				}
			}

			if(!empty($this->errors)) {
					Configure::write('Missingdetect.Controller', $this->errors);
			}

			if(!empty($controller->modelNames)) {
				$model = $controller->{$controller->modelNames[0]};

				if(is_object($model)) {
					$model->Behaviors->attach('Missingdetect.Property');
				}
			}

    }


		function beforeRender() {

      if(!Configure::read('debug')){
        return;
      }

			$error = Configure::read('Missingdetect');
			pr($error);
		}
}
?>
