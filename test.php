<?php

$limit = getenv('TEST_LIMIT') ? : PHP_INT_MAX;
$delay = getenv('TEST_DELAY') ? : 0;
$lock = getenv('TEST_LOCK') ? : 0;

$file = '/app/data/test.txt';

if (!file_exists($file)) {
    touch($file);
}

$res = fopen($file, 'a+');

$i = 0;
while (true) {
    $i++;
    $locked = false;
    if ($lock) {
        $locked = flock($res, LOCK_EX);
    }
    $line = sprintf("Host: %s;\t(%010d.);\tTime: %s; \n", gethostname(),  $i, date('Y.m.d. H:i:s.u'));
    if ($locked or !$lock) {
        fwrite($res, $line);
        if ($delay) {
            usleep($delay);
        }
        fflush($res);
        if ($locked) {
            flock($res, LOCK_UN);
        }
    } else {
        echo 'FAILED TO LOCK: ' . $line;
    }
    if ($i >= $limit) {
        break;
    }

}

if (is_resource($res)) {
    fclose($res);
}