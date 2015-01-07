<?php

require 'auth.php';

$request = $_SERVER['REQUEST_METHOD'];

if ($request == 'GET')
	do_get();
else if ($request == 'POST')
	do_post();
else if ($request == 'PUT')
	do_put();

function do_get() {
	echo 'Keyword: ';
	if (isset($_GET['q'])) {
		echo $_GET['q'];
	}

	echo '</br>Number of posts: ';

	if (isset($_GET['c'])) {
		echo $_GET['c'];
	}
}

function do_post() {
	if (isset($_POST['title'])) {
		
	}
}

function do_put() {
	echo 'put';
}

?>