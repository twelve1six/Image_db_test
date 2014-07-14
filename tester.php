<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Image to DB</title>
	</head>

	<body>
		<?php
		class Model {
			public $text;

			public function __construct() {
				$this -> text = 'Hello world!';
			}

		}

		class View {
			private $model;
			private $controller;

			public function __construct(Controller $controller, Model $model) {
				$this -> controller = $controller;
				$this -> model = $model;
			}

			public function output() {
				return '<a href="mvc.php?action=textclicked">' . $this -> model -> text . '</a>';
			}

		}

		class Controller {
			private $model;

			public function __construct(Model $model) {
				$this -> model = $model;
			}

			public function textClicked() {
				$this -> model -> text = 'Text Updated';
			}

		}

		$model = new Model();
		//It is important that the controller and the view share the model
		$controller = new Controller($model);
		$view = new View($controller, $model);
		if (isset($_GET['action']))
			$controller -> {$_GET['action']}();
		echo $view -> output();
	?>
	</body>
</html>