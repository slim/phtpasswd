<pre>
<?php
	require "../../ini.php";

	$user = $_GET['u'];
	$password = $_GET['p'];
	passthru("htpasswd -D $htpasswd_file $user");
	passthru("htpasswd -nb $user $password >> $htpasswd_file 2>&1");
?>
</pre>
