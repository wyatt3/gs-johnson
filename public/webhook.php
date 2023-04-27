<?php
$command = 'cd /var/www/gsjohnson/ && git reset --hard HEAD && git clean -d -f && git pull origin master && php artisan migrate && npm install && npm run prod';
$output = [];
exec($command, $output);
foreach ($output as $command_result) {
    echo $command_result . "<br>";
}
