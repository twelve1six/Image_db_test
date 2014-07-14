<html>
	<head>
		<title>Image to DB</title>
	</head>
	
	<body>
		<?php
			class Model {
				public $string;
				
				public function __construct() {
					$this->text = 'Hello world!';
				}
			}
			
			class View {
				private $model;
				private $controller;
				
				public function construct(Controller $controller, Model $model) {
					$this->controller = $controller;
					$this->model = $model;
				}
				
				public function output() {
					return '<h1>' . $this->model->text. '</h1>';
				}
			}
			
			class Controller {
				private $model;
				
				public function construct(Model $model) {
					$this->model = $model;	
				}
			}
			
			$model = new Model();
			
			$controller = new Controller($model);
			$view = new View($controller, $model);
			
			echo $view->output();
		?>
	</body>
</html>