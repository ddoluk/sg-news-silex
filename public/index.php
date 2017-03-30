<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Silex\Application;

$app = new Application();
$app['debug'] = true;

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/services.php';
require_once __DIR__ . '/../app/config/routes.php';

$app->run();