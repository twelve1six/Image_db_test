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
		//$conn = sqlsvr_connect($DB_IP,$DB_USERID,$DB_USERPW);

		$stmt = $pdo -> prepare("EXEC dbo.SP_INDICATOR_DATA 6, '11', '11090', ' AND SEX IN (1) AND DEATH_YEAR IN (2010, 2011, 2012)', '138', '', '', 'PERCENT_1'");
		$stmt -> execute();
		while ($row = $stmt -> fetch()) {
			print_r($row);
			echo "<br>";
		}

		unset($pdo);
		unset($stmt);
	?>
	</BODY>
</HTML>