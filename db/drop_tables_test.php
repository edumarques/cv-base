<?php

declare(strict_types=1);

$dbFile     = __DIR__ . '/test_db.sqlite3';
$dropScript = __DIR__ . '/drop_tables.sql';

if (!file_exists($dbFile)) {
    echo 'No database to drop tables from.';
    exit();
}

$sqlite = new SQLite3($dbFile);

$creationQuery = file_get_contents($dropScript);

$success = $sqlite->exec($creationQuery);

if ($success) {
    echo 'Tables dropped successfully.';
}
else {
    echo 'There has been an error while dropping the tables. Please try again.';
}
