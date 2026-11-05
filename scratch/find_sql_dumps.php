<?php
// Look for any sql dump files in public_html or parent directory
$dirs = [
    __DIR__ . '/..',
    __DIR__ . '/../..',
    __DIR__ . '/../admin-panel',
    __DIR__ . '/../admin-panel/data'
];

foreach ($dirs as $dir) {
    if (is_dir($dir)) {
        $files = scandir($dir);
        foreach ($files as $f) {
            if (preg_match('/\.(sql|xml|csv)$/i', $f)) {
                echo "Found file: $dir/$f (" . filesize("$dir/$f") . " bytes)\n";
            }
        }
    }
}
