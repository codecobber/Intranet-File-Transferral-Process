<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>
<style>
	body{background-color:#d4cee2};
</style>

</head>

<body>

<h1>Intranet File Transferral Process</h1>
<form action="getCont.php" method="post">
Category path: <input type="text" name="path"> eg: news/public-protection-awareness<br>
Parent name: <input type="text" name="name">eg: news<br>
<input type="submit">
</form>
<hr>
<h2>Get images for parent page</h2>
<form action="getImgMain.php" method="post">
Parent name: <input type="text" name="name"> eg: news<br>
<input type="submit">
</form>

</body>
</html>