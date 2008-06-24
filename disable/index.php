<?php
	require "../ini.php";

	$htaccess->param("AuthType", "");
	$htaccess->param("AuthName", "");
	$htaccess->param("AuthUserFile", "");
	$htaccess->param("Require", "");
	$htaccess->update();

	if ($_GET['c']) {
		header("Location: ". $_GET['c']);
	}
