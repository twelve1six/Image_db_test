<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Save Or Display Image From DB</title>
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

		switch($_GET['mode']) {
			case 'store' :
				//Save img into DB
				
				//query ready
				$stmt = $pdo -> prepare("INSERT INTO Gallery (image, type) VALUES (:image, :type)");
				
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
				echo "</br>".$_FILES['image']['size'];			
								
				//bind params
				$stmt -> bindParam(':image', file_get_contents($_FILES['image']['tmp_name']),PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
				$stmt -> bindParam(':type', $_FILES['image']['type']);	
										
				//execute
				$stmt -> execute();
				
			break;
			
			case 'retrive' :
				//Display it from DB
				try {
					
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
					echo '<img src="data:'.$type.';base64,'.$b64image.'"/>';								
				}
				
				} catch(PDOException $e) {
					echo $e->getMessage();
				}
				
				//$stmt2 -> execute(array(':id' => $_POST['id']));
				
				//$stmt2 -> bindColumn('image', $id);
				//$stmt2 -> bindColumn(1, $image, PDO::PARAM_LOB);
				//$stmt2 -> bindColumn(1, $image, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
				//$stmt2 -> bindColumn(2, $image, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
				// if($row = $stmt2 -> fetch(PDO::FETCH_ASSOC)) {
					// // echo $row['image'];		
					// // echo $row['ID'];								
					// //header('Content-Type: image/jpg');
					// echo $row['image'];
				// }
				
				
				// while($row = $stmt2 -> fetch(PDO::FETCH_BOUND)) {
					//echo $image."</br>";
					// echo $image['type']."</br>";
					// header('content-type: '.$image['type']);
					// echo $image['image'],"</br>";	
					//header('Content-Type: image/jpg');
					//fpassthru($image);
					// file_put_contents($fname.".jpg", $image);
					// echo "<img src='".$fname.".jpg'> </br>";		
				// }								
				break;
		}		
		?>
	</body>
</html>
