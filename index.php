<?php

require 'authenticate.php';

if (isUserConnected()) {
	echo 'Hello ' . getUserName();
} else {
	echo 'Hello guest.';
}

echo '</br>'

?>