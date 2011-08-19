<?
// Simple script to relay the context of an attack in JSON

if (defined($_GET['ip']))
	die('No IP specified in GET');
if (defined($_GET['mac']))
	die('No MAC specified in GET');
if (defined($_GET['name']))
	die('No Name specified in GET');

$dexter = '/home/mc/Dexter/dexter'; // Path to dexter executable
$do_random = 0; // Random output mode

$result = array(
	'ip' => $_GET['ip'],
	'mac' => $_GET['mac'],
	'name' => $_GET['name'],
	'ports' => array(),
	'status' => 'ok',
);
sleep(3);


if ($do_random) { // Do a fake test
	if (rand(1,100) < 60) {
		$result['status'] = 'warning';
		foreach (range(1, rand(1,3)) as $offset)
			$result['ports'][rand(50,300)] = 'ICMP';
	}
} else { // Do an actual test
	#$output = `perl $dexter $ip`;
	$output = file_get_contents('dumps/report.dump');

	preg_match_all('/Found open port ([0-9]+)/', $output, $matches, PREG_SET_ORDER);
	$result['status'] = 'warning';
	foreach ($matches as $port)
		$result['ports'][$port[1]] = '';
}

echo json_encode($result);
?>
