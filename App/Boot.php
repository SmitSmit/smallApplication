<?php

set_exception_handler(function (\Throwable $exception) {
    echo "\n";

    $cause = $exception;
    $root = true;

    while (null !== $cause) {
        if (!$root) {
            echo "Called by\n";
        }

        echo get_class($cause).': '.$cause->getMessage()."\n";
        echo "\n";
        echo $cause->getFile().':'.$cause->getLine()."\n";
        foreach ($cause->getTrace() as $trace) {
            echo $trace['file'].':'.$trace['line']."\n";
        }
        echo "\n";

        $cause = $cause->getPrevious();
        $root = false;
    }
});

require_once __DIR__ . '/Autoload.php';

use App\Autoload;

spl_autoload_register([Autoload::class, 'baseLoad']);
