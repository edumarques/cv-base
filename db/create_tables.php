<?php

declare(strict_types=1);

$dbFile         = __DIR__ . '/db.sqlite3';
$creationScript = __DIR__ . '/create_tables.sql';

if (!file_exists($dbFile)) {
    file_put_contents($dbFile, '');
}

$sqlite = new SQLite3($dbFile);

$creationQuery = file_get_contents($creationScript);

$success = $sqlite->exec($creationQuery);

if ($success) {
    echo 'Tables created successfully.';
}
else {
    echo 'There has been an error while creating the tables. Please try again.';
}
