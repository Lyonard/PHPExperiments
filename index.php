<?php
include dirname(__FILE__)."\\core\\BootStrapper.class.php";

use core\BootStrapper as BootStrapper;
new BootStrapper();
echo "ci arrivo";

$logger = \core\Config::$loggers['File'];
$logger2 = new \core\log\FileLogger("C:\\wamp\\www\\PHPExperiments\\core\\log\\log2.txt");
echo "ssx";

$dummy = new \core\test\Dummy();
$dummy->attach($logger,'A');
$dummy->attach($logger2);
var_dump($dummy);
$dummy->a();
$dummy->notify('A');

//trigger_error("log(x) for x <= 0 is undefined, you used: scale = 1",E_USER_NOTICE);

//trigger_error("kokodd", E_USER_NOTICE);//E_USER_ERROR);
?>

