<?php

	require '../authenticator.php';

	if (Authenticator::isConnected()) {
		Authenticator::disconnect();
		echo 'true';
	} else {
		echo 'false';
	}

?>