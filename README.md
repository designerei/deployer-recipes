# Deployer recipes

This repository contains specific recipes to integrate with [Deployer](https://deployer.org/).

The recipes are customized for use with the `conplate` framework, built by designerei. They are intended to work with 
Contao version 5.3+, Deployer 7.

## Install

`composer require designerei/deployer-recipes:^1.0 --dev`

## Usage

- Install Deployer inside project. `composer require deployer/deployer --dev`
- Create a `deploy.php` inside the project.
- Customize credentials for `host`

```php
<?php

namespace Deployer;

import(__DIR__.'/vendor/designerei/deployer-recipes/recipe/project.php');

set('rsync_src', __DIR__);

host('DEV')
    ->setHostname('hostname')
    ->set('remote_user', 'remote_user')
    ->set('deploy_path', '/home/foobar/httpdocs')
    ->set('bin/php', 'path/to/php')
    ->set('bin/composer', '{{bin/php}} /path/to/bin/composer/composer.phar')
    ->set('cachetool_args', '--web=SymfonyHttpClient --web-path=./{{public_path}} --web-url=https://{{hostname}}')
;

after('deploy:success', 'cachetool:clear:opcache');

// Here you can define project specific excludes and tasks

// Project-specific exclude
//add('exclude', [
//  ''
//]);

// Project-specific tasks
//task('task', function () {
//    runLocally('');
//});

after('contao:manager:download', 'contao:manager:lock');
```

### Deploy

- `dep deploy [HOST]`

### Database helpers

These tasks restore/release the database local <-> remote unidirectionally.

- `dep database:retrieve [host]` downloads a database dump from remote and overwrites the local database
- `dep database:release [host]` overwrites the remote database with the local one

### Files sync

- `dep files:retrieve [HOST]` downloads the remote _/files_ folder to the local _/files_ folder
- `dep files:release [HOST]` uploads the local _/files_ folder to the remote _/files_ folder


### Backup

Combined `database:retrieve` and `files:retrieve` tasks for backup database and files to local project.

- `dep backup [host]`

## Thanks

Thanks to [denniserdmann](https://github.com/denniserdmann) and [richardhj](https://github.com/richardhj) for inspiration
with their [deployer-recipes](https://github.com/nutshell-framework/deployer-recipes).