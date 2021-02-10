<?php

declare(strict_types=1);

$files = glob(__DIR__ . '/cvs/*');
$count = 0;

foreach ($files as $file) {
    if (is_file($file)) {
        $count++;
        unlink($file);
    }
}

echo "\nCleaned $count files.";
