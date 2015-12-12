<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
//arreglo designado para hacer convivir a mas apps de Hagane <3
// $HaganeInit = array(
// 	'appFolderName' => 'app-uni',
// 	'appFolderDepth' => '../../'
// );

$HaganeInit = array(
	'appFolderName' => 'app-sbc',
	'appFolderDepth' => '../'
);

include_once($HaganeInit['appFolderDepth'].'lib/init.php');

$app = new \Hagane\App();
$app->start($HaganeInit);
?>
