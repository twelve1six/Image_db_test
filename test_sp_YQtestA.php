<HTML>
	<HEAD>

	</HEAD>
	<BODY>
		<?php
		header("Content-Type: text/html; charset=euc-kr");
		$serverName = "192.168.0.20,1433";
		//기본 포트port 1433
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

		//$conn = sqlsvr_connect($DB_IP,$DB_USERID,$DB_USERPW);
		$retval = null;
		
		//have to make a variable to save return value.(retval) 
		$stmt = $pdo -> prepare("EXEC :retval = dbo.sp_YQtestA 3");
		$stmt -> bindParam(':retval', $retval ,PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT,4);
		$stmt -> execute();

	    while ($row = $stmt -> fetch()) { 
		    print_r($row);
			echo "<br>";
		}	
		
		/*
		 *simply excute sp cannot get a return value. 
		 *After 2 nextRowset, can get a return value.		
		 *Reference: http://social.msdn.microsoft.com/Forums/sqlserver/en-US/aac57e8a-4232-45b1-98c6-83491fc7c49d/pdosqlsrv-having-problems-with-store-procedure-output-parameters-and-recordset?forum=sqldriverforphp
		*/
		
		$stmt->nextRowset();
		$stmt->nextRowset();
		
		echo "return value: ".$retval;
		
		unset($pdo);
		unset($stmt);
	?>
	</BODY>
</HTML>