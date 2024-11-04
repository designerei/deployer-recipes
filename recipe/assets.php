<?php

namespace Deployer;

desc('Build assets locally');
task('assets:build', function () {
    runLocally('bin/console importmap:install');
    runLocally('bin/console tailwind:build --minify');
    runLocally('bin/console asset-map:compile');
});

desc('Clear assets locally');
task('assets:clear', function () {
    runLocally('rm -rf ./{{public_path}}/asset-mapper');
});

before('deploy', 'assets:build');
after('deploy', 'assets:clear');