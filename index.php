<?php
// index.php

require_once __DIR__.'/vendor/autoload.php';

$app = new \Silex\Application();

// include the prod configuration
require __DIR__.'/config/dev.php';

require_once __DIR__.'/src/app.php';

$app->run();