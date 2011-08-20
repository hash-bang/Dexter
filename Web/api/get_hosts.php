<?
// Simple script for parsing the output of bin/list into JSON

$hosts = array();
$output = `perl bin/get_hosts.pl`;
#$output = file_get_contents('dumps/hosts.dump'); # FIXME: Debug
foreach (preg_split('/\n/', $output) as $line)
	if (preg_match('/^(.+?),(.+?),(.*)$/', $line, $matches))
		$hosts[] = array('ip' => $matches[1], 'mac' => $matches[2], 'name' => $matches[3]);
#$hosts[] = array('ip' => '127.0.0.1', 'mac' => 'LOCALHOST', 'name' => 'LOCALHOST');
echo json_encode($hosts);
?>
