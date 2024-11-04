<?php

namespace Deployer;

// backup
desc('Backup database and files');
task('backup', [
    'database:retrieve',
    'files:retrieve'
]);
