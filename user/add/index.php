<?php
	require "../../ini.php";

	$user = $_GET['u'];
	$password = $_GET['p'];
	exec("htpasswd -D $htpasswd_file $user");
	exec("htpasswd -nb $user $password >> $htpasswd_file 2>&1");

	if ($_GET['c']) {
		header("Location: ". $_GET['c']);
	}
