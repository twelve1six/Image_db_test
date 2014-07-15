<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Display Image From DB</title>
	</head>

	<body>
		<?php
		
		header("Content-Type: text/html; charset=euc-kr");
		//기본 포트port 1433
		$serverName = "192.168.0.20,1433";
		
		//USER & DB info
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
				$stmt = $pdo -> prepare("INSERT INTO Gallery (image) VALUES (:image)");
				
				//check file exits
				//echo $_POST['image']. "</br>";
				//echo file_exists($_POST['image']);
								
				//set params
				//$datastring = file_get_contents($_POST['image']);
				// $image = file_get_contents($_POST['image']);
				
				//check params
				// echo $image['hex'];;
				// echo $image2;				
				// echo $des;
				
				//check type
				echo "</br>".$_FILES['image']['type'];
				echo "</br>".file_get_contents($_FILES);				
								
				//bind params
				$stmt -> bindParam(':image', file_get_contents($_FILES['image']['tmp_name']),PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
							
				//execute
				$stmt -> execute();
				
				
				//Display it from DB
				
				//$stmt2 -> $pdo -> prepare("SELECT image FROM Gallery WHERE ");
				
								
				break;
		}
		
		?>
	</body>
</html>
