<html>
	<head>
		<title>Image to DB</title>
	</head>
	
	<body>
		<?php
		
			$model = new Model();			
			$controller = new Controller($model);
			$view = new View($controller, $model);
			
			class Model {
				public $text;
				
				public function __construct() {
					$this->text = 'Hello world!';
				}
			}
			
			class View {
				private $model;
				private $controller;
				
				public function __construct(Controller $controller, Model $model) {
					$this->controller = $controller;
					$this->model = $model;
				}
				
				public function output() {
					return $this->model->text;
				}
			}
			
			class Controller {
				private $model;
				
				public function __construct(Model $model) {
					$this->model = $model;	
				}
			}		

			echo $view->output();
		?>
		
	</body>
</html>