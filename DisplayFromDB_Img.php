<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Display Image From DB</title>
	</head>

	<body>
		<?php
		
		header("Content-Type: text/html; charset=euc-kr");
		$serverName = "192.168.0.20,1433";
		//기본 포트port 1433
		$DB_USERID = "sa";
		$DB_USERPW = "h890910)";
		$DB_NAME = "SAFE";

		//$dbh = new PDO('sqlsrv:192.168.0.20,1433', $DB_USERID, $DB_USERPW, array('Database' => "SAFE"));
		try {
			// MySQL PDO 객체 생성
			// mysql을 다른 DB로 변경하면 다른 DB도 사용 가능
			$pdo = new PDO("sqlsrv:Server=$serverName;Database=$DB_NAME", $DB_USERID, $DB_USERPW);
			// 에러 출력
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (Exception $e) {
			echo $e -> getMessage();
		}

		switch($_GET['mode']) {
			case 'store' :
				//query ready
				$stmt = $pdo -> prepare("INSERT INTO Gallary (image, des) VALUES (:image, :des)");

				//bind params
				$stmt -> bindParam(':image', $image, PDO::PARAM_LOB);
				$stmt -> bindParam(':des', $des);

				//set params
				$image = $_POST['image'];
				$description = 'default';

				//execute
				$stmt -> execute();

				break;
		}
		
		?>
	</body>
</html>
