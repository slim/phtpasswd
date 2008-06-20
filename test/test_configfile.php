<?php
if (! defined('SIMPLE_TEST')) {
  define('SIMPLE_TEST', './simpletest/');
}
require_once(SIMPLE_TEST . 'unit_tester.php');
require_once(SIMPLE_TEST . 'reporter.php');
$include_type = 'tests';

require_once("../lib/configfile.php");

class TestConfigFile extends UnitTestCase
{
    function TestConfigFile()
    {
        $this->UnitTestCase('ConfigFile unittests');
		$this->HtaccessDist   = <<<EOC
RewriteEngine on
RewriteBase /test/
RewriteRule ^$  accueil.php [L]
RewriteRule ^articles/$  articles/article_liste.php [L]
EOC;

		$this->HtaccessWithBase   = <<<EOC
RewriteEngine on
RewriteBase /xxx/yyy/
RewriteRule ^$  accueil.php [L]
RewriteRule ^articles/$  articles/article_liste.php [L]
EOC;
		$this->HtaccessNewRule   = <<<EOC
RewriteEngine on
RewriteBase /xxx/yyy/
RewriteRule ^$  accueil.php [L]
RewriteRule ^articles/$  articles/article_liste.php [L]
RewriteRule ^x/$  /yyyyyyy [L]
EOC;
    }

	function test_apply()
	{
		$htaccess = new ConfigFile('.htaccess');
		$htaccess->param('RewriteBase', 'RewriteBase /xxx/yyy/');
		$resultat = $htaccess->apply($this->HtaccessDist);
		$this->assertEqual($resultat, $this->HtaccessWithBase);
		$htaccess->param('RewriteRule ^x/$', 'RewriteRule ^x/$  /yyyyyyy [L]');
		$resultat = $htaccess->apply($this->HtaccessDist);
		$this->assertEqual($resultat, $this->HtaccessNewRule);
	}

}

$test =& new TestConfigFile();
$test->run(new HtmlReporter());
?>
