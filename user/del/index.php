<?php
	require "../../ini.php";

	$user = $_GET['u'];

	exec("htpasswd -D $htpasswd_file $user 2>&1");

	if ($_GET['c']) {
		header("Location: ". $_GET['c']);
	}
?>
