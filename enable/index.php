<?php
	require "../ini.php";
	
	$htaccess->param("AuthType", "AuthType Basic");
	$htaccess->param("AuthName", 'AuthName "Restricted Resource"');
	$htaccess->param("AuthUserFile", "AuthUserFile $htpasswd_file");
	$htaccess->param("Require", "Require valid-user");
	$htaccess->update();

	if ($_GET['c']) {
		header("Location: ". $_GET['c']);
	}
