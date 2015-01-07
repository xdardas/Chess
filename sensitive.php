<?php

	require 'authenticate.php';

	if (!isUserConnected()) {
		header('Location: index.php');
		exit();
	}

?>

<html>

<h1>I am sensitive ;3</h1>

</html>