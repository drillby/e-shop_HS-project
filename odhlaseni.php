<!DOCTYPE html>
<html>

<head>
	<title>YellowStore</title>
	<link rel="shotcut icon" href="images/favicon.ico">
</head>

<body>
	<?php
	session_start();
	session_unset();
	session_destroy();

	header("Location: http://xeon.spskladno.cz/~podrazkp/VTC/e-shop/e-shop_hlavni_strana.php");
	?>
</body>

</html>