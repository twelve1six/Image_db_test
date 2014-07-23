<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Send Image From DB</title>
	</head>
	
	<body>
		<?php
		
		header("Content-Type: text/html; charset=utf-8");
		//기본 포트port 1433
		$serverName = "192.168.0.20,1433";
		
		//USER & DB info
		$DB_USERID = "sa";
		$DB_USERPW = "h890910)";
		$DB_NAME = "PHP_test";

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
		
				$stmt2 = $pdo -> prepare("SELECT image, type FROM Gallery WHERE id = :id");
				
				//check id
				//echo $_POST['id']."</br>";
								
				$stmt2 -> bindParam(':id', $_POST['id']);
				$stmt2 -> execute();				
				$stmt2 -> bindColumn(1, $image, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
				$row = $stmt2 -> fetch(PDO::FETCH_ASSOC);
				
				if($row) {
					//fpassthru($row['image']);					
					//echo pack('H*',$row['image']);
					//if (headers_sent($file, $line)) { echo "Output at $file line $line"; } else { echo "No output"; } 
					
					// header('Content-Type: image/jpeg');		
					// header('Content-Transfer-Encoding: binary'); 
					// header('Content-Length: 37403');	
// 							
					// print $row['image'];	
					
					$b64image = base64_encode($row['image']);
					$type = $row['type'];	
					
				}
		?>
		
		<form action="./Img_Send_Display_FromDB.php" method="POST">
			<p> image :	<input type="text" name="image"> </p>
			<p> type  : <input type="text" name="type"> </p>
			<p> <input type="submit" value="send"/> </p>		
				
		</form>			

	</body>
</html>