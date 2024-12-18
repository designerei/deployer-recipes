<?php

namespace Deployer;

desc('Build assets locally');
task('assets:build', function () {
    runLocally('bin/console importmap:install');
    runLocally('bin/console sass:build');
    runLocally('bin/console tailwind:build --minify');
    runLocally('bin/console asset-map:compile');
});

desc('Clear assets locally');
task('assets:clear', function () {
    runLocally('rm -rf ./{{public_path}}/asset-mapper');
});

// generate fake app.output.css file
desc('Added app.output.css');
task('generate:input-css', function () {
    cd('{{release_path}}');
    run('mkdir {{release_path}}/var/sass');
    cd('{{release_path}}/var/sass');
    run('touch app.output.css');
});

before('deploy', 'assets:build');
after('deploy', 'generate:input-css');
after('deploy', 'assets:clear');