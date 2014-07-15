<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Save Image to DB</title>
	</head>
	
	<body>
		<form enctype="multipart/form-data" action="./SaveToDB_Img.php?mode=store" method="POST">
			<p> image :	<input type="file" name="image"> </p>
			<p> <input type="submit" value="save"/> </p>			
		</form>		
		
		<form action="./SaveToDB_Img.php?mode=retrive" method="POST">
			<p> id :	<input type="text" name="id"> </p>
			<p> <input type="submit" value="display" /> </p>			
		</form>	
	</body>
</html>