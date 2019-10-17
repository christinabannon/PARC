<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title> PARC </title>
</head>

<body>
	<form action="DataStore" method="post">
		How many minutes did it take you to find a parking spot?
		<br>
  		<input type="number" name="quantity" min="1" max="100">
  		<br>
  		<input type="submit" value="Submit">
	</form>
	
</body>
</html>
