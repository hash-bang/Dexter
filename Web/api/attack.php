<?
// Simple script to relay the context of an attack in JSON

if (defined($_GET['ip']))
	die('No IP specified in GET');
if (defined($_GET['mac']))
	die('No MAC specified in GET');
if (defined($_GET['name']))
	die('No Name specified in GET');

$do_random = 1; // Random output mode

$result = array(
	'ip' => $_GET['ip'],
	'mac' => $_GET['mac'],
	'name' => $_GET['name'],
	'ports' => array(),
	'status' => 'ok',
);
sleep(3);


if ($do_random) {
	if (rand(1,100) < 60) {
		$result['status'] = 'warning';
		foreach (range(1, rand(1,3)) as $offset)
			$result['ports'][rand(50,300)] = 'ICMP';
	}
}

echo json_encode($result);
?>
