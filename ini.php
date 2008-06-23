<?php
	require "lib/configfile.php";

	$root = dirname(dirname(__FILE__));
	$htpasswd_file = "$root/.htusers";
	$htaccess = new ConfigFile("$root/.htaccess");
