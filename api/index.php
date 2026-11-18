<?php

// Forward Vercel Serverless requests to Laravel public/index.php

// Ensure /tmp directory structure for Laravel storage on Vercel read-only filesystem
$tmpDirs = [
    '/tmp/views',
    '/tmp/sessions',
    '/tmp/cache',
    '/tmp/logs',
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Setup SQLite database in writable /tmp if not exists
$sqliteDb = '/tmp/database.sqlite';
if (!file_exists($sqliteDb)) {
    $seededDb = __DIR__ . '/../database/database.sqlite';
    if (file_exists($seededDb)) {
        @copy($seededDb, $sqliteDb);
    } else {
        @touch($sqliteDb);
    }
}

// Run Laravel application
require __DIR__ . '/../public/index.php';
