<?php

$time = date('m/d/Y h:i:s a', time());
$fp = fopen('../log/leadlog.csv', 'a+');  
fputcsv($fp,array($time,$firstname,$lastname,$email,$phone,$formpage,$source,$medium,$campaign));  
fclose($fp);  