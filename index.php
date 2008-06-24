<style>
#add {
	margin: 50px 30px;
}
#add label {
	display: block;
	margin-top: 10px;
}
#add * input { 
	display: block;
}
#add * input:focus { 
	background: yellow;
}
#del li {
	list-style: none;
	padding: 10px; 
	display: inline;
}
#del a { 
	border: 1px outset silver ; 
	padding: 5px 10px; 
	color: black; 
	background-color: lightgrey; 
	text-decoration:none;
}
#del a:hover { 
	background-color: red; 
}
#switch #disable:hover, #switch #disable:visited { 
	background-color: green; 
	color: white; 
}
#switch #enable:hover, #switch #enable:visited { 
	background-color: red; 
	color: white; 
}
</style>
<?php
	require "ini.php";

	$here_url = $here->url;
	$user_del_url = $here->base()->get('./user/del/')->url;
	$enable_auth_url = $here->base()->get('./enable/')->url;
	$disable_auth_url = $here->base()->get('./disable/')->url;
	$private_dir = $here->base()->get('/../')->file;

	if (!is_writable($private_dir) || !is_writable("$private_dir/.htaccess")) {
		$error = "<b>WARNING</b> parent directory or .htaccess are not writeable. <code>chmod 777 $private_dir && chmod 666 $private_dir/.htacess</code></div>"; 
		die("<div style='background-color: yellow; border: 2px solid red; padding: 10px; margin: 10px;'>$error</div>");
	}

	$htpasswd = @file_get_contents($htpasswd_file);
	preg_match_all("/^[^\:\n]+|\n[^\:\n]+/", $htpasswd, $users);
?>
<?php if ($htpasswd) { ?>
<div id="switch">
<sub>
<a id="enable" href="<?php echo "$enable_auth_url?c=$here_url"; ?>">Enable Authentication</a>
|
<a id="disable" href="<?php echo "$disable_auth_url?c=$here_url"; ?>">Disable Authentication</a>
</sub>
</div>
<?php } ?>
<div id="add">
<h1>Add/Update user</h1>
<form method="GET" action="./user/add/">
<label>User Name<input type="text" name="u" /></label>
<label>Password<input type="text" name="p" /></label>
<input type="hidden" name="c" value="<?php echo $here_url; ?>"/>
<input type="submit" />
</form>
</div>
<div id="del">
<h1>Delete user</h1>
<ul>
<?php
	foreach($users[0] as $u) {
		$u = trim($u);
		echo "<li><a href='$user_del_url?u=$u&c=$here_url'>$u</a></li>";
	}
?>
</ul>
</div>
