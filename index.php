<?php

require 'authenticator.php';

$acc = Authenticator::getAccount();
if (is_null($acc)) {
	echo 'Hello guest.';
} else {
	echo 'Hello ' . $acc->username() . '.';
}

echo '</br>'

?>