<?php

	require 'authenticate.php';

	connectUser("admin", "admin");
	header('Location: index.php');

?>