<?
// Simple script to relay the context of an attack in JSON

if (defined($_GET['ip']))
	die('No IP specified in GET');
if (defined($_GET['mac']))
	die('No MAC specified in GET');
if (defined($_GET['name']))
	die('No Name specified in GET');

$result = array(
	'ip' => $_GET['ip'],
	'mac' => 'MAC',
	'name' => 'NAME',
	'ports' => array(
		22 => 'SSH',
		80 => 'Web',
		666 => '',
	),
	'status' => 'warning',
);
sleep(3);
echo json_encode($result);
?>
