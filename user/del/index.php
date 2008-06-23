<pre>
<?php
	require "../../ini.php";

	$user = $_GET['u'];

	passthru("htpasswd -D $htpasswd_file $user 2>&1");
?>
</pre>
