<?php

	require 'authenticate.php';

	disconnectUser();
	header('Location: index.php');

?>