<?php

include implode(DIRECTORY_SEPARATOR, array(
            dirname(__FILE__),
            "core",
            "BootStrapper.php"
        )
    );



use core\BootStrapper as BootStrapper;
new BootStrapper();


//var_dump($_SERVER['REQUEST_URI']);
/*
$logger = \Logger::getLogger("main");

$logger->trace("My first message.");   // Not logged because TRACE < WARN
$logger->debug("My second message.");  // Not logged because DEBUG < WARN
$logger->info("My third message.");    // Not logged because INFO < WARN
$logger->warn("My fourth message.");   // Logged because WARN >= WARN
$logger->error("My fifth message.");   // Logged because ERROR >= WARN
$logger->fatal("My sixth message.");   // Logged because FATAL >= WARN*/

/*$logger = \core\Config::$loggers['File'];
$logger2 = new \core\log\FileLogger("core/log/log2.txt");
echo "ssx";

$dummy = new \core\test\Dummy();
$dummy->attach($logger,'A');
$dummy->attach($logger2);
var_dump($dummy);
$dummy->a();
$dummy->notify('A');*/

//trigger_error("log(x) for x <= 0 is undefined, you used: scale = 1",E_USER_NOTICE);

////trigger_error("kokodd", E_USER_NOTICE);//E_USER_ERROR);
//$last = file_get_contents("last");
//echo "PRIMA: $last<br/><br/>";
//$b = $last;
//while($b == $last){
//    $a = rand(0,100);
//    if ($a <= 33)        $b = "CARTA";
//    else if ($a <= 66)   $b = "FORBICI";
//    else $b = "SASSO";
//}
//
//file_put_contents("last",$b);
//echo "PLAYER 1". $b."       -       ";
?>
