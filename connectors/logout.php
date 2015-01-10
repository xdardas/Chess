<?php

	require '../authenticator.php';

	Authenticator::disconnect();
	header('Location: ../index.php');

?>