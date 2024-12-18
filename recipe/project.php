<?php

namespace Deployer;

import('recipe/contao.php');
import(__DIR__ . '/assets.php');
import(__DIR__ . '/backup.php');
import(__DIR__ . '/contao.php');
import(__DIR__ . '/contao-rsync.php');
import(__DIR__ . '/database.php');
import(__DIR__ . '/files.php');

set('keep_releases', 3);

add('exclude', [
    '.DS_Store',
    '/.env.example',
    '/.symfony.local.yaml',
    '/themes/*/assets',
    '/var/backups',
]);

after('deploy:vendors', 'deploy:htaccess');
before('deploy:publish', 'contao:manager:download');

after('deploy:failed', 'deploy:unlock');

task('deploy:writable')->disable();