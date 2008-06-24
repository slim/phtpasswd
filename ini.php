<?php
	require "lib/configfile.php";
	require "lib/localresource.php";

 	$u = "http://". $_SERVER['SERVER_NAME'] ."/". $_SERVER['REQUEST_URI'];
    $f = $_SERVER['SCRIPT_FILENAME'];
    $here = new LocalResource($u, $f);

	$root = dirname(dirname(__FILE__));
	$htpasswd_file = "$root/.htusers";
	$htaccess = new ConfigFile("$root/.htaccess");
